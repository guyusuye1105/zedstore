<?php

namespace app\api\controller;

//use app\api\model\Test as TestModel;
use think\Db;
use think\Request;

// 仅仅做测试用
class Test extends Controller
{
/*
    public function _initialize()
    {
        //parent::_initialize();
        //$this->user = $this->getUser();   // 用户信息
    }
*/
    private function connectRedis(){
        $config=load_we7_config();
        $redis=new \Redis();
//        $redis->connect($config['setting']['redis']['server'],$config['setting']['redis']['port']);
//        $redis->auth($config['setting']['redis']['auth']); //密码验证
        $redis->connect('127.0.0.1',6379,10);
        return $redis;
    }
    // 设置lcj
    public function a(){
        $redis = $this->connectRedis();
        //$res = $redis->set('lcj','帅哥哥');
        //$res = $redis->get('lcj');
        //$res = $redis->delete('lcj');
        //$res = $redis->setnx('lcj','帅哥哥1111');
        //$res = $redis->rpush('list','ddd');
        //$res = $redis->delete('list');
        //$res = $redis->lgetrange('list',0,-1);
        // $res2 = $redis->lrange('list',0,-1);
        //$res = $redis->getMultiple(array('list','lcj'));
        //$res2 = $redis->lgetrange('list',0,-1);
        //$res = $redis->llen('list');
//        $res = $redis->hset('hash:1','age',11);
//        $res = $redis->hset('hash:2','age',112);
//        $res = $redis->hset('hash:2','id',2);
//        $res = $redis->hset('hash:2','name','王二麻子');

//        $redis->zadd('zset:students', '1', '90');
//        $redis->zadd('zset:students', '2', '80');
//        $redis->zadd('zset:students', '3', '95');
//        $redis->zadd('zset:students', '7', '75');
//        $redis->zadd('zset:students', '5', '55');
        $res  = $redis->zrange('zset:students', 0, -1);







        if(isset($res)){
            var_dump($res);
        }
        if(isset($res2)){
            var_dump($res2);
        }
        if(isset($res3)){
             var_dump($res3);
        }
        if(isset($res4)){
            var_dump($res4);
        }
        if(isset($res5)){
            var_dump($res5);
        }


    }




    // 添加文章
function add_article($article){
    $article_fields = [
        'article_id'  => $article['article_id'],
        'create_time' => strtotime($article['create_time']),
        'title'       => $article['title'],
        'user_id'     => $article['user_id'],
        'nickname' => $article['nickname'],
        'logo'        => $article['logo'],
        'cover'       => $article['cover'],
        'category' => $article['category'],
    ];
    $this->redis->multi();
    $this->redis->hmset( 'article:' . $article['article_id'], $article_fields );
    $res = $this->redis->zadd('article:list', strtotime($article['create_time']), $article['article_id']);
    $this->redis->exec();
}

// 读取文章列表
function get_articles_by_score($create_time_star, $create_time_end){
		return $this->redis->zRevRangeByScore('article:list', "$create_time_star" , "$create_time_end", ['withscores' => true, 'limit' => [0, $this->pagesize]]);
}

    //
    public function b(){
        $redis = $this->connectRedis();
        $res = $redis->get('lcj');
        var_dump($res);
    }
    // 现在初始化里面定义后边要使用的redis参数
    public function _initialize(){
        parent::_initialize();
        /*
        $goods_id = 1;
        if($goods_id){
            $this->goods_id = $goods_id;
            $this->user_queue_key = "goods_".$goods_id."_user";//当前商品队列的用户情况
            $this->goods_number_key = "goods".$goods_id;//当前商品的库存队列
        }
        $this->user_id = 1;
        */
    }
    private function lcjInit(){
        $get = $_GET;
        $goods_id = $get['id'];
        if($goods_id){
            $this->goods_id = $goods_id;
            $this->user_queue_key = "goods_".$goods_id."_user";//当前商品队列的用户情况
            $this->goods_number_key = "goods".$goods_id;//当前商品的库存队列
        }
        $this->user_id = $get['user_id'];
    }

   //用户在进入商品详情页前先将当前商品的库存进行队列存入redis如下
    /**
     * 访问产品前先将当前产品库存队列
     * @access public
     * @author lichenjie
     */
    public function _before_detail(){
        $this->lcjInit();
        $where['id'] = $this->goods_id;
        //$where['start_time'] = array("lt",time());
        //$where['end_time'] = array("gt",time());
        $goods = db("item")->where($where)->field(array('id','name','price','extra1'))->find();
        !$goods && $this->error("当前秒杀已结束！");
        // 如果商品数量大于订单数量
        if($goods['extra1']>1){
            $redis = $this->connectRedis();
            $getUserRedis = $redis->hGetAll($this->user_queue_key);  //
            $gnRedis = $redis->llen($this->goods_number_key);
            /* 如果没有会员进来队列库存 */
            if(!count($getUserRedis) && !$gnRedis){
                for ($i = 0; $i < $goods['extra1']; $i ++) {
                    $redis->lpush($this->goods_number_key, 1);
                }
            }
            $resetRedis = $redis->llen($this->goods_number_key);
            if(!$resetRedis){
                $this->error("系统繁忙，请稍后抢购！");
            }
        }else{
            $this->error("当前产品已经秒杀完！");
        }

    }


//接下来要做的就是用ajax来异步的处理用户点击购买按钮进行符合条件的数据进入购买的排队队列
//（如果当前用户没在当前产品用户的队列就进入排队并且pop一个库存队列，如果在就抛出，）：
    /**
     * 抢购商品前处理当前会员是否进入队列
     * @access public
     * @author lichenjie
     */
    public function goods_number_queue(){
        $this->lcjInit();
        if(!$this->user_id){
            return array("status" => "-1","msg" => "请先登录");
        }

        $where['id'] = $this->goods_id;
        $goods_info = db("item")->where($where)->field(array('id','name','price','extra1'))->find();
        !$goods_info && $this->error("对不起当前商品不存在或已下架！");
        /* redis 队列 */
        $redis = $this->connectRedis();
        /* 进入队列 */
        $goods_number_key = $redis->llen("{$this->goods_number_key}");
        if (!$redis->hGet("{$this->user_queue_key}", $this->user_id)) {
            $goods_number_key = $redis->lpop("{$this->goods_number_key}");
        }

        if($goods_number_key){
            // 判断用户是否已在队列
            if (!$redis->hGet("{$this->user_queue_key}", $this->user_id)) {
                // 插入抢购用户信息
                $userinfo = array(
                    "user_id" => $this->user_id,
                    "create_time" => time()
                );
                $redis->hSet("{$this->user_queue_key}", $this->user_id, serialize($userinfo));
                return array("status" => "1");
            }else{
                db('item')->where('id',$this->goods_id)->setDec('extra1');
                return '用户id为'.$this->user_id.'的用户抢购成功！';
            }

        }else{
            return array("status" => "-1","msg" => "系统繁忙,请重试！");
        }
    }
}