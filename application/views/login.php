<?php
	include('header.php');
?>

<div id="login">
    <div class="login_bg"></div>
    <div class="login_wrap">
        <div class="login_title">登录</div>
        <div class="login_content">
            <!--<form action="/user/sign_in" name="login" method="post" onsubmit="return login_check()">-->
            <form action="javascript:void(0);" class="form" name="login" method="post">
               <p class="login_f">账号</p>
               <input type="text" name="phone" onfocus="if(this.value == '请输入手机号'){this.value=''}" onblur="if(this.value == ''){this.value='请输入手机号'}" value="请输入手机号"/>
               <p>密码</p>
               <input type="password" placeholder="请输入密码"  name="passwd" value=""/>
               <button>立即登录</button>
            </form>
            <div class="login_other">
                <a href="/user/signup" class="other1">马上注册</a>
                <!--<a href="###" class="other2">忘记密码</a>-->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    /*var login_check = function(){
        var phone = $('input[name="phone"]').val();
        var pwd = $('input[name="pwd"]').val();
        var reg = /^1[3|4|5|8][0-9]\d{4,8}$/;
        if(!reg.test(phone)){
            alert('请输入正确的手机号');
            return false;
        }else if(pwd.length < 6){
            alert('请输入大于6位的密码');
            return false;
        }else{
            return true;
        }
        
    }*/

$(document).ready(function(){
    $(".form").submit(function(e){
        var phone = $('input[name="phone"]').val();
        var passwd = $('input[name="passwd"]').val();
        var reg = /^1[3|4|5|8|7]\d{9}$/;
        if(!reg.test(phone)){
            alert('请输入正确的手机号');
            return false;
        }else if(passwd.length < 6){
            alert('请输入大于6位的密码');
            return false;
        }

        $.post('/user/sign_in',
                {phone : phone, passwd : passwd},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == 0){
                            window.location.href = "/index.php";
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

});
</script>
<?php
	include('footer.php');
?>

