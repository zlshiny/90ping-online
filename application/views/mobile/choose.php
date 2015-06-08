<?php  require_once 'header.php'; ?>
<script type="text/javascript">
    $(function(){
        var bwidth = $(window).width();
        var bheight = $(window).height();
        var contentHeight = bheight - 55;
        $('.subscribe .content').height(contentHeight);
        if(bheight <=480){
            $('.info-area').css('margin-top','0');
        }

        var myDate = new Date();
        var monthIndex = myDate.getMonth(); 
        $('.month-list .month').each(function(){
            if($(this).index() >= monthIndex){
                $(this).show();
                if($(this).index() == monthIndex){
                    $(this).addClass('on');
                }
            }
        })
        $('.age, .month').on('click',function(){
            var inputVal = $(this).index();
            if($(this).hasClass('age')){
                $('.age').removeClass('on');
                $(this).addClass('on');
                $('#age-input').val(inputVal);
            }else{
                $('.month').removeClass('on');
                $(this).addClass('on');
                $('#month-input').val(inputVal+1);
            }
        })

        $('.info-form-button').live('click',function(){
            var order_id = $(".order_id").val();
            var user_id = $(".user_id").val();
            var serial_number = $(".serial_number").val();

            var city = parseInt($(".choose_city").attr('data-value'));
            var name = $(".choose_input_name").val();
            var decor_date = parseInt($(".month-list").children(".on").attr('title'));
            var acreage = parseInt($('.proportion').val());
            var xiaoqu = $(".house-area").val();
            var phone = $(".phone").val();

            if(order_id <= 0 || user_id <= 0){
                alert('订单非法');
                return false;
            }

            if(serial_number <= 0){
                alert('订单序列号不合法');
                return false;
            }

//        if(age != 1 && age != 2){
//            alert('年龄不合法');
//            return false;
//        }

            if(city != 1){
                alert('城市非法');
                return false;
            }

            if(name == undefined || name == ''){
                alert('请输入姓名');
                return false;
            }

            if(decor_date > 12 || decor_date <= 0 || isNaN(decor_date)){
                alert('日期不合法');
                return false;
            }

            var min_acreage = $("#min_acreage").val();
            var max_acreage = $("#max_acreage").val();
            if(acreage < min_acreage || acreage > max_acreage || isNaN(acreage)){
                alert('面积非法,只能预定' + min_acreage + '到' + max_acreage + '之间');
                return false;
            }

            if(xiaoqu == undefined || xiaoqu == ''){
                alert('请输入小区名');
                return false;
            }
            
            var sub_type = $(this).attr("data-type");
            $.post('/order/appointsec',
                {order_id: order_id, phone: phone, user_id: user_id, name: name, acreage: acreage, decor_date: decor_date, city: city, xiaoqu: xiaoqu, serial_number: serial_number},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == 0){
                            if(data.order_id > 0 && data.user_id > 0 && data.serial_number.length > 0){
                                if(sub_type == 2) {
                                    $(".order_id").val(data.order_id);
                                    $(".user_id").val(data.user_id);
                                    $(".serial_number").val(data.serial_number);
                                    $(".price").val(data.price);
                                    $("#sec_order").submit();
                                }else if(sub_type == 1){
                                    $(".individ_order_id").val(data.order_id);
                                    $(".individ_user_id").val(data.user_id);
                                    $(".individ_acreage").val(acreage);
                                    $(".individ_serial_number").val(data.serial_number);
                                    $("#individual_form").submit();
                                }else{
                                    return false;
                                }
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

    })
</script>
<body class="subscribe">
<!-- banner -->
<?php  require_once 'header-banner.php'; ?>

<!-- content start -->
<div class="content">
    <div class="info-area">
        <div class="info-area-title">你只需做个决定</div>

        <div class="info-form-area info-area-block">
            <form id="info-form" class="info-form">
                <div class="form-input-pay">
                    <p>城市</p>
                    <div class="age-list">
                        <div class="age on choose_city" data-value="<?=$this->config->item('北京市', 'city');?>" title="北京">北京</div>
                    </div>
<!--                    <input type="hidden" id="age-input" name="age" value="">-->
                </div>
                <div class="form-input-pay">
                    <p>姓名</p>
                    <div class="form-input-2">
                        <input type="text" class="choose_input_name left"  placeholder="请输入姓名" >
                    </div>
                </div>
                <div class="form-input-pay">
                    <p>装修时间</p>
                    <div class="month-list">
                        <div class="month" title="1">1月</div>
                        <div class="month" title="2">2月</div>
                        <div class="month" title="3">3月</div>
                        <div class="month" title="4">4月</div>
                        <div class="month" title="5">5月</div>
                        <div class="month" title="6">6月</div>
                        <div class="month" title="7">7月</div>
                        <div class="month" title="8">8月</div>
                        <div class="month" title="9">9月</div>
                        <div class="month" title="10">10月</div>
                        <div class="month" title="11">11月</div>
                        <div class="month" title="12">12月</div>
                    </div>
                    <input type="hidden" id="month-input" name="month" value="">
                </div>
                <div class="form-input-pay">
                    <p>房本面积</p>
                    <div class="form-input-2">
                        <input type="text" class="proportion left"  placeholder="请输入房本面积" >
                        <span>㎡</span>
                    </div>
                </div>
                <div class="form-input-pay">
                    <p>小区名称</p>
                    <div class="form-input-2">
                        <input type="text" class="house-area left"  placeholder="如：朝阳区双井时代国际嘉园一期" >
                    </div>
                </div>
                <div class="form-input top10">
                    <button type="button" class="info-form-button" data-type="2">直接预约</button>
                </div>
            </form>
        </div>
        
    </div>

</div>
<div style="display: none;">
    <input type="hidden" id="min_acreage" value="<?=MIN_ACREAGE;?>"/>
    <input type="hidden" id="max_acreage" value="<?=MAX_ACREAGE;?>"/>
    <form action="/pay/success" method="post" id="sec_order">
        <input type="hidden" name="order_id" class="order_id" value="<?=$order_id;?>"/>
        <input type="hidden" name="user_id" class="user_id" value="<?=$user_id;?>"/>
        <input type="hidden" name="price" class="price" value="0"/>
        <input type="hidden" name="phone" class="phone" value="<?=$phone;?>"/>
        <input type="hidden" name="serial_number" class="serial_number" value="<?=$serial_number;?>"/>
    </form>
</div>
<!-- content start -->
</body>
</html>
