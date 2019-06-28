<?php

namespace app\common\model;

use think\Request;
use think\Db;

/**
 * 商品模型
 * Class Goods
 * @package app\common\model
 */
class ShopBag extends BaseModel
{
    protected $name = 'shop_bag';
    protected $item_name = 'item';
    /**
     * 获取购物袋
     */
    function getShopBag($user_id)
    {
        $key = $user_id;
        $content = redis()->get($key);
        $res = array();
        if ($content != '') {
            $tmp = explode(';', $content);
            foreach ($tmp as $key => $val) {
                $tmp[$key] = db($this->item_name)
                    ->where('wxapp_id', self::$wxapp_id)
                    ->where('id', $val)
                    ->find();
            }
            return $tmp;
        }else{
            $res = array();
            return $res;
        }


            /* $res = db($this->name)
                 ->where('wxapp_id',self::$wxapp_id)
                 ->where('user_id',$user_id)
                 ->find();
             if($res['item_content']!=''){
                 $tmp = explode(';',$res['item_content']);
                 foreach ($tmp as $key => $val){
                     $tmp[$key] = db($this->item_name)
                         ->where('wxapp_id',self::$wxapp_id)
                         ->where('id',$val)
                         ->find();
                 }
                 $res['item_content'] = $tmp;
             }
             return $res;*/

    }
    /**
     * 保存购物袋
     */
    function saveShopBag($data){
        $key = $data['user_id'];
        $res = redis()->set($key,$data['item_content'],86400*7);//七天过期
        return $res;

      /*  $shopbag = db($this->name)->where('wxapp_id',self::$wxapp_id)->where('user_id',$data['user_id'])->find();
        // 更新购物袋
        if($shopbag){
            $data['id'] = $shopbag['id'];
            db($this->name)->update($data);
            //新增购物袋
        }else{
            $data['wxapp_id'] = self::$wxapp_id;
            db($this->name)->insert($data);
        }*/
    }


}