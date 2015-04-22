<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>订单详情-90平方智能家装</title>

    <style type="text/css">
        .regist{
            height:400px;
            width:1000px;
        }

        .regist span{
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
            <?php if(!empty($order)):?>
                    <div>
                        <p><?=$order['phone'];?></p>
                        <p><?=$order['location'];?></p>
                        <p><?=$order['acreage'];?></p>
                        <p><?=$order['product_name'];?></p>
                        <p><?=$order['init_deposit'];?></p>
                    </div>
            <?php endif;?>
    </div>
</div>
<script type="application/javascript" src="<?=JS_PATH . 'jquery-1.11.2.min.js';?>"></script>
</body>
</html>
