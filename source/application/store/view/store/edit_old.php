<link rel="stylesheet" href="assets/store/css/goods.css">
<link rel="stylesheet" href="assets/store/plugins/umeditor/themes/default/css/umeditor.css">
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">门店信息</div>
                            </div>

                            <input type="hidden" name="store[id]" value="<?=$list[0]['id']?>" >
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店名称 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[store_name]"
                                           value="<?=$list[0]['store_name']?>" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店编号 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[store_num]"
                                           value="<?=$list[0]['store_num']?>" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店电话 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[store_mobile]"
                                           value="<?=$list[0]['store_mobile']?>" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">营业时间 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[worktime]"
                                           value="<?=$list[0]['worktime']?>" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">所在地 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[province]"
                                           value="<?=$list[0]['province']?>" required>
                                    <input type="text" class="tpl-form-input" name="store[city]"
                                           value="<?=$list[0]['city']?>" required>
                                    <input type="text" class="tpl-form-input" name="store[county]"
                                           value="<?=$list[0]['county']?>" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">具体地址 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[address]"
                                           value="<?=$list[0]['address']?>" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">坐标定位 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[longitude]"
                                           value="<?=$list[0]['longitude']?>" required>
                                    <input type="text" class="tpl-form-input" name="store[latitude]"
                                           value="<?=$list[0]['latitude']?>" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">轮播图片（最多添加5张） </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <div class="am-form-file">
                                        <div class="am-form-file">
                                            <button type="button"
                                                    class="upload-file am-btn am-btn-secondary am-radius">
                                                <i class="am-icon-cloud-upload"></i> 选择图片
                                            </button>
                                            <div class="uploader-list am-cf">
                                                <?php $list[0]['slide'] = explode(';',$list[0]['slide']); ?>
                                                <?php foreach ($list[0]['slide'] as $key => $item): ?>
                                                    <div class="file-item">
                                                        <img src="<?= $item ?>">
                                                        <input type="hidden" name="store[images][]"
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






                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">店铺介绍 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <textarea class="am-field-valid" rows="6" name="store[describe]"  required>
                                    <?=$list[0]['describe']?>
                                    </textarea>
                                </div>
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


<script src="assets/store/js/ddsort.js"></script>
<script src="assets/store/plugins/umeditor/umeditor.config.js"></script>
<script src="assets/store/plugins/umeditor/umeditor.min.js"></script>
<script src="assets/store/js/goods.spec.js"></script>
<script>
    $(function () {
        // 选择图片
        $('.upload-file').selectImages({
            name: 'store[images][]'
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
        $('#my-form').superForm({});
    })
</script>
