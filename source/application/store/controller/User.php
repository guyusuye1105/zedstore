<?php

namespace app\store\controller;

use app\store\model\User as UserModel;
use think\config;

/**
 * 商品管理控制器
 * Class Goods
 * @package app\store\controller
 */
class User extends Controller
{
    /**
     * 成员列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $dpagesize = Config::get('paginate.list_rows');
        $model = new UserModel;
        $param = $this->request->param();
        $pagesize = isset($param['pagesize']) ? $param['pagesize'] : $dpagesize;
        $keywords = isset($param['keywords']) ? $param['keywords'] : '';
        $list = $model->getLists('',$keywords,$pagesize,2);
        $data['keywords'] = $keywords;
        return $this->fetch('index', compact('list','data'));
    }

}
