<?php

namespace app\common\model;

/**
 * 商家用户模型
 * Class StoreUser
 * @package app\common\model
 */
class StoreUser extends BaseModel
{
    protected $name = 'store_user';

    /**
     * 新增默认商家用户信息
     * @param $wxapp_id
     * @return false|int
     */
   /* public function insertDefault($wxapp_id)
    {
        return $this->save([
            'user_name' => 'yoshop_' . $wxapp_id,
            'password' => md5(uniqid()),
            'wxapp_id' => $wxapp_id,
        ]);
    }*/

    /**
     * 新增默认商家用户信息
     * @param $wxapp_id
     * @return false|int
     */
    public function insertDefault($wxapp_id,$user)
    {
        /*  $moudle_name=config('moudle_name');
          if(empty($moudle_name)){
              $moudle_name='yoshop';
          }*/
        //判断is_super  下面三个是we7的管理员

        if(in_array($user['role'],array('vice_founder','owner','manager'))){
            $is_super=1;
        }else{
            $is_super=0;
        }

        return $this->save([
            'user_name' => $user['user_name'],
            'password' => md5(uniqid()),
            'wxapp_id' => $wxapp_id,
            'we7_uid' => $user['uid'],
            'real_name' => $user['real_name'],
            'is_super' => $is_super,
        ]);
    }

}
