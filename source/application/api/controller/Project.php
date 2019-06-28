<?php

namespace app\api\controller;

use app\api\model\Project as ProjectModel;
use app\api\model\Classify as ClassifyModel;

/**
 * 项目
 */
class Project extends Controller
{
    /**
     * @api {post} api/project/getList 获取所有服务列表（二维数组格式）
     * @apiName projectgetLists
     * @apiGroup 服务
     * @apiPermission none
     * @apiParam    wxapp_id
     * @apiDescription 获取所有服务列表（二维数组格式）
     */
    public function getList()
    {
        $model = new ProjectModel;
        $list = $model->getLists();
        return $this->renderSuccess(['list'=>$list]);
    }

    /**
     * @api {post} api/project/lists 获取服务列表
     * @apiName projectlistsn
     * @apiGroup 首页
     * @apiPermission none
     * @apiDescription 获取服务列表
     ** @apiUse  projectlists
     */
    public function lists()
    {
        $post = $this->request->post();
        $model = new ProjectModel;
        if(empty($post['project_id'])){
            $post['project_id'] = '';
        }
        $list = $model->getList($post['project_id']);
        return $this->renderSuccess(['list'=>$list]);
    }

    /**
     * @api {post} api/project/onelist 获取单个服务
     * @apiName projectonelistsn
     * @apiGroup 服务
     * @apiParam    id 要获取的服务id
     * @apiDescription 获取服务列表
     ** @apiUse  projectonelists
     */
    public function onelist()
    {
        $post = $this->request->post();
        $model = new ProjectModel;
        if(empty($post['id'])){
            $post['id'] = '';
        }
        $list = $model->getOneList($post['id']);
        return $this->renderSuccess(['list'=>$list]);
    }

    /**
     * @api {post} api/project/getclassify 获取项目分类
     * @apiName projectgetclassifyn
     * @apiGroup 首页
     * @apiPermission none
     * @apiDescription 获取项目分类
     ** @apiUse  projectgetclassify
     */
    public function getClassify()
    {
        if(empty($post['pagesize'])){
            $post['pagesize'] = 10000;
        }
        $model = new ClassifyModel;
        $list = $model->getList('',$post['pagesize']);
        return $this->renderSuccess(compact('list'));
    }



}
