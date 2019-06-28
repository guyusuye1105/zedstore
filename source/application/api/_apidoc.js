/**
 * @apiDefine wxappbase
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "wxapp": {
             "is_service": 0,
             "is_phone": 0,
             "phone_no": "",
             "service_image": null,
             "phone_image": null,
             "navbar": {
                 "wxapp_title": "李晨杰2",
                 "top_text_color": {
                     "text": "#ffffff",
                     "value": 20
                 },
                 "top_background_color": "#fd4a5f"
             }
         }
     }
 }
 **/

/**
 * @apiDefine userindexdetail
 *
 * @apiParam {Int} wxapp_id
 * @apiParam {String} token 用户身份标识
 * @apiSuccess 	nickName  昵称
 * @apiSuccess 	gender  性别
 * @apiSuccess 	mobile  电话号码
 * @apiSuccess 	birthday  生日
 * @apiSuccess 	shop_time  消费次数
 * @apiSuccess 	shop_money  消费金额
 * @apiSuccess 	cover  头像
 * @apiSuccess 	change_birthday  是否修改生日（1是0否）
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "userInfo": {
             "user_id": 4,
             "open_id": "oS6g34ztf1TwiqBeQVwcyE2Gn_-4",
             "nickName": "顾与苏夜",
             "avatarUrl": "https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLnkHqEJdg6Hts1ibnXQxAK22Yia7ESCicKLkiao7mPuYYbibB3iaaVTv2y4ATloUnLeytLD3aRF24yLXgQ/132",
             "gender": "男",
             "country": "中国",
             "province": "浙江",
             "city": "绍兴",
             "address_id": 0,
             "card": 0,
             "mobile": "",
             "birthday": "",
             "shop_time": 0,
             "shop_money": 0,
             "change_birthday": 0,
             "cover": "",
             "address": [],
             "address_default": null
         },
         "orderCount": {
             "payment": 0,
             "received": 0
         }
     }
 }
 **/

/**
 * @apiDefine projectgetclassify
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	id  项目id
 * @apiSuccess 	name	项目名
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "list": {
             "total": 8,
             "per_page": 2,
             "current_page": 1,
             "last_page": 4,
             "data": [
                 {
                     "id": 2,
                     "name": "美睫"
                 },
                 {
                     "id": 3,
                     "name": "手足护理"
                 }
             ]
         }
     }
 }
 **/

/**
 * @apiDefine storelists
 *
 * @apiParam {Int} wxapp_id
 * @apiParam {Int} id   门店id
 * @apiSuccess 	per_page  每页个数
 * @apiSuccess 	current_page	当前页
 * @apiSuccess 	id
 * @apiSuccess 	store_name  店名
 * @apiSuccess 	store_mobile  电话号码
 * @apiSuccess 	worktime  营业时间
 * @apiSuccess 	province  省
 * @apiSuccess 	city  市
 * @apiSuccess 	county  区
 * @apiSuccess 	address  详细地址
 * @apiSuccess 	longitude  经度
 * @apiSuccess 	latitude  纬度
 * @apiSuccess 	slide  轮播图(;分割)
 * @apiSuccess 	describe  详细描述
 * @apiSuccess 	store_num  门店编号
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "list": {
             "total": 1,
             "per_page": 2,
             "current_page": 1,
             "last_page": 1,
             "data": [
                 {
                     "id": 1,
                     "store_name": "滨江店",
                     "store_mobile": "110",
                     "worktime": "7:00-20:00",
                     "province": "浙江省",
                     "city": "杭州市",
                     "county": "滨江区",
                     "address": "110号",
                     "longitude": "111",
                     "latitude": "222",
                     "slide": "http://localhost:9000/my_mp/addons/yiovo_shop/web/uploads/20181116155526c35614286.jpg;http://localhost:9000/my_mp/addons/yiovo_shop/web/uploads/201811171549185db733693.jpg",
                     "describe": "                                    11                                    ",
                     "store_num": "1111"
                 }
             ]
         }
     }
 }
 **/
/**
 * @apiDefine stafflists
 *
 * @apiParam {Int} wxapp_id
 * @apiParam {Int} id   服务的id，不传则输出所有
 * @apiParam {Int} job_id   所属项目的id，不传则输出所有
 * @apiParam {Int} pagesize   每页个数，
 * @apiParam {Int} page   显示第几页，不上传显示第一页
 * @apiSuccess 	id
 * @apiSuccess 	name  员工姓名
 * @apiSuccess 	type  员工类型（admin管理员 waiter服务员）
 * @apiSuccess 	job_id  员工职称id
 * @apiSuccess 	account  员工账号
 * @apiSuccess 	cover  员工头像(只有一个)
 * @apiSuccess 	mobile  手机号码
 * @apiSuccess 	is_vacation  是否休假（1是0否）
 * @apiSuccess 	is_free  是否空闲(1是0否)
 * @apiSuccess 	create_time
 * @apiSuccess 	vacation_time  休假日期
 * @apiSuccess 	job_name  员工职称名
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "list": {
             "total": 1,
             "per_page": 2,
             "current_page": 1,
             "last_page": 1,
             "data": [
                 {
                     "id": 1,
                     "name": "张三22",
                     "type": "admin",
                     "job_id": "1",
                     "account": "2018101011",
                     "cover": "http://localhost:9000/my_mp/addons/yiovo_shop/web/uploads/20181116155526c35614286.jpg",
                     "mobile": "18769347123",
                     "is_vacation": 0,
                     "is_free": 0,
                     "create_time": "1970-01-01 08:00:00",
                     "vacation_time": "323",
                     "job_name": "店长"
                 }
             ]
         }
     }
 }
 **/
/**
 * @apiDefine projectlists
 *
 * @apiParam {Int} wxapp_id
 * @apiParam {Int} project_id   所属项目id,不传则获得所有
 * @apiSuccess 	id
 * @apiSuccess 	project_id  所属项目ID
 * @apiSuccess 	name
 * @apiSuccess 	cover  主图片（只限一张）（暂时保留功能）
 * @apiSuccess 	account  员工账号
 * @apiSuccess 	cover  员工头像(只有一个)
 * @apiSuccess 	slide  项目图片（最多5张,以数组形式返回）
 * @apiSuccess 	price  价格
 * @apiSuccess 	exchange  兑换积分数值
 * @apiSuccess 	describe  描述
 * @apiSuccess 	attr  对应属性ID
 * @apiSuccess 	project_name  所属项目名字
 * @apiSuccess 	content_type  预约内容类型（1表示一个项目最多一个服务，相同服务不能选多个，2,3等待后续添加）
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "list": [
             {
                 "id": 1,
                 "project_id": 2,
                 "name": "五彩缤纷",
                 "cover": "",
                 "slide": [
                     "https://file.minstech.cn/addons/mshop/uploads/20181127192137e5cd97798.jpg",
                     "https://file.minstech.cn/addons/mshop/uploads/2018112719183290a831678.jpg"
                 ],
                 "price": "111",
                 "sort": 0,
                 "status": 1,
                 "exchange": 323,
                 "describe": "                                                                                                                                                                                                                                                               ",
                 "attr": "",
                 "wxapp_id": 10,
                 "content_type": 1,
                 "project_name": "染发"
             },
  **/

/**
 * @apiDefine projectonelists
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	id
 * @apiSuccess 	name    服务名称
 * @apiSuccess 	cover  主图片（只限一张）（暂时保留功能）
 * @apiSuccess 	cover  员工头像(只有一个)
 * @apiSuccess 	slide  项目图片（最多5张,返回数组）
 * @apiSuccess 	price  价格
 * @apiSuccess 	exchange  兑换积分数值
 * @apiSuccess 	describe  描述
 * @apiSuccess 	attr  对应属性（一个属性下有多个描述时候，用;分割）
 * @apiSuccess 	project_name  所属项目名字
 * @apiSuccess 	content_type  预约内容类型（1表示一个项目最多一个服务，相同服务不能选多个，2,3等待后续添加）
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "list": {
             "id": 1,
             "project_id": 2,
             "name": "五彩缤纷",
             "cover": "",
             "slide": [
                 "https://file.minstech.cn/addons/mshop/uploads/20181127192137e5cd97798.jpg",
                 "https://file.minstech.cn/addons/mshop/uploads/2018112719183290a831678.jpg"
             ],
             "price": "111",
             "sort": 0,
             "status": 1,
             "exchange": 323,
             "describe": "                                                                                                                                           3232                                                                                                                ",
             "attr": [
                 [
                     "yans ",
                     [
                         "hong",
                         "baise"
                     ]
                 ],
                 [
                     "优惠",
                     [
                         "八折"
                     ]
                 ],
                 [
                     "地带",
                     [
                         "地带"
                     ]
                 ]
             ],
             "wxapp_id": 10,
             "content_type": 1
         }
     }
 }
  **/


/**
 * @apiDefine appointgetTimeStrip
 *
 * @apiParam {Int} wxapp_id
 * @apiParam {String} day  当前选中日期（格式2011-01-02）（必填）
 * @apiParam {Int} staff_id 当前选中人员id，可以不填
 * @apiSuccess 	id
 * @apiSuccess 	name	时间段名称
 * @apiSuccess 	type	时间段类型，上午morning下午afternoon晚上evening
 * @apiSuccess 	show	overtime过去的时间 free空闲 appoint被预约 vacation休假中
 * @apiSuccessExample  Response (example):
 {
{
	"code": 1,
	"msg": "success",
	"data": {
		"list": {
			"morning": [
				{
					"id": 1,
					"name": "07:00",
					"begin_time": 25200,
					"end_time": 0,
					"wxapp_id": 10,
					"type": "morning",
					"sort": 1,
					"begin_use_time": 0,
					"end_use_time": 2147483647,
					"show": "overtime"
				},
				{
					"id": 2,
					"name": "08:00",
					"begin_time": 28800,
					"end_time": 0,
					"wxapp_id": 10,
					"type": "morning",
					"sort": 2,
					"begin_use_time": 0,
					"end_use_time": 2147483647,
					"show": "overtime"
				}
			],
			"afternoon": [
				{
					"id": 3,
					"name": "13:00",
					"begin_time": 46800,
					"end_time": 0,
					"wxapp_id": 10,
					"type": "afternoon",
					"sort": 3,
					"begin_use_time": 0,
					"end_use_time": 2147483647,
					"show": "overtime"
				}
			],
			"evening": [
				{
					"id": 4,
					"name": "20:00",
					"begin_time": 72000,
					"end_time": 0,
					"wxapp_id": 10,
					"type": "evening",
					"sort": 4,
					"begin_use_time": 0,
					"end_use_time": 2147483647,
					"show": "overtime"
				}
			]
		}
	}
}
 **/
/**
 * @apiDefine appointgetstaff
 *
 * @apiParam {Int} wxapp_id
 * @apiParam {String} day  当前选中日期（格式2011-01-02）（必填）
 * @apiParam {Int} timeduan 时间段id，必填
 * @apiSuccess 	id
 * @apiSuccess 	name	员工姓名
 * @apiSuccess 	type	员工类型（admin管理员 waiter服务员）
 * @apiSuccess 	job_id	员工职称id
 * @apiSuccess 	account	员工账号
 * @apiSuccess 	cover	员工头像
 * @apiSuccess 	mobile	手机号码
 * @apiSuccess 	is_vacation	是否休假（1是0否）
 * @apiSuccess 	is_free	是否空闲(1是0否)
 * @apiSuccess 	show	free空闲 appoint被预约 vacation休假中
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "list": {
             "1": {
                 "id": 1,
                 "name": "张三22",
                 "type": "admin",
                 "job_id": "1",
                 "account": "2018101011",
                 "cover": "http://localhost:9000/my_mp/addons/yiovo_shop/web/uploads/20181116155526c35614286.jpg",
                 "password": "1111",
                 "mobile": "18769347123",
                 "is_vacation": 0,
                 "is_free": 0,
                 "sort": 0,
                 "create_time": 0,
                 "wxapp_id": 10,
                 "vacation_time": "323",
                 "show": "appoint"
             },
             "2": {
                 "id": 2,
                 "name": "4",
                 "type": "admin",
                 "job_id": "1",
                 "account": "1",
                 "cover": "",
                 "password": "",
                 "mobile": "3",
                 "is_vacation": 0,
                 "is_free": 0,
                 "sort": 0,
                 "create_time": 1542768021,
                 "wxapp_id": 10,
                 "vacation_time": "",
                 "show": "free"
             }
         }
     }
 }
 **/
/**
 * @apiDefine appointappoint
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	data    预约成功
 * @apiError    msg false
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": "预约成功"
 }
 * @apiErrorExample Response (example):
 {
	"code": 0,
	"msg": "对不起，预约失败，请重试",
	"data": []
}
 **/
/**
 * @apiDefine shopbaggetShopBag
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	id
 * @apiSuccess 	user_id    成员id
 * @apiSuccess 	item_content    预约袋内容（数组）
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "list": {
             "id": 1,
             "user_id": 1,
             "item_content": [
                 {
                     "id": 2,
                     "project_id": 3,
                     "name": "流彩备份",
                     "cover": "",
                     "slide": "https://timgsa.baidu.com/timg?image&quality=80;https://timgsa.baidu.com/timg?image&quality=80",
                     "price": "111",
                     "sort": 0,
                     "status": 0,
                     "exchange": 0,
                     "describe": "                                                                                                                                                                                                        11                                                     ",
                     "attr": "",
                     "wxapp_id": 10,
                     "content_type": 1
                 },
                 {
                     "id": 3,
                     "project_id": 1,
                     "name": "意可贴",
                     "cover": "",
                     "slide": "http://localhost:9000/my_mp/addons/yiovo_shop/web/uploads/20181116155526c35614286.jpg",
                     "price": "111",
                     "sort": 0,
                     "status": 0,
                     "exchange": 0,
                     "describe": "11",
                     "attr": "1",
                     "wxapp_id": 10,
                     "content_type": 1
                 }
             ],
             "wxapp_id": 10
         }
     }
 }
 **/
/**
 * @apiDefine shopbagsaveShopBag
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	msg 保存成功（以后所有保存操作成功默认code1,失败code0）
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "保存成功",
     "data": []
 }
 * @apiErrorExample Response (example):
 {
	"code": 0,
	"msg": "保存失败",
	"data": []
}
 **/
/**
 * @apiDefine userupdate
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	msg 修改成功（以后所有保存操作成功默认code1,失败code0）
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": "修改成功！"
 }
 * @apiErrorExample Response (example):
 {
	"code": 0,
	"msg": "修改失败",
	"data": []
}
 **/
/**
 * @apiDefine oredersgetLists
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	id
 * @apiSuccess 	list.total  总个数
 * @apiSuccess 	list.last_page  总页数
 * @apiSuccess 	color  default默认不做改变， red已经到达订单时间但是员工没有确认到店,yellow还有半个小时到达订单预约时间,green员工确认到店正在服务中
 * @apiSuccess 	num  订单编号
 * @apiSuccess 	user_id  用户id
 * @apiSuccess 	item_id  服务id(用;分割)
 * @apiSuccess 	create_time  创建时间
 * @apiSuccess 	appoint_time  预约时间
 * @apiSuccess 	staff_id  员工id
 * @apiSuccess 	state  订单状态（notgo未到店 inserver服务中 waitmoney待支付 complete已完成 cancel已撤单 late已逾期）
 * @apiSuccess 	type  订单类型（appoint预约订单 instore在店订单）
 * @apiSuccess 	addserver    附加服务价格（例如 18.6）
 * @apiSuccess 	discount    折扣（例如8.5）
 * @apiSuccess 	staff_name    服务人员名字
 * @apiSuccess 	staff_mobile    服务人员号码
 * @apiSuccess 	staff_type    服务人员类型
 * @apiSuccess 	staff_cover    服务人员头像
 * @apiSuccess 	item    服务项目的数组
 * @apiSuccess 	remark    备注
 * @apiSuccess 	price    总价
 * @apiSuccess    final_price  最终价格
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "list": {
             "rows": [
                 {
                     "id": 8,
                     "num": "",
                     "user_id": 2,
                     "item_id": "2;2;3",
                     "create_time": 1543895711,
                     "update_time": 1543895711,
                     "appoint_time": "1541890800",
                     "staff_id": 1,
                     "wxapp_id": 10,
                     "state": "notgo",
                     "type": "appoint",
                     "addserver": "0.00",
                     "discount": "",
                     "remark": "",
                     "price": "333.00",
                     "final_price": "333.00",
                     "is_comment": 0,
                     "store_id": 1,
                     "color": "red",
                     "staff_name": "李哥",
                     "staff_mobile": "18768392827",
                     "staff_type": "admin",
                     "staff_cover": "https://file.minstech.cn/addons/mshop/uploads/2018120310284504fdd3251.jpg",
                     "item": [
                         {
                             "id": 2,
                             "project_id": 3,
                             "name": "流彩指甲",
                             "cover": "",
                             "slide": "https://file.minstech.cn/addons/mshop/uploads/20181203101850a3c503165.jpg",
                             "price": "111",
                             "sort": 0,
                             "status": 0,
                             "exchange": 0,
                             "describe": "                                                                                                                                                                                                                                                               ",
                             "attr": "",
                             "wxapp_id": 10,
                             "content_type": 1
                         },
                         {
                             "id": 2,
                             "project_id": 3,
                             "name": "流彩指甲",
                             "cover": "",
                             "slide": "https://file.minstech.cn/addons/mshop/uploads/20181203101850a3c503165.jpg",
                             "price": "111",
                             "sort": 0,
                             "status": 0,
                             "exchange": 0,
                             "describe": "                                                                                                                                                                                                                                                               ",
                             "attr": "",
                             "wxapp_id": 10,
                             "content_type": 1
                         },
                         {
                             "id": 3,
                             "project_id": 2,
                             "name": "红色头发",
                             "cover": "",
                             "slide": "https://file.minstech.cn/addons/mshop/uploads/201812031018509b6939727.jpeg",
                             "price": "111",
                             "sort": 0,
                             "status": 0,
                             "exchange": 0,
                             "describe": "                                                                                                                        11                                                                                                            ",
                             "attr": "颜色;红色;;时长;1小时",
                             "wxapp_id": 10,
                             "content_type": 1
                         }
                     ]
                 }
             ],
             "total": 10,
             "last_page": 10
         }
     }
 }
 **/
/**
 * @apiDefine oredersaddLists
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	code    1代表成功，不等于1代表失败（例如0，-1）
 * @apiSuccess 	data  代表成功或失败的信息
 * @apiSuccessExample  Response (example):
 {
	"code": 1,
	"msg": "success",
	"data": "新增订单成功"
}
 **/
/**
 * @apiDefine orederscancelorder
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	code    1代表成功，不等于1代表失败（例如0，-1）
 * @apiSuccess 	data  代表成功或失败的信息
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": "撤单成功"
 }
 **/
/**
 * @apiDefine orederspay
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	code    1代表成功，不等于1代表失败（例如0，-1）
 * @apiSuccess 	data  代表成功或失败的信息
 * @apiSuccessExample  Response (example):
 {
    "code": 1,
    "msg": "success",
    "data": {
        "payment": {
            "prepay_id": "wx30163153452688412b49e7100419042676",
            "nonceStr": "3326fa351202a1d15bb403b530462df9",
            "timeStamp": "1548837113",
            "paySign": "73D9B6C4EB3152416BE4C374B88FE668"
        },
        "order_id": "500"
    }
}
 **/
/**
 * @apiDefine userbindmobile
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	code    1代表成功，不等于1代表失败（例如0，-1）
 * @apiSuccess 	data  代表成功或失败的信息
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": "绑定成功"
 }
 **/