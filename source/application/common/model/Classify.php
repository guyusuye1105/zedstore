<?php

namespace app\common\model;

use think\Cache;
use think\Request;

/**
 * 商品分类模型
 * Class Category
 * @package app\common\model
 */
class Classify extends BaseModel
{
    protected $name = 'project';
    /**
     * 获取分类
     */
    public function getList($id,$pagesize='')
    {
        Cache::clear();
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
