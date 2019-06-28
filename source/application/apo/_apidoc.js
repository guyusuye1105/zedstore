/**
 * @apiDefine stafflogin
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	code    1代表成功，不等于1代表失败（例如0，-1）
 * @apiSuccess 	data  代表成功或失败的信息
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "id": 1,
         "name": "张三22",
         "type": "admin",
         "job_id": "1",
         "account": "test1",
         "cover": "https://file.minstech.cn/addons/mshop/uploads/20181129164142bc96b5342.jpg",
         "password": "e10adc3949ba59abbe56e057f20f883e",
         "mobile": "18769347123",
         "is_vacation": 0,
         "is_free": 1,
         "sort": 0,
         "create_time": 0,
         "wxapp_id": 10,
         "vacation_time": "323"
     }
 }
 * @apiErrorExample Response (example):
 {
     "code": 0,
     "msg": "密码错误", // 或者 该账号不存在
     "data": []
 }
 **/
/**
 * @apiDefine ordersworkStation
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	list.total 总个数
 * @apiSuccess 	list.last_page 总页数
 * @apiSuccess 	color  default默认不做改变， red已经到达订单时间但是员工没有确认到店,yellow还有半个小时到达订单预约时间,green员工确认到店正在服务中
 * @apiSuccess 	item_id 服务id（例如2;5;7）
 * @apiSuccess 	user_id 用户ID
 * @apiSuccess 	create_time 创建时间
 * @apiSuccess 	staff_id 所属员工id
 * @apiSuccess 	state 订单状态（notgo未到店 inserver服务中 waitmoney待支付 complete已完成 cancel已撤单 late已逾期）
 * @apiSuccess 	type 订单类型（appoint预约订单 instore在店订单）
 * @apiSuccess 	addserver 附加服务（价格）
 * @apiSuccess 	discount 折扣（例如8.5）
 * @apiSuccess 	remark 备注
 * @apiSuccess 	user_nickname 用户昵称
 * @apiSuccess 	user_mobile 用户手机号码
 * @apiSuccess 	user_card 用户卡号
 * @apiSuccess 	user_cover 用户头像
 * @apiSuccess 	item 数组，该订单的所有服务的信息
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "list": {
             "rows": [
                 {
                     "id": 1,
                     "num": "",
                     "user_id": 2,
                     "item_id": "2;2;3",
                     "create_time": 1543893025,
                     "update_time": 1543893025,
                     "appoint_time": "1543900440",
                     "staff_id": 2,
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
                     "user_nickname": "张鹏",
                     "user_mobile": "2222",
                     "user_card": 0,
                     "user_cover": "https://wx.qlogo.cn/mmopen/vi_32/ErWGnCKpHxV6gG6bPwxM7KwdXz3c9D3HBwDjhpibOMll4CVLzIwDKeZsFnyAfaOBib7QibW1IAz9oDmYYBPicnWXPg/132",
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
             "total": 7,
             "last_page": 7
         }
     }
 }
 **/
/**
 * @apiDefine ordersisInStore
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	code    1代表成功，不等于1代表失败（例如0，-1）
 * @apiSuccess 	data  代表成功或失败的信息
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "list": {
             "id": 1,
             "num": "2018120454569702",
             "user_id": 2,
             "item_id": "2;2;3",
             "create_time": "2018-12-04 11:10:25",
             "update_time": "2018-12-06 16:52:02",
             "appoint_time": "1543903500",
             "staff_id": 2,
             "state": "inserver",
             "type": "appoint",
             "addserver": "11.00",
             "discount": "8",
             "remark": "",
             "price": "333.00",
             "final_price": "91.00",
             "is_comment": 0,
             "store_id": 1
         }
     }
 }
 **/
/**
 * @apiDefine ordersupdateItem
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	code    1代表成功，不等于1代表失败（例如0，-1）
 * @apiSuccess 	data  代表成功或失败的信息
 * @apiSuccessExample  Response (example):
 {
	"code": 1,
	"msg": "success",
	"data": {
		"list": {
			"id": 118,
			"num": "",
			"user_id": 2,
			"item_id": "2",
			"create_time": "2018-11-30 17:06:51",
			"update_time": "2018-12-03 16:05:40",
			"appoint_time": "1543680000",
			"staff_id": 2,
			"state": "notgo",
			"type": "appoint",
			"addserver": "11.00",
			"discount": "",
			"remark": "",
			"price": "111.00",
			"final_price": "111.00",
			"is_comment": 0
		}
	}
}
 **/
/**
 * @apiDefine usersearchUser
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	total    数据总条数
 * @apiSuccess 	per_page  每页个数
 * @apiSuccess 	current_page  当前页码
 * @apiSuccess 	last_page  总页数
 * @apiSuccess 	nickName  昵称
 * @apiSuccess 	gender  性别
 * @apiSuccess 	card  会员卡号
 * @apiSuccess 	mobile  手机号码
 * @apiSuccess 	birthday  会员生日
 * @apiSuccess 	shop_time  消费次数
 * @apiSuccess 	shop_money  总消费金额
 * @apiSuccess 	avatarUrl  会员头像
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "list": {
             "total": 5,
             "per_page": "15",
             "current_page": 1,
             "last_page": 1,
             "data": [
                 {
                     "user_id": 2,
                     "open_id": "oS6g34_ARrnp99aIFhaRmLMDWhMc",
                     "nickName": "张鹏",
                     "avatarUrl": "https://wx.qlogo.cn/mmopen/vi_32/ErWGnCKpHxV6gG6bPwxM7KwdXz3c9D3HBwDjhpibOMll4CVLzIwDKeZsFnyAfaOBib7QibW1IAz9oDmYYBPicnWXPg/132",
                     "gender": "男",
                     "country": "中国",
                     "province": "江西",
                     "city": "九江",
                     "address_id": 0,
                     "create_time": "2018-11-21 15:03:26",
                     "update_time": "2018-11-30 16:58:36",
                     "card": 0,
                     "mobile": "ccccc",
                     "birthday": "2018-12-18",
                     "shop_time": 0,
                     "shop_money": 0,
                     "cover": ""
                 },
                 {
                     "user_id": 4,
                     "open_id": "oS6g34ztf1TwiqBeQVwcyE2Gn_-4",
                     "nickName": "顾与苏夜",
                     "avatarUrl": "https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLnkHqEJdg6Hts1ibnXQxAK22Yia7ESCicKLkiao7mPuYYbibB3iaaVTv2y4ATloUnLeytLD3aRF24yLXgQ/132",
                     "gender": "男",
                     "country": "中国",
                     "province": "浙江",
                     "city": "绍兴",
                     "address_id": 0,
                     "create_time": "2018-11-22 13:13:00",
                     "update_time": "2018-11-29 10:49:34",
                     "card": 0,
                     "mobile": "",
                     "birthday": "",
                     "shop_time": 0,
                     "shop_money": 0,
                     "cover": ""
                 },
                 {
                     "user_id": 6,
                     "open_id": "oS6g34_ARrnp99aIFhaRmLMDWhMc",
                     "nickName": "张鹏",
                     "avatarUrl": "https://wx.qlogo.cn/mmopen/vi_32/ErWGnCKpHxV6gG6bPwxM7KwdXz3c9D3HBwDjhpibOMll4CVLzIwDKeZsFnyAfaOBib7QibW1IAz9oDmYYBPicnWXPg/132",
                     "gender": "男",
                     "country": "中国",
                     "province": "江西",
                     "city": "九江",
                     "address_id": 1,
                     "create_time": "2018-11-26 19:23:28",
                     "update_time": "2018-11-27 14:35:16",
                     "card": 0,
                     "mobile": "",
                     "birthday": "",
                     "shop_time": 0,
                     "shop_money": 0,
                     "cover": ""
                 },
                 {
                     "user_id": 7,
                     "open_id": "oS6g34w03Sy84zmiOMq75oDXJHvw",
                     "nickName": "赵起帆EN",
                     "avatarUrl": "https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJak8cc3Xol8vAtajWc3Q8Oj70AtzMibq5wmcpAx4v6d7Tpe703HVmCk26ZRibvQUyMXHYwGyicgiaqyA/132",
                     "gender": "男",
                     "country": "安提瓜岛和巴布达",
                     "province": "",
                     "city": "",
                     "address_id": 0,
                     "create_time": "2018-11-27 11:42:38",
                     "update_time": "2018-11-27 11:42:38",
                     "card": 0,
                     "mobile": "",
                     "birthday": "",
                     "shop_time": 0,
                     "shop_money": 0,
                     "cover": ""
                 },
                 {
                     "user_id": 8,
                     "open_id": "oS6g342qvKPPEEKNGGWYSoXrh6ck",
                     "nickName": "乐乐浴",
                     "avatarUrl": "https://wx.qlogo.cn/mmopen/vi_32/9tJia3oNBjxqu8ju8iaia6tmausND8WqSha5QmHibNMem7nd1EHvXkhWAz2Rntrh6d9WQWPySlOo06DCxupaicDGUqQ/132",
                     "gender": "未知",
                     "country": "",
                     "province": "",
                     "city": "",
                     "address_id": 0,
                     "create_time": "2018-11-30 15:03:41",
                     "update_time": "2018-11-30 15:04:04",
                     "card": 0,
                     "mobile": "",
                     "birthday": "",
                     "shop_time": 0,
                     "shop_money": 0,
                     "cover": ""
                 }
             ]
         }
     }
 }
 **/
/**
 * @apiDefine ordersgetOrders
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	list.total 总个数
 * @apiSuccess 	list.last_page 总页数
 * @apiSuccess 	color  default默认不做改变， red已经到达订单时间但是员工没有确认到店,yellow还有半个小时到达订单预约时间,green员工确认到店正在服务中
 * @apiSuccess 	item_id 服务id（例如2;5;7）
 * @apiSuccess 	user_id 用户ID
 * @apiSuccess 	create_time 创建时间
 * @apiSuccess 	staff_id 所属员工id
 * @apiSuccess 	state 订单状态（notgo未到店 inserver服务中 waitmoney待支付 complete已完成 cancel已撤单 late已逾期）
 * @apiSuccess 	type 订单类型（appoint预约订单 instore在店订单）
 * @apiSuccess 	addserver 附加服务（价格）
 * @apiSuccess 	discount 折扣（例如8.5）
 * @apiSuccess 	remark 备注
 * @apiSuccess 	user_nickname 用户昵称
 * @apiSuccess 	user_mobile 用户手机号码
 * @apiSuccess 	user_card 用户卡号
 * @apiSuccess 	user_cover 用户头像
 * @apiSuccess 	item 数组，该订单的所有服务的信息
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "list": {
             "rows": [
                 {
                     "id": 1,
                     "num": "",
                     "user_id": 2,
                     "item_id": "2;2;3",
                     "create_time": 1543893025,
                     "update_time": 1543893025,
                     "appoint_time": "1543900440",
                     "staff_id": 2,
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
                     "user_nickname": "张鹏",
                     "user_mobile": "2222",
                     "user_card": 0,
                     "user_cover": "https://wx.qlogo.cn/mmopen/vi_32/ErWGnCKpHxV6gG6bPwxM7KwdXz3c9D3HBwDjhpibOMll4CVLzIwDKeZsFnyAfaOBib7QibW1IAz9oDmYYBPicnWXPg/132",
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
             "total": 7,
             "last_page": 7
         }
     }
 }
 **/
/**
 * @apiDefine staffdetail
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	code    1代表成功，不等于1代表失败（例如0，-1）
 * @apiSuccess 	data  代表成功或失败的信息
 * @apiSuccess 	nick_name  我的花名
 * @apiSuccess 	name  姓名
 * @apiSuccess 	account  账号
 * @apiSuccess 	mobile  手机号
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": {
         "id": 1,
         "name": "张三22",
         "type": "admin",
         "job_id": "1",
         "account": "test1",
         "cover": "https://file.minstech.cn/addons/mshop/uploads/20181129164142bc96b5342.jpg",
         "password": "e10adc3949ba59abbe56e057f20f883e",
         "mobile": "18769347123",
         "is_vacation": 0,
         "is_free": 1,
         "sort": 0,
         "create_time": 0,
         "wxapp_id": 10,
         "nick_name": '人见人爱花见花开车见车爆胎的吴彦祖同学',
         "vacation_time": "323"
     }
 }
 **/
/**
 * @apiDefine staffupdate
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	code    1代表成功，不等于1代表失败（例如0，-1）
 * @apiSuccess 	data  代表成功或失败的信息
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": "修改成功！"
 }
 **/
/**
 * @apiDefine staffeditpwd
 *
 * @apiParam {Int} wxapp_id
 * @apiSuccess 	code    1代表成功，不等于1代表失败（例如0，-1）
 * @apiSuccess 	data  代表成功或失败的信息
 * @apiSuccessExample  Response (example):
 {
     "code": 1,
     "msg": "success",
     "data": "密码修改成功"
 }
 **/