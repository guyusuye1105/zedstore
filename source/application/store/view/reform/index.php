<div class="page-home row-content am-cf">
    <!-- 工具栏 -->
    <div class="row">
            <div class="am-cf">
                <div class="am fr">
                    <div class="am-form-group tpl-form-border-form am-fl">
                        <input type="text" name="start_time" id="begintime"
                               class="am-form-field"
                               placeholder="请选择起始日期"
                               value="<?=$data['begintime']?>"
                               data-am-datepicker>
                    </div>
                    <div class="am-form-group tpl-form-border-form am-fl" style="padding-left:5px">
                        <input type="text" name="end_time" id="endtime"
                               class="am-form-field"
                               placeholder="请选择截止日期"
                               value="<?=$data['endtime']?>"
                               data-am-datepicker>
                    </div>
                    <div class="am-form-group tpl-form-border-form am-fl" style="width:100px;padding-left:5px">
                        <div class="am-input-group am-input-group-sm tpl-form-border-form">
                            <div class="am-input-group-btn">
                                <a id="search" class="am-btn am-btn-default am-icon-search" data-url="index.php?s=/store/reform/index"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <!-- 订单统计（已完成） -->
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12 am-margin-bottom">
            <div class="widget am-cf">
                <div class="widget-head">
                    <div class="widget-title">订单统计（已完成）</div>
                </div>
                <div class="widget-body am-cf">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6 order-list">
                            <table class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                                <thead>
                                <tr>
                                    <th>订单类型</th>
                                    <th>订单量</th>
                                    <th>比例</th>
                                </tr>
                                </thead>
                                <?php if(empty($list['order'])) :?>
                                    <tbody>
                                    <tr style="color:#6d7279">
                                        <td class="am-text-middle" colspan="3" >暂无数据！</td>
                                    </tr>
                                    <tbody>
                                <?php else :?>
                                <tbody>
                                <tr style="color:#6d7279">
                                    <td class="am-text-middle" >有效预约订单</td>
                                    <td class="am-text-middle"><?= $list['order']['appoint']['count']?></td>
                                    <td class="am-text-middle"><?= $list['order']['appoint']['percent']?></td>
                                </tr>
                                <tr style="color:#6d7279">
                                    <td class="am-text-middle" >有效到店订单</td>
                                    <td class="am-text-middle"><?= $list['order']['instore']['count']?></td>
                                    <td class="am-text-middle"><?= $list['order']['instore']['percent']?></td>
                                </tr>
                                <tr style="color:#6d7279">
                                    <td class="am-text-middle" >撤单</td>
                                    <td class="am-text-middle"><?= $list['order']['cancel']['count']?></td>
                                    <td class="am-text-middle"><?= $list['order']['cancel']['percent']?></td>
                                </tr>
                                <tr style="color:#6d7279">
                                    <td class="am-text-middle" >总订单</td>
                                    <td class="am-text-middle"><?= $list['order']['total']?></td>
                                    <td class="am-text-middle"></td>
                                </tr>
                                <tr style="color:#6d7279">
                                    <td class="am-text-middle" >有效订单</td>
                                    <td class="am-text-middle"><?= $list['order']['valid']?></td>
                                    <td class="am-text-middle"></td>
                                </tr>
                                </tbody>
                                <?php endif;?>
                            </table>

                    </div>

                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                        订单统计图
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- 员工营业额统计 -->
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12 am-margin-bottom">
            <div class="widget am-cf">
                <div class="widget-head">
                    <div class="widget-title">员工营业额统计</div>
                </div>

                <div class="widget-body am-cf">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6 order-list">
                        <table class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>员工姓名</th>
                                <th>完成订单量</th>
                                <th>收入金额（元）</th>
                                <th>收入比例</th>
                            </tr>
                            </thead>
                            <?php if(empty($list['staffMoney'])) :?>
                                <tbody>
                                <tr style="color:#6d7279">
                                    <td class="am-text-middle" colspan="4" >暂无数据！</td>
                                </tr>
                                <tbody>
                            <?php else :?>
                            <tbody>
                            <tr style="color:#6d7279">
                                <td class="am-text-middle" >总计</td>
                                <td class="am-text-middle"><?= $list['staffMoney'][0]['count']?></td>
                                <td class="am-text-middle"><?= sprintf("%.2f",$list['staffMoney'][0]['money'])?></td>
                                <td class="am-text-middle"></td>
                            </tr>
                            <?php foreach($list['staffMoney'][1] as $key=>$val) :?>
                            <tr style="color:#6d7279">
                                <td class="am-text-middle" ><?= $val['name']?></td>
                                <td class="am-text-middle"><?= $val['count']?></td>
                                <td class="am-text-middle"><?= sprintf("%.2f",$val['money'])?></td>
                                <td class="am-text-middle"><?= $val['percent']?></td>
                            </tr>
                            <?php endforeach;?>

                            </tbody>
                            <?php endif;?>
                        </table>

                    </div>

                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                        员工营业额统计
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- 项目订单量统计 -->
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12 am-margin-bottom">
            <div class="widget am-cf">
                <div class="widget-head">
                    <div class="widget-title">项目订单量统计</div>
                </div>

                <div class="widget-body am-cf">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6 order-list">
                        <table class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>类别</th>
                                <th>项目</th>
                                <th>订单量</th>
                                <th>订单占比</th>
                            </tr>
                            </thead>
                            <?php if(empty($list['item'])) :?>
                                <tbody>
                                <tr style="color:#6d7279">
                                    <td class="am-text-middle" colspan="4" >暂无数据！</td>
                                </tr>
                                <tbody>
                            <?php else :?>
                                <tbody>
                                <tr style="color:#6d7279">
                                    <td class="am-text-middle" >总计</td>
                                    <td class="am-text-middle"></td>
                                    <td class="am-text-middle"><?= $list['item']['total']['count']?></td>
                                    <td class="am-text-middle"></td>
                                </tr>
                                <?php foreach($list['item']['content'] as $key=>$val) :?>
                                        <?php foreach($val['son'] as $key2=>$val2):?>
                                        <tr style="color:#6d7279">
                                            <?php if($key2 == 0):?>
                                                <td class="am-text-middle" rowspan="<?= count($val['son'])?>"><?= $val['name']?></td>
                                            <?php endif;?>
                                            <td class="am-text-middle"><?= $val2['name']?></td>
                                            <td class="am-text-middle"><?= $val2['count']?></td>
                                            <td class="am-text-middle"><?= $val2['percent']?></td>
                                        </tr>
                                        <?php endforeach;?>

                                <?php endforeach;?>

                                </tbody>
                            <?php endif;?>
                        </table>

                    </div>

                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                        项目订单量统计
                    </div>










                </div>
            </div>
        </div>
    </div>

</div>



<script type="text/javascript">
    //点击搜索
    $('#search').bind('click',function(){
        var begintime = $('#begintime').val();
        var endtime = $('#endtime').val();
        var url = $(this).data('url') +  '/begintime/' + begintime + '/endtime/'+endtime;
        window.location.href = url;
    });

</script>