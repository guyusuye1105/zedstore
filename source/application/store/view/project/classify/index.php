<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">项目分类管理</div>
                </div>

                <div class="widget-body am-fr">
                    <!--                    按钮层-->
                    <div style="width:100%">
                        <div class="am-btn-group am-btn-group-xs">
                            <a class="am-btn am-btn-default am-btn-success am-radius" href="index.php?s=/store/project.classify/add">
                                <span class="am-icon-plus"></span>新增
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="am-scrollable-horizontal am-u-sm-12">
                        <table id="project_table" width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>序号</th>
                                <th>分类名称</th>
                                <th>操作</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($list)): foreach ($list as $item): ?>
                                <tr >
                                    <td class="am-text-middle"><?= $item['id'] ?></td>
                                    <td class="am-text-middle"><?= $item['name'] ?></td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <a href="<?= url('project.classify/edit',
                                                ['id' => $item['id']]) ?>">
                                                <i class="am-icon-pencil"></i> 编辑
                                            </a>
                                            <a href="javascript:;" class="item-delete tpl-table-black-operation-del"
                                               data-id="<?= $item['id'] ?>">
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
        // 删除元素
        var url = "<?= url('project.classify/delete') ?>";
        $('.item-delete').delete('id', url);

    });
</script>

