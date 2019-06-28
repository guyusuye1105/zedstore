<?php

namespace app\apo\controller;
use app\apo\model\Staff as StaffModel;
use app\store\model\UploadFile;

/**
 * 门店
 */
class Staff extends Controller
{
    /**
     * @api {post} apo/staff/login 服务员登陆
     * @apiName staffloginn
     * @apiGroup 基础
     * @apiParam    account 账户
     * @apiParam    password 密码
     * @apiDescription 服务员登陆
     ** @apiUse  stafflogin
     */
    public function login()
    {
        $post = $this->request->post();
        $model = new StaffModel;
        $post['password'] = MD5($post['password']);
        $res = $model->login($post['account'],$post['password']);
        if($res['code'] == 1){
            return $this->renderSuccess($res['msg']);
        }else{
            return $this->renderError($res['msg']);
        }
    }

    /**
     * @api {post} apo/staff/detail 我的信息
     * @apiName staffdetailn
     * @apiGroup 我的
     * @apiParam   {int} id 服务员id
     * @apiDescription 我的信息
     ** @apiUse  staffdetail
     */
    public function detail()
    {
        $post = $this->request->post();
        $model = new StaffModel;
        $res = $model->detail($post['id']);
        if($res['code'] == 1){
            return $this->renderSuccess($res['msg']);
        }else{
            return $this->renderError($res['msg']);
        }
    }

    /**
     * @api {post} apo/staff/update 更新员工信息
     * @apiName staffupdaten
     * @apiGroup 我的
     * @apiDescription 更新用户信息
     * @apiParam    {string}    mobile   手机号码（空）
     * @apiParam    {int}    id   员工id(非空)
     * @apiParam    {string}    nick_name   花名(空)
     * @apiParam    {string}    name   员工姓名（空）
     ** @apiUse  staffupdate
     */
    public function update()
    {
        $model = new StaffModel;
        $post = $this->request->post();
        $id = $post['id'];
        if(isset($post['mobile'])){
            $data['mobile'] = $post['mobile'];
        }
        if(isset($post['nick_name'])){
            $data['nick_name'] = $post['nick_name'];
        }
        if(isset($post['name'])){
            $data['name'] = $post['name'];
        }
        if($model->updateDataById($data,$id)){
            return $this->renderSuccess('修改成功！');
        }else{
            return $this->renderError('修改失败！');
        }
    }


    /**
     * @api {post} apo/staff/editpwd 员工修改密码
     * @apiName staffeditpwdn
     * @apiGroup 我的
     * @apiDescription 员工修改密码
     * @apiParam    {string}    old_pwd   旧密码（非空）
     * @apiParam    {int}    id   员工id(非空)
     * @apiParam    {string}    new_pwd   新密码(非空)
     ** @apiUse  staffeditpwd
     */
    public function editPwd()
    {
        $model = new StaffModel;
        $post = $this->request->post();
        $res = $model->editPwd($post['id'],$post['new_pwd'],$post['old_pwd']);
        if($res['code'] == 1){
            return $this->renderSuccess($res['msg']);
        }else{
            return $this->renderError($res['msg']);
        }
    }

    /**
     * @api {post} apo/staff/updatePhoto 更新员工头像
     * @apiName staffupdatePhoton
     * @apiGroup 我的
     * @apiDescription 更新员工头像
     * @apiParam    {int}    id   员工id(非空)
     * @apiParam    {file}    iFile   图片的路径
     * @apiParam    {int}    wxapp_id
     */
    public function updatePhoto()
    {
        $upload = new UploadFile;
        $model = new StaffModel;
        $post = $this->request->post();
        $res = $upload->myUpdateFile();
        if($res['code']!=1){
            return $this->renderError($res['msg']);
        }else{
            // 更换头像
            $data['cover']  = $res['data']['file_url'];
            $id = !empty($post['id']) ? $post['id'] : die('缺少参数id');
            if($model->updateDataById($data,$id)){
                return $this->renderSuccess($data['cover']);
            }else{
                return $this->renderError('修改失败！');
            }
        }
    }

}