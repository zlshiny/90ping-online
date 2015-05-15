<!DOCTYPE html>
<!--HTML5 doctype-->
<html>
<head>
	<title>WebApp2</title>
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
			var listheight = parseInt(gheight*0.66);
			var bannerheight = parseInt(gheight*0.34);
			
			if(bannerheight < 160){
				bannerheight = 160;
				listheight = gheight - bannerheight;				
			}
			var liheight = parseInt(listheight*0.5);
			$('#image-list').height(listheight);
			$('#image-list img').height(parseInt(liheight*0.8));
			$('#image-list img').css('width','auto');
			$('#image-banner').height(parseInt(bannerheight));
			$('#image-banner img').css('max-width','100%');
	    	$('#image-list img').on('touchstart',function(){
	    		var id = $(this).attr('id');
	    		$(this).attr('src','image/'+id+'h.png')
	    	})
	    	.on('touchend ',function(){
	    		var id = $(this).attr('id');
	    		$(this).attr('src','image/'+id+'.png')
	    	})
	    })

    </script>    
</head>
<body >
<div class="pages">

	<div class="content">
		<ul id="image-list">
			<li>
				<img id="1" src="image/1.png">
				<p class=""><a href="">极致体验</a></p>
			</li>
			<li>
				<img id="2" src="image/2.png">
				<p><a href="">高端品质</a></p>
			</li>
			<li>
				<img id="3" src="image/3.png">
				<p><a href="">80后专属</a></p>
			</li>
			<li>
				<img id="4" src="image/4.png">
				<p><a href="">智能的家</a></p>
			</li>
		</ul>
		<div id="image-banner" class="image-banner">
			<img src="image/2.jpg">
		</div>
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