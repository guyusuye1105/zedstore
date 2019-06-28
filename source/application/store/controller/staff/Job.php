<?php

namespace app\store\controller\staff;

use app\store\controller\Controller;
use think\Config;
use app\store\model\Job as JobModel;

/**
 * 商品分类
 * Class Categor
 * @package app\store\controller\goods
 */
class Job extends Controller
{
    /**
     * 列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $dpagesize = Config::get('paginate.list_rows');
        $thisModel = new JobModel;
        $param = $this->request->param();
        $pagesize = isset($param['pagesize']) ? $param['pagesize'] : $dpagesize;
        $list = $thisModel->getList('',$pagesize);
        return $this->fetch('index', compact('list'));
    }
    /**
     * 新增
     */
    public function add()
    {
        $thisModel = new JobModel;
        if (!$this->request->isAjax()) {
            return $this->fetch('add');
        }
        $content = $this->postData('job');
        if ($thisModel->createData($content)) {
            return $this->renderSuccess('添加成功', url('staff.job/index'));
        }
        $error = $thisModel->getError() ?: '添加失败';
        return $this->renderError($error);
    }

    /**
     * 编辑
     */
    public function edit($id)
    {
        $thisModel = new JobModel;
        if (!$this->request->isAjax()) {
            $list = $thisModel->getList($id);
            return $this->fetch('edit', compact('list'));
        }
        $content = $this->postData('job');
        if ($thisModel->updateDataById($content,$content['id'])) {
            return $this->renderSuccess('更新成功', url('staff.job/index'));
        }
        $error = $thisModel->getError() ?: '更新失败';
        return $this->renderError($error);
    }

    /**
     * 删除
     */
    public function delete($id)
    {
        $thisModel = new JobModel;
        if (!$thisModel->delDataById($id)) {
            return $this->renderError('删除失败');
        }
        return $this->renderSuccess('删除成功');
    }



}
