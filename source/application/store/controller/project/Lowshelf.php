<?php

namespace app\store\controller\project;

use app\store\controller\Controller;
use think\Config;
use app\store\model\Lowshelf as LowshelfModel;

/**
 * 商品分类
 * Class Categor
 * @package app\store\controller\goods
 */
class Lowshelf extends Controller
{
    /**
     * 列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {

        $dpagesize = Config::get('paginate.list_rows');
        $thisModel = new LowshelfModel;
        $param = $this->request->param();
        $pagesize = isset($param['pagesize']) ? $param['pagesize'] : $dpagesize;
        $list = $thisModel->getList($pagesize);
        return $this->fetch('index', compact('list'));
    }

    /**
     * 上架
     */
    public function upshelf(){
        $param = $this->request->param();
        $param['is_delete'] = 0;
        // 把服务状态改为上架
        $res = db('item')->update($param);
        if ($res) {
            return $this->renderSuccess('操作成功');
        }else{
            return $this->renderError('操作失败');
        }
    }

    /**
     * 删除
     */
    public function delete(){
        $param = $this->request->param();
        $thisModel = new LowshelfModel;
        if (!$thisModel->delDataById($param['id'])) {
            return $this->renderError('删除失败');
        }
        return $this->renderSuccess('删除成功');


       /* $param = $this->request->param();
        // 把服务状态改为上架
        $res = db('item')->delete($param['id']);
        if ($res) {
            return $this->renderSuccess('操作成功');
        }else{
            return $this->renderError('操作失败');
        }*/
    }



}
