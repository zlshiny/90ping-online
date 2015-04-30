$(document).ready(function(){
    $(".main_visual").hover(function(){
        $("#btn_prev,#btn_next").fadeIn()
    },function(){
        $("#btn_prev,#btn_next").fadeOut()
    });
    
    $dragBln = false;
    
    $(".main_image").touchSlider({
        flexible : true,
        speed : 200,
        btn_prev : $("#btn_prev"),
        btn_next : $("#btn_next"),
        paging : $(".flicking_con a"),
        counter : function (e){
            $(".flicking_con a").removeClass("on").eq(e.current-1).addClass("on");
        }
    });
    
    $(".main_image").bind("mousedown", function() {
        $dragBln = false;
    });
    
    $(".main_image").bind("dragstart", function() {
        $dragBln = true;
    });
    
    $(".main_image a").click(function(){
        if($dragBln) {
            return false;
        }
    });
    
    timer = setInterval(function(){
        $("#btn_next").click();
    }, 5000);
    
    $(".main_visual").hover(function(){
        clearInterval(timer);
    },function(){
        timer = setInterval(function(){
            $("#btn_next").click();
        },5000);
    });
    
    $(".main_image").bind("touchstart",function(){
        clearInterval(timer);
    }).bind("touchend", function(){
        timer = setInterval(function(){
            $("#btn_next").click();
        }, 5000);
    });
    
});

    var s = 30;
    var get_code = true;
    $('.app_sub').live('click',function(){
        var phone = $(".app_phone").val();
        var verify_number = $(".app_code").val();

        if(!input_check(phone , verify_number)){
            return false;
        }

        $.post('/order/appointment',
                {phone : phone, phone_verify_number: verify_number, source:'1'},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == 0){
                            if(data.order_id > 0 && data.user_id > 0){
                                alert('预约成功,客服稍后会与您联系');
                                return true;
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
