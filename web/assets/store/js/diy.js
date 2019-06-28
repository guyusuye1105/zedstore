(function () {

    // diy类参数
    var options = {}

        // diy数据
        , diyData = {
            items: {
                page: {
                    id: 'page',
                    type: 'page',
                    name: '页面设置',
                    params: {
                        name: '页面名称',
                        title: '页面标题',
                        share_title: '分享标题'
                    },
                    style: {
                        titleTextColor: 'black',
                        titleBackgroundColor: '#ffffff'
                    }
                }
            }
        }

        /**
         * 新增组件
         * @type {{}}
         */
        , defaultData = {
            search: {
                name: '搜索框',
                params: {'placeholder': '请输入关键字进行搜索'},
                style: {
                    textAlign: 'left',
                    searchStyle: ''
                }
            },
            banner: {
                name: '图片轮播',
                style: {
                    btnColor: '#ffffff',
                    btnShape: 'round'
                },
                data: [
                    {
                        imgUrl: BASE_URL + 'assets/store/img/diy/banner_01.jpg',
                        linkUrl: '',
                        advise: '建议尺寸750x360'
                    },
                    {
                        imgUrl: BASE_URL + 'assets/store/img/diy/banner_02.jpg',
                        linkUrl: '',
                        advise: '建议尺寸750x360'
                    }
                ]
            },
            imageSingle: {
                name: '单图组',
                style: {
                    paddingTop: 0,
                    paddingLeft: 0,
                    background: '#ffffff'
                },
                data: [
                    {
                        imgUrl: BASE_URL + 'assets/store/img/diy/banner_01.jpg',
                        imgName: 'image-1.jpg',
                        linkUrl: ''
                    },
                    {
                        imgUrl: BASE_URL + 'assets/store/img/diy/banner_02.jpg',
                        imgName: 'banner-2.jpg',
                        linkUrl: ''
                    }
                ]
            },
            navBar: {
                name: '导航组',
                style: {background: '#ffffff', rowsNum: '4'},
                data: [
                    {
                        imgUrl: BASE_URL + 'assets/store/img/diy/navbar/icon-1.png',
                        imgName: 'icon-1.png',
                        linkUrl: '',
                        text: '按钮文字1',
                        color: '#666666',
                        advise: '建议尺寸100x100'
                    },
                    {
                        imgUrl: BASE_URL + 'assets/store/img/diy/navbar/icon-2.png',
                        imgName: 'icon-2.jpg',
                        linkUrl: '',
                        text: '按钮文字2',
                        color: '#666666',
                        advise: '建议尺寸100x100'
                    },
                    {
                        imgUrl: BASE_URL + 'assets/store/img/diy/navbar/icon-3.png',
                        imgName: 'icon-3.jpg',
                        linkUrl: '',
                        text: '按钮文字3',
                        color: '#666666',
                        advise: '建议尺寸100x100'
                    },
                    {
                        imgUrl: BASE_URL + 'assets/store/img/diy/navbar/icon-4.png',
                        imgName: 'icon-4.jpg',
                        linkUrl: '',
                        text: '按钮文字4',
                        color: '#666666',
                        advise: '建议尺寸100x100'
                    }
                ]
            },
            blank: {
                name: '辅助空白',
                style: {
                    height: '20',
                    background: '#ffffff'
                }
            },
            guide: {
                name: '辅助线',
                style: {
                    background: '#ffffff',
                    lineStyle: 'solid',
                    lineHeight: '1',
                    lineColor: "#000000",
                    paddingTop: 10
                }
            },
            video: {
                name: '视频组',
                params: {
                    videoUrl: 'http://wxsnsdy.tc.qq.com/105/20210/snsdyvideodownload?filekey=30280201010421301f0201690402534804102ca905ce620b1241b726bc41dcff44e00204012882540400',
                    poster: BASE_URL + 'assets/store/img/diy/video_poster.png'
                },
                style: {
                    paddingTop: '0',
                    height: '190'
                }
            },
            notice: {
                name: '公告组',
                params: {
                    text: '这里是第一条自定义公告的标题',
                    icon: BASE_URL + 'assets/store/img/diy/notice.png'
                },
                style: {
                    paddingTop: '4',
                    background: '#ffffff',
                    textColor: '#000000'
                }
            },
            richText: {
                name: '富文本',
                params: {
                    content: '这里是富文本的内容'
                },
                style: {
                    paddingTop: '0',
                    paddingLeft: '0',
                    background: '#ffffff'
                }
            },
            window: {
                name: '图片橱窗',
                style: {
                    paddingTop: '0',
                    paddingLeft: '0',
                    background: '#ffffff',
                    layout: '2'
                },
                data: [
                    {
                        imgUrl: BASE_URL + 'assets/store/img/diy/window/01.jpg',
                        linkUrl: ''
                    },
                    {
                        imgUrl: BASE_URL + 'assets/store/img/diy/window/02.jpg',
                        linkUrl: ''
                    },
                    {
                        imgUrl: BASE_URL + 'assets/store/img/diy/window/03.jpg',
                        linkUrl: ''
                    },
                    {
                        imgUrl: BASE_URL + 'assets/store/img/diy/window/04.jpg',
                        linkUrl: ''
                    }
                ],
                dataNum: 4
            },
            goods: {
                name: '商品组',
                params: {
                    source: 'choice', // choice; auto
                    auto: {
                        category: 0,
                        goodsSort: 'all', // all; sales; price
                        showNum: 6
                    }
                },
                style: {
                    background: '#f3f3f3',
                    display: 'list', // list; slide
                    column: '2',
                    show: {
                        goodsName: '1',
                        goodsPrice: '1',
                        linePrice: '1'
                    }
                },
                // 自动获取: 默认数据
                defaultData: [
                    {
                        goods_name: '此处显示商品名称',
                        image: BASE_URL + 'assets/store/img/diy/goods/01.jpg',
                        goods_price: '99.00'
                    },
                    {
                        goods_name: '此处显示商品名称',
                        image: BASE_URL + 'assets/store/img/diy/goods/02.jpg',
                        goods_price: '99.00'
                    },
                    {
                        goods_name: '此处显示商品名称',
                        image: BASE_URL + 'assets/store/img/diy/goods/03.jpg',
                        goods_price: '99.00'
                    },
                    {
                        goods_name: '此处显示商品名称',
                        image: BASE_URL + 'assets/store/img/diy/goods/04.jpg',
                        goods_price: '99.00'
                    }
                ],
                // 手动选择: 默认数据
                data: [
                    {
                        goods_name: '此处显示商品名称',
                        image: BASE_URL + 'assets/store/img/diy/goods/01.jpg',
                        goods_price: '99.00',
                        is_default: true
                    },
                    {
                        goods_name: '此处显示商品名称',
                        image: BASE_URL + 'assets/store/img/diy/goods/02.jpg',
                        goods_price: '99.00',
                        is_default: true
                    }
                ]
            },
            coupon: {
                name: '优惠券组',
                style: {
                    paddingTop: '10',
                    background: '#ffffff'
                },
                params: {
                    limit: '5'
                },
                data: [
                    {
                        color: 'red',
                        reduce_price: '10',
                        min_price: '100.00'
                    },
                    {
                        color: 'violet',
                        reduce_price: '10',
                        min_price: '100.00'
                    }
                ]
            }
        }

        /**
         * 私有方法
         */
        , method = {

            /**
             * 初始化类
             */
            init: {

                // 执行初始化
                execute: function () {
                    // 初始化diy元素拖拽事件
                    this.diyItem.DDSort();
                    // 初始化diy元素选中事件
                    this.diyItem.selected();
                    // 初始化diy元素删除事件
                    this.diyItem.delete();
                    // 注册数据绑定
                    this.inputDataBind();
                    // 初始化工具栏事件
                    this.toolbar.execute();
                    // 模板引擎自定义函数
                    this.templateHelper();
                    // 渲染已有diy数据
                    method.render.main();
                },

                /**
                 * diy元素事件类
                 */
                diyItem: {

                    /**
                     * 初始化拖拽事件
                     */
                    DDSort: function () {
                        var $diyPhone = $(options.phoneMain).parent();
                        // diy元素拖拽
                        $diyPhone.DDSort({
                            target: '.drag',
                            delay: 50, // 延时处理，默认为 50 ms，防止手抖点击 A 链接无效
                            up: function () {
                                var newItems = {};
                                $diyPhone.find('.optional').each(function () {
                                    var itemId = $(this).data('itemid');
                                    newItems[itemId] = diyData.items[itemId]
                                });
                                diyData.items = newItems;
                            }
                        });
                    },

                    /**
                     * 初始化选中事件
                     */
                    selected: function () {
                        var $diyPhone = $(options.phoneMain).parent();
                        $diyPhone.on('click', '.optional', function () {
                            var $this = $(this);
                            if (!$this.hasClass('selected')) {
                                // 设置选中
                                $diyPhone.find('.optional').removeClass('selected');
                                $this.addClass('selected');
                                // 渲染编辑器
                                method.render.editor($this.data('itemid'));
                            }
                        });
                    },

                    /**
                     * 删除元素事件
                     */
                    delete: function () {
                        var $phoneMain = $(options.phoneMain);
                        $phoneMain.on('click', '.btn-del', function () {
                            var $this = $(this);
                            layer.confirm('确定要删除吗？', function (index) {
                                var $item = $this.parent().parent()
                                    , $nextItem = $item.next()
                                    , itemId = $item.data('itemid');
                                method.diyData.deleteItem(itemId);
                                $item.remove();
                                $nextItem.trigger('click');
                                layer.close(index);
                            });
                        });
                    }

                },

                /**
                 * 模板引擎自定义函数
                 */
                templateHelper: function () {
                    template.defaults.escape = false;
                    // 计算对象总数
                    template.defaults.imports.objectKeys = function (object) {
                        console.log(Object.keys(object));
                        return Object.keys(object);
                    };
                },

                /**
                 * 注册数据绑定
                 */
                inputDataBind: function () {
                    // 绑定input修改事件
                    $(options.editor).on(
                        'input propertychange change'
                        , '[data-bind]'
                        , function () {
                            var $this = $(this)
                                , val = $this.val()
                                , itemIndex = $this.data('bind').split('.')
                                , itemId = $this.parents('form').data('itemid');
                            if (this.type === 'checkbox')
                                val = this.checked ? '1' : '0';
                            // 数据绑定 (最多支持3级)
                            method.diyData.setData(itemId, itemIndex, val);
                            // 重新渲染diy元素
                            method.render.refreshDiyItem(itemId);
                        });
                },

                /**
                 * 工具栏事件
                 */
                toolbar: {
                    /**
                     * 工具栏元素
                     */
                    diyMenu: $('#diy-menu'),

                    /**
                     * 执行初始化事件
                     */
                    execute: function () {
                        // 新增组件事件
                        this.components();
                        // 数据提交
                        this.submit();
                    },

                    /**
                     * 新增组件
                     */
                    components: function () {
                        this.diyMenu.find('.special').click(function () {
                            var type = $(this).data('type');
                            method.render.insertDiyItem(type);
                        });
                    },

                    /**
                     * 保存数据到后端
                     */
                    submit: function () {
                        $('#submit').click(function () {
                            if ($.isEmptyObject(diyData.items)) {
                                layer.msg('至少存在一个组件', {anim: 6});
                                return false;
                            }
                            $.post('', {data: JSON.stringify(diyData)}, function (result) {
                                result.code === 1 ? $.show_success(result.msg, result.url)
                                    : $.show_error(result.msg);
                            });
                        });
                    }

                }

            },

            /**
             * 编辑器类
             */
            editor: {
                // 添加元素类
                addItem: {

                    /**
                     * 添加图片轮播元素
                     * @param itemId
                     * @param $items
                     */
                    banner: function (itemId, $items) {
                        var dataItem = method.diyData.addItemData(itemId, 'banner');
                        $items.append(template('tpl_editor_data_item_image', dataItem));
                        // 选择图片
                        method.editor.event.selectImages($items);
                    },

                    /**
                     * 添加单图组元素
                     * @param itemId
                     * @param $items
                     */
                    imageSingle: function (itemId, $items) {
                        var dataItem = method.diyData.addItemData(itemId, 'imageSingle');
                        $items.append(template('tpl_editor_data_item_image', dataItem));
                        // 选择图片
                        method.editor.event.selectImages($items);
                    },

                    /**
                     * 添加按钮组元素
                     * @param itemId
                     * @param $items
                     */
                    navBar: function (itemId, $items) {
                        var dataItem = method.diyData.addItemData(itemId, 'navBar');
                        $items.append(template('tpl_editor_data_item_navBar', dataItem));
                        // 选择图片
                        method.editor.event.selectImages($items);
                    },

                    /**
                     * 添加图片橱窗元素
                     * @param itemId
                     * @param $items
                     */
                    window: function (itemId, $items) {
                        var dataItem = method.diyData.addItemData(itemId, 'window');
                        $items.append(template('tpl_editor_data_item_image', dataItem));
                        // 选择图片
                        method.editor.event.selectImages($items);
                    },

                    /**
                     * 添加商品数据
                     * @param itemId
                     * @param data
                     * @param $items
                     */
                    goods: function (itemId, data, $items) {
                        var datas = method.diyData.addItemDatas(itemId, data);
                        $items.append(template('tpl_editor_data_item_goods', datas));
                    }

                },

                // 事件方法
                event: {

                    $form: null,

                    /**
                     * 事件注册
                     */
                    register: function ($form, item) {
                        // form 元素
                        this.$form = $form;
                        // 子元素拖拽事件
                        this.itemDDSort();
                        // input单/多选框事件
                        this.inputCheckbox();
                        // 注册select组件
                        this.amSelected();
                        // 删除子元素事件
                        this.itemDelete();
                        // 添加子元素事件
                        this.itemAdd();
                        // 图片选择事件
                        this.selectImages();
                        // input滑块移动事件
                        this.inputRange();
                        // 颜色重置事件
                        this.btnResetColor();
                        // 切换help内容 (radio)
                        this.switchHelp();
                        // 商品组件
                        if ($.inArray(item.type, ['goods']) > -1) {
                            // 切换容器
                            this.switchBox();
                            // 选择商品
                            this.selectGoods();
                        }
                        // 富文本
                        item.type === 'richText' && this.richText();
                    },

                    /**
                     * 拖拽事件
                     */
                    itemDDSort: function () {
                        this.$form.find('.form-items').DDSort({
                            target: '.drag',
                            delay: 50, // 延时处理，默认为 50 ms，防止手抖点击 A 链接无效
                            up: function () {
                                var $formItems = $(this).parent()
                                    , newData = {}
                                    , itemId = $formItems.parents('form').data('itemid');
                                $formItems.find('.form-item').each(function () {
                                    var key = $(this).data('key');
                                    newData[key] = diyData.items[itemId].data[key];
                                });
                                diyData.items[itemId].data = newData;
                                // 重新渲染diy元素
                                method.render.refreshDiyItem(itemId);
                            }
                        });
                    },

                    /**
                     * 单/多选框事件
                     */
                    inputCheckbox: function () {
                        // 单/多选框
                        this.$form.find('input[type=checkbox], input[type=radio]').uCheck();
                    },

                    /**
                     * input滑块移动事件
                     */
                    inputRange: function () {
                        this.$form.on('input propertychange change', 'input[type=range]', function () {
                            var $this = $(this);
                            $this.next('.display-value').find('span.value').text($this.val());
                        });
                    },

                    /**
                     * 注册select组件
                     */
                    amSelected: function () {
                        this.$form.find('select').selected();
                    },

                    /**
                     * 重置颜色
                     */
                    btnResetColor: function () {
                        this.$form.on('click', '.btn-resetColor', function () {
                            var $this = $(this);
                            $this.prev('input[type=color]').val($this.data('color')).change();
                        });
                    },

                    /**
                     * 删除子元素事件
                     */
                    itemDelete: function () {
                        var _this = this;
                        // 子元素删除事件
                        _this.$form.on('click', '.item-delete', function () {
                            var $this = $(this)
                                , $item = $this.parent();
                            if (_this.$form.find('.form-item').length <= 1) {
                                layer.msg('至少保留一个', {anim: 6});
                                return false;
                            }
                            // 方法: 删除元素
                            var doDelete = function () {
                                var key = $item.data('key')
                                    , itemId = $item.parents('form').data('itemid');
                                // 移除当前子元素
                                $item.remove();
                                delete diyData.items[itemId].data[key];
                                // 记录dataNum
                                if (diyData.items[itemId].hasOwnProperty('dataNum'))
                                    diyData.items[itemId].dataNum--;
                                // 重新渲染diy元素
                                method.render.refreshDiyItem(itemId);
                            };
                            // 无需确认删除
                            if ($this.data('no-confirm') === true) {
                                doDelete();
                                return false;
                            }
                            // 用户确认后删除
                            layer.confirm('您确定要删除吗？', {
                                title: '友情提示'
                            }, function (index) {
                                doDelete();
                                layer.close(index);
                            });
                        });
                    },

                    /**
                     * 添加子元素事件
                     */
                    itemAdd: function () {
                        this.$form.find('.j-data-add').click(function () {
                            var $items = $(this).prev('.form-items')
                                , itemId = $items.parent().data('itemid')
                                , type = diyData.items[itemId].type;
                            // 添加子元素
                            method.editor.addItem[type](itemId, $items);
                            // 重新渲染diy元素
                            method.render.refreshDiyItem(itemId);
                        });
                    },

                    /**
                     * 选择图片文件 (点击图片)
                     */
                    selectImages: function () {
                        // 选择图片
                        this.$form.find('.j-selectImg').selectImages({
                            done: function (data, $addon) {
                                $addon.children('img').attr('src', data[0].file_path);
                                $addon.children('input').val(data[0].file_path).change();
                            }
                        });
                    },

                    /**
                     * 切换help内容
                     */
                    switchHelp: function () {
                        var $switchHelp = this.$form.find('.j-switch-help')
                            , $helpBlock = $switchHelp.find('.help-block');
                        $switchHelp.find('input').change(function () {
                            var helpText = $(this).nextAll('.help:first').html();
                            if (typeof helpText === 'undefined') {
                                helpText = $helpBlock.data('default');
                            }
                            $helpBlock.find('small').html(helpText);
                        });
                    },

                    /**
                     * 切换box内容
                     */
                    switchBox: function () {
                        var $switch = this.$form.find('.j-switch-box');
                        if (!$switch.length)
                            return false;
                        var itemClass = $switch.data('item-class')
                            , $switchItem = this.$form.find('.' + itemClass);
                        $switch.find('input[data-switch]').change(function () {
                            var selectClass = $(this).data('switch');
                            $switchItem.addClass('am-hide')
                                .siblings('.' + selectClass)
                                .removeClass('am-hide');
                        });
                    },

                    /**
                     * 选择图片文件 (点击图片)
                     */
                    selectGoods: function () {
                        var $selectGoods = this.$form.find('.j-selectGoods')
                            , $formItems = $selectGoods.prev('.form-items')
                            , itemId = $selectGoods.parents('form').data('itemid')
                            , type = diyData.items[itemId].type;
                        // 选择图片
                        $selectGoods.selectData({
                            title: '选择商品',
                            uri: 'goods/lists&status=10',
                            duplicate: false,
                            dataIndex: 'goods_id',
                            done: function (data) {
                                // 添加子元素
                                method.editor.addItem[type](itemId, data, $formItems);
                                // 重新渲染diy元素
                                method.render.refreshDiyItem(itemId);
                            },
                            getExistData: function () {
                                var existdata = [];
                                for (var i in diyData.items[itemId].data) {
                                    if (diyData.items[itemId].data.hasOwnProperty(i)
                                        && typeof diyData.items[itemId].data[i]['goods_id'] !== 'undefined')
                                        existdata.push(diyData.items[itemId].data[i]['goods_id']);
                                }
                                return existdata;
                            }
                        });
                    },

                    /**
                     * 注册富文本编辑器
                     */
                    richText: function () {
                        var $form = this.$form;
                        // console.log();
                        UM.delEditor('ume-editor');
                        // 富文本编辑器
                        var um = UM.getEditor('ume-editor', {
                            initialFrameWidth: 375,
                            initialFrameHeight: 400
                        });
                        um.ready(function () {
                            um.addListener('contentChange', function () {
                                // console.log(um.getContent());
                                $form.find('.richtext').text(um.getContent()).trigger('change')
                            });
                        })
                    }

                }
            },

            /**
             * 渲染类
             */
            render: {

                /**
                 * 渲染整个diy页面
                 */
                main: function () {
                    var $diyPhoneMain = $(options.phoneMain);
                    var mainHtml = '';
                    $.each(diyData.items, function (index, item) {
                        var tpl = template('tpl_diy_' + item.type, item);
                        if (item.type === 'page') {
                            var $diyPage = function () {
                                return $diyPhoneMain.prev('#diy-page');
                            };
                            $diyPage().prop('outerHTML', tpl);
                            $diyPage().trigger('click');
                        } else {
                            mainHtml += tpl;
                        }
                    });
                    $diyPhoneMain.html(mainHtml);
                },

                /**
                 * 重新渲染diy子元素
                 * @param itemId
                 */
                refreshDiyItem: function (itemId) {
                    var item = diyData.items[itemId]
                        , html = template('tpl_diy_' + item.type, item)
                        , $diy = function () {
                        return $('#diy-' + item.id);
                    };
                    $diy().prop('outerHTML', html).addClass('selected');
                    $diy().addClass('selected');
                },

                /**
                 * 新增diy子元素
                 */
                insertDiyItem: function (type) {
                    // 新记录id
                    var diyItemId = method.diyData.newDataId();
                    var item = diyData.items[diyItemId] = $.extend(true, {}, {
                        id: diyItemId,
                        type: type
                    }, defaultData[type]);
                    // 处理子元素集
                    if (item.hasOwnProperty('data')) {
                        var data = {};
                        $.each(item.data, function (index, val) {
                            var dataId = method.diyData.newDataId();
                            data[dataId] = val;
                        });
                        item.data = data;
                    }
                    // 渲染页面
                    var html = template('tpl_diy_' + type, item);
                    $(options.phoneMain).append(html)
                        .find('#diy-' + diyItemId).trigger('click');
                },

                /**
                 * 渲染元素编辑器
                 * @param itemId
                 */
                editor: function (itemId) {
                    var item = diyData.items[itemId]
                        , $form = $(template('tpl_editor_' + item.type, item));

                    // 注册所有事件
                    // method.editor.event.register($form, item);

                    // 写入编辑器
                    $('#diy-editor').find('.inner').html($form);

                    // 注册所有事件
                    method.editor.event.register($form, item);
                }

            },

            /**
             * diy数据类
             */
            diyData: {

                /**
                 * 生成新增数据的id
                 * @returns {string}
                 */
                newDataId: function () {
                    return 'n' + Math.random().toString().substr(3);
                },

                /**
                 * 数据绑定
                 * @param itemId
                 * @param itemIndex
                 * @param val
                 */
                setData: function (itemId, itemIndex, val) {
                    var item = diyData.items[itemId][itemIndex[0]];
                    switch (itemIndex.length) {
                        case 1:
                            item = val;
                            break;
                        case 2:
                            item[itemIndex[1]] = val;
                            break;
                        case 3:
                            item[itemIndex[1]][itemIndex[2]] = val;
                            break;
                    }
                },

                /**
                 * 添加子元素数据
                 * @param itemId
                 * @param itemType
                 * @returns {*}
                 */
                addItemData: function (itemId, itemType) {
                    var dataId = this.newDataId()
                        , data = {}
                        , defaultItemData = defaultData[itemType].data[0];
                    data[dataId] = $.extend(true, {dataId: dataId}, defaultItemData);
                    diyData.items[itemId].data[dataId] = data[dataId];
                    // 记录dataNum
                    if (diyData.items[itemId].hasOwnProperty('dataNum'))
                        diyData.items[itemId].dataNum++;
                    return data;
                },

                /**
                 * 添加子元素数据集
                 * @param itemId
                 * @param list
                 * @returns {*}
                 */
                addItemDatas: function (itemId, list) {
                    var _this = this;
                    var datas = {};
                    list.forEach(function (item) {
                        var dataId = _this.newDataId();
                        datas[dataId] = item;
                        diyData.items[itemId].data[dataId] = item;
                    });
                    return datas;
                },

                /**
                 * 删除diy元素
                 */
                deleteItem: function (itemId) {
                    delete diyData.items[itemId];
                }
            }

        };

    /***
     * 前端可视化diy
     * @constructor
     */
    function diyPhone(data, opts) {
        // diy 数据
        diyData = $.extend(true, diyData, data);
        // 配置信息
        options = $.extend({}, {phoneMain: '#phone-main', editor: '#diy-editor'}, opts);
        // 执行初始化
        method.init.execute();
    }

    diyPhone.prototype = {};

    window.diyPhone = diyPhone;

})(window);
