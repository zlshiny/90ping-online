<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<script type="text/javascript" src="/static/js/mobile/zepto.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>

<title>注册</title>
</head>
<script id="style" type="text/template">
    *{
    	margin:0px;
		padding:0px;
		border:0px;
        background-size:100% 100%;
        font-family: :"Microsoft YaHei";
        text-decoration:none;
    }
    body{
    	background-image:<@bg1.jpg>;
    	width:100%;
    	height:1136vx;
    }
    header{
    	height:120vx;
    	width:100%;
    	background-image:<@banner.png>;
    }
    section{
    	width:580vx;
    	position:relative;
    	left:50%;
    	margin-left:-290vx;
    	top:80vx;
    	min-height:600vx;
    	border:1px solid #1dd2af;
    	border-radius:5px;
    	background-color:#fff;
    }
    section>h1{
    	height:100vx;
    	width:440vx;
    	background-color:#1dd2af;
    	padding:0px 70vx;
    	font-size:36vx;
    	line-height:100vx;
    	color:#fff;
    }
    section>h1 a{
    	font-size:12px;
    	color:#fff;
    	float:right;
    	font-weight:normal;
    }
    section div{
    	width:440vx;
    	padding:60vx 70vx;
    }
    section div>h2{
    	color:#717171;
    	font-size:28vx;
    	font-weight:normal;
    	margin-bottom:10vx;
    }
    section div>input{
    	border-radius:5px;
    	width:440vx;
    	height:60vx;
    	border:1px solid #a6a6a6;
    	margin-bottom:20vx;
    	text-indent:10px;
    }
    section div>input:nth-of-type(4){
    	width:270vx;
    	float:left;
    	margin-right:20vx;
    }
    section div>span{
    	display:block;
    	width:145vx;
    	height:60vx;
    	text-align:center;
    	color:#fff;
    	background-color:#bfbfbf;
    	border-radius:5px;
    	float:left;
    	font-size:12px;
    	line-height:60vx;
    }
    section button{
    	width:440vx;
    	height:60vx;
    	background-color:#1dd2af;
    	color:#fff;
    	border-radius:5px;
    	margin-top:10px;
    	clear:both;
    }
    section div>a:nth-of-type(1){
    	float:left;
    	color:#1dd2af;
    	font-size:24vx;
    	margin-top:20vx;
    }
    section div>a:nth-of-type(2){
    	float:right;
    	margin-top:20vx;
    	color:#717171;
    	font-size:24vx;
    }
</script>
<style></style>
<script>
    $(window).on("resize orientationchange",function () {
        var vw = innerWidth;
        if (window._vw == vw) return;
        $("style").text(function (temp) {

            return temp.replace(/<(.)(.*?)>/g,function (str, c, exp) {

                switch (c) {
                    case '=':
                        return eval(exp);
                    case '@':
                        return 'url(/static/image/mobile/' + exp + ')';
                }
            }).replace(/\b(\d+)vx\b/g,function (str, val) {
                return vw / 640 * val + "px";
            }).replace(/(?:background-size|border-radius|box-sizing):[^};]+/g, "-webkit-$&;-moz-$&;$&");
        }($("#style").text()));
        window._vw = vw;
        setTimeout(function () {
            $(window).trigger("resize");
        }, 1000)
    }).trigger("resize");

    var g = $('.regist_msg');
    var get_code = true;
    var s = 30;
    var reg = /^1[3|4|5|7|8]\d{9}$/;    
    $("button").live('click', function(){
        var phone = $('input[name="phone"]').val();
        var passwd = $('input[name="passwd"]').val();
        var rpasswd = $('input[name="repasswd"]').val();
        var code = $('input[name="code"]').val();

        if(!reg.test(phone)){
            g.hide();
            alert('手机号码错误');
            return false;
        }else if(passwd.length < 6){
            g.hide();
            alert('密码不能小于6位');
            return false;
        }else if(rpasswd !== passwd){
            g.hide();
            alert('两次密码不一致');
            return false;
        }else if(code.length !== 4){
            g.hide();
            alert('验证码错误');
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
    };

    $('span').live('click',function(){
        var phone = $('input[name="phone"]').val();
        if(get_code){
            if(!reg.test(phone)){
                alert('手机号码错误');
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
    });

</script>
<body>
	<header></header>
	<section>
		<h1>注册<a href="/user/login">已有账号，登录</a></h1>
		<div>
			<h2>手机号码</h2>
			<input type="text" name="phone" placeholder="请输入手机号" value=""/>
			<h2>密码</h2>
			<input type="password" name="passwd" placeholder="请输入密码" value=""/>
			<h2>确认密码</h2>
			<input type="password" name="repasswd" placeholder="请输入密码" value=""/>
			<h2>验证码</h2>
			<input type="text" name="code" value=""/>
			<span class="regist_code_msg">获取验证码</span>
			<button>同意协议并注册</button>
		</div>
	</section>
</body>

</html>  
