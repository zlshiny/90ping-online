<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>订单列表-90平方智能家装</title>

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
        <ul>
            <?php if(!empty($list)):?>
                <?php foreach($list as $v):?>
                <li>
                    <div>
                        <span><?=$v['serial_number'];?></span>
                        <span><?=$v['phone'];?></span>
                        <span><?=$v['product_name'];?></span>
                        <span><?=$v['init_deposit'];?></span>
                        <span><?=$v['status_name'];?></span>
                        <span><a href="#" class="action_order" id="action_order" order-id="<?=$v['order_id'];?>" user-id="<?=$v['user_id'];?>" value="<?=$v['status'];?>"><?=$v['action_name'];?></a></span>
                        <?php if($v['status'] > 0):?><span><a href="/order/detail/<?=$v['order_id'];?>">查看</a></span><?php endif;?>
                    </div>
                </li>
                <?php endforeach;?>
            <?php endif;?>
        </ul>
    </div>
    <div style="display:none;">
        <form action="" method="post" id="fir_order">
            <input type="hidden" name="order_id" id="fir_order_id" value=""/>
            <input type="hidden" name="user_id" id="fir_user_id" value=""/>
        </form>
    </div>
</div>
<script type="application/javascript" src="<?=JS_PATH . 'jquery-1.11.2.min.js';?>"></script>
<script type="application/javascript">
$(document).ready(function(){
    $(".action_order").click(function(){
        var status = $(this).attr('value');
        if(status == 1){
            $("#fir_order").attr("action", "/order/load_appointhird");
        }else if(status == 0){
            $("#fir_order").attr("action", "/order/load_appointsec");
        }else{
            return false;
        }

        $("#fir_order_id").attr("value", $(this).attr("order-id"));
        $("#fir_user_id").attr("value", $(this).attr("user-id"));
        $("#fir_order").submit();
    });
});
</script>
</body>
</html>
