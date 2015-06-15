<?php
include(dirname(__FILE__) . '/../../header.php');
?>
<link rel="stylesheet" type="text/css" href="/static/css/activity/neighbor_web.css">
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<div id="zc_info">
        <input type="hidden" id="is_over" value="<?php if(empty($detail['left_time'])):?>1<?php else:?>0<?php endif;?>"/>
        <input type="hidden" id="district" value="<?=urlencode($detail['district']);?>"/>
        <input type="hidden" id="nt_id" value="<?=$detail['id'];?>"/>
		<div class="zc_info_main">
			<div class="zc_info_banner">
				<h1><?=$detail['district'];?></h1>
				<a href="javascript:kobe();" class="zc_info_btn1">我要参与</a>
				<a href="/activity/neighbor/apply" class="zc_info_btn2">我要发起</a>
			</div>
			<div class="zc_info_wrap3">
				<div class="zc_info_title">
                    <?php if(empty($detail['left_time'])):?>
                        本次众筹已结束
                    <?php else:?>
					结束时间：还剩 <?=$detail['left_time']['d'];?> 天 <?=$detail['left_time']['h'];?> 时  <?=$detail['left_time']['i'];?> 分  <?=$detail['left_time']['s'];?> 秒
                    <?php endif;?>
				</div>
				<div class="zc_info_msg">
					<h1>众筹优惠目标：<span><?=$detail['target_money'];?></span></h1>
					<h2>满20人，每人优惠10000元</h2>
					<h3>发起人：<?=$detail['uname'];?>  </h3>
					<p style="text-align:center"><?=$detail['slogan'];?></p>
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
					<a href="#invite"><span><b>邀请</b></span></a>
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
				<div class="zc_info_list bdsharebuttonbox" id="invite">
					<p>邀请好友帮忙省钱</p>
					<a target="_blank" href="http://service.weibo.com/share/share.php?url=http%3A%2F%2Fwww.90pingfang.com%2Factivity%2Fneighbor%2Fdetail%2F13%23%23%23&appkey=<?=WEIBO_APP_KEY;?>&title=我预约了超级Home智能家装，发起了邻居一起装，参与者最高可以省20W，大家一起来省点装修钱吧&pic=&ralateUid=&language=zh_cn" class="share_btn share_btn1"></a>
					<!--<a href="###" class="share_btn share_btn2"></a>-->
                    <!--<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>-->
                    <a href="#" class="bds_weixin share_btn share_btn2" data-cmd="weixin" title="分享到微信"></a>
                    <a href="#" class="bds_qzone share_btn share_btn3" data-cmd="qzone" title="分享到QQ空间"></a>
				</div>
				<div class="clear_padding"></div>
			</div>
		</div>
	</div>
    </body>
    <script type="text/javascript">
        window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"我预约了超级Home智能家装，发起了邻居一起装，参与者最高可以省20W，大家一起来省点装修钱吧","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];

    /*wx.config({
        debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: '<?=WECHAT_APPID;?>', // 必填，公众号的唯一标识
        timestamp: <?=time();?>, // 必填，生成签名的时间戳
        nonceStr: 'ac3r', // 必填，生成签名的随机串
        signature: '',// 必填，签名，见附录1
        jsApiList: [onMenuShareTimeline, onMenuShareAppMessage, onMenuShareAppMessage] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });*/

    //$("#zc_info_btn1").live('click', function(){
    var kobe = function(){
        var is_over = $("#is_over").val();        
        if(is_over == 1){
            alert('本次众筹已结束，您可以重新发起');
            return false;
        }
        
        var nt_id = $("#nt_id").val();
        var district = $("#district").val();
        location.href="/activity/neighbor/join/" + nt_id + "/" + district;
    }
    //});

    /*wx.ready(function(){
        wx.onMenuShareTimeline({
            title: '', // 分享标题
            link: '', // 分享链接
            imgUrl: '', // 分享图标
            success: function () { 
            // 用户确认分享后执行的回调函数
            },
            cancel: function () { 
            // 用户取消分享后执行的回调函数
            }
        });
    });*/
</script>
</html>  
