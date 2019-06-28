<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//------------------------
//  助手函数 自定义 覆盖原来的
//-------------------------

use think\Cache;
use think\Config;
use think\Cookie;
use think\Db;
use think\Debug;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\Lang;
use think\Loader;
use think\Log;
use think\Model;
use think\Request;
use think\Response;
use think\Session;
use think\Url;
use think\View;




if (!function_exists('load_trait')) {
    /**
     * 快速导入Traits PHP5.5以上无需调用
     * @param string    $class trait库
     * @param string    $ext 类库后缀
     * @return boolean
     */
    function load_trait($class, $ext = EXT)
    {
        return Loader::import($class, TRAIT_PATH, $ext);
    }
}

if (!function_exists('exception')) {
    /**
     * 抛出异常处理
     *
     * @param string    $msg  异常消息
     * @param integer   $code 异常代码 默认为0
     * @param string    $exception 异常类
     *
     * @throws Exception
     */
    function exception($msg, $code = 0, $exception = '')
    {
        $e = $exception ?: '\think\Exception';
        throw new $e($msg, $code);
    }
}

if (!function_exists('debug')) {
    /**
     * 记录时间（微秒）和内存使用情况
     * @param string            $start 开始标签
     * @param string            $end 结束标签
     * @param integer|string    $dec 小数位 如果是m 表示统计内存占用
     * @return mixed
     */
    function debug($start, $end = '', $dec = 6)
    {
        if ('' == $end) {
            Debug::remark($start);
        } else {
            return 'm' == $dec ? Debug::getRangeMem($start, $end) : Debug::getRangeTime($start, $end, $dec);
        }
    }
}

if (!function_exists('lang')) {
    /**
     * 获取语言变量值
     * @param string    $name 语言变量名
     * @param array     $vars 动态变量值
     * @param string    $lang 语言
     * @return mixed
     */
    function lang($name, $vars = [], $lang = '')
    {
        return Lang::get($name, $vars, $lang);
    }
}

if (!function_exists('config')) {
    /**
     * 获取和设置配置参数
     * @param string|array  $name 参数名
     * @param mixed         $value 参数值
     * @param string        $range 作用域
     * @return mixed
     */
    function config($name = '', $value = null, $range = '')
    {
        if (is_null($value) && is_string($name)) {
            return 0 === strpos($name, '?') ? Config::has(substr($name, 1), $range) : Config::get($name, $range);
        } else {
            return Config::set($name, $value, $range);
        }
    }
}

if (!function_exists('input')) {
    /**
     * 获取输入数据 支持默认值和过滤
     * @param string    $key 获取的变量名
     * @param mixed     $default 默认值
     * @param string    $filter 过滤方法
     * @return mixed
     */
    function input($key = '', $default = null, $filter = '')
    {
        if (0 === strpos($key, '?')) {
            $key = substr($key, 1);
            $has = true;
        }
        if ($pos = strpos($key, '.')) {
            // 指定参数来源
            list($method, $key) = explode('.', $key, 2);
            if (!in_array($method, ['get', 'post', 'put', 'patch', 'delete', 'route', 'param', 'request', 'session', 'cookie', 'server', 'env', 'path', 'file'])) {
                $key    = $method . '.' . $key;
                $method = 'param';
            }
        } else {
            // 默认为自动判断
            $method = 'param';
        }
        if (isset($has)) {
            return request()->has($key, $method, $default);
        } else {
            return request()->$method($key, $default, $filter);
        }
    }
}

if (!function_exists('widget')) {
    /**
     * 渲染输出Widget
     * @param string    $name Widget名称
     * @param array     $data 传入的参数
     * @return mixed
     */
    function widget($name, $data = [])
    {
        return Loader::action($name, $data, 'widget');
    }
}

if (!function_exists('model')) {
    /**
     * 实例化Model
     * @param string    $name Model名称
     * @param string    $layer 业务层名称
     * @param bool      $appendSuffix 是否添加类名后缀
     * @return \think\Model
     */
    function model($name = '', $layer = 'model', $appendSuffix = false)
    {
        return Loader::model($name, $layer, $appendSuffix);
    }
}

if (!function_exists('validate')) {
    /**
     * 实例化验证器
     * @param string    $name 验证器名称
     * @param string    $layer 业务层名称
     * @param bool      $appendSuffix 是否添加类名后缀
     * @return \think\Validate
     */
    function validate($name = '', $layer = 'validate', $appendSuffix = false)
    {
        return Loader::validate($name, $layer, $appendSuffix);
    }
}

if (!function_exists('db')) {
    /**
     * 实例化数据库类
     * @param string        $name 操作的数据表名称（不含前缀）
     * @param array|string  $config 数据库配置参数
     * @param bool          $force 是否强制重新连接
     * @return \think\db\Query
     */
    function db($name = '', $config = [], $force = false)
    {
        return Db::connect($config, $force)->name($name);
    }
}

if (!function_exists('M')) {
    /**
     * 实例化数据库类
     * @param string        $name 操作的数据表名称（不含前缀）
     * @param array|string  $config 数据库配置参数
     * @param bool          $force 是否强制重新连接
     * @return \think\db\Query
     */
    function M($name = '', $config = [], $force = false)
    {
        return Db::connect($config, $force)->name($name);
    }
}


if (!function_exists('controller')) {
    /**
     * 实例化控制器 格式：[模块/]控制器
     * @param string    $name 资源地址
     * @param string    $layer 控制层名称
     * @param bool      $appendSuffix 是否添加类名后缀
     * @return \think\Controller
     */
    function controller($name, $layer = 'controller', $appendSuffix = false)
    {
        return Loader::controller($name, $layer, $appendSuffix);
    }
}

if (!function_exists('action')) {
    /**
     * 调用模块的操作方法 参数格式 [模块/控制器/]操作
     * @param string        $url 调用地址
     * @param string|array  $vars 调用参数 支持字符串和数组
     * @param string        $layer 要调用的控制层名称
     * @param bool          $appendSuffix 是否添加类名后缀
     * @return mixed
     */
    function action($url, $vars = [], $layer = 'controller', $appendSuffix = false)
    {
        return Loader::action($url, $vars, $layer, $appendSuffix);
    }
}

if (!function_exists('import')) {
    /**
     * 导入所需的类库 同java的Import 本函数有缓存功能
     * @param string    $class 类库命名空间字符串
     * @param string    $baseUrl 起始路径
     * @param string    $ext 导入的文件扩展名
     * @return boolean
     */
    function import($class, $baseUrl = '', $ext = EXT)
    {
        return Loader::import($class, $baseUrl, $ext);
    }
}

if (!function_exists('vendor')) {
    /**
     * 快速导入第三方框架类库 所有第三方框架的类库文件统一放到 系统的Vendor目录下面
     * @param string    $class 类库
     * @param string    $ext 类库后缀
     * @return boolean
     */
    function vendor($class, $ext = EXT)
    {
        return Loader::import($class, VENDOR_PATH, $ext);
    }
}

if (!function_exists('dump')) {
    /**
     * 浏览器友好的变量输出
     * @param mixed     $var 变量
     * @param boolean   $echo 是否输出 默认为true 如果为false 则返回输出字符串
     * @param string    $label 标签 默认为空
     * @return void|string
     */
    function dump($var, $echo = true, $label = null)
    {
        return Debug::dump($var, $echo, $label);
    }
}

if (!function_exists('url')) {
    /**
     * Url生成
     * @param string        $url 路由地址
     * @param string|array  $vars 变量
     * @param bool|string   $suffix 生成的URL后缀
     * @param bool|string   $domain 域名
     * @return string
     */
    function url($url = '', $vars = '', $suffix = true, $domain = false)
    {
        return Url::build($url, $vars, $suffix, $domain);
    }
}

if (!function_exists('session')) {
    /**
     * Session管理
     * @param string|array  $name session名称，如果为数组表示进行session设置
     * @param mixed         $value session值
     * @param string        $prefix 前缀
     * @return mixed
     */
    function session($name, $value = '', $prefix = null)
    {
        if (is_array($name)) {
            // 初始化
            Session::init($name);
        } elseif (is_null($name)) {
            // 清除
            Session::clear('' === $value ? null : $value);
        } elseif ('' === $value) {
            // 判断或获取
            return 0 === strpos($name, '?') ? Session::has(substr($name, 1), $prefix) : Session::get($name, $prefix);
        } elseif (is_null($value)) {
            // 删除
            return Session::delete($name, $prefix);
        } else {
            // 设置
            return Session::set($name, $value, $prefix);
        }
    }
}

if (!function_exists('cookie')) {
    /**
     * Cookie管理
     * @param string|array  $name cookie名称，如果为数组表示进行cookie设置
     * @param mixed         $value cookie值
     * @param mixed         $option 参数
     * @return mixed
     */
    function cookie($name, $value = '', $option = null)
    {
        if (is_array($name)) {
            // 初始化
            Cookie::init($name);
        } elseif (is_null($name)) {
            // 清除
            Cookie::clear($value);
        } elseif ('' === $value) {
            // 获取
            return 0 === strpos($name, '?') ? Cookie::has(substr($name, 1), $option) : Cookie::get($name, $option);
        } elseif (is_null($value)) {
            // 删除
            return Cookie::delete($name);
        } else {
            // 设置
            return Cookie::set($name, $value, $option);
        }
    }
}

if (!function_exists('cache')) {
    /**
     * 缓存管理
     * @param mixed     $name 缓存名称，如果为数组表示进行缓存设置
     * @param mixed     $value 缓存值
     * @param mixed     $options 缓存参数
     * @param string    $tag 缓存标签
     * @return mixed
     */
    function cache($name, $value = '', $options = null, $tag = null)
    {
        if (is_array($options)) {
            // 缓存操作的同时初始化
            $cache = Cache::connect($options);
        } elseif (is_array($name)) {
            // 缓存初始化
            return Cache::connect($name);
        } else {
            $cache = Cache::init();
        }

        if (is_null($name)) {
            return $cache->clear($value);
        } elseif ('' === $value) {
            // 获取缓存
            return 0 === strpos($name, '?') ? $cache->has(substr($name, 1)) : $cache->get($name);
        } elseif (is_null($value)) {
            // 删除缓存
            return $cache->rm($name);
        } elseif (0 === strpos($name, '?') && '' !== $value) {
            $expire = is_numeric($options) ? $options : null;
            return $cache->remember(substr($name, 1), $value, $expire);
        } else {
            // 缓存数据
            if (is_array($options)) {
                $expire = isset($options['expire']) ? $options['expire'] : null; //修复查询缓存无法设置过期时间
            } else {
                $expire = is_numeric($options) ? $options : null; //默认快捷缓存设置过期时间
            }
            if (is_null($tag)) {
                return $cache->set($name, $value, $expire);
            } else {
                return $cache->tag($tag)->set($name, $value, $expire);
            }
        }
    }
}

if (!function_exists('trace')) {
    /**
     * 记录日志信息
     * @param mixed     $log log信息 支持字符串和数组
     * @param string    $level 日志级别
     * @return void|array
     */
    function trace($log = '[think]', $level = 'log')
    {
        if ('[think]' === $log) {
            return Log::getLog();
        } else {
            Log::record($log, $level);
        }
    }
}

if (!function_exists('request')) {
    /**
     * 获取当前Request对象实例
     * @return Request
     */
    function request()
    {
        return Request::instance();
    }
}

if (!function_exists('response')) {
    /**
     * 创建普通 Response 对象实例
     * @param mixed      $data   输出数据
     * @param int|string $code   状态码
     * @param array      $header 头信息
     * @param string     $type
     * @return Response
     */
    function response($data = [], $code = 200, $header = [], $type = 'html')
    {
        return Response::create($data, $type, $code, $header);
    }
}

if (!function_exists('view')) {
    /**
     * 渲染模板输出
     * @param string    $template 模板文件
     * @param array     $vars 模板变量
     * @param array     $replace 模板替换
     * @param integer   $code 状态码
     * @return \think\response\View
     */
    function view($template = '', $vars = [], $replace = [], $code = 200)
    {
        return Response::create($template, 'view', $code)->replace($replace)->assign($vars);
    }
}

if (!function_exists('json')) {
    /**
     * 获取\think\response\Json对象实例
     * @param mixed   $data 返回的数据
     * @param integer $code 状态码
     * @param array   $header 头部
     * @param array   $options 参数
     * @return \think\response\Json
     */
    function json($data = [], $code = 200, $header = [], $options = [])
    {
        return Response::create($data, 'json', $code, $header, $options);
    }
}

if (!function_exists('jsonp')) {
    /**
     * 获取\think\response\Jsonp对象实例
     * @param mixed   $data    返回的数据
     * @param integer $code    状态码
     * @param array   $header 头部
     * @param array   $options 参数
     * @return \think\response\Jsonp
     */
    function jsonp($data = [], $code = 200, $header = [], $options = [])
    {
        return Response::create($data, 'jsonp', $code, $header, $options);
    }
}

if (!function_exists('xml')) {
    /**
     * 获取\think\response\Xml对象实例
     * @param mixed   $data    返回的数据
     * @param integer $code    状态码
     * @param array   $header  头部
     * @param array   $options 参数
     * @return \think\response\Xml
     */
    function xml($data = [], $code = 200, $header = [], $options = [])
    {
        return Response::create($data, 'xml', $code, $header, $options);
    }
}

if (!function_exists('redirect')) {
    /**
     * 获取\think\response\Redirect对象实例
     * @param mixed         $url 重定向地址 支持Url::build方法的地址
     * @param array|integer $params 额外参数
     * @param integer       $code 状态码
     * @param array         $with 隐式传参
     * @return \think\response\Redirect
     */
    function redirect($url = [], $params = [], $code = 302, $with = [])
    {
        if (is_integer($params)) {
            $code   = $params;
            $params = [];
        }
        return Response::create($url, 'redirect', $code)->params($params)->with($with);
    }
}

if (!function_exists('abort')) {
    /**
     * 抛出HTTP异常
     * @param integer|Response      $code 状态码 或者 Response对象实例
     * @param string                $message 错误信息
     * @param array                 $header 参数
     */
    function abort($code, $message = null, $header = [])
    {
        if ($code instanceof Response) {
            throw new HttpResponseException($code);
        } else {
            throw new HttpException($code, $message, null, $header);
        }
    }
}

if (!function_exists('halt')) {
    /**
     * 调试变量并且中断输出
     * @param mixed      $var 调试变量或者信息
     */
    function halt($var)
    {
        dump($var);
        throw new HttpResponseException(new Response);
    }
}

if (!function_exists('token')) {
    /**
     * 生成表单令牌
     * @param string $name 令牌名称
     * @param mixed  $type 令牌生成方法
     * @return string
     */
    function token($name = '__token__', $type = 'md5')
    {
        $token = Request::instance()->token($name, $type);
        return '<input type="hidden" name="' . $name . '" value="' . $token . '" />';
    }
}

if (!function_exists('load_relation')) {
    /**
     * 延迟预载入关联查询
     * @param mixed $resultSet 数据集
     * @param mixed $relation 关联
     * @return array
     */
    function load_relation($resultSet, $relation)
    {
        $item = current($resultSet);
        if ($item instanceof Model) {
            $item->eagerlyResultSet($resultSet, $relation);
        }
        return $resultSet;
    }
}

if (!function_exists('collection')) {
    /**
     * 数组转换为数据集对象
     * @param array $resultSet 数据集数组
     * @return \think\model\Collection|\think\Collection
     */
    function collection($resultSet)
    {
        $item = current($resultSet);
        if ($item instanceof Model) {
            return \think\model\Collection::make($resultSet);
        } else {
            return \think\Collection::make($resultSet);
        }
    }
}

/*
 * 根据配置实例化一个redis对象
 */
if (!function_exists('redis')) {

    function redis($options=[])
    {
        if(empty($options)){
            $options = Config::get('cache' );
        }
        return new \think\cache\driver\Redis($options);
    }
}

/*
 * 拆字符串为数组 默认,拆开 此函数 会先校检是否存在
 * @return 数组
 */
if (!function_exists('split_string')) {

    function split_string($string,$delimiter=",")
    {
        if(is_string($string)){
            $string=trim($string);
            if(strpos($string,$delimiter)!==false){
                return explode($delimiter,$string);
            }else{
                return array($string);
            }
        }else{
            return false;
        }
    }
}

if(!function_exists('http_get')){
    function http_get($url,$params=''){
        //初始化
        if(!empty($params) && is_array($params)){
            $query='';
            foreach ($params as $k=> $p){
                $query.=$k."=".$p."&";
            }
            $query=rtrim($query,"&");
            $url=rtrim($url,"?")."?".$query;
        }

        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        //curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);

        $output=json_decode($data,true);
        //显示获得的数据
        return $output;
    }

}

if(!function_exists('http_post')){
   function HttpPost($url,$data){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $headers=array(
            'Content-type:application/x-www-form-urlencoded;charset="utf-8"'
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);

        curl_close($ch);

        $output=json_decode($output,true);
        return $output;

    }
}

if(!function_exists('array_sort')){
    /*
$array:需要排序的数组
$keys:需要根据某个key排序
$sort:倒叙还是顺序
*/
    function array_sort($array,$keys,$sort='asc') {
        $newArr = $valArr = array();
        foreach ($array as $key=>$value) {
            $valArr[$key] = $value[$keys];
        }
        ($sort == 'asc') ?  asort($valArr) : arsort($valArr);//先利用keys对数组排序，目的是把目标数组的key排好序
        reset($valArr); //指针指向数组第一个值
        foreach($valArr as $key=>$value) {
            $newArr[$key] = $array[$key];
        }
        return $newArr;
    }
}


if(!function_exists('totimestamp')){
    /**
     * @param $str 可传入时间戳 毫秒时间戳 和日期2018-12-31这样的
     * @return false|float|int
     */
    function totimestamp($str){
        if(strpos($str,'-')!==false){
            return strtotime($str);
        }else if(strlen($str)==14){
            //毫秒
            return ceil($str/1000);
        }else{
            return $str;
        }
    }
}

if(!function_exists('excel_export')){

    /*
 * record 数据数据
 * header 导出的第一行
 *
 */
    function excel_export($record,$header,$title=''){

        $keys = array_keys($header);
        $html = "\xEF\xBB\xBF";
        foreach ($header as $li) {
            $html .= $li . "\t ,";
        }
        $html .= "\n";
        $count = count($record);
        $pagesize = ceil($count/5000);
        for ($j = 1; $j <= $pagesize; $j++) {
            $list = array_slice($record, ($j-1) * 5000, 5000);
            if (!empty($list)) {
                $size = ceil(count($list) / 500);
                for ($i = 0; $i < $size; $i++) {
                    $buffer = array_slice($list, $i * 500, 500);
                    $user = array();
                    foreach ($buffer as $row) {
                        foreach ($keys as $key) {
                            $data[] = $row[$key];
                        }
                        $user[] = implode("\t ,", $data) . "\t ,";
                        unset($data);
                    }
                    $html .= implode("\n", $user) . "\n";
                }
            }
        }

        if(empty($title)){
            $title=date("Ymd");
        }
        ob_clean();
        header("Content-type:text/csv");
        header("Content-Disposition:attachment; filename={$title}.csv");
        echo $html;
        exit();

    }


}

if(!function_exists('get_array_value')){

    function get_array_value($array,$key){
        foreach ($array as $k=>$v){
            if(is_array($v)){
                if(isset($v[$key])){
                    return $v[$key];
                }
            }else{
                if($k==$key){
                    return $v;
                }
            }
        }
        return "";
    }
}