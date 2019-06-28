<?php

namespace app\common\model\store;

use app\common\model\BaseModel;

/**
 * 商家用户权限模型
 * Class Access
 * @package app\common\model\admin
 */
class Access extends BaseModel
{
    protected $name = 'store_access';

    /**
     * 获取所有权限
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected static function getAll()
    {
        $data = static::useGlobalScope(false)->order(['sort' => 'asc', 'create_time' => 'asc'])->select();
        return $data ? $data->toArray() : [];
    }

    /**
     * 权限信息
     * @param $access_id
     * @return array|false|\PDOStatement|string|\think\Model|static
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function detail($access_id)
    {
        return static::useGlobalScope(false)->where(['access_id' => $access_id])->find();
    }

    /**
     * 获取权限url集
     * @param $accessIds
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getAccessUrls($accessIds)
    {
        $urls = [];
        foreach (static::getAll() as $item) {
            in_array($item['access_id'], $accessIds) && $urls[] = $item['url'];
        }
        return $urls;
    }

}