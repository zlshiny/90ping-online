<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>注册-90平方智能家装</title>

    <style type="text/css">
        .regist{
            height:400px;
            width:1000px;
        }

        .phone{
            margin-left:10px; 
        }

        .passwd{
            margin-left:25px; 
        }

        .spasswd{
            margin-left:25px; 
        }
    </style>
</head>
<body>
<div class="body">
    <div>
        <span><?php if(check_login()):?>已登录<?php else:?>未登录<?php endif;?></span>
    </div>
    <div class="regist">
        <form class="form" action="javascript:void(0);" method="post">
            <div class="phone-box">
                <span>手机号：</span>
                <input type="text" name="phone" class="phone" placeholder="请输入手机号"  value=""/>
            </div>
            <div class="passwd-box">
                <span>密码：</span>
                <input type="password" name="passwd" class="passwd" placeholder="请输入密码"  value=""/>
            </div>
            <div class="spasswd-box">
                <span>重复密码：</span>
                <input type="password" name="spasswd" class="spasswd" placeholder="重新输入密码"  value=""/>
            </div>
            <div class="check-box">
                <span>验证码：</span>
                <input type="text" name="check" class="check" placeholder="输入手机验证码"  value=""/>
                <input type="button" name="fetch_verify" class="fetch_verify" value="获取验证码"/>
            </div>
            <div class="submit-buttion">
                <input type="submit" name="button" class="button" value="同意协议并注册"/>
            </div>
        </form>
    </div>
</div>
<script type="application/javascript" src="<?=JS_PATH . 'jquery-1.11.2.min.js';?>"></script>
<script type="application/javascript">
$(document).ready(function(){
    $(".form").submit(function(e){
        var phone = $(".phone").val();
        var passwd = $(".passwd").val();
        var spasswd = $(".spasswd").val();
        var verify_number = $(".check").val();

        if(passwd != spasswd){
            alert('密码不一致');
            return false;
        }

        $.post('/user/regist',
                {phone : phone, passwd : passwd, spasswd : spasswd, verify_number : verify_number},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        alert(data.msg); 
                        return true;
                    }else{
                        alert("通信错误");
                        return false;
                    }
                });
    });

    $(".fetch_verify").click(function(){
        var number = $(".phone").val();
        if(number == undefined || !number) return false;
        $.post('/user/phone_verify',
                {phone: number},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        alert(data.code +":" + data.msg);
                    }else{
                        alert('4');
                    }
                });
    });
});
</script>
</body>
</html>
