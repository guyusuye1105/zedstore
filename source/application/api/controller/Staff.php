<?php

namespace app\api\controller;

use app\api\model\Staff as StaffModel;
use think\Request;

/**
 * 项目
 */
class Staff extends Controller
{
    /**
     * @api {post} api/staff/lists 获取服务人员
     * @apiName stafflistsn
     * @apiGroup 首页
     * @apiPermission none
     * @apiDescription 获取服务人员列表
     ** @apiUse  stafflists
     */
    public function lists()
    {
        $post = $this->request->post();
        $model = new StaffModel;
        if(empty($post['id'])){
            $post['id'] = '';
        }
        if(empty($post['pagesize'])){
            $post['pagesize'] = 10000;
        }
        if(empty($post['job_id'])){
            $post['job_id'] = '';
        }
        $list = $model->getList($post['job_id'],$post['id'],$post['pagesize']);
        return $this->renderSuccess(compact('list'));
    }


}
