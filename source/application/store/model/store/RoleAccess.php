<?php

namespace app\store\model\store;

use app\common\model\store\RoleAccess as RoleAccessModel;

/**
 * 商家用户角色权限关系模型
 * Class RoleAccess
 * @package app\store\model\store
 */
class RoleAccess extends RoleAccessModel
{
    /**
     * 新增关系记录
     * @param $role_id
     * @param array $access
     * @return array|false
     * @throws \Exception
     */
    public function add($role_id, $access)
    {
        $data = [];
        foreach ($access as $access_id) {
            $data[] = [
                'role_id' => $role_id,
                'access_id' => $access_id,
                'wxapp_id' => self::$wxapp_id,
            ];
        }
        return $this->saveAll($data);
    }

    /**
     * 更新关系记录
     * @param $role_id
     * @param array $newAccess 新的权限集
     * @return array|false
     * @throws \Exception
     */
    public function edit($role_id, $newAccess)
    {
        // 已分配的权限集
        $assignAccessIds = self::getAccessIds($role_id);

        /**
         * 找出删除的权限
         * 假如已有的权限集合是A，界面传递过得权限集合是B
         * 权限集合A当中的某个权限不在权限集合B当中，就应该删除
         * 使用 array_diff() 计算补集
         */
        if ($deleteAccessIds = array_diff($assignAccessIds, $newAccess)) {
            self::deleteAll(['role_id' => $role_id, 'access_id' => ['in', $deleteAccessIds]]);
        }

        /**
         * 找出添加的权限
         * 假如已有的权限集合是A，界面传递过得权限集合是B
         * 权限集合B当中的某个权限不在权限集合A当中，就应该添加
         * 使用 array_diff() 计算补集
         */
        $newAccessIds = array_diff($newAccess, $assignAccessIds);
        $data = [];
        foreach ($newAccessIds as $access_id) {
            $data[] = [
                'role_id' => $role_id,
                'access_id' => $access_id,
                'wxapp_id' => self::$wxapp_id,
            ];
        }
        return $this->saveAll($data);
    }

    /**
     * 获取指定角色的所有权限id
     * @param int|array $role_id 角色id (支持数组)
     * @return array
     */
    public static function getAccessIds($role_id)
    {
        $roleIds = is_array($role_id) ? $role_id : [(int)$role_id];
        return (new self)->where('role_id', 'in', $roleIds)->column('access_id');
    }

    /**
     * 删除记录
     * @param $where
     * @return int
     */
    public static function deleteAll($where)
    {
        return self::destroy($where);
    }

}