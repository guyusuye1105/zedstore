<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" enctype="multipart/form-data" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">添加门店</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店编号：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[store_num]"
                                           value="" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店名称：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[store_name]"
                                           value="" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店电话：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[store_mobile]"
                                           value="" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">营业时间：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[worktime]"
                                           value="" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店地址：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    省:<input type="text" id="province" class="tpl-form-input" name="store[province]"
                                             value="" required>
                                    市:<input type="text" id="city" class="tpl-form-input" name="store[city]"
                                             value="" required>
                                    区:<input type="text" id="county" class="tpl-form-input" name="store[county]"
                                             value="" required>
                                    <button onclick="search()" type="button" class="am-btn am-btn-secondary">搜索</button>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">经度：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" id="lng" class="tpl-form-input" name="store[longitude]"
                                           value="" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">纬度：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" id="lat" class="tpl-form-input" name="store[latitude]"
                                           value="" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">详细地址：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" id="address"  class="tpl-form-input" name="store[address]"
                                           value="" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">地图：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <div id="BDmap" style="width: 100%;height: 400px;"></div>
                                </div>
                            </div>


                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">轮播图： </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <div class="am-form-file">
                                        <div class="am-form-file">
                                            <button type="button"
                                                    class="upload-file am-btn am-btn-secondary am-radius">
                                                <i class="am-icon-cloud-upload"></i> 选择图片
                                            </button>
                                            <div class="uploader-list am-cf">
                                            </div>
                                        </div>
                                        <div class="help-block am-margin-top-sm">
                                            <small>尺寸750x750像素以上，大小2M以下 (可拖拽图片调整显示顺序 )</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店简介：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[describe]"
                                           value="" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                    <button type="submit" id="submit" class="j-submit am-btn am-btn-secondary">提交
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

<!-- 图片文件列表模板 -->
{{include file="layouts/_template/tpl_file_item" /}}

<!-- 文件库弹窗 -->
{{include file="layouts/_template/file_library" /}}

<script src="assets/common/js/vue.min.js"></script>
<script src="assets/common/js/ddsort.js"></script>
<script src="assets/common/plugins/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5w3ODGXuLmKOkGgsDVsZ8Q5wguwKf1Xu"></script>
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
<script type="text/javascript">
    var map = new BMap.Map("BDmap");
    // 创建地图实例
    var point = new BMap.Point(116.404, 39.915);
    // 创建点坐标
    map.centerAndZoom(point, 15);
    map.enableScrollWheelZoom(true);
    // 初始化地图，设置中心点坐标和地图级别
    map.addEventListener("click", function(e){
        // alert(e.point.lng + ", " + e.point.lat);
        $('#lng').val(e.point.lng)
        $('#lat').val(e.point.lat)
        // document.getElementById('lnglat').value = e.point.lng + ", " + e.point.lat
        // 创建地理编码实例
        var myGeo = new BMap.Geocoder();
        // 根据坐标得到地址描述
        myGeo.getLocation(new BMap.Point(e.point.lng,e.point.lat), function(result){
            if (result){
                // document.getElementById('address').value = result.address;
                // $("#address").val(result.address)
                $("#province").val(result.addressComponents.province)
                $("#city").val(result.addressComponents.city)
                $("#county").val(result.addressComponents.district)
                $("#address").val(result.addressComponents.street+result.addressComponents.streetNumber)
            }
        });
    });

    function search(){
        var address = $("#province").val()+$("#city").val()+$("#county").val()
        var myGeo = new BMap.Geocoder();
        if(address != ''){
            myGeo.getPoint(address, function(point){
                if (point) {
                    map.centerAndZoom(point, 16);
                    map.addOverlay(new BMap.Marker(point));
                    $('#lng').val(point.lng)
                    $('#lat').val(point.lat)
                }
            });
        }else{

        }

    }
</script>