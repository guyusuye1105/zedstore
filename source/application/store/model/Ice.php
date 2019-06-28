<?php

namespace app\store\model;

use app\common\model\BaseModel as BaseModel;
use think\Cache;
use think\Request;

/**
 *项目分类管理模型
 */
class Ice extends BaseModel
{
    protected $name = 'staff';
    /**
     * 获取员工列表
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList($pagesize='')
    {
        $map = [];
        $map['a.is_delete'] = ['=', 1];
        $res = $this->alias('a')
            ->join('job b','a.job_id = b.id')
            ->field('a.*,b.name as job_name')
            ->where($map)
            ->paginate($pagesize, false, [
                'query' => Request::instance()->request()
            ]);
        return $res;
    }
}
