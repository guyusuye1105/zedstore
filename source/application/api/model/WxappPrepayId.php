<?php

namespace app\api\model;

use app\common\model\WxappPrepayId as WxappPrepayIdModel;

/**
 * 小程序prepay_id模型
 * Class WxappPrepayId
 * @package app\api\model
 */
class WxappPrepayId extends WxappPrepayIdModel
{
    /**
     * 新增记录
     * @param $prepay_id
     * @param $order_id
     * @param $user_id
     * @return false|int
     */
    public function add($prepay_id, $order_id, $user_id)
    {
        return $this->save([
            'prepay_id' => $prepay_id,
            'order_id' => $order_id,
            'user_id' => $user_id,
            'can_use_times' => 0,
            'used_times' => 0,
            'wxapp_id' => self::$wxapp_id,
            'expiry_time' => time() + (7 * 86400)
        ]);
    }

}