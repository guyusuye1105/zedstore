<?php

namespace app\common\model;

use think\Request;
use think\Db;

/**
 * 商品模型
 * Class Goods
 * @package app\common\model
 */
class Appoint extends BaseModel
{
    protected $name = 'appoint';
    protected $timeduan_name = 'time_duan';
    protected $staff_name = 'staff';
    /**
     * 获取预约某天某个服务员时间段
     */
    function getTimeStrip($day,$staff_id){
        // 获取某天的所有时间段
        $timeduan = $this->getTimeDuan($day);
        // 给当天无效时间段做标记
        $validtimeduan = $this->getValidTimeDuan($day,$timeduan);
        // 如果有当前员工判断当前员工的空闲时间,如果没有当前员工判断是否所有员工都忙碌
        if($staff_id == ''){
            $time = $validtimeduan;
        }else{
            $time = $this->getStaffTime($day,$validtimeduan,$staff_id);
        }
        $res = array();
        foreach($time as $key=>$val) {
            if ($val['type'] == 'morning') {
                $res['morning'][] = $val;
            } else if ($val['type'] == 'afternoon') {
                $res['afternoon'][] = $val;
            } else if ($val['type'] == 'evening') {
                $res['evening'][] = $val;
            }
        }
        return $res;
    }

    /**
     * 获取预约某天某个时间段员工
     * @param $day  当天零点时间戳
     * @param $timeduan 时间段id
     * @return array
     */
    function getStaff($day,$timeduan){
        // 获取所有员工
        $tablename = $this->getTable($this->staff_name);
        $tablename2 = $this->getTable($this->name);
        $allStaff1 = Db::query('select * from '.$tablename.' where wxapp_id=? and is_delete =?',[self::$wxapp_id,0]);
        $allStaff = array();
        foreach($allStaff1 as $key=>$val){
            $val['show'] = 'free';
            $allStaff[$val['id']] = $val;
        }
        // 从预约表获得当前被预约的员工
        $mangStaff = Db::query('select * from '.$tablename2.' where wxapp_id=? and appoint_time=? and timeduan_id=? and staff_id != ?',[self::$wxapp_id,$day,$timeduan,0]);
        foreach($mangStaff as $key=>$val){
            $id = $val['staff_id'];
            $allStaff[$id]['show'] = 'appoint';
        }
       // p($allStaff);
        // 根据job_id获得员工段位信息
        $map = [];
        $map['wxapp_id'] = array('=',self::$wxapp_id);
        foreach($allStaff as $key2 => $val2){
            $map['id'] = array('=',$val2['job_id']);
            $job = db('job')->where($map)->find();
            $allStaff[$key2]['job_name'] = $job['name'];
        }
        return $allStaff;
    }

    /**
     * 预约
     */
    function appoint($data){
        if($data['content_type'] == 1){
            $res = $this->createData($data);
        }else{
            $res = false;
        }
        return $res;
    }
    /**
     * 根据时间段id获取时间段所有数据
     */
    function byTimeDuanGetTime($timeduan_id){
        $res = db('time_duan')->where('id','=',$timeduan_id)
            ->find();
        return $res;
    }

    /**
     *根据当前时间判断当前时间段
     */
    /*
    function getTimeDuanId($nowtime,$appoint_time){
        $appoint_time = strtotime(date($appoint_time));
        $nowtime = strtotime(date($nowtime));
        $time = $nowtime - $appoint_time;
        $res = Db::name($this->timeduan_name)
            ->order('sort')
            ->where('wxapp_id',self::$wxapp_id)
            ->where('begin_time>'.$time)
            ->order('begin_time')
            ->select()
            ->toArray();
        p($res);
        return $res;
    }
    */

    /**
     * 获取某天的所有时间段
     * @param $day  选中天数零点时间戳
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    private function getTimeDuan($day){
        $res = Db::name($this->timeduan_name)
            ->order('begin_time')
            ->where('wxapp_id',self::$wxapp_id)
            ->where('begin_use_time<='.$day.' and end_use_time>'.$day)
            ->select()
            ->toArray();
        return $res;
    }

    /**
     * 给当天无效时间段做标记
     * @param $day  选中天数零点时间戳
     * @param $timeduan 某天的所有时间段
     * @return mixed
     */
    private function getValidTimeDuan($day,$timeduan){
        $time = time() - $day;
        foreach($timeduan as $key => $val){
            if($val['begin_time']-3600<$time){//在预约时间1小时以前则变为超时
                $timeduan[$key]['show'] = 'overtime';
            }else{
                $timeduan[$key]['show'] = 'free';
            }
        }
        return $timeduan;
    }

    /**
     * 判断当前员工的空闲时间
     * @param $day
     * @param $validtimeduan
     * @param $staff_id
     * @return mixed
     */
    private function getStaffTime($day,$validtimeduan,$staff_id){
        $tablename = $this->getTable($this->name);
        $res = Db::query('select * from '.$tablename.' where wxapp_id=? and staff_id =? and appoint_time =?',[self::$wxapp_id,$staff_id,$day]);
        foreach($res as $val){
            foreach($validtimeduan as $key2=>$val2){
                // 某个时间段员工被预约的话，把该时间段状态设为预约（如果已经超时则不用管）
                if($val['timeduan_id'] == $val2['id'] && $val2['show']!='overtime'){
                    $validtimeduan[$key2]['show'] = 'appoint';
                }
            }
        }
        return $validtimeduan;
    }

}