<?php

namespace app\api\controller\user;

use app\api\controller\Controller;
use app\api\model\Order as OrderModel;

/**
 * 个人中心主页
 * Class Index
 * @package app\api\controller\user
 */
class Index extends Controller
{
    /**
     * 获取当前用户信息
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    /**
     * @api {post} api/user.index/detail 获取当前用户信息
     * @apiName userindexdetailn
     * @apiGroup 基本
     * @apiPermission none
     * @apiDescription 获取当前用户信息
     ** @apiUse  userindexdetail
     */
    public function detail()
    {
        // 当前用户信息
        $userInfo = $this->getUser();
        // lichenjie 如果头像为空，需要授权登录
        if($userInfo['avatarUrl'] == ''){
            return $this->renderJson('-2', '需要授权登录');
        }
        // 订单总数
        $model = new OrderModel;
        $orderCount = [
            'payment' => $model->getCount($userInfo['user_id'], 'payment'),
            'received' => $model->getCount($userInfo['user_id'], 'received'),
        ];
        return $this->renderSuccess(compact('userInfo', 'orderCount'));
    }

}
