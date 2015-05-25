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
    <script type="text/javascript" charset="utf-8" src="/static/js/jquery.fullPage.min.js"></script>
    <script type="text/javascript">
		$(function(){

			var bwidth = $(window).width();
		  	var bheight = $(window).height();
		  	var sheight = bheight - 60;
			$('section').width(bwidth);
			$('section').height(sheight);				
			var gheight = bheight -55;
			var pageHeight = bheight - 60;
			$('#view1 .content').height(gheight);
			$('#view2 .pages').height(bheight);
			$('#view3 .pages').height(pageHeight);
			$('#super-home-9080').height(parseInt(pageHeight*0.6));
		  	$('#super-home-last').height(parseInt(pageHeight*0.4));

			$('#slide-image').bxSlider({
			    //mode:'vertical', //默认的是水平
			    displaySlideQty:2,//显示li的个数
			    moveSlideQty: 1,//移动li的个数  
			    captions: true,//自动控制
			    auto: false,
			    controls: false//隐藏左右按钮
			});

			$('#image-list img').on('touchstart',function(){
	    		var id = $(this).attr('class');
	    		// $(this).hide();
	    		$('#'+id).hide();
	    		$('#'+id+id).show();
	    	})
	    	.on('touchend ',function(){
	    		var id = $(this).attr('class');
	    		// $(this).hide();
	    		$('#'+id+id).hide();
	    		$('#'+id).show();
	    	})

	    	$('#body').fullpage();
		}); 
    </script>    
</head>
<body>
<div  id="body">
<section id="view1" class="section">
	<div class="pages">
	    <!---->
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

	
</section>

<section id="view2" class="section">
	<div class="pages">
		<div class="content">
			<ul id="image-list">
				<li>
					<img id="1" class="1" src="/static/image/mobile/1.png">
					<img id="11" class="1" src="/static/image/mobile/1h.png" style="display:none;">
					<p class=""><a href="">极致体验</a></p>
				</li>
				<li>
					<img id="2" class="2" src="/static/image/mobile/2.png">
					<img id="22" class="2" src="/static/image/mobile/2h.png" style="display:none;">
					<p><a href="">高端品质</a></p>
				</li>
				<li>
					<img id="3" class="3" src="/static/image/mobile/3.png">
					<img id="33" class="3" src="/static/image/mobile/3h.png" style="display:none;">
					<p><a href="">80后专属</a></p>
				</li>
				<li>
					<img id="4" class="4" src="/static/image/mobile/4.png">
					<img id="44" class="4" src="/static/image/mobile/4h.png" style="display:none;">
					<p><a href="">智能的家</a></p>
				</li>
			</ul>
			<div id="image-banner" class="image-banner">
				<img src="/static/image/mobile/2.jpg">
			</div>
		</div>
	</div>

	
</section>

<section id="view3" class="section">
	<div class="pages">
		<div class="content">
			<ul id="super-home">
				<li id="super-home-9080">
					<a href="#"><img src="/static/image/mobile/9080.jpg"></a>			
				</li>
				<li id="super-home-last">
					<a href="#"><img src="/static/image/mobile/last-button.png"></a>
				</li>
			</ul>
		</div>
	</div>

	
</section>

</div>
<!-- 尾部start -->
<footer>
    <a href="/mobile/home" class="icon home active" >主页</a>
    <a href="#" class="icon loan" >贷款</a>
    <a href="/wechat/product" class="icon super" >超级Home1.0</a>
    <a href="http://wsq.discuz.qq.com/?siteid=264518165&source=wap&c=index&a=index" class="icon bbs" >社区</a>
    <a href="#" class="icon user"  >登录</a>
</footer>
<!-- 尾部end -->
</body>
</html>
