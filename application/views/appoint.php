<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>预约-90平方智能家装</title>

    <style type="text/css">
        .regist{
            height:400px;
            width:1000px;
        }

        .phone{
            margin-left:10px; 
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
            <div class="check-box">
                <span>验证码：</span>
                <input type="text" name="check" class="check" placeholder="输入手机验证码"  value=""/>
                <input type="button" name="fetch_verify" class="fetch_verify" value="获取验证码"/>
            </div>
            <div class="submit-buttion">
                <input type="submit" name="button" class="button" value="预约"/>
            </div>
        </form>
    </div>
    <div style="display:none;">
        <form action="/order/load_appointsec" method="post" id="sec_order">
            <input type="hidden" name="order_id" id="sec_order_id" value=""/>
            <input type="hidden" name="user_id" id="sec_user_id" value=""/>
        </form>
    </div>
</div>
<script type="application/javascript" src="<?=JS_PATH . 'jquery-1.11.2.min.js';?>"></script>
<script type="application/javascript">
$(document).ready(function(){
    $(".form").submit(function(e){
        var phone = $(".phone").val();
        var verify_number = $(".check").val();

        $.post('/order/appointment',
                {phone : phone, phone_verify_number: verify_number},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        alert(data.msg);
                        if(data.code == 0){
                            if(data.order_id > 0 && data.user_id > 0){
                                $("#sec_order_id").val(data.order_id);  
                                $("#sec_user_id").val(data.user_id);  
                                $("#sec_order").submit();
                            }else{
                                return false;
                            }
                        }else{
                            return false;
                        }
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
