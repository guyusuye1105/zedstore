<?php

namespace app\common\model;

/**
 * 小程序prepay_id模型
 * Class WxappPrepayId
 * @package app\common\model
 */
class WxappPrepayId extends BaseModel
{
    protected $name = 'wxapp_prepay_id';

    /**
     * prepay_id 详情
     * @param $order_id
     * @return array|false|static|string|\think\Model
     */
    public static function detail($order_id)
    {
        return (new static)->where(['order_id' => $order_id])
            ->order(['create_time' => 'desc'])->find();
    }

    /**
     * 记录prepay_id使用次数
     * @return int|true
     * @throws \think\Exception
     */
    public function updateUsedTimes()
    {
        return $this->setInc('used_times', 1);
    }

}