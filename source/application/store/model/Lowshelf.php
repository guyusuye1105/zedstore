<?php

namespace app\store\model;

use app\common\model\BaseModel as BaseModel;
use think\Cache;
use think\Request;

/**
 *项目分类管理模型
 */
class Lowshelf extends BaseModel
{
    protected $name = 'item';


    /**
     * 获取服务列表
     */
    public function getList($pagesize)
    {
        $map = [];
        $map['a.is_delete'] = ['=',1];
        $res = $this->alias('a')
            ->join('project b','a.project_id = b.id')
            ->field('a.*,b.name as project_name')
            ->where($map)
            ->paginate($pagesize, false, [
                'query' => Request::instance()->request()
            ]);
        return $res;
    }
}
