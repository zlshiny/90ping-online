<?php
    include('header.php');
?>
<link href="<?=CSS_PATH . 'main.css';?>" rel="stylesheet" type="text/css" />
<div id="choose_banner">
    <div class="choose_bg"></div>
    <div class="choose_wrap">
        <h1 style="top:50px;">请选择支付方式</h1>
        <a href="/pay/wechat" class="pay_zfb"></a>
        <a href="/pay/wechat" class="pay_wx"></a>
    </div>
</div>
<?php
    include('footer.php')
?>
