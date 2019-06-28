<?php

namespace app\apo\model;

use app\common\model\Staff as StaffModel;

/**
 * 职员模型
 */
class Staff extends StaffModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
        'password',
       // 'sort',
    ];
    function login($account,$password){
        $map['account'] = ['=',$account];
        $map['is_delete'] = ['=',0];
        $res = db($this->name)
            ->where($map)
            ->find();
        if(!$res){
            return array('code'=>'0','msg'=>'该账号不存在或者被禁用');
        }
        if($res['password'] == $password){
            return array('code'=>'1','msg'=>$res);
        }else{
            return array('code'=>'0','msg'=>'密码错误');
        }
    }
    function detail($id){
        $res = db($this->name)
            ->where('id','=',$id)
            ->find();
        if(!$res){
            return array('code'=>'0','msg'=>'该账号不存在');
        }else{
            return array('code'=>'1','msg'=>$res);
        }
    }
    function editPwd($id,$new_pwd,$old_pwd){
        $res = db($this->name)
            ->where('id','=',$id)
            ->find();
        if($new_pwd == $old_pwd){
            return array('code'=>'0','msg'=>'新旧密码不能相同');
        }
        $new_pwd = MD5($new_pwd);
        $old_pwd = MD5($old_pwd);
        if($old_pwd == $res['password']){
            $data['id'] = $id;
            $data['password'] = $new_pwd;
            $res2 = db($this->name)
                ->update($data);
            if($res2){
                return array('code'=>'1','msg'=>'密码修改成功');
            }else{
                return array('code'=>'0','msg'=>'密码修改失败');
            }
        }else{
            return array('code'=>'0','msg'=>'原密码不正确');
        }
    }


}
