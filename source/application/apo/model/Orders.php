<?php

namespace app\apo\model;

use app\common\model\Orders as OrdersModel;
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
        'wxapp_id',
    ];

    /**
     * 服务员获取订单
     * @param $begintime
     * @param $endtime
     * @param $page
     * @param $pagesize
     * @param $state
     */
    function getOrders($begintime,$endtime,$page,$pagesize,$state,$staff_id,$order='desc'){
        $map['wxapp_id']  = array('=',self::$wxapp_id);
        if($begintime!=''&&$endtime!=''){
            $map['appoint_time']  = array(array('>=',$begintime),array('<',$endtime+3600*24));
        }elseif($begintime==''&&$endtime!=''){
            $map['appoint_time']  = array('<',$endtime+3600*24);
        }elseif($begintime!=''&&$endtime==''){
            $map['appoint_time']  = array('>=',$begintime);
        }
        $map['staff_id']  = array('=',$staff_id);
        if($state == 'ing'){
            $map['state']  = array('in',array('notgo', 'inserver', 'waitmoney'));//状态为进行中
        }elseif($state == ''){

        }else{
            $map['state']  = array('=',$state);
        }
        $total =  count(db($this->name)->where($map)->select());
        $res = db($this->name)
            ->where($map)
            ->order('appoint_time '.$order)
            ->limit(($page-1)*$pagesize,$pagesize)
            ->select()
            ->toArray();

        // 获取用户信息
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
            $res2 = db('user')->where('user_id','=',$val['user_id'])->find();
            $res[$key]['user_nickname'] = $res2['nickName'];
            $res[$key]['user_mobile'] = $res2['mobile'];
            $res[$key]['user_card'] = $res2['card'];
            $res[$key]['user_cover'] = $res2['avatarUrl'];

            $res[$key]['item'] = json_decode($res[$key]['item'],true);
            /*$item = explode(';',$val['item_id']);
            // 获取商品信息
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

}
