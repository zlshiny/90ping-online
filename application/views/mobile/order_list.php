<?php  require_once 'header.php'; ?>
<script type="text/javascript">
    $(function(){
        $('.arrow-img').on('click',function(){
            var display = $(this).parent().parent().next(".my-order-content").css('display');
            if(display == 'none'){
                $(this).parent().parent().next(".my-order-content").show();
                $(this).attr('src','/static/image/mobile/arrow-up.png');
            }else{
                $(this).parent().parent().next(".my-order-content").hide();
                $(this).attr('src','/static/image/mobile/arrow-down.png');
            }
        })
    })
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
        <div class="order-title">我的订单</div>
        <?php if(!empty($list)):?>
        <?php foreach($list as $v):?>
            <div class="order-menu">
                <div class="order-num">订单编号：<?=$v['serial_number'];?></div>
                <div class="arrow">
                    <img class="arrow-img" src="/static/image/mobile/arrow-up.png">
                </div>
            </div>
            <div class="my-order-content">
                <p>姓名&nbsp;&nbsp;<?=$v['name'];?></p>
                <p>产品&nbsp;&nbsp;<?=$v['product_name'];?></p>
                <p>定金&nbsp;&nbsp;<?=$v['init_deposit'];?>元</p>
                <p>状态&nbsp;&nbsp;<?=$v['status_name'];?></p>
                <div class="my-order-operation">
                    <p>操作</p>
                    <?php if($v['status'] > 0):?><a href="/order/detail/<?=$v['order_id'];?>" class="my-order-a">查看</a><?php endif;?>
                    <?php if($v['status'] == 0):?>
                        <a href="#" class="my-order-a" serial-number="<?=$v['serial_number'];?>" order-id="<?=$v['order_id'];?>" user-id="<?=$v['user_id'];?>" value="<?=$v['status'];?>">
                            <?=$v['action_name'];?>
                        </a>
                    <?php endif;?>
                    <div></div>
                    <div></div>
                </div>
            </div>
        <?php endforeach;?>
        <?php endif;?>
    </div>
</div>
<!-- content start -->
</body>
</html>
