<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>预约第三步-90平方智能家装</title>

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
    <div>预约成功</div>
    <div style="display:none;">
        <form action="/order/load_appointsec" method="post" id="sec_order">
            <input type="hidden" name="order_id" id="sec_order_id" value="<?=$order_id;?>"/>
            <input type="hidden" name="user_id" id="sec_user_id" value="<?=$user_id;?>"/>
        </form>
    </div>
</div>
</body>
</html>
