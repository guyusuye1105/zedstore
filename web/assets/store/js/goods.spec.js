(function () {

    // 配置信息
    var setting = {
        el: 'many-app',
        baseData: null
    };

    /**
     * 构造方法
     * @param options
     * @param baseData
     * @constructor
     */
    function GoodsSpec(options, baseData) {
        // 配置信息
        setting = $.extend(true, {}, setting, options);
        // 初始化
        this.initialize();
    }

    GoodsSpec.prototype = {

        // vue组件句柄
        appVue: null,

        /**
         * 初始化
         */
        initialize: function () {
            // 已存在的规格数据
            var spec_attr = [], spec_list = [];
            if (typeof setting.baseData !== 'undefined' && setting.baseData !== null) {
                spec_attr = setting.baseData['spec_attr'];
                spec_list = setting.baseData['spec_list'];
            }

            // 实例化vue对象
            this.appVue = new Vue({
                el: setting.el,
                data: {
                    spec_attr: spec_attr,
                    spec_list: spec_list,
                    // 显示添加规格组按钮
                    showAddGroupBtn: true,
                    // 显示添加规格组表单
                    showAddGroupForm: false,
                    // 新增规格组值
                    addGroupFrom: {
                        specName: '',
                        specValue: ''
                    },
                    // 批量设置sku属性
                    batchData: {
                        goods_no: '',
                        goods_price: '',
                        line_price: '',
                        stock_num: '',
                        goods_weight: ''
                    }
                },
                methods: {
                    /**
                     * 显示/隐藏添加规则组
                     */
                    onToggleAddGroupForm: function () {
                        this.showAddGroupBtn = !this.showAddGroupBtn;
                        this.showAddGroupForm = !this.showAddGroupForm;
                    },

                    /**
                     * 表单提交：新增规格组
                     * @returns {boolean}
                     */
                    onSubmitAddGroup: function () {
                        var _this = this;
                        if (_this.addGroupFrom.specName === '' || _this.addGroupFrom.specValue === '') {
                            layer.msg('请填写规则名或规则值');
                            return false;
                        }
                        // 添加到数据库
                        var load = layer.load();
                        $.post(STORE_URL + '/goods.spec/addSpec', {
                            spec_name: _this.addGroupFrom.specName,
                            spec_value: _this.addGroupFrom.specValue
                        }, function (result) {
                            layer.close(load);
                            if (result.code !== 1) {
                                layer.msg(result.msg);
                                return false;
                            }
                            // 记录规格数据
                            _this.spec_attr.push({
                                group_id: result.data['spec_id'],
                                group_name: _this.addGroupFrom.specName,
                                spec_items: [{
                                    item_id: result.data['spec_value_id'],
                                    spec_value: _this.addGroupFrom.specValue
                                }],
                                tempValue: ''
                            });
                            // 清空输入内容
                            _this.addGroupFrom.specName = '';
                            _this.addGroupFrom.specValue = '';
                            // 隐藏添加规则组
                            _this.onToggleAddGroupForm();
                            // 构建规格组合列表
                            _this.buildSkulist();
                        });
                    },

                    /**
                     * 新增规格值
                     * @param index
                     */
                    onSubmitAddValue: function (index) {
                        var _this = this
                            , specAttr = _this.spec_attr[index];
                        if (specAttr.tempValue === '') {
                            layer.msg('规格值不能为空');
                            return false;
                        }
                        // 添加到数据库
                        var load = layer.load();
                        $.post(STORE_URL + '/goods.spec/addSpecValue', {
                            spec_id: specAttr.group_id,
                            spec_value: specAttr.tempValue
                        }, function (result) {
                            layer.close(load);
                            if (result.code !== 1) {
                                layer.msg(result.msg);
                                return false;
                            }
                            // 记录规格数据
                            specAttr.spec_items.push({
                                item_id: result.data['spec_value_id'],
                                spec_value: specAttr.tempValue
                            });
                            // 清空输入内容
                            specAttr.tempValue = '';
                            // 构建规格组合列表
                            _this.buildSkulist();
                        });
                    },

                    /**
                     * 构建规格组合列表
                     */
                    buildSkulist: function () {
                        var _this = this;
                        // 规格组合总数 (table行数)
                        var totalRow = 1;
                        for (var i = 0; i < _this.spec_attr.length; i++) {
                            totalRow *= _this.spec_attr[i].spec_items.length;
                        }
                        // 遍历tr 行
                        var specList = [];
                        for (i = 0; i < totalRow; i++) {
                            var rowData = [], rowCount = 1, specSkuIdAttr = [];
                            // 遍历td 列
                            for (var j = 0; j < _this.spec_attr.length; j++) {
                                var skuValues = _this.spec_attr[j].spec_items;
                                rowCount *= skuValues.length;
                                var anInterBankNum = (totalRow / rowCount)
                                    , point = ((i / anInterBankNum) % skuValues.length);
                                if (0 === (i % anInterBankNum)) {
                                    rowData.push({
                                        rowspan: anInterBankNum,
                                        item_id: skuValues[point].item_id,
                                        spec_value: skuValues[point].spec_value
                                    });
                                }
                                specSkuIdAttr.push(skuValues[parseInt(point.toString())].item_id);
                            }
                            specList.push({
                                spec_sku_id: specSkuIdAttr.join('_'),
                                rows: rowData,
                                form: {}
                            });
                        }

                        // return false;
                        // 合并旧sku数据
                        if (_this.spec_list.length > 0 && specList.length > 0) {
                            for (i = 0; i < specList.length; i++) {
                                var overlap = _this.spec_list.filter(function (val) {
                                    return val.spec_sku_id === specList[i].spec_sku_id;
                                });
                                if (overlap.length > 0) specList[i].form = overlap[0].form;
                            }
                        }
                        _this.spec_list = specList;
                        // 注册上传sku图片事件
                        _this.onSelectImagesEvent();
                    },

                    /**
                     * 删除规则组事件
                     * @param index
                     */
                    onDeleteGroup: function (index) {
                        var _this = this;
                        layer.confirm('确定要删除该规则吗？确认后不可恢复请谨慎操作'
                            , function (layerIndex) {
                                // 删除指定规则组
                                _this.spec_attr.splice(index, 1);
                                // 构建规格组合列表
                                _this.buildSkulist();
                                layer.close(layerIndex);
                            });
                    },

                    /**
                     * 删除规则值事件
                     * @param index
                     * @param itemIndex
                     */
                    onDeleteValue: function (index, itemIndex) {
                        var _this = this;
                        layer.confirm('确定要删除该规则吗？确认后不可恢复请谨慎操作'
                            , function (layerIndex) {
                                // 删除指定规则组
                                _this.spec_attr[index].spec_items.splice(itemIndex, 1);
                                // 构建规格组合列表
                                _this.buildSkulist();
                                layer.close(layerIndex);
                            });
                    },

                    /**
                     * 批量设置sku属性
                     */
                    onSubmitBatchData: function () {
                        var _this = this;
                        _this.spec_list.forEach(function (value) {
                            if (_this.batchData.goods_no) {
                                _this.$set(value.form, 'goods_no', _this.batchData.goods_no);
                            }
                            if (_this.batchData.goods_price) {
                                _this.$set(value.form, 'goods_price', _this.batchData.goods_price);
                            }
                            if (_this.batchData.line_price) {
                                _this.$set(value.form, 'line_price', _this.batchData.line_price);
                            }
                            if (_this.batchData.stock_num) {
                                _this.$set(value.form, 'stock_num', _this.batchData.stock_num);
                            }
                            if (_this.batchData.goods_weight) {
                                _this.$set(value.form, 'goods_weight', _this.batchData.goods_weight);
                            }
                        });
                    },

                    /**
                     * 注册上传sku图片事件
                     */
                    onSelectImagesEvent: function () {
                        var _this = this;
                        // 注册上传sku图片
                        _this.$nextTick(function () {
                            $(_this.$el).find('.j-selectImg').selectImages({
                                done: function (data, $addon) {
                                    var index = $addon.data('index');
                                    _this.$set(_this.spec_list[index].form, 'image_id', data[0]['file_id']);
                                    _this.$set(_this.spec_list[index].form, 'image_path', data[0]['file_path']);
                                }
                            });
                        });
                    },

                    /**
                     * 删除sku图片
                     */
                    onDeleteSkuImage: function (index) {
                        this.spec_list[index].form['image_id'] = 0;
                        this.spec_list[index].form['image_path'] = '';
                    },

                    /**
                     * 获取当前data
                     */
                    getData: function () {
                        return this.$data;
                    },

                    /**
                     * sku列表是否为空
                     * @returns {boolean}
                     */
                    isEmptySkuList: function () {
                        return !this.spec_list.length;
                    }

                }
            });

            // 初始化生成sku列表
            spec_list.length > 0 && this.appVue.buildSkulist();
        }

    };

    window.GoodsSpec = GoodsSpec;

})();

