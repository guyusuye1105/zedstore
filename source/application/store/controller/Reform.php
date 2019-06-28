<?php

namespace app\store\controller;

use app\store\model\Reform as ReformModel;
use think\Request;
use think\Config;
use think\Cache;

/**
 * 统计报表
 * Class Goods
 * @package app\store\controller
 */
class Reform extends Controller
{
    /**
     * 列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
       //($self::$wxapp_id);
       // p(config());
       //

        $thisModel = new ReformModel;
        $param = $this->request->param();
        $begintime = isset($param['begintime']) ? strtotime($param['begintime']) : strtotime('2000-1-1');
        $endtime = isset($param['endtime']) ? strtotime($param['endtime']) : strtotime('2038-1-1');
        // 订单统计
        $order = $thisModel->getOrderStatistics($begintime,$endtime);
        // 员工营业额统计
        $staffMoney = $thisModel->getstaffMoney($begintime,$endtime);
        // 流量统计
       // $flux =  $thisModel->getFlux($begintime,$endtime);
        // 项目营业额统计
        $item =  $thisModel->getItemMoney($begintime,$endtime);
        $list['order'] = $order;
        $list['staffMoney'] = $staffMoney;
        $list['item'] = $item;
        $data['begintime'] = isset($param['begintime']) ? $param['begintime'] : '';
        $data['endtime'] = isset($param['endtime']) ? $param['endtime'] : '';
        return $this->fetch('index', compact('list','data'));
    }

}
