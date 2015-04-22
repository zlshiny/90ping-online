<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login Page</title>
    <link rel="stylesheet" href="css/common.css"/>
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/footer.css"/>
    <link rel="stylesheet" href="css/login.css"/>
    <script src="<?=JS_PATH . 'jquery.min.js';?>"></script>
    <script src="<?=JS_PATH . 'login.js';?>"></script>
</head>

<body class="com_page">
    <!--header-->
    <header id="header" class="header_wrapper"></header>
    <!--login body content-->
    <div class="login_body_wrapper">
        <div class="login_content">
            <div class="login_box">
                <header>登录</header>
                <form action="" class="login_form">
                    <h3 class="login_title">账号</h3>
                    <input type="text" class="login_input" placeholder="请输入手机号" />
                    <h3 class="login_title">密码</h3>
                    <input type="text" class="login_input" placeholder="请输入密码"/>

                    <button class="login_box_btn-loginIn">立即登录</button>
                    <ul class="login_bottom clearfix">
                        <li class="login_box_btn-register"><a href="">马上注册</a></li>
                        <li class="login_box_btn-forget"><a href="">忘记密码</a></li>
                    </ul>
                </form>
            </div>
        </div>
    </div>

    <!--footer-->
    <footer class="footer_wrapper" id="footer"></footer>
</body>
</html>
