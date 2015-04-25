<?php
	include('header.php');
?>

<div id="login" class="regist">
   <div class="login_wrap regist_wrap">
        <div class="login_title">注册
            <a href="/user/login">已有账号，登录</a>
        </div>
        <div class="login_content">
            <!--<form action="/user/sign_in" name="login" method="post" onsubmit="return login_check()">-->
            <form action="javascript:void(0);" class="form" name="login" method="post">
               <p class="login_f">手机号码
                <span class="regist_msg phone_msg">手机号码有误，请重新输入</span>
               </p>
               <input type="text" name="phone" onfocus="if(this.value == '请输入手机号'){this.value=''}" onblur="if(this.value == ''){this.value='请输入手机号'}" value="请输入手机号"/>
               <p>密码
                <span class="regist_msg pwd_msg">密码长度不能小于6位</span>
               </p>
               <input type="text" onfocus="if(this.value == '请输入密码'){this.value=''}" onblur="if(this.value == ''){this.value='请输入密码'}" name="passwd" value="请输入密码"/>
               <p>确认密码
                <span class="regist_msg rpwd_msg">两次密码内容不一致</span>
               </p>
               <input type="text" name="repasswd" value="请再次输入密码" onfocus="if(this.value == '请再次输入密码'){this.value = ''}" onblur="if(this.value == ''){this.value='请再次输入密码'}"/>
               <p>验证码
                <span class="regist_msg code_msg">验证码输入错误</span>
               </p>
               <input type="text" name="code" class="regist_code"/>
               <div class="regist_code_msg">获取短信验证码</div>
               <button>同意协议并注册</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function(){
    var p = $('.phone_msg') , w = $('.pwd_msg') , rp = $('.rpwd_msg') , c = $('.code_msg') , g = $('.regist_msg');
    var get_code = true;
    var s = 30;
    var phone = $('input[name="phone"]').val();
    var passwd = $('input[name="passwd"]').val();
    var rpasswd = $('input[name="repasswd"]').val();
    var code = $('input[name="code"]').val();
    var reg = /^1[3|4|5|7|8]\d{9}$/;    
    $(".form").submit(function(e){
        var phone = $('input[name="phone"]').val();
        var passwd = $('input[name="passwd"]').val();
        var rpasswd = $('input[name="repasswd"]').val();
        var code = $('input[name="code"]').val();

        if(!reg.test(phone)){
            g.hide();
            p.show();
            return false;
        }else if(passwd.length < 6){
            g.hide();
            w.show();
            return false;
        }else if(rpasswd !== passwd){
            g.hide();
            rp.show();
            return false;
        }else if(code.length !== 4){
            g.hide();
            c.show();
            return false;
        }
        g.hide();

        $.post('/user/regist',
                {phone : phone, passwd : passwd, spasswd : rpasswd, verify_number : code},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == 0){
                            window.location.href="/";
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

    var code_time = function(){
        get_code = false;
        if(s < 0){
            $('.regist_code_msg').html('重新获取');
            get_code = true;
            s=30;
            return false;
        }
        $('.regist_code_msg').html('还有'+s+'秒 ');
        s--;
        setTimeout(function(){code_time()},1000);
    }
    $('.regist_code_msg').live('click',function(){
        
        var phone = $('input[name="phone"]').val();
        if(get_code){
            if(!reg.test(phone)){
                p.show();
                return false;
            }
            code_time();            
            g.hide();
            $.post('/user/phone_verify',
                {phone: phone}, function(data, status){
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

});
</script>
<?php
	include('footer.php');
?>

