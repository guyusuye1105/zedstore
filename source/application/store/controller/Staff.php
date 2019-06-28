<?php

namespace app\store\controller;

use app\store\model\Staff as StaffModel;
use app\common\model\UploadFile as UploadFileModel;
use think\Request;
use think\Config;

/**
 * 项目管理控制器
 * Class Goods
 * @package app\store\controller
 */
class Staff extends Controller
{
    /**
     * 列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $dpagesize = Config::get('paginate.list_rows');
        $thisModel = new StaffModel;
        $param = $this->request->param();
        $job_id = isset($param['job_id']) ? $param['job_id'] : '';
        $pagesize = isset($param['pagesize']) ? $param['pagesize'] : $dpagesize;
        $list = $thisModel->getList($job_id,'',$pagesize);
        $data['job'] = $thisModel->getJobtList();
        $data['id'] = $job_id;
        return $this->fetch('index', compact('list','data'));
    }

    /**
     * 新增
     */
    public function add()
    {
        $thisModel = new StaffModel;
        if (!$this->request->isAjax()) {
            $data['job'] = $thisModel->getJobtList();
            return $this->fetch('add',compact('data'));
        }
        $fileModel = new UploadFileModel;
        $content = $this->postData('staff');
        if(!isset($content['images'])){
            $error = $thisModel->getError() ?: '请上传项目图片';
            return $this->renderError($error);
        }
        $content['cover'] = $fileModel->getUrlById($content['images']);
        $content['password'] = MD5($content['password']);
        if ($thisModel->createData($content)) {
            return $this->renderSuccess('添加成功', url('staff/index'));
        }
        $error = $thisModel->getError() ?: '添加失败';
        return $this->renderError($error);
    }

    /**
     * 编辑
     */
    public function edit($id)
    {
        $thisModel = new StaffModel;
        if (!$this->request->isAjax()) {
            $list = $thisModel->getList('',$id);
            $data['job'] = $thisModel->getJobtList();
            return $this->fetch('edit', compact('list', 'data'));
        }
        $fileModel = new UploadFileModel;
        $content = $this->postData('staff');

        if(!isset($content['images'])){
            $error = $thisModel->getError() ?: '请上传项目图片';
            return $this->renderError($error);
        }
        $content['cover'] = $fileModel->getUrlById($content['images']);
        //$content['password'] = MD5($content['password']);
        if ($thisModel->updateDataById($content,$content['id'])) {
            return $this->renderSuccess('更新成功', url('staff/index'));
        }
        $error = $thisModel->getError() ?: '更新失败';
        return $this->renderError($error);
    }

    /**
     * 删除
     */
    public function delete()
    {
        $id = $this->request->param()['id'];
        $thisModel = new StaffModel;
        if (!$thisModel->delDataById($id)) {
            return $this->renderError('操作失败');
        }
        return $this->renderSuccess('操作成功');
    }
    /**
     * 休假
     */
    public function vacation($id)
    {
        $thisModel = new StaffModel;
        $res =  $thisModel->getDataById($id);
        if($res['is_vacation'] == '0'){
            $param = array('is_vacation'=>'1');
        }else{
            $param = array('is_vacation'=>'0');
        }
        if (!$thisModel->updateDataById($param,$id)) {
            return $this->renderError('操作失败');
        }
        return $this->renderSuccess('操作成功');
    }
    /**
     * 冻结
     */
    public function ice($id)
    {
        $thisModel = new StaffModel;
        if (!$thisModel->updateDataById(array('is_delete'=>1),$id)) {
            return $this->renderError('操作失败');
        }
        return $this->renderSuccess('操作成功');
    }
    /**
     * 解冻
     */
    public function cancelIce()
    {
        $id = $this->request->param()['id'];
        $thisModel = new StaffModel;
        if (!$thisModel->updateDataById(array('is_delete'=>0),$id)) {
            return $this->renderError('操作失败');
        }
        return $this->renderSuccess('操作成功');
    }
}
