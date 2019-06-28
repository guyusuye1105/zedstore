<?php

namespace app\api\controller;

use app\api\model\Appoint as AppointModel;
use app\api\model\Orders as OrdersModel;

/**
 * 门店
 */
class Appoint extends Controller
{
    /**
     * @api {post} api/appoint/gettimestrip 获取时间段
     * @apiName appointgetTimeStripname
     * @apiGroup 预约
     * @apiPermission none
     * @apiDescription 获取预约某天某个服务员时间段
     ** @apiUse  appointgetTimeStrip
     */
    public function getTimeStrip()
    {
        $post = $this->request->post();
        if(!empty($post['day'])){
            $day = strtotime(date($post['day']));
        }else{
            die('缺少参数day');
            //return $this->renderError('缺少参数day');
        }
        // 员工ID
        if(!empty($post['staff_id'])&&$post['staff_id']!='undefined'){
            $staff_id = $post['staff_id'];
        }else{
            $staff_id = '';
        }
        $model = new AppointModel;
        $list = $model->getTimeStrip($day,$staff_id);
        return $this->renderSuccess(compact('list'));
    }
    /**
     * @api {post} api/appoint/getstaff 获取员工
     * @apiName appointgetstaffn
     * @apiGroup 预约
     * @apiPermission none
     * @apiDescription 获取预约某天某个时间段员工
     ** @apiUse  appointgetstaff
     */
    public function getStaff(){
        $post = $this->request->post();
        $model = new AppointModel;
        if(!empty($post['timeduan'])){
            $timeduan = $post['timeduan'];
        }else{
            die('缺少参数timeduan');
        }
        if(!empty($post['day'])){
            $day = strtotime(date($post['day']));
        }else{
            die('缺少参数day');
            //return $this->renderError('缺少参数day');
        }
        $list = $model->getStaff($day,$timeduan);
        return $this->renderSuccess(compact('list'));
    }
    /**
     * @api {post} api/appoint/appoint 预约
     * @apiName appointappointn
     * @apiGroup 预约
     * @apiParam {Int} user_id  会员id
     * @apiParam {Int} staff_id 服务人员id
     * @apiParam {Int} content_type 预约类型
     * @apiParam {Int} content 预约内容（预约项目的id，用;分割）
     * @apiParam {Int} appoint_time 预约时间（2018-11-11）
     * @apiParam {Int} timeduan_id 时间段id(预约需要传时间段id)
     * @apiParam {string} token 标识
     * @apiDescription 保存预约信息预约
     ** @apiUse  appointappoint
     */
    function appoint(){
        $this->getUser();   // 用户信息
        $post = $this->request->post();
        $model = new AppointModel;
        $data['user_id'] = $post['user_id'];
        $data['staff_id'] = $post['staff_id'];
        $data['content_type'] = $post['content_type'];
        $data['content'] = $post['content']!='undefined'? $post['content']:'';
        $data['appoint_time'] = strtotime(date($post['appoint_time']));
        $data['timeduan_id'] = $post['timeduan_id'];
        $list = $model->appoint($data);
        if($list){
            /*
            $ordersmodel = new OrdersModel;
            // 预约成功的话把数据写入订单表
            $data2['staff_id'] = isset($post['staff_id']) ? $post['staff_id'] : '';
            $data2['item_id'] = (isset($post['content']) && $post['content']!='undefined') ? $post['content'] : '';
            $data2['user_id'] = isset($post['user_id']) ? $post['user_id'] : '';
            $data2['remark'] = isset($post['remark']) ? $post['remark'] : '';
            $tmp = $model->byTimeDuanGetTime($post['timeduan_id']);
            $data2['appoint_time'] = $data['appoint_time'] + $tmp['begin_time'];
            $data2['type'] = 'appoint';
            $data2['state'] = 'notgo';
            $data2['price'] = $ordersmodel->getPrice($post['content']);
            $data2['final_price'] = $data2['price'];
            $data2['num'] = $ordersmodel->orderNo();
            if($ordersmodel->createData($data2)){
                return $this->renderSuccess('预约成功');
            }else{
                return $this->renderError('出现未知错误，预约成功，但是无法建立订单');
            }
            */
            $ordersmodel = new OrdersModel;
            // 预约成功的话把数据写入订单表
            $data2['staff_id'] = isset($post['staff_id']) ? $post['staff_id'] : '';
            $data2['item_id'] = (isset($post['content']) && $post['content']!='undefined') ? $post['content'] : '';
            $data2['user_id'] = isset($post['user_id']) ? $post['user_id'] : '';
            $data2['remark'] = isset($post['remark']) ? $post['remark'] : '';
            $tmp = $model->byTimeDuanGetTime($post['timeduan_id']);
            $data2['appoint_time'] = $data['appoint_time'] + $tmp['begin_time'];
            $data2['type'] = 'appoint';
            $data2['state'] = 'notgo';
            if($ordersmodel->addList($data2)){
                return $this->renderSuccess('预约成功');
            }else{
                return $this->renderError('出现未知错误，预约成功，但是无法建立订单');
            }

        }else{
            return $this->renderError('对不起，预约失败，请重试');
        }

    }



}
