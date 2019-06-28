<?php

namespace app\store\model;

use app\common\model\Job as JobModel;
use think\Cache;
use think\Request;

/**
 *项目分类管理模型
 */
class Job extends JobModel
{
    /**
     * 获取分类
     */
    public function getList($id,$pagesize='')
    {
        $map = [];
        if ($id != '') {
            $map['id'] = ['=', $id];
        }
        $res = $this
            ->where($map)
            ->paginate($pagesize, false, [
                'query' => Request::instance()->request()
            ]);
        return $res;
    }
}
