<?php  require_once 'header.php'; ?>
<script type="text/javascript">
    $(function(){
        var bwidth = $(window).width();
        var bheight = $(window).height();
        var contentHeight = bheight - 55;
        $('.subscribe .content').height(contentHeight);

//        $('.info-form-button').on('click',function(){
//            var check = checkMobil('mobile');
//            if(check){
//                $('#info-form').submit();
//            }else{
//                return false;
//            }
//        })


        var s = 30;
        var get_code = true;
        $('.app_sub').live('click',function(){
            var phone = $(".app_phone").val();
            var verify_number = $(".app_code").val();
            var source = $("#order_souce").val();

            if(!input_check(phone , verify_number)){
                return false;
            }

            $.post('/order/appointment',
                {phone : phone, phone_verify_number: verify_number, source: source},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == 0){
                            if(data.order_id > 0 && data.user_id > 0){
                                $("#sec_order_id").val(data.order_id);
                                $("#sec_user_id").val(data.user_id);
                                $("#phone").val(phone);
                                $("#sec_serial_number").val(data.serial_number);
                                $("#sec_order").submit();
                            }else{
                                alert(data.msg);
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
        });


        $('.yzm').live('click',function(){
            if(get_code){
                var num = $(".app_phone").val();
                var reg = /^1[34578]\d{9}$/;
                if(!reg.test(num)){
                    alert('请输入正确的手机号');
                    return false;
                }

                code_time();
                $.post('/user/phone_verify',
                    {phone: num}, function(data, status){
                        if(status == "success"){
                            data = eval('(' + data + ')');
                            if(data.code != 0){
                                alert(data.msg);
                            }
                        }else{
                            alert('获取失败,请30秒后重新获取');
                        }
                    });
            }
        })

        var code_time = function(that){
            get_code = false;
            if(s < 0){
                $('.yzm').html('重新获取');
                get_code = true;
                s=30;
                return false;
            }
            $('.yzm').html('还剩'+s+'秒');
            s--;
            setTimeout("code_time()",1000);

        }
        var input_check = function(p,c){
            var reg = /^1[34578]\d{9}$/;
            if(!reg.test(p)){
                alert('请输入正确的手机号');
                return false;
            }else if(c.length !== 4){
                alert('请输入正确的验证码');
                return false;
            }else{
                return true;
            }
        }

    })
</script>
<body class="subscribe">
<!-- banner -->
<?php  require_once 'header-banner.php'; ?>

<!-- content start -->
<div class="content">
    <div class="info-area">
        <div class="info-area-title">你只需做个决定</div>
        <div class="info-area-block">
            <div class="subtitle-line left">
                <hr>
            </div>
            <div class="info-area-subtitle left">
                剩下所有的一切，交给我们就好
            </div>
            <div class="subtitle-line left">
                <hr>
            </div>
        </div>

        <div class="info-form-area info-area-block">
<!--            <form id="info-form" class="info-form">-->
                <div class="form-input">
                    <input type="text" id="mobile" class="mobile text-input app_phone" placeholder="请输入手机号"  >
                </div>
                <div class="form-input">
                    <input type="text" class="verify-code text-input left app_code"  placeholder="请输入验证码" >
                    <div class="info-form-button get-verify-code left yzm">获取验证码</div>
                </div>
                <div class="form-input">
                    <button type="button" class="info-form-button app_sub">立即预约</button>
                </div>
<!--            </form>-->
        </div>
    </div>

</div>
<div style="display:none;">
    <input type="hidden" id="order_souce" value="<?=ORDER_SOURCE_MOBILE;?>" />
    <form action="/order/improve" method="post" id="sec_order">
        <input type="hidden" name="order_id" id="sec_order_id" value=""/>
        <input type="hidden" name="user_id" id="sec_user_id" value=""/>
        <input type="hidden" name="phone" id="phone" value=""/>
        <input type="hidden" name="serial_number" id="sec_serial_number" value=""/>
    </form>
</div>
<!-- content start -->
</body>
</html>
