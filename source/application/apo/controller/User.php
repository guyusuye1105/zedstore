<?php

namespace app\apo\controller;
use app\apo\model\User as UserModel;


/**
 * 门店
 */
class User extends Controller
{
    /**
     * @api {post} apo/user/searchUser 获取用户
     * @apiName usersearchUsern
     * @apiGroup 服务
     * @apiParam    keywords 搜索关键字(空)（不填搜索全部）
     * @apiParam    pagesize 每页个数(非空)
     * @apiParam    page 页码(空)（不填默认第一页）
     * @apiDescription 获取用户
     ** @apiUse  usersearchUser
     */
    public function searchUser()
    {
        $post = $this->request->post();
        $model = new UserModel;
        $keywords = isset($post['keywords']) ? $post['keywords'] : '';
        if(isset($post['pagesize'])){$pagesize = $post['pagesize'];}else{die('缺少参数pagesize');}
        $list = $model->getLists('',$keywords,$pagesize);
        return $this->renderSuccess(['list'=>$list]);

    }




}