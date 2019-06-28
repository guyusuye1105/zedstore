<?php

namespace app\store\model;

use app\common\model\Staff as StaffModel;
use think\Db;
use think\Request;

/**
 * 职员模型
 * Class Goods
 * @package app\store\model
 */
class Staff extends StaffModel
{



    public function getJobtList(){
        $res = Db::name('job')
            ->select();
        return $res;
    }
}
