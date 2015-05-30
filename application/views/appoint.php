<?php
    include('header.php');
?>
<div id="choose_banner" class="choose_banner_appoint">
    <div class="choose_bg"></div>
    <div class="choose_wrap appoint">
        <h1>你只需做个决定</h1>
        <img src="<?=IMAGE_PATH . '/banner_small/msg_back.png';?>"/>
        <input type="text" class="app_phone" name="phone" value="请输入手机号" onfocus="if(this.value == '请输入手机号'){this.value = ''}" onblur="if(this.value == ''){this.value='请输入手机号'}"/>
        <input type="text" class="app_code" name="code" onfocus="if(this.value == '请输入验证码'){this.value = ''}" onblur="if(this.value == ''){this.value = '请输入验证码'}" value="请输入验证码"/>
        <div class="yzm">获取验证码</div>
        <div class="app_sub">预约</div>
    </div>
    <div style="display:none;">
        <form action="/order/improve" method="post" id="sec_order">
            <input type="hidden" name="order_id" id="sec_order_id" value=""/>
            <input type="hidden" name="user_id" id="sec_user_id" value=""/>
            <input type="hidden" name="serial_number" id="sec_serial_number" value=""/>
        </form>
    </div>
</div>

<script type="text/javascript">
    var s = 30;
    var get_code = true;
    $('.app_sub').live('click',function(){
        var phone = $(".app_phone").val();
        var verify_number = $(".app_code").val();

        if(!input_check(phone , verify_number)){
            return false;
        }

        $.post('/order/appointment',
                {phone : phone, phone_verify_number: verify_number},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == 0){
                            if(data.order_id > 0 && data.user_id > 0){
                                $("#sec_order_id").val(data.order_id);  
                                $("#sec_user_id").val(data.user_id);  
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
</script>
<?php
    include('footer.php');
?>
