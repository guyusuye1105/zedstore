<?php

namespace app\store\controller;

use app\store\model\Store as StoreModel;
use app\common\model\UploadFile as UploadFileModel;
use think\Request;
use think\Config;

/**
 * 项目管理控制器
 * Class Goods
 * @package app\store\controller
 */
class Store extends Controller
{
    /**
     * 列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $dpagesize = Config::get('paginate.list_rows');
        $thisModel = new StoreModel;
        $param = $this->request->param();
        $id = isset($param['id']) ? $param['id'] : '';
        $pagesize = isset($param['pagesize']) ? $param['pagesize'] : $dpagesize;
        $list = $thisModel->getList($id,$pagesize);
        return $this->fetch('index', compact('list'));
    }

    /**
     * 新增
     */
    public function add()
    {
        $thisModel = new StoreModel;
        if (!$this->request->isAjax()) {
            return $this->fetch('add');
        }
        $fileModel = new UploadFileModel;
        $content = $this->postData('store');
        if(!isset($content['images'])){
            $error = $thisModel->getError() ?: '请上传项目图片';
            return $this->renderError($error);
        }
        $content['slide'] = $fileModel->getUrlById($content['images']);
        if ($thisModel->createData($content)) {
            return $this->renderSuccess('添加成功', url('store/index'));
        }
        $error = $thisModel->getError() ?: '添加失败';
        return $this->renderError($error);
    }

    /**
     * 编辑
     */
    public function edit($id)
    {
        $thisModel = new StoreModel;
        if (!$this->request->isAjax()) {
            $list = $thisModel->getList($id);
            return $this->fetch('edit', compact('list'));
        }
        $fileModel = new UploadFileModel;
        $content = $this->postData('store');
        if(!isset($content['images'])){
            $error = $thisModel->getError() ?: '请上传项目图片';
            return $this->renderError($error);
        }
        $content['slide'] = $fileModel->getUrlById($content['images']);
        if ($thisModel->updateDataById($content,$content['id'])) {
            return $this->renderSuccess('更新成功', url('store/index'));
        }
        $error = $thisModel->getError() ?: '更新失败';
        return $this->renderError($error);
    }

    /**
     * 删除
     */
    public function delete($id)
    {
        $thisModel = new StoreModel;
        if (!$thisModel->delDataById($id)) {
            return $this->renderError('删除失败');
        }
        return $this->renderSuccess('删除成功');
    }
}
