<?php  require_once 'header.php'; ?>
<script type="text/javascript">
    $(function(){
        changeMenu();
         $('li').on('click', function(){
            changeMenu();
            var indexLi = $(this).index();
            $(this).addClass('on');
            $(this).children('a').children('img').attr('src','/static/image/mobile/menu'+(indexLi+1)+'-on.png')
        })
    })
    
    function changeMenu(){
        $('li').each(function(){
            var i = $(this).index();
            if($(this).hasClass('on')){
                $(this).removeClass('on');
                $(this).children('a').children('img').attr('src','/static/image/mobile/menu'+(i+1)+'.png')
            }
        })
    }
</script>    
<body class="order">
<!-- banner -->
<?php  require_once 'header-banner.php'; ?>

<!-- content start -->
<div class="content">
    <div class="logout">
        <a class="logout-button" href="/user/logout">退出登录</a>
    </div>

    <div class="order-detail">
        <div class="order-title">订单详情</div>
        <div class="order-menu">
            <ul>
                <li><a href="#"><img src="/static/image/mobile/menu1.png"></a></li>
                <li class="on"><a href="#"><img src="/static/image/mobile/menu2-on.png"></a></li>
                <li><a href="#"><img src="/static/image/mobile/menu3.png"></a></li>
            </ul>
        </div>
        <div class="house-info">
            <div class="info-title">房屋信息</div>
            <div class="house-info-content">
                <p>姓名：<?=$order['name'];?></p>
                <p>电话：<?=$order['phone'];?></p>
                <p>所在地区：<?=$order['location'];?></p>
                <p>面积：<?=$order['acreage'];?></p>
            </div>
        </div>

        <div class="product-info">
            <div class="info-title">产品信息</div>
            <table class="product-table">
                <tr>
                    <td class="center">产品名称</td>
                    <td class="pleft"><?=$order['product_name'];?></td>
                </tr>
                <tr>
                    <td class="center">总价</td>
                    <td class="pleft"><?=$order['price'];?>元</td>
                </tr>
                <tr>
                    <td class="center">定金</td>
                    <td class="pleft"><?=$order['init_deposit'];?>元</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- content start -->
</body>
</html>
