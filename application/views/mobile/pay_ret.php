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
            <p class="success-message-p2"><a href="/activity/neighbor" style="font-size:30px;background-color:#1dd2af;color:#fff;border-radius:5px;padding:8px 8px;">邻居一起装</a></p>
            <p class="success-message-p2" style="font-size:25px;">参与邻居一起装，最高优惠20万</p>
        </div>

        
        
    </div>

</div>
<!-- content start -->
</body>
</html>
