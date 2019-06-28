<?php

namespace app\common\model;

use think\Request;
use traits\model\SoftDelete;
use think\Db;
use app\common\library\storage\Driver as StorageDriver;
use think\Config;

/**
 * 文件库模型
 * Class UploadFile
 * @package app\common\model
 */
class UploadFile extends BaseModel
{
    use SoftDelete;

    protected $name = 'upload_file';
    protected $updateTime = false;
    protected $deleteTime = false;
    protected $append = ['file_path'];

    /**
     * 获取图片完整路径
     * @param $value
     * @param $data
     * @return string
     */
    public function getFilePathAttr($value, $data)
    {
        if ($data['storage'] === 'local') {
            return self::$base_url . 'uploads/' . $data['file_name'];
        }
        return $data['file_url'] ;//lichenjie 2018-11-27
        //return $data['file_url'] . '/' . $data['file_name'];
    }

    /**
     * 根据文件名查询文件id
     * @param $fileName
     * @return mixed
     */
    public static function getFildIdByName($fileName)
    {
        return (new static)->where(['file_name' => $fileName])->value('file_id');
    }

    /**
     * 查询文件id
     * @param $fileId
     * @return mixed
     */
    public static function getFileName($fileId)
    {
        return (new static)->where(['file_id' => $fileId])->value('file_name');
    }

    /**
     * 获取列表记录
     * @param $group_id
     * @param string $file_type
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList($group_id, $file_type = 'image')
    {
        $model = $this->where(['file_type' => $file_type, 'is_delete' => 0]);
        if ($group_id !== -1) {
            $model->where(compact('group_id'));
        }
        return $model->order(['file_id' => 'desc'])
            ->paginate(32, false, [
            'query' => Request::instance()->request()
        ]);
    }

    /**
     * 根据文件id获得文件详细地址
     * @param $ids
     * @param string $file_type
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    function getUrlById($ids,$file_type = 'image'){
        $arr = array();
        foreach($ids as $key=>$val){
            // 判断是id 还是url地址
            if(is_numeric( $val)) {
                $a = Db::name($this->name)->where(['file_type' => $file_type, 'is_delete' => 0, 'file_id' => $val])
                    ->find();
                $url = $this->getFilePathAttr('', $a);
            }else{
                $url = $val;
            }
            $arr[$key] = $url;
        }
        $result = implode(';',$arr);
        return $result;
    }

    /**
     * 更新图片模型层
     * @author lichenjie
     */
    function myUpdateFile(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $file = Request::instance()->file('iFile');

        if (empty($file)) {
            return array('code'=>'0','msg' => '参数错误，图片上传失败#1');
        }

        // 实例化存储驱动
        $StorageDriver = new StorageDriver(Config::get('upload'));
        // 上传图片
        if (!$StorageDriver->upload())
            return array('code'=>'0','msg' => '图片上传失败' . $StorageDriver->getError());
        // 图片上传路径
        $fileName = $StorageDriver->getFileName();
        // 图片信息
        $fileInfo = $StorageDriver->getFileInfo();

        // 添加文件库记录
        //$uploadFile = $this->addUploadFile(-1, $fileName, $fileInfo, 'image');

        // 存储引擎
        $storage = Config::get('upload')['default'];
        // 存储域名
        // $fileUrl = isset($this->config['engine'][$storage]) ? $this->config['engine'][$storage]['domain'] : '';
        // 添加文件库记录
        $this->add([
            'group_id' => -1,
            'storage' => $storage,
            'file_url' => $this->getFileUrl($fileName),
            'file_name' => $fileName,
            'file_size' => $fileInfo['size'],
            'file_type' => 'image',
            'extension' => pathinfo($fileInfo['name'], PATHINFO_EXTENSION),
        ]);
        // 图片上传成功
        return array('code'=>'1','msg' => '图片上传成功','data'=>$this->toArray());
    }

    private function getFileUrl($fileName){
        $config=Config::get('upload');
        $storage = Config::get('upload')['default'];

        $oss_conf=$config['engine'][$storage];
        if(!empty($oss_conf['domain_alias'])){
            $host=$oss_conf['domain_alias'];
        }else{
            $host=$oss_conf['domain'];
        }
        return "https://".$host."/".$oss_conf['oss_path']."/".$fileName;
    }

}
