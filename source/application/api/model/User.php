<?php

namespace app\api\model;

use app\common\model\User as UserModel;
//use app\api\model\Wxapp;
use app\common\library\wechat\WxUser;
use app\common\exception\BaseException;
use think\Cache;
use think\Request;

/**
 * 用户模型类
 * Class User
 * @package app\api\model
 */
class User extends UserModel
{
    private $token;

    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
        'create_time',
        'update_time'
    ];

    /**
     * 获取用户信息
     * @param $token
     * @return null|static
     * @throws \think\exception\DbException
     */
    public static function getUser($token)
    {
        //p(self::detail(['open_id' => Cache::get($token)['openid']]));
        return self::detail(['open_id' => Cache::get($token)['openid']]);
    }

    /**
     * 用户登录
     * @param array $post
     * @return string
     * @throws BaseException
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function login($post)
    {
        // 微信登录 获取session_key
        $session = $this->wxlogin($post['code']);
        // 自动注册用户
        $userInfo = json_decode(htmlspecialchars_decode($post['user_info']), true);
        $user_id = $this->register($session['openid'], $userInfo,$session['session_key']);
        // 生成token (session3rd)
        $this->token = $this->token($session['openid']);

        // 记录缓存, 7天
        Cache::set($this->token, $session, 86400 * 7);
        return $user_id;
    }
    /**
     * 用户登录2
     * @param array $post
     * @return string
     * @throws BaseException
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function submit($post)
    {
        // 微信登录 获取session_key
        $session = $this->wxlogin($post['code']);

        // 自动注册用户
        $userInfo = array(
            'openid'=>$session['openid'],
            'session_key'=>$session['session_key'],
        );
        $user_id = $this->register2($session['openid'], $userInfo);
        // 生成token (session3rd)
        $this->token = $this->token($session['openid']);

        // 记录缓存, 7天
        Cache::set($this->token, $session, 86400 * 7);
        return $user_id;
    }

    /**
     * 获取token
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * 微信登录
     * @param $code
     * @return array|mixed
     * @throws BaseException
     * @throws \think\exception\DbException
     */
    private function wxlogin($code)
    {
        //造假数据session_key
       /* $session['openid'] = '323232';
        return $session;*/
        // 获取当前小程序信息
        $wxapp = Wxapp::detail();
        // 微信登录 (获取session_key)
        $WxUser = new WxUser($wxapp['app_id'], $wxapp['app_secret']);
        if (!$session = $WxUser->sessionKey($code))
            throw new BaseException(['msg' => 'session_key 获取失败']);
        return $session;
    }

    /**
     * 生成用户认证的token
     * @param $openid
     * @return string
     */
    private function token($openid)
    {
        return md5($openid . self::$wxapp_id . 'token_salt');
    }

    /**
     * 自动注册用户
     * @param $open_id
     * @param $userInfo
     * @return mixed
     * @throws BaseException
     * @throws \think\exception\DbException
     */
    private function register($open_id, $userInfo,$lcj)
    {
        if (!$user = self::get(['open_id' => $open_id])) {
            $user = $this;
            $userInfo['open_id'] = $open_id;
            $userInfo['wxapp_id'] = self::$wxapp_id;
            $userInfo['card'] = $this->cardNo();
            $userInfo['session_key'] = $lcj;

        }
        $userInfo['nickName'] = preg_replace('/[\xf0-\xf7].{3}/', '', $userInfo['nickName']);
        if (!$user->allowField(true)->save($userInfo)) {
            throw new BaseException(['msg' => '用户注册失败']);
        }
        return $user['user_id'];
    }
    /**
     * 自动注册用户2
     * @param $open_id
     * @param $userInfo
     * @return mixed
     * @throws BaseException
     * @throws \think\exception\DbException
     */
    private function register2($open_id, $userInfo)
    {

        if (!$user = self::get(['open_id' => $open_id])) {
            $user = $this;
            $userInfo['open_id'] = $open_id;
            $userInfo['wxapp_id'] = self::$wxapp_id;
            $userInfo['card'] = $this->cardNo();
        }
       // p($userInfo);
        if (!$user->allowField(true)->save($userInfo)) {
            throw new BaseException(['msg' => '用户注册失败']);
        }
        return $user['user_id'];
    }

    /**
     * 生成会员卡编号
     * @return string
     */
    function cardNo()
    {
        return date('ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

    /**
     * lcj
     * 判断是否是注册会员
     */
    function isMember($user_id)
    {
        $user = db('user')
            ->where('user_id',$user_id)
            ->find();
        if($user['mobile'] == ''){
            return 0;
        }else{
            return 1;
        }
    }
    /*
     * 获取小程序手机号
     */
    public function getphone($param){
        if ($this->check_params(['uid','iv','encryptedData'], $param)) {
            $uid=$param['uid'];
            $member=M($this->name)->where(array('user_id'=>$uid))->find();
            if(!$member){
                $this->setError('1','uid参数错误');
                return false;
            }

            $session_key=$member['session_key'];
            $iv=$param['iv'];
            $encryptedData=$param['encryptedData'];
            $data=Wxapp::getphone($encryptedData,$iv,$session_key);
            if($data){
                unset($data['watermark']);

                //拿到手机号后 更新下本地信息
                $update['mobile']=$data['phoneNumber'];
                $update['update_time']=time();
                M($this->name)->where(['user_id'=>$uid])->update($update);
                return $data;
            }else{
                $this->setError(Wxapp::getErrCode(),Wxapp::getErrMsg());
                return false;
            }

        }else{
            $this->setError('1','参数错误');
            return false;
        }
    }
    /**
     * 获取access_token
     */
   /* function getAccessToken(){
        // 获取当前小程序信息
        $wxapp = Wxapp::detail();
        // 微信登录 (获取session_key)
        $WxBase = new WxBase($wxapp['app_id'], $wxapp['app_secret']);
        $a = $WxBase->getAccessToken();
        return $session;

   use app\common\library\wechat\WxBase;
    }*/

    /*
* 这里使用一个简单的参数验证
* isset 检查是否定义 否则而检查是否为空
*/
    public function check_params($array = array(),$gpc,$type='isset'){
        if (!empty($array)) {
            if($type=='isset'){
                foreach ($array as $av) {
                    if(is_string($av) || is_int($av)){
                        if(isset($gpc[$av]) && $gpc[$av]=="undefined"){
                            $this->setError(2,"参数错误 {$av}未定义undefined");
                            return false;
                        }

                        if (!isset($gpc[$av])) {
                            $this->setError(1,"参数错误 缺少{$av}");
                            return false;
                        }
                    }elseif(is_array($av)){
                        //至少有1个
                        $flag=false;
                        $tip="";
                        foreach ($av as $vv){
                            $tip.=$vv." ";
                            if (isset($gpc[$vv]) && $gpc[$vv]!="undefined") {
                                $flag=true;
                                break;
                            }
                        }
                        if(!$flag){
                            $this->setError(3,"{$tip}不能都缺失");
                            return false;
                        }
                    }else{
                        $this->setError(3,"格式错误");
                        return false;
                    }

                }

            }else{
                foreach ($array as $av) {
                    if(is_string($av) || is_int($av)){
                        if(empty($gpc[$av]) || $gpc[$av]=="undefined"){
                            $this->setError(2,"参数错误 {$av}不能为空或未定义");
                            return false;
                        }

                        if (empty($gpc[$av])) {
                            $this->setError(1,"参数错误 {$av}不能为空");
                            return false;
                        }
                    }elseif(is_array($av)){
                        //至少有1个
                        $flag=false;
                        $tip="";
                        foreach ($av as $vv){
                            $tip.=$vv." ";
                            if (!empty($gpc[$vv]) && $gpc[$vv]!="undefined") {
                                $flag=true;
                                break;
                            }
                        }
                        if(!$flag){
                            $this->setError(3,"{$tip}不能都为空");
                            return false;
                        }
                    }else{
                        $this->setError(3,"格式错误");
                        return false;
                    }

                }
            }

        }
        return true;
    }
}
