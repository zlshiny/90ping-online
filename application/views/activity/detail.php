<!DOCTYPE html>
<!--HTML5 doctype-->
<html>
<head>
    <title>邻居一起装</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/static/css/activity/neighbor.css" />
    <script type="text/javascript" charset="utf-8" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/fastclick.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/jquery.bxslider.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/activity/neighbor.js"></script>   
</head>

<body class="detail">

<div id="shareit">
  <img class="arrow" src="/static/image/activity/iphone/11.png">
  <!--
  <a href="#" id="follow">
    <img id="share-text" src="http://dev.vxtong.com/cases/nuannan/imgs/share-text.png">
  </a>
  -->
</div>

<input type="hidden" id="is_over" value="<?php if(empty($detail['left_time'])):?>1<?php else:?>0<?php endif;?>"/>
<input type="hidden" id="district" value="<?=urlencode($detail['district']);?>"/>
<input type="hidden" id="nt_id" value="<?=$detail['id'];?>"/>
<div class="detail-title"></div>
<?php $i = $detail['id'] % 7;?>
<div class="detail-img" style="background: url('/static/image/activity/neighbor/mobile/default_<?=$i;?>.jpg')">
    <div class="detail-img-top">距结束还剩 <strong><?=$detail['left_time']['d'];?></strong> 天 <strong><?=$detail['left_time']['h'];?></strong> 时 <strong><?=$detail['left_time']['i'];?></strong> 分</div>
    <span class="district"><?=$detail['district'];?></span>
    <div class="list_top_footer">地址：<?=$detail['district'];?><?=$detail['tablet'];?></div>
</div>

<div class="detail-area">
    <div class="detail-banner">
        <div class="detail-banner-title">
            <h2 style="color:#393939;font-size:25px;">众筹优惠目标：<?=$detail['target_total_money'];?></h2>
            <p style="color:#aeaeae;font-size:15px;line-height: 25px;">同小区邻居满20人每人减1000元装修款</p>
        </div>
        <div class="button-area">
            <div class="button">
                <?php if($join == 1):?>
                <a href="javascript:share();"><button type="button" class="detail-banner-button ">邀请邻居</button></a>
                <?php elseif($apply == 1):?>
                <a href="javascript:share();"><button type="button" class="detail-banner-button ">邀请好友</button></a>
                <?php else:?>
                <a href="javascript:kobe();"><button type="button" class="detail-banner-button ">我要参与</button></a>
                <?php endif;?>
            </div>
            <div class="button">
                <?php if($apply == 1):?>
                <a href="javascript:share();"><button type="button" class="detail-banner-button ">邀请邻居</button></a>
                <?php else:?>
                <a href="/activity/neighbor/apply"><button type="button" class="detail-banner-button ">我也要发起</button></a>
                <?php endif;?>
            </div>
        </div>
<!--        --><?php //if(empty($detail['left_time'])):?>
<!--                                <p>本次众筹已结束</p>-->
<!--                                                    --><?php //else:?>
<!--        <p>结束时间：还剩--><?//=$detail['left_time']['d'];?><!--天--><?//=$detail['left_time']['h'];?><!--时--><?//=$detail['left_time']['i'];?><!--分--><?//=$detail['left_time']['s'];?><!--秒</p>-->
<!--        --><?php //endif;?>
    </div>

    <div class="detail-content">

        <div class="desciption">
            <div class="des_top" style="font-size:16px;color:#666666;text-align:left;padding-left:8px;padding-top: 20px;"><span>发起人：</span><strong><?=$detail['uname'];?></strong>(<?=$detail['tablet'];?>)</div>
            <div class="des_foot" style="width: 100%;text-align: left;font-size:14px;color:#b0b0b0;text-indent: 3em;margin-top:20px;padding-bottom: 20px;padding-left: 20px;padding-right:20px;">
                <?=$detail['slogan'];?>
            </div>
        </div>

        <div class="detail-target">
            <div class="list_conf flex_conf">
                <strong><?=$detail['percent'];?></strong><span class="shit">%</span>
                <p>已达到</p>
            </div>
            <div class="list_conf flex_conf">
                <span class="shit">￥</span><strong><?=$detail['save_money'];?></strong>
                <p>已优惠</p>
            </div>
            <div class="list_conf flex_conf">
                <strong><?=$detail['left_target_people'];?></strong><span class="shit">人</span>
                <p>还差人数</p>
            </div>
        </div>

<!--        <div class="content-menu">-->
<!--            <div class="content-menu-sub">-->
<!--                <div class="content-menu-title">-->
<!--                    当前参与人次-->
<!--                </div>-->
<!--                <div class="content-menu-content">-->
<!--                    --><?//=$detail['current_ucount'];?><!-- 人-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="content-menu-sub">-->
<!--                <div class="content-menu-title">-->
<!--                    距目标还差-->
<!--                </div>-->
<!--                <div class="content-menu-content">-->
<!--                    --><?//=$detail['left_target_people'];?><!-- 人-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="content-menu-sub">-->
<!--                <div class="content-menu-title">-->
<!--                    发起时间-->
<!--                </div>-->
<!--                <div class="content-menu-content">-->
<!--                    --><?//=$detail['create_time'];?>
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        </div>-->

        <div class="user-list">
            <p>参加众筹的邻居有：</p>
            <table class="user-list-table">
                <?php foreach($detail['partin'] as $part):?>
                <tr style="padding-top: 10px;">
                    <td class="center" width="25%" style="text-align: left;"><?=$part['name'];?></td>
                    <td class="pleft" width="25%" style="text-align: center;"><?=$part['phone_less'];?></td>
                    <td class="pleft" width="50%" style="text-align: center;"><?=$part['tablet'];?></td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
        <div class="super-home">
            <a href="/wechat/product?from=neighbor"><div class="super-home-button">进入超级Home1.2 ></div></a>
        </div>
    </div>

</div>

<script type="text/javascript">
    var kobe = function(){
        var is_over = $("#is_over").val();        
        if(is_over == 1){
            alert('本次众筹已结束，您可以发起新的众筹哦');
            return false;
        }
        
        var nt_id = $("#nt_id").val();
        var district = $("#district").val();
        location.href="/activity/neighbor/join/" + nt_id + "/" + district;
    }

    var share = function(){
      $("#shareit").show();
      location.href="#shareit";
    }

    $("#shareit").live('click', function(){
        $(this).hide();
    });
    //});
</script>

</body>
</html>
