<?php

namespace app\common\model\store;

use think\Session;
use app\common\model\BaseModel;

/**
 * 商家用户模型
 * Class User
 * @package app\common\model
 */
class User extends BaseModel
{
    protected $name = 'store_user';

    /**
     * 关联微信小程序表
     * @return \think\model\relation\BelongsTo
     */
    public function wxapp()
    {
        $module = self::getCalledModule() ?: 'common';
        return $this->belongsTo("app\\{$module}\\model\\Wxapp");
    }

    /**
     * 关联用户角色表表
     * @return \think\model\relation\BelongsToMany
     */
    public function role()
    {
        return $this->belongsToMany('Role', 'StoreUserRole');
    }

    /**
     * 验证用户名是否重复
     * @param $user_name
     * @return bool
     */
    public static function checkExist($user_name)
    {
        return !!static::useGlobalScope(false)
            ->where('user_name', '=', $user_name)
            ->value('store_user_id');
    }

    /**
     * 商家用户详情
     * @param $where
     * @param array $with
     * @return static|null
     * @throws \think\exception\DbException
     */
    public static function detail($where, $with = [])
    {
        !is_array($where) && $where = ['store_user_id' => (int)$where];
        return static::get(array_merge(['is_delete' => 0], $where), $with);
    }

    /**
     * 保存登录状态
     * @param $user
     * @throws \think\Exception
     */
    public function loginState($user)
    {
        /** @var \app\common\model\Wxapp $wxapp */
        $wxapp = $user['wxapp'];
        // 保存登录状态
        Session::set('demo1', [
            'user' => [
                'store_user_id' => $user['store_user_id'],
                'user_name' => $user['user_name'],
            ],
            'wxapp' => $wxapp->toArray(),
            'is_login' => true,
        ]);
    }

}
