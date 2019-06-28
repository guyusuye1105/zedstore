<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">会员管理</div>
                </div>

                <div class="widget-body am-fr">

                    <div class="page_toolbar am-margin-bottom-xs am-cf">
                    <div class="am-form-group am-fl" style="width:300px;padding-left:5px;float:right">
                        <div class="am-input-group am-input-group-sm tpl-form-border-form">
                            <input type="text" class="am-form-field" id="search1" placeholder="请输入关键字" value="<?=$data['keywords']?>">
                            <div class="am-input-group-btn">
                                <a id="search" class="am-btn am-btn-default am-icon-search" data-url="index.php?s=/store/user/index"></a>
                            </div>
                        </div>
                    </div>
                    </div>

                    <hr>


                    <div class="am-scrollable-horizontal am-u-sm-12">
                        <table id="project_table" width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>会员头像</th>
                                <th>会员昵称</th>
                                <th>会员卡号</th>
                                <th>会员手机号码</th>
                                <th>成为会员时间</th>
                                <th>性别</th>
                                <th>生日</th>
                                <th>消费次数</th>
                                <th>消费金额</th>


                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($list)): foreach ($list as $item): ?>
                                <tr >
                                    <td class="am-text-middle"><?= $item['user_id'] ?></td>
                                    <td class="am-text-middle">
                                            <img src="<?= $item['avatarUrl'] ?>" width="50" height="50" alt="项目图片">
                                    </td>
                                    <td class="am-text-middle"><?= $item['nickName'] ?></td>
                                    <td class="am-text-middle"><?= $item['card'] ?></td>
                                    <td class="am-text-middle"><?= $item['mobile'] ?></td>
                                    <td class="am-text-middle"><?= $item['create_time'] ?></td>
                                    <td class="am-text-middle"><?= $item['gender'] ?></td>
                                    <td class="am-text-middle"><?= $item['birthday'] ?></td>
                                    <td class="am-text-middle"><?= $item['shop_time'] ?></td>
                                    <td class="am-text-middle"><?= $item['shop_money'] ?></td>


                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="8" class="am-text-center">暂无记录</td>
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
        $('#search').bind('click',function(){
            var a = $('#search1').val();
            var url = $(this).data('url') + '/keywords/' + a;
          window.location.href=url;
        });


    });
</script>

