<?php

namespace app\store\controller;

use app\store\model\Category;
use app\store\model\Delivery;
use app\store\model\Orders as OrdersModel;
use think\config;

/**
 * 商品管理控制器
 * Class Goods
 * @package app\store\controller
 */
class Orders extends Controller
{
    /**
     * 订单列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index($datatype)
    {
        $dpagesize = Config::get('paginate.list_rows');
        $model = new OrdersModel;
        $param = $this->request->param();
        $pagesize = isset($param['pagesize']) ? $param['pagesize'] : $dpagesize;
        $keywords = isset($param['keywords']) ? $param['keywords'] : '';
        if(!empty($param['begintime'])){
            $begintime = strtotime($param['begintime']);
            $data['begintime'] = date('Y-m-d',$begintime);
        }else{
            $begintime = '';
            $data['begintime'] = '';
        }
        if(!empty($param['endtime'])){
            $endtime = strtotime($param['endtime']);
            $data['endtime'] = date('Y-m-d',$endtime);
        }else{
            $endtime = '';
            $data['endtime'] = '';
        }
        $list = $model->getList($keywords,$pagesize,$datatype,$begintime,$endtime);
        //$fuckitem = $model->getFuckItem();
        $data['keywords'] = $keywords;
        $data['datatype'] = $datatype;
        //$data['fuckitem'] = $fuckitem;
        $res['list'] = $list;
        $res['data'] = $data;
        return $res;
    }
    // 进行中
    public function ing()
    {
        $res = $this->index('ing');
        $list = $res['list'];
        $data = $res['data'];
        return $this->fetch('index', compact('list','data'));
    }
    // 已完成
    public function complete()
    {
        $res = $this->index('complete');
        $list = $res['list'];
        $data = $res['data'];
        return $this->fetch('index', compact('list','data'));
    }
    // 已撤单
    public function cancel()
    {
        $res = $this->index('cancel');
        $list = $res['list'];
        $data = $res['data'];
        return $this->fetch('index', compact('list','data'));
    }
    // 已逾期
    public function late()
    {
        $res = $this->index('late');
        $list = $res['list'];
        $data = $res['data'];
        return $this->fetch('index', compact('list','data'));
    }
    // 全部订单
    public function all()
    {
        $res = $this->index('all');
        $list = $res['list'];
        $data = $res['data'];
        return $this->fetch('index', compact('list','data'));
    }

    /**
     * 订单导出
     * @param string $dataType
     * @throws \think\exception\DbException
     */
    function export()
    {
        $model = new OrdersModel;
        $param = $this->request->param();
        return $model->exportList($param);
    }

}
