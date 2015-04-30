<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title>史上最省心的互联网家装单品—超级Home1.0，软硬装全包，专为80后奋斗者</title>
<script type="text/javascript" src="<?=JS_PATH . 'jquery.min.js';?>"></script>
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
    width:53%;
    margin-top:10px;
}

.app_phone{
    width:90%;
    margin-top:40px;
}

.appoint input{
    text-indent:10px;
    line-height:25px;
    margin-left:0px;
    border:none;
    outline:none;
    height:40px;
    color:#939393;
    font-size:18px;
    position:relative;
    border-radius:5px;
    behavior:url(/static/css/PIE.htc);
}
.yzm{
    display:inline-block;
    width:35%;
    height:48px;
    margin-left:2%;
    background-color:#9cd4c9;
    color:#fff;
    font-size:18px;
    margin-top:10px;
    cursor:pointer;
    border-radius:5px;
    text-align:center;
    line-height:48px;
}

.menu_img {
    position:fixed;
    width:100%;
    height:50px;
    /*background-image:url('/static/image/wechat/menu.jpg');*/
    background-color:#333333;
    text-align:center;
    line-height:50px;
}

</style>
</head>
<body>
    <!--<div class="img" style="position:fixed">
        <img src="<?=IMAGE_PATH . "wechat/menu.jpg";?>"/>
        <div style="padding-top:15px;text-align:center;margin-top:10px;height:50px;">
	        <a href="#appoint" style="text-decoration:none;" target="_blank" class="bgcl ft48 app_sub">预约</a>
        </div>
    </div>
    -->
    <div class="img menu_img">
        <img style="height:50px;width:auto;" src="/static/image/wechat/menu.jpg">
        <div style="padding-top:1px;text-align:center;height:50px;position:absolute;right:10px;top:0px">
            <a href="#appoint" style="text-decoration:none;font-size:15px;padding: 6px 10px;background-color:#1dd2af" target="_blank" class="bgcl ft48">预约</a >
        </div>
    </div>
    <div class="img" style="height:50px;">
    </div>
    <div class="img">
        <img src="<?=IMAGE_PATH . "wechat/header.jpg";?>"/>
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
<script type="text/javascript">
    var s = 30;
    var get_code = true;
    $('.app_sub').live('click',function(){
        var phone = $(".app_phone").val();
        var verify_number = $(".app_code").val();

        if(!input_check(phone , verify_number)){
            return false;
        }

        $.post('/order/appointment',
                {phone : phone, phone_verify_number: verify_number, source:'1'},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == 0){
                            if(data.order_id > 0 && data.user_id > 0){
                                alert('预约成功,客服稍后会与您联系');
                                return true;
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
</script>
</html>
