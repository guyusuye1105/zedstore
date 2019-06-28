<?php

namespace app\store\controller\project;

use app\store\controller\Controller;
use think\Config;
use app\store\model\Attr as AttrModel;

/**
 * 商品分类
 * Class Category
 * @package app\store\controller\goods
 */
class Attr extends Controller
{
    /**
     * 列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {

        $dpagesize = Config::get('paginate.list_rows');
        $thisModel = new AttrModel;
        $param = $this->request->param();
        $pagesize = isset($param['pagesize']) ? $param['pagesize'] : $dpagesize;
        $list = $thisModel->getList('',$pagesize);
        return $this->fetch('index', compact('list','data'));
    }

    /**
     * 新增
     */
    public function add()
    {
        $thisModel = new AttrModel;
        if (!$this->request->isAjax()) {
            return $this->fetch('add');
        }
        $content = $this->postData('classify');
        $content['label'] = substr($content['label'],1);
        if ($thisModel->createData($content)) {
            return $this->renderSuccess('添加成功', url('project.classify/index'));
        }
        $error = $thisModel->getError() ?: '添加失败';
        return $this->renderError($error);
    }

    /**
     * 编辑
     */
    public function edit($id)
    {
        $thisModel = new ClassifyModel;
        if (!$this->request->isAjax()) {
            $list = $thisModel->getList($id);
            return $this->fetch('edit', compact('list'));
        }
        $content = $this->postData('classify');
        if ($thisModel->updateDataById($content,$content['id'])) {
            return $this->renderSuccess('更新成功', url('project.classify/index'));
        }
        $error = $thisModel->getError() ?: '更新失败';
        return $this->renderError($error);
    }

    /**
     * 删除
     */
    public function delete($id)
    {
        $thisModel = new ClassifyModel;
        if (!$thisModel->delDataById($id)) {
            return $this->renderError('删除失败');
        }
        return $this->renderSuccess('删除成功');
    }


}
