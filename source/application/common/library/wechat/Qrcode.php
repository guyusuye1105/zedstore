<?php

namespace app\common\library\wechat;

use app\common\exception\BaseException;

/**
 * 小程序二维码
 * Class Qrcode
 * @package app\common\library\wechat
 */
class Qrcode extends WxBase
{
    /**
     * 获取小程序码
     * @param $scene
     * @param null $page
     * @param int $width
     * @return mixed
     * @throws BaseException
     */
    public function getQrcode($scene, $page = null, $width = 430)
    {
        // 微信接口url
        $access_token = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token={$access_token}";
        // 构建请求
        $data = compact('scene', 'width');
        !is_null($page) && $data['page'] = $page;
        // 返回结果
        $result = $this->post($url, json_encode($data, JSON_UNESCAPED_UNICODE));
        // 记录日志
        log_write([
            'describe' => '获取小程序码',
            'params' => $data,
            'result' => strpos($result, 'errcode') ? $result : 'image'
        ]);
        if (strpos($result, 'errcode')) {
            $data = json_decode($result, true);
            throw new BaseException(['msg' => '小程序码获取失败 ' . $data['errmsg']]);
        }
        return $result;
    }

}