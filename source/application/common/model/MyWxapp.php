<?php

namespace app\common\model;

use think\Request;
use app\common\library\wechat\WxBase;

/**
 * 商品模型
 * Class Goods
 * @package app\common\model
 */
class MyWxapp extends WxBase
{
    function getFlux(){
        $access_token = $this->getAccessToken();
        p($access_token);
    }
}