<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="90平方，装修，互联网装修，智能家装，家装，互联网家装，方太">
<meta name="description" content="90平方-互联网智能家装，专注于80后，环保健康，高端品质">
<title>第一个专注于80后的互联网智能家装，整包一口价</title>
<link href="<?=CSS_PATH . 'main.css';?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=JS_PATH . 'jquery.min.js';?>"></script>
<script type="text/javascript" src="<?=JS_PATH . 'scrolltopcontrol.js';?>"></script>
<script type="text/javascript" src="<?=JS_PATH . 'respond.js';?>"></script>
<script type="text/javascript" src="<?=JS_PATH . 'jquery.flexslider-2.2.0.min.js';?>"></script>
<script>
var _hmt = _hmt || [];
(function() {
 var hm = document.createElement("script");
 hm.src = "//hm.baidu.com/hm.js?f6c15189a037831e314d611395fd9dfe";
 var s = document.getElementsByTagName("script")[0]; 
 s.parentNode.insertBefore(hm, s);
 })();
</script>
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
				<li><a href="/product" class="nav2">超级Home1.0</a><span></span></li>
				<li><a href="/loan" class="nav3">家装贷款</a></li>
				<li><a href="http://bbs.91haizibang.com" target="_blank" class="nav4">社区</a></li>
				<li><?php if(get_cookie(LOGIN_COOKIE_KEY)):?><a href="/order/myorder" class="nav5">个人中心<?php else:?><a href="/user/login" class="nav5">登录/注册<?php endif;?></a></li>
			</ul>
		</div>
	</div>
