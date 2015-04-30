<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<style type="text/css">
    body {
        margin:0px;
        background-color:#eeeeee;
    }
    img {
        width:100%; 
    }
.bgcl{
	background-color:#1dd2af;
	padding:10px 80px;
	display:inline;	
	position:relative;
	border-radius: 10px;
	-webkit-border-radius: 10px;
	color:#fff;
}
.ft48{
	font-size:22px;
}
.app_code{
    width:255px;
    margin-top:10px;
}

.appoint input{
    text-indent:10px;
    line-height:25px;
    margin-left:0px;
    border:none;
    outline:none;
    clear:both;
    float:left;
    height:53px;
    color:#939393;
    font-size:18px;
    position:relative;
    border-radius:5px;
    behavior:url(/static/css/PIE.htc);
}
.appoint .app_phone{
    width:390px;
    margin-top:40px;
}
.appoint .app_sub{
    width:390px;
    background-color:#1dd2af;
    font-size:24px;
    color:#fff;
    text-align:center;
.yzm{
    display:block;
    width:127px;
    height:52px;
    float:left;
    margin-left:10px;
    background-color:#9cd4c9;
    color:#fff;
    font-size:18px;
    margin-top:10px;
    cursor:pointer;
    border-radius:5px;
    text-align:center;
    line-height:52px;
}

.app_sub{
    width:100px;
    background-color:#1dd2af;
    font-size:24px;
    color:#fff;
    text-align:center;
    line-height:55px;
    height:55px;
    clear:both;
    float:left;
    margin-left:261px;
    margin-top:20px;
    border-radius:5px;
    behavior:url(/static/css/PIE.htc);
    position:relative;
    cursor:pointer;
}
</style>
</head>
<body>
    <div class="img" style="position:fixed">
        <img src="<?=IMAGE_PATH . "wechat/menu.png";?>"/>
    </div>
    <div class="img">
        <img src="<?=IMAGE_PATH . "wechat/holder.jpg";?>"/>
    </div>
    <div class="appoint">
        <input type="text" class="app_phone" name="phone" value="请输入手机号" onfocus="if(this.value == '请输入手机号'){this.value = ''}" onblur="if(this.value == ''){this.value='请输入手机号'}"/>
        <input type="text" class="app_code" name="code" onfocus="if(this.value == '请输入验证码'){this.value = ''}" onblur="if(this.value == ''){this.value = '请输入验证码'}" value="请输入验证码"/>
        <div class="yzm">获取验证码</div>
        <div class="app_sub">提交</div>
    </div>
    <div class="img">
        <img src="<?=IMAGE_PATH . "wechat/header.jpg";?>"/>
    </div>
    <div style="padding-top:15px;text-align:center;">
	    <a href="/order" style="text-decoration:none;" target="_blank" class="bgcl ft48">立即预约</a>
    </div>
    <div class="img">
        <img src="<?=IMAGE_PATH . "wechat/top.jpg";?>"/>
    </div>
    <div class="img">
        <img src="<?=IMAGE_PATH . "wechat/ciwo.jpg";?>"/>
    </div>
    <div class="img">
        <img src="<?=IMAGE_PATH . "wechat/footer.jpg";?>"/>
    </div>
</body>
</html>
