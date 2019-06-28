<?php

namespace app\store\controller;

use think\db;
//use app\admin\model\Wxapp as WxappModel;
//use app\admin\model\store\User as StoreUser;

/**
 * 定时任务
 */
class Crontab
{

    // 按小时执行定时任务
    public function workByHour()
    {
        // 定时设置订单逾期
        $res = Db('orders')
            ->select();
        // 遍历
        foreach($res as $key=>$val){
            // 设置已逾期订单
            if($val['appoint_time']<time()&& $val['state']=='notgo'){
                $res[$key]['state'] = 'late';
                $lateOrders['state'] = 'late';
                $lateOrders['id'] = $val['id'];
                db('orders')->update($lateOrders);
            }
        }
    }

    //测试接口：http://10.131.4.200:9001/addons/mt2_school/web/index.php?s=/admin/crontab/workByDay
    //以上为真实的接口，下面没用到，测试而已

    /**
     * 小程序列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $model = new WxappModel;
        return $this->fetch('index', [
            'list' => $list = $model->getList(),
            'names' => $model->getStoreName($list)
        ]);
    }

    /**
     * 定时任务测试1
     *  admin/crontab/test1
     */
    public function test1()
    {
        $a = array(
            'teacher_name'=>'定时任务测试啊啊啊'
        );
        Db('teacher')->insert($a);
    }

    /**
     * 课程是否开班
     *  admin/crontab/subjectOpen
     */
    public function subjectOpen()
    {
        $map['is_delete'] = ['=',0];
        $map['status'] = ['=',0];
        $map['status'] = ['=',0];
        $subject = Db('subject')
            ->where($map)
            ->select();
        p($subject->toArray());
    }



}