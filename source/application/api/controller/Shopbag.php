<?php

namespace app\api\controller;

use app\api\model\ShopBag as ShopBagModel;

/**
 * 购物袋
 */
class ShopBag extends Controller
{
    /**
     * 构造方法
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->user = $this->getUser();   // 用户信息
    }
    /**
     * @api {post} api/shopbag/getShopBag 获取购物袋
     * @apiName shopbaggetShopBagn
     * @apiGroup 购物袋
     * @apiDescription 获取购物袋
     * @apiParam    {int}   user_id   会员id
     ** @apiUse  shopbaggetShopBag
     */
    public function getShopBag(){
        $post = $this->request->post();
        $model = new ShopBagModel;
        if(!empty($post['user_id'])){
            $user_id = $post['user_id'];
        }else{
            die('缺少参数user_id');
        }
        $list = $model->getShopBag($user_id);
        return $this->renderSuccess(compact('list'));
    }
    /**
     * @api {post} api/shopbag/saveShopBag 保存购物袋
     * @apiName shopbagsaveShopBagn
     * @apiGroup 购物袋
     * @apiDescription 保存购物袋
     * @apiParam    {int}   user_id   会员id
     * @apiParam    {String}   item_content   购物袋信息（例如2；3；4）
     ** @apiUse  shopbagsaveShopBag
     */
    function saveShopBag(){
        $post = $this->request->post();
        $model = new ShopBagModel;
        if(!empty($post['user_id'])){
            $data['user_id'] = $post['user_id'];
        }else{
            die('user_id');
        }
        if(!empty($post['item_content'])){
            $data['item_content'] = $post['item_content'];
        }else{
            $data['item_content'] = '';
        }
        //$res = $model->createData($data);
        if($model->saveShopBag($data)){
            return $this->renderSuccess('保存成功');
        }else{
            return $this->renderError('保存失败');
        }


    }


}