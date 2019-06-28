<?php

namespace app\api\model;

use app\common\model\ShopBag as ShopBagModel;

/**
 * 门店模型
 */
class ShopBag extends ShopBagModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
    ];



}
