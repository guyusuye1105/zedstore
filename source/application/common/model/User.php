<?php

namespace app\common\model;

use think\Request;

/**
 * 商品模型
 * Class Goods
 * @package app\common\model
 */
class User extends BaseModel
{
    protected $name = 'user';
    // 性别
    private $gender = ['未知', '男', '女'];

    /**
     * 关联收货地址表
     * @return \think\model\relation\HasMany
     */
    public function address()
    {
        return $this->hasMany('UserAddress');
    }

    /**
     * 关联收货地址表 (默认地址)
     * @return \think\model\relation\BelongsTo
     */
    public function addressDefault()
    {
        return $this->belongsTo('UserAddress', 'address_id');
    }

    /**
     * 显示性别
     * @param $value
     * @return mixed
     */
    public function getGenderAttr($value)
    {
        return $this->gender[$value];
    }

    /**
     * 获取用户列表
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList()
    {
        $request = Request::instance();
        return $this->order(['create_time' => 'desc'])
            ->paginate(15, false, ['query' => $request->request()]);
    }

    /**
     * 获取用户信息
     * @param $where
     * @return null|static
     * @throws \think\exception\DbException
     */
    public static function detail($where)
    {
        return self::get($where, ['address', 'addressDefault']);
    }
    /**
     * 获取会员列表
     * $type 会员类型（1所有 2过滤掉没头像的会员）
     * */
    public function getLists($id,$keywords,$pagesize,$type=1)
    {
        $map = [];
        if ($keywords != '') {
            $map['nickName|mobile|card'] = ['like', '%'.$keywords.'%'];
        }
        if ($id != '') {
            $map['user_id'] = ['=', $id];
        }
        if($type == 2){
            $map['nickName|avatarUrl'] = ['<>', ''];
        }
        $res = $this->where($map)
            ->paginate($pagesize, false, [
                'query' => Request::instance()->request()
            ]);
        return $res;
    }
}
