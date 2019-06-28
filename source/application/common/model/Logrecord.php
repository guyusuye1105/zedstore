<?php

namespace app\common\model;

use think\Request;

/**
 * 商品模型
 * Class Goods
 * @package app\common\model
 */
class Logrecord extends BaseModel
{
    protected $name = 'Logrecord';

    // 插入日志
    function insertLog($data){
        if(!isset($data['wxapp_id'])){
            $data['wxapp_id'] = 0;
        }
        $data['create_time'] = time();
        $result = Db($this->name)->insert($data);
       // $result = $this->createData($data);
        return $result;
    }

}
