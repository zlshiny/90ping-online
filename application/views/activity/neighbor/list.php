<?php
include(dirname(__FILE__) . '/../../header.php');
?>
<link rel="stylesheet" type="text/css" href="/static/css/activity/neighbor_web.css">
<div id="zc">
    <!--
	<div id="zc_title">
		<span>邻居一起装</span>
		<input type="text" placeholder="请输入小区名搜索" class="zc_search"/>
	</div>
    -->
	<div id="zc_banner">
		<a href="/activity/neighbor/apply">我要发起</a>
	</div>
	<div class="wrap3">
		<div id="zc_main">
			<img src="/static/image/activity/neighbor/jizhi.png">
			<img src="/static/image/activity/neighbor/guize.png">
		</div>
		<?php if(!empty($list)):?>
		<?php foreach($list as $v):?>
		<div class="zc_block" data-id="<?=$v['id'];?>">
			<div class="zc_block1">
				<h1><?=$v['district'];?></h1>
				<p>北京市</p>
			</div>
			<div class="zc_block2">
				<h1>发起人：<?=$v['uname'];?></h1>
				<p>当前参与人数：<?=$v['current_ucount'];?></p>
				<p>当前优惠金额：<?=$v['cur_money'];?></p>
				<p>距离优惠5000还剩：<?=$v['left_people'];?>人</p>
			</div>
			<a href="/activity/neighbor/join/<?=$v['id'];?>/<?=urlencode($v['district']);?>">我要优惠</a>
		</div>
		<?php endforeach;?>
		<?php endif;?>
	</div>
</div>
<script type="text/javascript">
    $(".zc_block").live('click', function(){
        var id = $(this).attr("data-id");
        location.href="/activity/neighbor/detail/" + id;
    });
</script>
</body>
</html>  
