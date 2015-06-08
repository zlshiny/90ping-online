/*用户表*/
CREATE TABLE `user`(
    `user_id` int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
    `name` varchar(30) NOT NULL DEFAULT '' COMMENT '真实名字',
    `phone` bigint NOT NULL DEFAULT 0 COMMENT 'phone number',
    `email` varchar(30) NOT NULL DEFAULT '',
    `passwd` varchar(60) NOT NULL DEFAULT '' COMMENT 'passwd',
    `gender` tinyint NOT NULL DEFAULT 0,
    `status` tinyint NOT NULL DEFAULT 0 COMMENT '0:预约(没设密码)，1:信息已补充完整',
    `age` tinyint NOT NULL DEFAULT 0 COMMENT '0:未定, 1:80后, 2:80前',
    `age_range` tinyint NOT NULL DEFAULT 0 COMMENT '0:85前,1:85后',
    `encrypt_cookie` char(20) NOT NULL DEFAULT '' COMMENT 'cookie加密串',
    `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间'
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*户型表*/
CREATE TABLE `house`(
    `id` int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `order_id` int UNSIGNED NOT NULL DEFAULT 0,
    `user_id` int UNSIGNED NOT NULL DEFAULT 0,
    `acreage` decimal(5,2) NOT NULL DEFAULT 0.0 COMMENT '面积',
    `htype` tinyint NOT NULL DEFAULT 0 COMMENT '户型,如一居室',
    `layout` tinyint NOT NULL DEFAULT 0 COMMENT '房屋类型,如LOFT或平层等',
    `is_decor` tinyint NOT NULL DEFAULT 0 COMMENT '新房或二手房,0新房,1二手房',
    `province` tinyint NOT NULL DEFAULT 0,
    `city` smallint NOT NULL DEFAULT 0,
    `district` tinyint NOT NULL DEFAULT 0 COMMENT '市辖区',
    `area` varchar(256) NOT NULL DEFAULT '' COMMENT '小区名',
    `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '录入时间'
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*订单表*/
CREATE TABLE `orders`(
    `id` int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `house_id` int UNSIGNED NOT NULL DEFAULT 0,
    `user_id` int UNSIGNED NOT NULL DEFAULT 0,
    `product_id` tinyint NOT NULL DEFAULT 0 COMMENT '产品类型ID',
    `serial_number` char(32) NOT NULL DEFAULT '' COMMENT '订单号',
    `deposit` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '订金',
    `status` tinyint UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单状态',
    `source` tinyint UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单来源, 0:网站, 1:微信',
    `is_deal` tinyint NOT NULL DEFAULT 0 COMMENT '是否已沟通',
    `deal_time` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '处理时间',
    `decor_time` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '装修时间',
    `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `price` int NOT NULL DEFAULT 0 COMMENT '订单价格',
    `personal_config` varchar(256) NOT NULL DEFAULT '',
    `is_personal` tinyint NOT NULL DEFAULT 0 COMMENT '是否个性化, 0:no 1:yes'
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `orders_personal`(
    `id` int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `order_id` int unsigned NOT NULL default 0,
    `personal_config_id` tinyint NOT NULL DEFAULT 0,
    `color` VARCHAR(16) NOT NULL DEFAULT ''
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*产品表*/
CREATE TABLE `product`(
    `id` tinyint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(64) NOT NULL DEFAULT '',
    `price` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '价格'
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `loan`(
    `id` int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user_id` int UNSIGNED NOT NULL DEFAULT 0,
    `status` tinyint UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态',
    `organization` tinyint NOT NULL DEFAULT 0 COMMENT '工作单位性质,1:国企,2:事业单位,3:私营企业',
    `income` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '月收入',
    `expect_amount` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '期望贷款金额',
    `real_amount` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '实际贷款金额',
    `location` varchar(128) NOT NULL DEFAULT '' COMMENT '房屋地址',
    `acreage` decimal(5,2) NOT NULL DEFAULT 0.0 COMMENT '房屋面积',
    `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `personal_config`(
    `id` TINYINT PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(32) NOT NULL DEFAULT '' COMMENT '配置名',
    `color_list` varchar(64) NOT NULL DEFAULT '' COMMENT '可选颜色,"|"分割,',
    `price` int NOT NULL DEFAULT 0 COMMENT 'price'
) ENGINE=INNODB DEFAULT CHARSET=utf8;
insert into `personal_config`(`name`, `color_list`, `price`) values('吊顶', '红色|蓝色', 3200), ('沙发', '灰色', 8900),
    ('床垫', '', 840),('门', '红色|绿色', 5400),('卫生间', '', 12000);

insert into `personal_config`(`name`, `color_list`, `price`) values('TATA推拉门', '', 4200), ('科勒智能马桶盖', '', 2499),
    ('方太柏厨吧台', '', 3150),('西门子USB插口', '', 100),('核桃锁', '', 1080),('卫生间', '', 169000),('梳妆台', '', 2000),
    ('梳妆凳', '', 650), ('皮质沙发', '', 5000), ('新西兰手工羊毛地毯', '', 4100);

CREATE TABLE `neighbor_together`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT UNSIGNED NOT NULL DEFAULT 0,
    `uname` varchar(64) NOT NULL DEFAULT '' COMMENT '发起者姓名',
    `phone` bigint NOT NULL DEFAULT 0 COMMENT 'phone number',
    `current_ucount` TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT '当前参与人数',
    `current_state` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '当前阶段',
    `slogan` varchar(255) NOT NULL DEFAULT '' COMMENT '口号',
    `target_state` TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT '目标阶段',
    `district` varchar(128) NOT NULL DEFAULT '' COMMENT '小区名',
    `tablet` varchar(32) NOT NULL DEFAULT '' COMMENT '门牌号',
    `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `neighbor_together_user`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `nt_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动ID',
    `user_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '参与人',
    `phone` bigint NOT NULL DEFAULT 0 COMMENT 'phone number',
    `uname` varchar(64) NOT NULL DEFAULT '' COMMENT '参与者姓名',
    `tablet` varchar(32) NOT NULL DEFAULT '' COMMENT '门牌号',
    `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB DEFAULT CHARSET=utf8;
