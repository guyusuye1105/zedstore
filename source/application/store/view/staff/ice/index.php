<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">员工管理</div>
                </div>

                <div class="widget-body am-fr">
                    <!--                    按钮层-->

                    <hr>
                    <div class="am-scrollable-horizontal am-u-sm-12">
                        <table id="project_table" width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>序号</th>
                                <th>员工姓名</th>
                                <th>员工性质</th>
                                <th>员工段位</th>
                                <th>员工账号</th>
                                <th>员工头像</th>
                                <th>员工手机号码</th>
                                <th>状态</th>
                                <th>操作</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($list)): foreach ($list as $item): ?>
                                <tr data-id="<?= $item['id'] ?>">
                                    <td class="am-text-middle"><?= $item['id'] ?></td>
                                    <td class="am-text-middle"><?= $item['name'] ?></td>
                                    <td class="am-text-middle">
                                        <?php if($item['type'] == 'admin'):?>
                                            管理员
                                        <?php elseif($item['type'] == 'waiter'):?>
                                            服务员
                                        <?php endif;?>
                                    </td>
                                    <td class="am-text-middle"><?= $item['job_name'] ?></td>
                                    <td class="am-text-middle"><?= $item['account'] ?></td>
                                    <td class="am-text-middle">
                                        <img src="<?= $item['cover'] ?>" width="50" height="50" alt="员工头像">
                                    </td>
                                    <td class="am-text-middle"><?= $item['mobile'] ?></td>
                                    <td class="am-text-middle">已冻结</td>

                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <a href="javascript:;" data-id="<?= $item['id'] ?>" class="ice">
                                                <i class="am-icon-pencil"></i> 解冻
                                            </a>
                                            <a href="javascript:;" data-id="<?= $item['id'] ?>"
                                               class=" delete tpl-table-black-operation-del">
                                                <i class="am-icon-trash"></i> 删除
                                            </a>

                                        </div>
                                    </td>

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
                            <div id="total_count" class="am-vertical-align-middle">总记录：<?= $list->total() ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        // 删除元素
        // var url = "<?= url('project.classify/delete') ?>";
        //  $('.item-delete').delete('id', url);

        // 解冻元素
        $('.ice').bind('click',function(){
            $this = $(this);
            layer.confirm('确定解冻该账号吗？', function (index) {
                var url = 'index.php?s=/store/staff/cancelice';
                var id = $this.data('id');
                $.post(url,{id:id},function(res){
                    if(res.code == 1){
                        layer.close(index);
                        window.location.href='index.php?s=/store/staff.ice/index';
                    }else{
                        layer.msg('操作失败');
                    }
                })
            })
        })
        // 删除元素
        $('.delete').bind('click',function(){
            $this = $(this);
            layer.confirm('确定删除该账号吗？', function (index) {
                var url = 'index.php?s=/store/staff/delete';
                var id = $this.data('id');
                $.post(url,{id:id},function(res){
                    if(res.code == 1){
                        layer.close(index);
                        window.location.href='index.php?s=/store/staff.ice/index';
                    }else{
                        layer.msg('操作失败');
                    }
                })
            })
        })





    });
</script>

