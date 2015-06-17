<!DOCTYPE html>
<!--HTML5 doctype-->
<html>
<head>
    <title>免费众筹iPhone6，你也来拼一下人品？</title>
    <meta name="description" content="史上第一个专注于80后家装产品-超级Home1.0，配置顶级家具软装和高端厨卫，拎包入住"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/static/css/activity/iphone_h5.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/h5v2/common.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/h5v2/swiper.css" />
    <script type="text/javascript" charset="utf-8" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/fastclick.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/activity/iphone_h5.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/swiper.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/h5v2/common.js"></script>
    <style type="text/css">
    .menu_img {
        position:fixed;
        width:100%;
        height:50px;
        /*background-image:url('/static/image/wechat/menu.jpg');*/
        background-color:#333333;
        text-align:center;
        line-height:50px;
        z-index: 5;
    }

    .bgcl{
	    background-color:#1dd2af;
	    padding:10px 80px;
	    display:inline;	
	    position:relative;
	    border-radius: 10px;
	    -webkit-border-radius: 10px;
	    color:#fff;
        z-index:6;
    }
    .ft48{
	    font-size:22px;
    }
    .margin_conf{
        margin-bottom: 15px;
    }
    </style>
    <script>
    var _hmt = _hmt || [];
    (function() {
     var hm = document.createElement("script");
     hm.src = "//hm.baidu.com/hm.js?f6c15189a037831e314d611395fd9dfe";
     var s = document.getElementsByTagName("script")[0]; 
     s.parentNode.insertBefore(hm, s);
     })();
    </script>
</head>

<body>
<div id="title_img">
<img src="/static/image/activity/iphone/iphone5.jpg">
</div>
<input type="hidden" id="name" value="<?php if($login_user):?><?=$login_user['name'];?><?php endif;?>" />
<input type="hidden" id="head_img_url" value="<?php if($login_user):?><?=$login_user['head_img_url'];?><?php endif;?>" />

<div>
    <div style="top:60%;text-align:center;position:fixed;right:1px;bottom:0px;z-index:100;">
        <a href="#h5_top" style="display:block;color:#fff;text-decoration:none;font-size:14px;padding: 12px 6px;background-color:#d0021b;height:40px;width:40px;font-family:'华文细黑','Microsoft Yahei';">详情</a>
        <a href="#appoint" style="margin-top:2px;color:#fff;display:block;text-decoration:none;font-size:14px;padding: 12px 6px;background-color:#07162b;height:40px;width:40px;font-family:'华文细黑','Microsoft Yahei';">预约</a>
    </div>
</div>

<section id="view-5" class="section">
    <p style="margin-top:5px;margin-left:5px; float:left;font-size:12px;color:#b3b1b4;">专注80后互联网智能家装产品 <a href="/wechat/product/">超级Home</a> 上线,赠送</p>
    <div class="title"><h3 style="display:inline;"><?=$user['nickname'];?></h3> 已众筹到好友支持的<font class="font left-money"><?=($this->config->item('price', 'iphone') - $user['left_money']);?></font>元啦</div>
    <div class="slogan" style="margin-top:10px;">邀请好友再众筹 <h3 style="display:inline;" class="left-money2"><?=$user['left_money'];?></h3> 元，即可得</div>
    <div class="slogan2">iPhone6 64G一台</div>
    <!--<div class="home"><a href="/wechat/product/">进入超级Home</a></div>-->

    <div class="content-block">
        <div class="button-block">
			<button class="support left" data-id="<?=$user['id'];?>">免费支持TA</button>
            <?php if($login_user['uid'] == $user['id']):?>
            <!--<a href="javascript:invite();"><button class="right invite_friend">邀请好友支持</button></a>-->
            <a href="#" class="invite_friend"><button class="right">邀请好友支持</button></a>
            <?php else:?>
            <a href="/activity/iphone/found"><button class="right">我也要</button></a>
            <?php endif;?>
        </div>

        <div class="content">
            <ul class="content-ul">
				<?php if(!empty($partin)):?>
                <?php foreach($partin as $p):?>
                <li>
                    <div class="li-left-2">
                        <img src="<?=$p['head_img_url'];?>">
                    </div>

                    <div class="li-right-2">
                        <span class="partin-user"><?=$p['name'];?></span><?=$p['slogan'];?>
                    </div>
                </li>
				<?php endforeach;?>
                <?php endif;?>
            </ul>
        </div>

    </div>
</section>
<div id="shareit">
  <img class="arrow" src="/static/image/activity/iphone/11.png">
  <!--
  <a href="#" id="follow">
    <img id="share-text" src="http://dev.vxtong.com/cases/nuannan/imgs/share-text.png">
  </a>
  -->
</div>

    <!--
    <div class="view menu_img">
        <img style="height:50px;width:auto;" src="/static/image/wechat/menu_2.jpg">
        <div style="padding-top:1px;text-align:center;height:50px;position:absolute;right:10px;top:0px">
            <a href="#appoint" style="text-decoration:none;font-size:15px;padding: 6px 10px;background-color:#1dd2af" class="bgcl ft48">预约</a >
        </div>
    </div>
    <div style="height:49px;"></div>
    -->

<section class="view" id="h5_top">
    <img src="/static/image/h5v2/home12-1.jpg">
    <div class="subscribe">
        <p>北京·仅30个天使用户</p>
        <a href="#appoint"><button type="button">立即预约</button></a>
        <!--
        <p>已有45排队</p>
        -->
    </div>
</section>

<section class="view" style="margin-top:-4px;">
    <img src="/static/image/h5v2/home12-2.jpg">
</section>

<section class="view">
    <img src="/static/image/h5v2/home12-3.jpg">
</section>


<section class="view" style="margin-bottom:25px;">
    <div class="swiper-container container-drawing">
        <ul id="drawing-room" class="swiper-wrapper">
            <li class="swiper-slide">
                <img src="/static/image/h5v2/k1.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/kt2.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/kt4.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/kt5.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/kt3.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/kt6.jpg">
            </li>
        </ul>
        <div class="swiper-button-next next-drawing"></div>
        <div class="swiper-button-prev prev-drawing"></div>
    </div>
</section>

<section class="view" style="margin-bottom:25px;">
    <div id="master-room" class="swiper-container container-master">
        <ul id="master-room" class="slide-area swiper-wrapper">
            <li class="swiper-slide">
                <img src="/static/image/h5v2/z1.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/z2.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/zw3.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/zw4.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/zw5.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/zw6.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/zw7.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/zw8.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/zw9.jpg">
            </li>
        </ul>
        <div class="swiper-button-next next-master"></div>
        <div class="swiper-button-prev prev-master"></div>
    </div>
</section>

<section class="view" style="margin-bottom:25px;">
    <img src="/static/image/h5v2/cw1.jpg">
    <!--
    <div id="subaltern-room" class="swiper-container container-subaltern">
        <ul id="subaltern-room" class="slide-area swiper-wrapper">
            <li class="swiper-slide">
                <img src="/static/image/h5v2/cw1.jpg">
            </li>
        </ul>
    </div>
    -->
</section>

<section class="view" style="margin-bottom:25px;">
    <div id="rest-room" class="swiper-container container-rest">
        <ul id="rest-room" class="slide-area swiper-wrapper">
            <li class="swiper-slide">
                <img src="/static/image/h5v2/w1.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/wsj2.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/wsj3.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/wsj5.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/wsj6.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/wsj7.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/wsj8.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/wsj9.jpg">
            </li>
        </ul>
        <div class="swiper-button-next next-rest"></div>
        <div class="swiper-button-prev prev-rest"></div>
    </div>
</section>

<section class="view" style="margin-bottom:25px;">
    <div id="kitchen-room" class="swiper-container container-kitchen">
        <ul id="kitchen-room" class="slide-area swiper-wrapper">
            <li class="swiper-slide">
                <img src="/static/image/h5v2/cf1.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/cf4.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/cf2.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/cf3.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/cf5.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/cf6.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/cf7.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/cf8.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/cf9.jpg">
            </li>
        </ul>
        <div class="swiper-button-next next-kitchen"></div>
        <div class="swiper-button-prev prev-kitchen"></div>
    </div>
</section>

<section class="view">
    <img src="/static/image/h5v2/ct1.jpg">
    <!--
    <div id="dining-room" class="swiper-container container-dining">
        <ul id="dining-room" class="slide-area swiper-wrapper">
            <li class="swiper-slide">
                <img src="/static/image/h5v2/ct1.jpg">
            </li>
        </ul>
        <div class="swiper-button-next next-dining"></div>
        <div class="swiper-button-prev prev-dining"></div>
    </div>
    -->
</section>

<section class="view">
    <img src="/static/image/h5v2/home12-4.jpg">
</section>

<section class="view">
    <img src="/static/image/h5v2/home12-5.jpg">
</section>

<section class="view">
    <div class="swiper-container container-ten">
        <ul id="ten" class="swiper-wrapper">
            <li class="swiper-slide">
                <img src="/static/image/h5v2/01.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/02.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/03.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/04.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/05.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/06.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/07.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/08.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/09.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/10.jpg">
            </li>
        </ul>
        <div class="swiper-button-next next-ten"></div>
        <div class="swiper-button-prev prev-ten"></div>
    </div>
</section>

<section class="view">
    <img src="/static/image/h5v2/rx.jpg">
</section>
<section>
    <div class="swiper-container container-ten">
        <ul id="ten" class="swiper-wrapper">
            <li class="swiper-slide">
                <img src="/static/image/h5v2/11.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/13.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/14.jpg">
            </li>
            <li class="swiper-slide">
                <img src="/static/image/h5v2/15.jpg">
            </li>
        </ul>
        <div class="swiper-button-next next-ten"></div>
        <div class="swiper-button-prev prev-ten"></div>
    </div>
</section>

<section class="view">
    <img src="/static/image/h5v2/home12-6.jpg">
</section>

<section class="view">
</section>


<section class="view" style="margin-top:-5px;">
    <img src="/static/image/h5v2/home12-7.jpg">
</section>

<section class="view" style="margin-top:-5px;">
    <img src="/static/image/h5v2/home12-8.jpg">
</section>

<section class="view">
    <img src="/static/image/h5v2/home12-9.jpg">
</section>

<!--
<section class="view">
    <img src="/static/image/h5v2/home12-22.png">
    <div class="subscribe">
        <p>每月最低还款**元，无抵押，最快2小时放款</p>
    </div>
</section>
-->

<section class="view" id="appoint">
    <img src="/static/image/h5v2/one-yun.png" width="100%">
    <form id="info-form" class="info-form">
        <div class="form-element">
            <div class="form-label">姓名</div>
            <div class="form-input">
                <input type="text" class="text-input choose_input_name"  placeholder="如：王先生" >
            </div>
        </div>

        <!--
        <div class="form-element">
            <div class="form-label">性别</div>
            <div class="form-input">
                <button type="button" class="gender-button on">男</button>
                <button type="button" class="gender-button">女</button>
                <input type="hidden" name="gender" class="text-input gender"  placeholder="" >
            </div>
        </div>
        <div class="form-element">
            <div class="form-label">出生年份</div>
            <div class="form-input">
                <input type="text" id="birthday" class="text-input birthday"  placeholder="" >
            </div>
        </div>
        -->
        <div class="form-element">
            <div class="form-label">房屋面积</div>
            <div class="form-input">
                <input type="text" class="text-input acreage_input"  placeholder="默认单位：㎡" >
            </div>
        </div>

        <div class="form-element">
            <div class="form-label">新房地址</div>
            <div class="form-input">
                <input type="text" class="text-input location_input"  placeholder="如：朝阳区双井时代嘉园" >
            </div>
        </div>

        <div class="form-element">
            <div class="form-label">装修时间</div>
            <div class="month-list">
                <div class="month on" title='6'>6月</div>
                <div class="month" title='7'>7月</div>
                <div class="month" title='8'>8月</div>
                <div class="month" title='9'>9月</div>
                <div class="month" title='10'>10月</div>
                <div class="month" title='11'>11月</div>
                <div class="month" title='12'>12月</div>
            </div>
            <input type="hidden" id="month-input" name="month" value="">
        </div>
        
        <div class="form-element">
            <div class="form-label">手机号</div>
            <div class="form-input">
                <input type="text" class="text-input app_phone"  placeholder="请输入手机号" >
            </div>
        </div>

        <!--
        <div class="form-element">
            <div class="form-label">验证码</div>
            <div class="form-input">
                <input type="text" class="verify-code app_code"  placeholder="请输入验证码" >
                <div class="yzm info-form-button get-verify-code left ">获取验证码</div>
            </div>
            
        </div>
        -->

        <div class="form-element center">
            <button type="button" class="app_sub info-form-button info-form-submit">提交</button>
        </div>


        <!--
        <div class="form-element">
            <div class="form-label">姓名</div>
            <div class="form-input">
                <input type="text" class="text-input "  placeholder="" >
            </div>
        </div>
        
        <div class="form-element">
            <div class="form-label">性别</div>
            <div class="form-input">
                <button type="button" class="gender-button on">男</button>
                <button type="button" class="gender-button">女</button>
                <input type="hidden" name="gender" class="text-input gender"  placeholder="" >
            </div>
        </div>

        <div class="form-element">
            <div class="form-label">出生年份</div>
            <div class="form-input">
                <input type="text" id="birthday" class="text-input birthday"  placeholder="" >
            </div>
        </div>
        <div class="form-element">
            <div class="form-label">房屋面积</div>
            <div class="form-input">
                <input type="text" class="text-input "  placeholder="默认单位：㎡" >
            </div>
        </div>

        <div class="form-element">
            <div class="form-label">新房地址</div>
            <div class="form-input">
                <input type="text" class="text-input "  placeholder="" >
            </div>
        </div>

        <div class="form-element">
            <div class="form-label">装修时间</div>
            <div class="month-list">
                <div class="month on">6月</div>
                <div class="month">7月</div>
                <div class="month">8月</div>
                <div class="month">9月</div>
                <div class="month">10月</div>
                <div class="month">11月</div>
                <div class="month">12月</div>
            </div>
            <input type="hidden" id="month-input" name="month" value="">
        </div>
        
        <div class="form-element">
            <div class="form-label">手机号</div>
            <div class="form-input">
                <input type="text" class="text-input "  placeholder="" >
            </div>
        </div>

        <div class="form-element">
            <div class="form-label">验证码</div>
            <div class="form-input">
                <input type="text" class="verify-code"  placeholder="请输入验证码" >
                <div class="info-form-button get-verify-code left ">获取验证码</div>
            </div>
            
        </div>

        <div class="form-element center">
            <button type="button" class="info-form-button info-form-submit">提交</button>
        </div>
        -->
    </form>
</section>

<footer>
    <div class="two-dimension">
        <p class="ptitle">长按识别</p>
        <img src="/static/image/h5v2/qrcode.jpg">
        <!--<p class="pphone">VIP客户服务：18501761049</p>-->
        <p class="pphone"><a href="tel:18501761049">VIP客户服务：18501761049</a></p>
    </div>
    <div class="footer-nav">
        <a href="#" class="rborder">超级Home1.2</a> | 
        <a href="/wechat/product/problem" class="rborder">常见问题</a>
         | 
        <a href="/" class="rborder">进入官网</a>
        <!--
         | 
        <a href="#">联系客服</a>
        -->
        
    </div>
</footer>
<div style="display:none">
    <input type="hidden" id="min_acreage" value="<?=MIN_ACREAGE;?>"/>
    <input type="hidden" id="max_acreage" value="<?=MAX_ACREAGE;?>"/>
        <form action="/wechat/pay" method="post" id="sec_order">
            <input type="hidden" name="order_id" class="order_id" value=""/>
            <input type="hidden" name="user_id" class="user_id" value=""/>
            <input type="hidden" name="serial_number" class="serial_number" value=""/>
            <input type="hidden" name="phone" class="phone" value=""/>
        </form>
</div>

<script type="text/javascript">
    var swiperTen = new Swiper('.container-ten', {
        nextButton: '.next-ten',
        prevButton: '.prev-ten'
    });
    var swiperDrawing = new Swiper('.container-drawing', {
        nextButton: '.next-drawing',
        prevButton: '.prev-drawing'
    });
    var swiperMaster = new Swiper('.container-master', {
        nextButton: '.next-master',
        prevButton: '.prev-master'
    });
    var swiperSubaltern = new Swiper('.container-subaltern', {
        nextButton: '.next-subaltern',
        prevButton: '.prev-subaltern'
    });
    var swiperRest = new Swiper('.container-rest', {
        nextButton: '.next-rest',
        prevButton: '.prev-rest'
    });
    var swiperKitchen = new Swiper('.container-kitchen', {
        nextButton: '.next-kitchen',
        prevButton: '.prev-kitchen'
    });
    var swiperDining = new Swiper('.container-dining', {
        nextButton: '.next-dining',
        prevButton: '.prev-dining'
    });   

    var s = 30;
    var get_code = true;
    $('.app_sub').live('click',function(){
        var phone = $(".app_phone").val();
        //var verify_number = $(".app_code").val();

        var name = $(".choose_input_name").val();
        var decor_date = parseInt($(".month-list").children(".on").attr('title'));
        var acreage = parseInt($('.acreage_input').val());
        var xiaoqu = $(".location_input").val();

        if(!input_check(phone , '3245')){
            return false;
        }

        if(name == undefined || name == ''){
            alert('请输入姓名');
            return false;
        }

        if(decor_date > 12 || decor_date <= 0 || isNaN(decor_date)){
            alert('日期不合法');
            return false;
        }

        var min_acreage = $("#min_acreage").val();
        var max_acreage = $("#max_acreage").val();
        if(acreage < min_acreage || acreage > max_acreage || isNaN(acreage)){
            alert('面积非法,只能预定' + min_acreage + '到' + max_acreage + '之间');
            return false;
        }

        if(xiaoqu == undefined || xiaoqu == ''){
            alert('请输入小区名');
            return false;
        }

            $.post('/order/appoint_wechat',
                {name: name, acreage: acreage, decor_time: decor_date, location: xiaoqu, phone: phone},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == 0){
                            if(data.order_id > 0 && data.user_id > 0 && data.serial_number > 0){
                                $(".order_id").val(data.order_id);    
                                $(".user_id").val(data.user_id);    
                                $(".serial_number").val(data.serial_number);    
                                $(".phone").val(phone);
                                $("#sec_order").submit();
                            }else{
                                alert(data.msg);
                                return false;
                            }
                        }else{
                            alert(data.msg);
                            return false;
                        }
                    }else{
                        alert("通信错误");
                        return false;
                    }
                });
    });


    $('.yzm').live('click',function(){
        if(get_code){
            var num = $(".app_phone").val();
            var reg = /^1[34578]\d{9}$/;
            if(!reg.test(num)){
                alert('请输入正确的手机号');
                return false;
            }

            code_time();
            $.post('/user/phone_verify',
                {phone: num}, function(data, status){
                        if(status == "success"){
                            data = eval('(' + data + ')');
                            if(data.code != 0){
                                alert(data.msg);
                            }
                        }else{
                            alert('获取失败,请30秒后重新获取');
                        }
                });
        }
    })

    var code_time = function(that){
        get_code = false;
        if(s < 0){
            $('.yzm').html('重新获取');
            get_code = true;
            s=30;
            return false;
        }
        $('.yzm').html('还剩'+s+'秒');
        s--;
        setTimeout("code_time()",1000);
        
    }
    var input_check = function(p,c){
        var reg = /^1[34578]\d{9}$/;
        if(!reg.test(p)){
            alert('请输入正确的手机号');
            return false;
        }else if(c.length !== 4){
            alert('请输入正确的验证码');
            return false;
        }else{
            return true;
        }
    }

    var invite = function(){
        alert('点击右上角，分享到朋友圈或直接分享给好友');
    }

    $(".invite_friend").on("click", function() {
        $("#shareit").show();
    });
   
   
    $("#shareit").on("click", function(){
        $("#shareit").hide(); 
    });
</script>

</body>
</html>
