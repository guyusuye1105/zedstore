<?php

namespace app\api\controller;

use app\api\model\User as UserModel;

/**
 * 用户管理
 * Class User
 * @package app\api
 */
class User extends Controller
{
    /**
     * @api {post} api/user/login 用户自动登录（需要权限）
     * @apiName userlogin
     * @apiGroup 基本
     * @apiDescription 会员自动登录（照搬原框架，能访问就好）
     * @apiParam    {int}   aaa   按照原框架传入参数就好
     * @apiSuccess  user_id 会员id
     * @apiSuccess  token
     * @apiSuccess  is_member   是否是注册会员（1是注册会员0是未注册会员）
     */
    public function login()
    {
        $model = new UserModel;
        $user_id = $model->login($this->request->post());
        // 判断是否是注册会员
        $is_member = $model->isMember($user_id);
        $token = $model->getToken();
        return $this->renderSuccess(compact('user_id', 'token','is_member'));
    }
    /**
     * @api {post} api/user/submit 用户登录（不需要权限）
     * @apiName usersubmit
     * @apiGroup 基本
     * @apiDescription 会员自动登录（照搬原框架，能访问就好）
     * @apiParam    {int}   wxapp_id
     * @apiParam    {string}   code
     * @apiSuccess  user_id 会员id
     * @apiSuccess  token
     * @apiSuccess  is_member   是否是注册会员（1是注册会员0是未注册会员）
     */
    public function submit()
    {
        $model = new UserModel;
        $user_id = $model->submit($this->request->post());
        // 判断是否是注册会员
        $is_member = $model->isMember($user_id);
        $token = $model->getToken();
        return $this->renderSuccess(compact('user_id', 'token','is_member'));
    }


    /**
     * @api {post} api/user/update 更新用户信息
     * @apiName userupdaten
     * @apiGroup 基本
     * @apiDescription 更新用户信息
     * @apiParam    {string}    mobile   手机号码（非必填）
     * @apiParam    {int}    user_id   会员id（必填）
     * @apiParam    {int}    gender   性别（1男2女0未知）（非必填）
     * @apiParam    {string}    birthday   生日（格式2018-11-11）（非必填）
     * @apiParam    {string}    token   （必填）
     ** @apiUse  userupdate
     */
    public function update()
    {
        $user = $this->getUser();
        $model = new UserModel;
        $post = $this->request->post();
        $id = $post['user_id'];
        if(isset($post['mobile'])){
            $data['mobile'] = $post['mobile'];
        }
        if(isset($post['gender'])){
            $data['gender'] = $post['gender'];
        }
        if(isset($post['birthday'])){
            $change_birthday = true;
            $data['birthday'] = $post['birthday'];
            $data['change_birthday'] = 1;
        }
        // 如果修改过了生日，那就不能被修改
        if(isset($change_birthday)){
            $tmp = $model->getDataById($id);
            if($tmp['change_birthday'] == 1){
                return $this->renderError('生日只能修改一次');
            }
        }
        if(empty($data)){die('没有做任何修改');}
        if($model->updateDataById($data,$id)){
            return $this->renderSuccess('修改成功！');
        }else{
            return $this->renderError('修改失败！');
        }
    }
    /**
     * @api {post} api/user/bindmobile 绑定手机号
     * @apiName userbindmobilen
     * @apiGroup 基本
     * @apiDescription 更新用户信息
     * @apiParam    {string}    mobile   手机号码（必填）
     * @apiParam    {int}    user_id   会员id（必填）
     * @apiParam    {string}    token   （必填）
     ** @apiUse  userbindmobile
     */
    public function bindMobile()
    {
        $user = $this->getUser();
        $model = new UserModel;
        $post = $this->request->post();
        $id = $post['user_id'];
        $data['mobile'] = isset($post['mobile']) ? $post['mobile'] : die('缺少参数mobile');
        if($model->updateDataById($data,$id)){
            return $this->renderSuccess('绑定成功');
        }else{
            return $this->renderError('绑定失败');
        }
    }

    /**
     * @api {get} api/user/getphone 微信绑定手机号
     * @apiName usergetphone
     * @apiGroup 基本
     * @apiPermission none
     *
     * @apiDescription 小程序上通过获取手机号,会同步更新会员资料里面的手机号
     *
     * @apiParam {Int} uid uid.
     * @apiParam {String} iv encryptedData.
     * @apiParam {Int} encryptedData encryptedData.
     * @apiParam {Int} wxapp_id 微信APPID
     * @apiSuccess data.phoneNumber Int    返回用户的手机号   code 200为正确 其他错误
     * @apiSuccessExample  Response (example):
     *{"code":200,"data":{"phoneNumber":"17826821486","purePhoneNumber":"17826821486","countryCode":"86"},"error":""}
     */
    public function getphone(){
        $post = $this->request->post();
        $model = new UserModel;
        $data = $model->getphone($post);
        if($data){
            return $this->renderSuccess(compact('data'));
        }else{
            return $this->renderError($model->getError());
        }
    }
}
