<?php
/**
 * 后台菜单配置
 *    'home' => [
 *       'name' => '首页',                // 菜单名称
 *       'icon' => 'icon-home',          // 图标 (class)
 *       'index' => 'index/index',         // 链接
 *     ],
 */
return [
    'index' => [
        'name' => '首页',
        'icon' => 'icon-home',
        'index' => 'index/index',
    ],
    'orders' => [
        'name' => '订单管理',
        'icon' => 'icon-order',
        'index' => 'orders/ing',
        'submenu' => [
            [
                'name' => '进行中',
                'index' => 'orders/ing',
            ],
            [
                'name' => '已完成',
                'index' => 'orders/complete',
            ],
            [
                'name' => '已撤单',
                'index' => 'orders/cancel',
            ],
            [
                'name' => '已逾期',
                'index' => 'orders/late',
            ],
            [
                'name' => '全部订单',
                'index' => 'orders/all',
            ]

        ],
    ],
    'project' => [
        'name' => '项目管理',
        'icon' => 'am-icon-book',
        'index' => 'project/index',
        'submenu' => [
            [
                'name' => '项目详情',
                'index' => 'project/index',
                'uris' => [
                    'project/index',
                    'project/add',
                    'project/edit'
                ],
            ],
            [
                'name' => '分类管理',
                'index' => 'project.classify/index',
                'uris' => [
                    'project.classify/index',
                    'project.classify/add',
                    'project.classify/edit',
                ],
            ],
            [
                'name' => '下架商品管理',
                'index' => 'project.lowshelf/index',
                'uris' => [
                    'project.classify/index',
                    'project.classify/add',
                    'project.classify/edit',
                ],
            ]
        ],
    ],
    'staff' => [
        'name' => '员工管理',
        'icon' => 'am-icon-users',
        'index' => 'staff/index',
        'submenu' => [
            [
                'name' => '员工详情',
                'index' => 'staff/index',
                'uris' => [
                    'staff/index',
                    'staff/add',
                    'staff/edit'
                ],
            ],
            [
                'name' => '员工段位',
                'index' => 'staff.job/index',
                'uris' => [
                    'staff.job/index',
                    'staff.job/add',
                    'staff.job/edit',
                ],
            ],
            [
                'name' => '冻结列表',
                'index' => 'staff.ice/index',
            ],
        ],
    ],
    'user' => [
        'name' => '会员管理',
        'icon' => 'icon-user',
        'index' => 'user/index',
    ],
    'store' => [
        'name' => '门店管理',
        'icon' => 'am-icon-shopping-bag',
        'index' => 'store/index',
    ],
    'reform' => [
        'name' => '统计报表',
        'icon' => 'icon-home',
        'index' => 'reform/index',
       ],
    'setting' => [
        'name' => '设置',
        'icon' => 'icon-setting',
        'index' => 'setting/store',
        'submenu' => [
            [
                'name' => '其他',
                'active' => true,
                'submenu' => [
                    [
                        'name' => '清理缓存',
                        'index' => 'setting.cache/clear'
                    ],
                    [
                        'name' => '环境检测',
                        'index' => 'setting.science/index'
                    ],
                ]

            ]
        ],
    ],

];
