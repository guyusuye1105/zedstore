<?php

namespace app\api\model;

use app\common\model\Store as StoreModel;

/**
 * 门店模型
 */
class Store extends StoreModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
    ];



}
