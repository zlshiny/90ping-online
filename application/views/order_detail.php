<?php
    include('header.php');
?>
<div class="orderlist_wrap" style="padding-bottom:100px;">
   <div class="order_title">订单详情</div>
    <div class="detail_wrap">
        <div class="detail_title">
            <div class="detail_type1 detail_type1_hover">预定购买</div>
            <div class="detail_type2">在线支付</div>
            <div class="detail_type3">线下交易</div>
        </div>
        <div class="detail_content">
            <h1>房屋信息</h1>
            <p>姓名：</p>
            <p>电话：<?=$order['phone'];?></p>
            <p>所在地区：<?=$order['location'];?></p>
            <p>户型/面积：</p>
            <div class="clearfix"></div>
        </div>
        <div class="detail_content">
            <h1>产品信息</h1>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <td width="340px;">产品名称</td>
                        <td width="340px;">单价</td>
                        <td>定金</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$order['product_name'];?></td>
                        <td>123</td>
                        <td><span>123</span></td>
                    </tr>
                </tbody>

            </table>
            <div class="clearfix"></div>

        </div>
    </div>
</div>
<?php
    include('footer.php');
?>
