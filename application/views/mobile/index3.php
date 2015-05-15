<!DOCTYPE html>
<!--HTML5 doctype-->
<html>
<head>
	<title>WebApp3</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <script type="text/javascript" charset="utf-8" src="js/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/fastclick.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/jquery.bxslider.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/common.js"></script>
    <script type="text/javascript">	   
		$(function(){		  
		  var gwidth = $('.pages').width();
		  var gheight = $('.pages').height();
		  $('#super-home-9080').height(parseInt(gheight*0.6));
		  $('#super-home-last').height(parseInt(gheight*0.4));
		}); 
    </script>    
</head>
<body >
<div class="pages">
	<div class="content">
		<ul id="super-home">
			<li id="super-home-9080">
				<a href="#"><img src="image/9080.jpg"></a>				
			</li>
			<li id="super-home-last">
				<a href="#"><img src="image/last.jpg"></a>
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