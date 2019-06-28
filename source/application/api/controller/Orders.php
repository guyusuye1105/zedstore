<?php

namespace app\api\controller;

use app\api\model\Orders as OrdersModel;
use app\api\model\Wxapp as WxappModel;
use app\api\model\Cart as CartModel;
use app\common\library\wechat\WxPay;
use app\api\model\WxappPrepayId as WxappPrepayIdModel;

/**
 * 订单控制器
 * Class Order
 * @package app\api\controller
 */
class Orders extends Controller
{
    /* @var \app\api\model\User $user */
    private $user;

    /**
     * 构造方法
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->user = $this->getUser();   // 用户信息
    }

    /**
     * @api {post} api/orders/getLists 获取订单
     * @apiName oredersgetListsn
     * @apiGroup 订单
     * @apiDescription 获取订单
     * @apiParam    {int}   user_id   会员id
     * @apiParam    {String}    state   订单状态（不填显示全部，ing表示进行中订单（包含未到店服务中已完成），complete已完成 cancel已撤单 late已逾期）
     * @apiParam    {String}    token
     * @apiParam    {String}    begintime   订单起始时间(2011-11-11)
     * @apiParam    {String}    endtime 订单结束时间(2018-11-11)
     * @apiParam    {String}    page   页码（非空）
     * @apiParam    {String}    pagesize    页数（非空）
     ** @apiUse  oredersgetLists
     */
    function getLists(){
        $post = $this->request->post();
        $model = new OrdersModel;
        $user_id = isset($post['user_id']) ? $post['user_id'] : '';
        $state = isset($post['state']) ? $post['state'] : '';
        $begintime = !empty($post['begintime']) ? strtotime($post['begintime']) : '';
        $endtime = !empty($post['endtime']) ? strtotime($post['endtime']) : '';
        if(empty($post['page'])){die('缺少参数page');}
        if(empty($post['pagesize'])){die('缺少参数pagesize');}
        $list = $model->getlists($user_id,$state,$begintime,$endtime,$post['page'],$post['pagesize']);
        return $this->renderSuccess(['list' => $list]);
    }

    /**
     * @api {post} api/orders/addLists 新增店内订单
     * @apiName oredersaddListsn
     * @apiGroup 订单
     * @apiDescription 新增店内订单
     * @apiParam    staff_id    员工id
     * @apiParam    item_id 项目id(格式1;3;4)
     * @apiParam    user_id 用户id
     * @apiParam    remark 备注
     * @apiParam    token   用户标识
     ** @apiUse  oredersaddLists
     */
    function addLists(){
        $post = $this->request->post();
        $model = new OrdersModel;
        $data['staff_id'] = isset($post['staff_id']) ? $post['staff_id'] : die('缺少参数staff_id');
        $data['item_id']  = (!empty($post['item_id'])&&$post['item_id']!='undefined') ? $post['item_id'] : die('店内订单必须选择一个项目');
        $data['user_id']  = isset($post['user_id']) ? $post['user_id'] : '';
        $data['remark']  = isset($post['remark']) ? $post['remark'] : '';
        $data['type']  = 'instore';
        $data['state']  = 'inserver';
        $data['appoint_time']  = time();
        $res = $model->addList($data);
        if($res){
            return $this->renderSuccess('新增订单成功');
        }else{
            return $this->renderError('新增订单失败');
        }
    }
    /**
     * @api {post} api/orders/updateProject 更新项目
     * @apiName oredersupdateProject
     * @apiGroup 订单
     * @apiDescription 更新订单内容
     * @apiParam    id   订单id
     * @apiParam    item_id 项目id(格式1;3;4)
     * @apiParam    remark 备注
     * @apiParam    token   用户标识
     * @apiParam    wxapp_id
     */
    function updateProject(){
        $post = $this->request->post();
        $model = new OrdersModel;
        $id = !empty($post['id']) ? $post['id'] : die('缺少参数id');
        $data['item_id']  = (!empty($post['item_id'])&&$post['item_id']!='undefined') ? $post['item_id'] : die('店内订单必须选择一个项目');
        $data['remark']  = isset($post['remark']) ? $post['remark'] : '';
        $res = $model->updateList($data,$id);
        if($res){
            return $this->renderSuccess('更新项目成功');
        }else{
            return $this->renderError('更新项目失败');
        }
    }
    /**
     * @api {post} api/orders/cancelorder 申请撤单
     * @apiName orederscancelordern
     * @apiGroup 订单
     * @apiDescription 顾客申请撤单,撤单成功不会返回当前订单状态，手动修改订单状态为cancel就好了
     * @apiParam    id    订单id（非空）
     * @apiParam    why_cancel 撤单原因(changetime换个时间 havething我有急事 notwant我不想做了)（非空）
     * @apiParam    cancel_remark 撤单备注（空）
     * @apiParam    token   用户标识（非空）
     ** @apiUse  orederscancelorder
     */
    function cancelOrder(){
        $post = $this->request->post();
        $model = new OrdersModel;
        $id = isset($post['id']) ? $post['id'] : die('缺少参数id');
        $data['why_cancel'] = isset($post['why_cancel']) ? $post['why_cancel'] : die('缺少参数why_cancel');
        $data['cancel_remark'] = isset($post['cancel_remark']) ? $post['cancel_remark'] : '';
        $data['state'] = 'cancel';
        $res = $model->updateDataById($data,$id);
        // $list = $model->getDataById($id);
        if($res){
            return $this->renderSuccess('撤单成功');
        }else{
            return $this->renderError('撤单失败');
        }
    }
    /**
     * @api {post} api/orders/pay 结单
     * @apiName orederspayn
     * @apiGroup 订单
     * @apiDescription 用户结单
     * @apiParam    id    订单id（非空）
     * @apiParam    final_price 最终支付价格
     * @apiParam    token
     ** @apiUse  orederspay
     */
    /*
    function pay(){
        $post = $this->request->post();
        $model = new OrdersModel;
        $id = (!empty($post['id'])&&$post['id']!='undefined') ? $post['id'] : die('缺少参数id');
        $data['final_price'] = isset($post['final_price']) ? $post['final_price'] : die('缺少参数final_price');
        $data['state'] = 'complete';
        $res = $model->updateDataById($data,$id);
        // $list = $model->getDataById($id);
        if($res){
            return $this->renderSuccess('结单成功');
        }else{
            return $this->renderError('结单失败');
        }
    }
    */
    function pay(){
        $post = $this->request->post();
        $model = new OrdersModel;
        $id = (!empty($post['id'])&&$post['id']!='undefined') ? $post['id'] : die('缺少参数id');
        $order = $model->getDataById($id);
        //$data['final_price'] = isset($post['final_price']) ? $post['final_price'] : die('缺少参数final_price');
        //$data['state'] = 'complete';
        //$model->updateDataById($data,$id);
       // $payment = $this->unifiedorder($order, $this->user);
        if($order){
            // 发起微信支付
            return $this->renderSuccess([
                'payment' => $this->unifiedorder($order, $this->user),
                'order_id' => $id
            ]);

        }
        $error = $model->getError() ?: '订单创建失败';
        return $this->renderError($error);
    }

    /**
     * 构建微信支付
     * @param $order
     * @param $user
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    private function unifiedorder($order, $user)
    {
        // 统一下单API
        $wxConfig = WxappModel::getWxappCache();
        $WxPay = new WxPay($wxConfig);
        $payment = $WxPay->unifiedorder($order['num'], $user['open_id'], $order['final_price']);
        // 记录prepay_id
        $model = new WxappPrepayIdModel;
       // dump($payment['prepay_id'], $order['id'], $user['user_id']);die;
        $model->add($payment['prepay_id'], $order['id'], $user['user_id'], 10);
        return $payment;
    }





}
