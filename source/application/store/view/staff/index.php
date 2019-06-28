<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">员工管理</div>
                </div>

                <div class="widget-body am-fr">
                    <!--                    按钮层-->
                    <div style="width:100%">
                        <div class="am-btn-group am-btn-group-xs">
                            <a class="am-btn am-btn-default am-btn-success am-radius" href="index.php?s=/store/staff/add">
                                <span class="am-icon-plus"></span>新增
                            </a>
                        </div>

                        <div class="am-btn-group am-btn-group-xs" style="float:right;padding-left:5px">
                            <div class="am-input-group am-input-group-sm tpl-form-border-form">
                                <div class="am-input-group-btn" style="width:auto">
                                    <button id="search" data-url="index.php?s=/store/staff/index"
                                            class="am-btn am-btn-default am-icon-search"
                                            type="submit"></button>
                                </div>
                            </div>
                        </div>
                        <div class="am-btn-group am-btn-group-xs" style="float:right">
                            <select id="project_select"
                                    data-am-selected="{btnSize: 'sm', placeholder: '商品状态'}">
                                <option value="all">全部</option>
                                <?php foreach ($data['job'] as $item): ?>
                                    <option  <?php if($data['id']==$item['id']):?> selected <?php endif;?> value="<?=$item['id']?>"><?=$item['name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>




                    </div>
                    <hr>
                    <div class="am-scrollable-horizontal am-u-sm-12">
                        <table id="project_table" width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>序号</th>
                                <th>员工姓名</th>
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
                                    <td class="am-text-middle"><?= $item['job_name'] ?></td>
                                    <td class="am-text-middle"><?= $item['account'] ?></td>
                                    <td class="am-text-middle">
                                        <img src="<?= $item['cover'] ?>" width="50" height="50" alt="员工头像">
                                    </td>
                                    <td class="am-text-middle"><?= $item['mobile'] ?></td>
                                    <td class="am-text-middle">
                                    <?php if($item['is_vacation'] == 1):?>
                                        休假中
                                    <?php elseif($item['is_free'] == 1):?>
                                        空闲
                                    <?php elseif($item['is_free'] == 0):?>
                                        工作中
                                    <?php endif;?>
                                    </td>

                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <a href="<?= url('staff/edit',
                                                ['id' => $item['id']]) ?>">
                                                <i class="am-icon-pencil"></i> 编辑
                                            </a>
                                            <a href="javascript:;" class="ice tpl-table-black-operation-del"
                                               data-id="<?= $item['id'] ?>">
                                                <i class="am-icon-trash"></i> 冻结
                                            </a>
                                            <a href="javascript:;" class="vacation am-icon-pencil"
                                               data-id="<?= $item['id'] ?>">

                                                <?php if($item['is_vacation'] == 1):?>
                                                    取消休假
                                                <?php else:?>
                                                    休假
                                                <?php endif;?>
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

        // 冻结元素
        $('.ice').bind('click',function(){
            $this = $(this);
            layer.confirm('确定冻结该账号吗？', function (index) {
                var url = 'index.php?s=/store/staff/ice';
                var id = $this.data('id');
                $.post(url,{id:id},function(res){
                    if(res.code == 1){
                        layer.close(index);
                        window.location.href='index.php?s=/store/staff/index';
                    }else{
                        layer.msg('操作失败');
                    }
                })
            })
        })
        // 休假
        $('.vacation').bind('click',function(){
            $this = $(this);
            var url = 'index.php?s=/store/staff/vacation';
            var id = $this.data('id');
            $.post(url,{id:id},function(res){
                if(res.code == 1){
                    window.location.href='index.php?s=/store/staff/index';
                }else{
                    layer.msg('操作失败');
                }
            })

        })


        $('#search').bind('click',function(){
            var a = $('#project_select').val();
            var url = $(this).data('url') + '/job_id/' + a;
            window.location.href=url;
        });

    });
</script>

