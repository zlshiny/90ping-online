<!DOCTYPE html>
<!--HTML5 doctype-->
<html>
<head>
	<title>超级Home</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/static/css/mobile/common.css" />
    <script type="text/javascript" charset="utf-8" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/fastclick.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/jquery.bxslider.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/mobile/common.js"></script>
    <script type="text/javascript">
		$(function(){		  
		  var pagesheight = $('.pages').height();
		  var gwidth = $('.content').width();
		  var gheight = pagesheight - 44;
		  $('.content').height(gheight);

		  $('#slide-image').bxSlider({
		        //mode:'vertical', //默认的是水平
		        displaySlideQty:0,//显示li的个数
		        moveSlideQty: 1,//移动li的个数  
		        captions: true,//自动控制
		        auto: true,
		        controls: false//隐藏左右按钮
		  });

		}); 
    </script>    
</head>
<body >
<div class="pages">
	<header class="banner">
		<img src="/static/image/mobile/banner.png">
	</header>

	<div class="content">
		<ul id="slide-image">
			<li>
				<a href="#"><img src="/static/image/mobile/1.jpg"></a>
			</li>
			<li>
				<a href="#"><img src="/static/image/mobile/2.jpg"></a>
			</li>
		</ul>
	</div>
</div>

<!-- 尾部start -->
<footer>
    <a href="#" class="icon home active" >主页</a>
    <a href="#" class="icon loan" >贷款</a>
    <a href="#" class="icon super" >超级Home1.0</a>
    <a href="#" class="icon bbs" >社区</a>
    <a href="#" class="icon user"  >登录</a>
</footer>
<!-- 尾部end -->
</body>
</html>