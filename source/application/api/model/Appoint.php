<?php

namespace app\api\model;

use app\common\model\Appoint as AppointModel;

/**
 * 门店模型
 */
class Appoint extends AppointModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
    ];



}
