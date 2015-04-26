<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>互联网智能家装</title>
<link href="<?=CSS_PATH . 'main.css';?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=JS_PATH . 'jquery.min.js';?>"></script>
<script type="text/javascript" src="<?=JS_PATH . 'scrolltopcontrol.js';?>"></script>
</head>
<script type="text/javascript">
window.onscroll = function(){
	if(document.body.scrollTop > 130){
		$('.i_banner_1').find('a').addClass('fix_p')
	}else{
		$('.i_banner_1').find('a').removeClass('fix_p')
	}
}
	
</script>
<body>
	<div id="header">
		<div class="wrap">
			<a href="/" id="logo"></a>
			<ul id="nav">
				<li><a href="/" class="nav1">主页</a></li>
				<li><a href="/product" class="nav2">超级Home1.0</a></li>
				<li><a href="/loan" class="nav3">家装贷款</a></li>
				<li><a href="http://91haizibang.com" target="_blank" class="nav4">社区</a></li>
				<li><?php if(get_cookie(LOGIN_COOKIE_KEY)):?><a href="/order/myorder" class="nav5">个人中心<?php else:?><a href="/user/login" class="nav5">登录/注册<?php endif;?></a></li>
			</ul>
		</div>
	</div>
