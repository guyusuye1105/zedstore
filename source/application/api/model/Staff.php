<?php

namespace app\api\model;

use app\common\model\Staff as StaffModel;

/**
 * 门店模型
 */
class Staff extends StaffModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
        'password',
        'sort',

    ];



}
