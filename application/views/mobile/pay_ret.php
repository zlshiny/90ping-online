<?php  require_once 'header.php'; ?>
<script type="text/javascript">
    $(function(){
        var bwidth = $(window).width();
        var bheight = $(window).height();
        var contentHeight = bheight - 55;
        $('.subscribe .content').height(contentHeight);

        $('.info-form-button').on('click',function(){
            var check = checkMobil('mobile');
            if(check){
                $('#info-form').submit();
            }else{
                return false;
            }
        })

    })
</script>
<body class="subscribe">
<!-- banner -->
<?php  require_once 'header-banner.php'; ?>

<!-- content start -->
<div class="content">
    <div class="info-area success-area">
        <div class="success-title">
            <img src="/static/image/mobile/ok.png">
            <p>预约成功!</p>
        </div>
        <div class="success-message">
            <p class="success-message-p1">恭喜您成功预约天使用户，订单号：<?=$serial_number;?></p>
            
            <!--<p class="success-message-p2">您可以到<a href="/order/myorder">我的订单</a>中查看订单的最新状态</p>-->
            <p class="success-message-p2"><a href="/wechat/product/v2" style="font-size:20px;">返回</a></p>
        </div>

        
        
    </div>

</div>
<!-- content start -->
</body>
</html>
