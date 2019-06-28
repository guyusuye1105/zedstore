<?php

namespace app\common\model;

use think\Request;
use think\Db;

/**
 * 商品模型
 * Class Goods
 * @package app\common\model
 */
class Staff extends BaseModel
{
    protected $name = 'staff';

    /**
     * 获取员工列表
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList($job_id,$id,$pagesize='')
    {
        $map = [];
        $map['a.is_delete'] = ['=', 0];
        if ($job_id != ''&&$job_id != 'all') {
            $map['a.job_id'] = ['=', $job_id];
        }
        if ($id != '') {
            $map['a.id'] = ['=', $id];
        }
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