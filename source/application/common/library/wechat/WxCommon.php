<?php

namespace app\common\library\wechat;

use app\common\exception\BaseException;

/**
 * 微信获取信息通用接口
 * Class WxCommon
 * @package app\common\library\wechat
 * @author lichenjie
 */
class WxCommon extends WxBase
{
    /**
     * 获取流量
     * @param $begintime    格式20180101
     * @param $endtime  格式20180101
     * @param $type 只有dai天，week周，month月三个值
     * @return bool
     * $type == 'dai' 日趋势：限定查询1天数据，允许设置的最大值为昨日
     * $type == 'week' 周趋势：注意：请求json和返回json与天的一致，这里限定查询一个自然周的数据，时间必须按照自然周的方式输入： 如：20170306(周一), 20170312(周日)
     * $type == 'month' 月趋势：请求json和返回json与天的一致，这里限定查询一个自然月的数据，时间必须按照自然月的方式输入： 如：20170201(月初), 20170228(月末)
     * 返回内容示例
     * {
        "list": [
        {
        "ref_date": "201702",
        "session_cnt": 126513,
        "visit_pv": 426113,
        "visit_uv": 48659,
        "visit_uv_new": 6726,
        "stay_time_session": 56.4112,
        "visit_depth": 2.0189
     * page_path	页面路径
        page_visit_pv	访问次数
        page_visit_uv	访问人数
        page_staytime_pv	次均停留时长
        entrypage_pv	进入页次数
        exitpage_pv	退出页次数
        page_share_pv	转发次数
        page_share_uv	转发人数
        }
        ]
        }
     */
    public function getFlux($begintime,$endtime,$type)
    {
        // 微信接口url
        $access_token = $this->getAccessToken();
        $url = 'https://api.weixin.qq.com/datacube/getweanalysisappid' . $type . 'lyvisittrend?access_token=' . $access_token;
        // 构建请求
        $data = [
            "begin_date"=>$begintime,
            "end_date"=>$endtime
        ];
        $result = $this->post($url, json_encode($data, JSON_UNESCAPED_UNICODE));
        // 记录日志
        log_write([
            'params' => $data,
            'result' => $result
        ]);
        // 返回结果
        $response = json_decode($result, true);
        if (!isset($response['errcode'])) {
            $this->error = 'not found errcode';
            return false;
        }
        if ($response['errcode'] != 0) {
            $this->error = $response['errmsg'];
            return false;
        }
        return $result;
    }

}