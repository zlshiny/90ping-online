<?php
	include('header.php');
?>
<div class="flexslider">
<!--	<a href="/order" target="_blank"></a>-->
        <ul class="slides">
			<li class="i_banner_1">
				<p class="bgc ft45 ma">史上第一个专注于85后</p>
				<p class="ft72 p20">互联网智能家装探索者</p>
				<p class="ft18 lh30">相比于低价，我们更追求品质和逼格，我们更关心健康环保<br/>
				不仅是房子，更是小伙伴们的社交场所<Br/>
				真正极致的体验：一键支付，拎包入住</p>
			</li>
			<li class="i_banner_1_new">
				
			</li>
		</ul>

</div>
<div id="i_mid">
	<div class="b_wrap">
	<a class="i_mid1" href="###">极致体验</a>
	<a class="i_mid2" href="###">高端品质</a>
	<a class="i_mid3" href="###">80后专属</a>
	<a class="i_mid4" href="###">智能家庭</a>
	<div class="clearfix"></div>
	</div>
</div>
<div class="i_banner_2">
	<img src="<?=IMAGE_PATH . 'd.png';?>">
	<p class="ft36 p20">我们拒绝70后，不做大户型</p>
	<p class="ft50 ">只为80后，造一个有逼格的家</p>
	<p class="ft18 p20">让房子，更懂我们80后的生活习惯，只精心做好90平方户型，80后第一套房</p>
</div>
<div id="i_main">
	<div class="i_wrap">
		<div class="msg">
			<img src="<?=IMAGE_PATH . 'i_msg1.png';?>">
			<p>我们拒绝70后，不做大户型</p>
			<div class="m_content">Less is more 。我们不做大户型，坚持只做90㎡的房子。我们不做任何浮夸的设计，摒弃欧式繁复的线条，讲究功能及实用，选用环保的材料，注重使用者的体验，期待用艺术关怀80后的奋斗者。</div>
		</div>
		<div class="msg" >
			<img src="<?=IMAGE_PATH . 'i_msg2.png';?>" style="margin-left:15px;">
			<p>只为80后，造一个有逼格的家</p>
			<div class="m_content">
            Not for everyone ，我们坚持用梦想为80后筑家。超级home品牌秉承简约舒适的设计理念，思考和规划80后的家庭生活环境和实用需求，选用欧洲高品质现代家具，让80后感受到生活的美好。
            </div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<div class="i_banner_3">
    <!--
	<p class="ft72">超级Home1.0内测   仅10位天使用户</p>
	<p class="ft30 p50">90平米户型  一口价  15.6万<br/><br/>
        换回30万整套智能家装解决方案，配好顶级家具软装和高端厨卫，拎包入住
    </p>
    -->
    <div class="kobe">
	<a href="/order" target="_blank" class="bgcl ft48">成为天使用户</a>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".flexslider").flexslider({
					directionNav: true,
					pauseOnAction: true,
					animation: "slide",  
					slideshowSpeed: 4000
		});
	});
</script>
<?php
	include('footer.php');
?>
