<?php
    include('header.php');
?>
<link href="<?=CSS_PATH . 'main.css';?>" rel="stylesheet" type="text/css" />
<div class="pay_result_wrap">
    <div class="result_bg"></div>
    <div class="result_wrap">
        <div class="result_success"></div><!-- 失败 result_fail-->
        <h1>预约成功!</h1>
<!--        <h2>恭喜您预约成功，订单号：--><?//=$serial_number;?><!--! 您的订单总额为--><?//=$price;?><!--元!</h2>-->
        <h2>恭喜您预约成功，订单号：<?=$serial_number;?>!</h2>
        <!--<p>如有疑问，请与<a href="###">客服联系</a></p>
        -->
        <!--<p>您可以到<a href="/order/myorder">我的订单</a>中查看订单的最新状态</p>-->
        <p class="neighbor_yinyou" style="margin-left:472px;"><a href="/activity/neighbor" style="padding:5px 5px;font-size:30px;background-color:#1dd2af;color:#fff;border-radius:5px;">邻居一起装</a></p>
        <p class="neighbor_yinyou" style="font-size:28px;margin-top:5px;text-align:center;margin-left:370px;">参与邻居一起装，最高优惠20万</p>
    </div>
</div>
<?php
    include('footer.php');
?>
