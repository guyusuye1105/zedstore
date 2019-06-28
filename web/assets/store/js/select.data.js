;(function ($, window, document, undefined) {

    /**
     * 数据选择器模块
     * @param $trigger
     * @param option
     * @constructor
     */
    function selectData($trigger, option) {
        var defaults = {
            title: '',              // 弹窗标题
            uri: '',                // api uri
            duplicate: true,        // 是否允许重复数据
            dataIndex: '',          // 数据索引名称 例如: goods_id, 用于验证数据是否重复
            getExistData: $.noop()  // 获取已存在数据接口函数
        };
        this.options = $.extend({}, defaults, option);
        // 初始化对象事件
        this.init($trigger);
    }

    selectData.prototype = {

        /**
         * 初始化
         */
        init: function ($trigger) {
            var _this = this;
            // 选择器触发事件
            $trigger.click(function () {
                _this.showModal();
            });
        },

        /**
         * 显示数据选择弹窗
         */
        showModal: function () {
            var _this = this;
            // 捕获页
            layer.open({
                type: 2
                , id: _this.options.layerId
                , title: _this.options.title
                , skin: 'modal-select-data'
                , area: ['840px', '520px']
                , offset: 'auto'
                , anim: 1
                , closeBtn: 1
                , shade: 0.3
                , btn: ['确定', '取消']
                , content: STORE_URL + '/data.' + this.options.uri
                , success: function (layero) {
                    // 初始化文件库弹窗
                    _this.initModal(layero);
                }
                , yes: function (index, layero) {
                    var iframeWin = window[layero.find('iframe')[0]['name']]
                        , selectedData = iframeWin.getSelectedData()    // 选择的数据
                        , newData = _this.duplicateData(selectedData);  // 去除重复
                    // 执行回调函数
                    if (newData && typeof _this.options.done === 'function') {
                        _this.options.done(newData, this.$touch);
                    }
                    layer.close(index);
                }
            });
        },

        /**
         * 筛选重复数据
         * @param selectedData
         */
        duplicateData: function (selectedData) {
            var _this = this;
            if (!selectedData.length) {
                return false;
            }
            if (_this.options.duplicate !== false) {
                return selectedData;
            }
            if (_this.options.dataIndex === '') {
                console.error('dataIndex is not defined');
                return false;
            }
            var existData = _this.options.getExistData.call(true);
            if (!existData.length) {
                return selectedData;
            }
            var newData = [];
            selectedData.forEach(function (item) {
                if (existData.indexOf(item[_this.options.dataIndex]) === -1) {
                    newData.push(item);
                    existData.push(item[_this.options.dataIndex]);
                }
            });
            return newData;
        },

        /**
         * 初始弹窗
         */
        initModal: function (element) {
            var _this = this;
            _this.$element = element;
        }

    };

    /**
     * 在Jquery插件中使用selectData对象
     * @param options
     * @returns {selectData}
     */
    $.fn.selectData = function (options) {
        return new selectData(this, options);
    };

})(jQuery, window, document);
