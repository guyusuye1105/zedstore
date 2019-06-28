<?php

namespace app\store\controller\store;

use app\store\controller\Controller;
use app\store\model\store\Role as RoleModel;
use app\store\model\store\Access as AccessModel;

/**
 * 商家用户角色控制器
 * Class StoreUser
 * @package app\store\controller
 */
class Role extends Controller
{
    /**
     * 角色列表
     * @return mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $model = new RoleModel;
        $list = $model->getList();
        return $this->fetch('index', compact('list'));
    }

    /**
     * 添加角色
     * @return array|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \Exception
     */
    public function add()
    {
        $model = new RoleModel;
        if (!$this->request->isAjax()) {
            // 权限列表
            $accessList = (new AccessModel)->getJsTree();
            // 角色列表
            $roleList = $model->getList();
            return $this->fetch('add', compact('accessList', 'roleList'));
        }
        // 新增记录
        if ($model->add($this->postData('role'))) {
            return $this->renderSuccess('添加成功', url('store.role/index'));
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }

    /**
     * 更新角色
     * @param $role_id
     * @return array|mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function edit($role_id)
    {
        // 角色详情
        $model = RoleModel::detail($role_id);
        if (!$this->request->isAjax()) {
            // 权限列表
            $accessList = (new AccessModel)->getJsTree($model['role_id']);
            // 角色列表
            $roleList = $model->getList();
            return $this->fetch('edit', compact('model', 'accessList', 'roleList'));
        }
        // 更新记录
        if ($model->edit($this->postData('role'))) {
            return $this->renderSuccess('更新成功', url('store.role/index'));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }

    /**
     * 删除角色
     * @param $role_id
     * @return array
     * @throws \think\exception\DbException
     */
    public function delete($role_id)
    {
        // 角色详情
        $model = RoleModel::detail($role_id);
        if (!$model->remove()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }

}
