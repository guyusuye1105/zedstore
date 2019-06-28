
<!--后台订单添加下颜色 黄色为还有半个小时到达订单预约时间 红色为已经到达订单时间但是员工没有确认到店 绿色为员工确认到店正在服务中-->

<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">订单管理</div>
                </div>
                <input type="hidden" id="dataType" value="<?= $data['datatype'] ?>">
                <div class="widget-body am-fr">
                    <!-- 工具栏 -->
                    <div class="page_toolbar am-margin-bottom-xs am-cf">
                        <form id="form-search" class="toolbar-form" action="">
                            <div class="am-u-sm-12 am-u-md-3">
                                <div class="am-form-group">
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                                <a class="j-export am-btn am-btn-success am-radius"
                                                   href="javascript:void(0);" onclick="orderInput(this)" data-url="index.php?s=/store/orders/export/">
                                                    <i class="am-icon-sign-out"></i>
                                                   订单导出
                                                </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="am-u-sm-12 am-u-md-9">
                                <div class="am fr">
                                    <div class="am-form-group tpl-form-border-form am-fl">
                                        <input type="text" name="start_time" id="start_time"
                                               class="am-form-field"
                                                placeholder="请选择起始日期"
                                               value="<?=$data['begintime']?>"
                                               data-am-datepicker>
                                    </div>
                                    <div class="am-form-group tpl-form-border-form am-fl" style="padding-left:5px">
                                        <input type="text" name="end_time" id="end_time"
                                               class="am-form-field"
                                                placeholder="请选择截止日期"
                                               value="<?=$data['endtime']?>"
                                               data-am-datepicker>
                                    </div>
                                    <div class="am-form-group am-fl" style="width:300px;padding-left:5px">
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form">
                                            <input type="text" class="am-form-field" id="keywords" placeholder="请输入关键字" value="<?=$data['keywords']?>">
                                            <div class="am-input-group-btn">
                                                <a id="search" class="am-btn am-btn-default am-icon-search" data-url="index.php?s=/store/orders/"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="order-list am-scrollable-horizontal am-u-sm-12 am-margin-top-xs">
                        <table width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>订单id</th>
                                <th>订单编号</th>
                                <th>会员昵称</th>
                                <th>会员卡号</th>
                                <th>会员手机号码</th>
                                <th>项目</th>
                                <th>价格（元）</th>
                                <th>最终价格（元）</th>
                                <th>创建时间</th>
                                <th>预约时间</th>
                                <th>预约员工</th>
                                <th>订单状态</th>
                                <th>撤单原因</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if (!$list->isEmpty()): foreach ($list as $key=>$item): ?>
                                <?php if($item['appoint_time']<(time()+1800)&&$item['appoint_time']>time() && $item['state']=='notgo'):?><!--黄色//还有半个小时到达订单预约时间-->
                                        <tr style="color:#e2e887" >
                                <?php elseif( $item['appoint_time']<time() && $item['state']=='notgo'): ?><!--红色//已经到达订单时间但是员工没有确认到店-->
                                        <tr style="color:#d47c98">
                                <?php elseif($item['state'] == 'inserver'): ?><!--绿色//员工确认到店正在服务中-->
                                        <tr style="color:#4dc17d">
                                <?php else: ?>
                                        <tr style="color:#6d7279">
                                <?php endif;?>
                                    <td class="am-text-middle" date-state="<?=$item['state']?>"><?= $item['id'] ?></td>
                                    <td class="am-text-middle"><?= $item['num'] ?></td>
                                    <td class="am-text-middle"><?= $item['user_name'] ?></td>
                                    <td class="am-text-middle"><?= $item['card'] ?></td>
                                    <td class="am-text-middle"><?= $item['user_mobile'] ?: '--' ?></td>
                                    <td class="am-text-middle">
                                        <?php
                                        $tmp = json_decode($item['item'],true);
                                        foreach($tmp as $key3=>$val3){
                                            @$tmp2[$key3] = $val3['name'];
                                        }
                                        $tmp3 = implode(';',$tmp2);
                                        ?>
                                        <?= $tmp3 ?>


                                    </td>
                                    <td class="am-text-middle"><?= $item['price'] ?: '--' ?></td>
                                    <td class="am-text-middle"><?= $item['final_price'] ?: '--' ?></td>
                                    <td class="am-text-middle"><?= $item['create_time'] ?></td>
                                    <td class="am-text-middle"><?= date('Y-m-d H:i:s',$item['appoint_time']) ?></td>
                                    <td class="am-text-middle"><?= $item['staff_name'] ?></td>
                                    <td class="am-text-middle">
                                        <?php if($item['state'] == 'notgo'):?>
                                        未到店
                                        <?php elseif($item['state'] == 'inserver'):?>
                                        服务中
                                        <?php elseif($item['state'] == 'waitmoney'):?>
                                        待支付
                                        <?php elseif($item['state'] == 'complete'):?>
                                        已完成
                                        <?php elseif($item['state'] == 'cancel'):?>
                                        已撤单
                                        <?php elseif($item['state'] == 'late'):?>
                                        已逾期
                                        <?php else:?>
                                        未知状态
                                        <?php endif;?>
                                    </td>
                                <td class="am-text-middle">
                                    <?php if( $item['why_cancel'] =='changetime'):?>
                                        换个时间  ；
                                    <?php elseif( $item['why_cancel'] =='havething'):?>
                                        我有急事  ；
                                    <?php elseif( $item['why_cancel'] =='notwant'):?>
                                        我不想做了；
                                        <?php endif;?>
                                    <?= $item['cancel_remark'] ?>
                                </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr >
                                    <td colspan="13" class="am-text-center">暂无记录</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="am-u-lg-12 am-cf">
                        <div class="am-fr"><?= $list->render() ?> </div>
                        <div class="am-fr pagination-total am-margin-right">
                            <div class="am-vertical-align-middle">总记录：<?= $list->total() ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(function () {
        /**
         * 点击搜索
         * */
        $('#search').bind('click',function(){
            var keywords = $('#keywords').val();
            var datatype = $('#dataType').val();
            var start_time = $('#start_time').val();
            var end_time = $('#end_time').val();
            var url = $(this).data('url') +  datatype + '/keywords/' + keywords + '/begintime/' + start_time + '/endtime/'+end_time;
            window.location.href = url;
        });

    });

    function orderInput(e){
        var keywords = $('#keywords').val();
        var datatype = $('#dataType').val();
        var start_time = $('#start_time').val();
        var end_time = $('#end_time').val();
        var url = $(e).data('url') + 'datatype/' + datatype + '/keywords/' + keywords + '/begintime/' + start_time + '/endtime/'+end_time;
        window.location = url;

    }

</script>

