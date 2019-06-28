<?php

namespace app\apo\model;

use app\common\model\User as UserModel;

/**
 * 职员模型
 */
class User extends UserModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
        'password',
        // 'sort',
    ];




}
