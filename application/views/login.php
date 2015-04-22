<!--<link rel="stylesheet" href="login_common.css"/>-->
<!--<link rel="stylesheet" href="header.css"/>-->
<!--<link rel="stylesheet" href="footer.css"/>-->
<link rel="stylesheet" href="<?=CSS_PATH . 'login.css';?>"/>
<script src="<?=JS_PATH . 'jquery.min.js';?>"></script>

<?php
	include('header.php');
?>
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
<?php
	include('footer.php');
?>

<!--</body>-->
