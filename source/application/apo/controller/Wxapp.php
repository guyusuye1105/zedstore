<?php

namespace app\apo\controller;

use app\apo\model\Wxapp as WxappModel;
use app\apo\model\WxappHelp;

/**
 * 微信小程序
 * Class Wxapp
 * @package app\api\controller
 */
class Wxapp extends Controller
{

    public function base()
    {
        $wxapp = WxappModel::getWxappCache();
        return $this->renderSuccess(compact('wxapp'));
    }

    /**
     * 帮助中心
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function help()
    {
        $model = new WxappHelp;
        $list = $model->getList();
        return $this->renderSuccess(compact('list'));
    }

}
