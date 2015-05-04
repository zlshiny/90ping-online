<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<meta name="keywords" content="90平方，装修，互联网装修，智能家装，家装，互联网家装，方太"/>
<meta name="description" content="史上第一个专注于80后家装产品-超级Home1.0，配置顶级家具软装和高端厨卫，拎包入住"/>
<title>最省心互联网家装产品疯狂预约，专为80后，软硬全包一口价</title>
<link href="<?=CSS_PATH . 'wechat.css';?>" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="img menu_img">
        <img style="height:50px;width:auto;" src="/static/image/wechat/menu.jpg">
        <div style="padding-top:1px;text-align:center;height:50px;position:absolute;right:10px;top:0px">
            <a href="#appoint" style="text-decoration:none;font-size:15px;padding: 6px 10px;background-color:#1dd2af" target="_blank" class="bgcl ft48">预约</a >
        </div>
    </div>
    <div class="img main_image">
        <!--<img src="<?=IMAGE_PATH . "wechat/header.jpg";?>"/>-->
        <ul>
            <li><span class="img_1"></span></li>
            <li><span class="img_2"></span></li>
            <li><span class="img_3"></span></li>
        </ul>
    </div>
    <div style="padding-top:15px;text-align:center;">
	    <a href="#appoint" style="text-decoration:none;" target="_blank" class="bgcl ft48">立即预约</a>
    </div>
    <div class="img">
        <img src="<?=IMAGE_PATH . "wechat/top.jpg";?>"/>
    </div>
    <div class="img">
        <img src="<?=IMAGE_PATH . "wechat/ciwo.jpg";?>"/>
    </div>
    <div class="appoint" id="appoint">
    <div style="margin-left:5%;">
        <input type="text" class="app_phone" name="phone" value="请输入手机号" onfocus="if(this.value == '请输入手机号'){this.value = ''}" onblur="if(this.value == ''){this.value='请输入手机号'}"/>
   </div>
    <div style="margin-left:5%;">
       <input type="text" class="app_code" name="code" onfocus="if(this.value == '请输入验证码'){this.value = ''}" onblur="if(this.value == ''){this.value = '请输入验证码'}" value="请输入验证码"/>
        <div class="yzm">获取验证码</div>
   </div>
    <div style="padding-top:15px;text-align:center;margin-top:10px;height:50px;">
	    <a href="#" style="text-decoration:none;" target="_blank" class="bgcl ft48 app_sub">提交</a>
    </div>
    </div>
    <div class="img">
        <img src="<?=IMAGE_PATH . "wechat/footer.jpg";?>"/>
    </div>
</body>
<script type="text/javascript" src="<?=JS_PATH . 'jquery.min.js';?>"></script>
<script type="text/javascript" src="/static/js/jquery.event.drag-1.5.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.touchSlider.js"></script>
<script type="text/javascript" src="/static/js/wechat.js"></script>
</html>
