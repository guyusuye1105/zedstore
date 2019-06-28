<?php

namespace app\apo\controller;
use app\apo\model\Orders as OrdersModel;


/**
 * 门店
 */
class Orders extends Controller
{
    /**
     * @api {post} apo/orders/workStation 显示工作台订单
     * @apiName ordersworkStationn
     * @apiGroup 工作台
     * @apiParam    page    第几页（非空）
     * @apiParam    pagesize    每页个数（非空）
     * @apiParam    staff_id 当前服务员id
     * @apiDescription 显示工作台订单
     **@apiUse  ordersworkStation
     */
    public function workStation()
    {
        $post = $this->request->post();
        $model = new OrdersModel;
        $begintime = strtotime(date('Y-m-d',time()));
        $endtime = $begintime;
        if(isset($post['page'])) {$page = $post['page'];}else{die('缺少参数page');}
        if(isset($post['pagesize'])) {$pagesize = $post['pagesize'];}else{die('缺少参数pagesize');}
        if(isset($post['staff_id'])) {$staff_id = $post['staff_id'];}else{die('缺少参数staff_id');}
        $state = 'ing';
        $list = $model->getOrders($begintime,$endtime,$page,$pagesize,$state,$staff_id,'asc');
        return $this->renderSuccess(['list' => $list]);
    }

    /**
     * @api {post} apo/orders/getOrders 获取订单
     * @apiName ordersgetOrdersn
     * @apiGroup 订单
     * @apiParam    page    第几页（非空）
     * @apiParam    pagesize    每页个数（非空）
     * @apiParam    staff_id 当前服务员id（非空）
     * @apiParam    begintime 开始时间点（空）
     * @apiParam    endtime 结束时间点（空）
     * @apiParam    state 订单状态（不填显示全部，ing表示进行中订单（包含未到店服务中已完成），complete已完成 cancel已撤单 late已逾期）
     * @apiDescription 获取订单
     **@apiUse  ordersgetOrders
     */
    public function getOrders()
    {
        $post = $this->request->post();
        $model = new OrdersModel;
        $begintime = empty($post['begintime']) ? '': strtotime($post['begintime']);
        $endtime = empty($post['endtime']) ? '' : strtotime($post['endtime']) ;
        if(isset($post['page'])) {$page = $post['page'];}else{die('缺少参数page');}
        if(isset($post['pagesize'])) {$pagesize = $post['pagesize'];}else{die('缺少参数pagesize');}
        if(isset($post['staff_id'])) {$staff_id = $post['staff_id'];}else{die('缺少参数staff_id');}
        $state = isset($post['state']) ? $post['state'] : '';
        $list = $model->getOrders($begintime,$endtime,$page,$pagesize,$state,$staff_id);
        return $this->renderSuccess(['list' => $list]);
    }
    /**
     * @api {post} apo/orders/isInStore 确认到店
     * @apiName ordersisInStoren
     * @apiGroup 工作台
     * @apiParam    id    订单id（非空）
     * @apiDescription 确认到店
     **@apiUse  ordersisInStore
     */
    public function isInStore()
    {
        $post = $this->request->post();
        $model = new OrdersModel;
        if(isset($post['id'])) {$id = $post['id'];}else{die('缺少参数id');}
        $data['state'] = 'inserver';
        $list = $model->updateDataById($data,$id);
        $res = $model->getDataById($id);
        if($list){
            return $this->renderSuccess(['list'=>$res]);
        }else{
            return $this->renderSuccess('操作失败');
        }
    }
    /**
     * @api {post} apo/orders/updateItem 更新订单
     * @apiName ordersupdateItemn
     * @apiGroup 工作台
     * @apiParam    id    订单id（非空）
     * @apiParam    price    订单总价(非空)
     * @apiParam    addserver    附加服务（空）
     * @apiParam    discount    折扣（空）
     * @apiDescription 更新订单
     **@apiUse  ordersupdateItem
     */
    public function updateItem()
    {
        $post = $this->request->post();
        $model = new OrdersModel;
        $data = array();
        if(isset($post['id'])) {$id = $post['id'];}else{die('缺少参数id');}
        if(empty($post['addserver'])) {
            $addserver = 0;
            $data['addserver'] = 0;
        } else{
            $data['addserver'] = $post['addserver'];
            $addserver = $post['addserver'];
        }
        if(isset($post['discount'])) {$data['discount'] = $post['discount'];}
        if(empty($post['discount'])) {$discount = 10;} else{ $discount = $post['discount'];}
        $data['final_price'] = $post['price']*$discount/10 + $addserver;
        $data['state'] = 'waitmoney';
        $list = $model->updateDataById($data,$id);//getDataById
        $res = $model->getDataById($id);
        $res['item'] = json_decode($res['item'],true);
        if($list){
            return $this->renderSuccess(['list'=>$res]);
        }else{
            return $this->renderSuccess('操作失败');
        }
    }

    /**
     * @api {post} apo/orders/pay 其他方式结单
     * @apiName orederspayn
     * @apiGroup 订单
     * @apiDescription 其他方式结单
     * @apiParam    id    订单id（非空）
     * @apiParam    final_price 最终支付价格
     * @apiParam    wxapp_id
     */
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


}