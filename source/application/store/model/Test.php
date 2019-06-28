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
class Test extends BaseModel
{
    protected $name = 'orders';

    function getList(){
        $map = [];
        $map['wxapp_id'] = ['=',10];
        $a = $this->where($map)
            ->max('price');
        dump($a);die;
    }
}
