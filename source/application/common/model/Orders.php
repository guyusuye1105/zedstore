<?php

namespace app\common\model;

use think\Request;

/**
 * 商品模型
 * Class Goods
 * @package app\common\model
 */
class Orders extends BaseModel
{
    protected $name = 'orders';
    //protected $append = ['goods_sales'];
    function getPrice($item_id){
        $item_id = explode(';',$item_id);
        $price = 0;
        $map = [];
        $map['wxapp_id']  = array('=',self::$wxapp_id);
        foreach($item_id as $key=>$val){
            $map['id'] = array('=',$val);
            $res = db('item')->where($map)->find();
            $price += $res['price'];
        }
        return $price;
    }

    /**
     * 生成订单号
     * @return string
     */
    function orderNo()
    {
        return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

}
