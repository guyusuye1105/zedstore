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
                                <div class="widget-title am-fl">添加项目属性</div>
                            </div>
                            <input type="hidden" id="label_str" name="classify[label]" >



                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require">属性名称 </label>
                                <div class="am-u-sm-9 am-input-group">
                                    <div class="am-u-sm-7">
                                        <input type="text" name="classify[name]" class="am-form-field" value="0" >
                                    </div>
                                </div>
                            </div>

                            <div id="item_label">
                            <div class="am-form-group ilabel">
                                <label class="am-u-sm-3 am-form-label form-require">属性标签 </label>
                                <div class="am-u-sm-9 am-input-group">
                                    <div class="am-u-sm-7">
                                        <input type="text" class="am-form-field"  value="0" >
                                    </div>
                                    <label class="am-u-sm-5 am-form-label am-text-left"><a class="del_label" onclick="del(this)">删除</a></label>
                                </div>
                            </div>
                            </div>






                            <small class="am-margin-left-xs">
                                <a href="javascript:void(0)"  id="add_label">新增属性标签</a>
                            </small>




                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                    <button type="submit" onclick="labelStr()" class="j-submit am-btn am-btn-secondary">提交
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

<script src="assets/store/js/ddsort.js"></script>
<script src="assets/store/plugins/umeditor/umeditor.config.js"></script>
<script src="assets/store/plugins/umeditor/umeditor.min.js"></script>
<script src="assets/store/js/goods.spec.js"></script>
<script>
    $(function () {
        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm({
        });
        /**
         * 点击新增属性标签
         */
        $('#add_label').bind('click',function(){
            $('#item_label').append('<div class="am-form-group ilabel">\n' +
                '                                <label class="am-u-sm-3 am-form-label form-require">属性标签 </label>\n' +
                '                                <div class="am-u-sm-9 am-input-group">\n' +
                '                                    <div class="am-u-sm-7">\n' +
                '                                        <input type="text" class="am-form-field"  value="0" >\n' +
                '                                    </div>\n' +
                '                                    <label class="am-u-sm-5 am-form-label am-text-left"><a href="javascript:void(0)" class="del_label" onclick="del(this)">删除</a></label>\n' +
                '                                </div>\n' +
                '                            </div>')
        })
    });
    /**
     * 点击删除属性标签
     */
    function del(a){
        $(a).closest('.ilabel').remove();

    }

    /**
     * 点击提交后算出属性标签合起来的字符串并赋值给name
     */
    function labelStr(){
        var label = '';
        $('#item_label input').each(function(){
            label += ';'+$(this).val();
        });
        $('#label_str').val(label);
    }

    /*
    layer.msg('43434', {
            icon: 1
            , time: 1800
            // , anim: 1
            , shade: 0.5
            , end: function () {
               // url === undefined ? window.location.reload() : window.location = url;
            }
        });
     */

</script>
