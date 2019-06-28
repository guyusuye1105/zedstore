<?php

namespace app\common\model\store;

use app\common\model\BaseModel;

/**
 * 商家用户角色模型
 * Class Role
 * @package app\common\model\admin
 */
class Role extends BaseModel
{
    protected $name = 'store_role';

    /**
     * 角色信息
     * @param $where
     * @return null|static
     * @throws \think\exception\DbException
     */
    public static function detail($where)
    {
        return self::get($where);
    }

}