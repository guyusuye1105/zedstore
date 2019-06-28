<?php

namespace app\store\controller;

use app\store\model\Project as ProjectModel;
use app\common\model\UploadFile as UploadFileModel;
use think\Request;
use think\Config;

/**
 * 项目管理控制器
 * Class Goods
 * @package app\store\controller
 */
class Project extends Controller
{
    /**
     * 列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $dpagesize = Config::get('paginate.list_rows');
        $thisModel = new ProjectModel;
        $param = $this->request->param();
        $project_id = isset($param['project_id']) ? $param['project_id'] : '';
        $pagesize = isset($param['pagesize']) ? $param['pagesize'] : $dpagesize;
        $list = $thisModel->getList($project_id,$pagesize);
        $data['project'] = $thisModel->getProjectList();
        $data['id'] = $project_id;
        return $this->fetch('index', compact('list','data'));
    }

    /**
     * 新增
     */
    public function add()
    {
        $thisModel = new ProjectModel;
        if (!$this->request->isAjax()) {
            $data['project'] = $thisModel->getProjectList();
            return $this->fetch('add', compact('data'));
        }
        $fileModel = new UploadFileModel;
        $content = $this->postData('project');
        $content['attr'] = substr($content['attr'],2);
        if(!isset($content['images'])){
            $error = $thisModel->getError() ?: '请上传项目图片';
            return $this->renderError($error);
        }
        $content['slide'] = $fileModel->getUrlById($content['images']);
        if ($thisModel->createData($content)) {
            return $this->renderSuccess('添加成功', url('project/index'));
        }
        $error = $thisModel->getError() ?: '添加失败';
        return $this->renderError($error);
    }

    /**
     * 编辑
     */
    public function edit($id)
    {
        $thisModel = new ProjectModel;
        if (!$this->request->isAjax()) {
            $list = $thisModel->getOneList($id);

            $data['project'] = $thisModel->getProjectList();
            $data['id'] = $id;
            return $this->fetch('edit', compact('list', 'data'));
        }
        $fileModel = new UploadFileModel;
        $content = $this->postData('project');
        $content['attr'] = substr($content['attr'],2);
        if(!isset($content['images'])){
            $error = $thisModel->getError() ?: '请上传项目图片';
            return $this->renderError($error);
        }
        $content['slide'] = $fileModel->getUrlById($content['images']);
        if ($thisModel->updateDataById($content,$content['id'])) {
            return $this->renderSuccess('更新成功', url('project/index'));
        }
        $error = $thisModel->getError() ?: '更新失败';
        return $this->renderError($error);
    }

    /**
     * 删除
     */
    public function delete($id)
    {
        $thisModel = new ProjectModel;
        if (!$thisModel->delDataById($id)) {
            return $this->renderError('删除失败');
        }
        return $this->renderSuccess('删除成功');
    }

    /**
     * 下架
     */
    public function lowshelf(){
        $thisModel = new ProjectModel;
        $param = $this->request->param();
        $param['is_delete'] = 1;
        // 把服务状态改为下架
        $res = db('item')->update($param);
        if ($res) {
            return $this->renderSuccess('操作成功');
        }else{
            return $this->renderError('操作失败');
        }
    }
}
