<?php

namespace app\api\model;

use app\common\model\Test as TestModel;

/**
 * 门店模型
 */
class Test extends ShopBagModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
    ];



}
