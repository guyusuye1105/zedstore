<?php

namespace app\api\model;

use app\common\model\Project as ProjectModel;

/**
 * 门店模型
 */
class Project extends ProjectModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
        'is_delete',
    ];

    /**
     * 获取所有服务列表
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getLists()
    {
        $map1 = self::$map[1];
        $map0 = self::$map[0];
        $res_item = $this->where($map1)
            ->select()->toArray();
        $res_project = db('project')->where($map0)
            ->select();
        // 遍历分类，获得已id作为数组键名的数组
        foreach($res_project as $key=>$val){
            $tmp[$val['id']] = $val;
        }
        // 遍历项目，把分类加入项目中
        foreach($res_item as $key2=>$val2){
            $val2['slide'] = explode(';',$val2['slide']);
            isset($tmp[$val2['project_id']]['item']) or $tmp[$val2['project_id']]['item'] = array();
            array_push($tmp[$val2['project_id']]['item'],$val2);
        }
        $result  =array();
        foreach($tmp as $key3=>$val3){
            $result[] = $val3;
        }
        return $result;
    }


    /**
     * 获取服务列表
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList($project_id)
    {
        $map = [];
        $map['a.is_delete'] = ['=',0];
        if ($project_id != '') {
            $map['a.project_id'] = ['=', $project_id];
        }
        $res = db($this->name)->alias('a')
            ->join('project b','a.project_id = b.id')
            ->field('a.*,b.name as project_name')
            ->where($map)
            ->select()
            ->toArray();
        foreach($res as $key => $val){
            $res[$key]['slide'] = explode(';',$res[$key]['slide']);
        }
        return $res;
    }


    /**
     * 获取单个服务内容
     */
    public function getOneList($id){

        $map['is_delete'] = ['=',0];
        $map['id'] = ['=',$id];
        $res = db($this->name)
            ->where($map)
            ->find();
        if($res['attr'] !='') {
            $res['attr'] = explode(';;', $res['attr']);
            foreach ($res['attr'] as $key => $val) {
                $res['attr'][$key] = explode(';', $val, 2);
                $res['attr'][$key][1] = explode(';',$res['attr'][$key][1]);
            }
        }
        $res['slide'] = explode(';',$res['slide']);
        return $res;
    }


}
