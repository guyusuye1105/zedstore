<link rel="stylesheet" href="assets/store/css/goods.css">
<link rel="stylesheet" href="assets/store/plugins/umeditor/themes/default/css/umeditor.css">
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <div>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">项目信息</div>
                            </div>

                            <input type="hidden" name="project[id]" value="<?= $list['id'] ?>" >
                            <input type="hidden" name="project[attr]" value="" >
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">项目名称 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="project[name]"
                                           value="<?= $list['name'] ?>" required maxlength="20">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">项目分类 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="project[project_id]" required
                                            data-am-selected="{searchBox: 1, btnSize: 'sm',  placeholder:'请选择项目分类'}">
                                        <option value=""></option>
                                        <?php if (isset($data['project'])): foreach ($data['project'] as $pval): ?>
                                            <option value="<?= $pval['id'] ?>"  <?= $list['project_id'] == $pval['id'] ? 'selected' : '' ?>  >
                                                　　<?= $pval['name'] ?>
                                            </option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                    <small class="am-margin-left-xs">
                                        <a href="<?= url('project.classify/add') ?>">去添加</a>
                                    </small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">项目价格 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input am-field-valid" name="project[price]"
                                           value="<?= $list['price'] ?>"  required=""
                                           pattern="^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">兑换积分数值 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="project[exchange]"
                                           value="<?= $list['exchange'] ?>"  >
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">项目描述 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <textarea class="am-field-valid" rows="6" name="project[describe]" style="border:1px solid;vertical-align:top"><?= $list['describe'] ?></textarea>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">项目图片（最多添加5张） </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <div class="am-form-file">
                                        <div class="am-form-file">
                                            <button type="button"
                                                    class="upload-file am-btn am-btn-secondary am-radius">
                                                <i class="am-icon-cloud-upload"></i> 选择图片
                                            </button>
                                            <div class="uploader-list am-cf">
                                                <?php $list['slide'] = explode(';',$list['slide']); ?>
                                                <?php foreach ($list['slide'] as $key => $item): ?>
                                                    <div class="file-item">
                                                        <img src="<?= $item ?>">
                                                        <input type="hidden" name="project[images][]"
                                                               value="<?= $item ?>">
                                                        <i class="iconfont icon-shanchu file-item-delete"></i>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="help-block am-margin-top-sm">
                                            <small>尺寸750x750像素以上，大小2M以下 (可拖拽图片调整显示顺序 )</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">项目属性</div>
                            </div>
                            <div class="am-form-group">
                            <small class="am-margin-left-xs">
                                <a href="javascript:void(0)" onclick="addAttr()">新增属性</a>
                            </small>
                            </div>
<div id="project_attr">
    <?php  if(!empty($list['attr'])): foreach($list['attr'] as $keya=>$vala):?>
        <div class="attr_block" style = " border:1px solid #000;width:100%;margin:20px">
            <div class="am-form-group">
                <label class="am-u-sm-3 am-form-label form-require">属性名称 </label>
                <div class="am-u-sm-9 am-input-group">
                    <div class="am-u-sm-7">
                        <input type="text" name="b_name" class="am-form-field" value="<?=$vala[0]?>" >
                    </div>
                </div>
            </div>
            <div class="item_label">
                <?php if(!empty($vala[1])):?>
                <?php  $label = explode(';',$vala[1]);?>
                <?php foreach($label as $keyb=>$valb):?>
                <div class="am-form-group ilabel">
                    <label class="am-u-sm-3 am-form-label form-require">属性标签 </label>
                    <div class="am-u-sm-9 am-input-group">
                        <div class="am-u-sm-7">
                            <input type="text" name="b_label" class="am-form-field"  value="<?=$valb?>" >
                        </div>
                        <label class="am-u-sm-5 am-form-label am-text-left"><a  onclick="del(this)">删除</a></label>
                    </div>
                </div>
                 <?php endforeach;?>
                <?php endif;?>
            </div>
            <small class="am-margin-left-xs">
                <a href="javascript:void(0)"  onclick="addAttrLabel(this)">新增属性标签</a>
                <a href="javascript:void(0)" onclick="delItem(this)">删除项目属性</a>
            </small>
        </div>
    <?php endforeach;?>
    <?php endif;?>
</div>


                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                    <button type="submit" id="submit" class="j-submit am-btn am-btn-secondary">提交
                                    </button>
                                    <a  class="am-btn am-btn-default" onclick="javascript:window.history.back(-1);">返回
                                    </a>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 图片文件列表模板 -->
{{include file="layouts/_template/tpl_file_item" /}}

<!-- 文件库弹窗 -->
{{include file="layouts/_template/file_library" /}}

<!-- 商品多规格模板 -->
{{include file="goods/_template/spec_many" /}}

<script src="assets/store/js/ddsort.js"></script>
<script src="assets/store/plugins/umeditor/umeditor.config.js"></script>
<script src="assets/store/plugins/umeditor/umeditor.min.js"></script>
<script src="assets/store/js/goods.spec.js"></script>
<script>
    $(function () {
        // 选择图片
        $('.upload-file').selectImages({
            name: 'project[images][]'
            , multiple: true
        });

        // 图片列表拖动
        $('.uploader-list').DDSort({
            target: '.file-item',
            delay: 100, // 延时处理，默认为 50 ms，防止手抖点击 A 链接无效
            floatStyle: {
                'border': '1px solid #ccc',
                'background-color': '#fff'
            }
        });
        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm({
        });
        /**
         * 表单提交前赋值name
         * */
        $('#submit').bind('click',function(){
            var arr = '';
            $('#project_attr .attr_block').each(function(index,e){
                arr += ";;" + $(e).find("input[name^='b_name']").val();

                $(e).find("input[name='b_label']").each(function(indexa,ea){
                    arr += ';' + $(ea).val();
                })
            });
            $("input[name='project[attr]']").val(arr);
        })




    });
    /**
     * 新增属性标签
     */
    function addAttrLabel(a){
           $(a).closest('.attr_block').find('.item_label').append('<div class="am-form-group ilabel">\n' +
                '                                <label class="am-u-sm-3 am-form-label form-require">属性标签 </label>\n' +
                '                                <div class="am-u-sm-9 am-input-group">\n' +
                '                                    <div class="am-u-sm-7">\n' +
                '                                        <input type="text" name="b_label" class="am-form-field"  value="" >\n' +
                '                                    </div>\n' +
                '                                    <label class="am-u-sm-5 am-form-label am-text-left"><a href="javascript:void(0)"  onclick="del(this)">删除</a></label>\n' +
                '                                </div>\n' +
                '                            </div>')

    }
    /**
     * 点击删除属性标签
     */
    function del(a){
        $(a).closest('.ilabel').remove();
    }
    function delItem(a){
        $(a).closest('.attr_block').remove();
    }

    /**
     * 新增属性
     */
    function addAttr(){
        $('#project_attr').append('\t\t<div class="attr_block" style = " border:1px solid #000;width:100%;margin:20px";margin:20px>\n' +
            '    <div class="am-form-group">\n' +
            '        <label class="am-u-sm-3 am-form-label form-require">属性名称 </label>\n' +
            '        <div class="am-u-sm-9 am-input-group">\n' +
            '            <div class="am-u-sm-7">\n' +
            '                <input type="text" name="b_name" class="am-form-field" value="" >\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '    <div class="item_label">\n' +
            '     \n' +
            '\n' +
            '        <div class="am-form-group ilabel">\n' +
            '            <label class="am-u-sm-3 am-form-label form-require">属性标签 </label>\n' +
            '            <div class="am-u-sm-9 am-input-group">\n' +
            '                <div class="am-u-sm-7">\n' +
            '                    <input type="text" name="b_label" class="am-form-field"  value="" >\n' +
            '                </div>\n' +
            '                <label class="am-u-sm-5 am-form-label am-text-left"><a  onclick="del(this)">删除</a></label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '\n' +
            '    </div>\n' +
            '    <small class="am-margin-left-xs">\n' +
            '        <a href="javascript:void(0)"  onclick="addAttrLabel(this)">新增属性标签</a>\n' +
            '        <a href="javascript:void(0)" onclick="delItem(this)">删除项目属性</a>\n' +
            '    </small>\n' +
            '</div>')
    }

</script>
