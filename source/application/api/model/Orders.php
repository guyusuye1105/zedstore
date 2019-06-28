<?php

namespace app\api\model;

use app\common\model\Orders as OrdersModel;
use think\Db;
use think\Request;

/**
 * 订单模型
 */
class Orders extends OrdersModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
       // 'id','num'
    ];
    /**
     * 待支付订单详情
     * @param $order_no
     * @return null|static
     * @throws \think\exception\DbException
     */
    public function payDetail($order_no)
    {
        return self::get(['num' => $order_no]);
    }


    function getlists($user_id,$state,$begintime,$endtime,$page,$pagesize){
        $map['wxapp_id']  = array('=',self::$wxapp_id);
       // $map['appoint_time']  = array(array('>=',$begintime),array('<',$endtime));
        $map['user_id']= array('=',$user_id);
        if($state == ''){

        }else if($state == 'ing'){
            $map['state']  = array('in',array('notgo', 'inserver', 'waitmoney'));//状态为进行中
        }else{
            $map['state']  = array('=',$state);
        }
       if($begintime !=''&&$endtime !=''){
            $map['appoint_time'] = [['>=', $begintime],['<', $endtime+86400]];
        }elseif($begintime !=''&&$endtime ==''){
            $map['appoint_time'] = ['>=', $begintime];
        }elseif($begintime ==''&&$endtime !=''){
            $map['appoint_time'] = ['<', $endtime+86400];
        }
        $total =  count(db($this->name)->where($map)->select());
        $res = db($this->name)
            ->where($map)
            ->order('appoint_time desc')
            ->limit(($page-1)*$pagesize,$pagesize)
            ->select()
            ->toArray();
        // 遍历从staff表获取staff的数据
        foreach($res as $key=>$val){
            // 设置已逾期订单
            if($val['appoint_time']<time()&& $val['state']=='notgo'){
                $res[$key]['state'] = 'late';
                $lateOrders['state'] = 'late';
                $lateOrders['id'] = $val['id'];
                db($this->name)->update($lateOrders);
            }
            // 根据时间状态判断颜色
            if($val['appoint_time']<(time()+1800)&&$val['appoint_time']>time() && $val['state']=='notgo'){
                $res[$key]['color'] = 'yellow';//黄色//还有半个小时到达订单预约时间
            }else if($val['appoint_time']<time() && $val['state']=='notgo'){
                $res[$key]['color'] ='red';//红色//已经到达订单时间但是员工没有确认到店
            }else if($val['state'] == 'inserver'){
                $res[$key]['color'] = 'green';//绿色//员工确认到店正在服务中
            }else{
                $res[$key]['color'] = 'default';
            }

            $res2 = db('staff')->where('id','=',$val['staff_id'])->find();
            $res[$key]['staff_name'] = $res2['name'] ? $res2['name'] : '';
            $res[$key]['staff_mobile'] = $res2['mobile'] ? $res2['mobile'] : '';
            $res[$key]['staff_type'] = $res2['type'] ? $res2['type'] : '';
            $res[$key]['staff_cover'] = $res2['cover'] ? $res2['cover'] : '';

            $res[$key]['item'] = json_decode($res[$key]['item'],true);
            /*$item = explode(';',$val['item_id']);
            $res[$key]['item'] = array();
            // 遍历把服务内容变成数组
            foreach($item as $key2 => $val2){
                $res3 = db('item')->where('id','=',$val2)->find();
                $res[$key]['item'][$key2] = $res3;
            }*/
        }
        $last_page = ceil($total/$pagesize);
        $res4['rows'] = $res;
        $res4['total'] = $total;
        $res4['last_page'] = $last_page;
        return $res4;
    }

    /**
     * 新增订单
     */
    function addList($data){
        //获取价格和最终价格
        $data['price'] = $this->getPrice($data['item_id']);
        $data['final_price'] = $data['price'];
        //获取订单编号
        $data['num'] = $this->orderNo();
        // 根据item_id获取商品信息
        $item = explode(';',$data['item_id']);
        foreach($item as $key2 => $val2){
            $res3 = db('item')->where('id','=',$val2)->find();
            $res[$key2] = $res3;
        }
        $data['item'] = json_encode($res,true);
        $result = $this->createDataGetId($data);
        return $result;
    }
    /**
     * 更新项目
     */
    function updateList($data,$id){
        //获取价格和最终价格
        $data['price'] = $this->getPrice($data['item_id']);
        $data['final_price'] = $data['price'];
        // 根据item_id获取商品信息
        $item = explode(';',$data['item_id']);
        foreach($item as $key2 => $val2){
            $res3 = db('item')->where('id','=',$val2)->find();
            $res[$key2] = $res3;
        }
        $data['item'] = json_encode($res,true);
        $result = $this->updateDataById($data,$id);
        return $result;
    }



}
