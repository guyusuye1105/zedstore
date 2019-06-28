<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">项目管理</div>
                </div>
                <!--通用data数据-->
                <input id="index_url" type="hidden" data-url="index.php?s=/store/project.lowshelf/index" >




                    <hr>



                    <div class="am-scrollable-horizontal am-u-sm-12">
                        <table id="project_table" width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>序号</th>
                                <th>项目名称</th>
                                <th>项目分类</th>
                                <th>项目价格</th>
                                <th>项目图片</th>
                                <th>操作</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($list)): foreach ($list as $item): ?>
                                <tr >
                                    <td class="am-text-middle"><?= $item['id'] ?></td>
                                    <td class="am-text-middle"><?= $item['name'] ?></td>
                                    <td class="am-text-middle"><?= $item['project_name'] ?></td>
                                    <td class="am-text-middle"><?= $item['price'] ?></td>
                                    <td class="am-text-middle">
                                        <?php $item['slide'] = explode(';',$item['slide']);?>
                                        <?php foreach( $item['slide'] as $val): ?>
                                            <img src="<?= $val ?>" width="50" height="50" alt="项目图片">
                                        <?php endforeach;?>
                                    </td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <a href="javascript:;"
                                               data-url = "index.php?s=/store/project.lowshelf/upshelf" class="upshelf"
                                               data-id="<?= $item['id'] ?>">
                                                <i class="am-icon-map"></i>上架
                                            </a>
                                            <a href="javascript:;"
                                               data-url = "index.php?s=/store/project.lowshelf/delete"
                                               data-id="<?= $item['id'] ?>"  class="delete tpl-table-black-operation-del">
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
        // 上架
        $('.upshelf').bind('click',function(){
            $this = $(this);
            layer.confirm('确定上架该服务吗？', function (index) {
                var url = $this.data('url');
                var id = $this.data('id');
                $.post(url,{id:id},function(res){
                    if(res.code == 1){
                        layer.close(index);
                        window.location.href=$('#index_url').data('url');
                    }else{
                        layer.msg('操作失败');
                    }
                })
            })
        })
        // 删除
        $('.delete').bind('click',function(){
            $this = $(this);

            layer.confirm('确定删除该服务吗？', function(index) {
               var url = $this.data('url');
                var id = $this.data('id');
                $.post(url,{id:id},function(res){
                    if(res.code == 1){
                        layer.close(index);
                        window.location.href=$('#index_url').data('url');
                    }else{
                        layer.msg('操作失败');
                    }
                })
            })
        })


    });
</script>

