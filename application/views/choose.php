<?php
    include('header.php');
?>
<script type="text/javascript">
    $('.part1 span').live('click',function(){
        $('.part1 span').removeClass('span_hover');
        $(this).addClass('span_hover');
        $(".age").val($(this).attr('title'));
    })

    $('.part2 span').live('click',function(){
        if($(this).hasClass('colgrey')){
            return false;
        }
        $('.part2 span').removeClass('span_hover');
        $(this).addClass('span_hover');
        $(".decor_date").val($(this).attr('title'));
    })

    $('.sub_btn').live('click',function(){
        var acreage = $('.c_input').val();
        var order_id = $(".order_id").val();
        var user_id = $(".user_id").val();
        var age = $(".age").val();
        var serial_number = $(".serial_number").val();
        var decor_date = $(".decor_date").val();

        if(order_id <= 0 || user_id <= 0){
            alert('订单非法');
            return false;
        }

        if(age != 1 && age != 0){
            alert('年龄不合法');
            return false;
        }

        if(decor_date > 12 || decor_date <= 0){
            alert('日期不合法');
            return false;
        }

        if(serial_number <= 0){
            alert('订单序列号不合法');
            return false;
        }

        $.post('/order/appointsec',
                {order_id: order_id, user_id: user_id, age: age, acreage: acreage, decor_date: decor_date, serial_number: serial_number},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == 0){
                            if(data.order_id > 0 && data.user_id > 0 && data.serial_number.length > 0){
                                $(".order_id").val(data.order_id);
                                $(".user_id").val(data.user_id);
                                $(".serial_number").val(data.serial_number);
                                $("#sec_order").submit();
                            }else{
                                return false;
                            }
                        }else{
                            alert(data.msg);
                            return false;
                        }
                    }else{
                        alert("通信错误");
                        return false;
                    }
                });
    })
</script>
<div id="choose_banner">
    <div class="choose_bg"></div>
    <div class="choose_wrap" style="top:105px;">
        <h1>你只需要做个决定</h1>
        <p style="margin-top:0px;">年龄</p>
        <div class="part1 clearfix">
            <span title="1">80后</span>
            <span class="span_hover" title="0">80前</span>
        </div>
        <p style="margin-top:20px;">装修时间</p>
        <div class="part2 clearfix">
            <span class="colgrey" title="1">1月</span>
            <span title="2" class="colgrey">2月</span>
            <span title="3" class="colgrey">3月</span>
            <span title="4" class="colgrey">4月</span>
            <span title="5" class="span_hover">5月</span>
            <span title="6">6月</span>
            <span title="7">7月</span>
            <span title="8">8月</span>
            <span title="9">9月</span>
            <span title="10">10月</span>
            <span title="11">11月</span>
            <span title="12">12月</span>
        </div>
        <input class="c_input" onfocus="if(this.value == '请输入房本面积'){this.value=''}" onblur="if(this.value == ''){this.value='请输入房本面积'}" type="text" value="请输入房本面积"/>
        <!--<div class="sub_btn bgc">支付1元预约金</div>-->
        <div class="sub_btn bgc">提交预约</div>
    </div>
    <div style="display:none">
        <input type="hidden" class="age" value="0"/>
        <input type="hidden" class="acreage" value=""/>
        <input type="hidden" class="decor_date" value="<?=$cur_mon;?>"/>
        <!--<form action="/pay" method="post" id="sec_order">
            <input type="hidden" name="order_id" class="order_id" value=""/>
            <input type="hidden" name="user_id" class="user_id" value=""/>
            <input type="hidden" name="serial_number" class="serial_number" value=""/>
        </form>
        -->
        <form action="/pay/success" method="post" id="sec_order">
            <input type="hidden" name="order_id" class="order_id" value="<?=$order_id;?>"/>
            <input type="hidden" name="user_id" class="user_id" value="<?=$user_id;?>"/>
            <input type="hidden" name="serial_number" class="serial_number" value="<?=$serial_number;?>"/>
        </form>
    </div>
</div>
<?php
    include('footer.php');
?>
