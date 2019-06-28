<?php

namespace app\api\controller;

use app\api\model\Store as StoreModel;

/**
 * 门店
 */
class Store extends Controller
{
    /**
     * @api {post} api/store/lists 获取门店信息
     * @apiName storelistsn
     * @apiGroup 首页
     * @apiPermission none
     * @apiDescription 获取门店信息
     ** @apiUse  storelists
     */
    public function lists()
    {
        $post = $this->request->post();
        $model = new StoreModel;
        if(empty($post['id'])){
            $post['id'] = '';
        }
        $list = $model->getList($post['id']);
        return $this->renderSuccess(compact('list'));
    }


}
