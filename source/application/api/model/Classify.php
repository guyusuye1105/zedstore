<?php

namespace app\api\model;

use app\common\model\Classify as ClassifyModel;

/**
 * 门店模型
 */
class Classify extends ClassifyModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
    ];



}
