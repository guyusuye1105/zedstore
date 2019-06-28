<?php

namespace app\store\model;

use app\common\model\Orders as OrdersModel;
use think\Db;
use think\Request;

/**
 * 商品模型
 * Class Goods
 * @package app\store\model
 */
class Orders extends OrdersModel
{

    /**
     * 获取订单列表
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList($keywords,$pagesize,$datatype='',$begintime='',$endtime='')
    {
        $map = [];
        if ($keywords != '') {
            $map['user.nickName|user.card|user.mobile|staff.name'] = ['like', '%'.$keywords.'%'];
        }
        if ($begintime != ''&&$endtime != '') {
            $map['appoint_time'] = [['>=', $begintime],['<', $endtime+86400]];
        }
        if ($begintime != ''&&$endtime == '') {
            $map['appoint_time'] = ['>=', $begintime];
        }
        if ($begintime == ''&&$endtime != '') {
            $map['appoint_time'] = ['<', $endtime+86400];
        }
        if($datatype == 'all'){

        }else if($datatype == 'ing'){
            $a = array('notgo','inserver','waitmoney');
            $map['a.state'] = ['in', $a];
        }else{
            $map['a.state'] = ['in', $datatype];
        }
        $request = Request::instance();
        $res = $this->order('appoint_time desc,create_time')
            ->alias('a')
            ->join('user','user.user_id = a.user_id')
            ->join('staff','staff.id = a.staff_id')
            ->field('a.*,user.nickName as user_name,user.card,staff.name as staff_name,user.mobile as user_mobile')
            ->where($map)
            ->paginate($pagesize, false, ['query' => $request->request()]);
        // 遍历
        foreach($res as $key=>$val){
            // 设置已逾期订单
            if($val['appoint_time']<time()&& $val['state']=='notgo'){
                $res[$key]['state'] = 'late';
                $lateOrders['state'] = 'late';
                $lateOrders['id'] = $val['id'];
                db($this->name)->update($lateOrders);
            }
        }
        return $res;
    }

    /**
     * 获取所有服务内容
     */
   /* function getFuckItem(){
        $res = db('item')->select()->toArray();
        $res2 = array();
        foreach ($res as $key=>$val){
            $res2[$val['id']] = $val['name'];
        }
        return $res2;
    }*/
    /**
     * 订单导出
     * @param $dataType
     * @param $query
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function exportList($query)
    {
        // 获取订单列表
        $records = $this->getExportList($query);
        //p($records);
        $header = array('num'=>'订单编号','user_name'=>'会员昵称','num'=>'会员卡号','user_mobile'=>'会员手机号码','item_name'=>'项目'
                ,'price'=>'价格（元）','final_price'=>'最终价格（元）','create_time'=>'创建时间','appoint_time'=>'预约时间','staff_name'=>'预约员工'
        ,'state'=>'订单状态');
        $title='订单表'.date('YmdHis');
        excel_export($records,$header,$title);
    }

    /**
     * 获取导出的订单内容
     * @param $query    查询条件
     */
    private function getExportList($query){
        // 返回数组的database配置
        config('database.resultset_type','array');
        $conf = config('database');
        //  确定查询条件
        $map = [];
        if(!empty($query['keywords'])){
            $map['user.nickName|user.card|user.mobile|staff.name'] = ['like','%'.$query['keywords'].'%'];
        }
        if($query['datatype'] == 'ing'){
            $a = array('notgo','inserver','waitmoney');
            $map['a.state'] = ['in', $a];
        }else if($query['datatype'] != 'all'){
            $map['a.state'] = ['in', $query['datatype']];
        }
        if (!empty($query['begintime'])&& !empty($query['endtime'])) {
            $map['appoint_time'] = [['>=', $query['begintime']],['<', $query['endtime']+86400]];
        }
        if (!empty($query['begintime']) && empty($query['endtime'])) {
            $map['appoint_time'] = ['>=', $query['begintime']];
        }
        if (empty($query['begintime']) && !empty($query['endtime'])) {
            $map['appoint_time'] = ['<', $query['endtime']+86400];
        }
        // 执行查询语句-获取订单信息
        $res = db($this->name,$conf)->order('appoint_time desc,create_time')
            ->alias('a')
            ->join('user','user.user_id = a.user_id')
            ->join('staff','staff.id = a.staff_id')
            ->field('a.*,user.nickName as user_name,user.card,staff.name as staff_name,user.mobile as user_mobile')
            ->where($map)
            ->select();
        // 遍历订单信息
        foreach($res as $key=>$val){
            $res[$key]['create_time'] = date('Y-m-d H:i:s',$val['create_time']);
            $res[$key]['appoint_time'] = date('Y-m-d H:i:s',$val['appoint_time']);
            switch($val['state'])
            {
                case 'notgo':
                    $res[$key]['state'] = '未到店';
                    break;
                case 'inserver':
                    $res[$key]['state'] = '服务中';
                    break;
                case 'waitmoney':
                    $res[$key]['state'] = '待支付';
                    break;
                case 'complete':
                    $res[$key]['state'] = '已完成';
                    break;
                case 'cancel':
                    $res[$key]['state'] = '已撤单';
                    break;
                case 'late':
                    $res[$key]['state'] = '已逾期';
                    break;
                default:
                    $res[$key]['state'] = '未知状态';
            }
           /* $val['item_id'] = explode(';',$val['item_id']);
            $tmp = array();
            // 从表item获取每个订单的具体服务
            foreach($val['item_id'] as $key2=>$val2){
                $item_name =  db('item',$conf)->where('id',$val2)->find();
                $tmp[$key2] = $item_name['name'];
            }
            $tmp = implode(';',$tmp);
            $res[$key]['item_name'] = $tmp;*/
           // 根据数据表里的item项（json格式）获取项目名称的字符串和
           $tmp = json_decode($val['item'],true);
           foreach($tmp as $key2=>$val2){
               $tmp2[$key2] = $val2['name'];
           }
            $res[$key]['item_name'] = implode(';',$tmp2);
        }
        return $res;

    }

}
