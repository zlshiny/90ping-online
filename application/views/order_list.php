<?php
    include('header.php');
?>
<div class="orderlist_wrap">
    <a href="/user/logout" class="login_out">退出登录</a>
    <div class="order_title">我的订单</div>
    <table cellpadding="0" border="0" cellspacing="0">
        <thead>
            <tr>
                <td width="260px">订单编号</td>
                <td width="170px">电话</td>
                <td width="170px">产品</td>
                <td width="170px">定金</td>
                <td width="170px">状态</td>
                <td width="170px">操作</td>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($list)):?>
            <?php foreach($list as $v):?>
            <tr>
                <td><?=$v['serial_number'];?></td>
                <td><?=$v['phone'];?></td>
                <td><?=$v['product_name'];?></td>
                <td><?=$v['init_deposit'];?></td>
                <td><?=$v['status_name'];?></td>
                <td>
                    <a href="#" class="action_order" id="action_order" order-id="<?=$v['order_id'];?>" user-id="<?=$v['user_id'];?>" value="<?=$v['status'];?>">
                        <?=$v['action_name'];?>
                    </a>
                    <?php if($v['status'] > 0):?><a href="/order/detail/<?=$v['order_id'];?>">查看</a><?php endif;?>
                </td>
            </tr>
            <?php endforeach;?>
            <?php endif;?>
        </tbody>
    </table>
    <div style="display:none;">
        <form action="" method="post" id="fir_order">
            <input type="hidden" name="order_id" id="fir_order_id" value=""/>
            <input type="hidden" name="user_id" id="fir_user_id" value=""/>
        </form>
    </div>
</div>
<script type="application/javascript">
$(document).ready(function(){
    $(".action_order").click(function(){
        var status = $(this).attr('value');
        if(status == 1){
            $("#fir_order").attr("action", "/pay");
        }else if(status == 0){
            $("#fir_order").attr("action", "/order/improve");
        }else{
            return false;
        }

        $("#fir_order_id").attr("value", $(this).attr("order-id"));
        $("#fir_user_id").attr("value", $(this).attr("user-id"));
        $("#fir_order").submit();
    });
});
</script>
<?php
    include('footer.php');
?>
