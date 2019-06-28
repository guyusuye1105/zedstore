<?php

namespace app\store\model;

use app\common\model\Project as ProjectModel;
use think\Db;
use think\Request;

/**
 * 商品模型
 * Class Goods
 * @package app\store\model
 */
class Project extends ProjectModel
{

    /**
     * 获取订单列表
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList($project_id,$pagesize)
    {
        $map = [];
        $map['a.is_delete'] = ['=',0];
        if ($project_id != 'all' && $project_id != '') {
            $map['a.project_id'] = ['=', $project_id];
        }
        $res = $this->alias('a')
            ->join('project b','a.project_id = b.id')
            ->field('a.*,b.name as project_name')
            ->where($map)
            ->paginate($pagesize, false, [
                'query' => Request::instance()->request()
            ]);
        return $res;
    }

    public function getProjectList(){
        $result = Db::name($this->projectName)
            ->where('wxapp_id',self::$wxapp_id)
            ->select();
        return $result;
    }

    public function getOneList($id){
        $res = Db::name($this->name)
            ->where('id',$id)
            ->find();

        //p($res);
        /* $attr = explode(';',$res['attr_id']);
         foreach($attr as $key => $val){
             $res['attr'][$key] = Db::name('attr')
                 ->where('id',$val)
                 ->find();
         }*/
        if($res['attr'] !='') {
            $res['attr'] = explode(';;', $res['attr']);
            foreach ($res['attr'] as $key => $val) {
                $res['attr'][$key] = explode(';', $val, 2);
            }
        }
        return $res;
    }

    // 判断商品分类能否删除
    public function canDelete($id){
        $res = Db::name($this->name)
            ->where('wxapp_id',self::$wxapp_id)
            ->where('project_id',$id)
            ->where('is_delete',0)
            ->find();
        if($res){
            return false;
        }else{
            return true;
        }
    }
}
