<?php

namespace app\store\model;

use app\common\model\BaseModel as BaseModel;
use think\Cache;
use think\Request;
use app\common\model\Wxapp as WxappModel;
use app\common\library\wechat\WxCommon;

/**
 *统计报表
 */
class Reform extends BaseModel
{
    protected $name = 'orders';

    /**
     * 订单统计
     */
    public function getOrderStatistics($begintime,$endtime)
    {
        // 获取一段时间内的所有complete，cancel的订单
        $map = self::$map[0];
        $map['appoint_time'] = [['>=',$begintime],['<',$endtime+24*3600]];
        $map['state'] = ['in',array('complete','cancel')];
        $res = db($this->name)
            ->where($map)
            ->select();

        // 处理数据获得想要的格式（获得各种订单类型的数量）
        $res2 = array(
            'cancel'=>array('count'=>0,'percent'=>''),
            'appoint'=>array('count'=>0,'percent'=>''),
            'instore'=>array('count'=>0,'percent'=>''),
        );
        if(empty($res)){
            $res2 = '';
        }else{
            foreach($res as $key=>$val){
                if($val['state'] == 'cancel'){
                    $res2['cancel']['count'] += 1;
                }elseif($val['state'] == 'complete' && $val['type'] == 'instore'){
                    $res2['instore']['count'] += 1;
                }elseif($val['state'] == 'complete' && $val['type'] == 'appoint'){
                    $res2['appoint']['count'] += 1;
                }else{
                    die('获取订单统计出错');
                }
            }
            $res2['total'] = $res2['cancel']['count'] + $res2['appoint']['count']+$res2['instore']['count'];
            $res2['valid'] = $res2['appoint']['count']+$res2['instore']['count'];
            $res2['cancel']['percent'] = round(($res2['cancel']['count']/$res2['total']*100),1).'%';
            $res2['appoint']['percent'] = round(($res2['appoint']['count']/$res2['total']*100),1).'%';
            $res2['instore']['percent'] = round(($res2['instore']['count']/$res2['total']*100),1).'%';
        }
        return $res2;
    }

    /**
     *员工营业额统计
     */
    function getstaffMoney($begintime,$endtime){
        // 获取一段时间内的所有complete的订单
        $map = self::$map[0];
        $map['appoint_time'] = [['>=',$begintime],['<',$endtime+24*3600]];
        $map['state'] = ['=','complete'];
        $res = db($this->name)
            ->where($map)
            ->select();
        // $result[0]是总数，$result[1]每个员工信息
        if(empty($res)){
            $result = '';
        }else{
            $result[0] = array('count'=>0,'money'=>0);
            foreach($res as $key=>$val){
                isset($result[1][$val['staff_id']]['count']) or $result[1][$val['staff_id']]['count'] = 0;
                isset($result[1][$val['staff_id']]['money']) or $result[1][$val['staff_id']]['money'] = 0;
                $result[1][$val['staff_id']]['count'] += 1;
                $result[1][$val['staff_id']]['money'] += $val['final_price'];
                $result[0]['count'] +=1;
                $result[0]['money'] += $val['final_price'];
            }
            foreach ($result[1] as $key2=>$val2){
                $result[1][$key2]['percent'] = round(($val2['money']/$result[0]['money']*100),1).'%';//round($num,2)
                $map = self::$map[0];
                $map['id'] = ['=',$key2];
                $staff = db('staff')->where($map)->find();
                if($staff['is_delete'] == 1){
                    $result[1][$key2]['name'] = $staff['name'].'(已禁用)';
                }else{
                    $result[1][$key2]['name'] = $staff['name'];
                }
            }
        }
        return $result;
    }

    /**
     *获取流量
     */
    function getFlux($begintime,$endtime){

        $wxConfig = WxappModel::getWxappCache(self::$wxapp_id);
        $myCommonModel = new WxCommon($wxConfig['app_id'], $wxConfig['app_secret']);
        $res = $myCommonModel->getFlux();



        // 获取app_id,app_secret
        $map = self::$map[0];
        $res = db('wxapp')
            ->where($map)
            ->find();
      //  $wxBaseModel =new WxBase($res['app_id'],$res['app_secret']);
       // p($wxBaseModel);
        // 请求API获取 access_token
       // $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$res['app_id']}&secret={$res['app_secret']}";
       // $result = $wxBaseModel->get($url);
      //  $data = json_decode($result, true);
        //p($data);
        // 请求API获取统计数据
      //  $url = "https://api.weixin.qq.com/datacube/getweanalysisappiddailyvisittrend?access_token={$data['access_token']}";

       /* $postData = array(
            "begin_date"=>"2018-03-13",
            "end_date" =>"2018-12-13"
        );*/
      // $url = $url.'/begin_date/20180313/end_date/20181213';

       // $result = $wxBaseModel->get($url);

       // p($result);
        // $result[0]是总数，$result[1]每个员工信息
        if(empty($res)){
            $result = '';
        }else{
            $result[0] = array('count'=>0,'money'=>0);
            foreach($res as $key=>$val){
                isset($result[1][$val['staff_id']]['count']) or $result[1][$val['staff_id']]['count'] = 0;
                isset($result[1][$val['staff_id']]['money']) or $result[1][$val['staff_id']]['money'] = 0;
                $result[1][$val['staff_id']]['count'] += 1;
                $result[1][$val['staff_id']]['money'] += $val['final_price'];
                $result[0]['count'] +=1;
                $result[0]['money'] += $val['final_price'];
            }
            foreach ($result[1] as $key2=>$val2){
                $result[1][$key2]['percent'] = round(($val2['money']/$result[0]['money']*100),1).'%';//round($num,2)
                $map = self::$map[0];
                $map['id'] = ['=',$key2];
                $staff = db('staff')->where($map)->find();
                if($staff['is_delete'] == 1){
                    $result[1][$key2]['name'] = $staff['name'].'(已禁用)';
                }else{
                    $result[1][$key2]['name'] = $staff['name'];
                }
            }
        }
        return $result;
    }

    /**
     *项目营业额统计
     */
    function getItemMoney($begintime,$endtime){
        // 获取一段时间内的所有complete的订单
        $map = self::$map[0];
        $map['appoint_time'] = [['>=',$begintime],['<',$endtime+24*3600]];
        $map['state'] = ['=','complete'];
        $res = db($this->name)
            ->where($map)
            ->select();
        // 获取所有项目（用项目id作为键名）
        $result = array();
        $map2 = self::$map[0];
        $res2 = db('item')
            ->field('id,project_id,name')
            ->where($map2)
            ->select();
        foreach($res2 as $key=>$val){
            $val['count'] = 0;
            //$val['percent'] = '';
            $result[$val['id']] = $val;
        }
        // 获取以项目作为分类的营业额统计数组
        $total = array(
            'count'=>count($res)
        );
        foreach($res as $key2=>$val2){
            $item_array = explode(';',$val2['item_id']);
            foreach($item_array as $key3=>$val3){
                if(isset($result[$val3])){
                    $result[$val3]['count'] += 1;
                }
            }
        }
        // 获取所有分类
        $map3 = self::$map[0];
        $res3 = db('project')
            ->field('id,name')
            ->where($map3)
            ->select();
        $res4 = array();
        foreach($res3 as $key4=>$val4){
            $val4['son'] = array();
            $res4[$val4['id']] = $val4;
        }
        //p($res4);
       // p($result);
        // 吧类别也加入数组中
        foreach($result as $key=>$val){
           // p($val);
            if($total['count'] == 0){
                $val['percent'] = '';
            }else{
                $val['percent'] = round(($val['count']/$total['count']*100),1).'%';
            }
           // p($val['project_id']);
            //p($res4);
            //p($res4);
            if(isset($res4[$val['project_id']])){
                array_push($res4[$val['project_id']]['son'],$val);
            }

        }
        $result2['content'] = $res4;
        $result2['total'] = $total;
        return $result2;
    }
}
