<?php

namespace app\store\controller\staff;

use app\store\controller\Controller;
use think\Config;
use app\store\model\Ice as IceModel;

/**
 * 商品分类
 * Class Categor
 * @package app\store\controller\goods
 */
class Ice extends Controller
{
    /**
     * 列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $dpagesize = Config::get('paginate.list_rows');
        $thisModel = new IceModel;
        $param = $this->request->param();
        $pagesize = isset($param['pagesize']) ? $param['pagesize'] : $dpagesize;
        $list = $thisModel->getList($pagesize);
        return $this->fetch('index', compact('list'));
    }



}
