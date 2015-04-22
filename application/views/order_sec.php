<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>预约第二步-90平方智能家装</title>

    <style type="text/css">
        .regist{
            height:400px;
            width:1000px;
        }
    </style>
</head>
<body>
<div class="body">
    <div>
        <span><?php if(check_login()):?>已登录<?php else:?>未登录<?php endif;?></span>
    </div>
    <div style="display:none">
        <input type="hidden" id="order_id" value="<?=$order_id;?>"/>
        <input type="hidden" id="user_id" value="<?=$user_id;?>"/>
    </div>
    <div class="regist">
        <form class="form" action="javascript:void(0);" method="post">
            <input type="hidden" class="order_id" value="<?=$order_id;?>"/>
            <input type="hidden" class="user_id" value="<?=$user_id;?>"/>
            <input type="hidden" class="age" value="1"/>
            <input type="hidden" class="acreage" value="90.10"/>
            <input type="hidden" class="decor_date" value="11"/>
            <div class="submit-buttion">
                <input type="submit" name="button" class="button" value="支付1元"/>
            </div>
        </form>
    </div>
    <div style="display:none;">
        <form action="/order/load_appointhird" method="post" id="sec_order">
            <input type="hidden" name="order_id" id="sec_order_id" value=""/>
            <input type="hidden" name="user_id" id="sec_user_id" value=""/>
        </form>
    </div>
</div>
<script type="application/javascript" src="<?=JS_PATH . 'jquery-1.11.2.min.js';?>"></script>
<script type="application/javascript">
$(document).ready(function(){
    $(".form").submit(function(e){
        var order_id = $(".order_id").val();
        var user_id = $(".user_id").val();
        var age = $(".age").val();
        var acreage = $(".acreage").val();
        var decor_date = $(".decor_date").val();

        $.post('/order/appointsec',
                {order_id: order_id, user_id: user_id, age: age, acreage: acreage, decor_date: decor_date},
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

});
</script>
</body>
</html>
