<?php

namespace app\common\model;

use think\Model;
use think\Request;
use think\Session;

/**
 * 模型基类
 * Class BaseModel
 * @package app\common\model
 */
class BaseModel extends Model
{
    public static $wxapp_id;
    public static $base_url;
    public static $map;

    /**
     * 模型基类初始化
     */
    public static function init()
    {
        parent::init();
        // 获取当前域名
        self::$base_url = base_url();
        // 后期静态绑定wxapp_id
        self::bindWxappId();
        // lichenjie 查询条件
        self::map();
    }

    // lichejie
    //  获取通用查询条件
    private static function map()
    {
        // 通用查询条件 0
        self::$map[0]['wxapp_id'] =  ['=',self::$wxapp_id];
        // 通用查询条件 1
        self::$map[1]['wxapp_id'] =  ['=',self::$wxapp_id];
        self::$map[1]['is_delete'] = ['=',0];
        // 通用查询条件 2
        self::$map[2]['wxapp_id'] =  ['=',self::$wxapp_id];
        self::$map[2]['is_delete'] =  ['=',1];
    }

    /**
     * 后期静态绑定类名称
     * 用于定义全局查询范围的wxapp_id条件
     * 子类调用方式:
     *   非静态方法:  self::$wxapp_id
     *   静态方法中:  $self = new static();   $self::$wxapp_id
     * @param $calledClass
     */
    private static function bindWxappId()
    {
        /*
        $class = [];
        if (preg_match('/app\\\(\w+)/', $calledClass, $class)) {
            $callfunc = 'set' . ucfirst($class[1]) . 'WxappId';
            method_exists(new self, $callfunc) && self::$callfunc();
        }
        */
        if ($module = self::getCalledModule()) {
            $callfunc = 'set' . ucfirst($module) . 'WxappId';
            method_exists(new self, $callfunc) && self::$callfunc();
        }
    }

    /**
     * 设置wxapp_id (store模块)
     */
    protected static function setStoreWxappId()
    {
        $session = Session::get('demo1');
        self::$wxapp_id = $session['wxapp']['wxapp_id'];
    }

    /**
     * 设置wxapp_id (api模块)
     */
    protected static function setApiWxappId()
    {
        $request = Request::instance();
        self::$wxapp_id = $request->param('wxapp_id');
    }
    /**
     * 设置wxapp_id (apo模块)
     */
    protected static function setApoWxappId()
    {
        $request = Request::instance();
        self::$wxapp_id = $request->param('wxapp_id');
    }

    /**
     * 获取当前域名
     * @return string
     */
    protected static function baseUrl()
    {
        $request = Request::instance();
        $host = $request->scheme() . '://' . $request->host();
        $dirname = dirname($request->baseUrl());
        return empty($dirname) ? $host : $host . $dirname . '/';
    }

    /**
     * 定义全局的查询范围
     * @param \think\db\Query $query
     */
    protected function base($query)
    {
        if (self::$wxapp_id > 0) {
            $query->where($query->getTable() . '.wxapp_id', self::$wxapp_id);
        }
    }



    /**
     * [delDataById 根据id删除数据]
     * @linchuangbin
     * @DateTime  2017-02-11T20:57:55+0800
     * @param     string                   $id     [主键]
     * @param     boolean                  $delSon [是否删除子孙数据]
     * @return    [type]                           [description]
     */
    public function delDataById($id = '', $delSon = false)
    {
        $this->startTrans();
        try {
            $this->where($this->getPk() ,'in', $id)->delete();
            if ($delSon && is_numeric($id)) {
                // 删除子孙
                $childIds = $this->getAllChild($id);
                if($childIds){
                    $this->where($this->getPk(), 'in', $childIds)->delete();
                }
            }
            $this->commit();
            return true;
        } catch(\Exception $e) {
            $this->error = '删除失败';
            $this->rollback();
            return false;
        }
    }

    /**
     * [getDataById 根据主键获取详情]
     * @linchuangbin
     * @DateTime  2017-02-10T21:16:34+0800
     * @param     string                   $id [主键]
     * @return    [array]
     */
    public function getDataById($id = '')
    {
        $data = $this->get($id);
        if (!$data) {
            $this->error = '暂无此数据';
            return false;
        }
        return $data;
    }

    /**
     * [createData 新建]
     * @linchuangbin
     * @DateTime  2017-02-10T21:19:06+0800
     * @param     array                    $param [description]
     * @return    [array]                         [description]
     */
    public function createData($param)
    {
        // 验证
      /*  $validate = validate($this->name);
        if (!$validate->check($param)) {
            $this->error = $validate->getError();
            return false;
        }*/
        $param['wxapp_id'] = self::$wxapp_id;
        try {
            $this->data($param)->allowField(true)->save();
            return true;
        } catch(\Exception $e) {
            $this->error = '添加失败';
            return false;
        }
    }

    /**
     * 新建
     * @author lichenjie
     */
    public function createDataGetId($param)
    {

        // 验证
        /*$validate = validate($this->name);
        if (!$validate->check($param)) {
            $this->error = $validate->getError();
            return false;
        }*/
        $param['wxapp_id'] = self::$wxapp_id;
        try {
            $id = $this->insertGetId($param);
            return $id;
        } catch(\Exception $e) {
            $this->error = '添加失败';
            return false;
        }
    }

    /**
     * [updateDataById 编辑]
     * @linchuangbin
     * @DateTime  2017-02-10T21:24:49+0800
     * @param     [type]                   $param [description]
     * @param     [type]                   $id    [description]
     * @return    [type]                          [description]
     */
    public function updateDataById($param, $id)
    {
       /* $checkData = $this->get($id);
        if (!$checkData) {
            $this->error = '暂无此数据';
            return false;
        }*/
        // 验证
       /* $validate = validate($this->name);
        if (!$validate->check($param)) {
            $this->error = $validate->getError();
            return false;
        }*/
       if(!isset($param['wxapp_id'])){
           $param['wxapp_id'] = self::$wxapp_id;
       }
        try {
            $this->allowField(true)->save($param, [$this->getPk() => $id]);
            return true;
        } catch(\Exception $e) {
            $this->error = '编辑失败';
            return false;
        }
    }

    /**
     * 获取当前调用的模块名称
     * 例如：admin, api, store, task
     * @return string|bool
     */
    protected static function getCalledModule()
    {
        if (preg_match('/app\\\(\w+)/', get_called_class(), $class)) {
            return $class[1];
        }
        return false;
    }

    public function defaults()
    {
        p($this);
    }

}
