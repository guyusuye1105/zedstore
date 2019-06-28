<?php

namespace app\store\model;

use app\common\model\Attr as AttrModel;
use think\Cache;
use think\Request;

/**
 *项目分类管理模型
 */
class Attr extends AttrModel
{
    /**
     * 获取分类
     */
    public function getList($id,$pagesize='')
    {
        $map = [];
        if ($id != '') {
            $map['a.id'] = ['=', $id];
        }
        return $this
            ->paginate($pagesize, false, [
                'query' => Request::instance()->request()
            ]);
    }
}
