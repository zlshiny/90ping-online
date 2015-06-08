<!DOCTYPE html>
<!--HTML5 doctype-->
<html>
<head>
    <title>home1.2</title>
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

<div class="detail-title">
    <img src="/static/image/activity/detail-title.png">
</div>

<div class="detail-area">
    <div class="detail-banner">
        <div class="detail-banner-title">
            <?=$detail['district'];?>
        </div>
        <div class="button-area">
            <div class="button">
                <a href="/activity/neighbor/join/<?=$detail['id'];?>/<?=urlencode($detail['district']);?>"><button type="button" class="detail-banner-button ">我要参与</button></a>
            </div>
            <div class="button">
                <a href="/activity/neighbor/apply"><button type="button" class="detail-banner-button ">我要发起</button></a>
            </div>
        </div>
        <p>结束时间：还剩<?=$detail['left_time']['d'];?>天<?=$detail['left_time']['h'];?>时<?=$detail['left_time']['i'];?>分<?=$detail['left_time']['s'];?>秒</p>
    </div>

    <div class="detail-content">

        <div class="desciption">
            <div class="desciption-title">
                <p class="p1">众筹优惠目标：<font class="p1-money"><?=$detail['target_money'];?></font></p>
                <p class="p2">满20人，每人优惠10000元</p>
            </div>
            <div class="author">
                发起人：<?=$detail['uname'];?>
            </div>
            <div class="desciption-content">
                <?=$detail['slogan'];?>
            </div>
        </div>

        <div class="content-menu">
            <div class="content-menu-sub">
                <div class="content-menu-title">
                    当前参与人次
                </div>
                <div class="content-menu-content">
                    <?=$detail['current_ucount'];?> 人
                </div>
            </div>

            <div class="content-menu-sub">
                <div class="content-menu-title">
                    距目标还差
                </div>
                <div class="content-menu-content">
                    <?=$detail['left_target_people'];?> 人
                </div>
            </div>

            <div class="content-menu-sub">
                <div class="content-menu-title">
                    发起时间
                </div>
                <div class="content-menu-content">
                    <?=$detail['create_time'];?>
                </div>
            </div>

        </div>

        <div class="user-list">
            <p>参与用户</p>
            <table class="user-list-table">
                <?php foreach($detail['partin'] as $part):?>
                <tr style="padding-top: 10px;">
                    <td class="center" width="35%"><?=$part['name'];?></td>
                    <td class="pleft" width="30%"><?=$part['tablet'];?></td>
                    <td class="pleft" width="35%"><?=$part['create_time'];?></td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>

        <div class="share">
            <p>点击右上角邀请邻居朋友参与</p>
            <!--
            <div class="weixin">
                <a href="#"><img src="/static/image/activity/weixin.png"></a>
            </div>
            -->
        </div>
    </div>

</div>


</body>
</html>
