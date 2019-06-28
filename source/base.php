<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: DK
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
// +--------------------tp的框架代码在最外面的vendor里面，-------------------------------
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
define('THINK_VERSION', '5.0.20');
define('THINK_START_TIME', microtime(true));
define('THINK_START_MEM', memory_get_usage());
define('EXT', '.php');
define('DS', DIRECTORY_SEPARATOR);
/*defined('THINK_PATH') or define('THINK_PATH', __DIR__ . DS);
define('LIB_PATH', THINK_PATH . 'library' . DS);
define('CORE_PATH', LIB_PATH . 'think' . DS);
define('TRAIT_PATH', LIB_PATH . 'traits' . DS);*/
defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']) . DS);
defined('ROOT_PATH') or define('ROOT_PATH', dirname(realpath(APP_PATH)) . DS);
defined('EXTEND_PATH') or define('EXTEND_PATH', ROOT_PATH . 'extend' . DS);

defined('VENDOR_PATH') or define('VENDOR_PATH', ROOT_PATH."../../../" . 'vendor' . DS);

//defined('VENDOR_PATH') or define('VENDOR_PATH', ROOT_PATH . 'vendor' . DS);
defined('THINK_PATH') or define('THINK_PATH', VENDOR_PATH.'/topthink/thinkphp' . DS);

define('LIB_PATH', THINK_PATH . 'library' . DS);
define('CORE_PATH', LIB_PATH . 'think' . DS);
define('TRAIT_PATH', LIB_PATH . 'traits' . DS);


defined('RUNTIME_PATH') or define('RUNTIME_PATH', ROOT_PATH . 'runtime' . DS);
defined('LOG_PATH') or define('LOG_PATH', RUNTIME_PATH . 'log' . DS);
defined('CACHE_PATH') or define('CACHE_PATH', RUNTIME_PATH . 'cache' . DS);
defined('TEMP_PATH') or define('TEMP_PATH', RUNTIME_PATH . 'temp' . DS);
defined('CONF_PATH') or define('CONF_PATH', APP_PATH); // 配置文件目录
defined('CONF_EXT') or define('CONF_EXT', EXT); // 配置文件后缀
defined('ENV_PREFIX') or define('ENV_PREFIX', 'PHP_'); // 环境变量的配置前缀

// 环境常量
define('IS_CLI', PHP_SAPI == 'cli' ? true : false);
define('IS_WIN', strpos(PHP_OS, 'WIN') !== false);

/*
 * 载入微擎的配置文件
 * type  database common
 */

function load_we7_config($key=''){
    try {
        // 读取微擎数据库配置
        $config = [];

        preg_match("/addons[\\\\|\/]([a-zA-Z0-9_-]*)/",ROOT_PATH,$matchs);

        if(!empty($matchs[1])){
            $moudle_name=$matchs[1];
        }else{
            throw new Exception('没有找到模块信息');
        }

        require ROOT_PATH."../../../data/config.php";
        $config['moudle_name']=$moudle_name;

        if(!empty($key) && !empty($config[$key])){
            return $config[$key];
        }else{
            return $config;
        }
    } catch (\Exception $e) {
        header('Content-type: text/html; charset=utf-8');
        echo '读取微擎配置文件失败，需开发者协助处理。错误信息：' . $e->getMessage();
        die;
    }
}

// 载入Loader类
require CORE_PATH . 'Loader.php';

// 加载环境变量配置文件
if (is_file(ROOT_PATH . '.env')) {
    $env = parse_ini_file(ROOT_PATH . '.env', true);

    foreach ($env as $key => $val) {
        $name = ENV_PREFIX . strtoupper($key);

        if (is_array($val)) {
            foreach ($val as $k => $v) {
                $item = $name . '_' . strtoupper($k);
                putenv("$item=$v");
            }
        } else {
            putenv("$name=$val");
        }
    }
}

// 注册自动加载
\think\Loader::register();

// 注册错误和异常处理机制
\think\Error::register();

// 加载惯例配置文件
\think\Config::set(include THINK_PATH . 'convention' . EXT);
