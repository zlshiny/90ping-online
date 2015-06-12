<?php
include(dirname(__FILE__) . '/../../header.php');
?>
<link rel="stylesheet" type="text/css" href="/static/css/activity/neighbor_web.css">
	<div id="zc_info">
		<div class="zc_info_main">
			<div class="zc_info_banner">
				<h1><?=$detail['district'];?></h1>
				<a href="/activity/neighbor/join/<?=$detail['id'];?>/<?=urlencode($detail['district']);?>" class="zc_info_btn1">我要参与</a>
				<a href="/activity/neighbor/apply" class="zc_info_btn2">我要发起</a>
			</div>
			<div class="zc_info_wrap3">
				<div class="zc_info_title">
					结束时间：还剩 <?=$detail['left_time']['d'];?> 天 <?=$detail['left_time']['h'];?> 时  <?=$detail['left_time']['i'];?> 分  <?=$detail['left_time']['s'];?>
				</div>
				<div class="zc_info_msg">
					<h1>众筹优惠目标：<span><?=$detail['target_money'];?></span></h1>
					<h2>满20人，每人优惠10000元</h2>
					<h3>发起人：<?=$detail['uname'];?>  </h3>
					<p><?=$detail['slogan'];?></p>
				</div>
				<div class="zc_info_block">
					<p>当前参与人次</p>
					<span><?=$detail['current_ucount'];?><b>人</b></span>
				</div>
				<div class="zc_info_block">
					<p>距离目标还差</p>
					<span><?=$detail['left_target_people'];?><b>人</b></span>
				</div>
				<div class="zc_info_block">
					<p>发起时间</p>
					<span><?=$detail['create_time'];?></span>
				</div>
				<div class="zc_info_block">
					<p>邀请邻居</p>
					<span><b>邀请</b></span>
				</div>
				<div class="zc_info_list">
					<p>参与用户</p>
					<table cellspaing="0" cellpadding="0" border="0">
						<?php foreach($detail['partin'] as $part):?>
						<tr>
							<td><?=$part['name'];?></td>
							<td><?=$part['tablet'];?></td>
							<td><?=$part['create_time'];?></td>
						</tr>
						<?php endforeach;?>
					</table>
				</div>
				<div class="zc_info_list">
					<p>分享到</p>
					<a href="###" class="share_btn share_btn1"></a>
					<a href="###" class="share_btn share_btn2"></a>
					<a href="###" class="share_btn share_btn3"></a>
				</div>
				<div class="clear_padding"></div>
			</div>
		</div>
	</div>
</body>
</html>  