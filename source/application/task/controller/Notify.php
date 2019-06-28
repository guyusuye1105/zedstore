<?php

namespace app\task\controller;

use app\task\model\Order as OrderModel;
use app\common\library\wechat\WxPay;

/**
 * 支付成功异步通知接口
 * Class Notify
 * @package app\api\controller
 */
class Notify
{
    /**
     * 支付成功异步通知
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function order()
    {
       // $WxPay = new WxPay([]);
        //$WxPay->notify(new OrderModel);
        // 微信支付组件：验证异步通知
        $WxPay = new WxPay(['app_id' => null, 'app_secret' => null]);
        $WxPay->notify();
    }

}
