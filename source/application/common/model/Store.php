<?php

namespace app\common\model;

use think\Request;

/**
 * 商品模型
 * Class Goods
 * @package app\common\model
 */
class Store extends BaseModel
{
    protected $name = 'store';
    protected $hidden = [
        'wxapp_id'
    ];


    /**
     * 获取门店列表
     * */
    public function getList($id,$pagesize='')
    {
        $map = [];
        if ($id != '') {
            $map['id'] = ['=', $id];
        }
        $res = $this->where($map)
            ->paginate($pagesize, false, [
                'query' => Request::instance()->request()
            ]);
        return $res;
    }


}