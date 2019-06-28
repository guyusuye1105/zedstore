<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form"  method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">门店信息</div>
                            </div>
                            <input type="hidden" name="store[id]" value="<?=$list[0]['id']?>" >
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店编号：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[store_num]"
                                           value="<?=$list[0]['store_num']?>" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店名称：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[store_name]"
                                           value="<?=$list[0]['store_name']?>" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店电话：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[store_mobile]"
                                           value="<?=$list[0]['store_mobile']?>" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">营业时间：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[worktime]"
                                           value="<?=$list[0]['worktime']?>" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店地址：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    省:<select type="text" id="province" class="tpl-form-input" name="store[province]"
                                              value="<?=$list[0]['province']?>" required>
                                    </select>
                                    市:<select type="text" id="city" class="tpl-form-input" name="store[city]"
                                              value="<?=$list[0]['city']?>" required></select>
                                    区:<input type="text" id="county" class="tpl-form-input" name="store[county]"
                                              value="<?=$list[0]['county']?>" required></input>
                                    <button onclick="search()" type="button" class="am-btn am-btn-secondary">搜索</button>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">经度：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" id="lng" class="tpl-form-input" name="store[longitude]"
                                           value="<?=$list[0]['longitude']?>" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">纬度：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" id="lat" class="tpl-form-input" name="store[latitude]"
                                           value="<?=$list[0]['latitude']?>" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">详细地址：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" id="address"  class="tpl-form-input" name="store[address]"
                                           value="<?=$list[0]['address']?>" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">地图：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <div id="BDmap" style="width: 100%;height: 400px;"></div>
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
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店简介：</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="store[describe]"
                                           value="<?=$list[0]['describe']?>" required>
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

<script src="assets/store/js/area.js"></script>
<script src="assets/store/plugins/umeditor/umeditor.config.js"></script>
<script src="assets/store/js/goods.spec.js"></script>

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5w3ODGXuLmKOkGgsDVsZ8Q5wguwKf1Xu"></script>
<script type="text/javascript">
    $(function () {

        /*addressInit('cmbProvince', 'cmbCity', 'cmbArea', '陕西', '宝鸡市', '金台区');*/
        // $(".selector").val("pxx");
        var province = '<?php echo $list[0]['province'] ?>';
        var city = '<?php echo $list[0]['city'] ?>';
        var county = '<?php echo $list[0]['county'] ?>';
        $('#province').find('option[value='+province+']').attr("selected",true)
        $('#city').find('option[value='+city+']').attr("selected",true)
        $('#county').find('option[value='+county+']').attr("selected",true)

        // 选择图片
        $('.upload-file').selectImages({
            name: 'store[images][]'
            , multiple: true
        });
        // 图片列表拖动
        /*  $('.uploader-list').DDSort({
              target: '.file-item',
              delay: 100, // 延时处理，默认为 50 ms，防止手抖点击 A 链接无效
              floatStyle: {
                  'border': '1px solid #ccc',
                  'background-color': '#fff'
              }
          });*/
        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm({
        });
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
                console.log(result)
                $('#province').find('option[value='+result.addressComponents.province+']').attr("selected",true)
                $('#city').find('option[value='+result.addressComponents.city+']').attr("selected",true)
                $('#county').find('option[value='+result.addressComponents.district+']').attr("selected",true)

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