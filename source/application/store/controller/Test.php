<?php

namespace app\store\controller;

use app\store\model\Test as TestModel;
use think\config;

/**
 * 商品管理控制器
 * Class Goods
 * @package app\store\controller
 */
class Test extends Controller
{

    public function index()
    {
        $model = new TestModel;
        $list = $model->getList();
        return $this->fetch('index');
    }

    public function add()
    {
        //获取到临时文件
        $file=$_FILES['file'];
        p($file['tmp_name']);
        //获取文件名
        $fileName=$file['name'];
        //移动文件到当前目录
       // move_uploaded_file($file['tmp_name'],$fileName);
    }



}
