<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" enctype="multipart/form-data" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">文件上传设置</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">
                                    默认上传方式
                                </label>
                                <div class="am-u-sm-9">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="storage[default]" value="local" data-am-ucheck
                                            <?= $values['default'] === 'local' ? 'checked' : '' ?>> 本地 (不推荐)
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="storage[default]" value="qiniu" data-am-ucheck
                                            <?= $values['default'] === 'qiniu' ? 'checked' : '' ?>> 七牛云存储
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="storage[default]" value="aliyun" data-am-ucheck
                                            <?= $values['default'] === 'aliyun' ? 'checked' : '' ?>> 阿里云OSS
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="storage[default]" value="qcloud" data-am-ucheck
                                            <?= $values['default'] === 'qcloud' ? 'checked' : '' ?>> 腾讯云COS
                                    </label>
                                </div>
                            </div>
                            <div id="qiniu"
                                 class="form-tab-group <?= $values['default'] === 'qiniu' ? 'active' : '' ?>">
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">
                                        存储空间名称 <span class="tpl-form-line-small-title">Bucket</span>
                                    </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="storage[engine][qiniu][bucket]"
                                               value="<?= $values['engine']['qiniu']['bucket'] ?>">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">
                                        ACCESS_KEY <span class="tpl-form-line-small-title">AK</span>
                                    </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input"
                                               name="storage[engine][qiniu][access_key]"
                                               value="<?= $values['engine']['qiniu']['access_key'] ?>">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">
                                        SECRET_KEY <span class="tpl-form-line-small-title">SK</span>
                                    </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input"
                                               name="storage[engine][qiniu][secret_key]"
                                               value="<?= $values['engine']['qiniu']['secret_key'] ?>">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">
                                        空间域名 <span class="tpl-form-line-small-title">Domain</span>
                                    </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="storage[engine][qiniu][domain]"
                                               value="<?= $values['engine']['qiniu']['domain'] ?>">
                                        <small>请补全http:// 或 https://，例如：http://static.cloud.com</small>
                                    </div>
                                </div>
                            </div>
                            <div id="aliyun"
                                 class="form-tab-group <?= $values['default'] === 'aliyun' ? 'active' : '' ?>">
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">
                                        存储空间名称 <span class="tpl-form-line-small-title">Bucket</span>
                                    </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="storage[engine][aliyun][bucket]"
                                               value="<?= $values['engine']['aliyun']['bucket'] ?>">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label"> AccessKeyId </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input"
                                               name="storage[engine][aliyun][access_key_id]"
                                               value="<?= $values['engine']['aliyun']['access_key_id'] ?>">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label"> AccessKeySecret </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input"
                                               name="storage[engine][aliyun][access_key_secret]"
                                               value="<?= $values['engine']['aliyun']['access_key_secret'] ?>">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">
                                        空间域名 <span class="tpl-form-line-small-title">Domain</span>
                                    </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input"
                                               name="storage[engine][aliyun][domain]"
                                               value="<?= $values['engine']['aliyun']['domain'] ?>">
                                        <small>请补全http:// 或 https://，例如：http://static.cloud.com</small>
                                    </div>
                                </div>
                            </div>
                            <div id="qcloud"
                                 class="form-tab-group <?= $values['default'] === 'qcloud' ? 'active' : '' ?>">
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">
                                        存储空间名称 <span class="tpl-form-line-small-title">Bucket</span>
                                    </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="storage[engine][qcloud][bucket]"
                                               value="<?= $values['engine']['qcloud']['bucket'] ?>">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">
                                        所属地域 <span class="tpl-form-line-small-title">Region</span>
                                    </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input"
                                               name="storage[engine][qcloud][region]"
                                               value="<?= $values['engine']['qcloud']['region'] ?>">
                                        <small>请填写地域简称，例如：ap-beijing、ap-hongkong、eu-frankfurt</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">
                                        SecretId
                                    </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input"
                                               name="storage[engine][qcloud][secret_id]"
                                               value="<?= $values['engine']['qcloud']['secret_id'] ?>">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">
                                        SecretKey
                                    </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input"
                                               name="storage[engine][qcloud][secret_key]"
                                               value="<?= $values['engine']['qcloud']['secret_key'] ?>">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">
                                        空间域名 <span class="tpl-form-line-small-title">Domain</span>
                                    </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="storage[engine][qcloud][domain]"
                                               value="<?= $values['engine']['qcloud']['domain'] ?>">
                                        <small>请补全http:// 或 https://，例如：http://static.cloud.com</small>
                                    </div>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                    <button type="submit" class="j-submit am-btn am-btn-secondary">提交
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {

        // 切换默认上传方式
        $("input:radio[name='storage[default]']").change(function (e) {
            $('.form-tab-group').removeClass('active');
            switch (e.currentTarget.value) {
                case 'qiniu':
                    $('#qiniu').addClass('active');
                    break;
                case 'qcloud':
                    $('#qcloud').addClass('active');
                    break;
                case 'aliyun':
                    $('#aliyun').addClass('active');
                    break;
                case 'local':
                    break;
            }
        });

        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm();

    });
</script>
