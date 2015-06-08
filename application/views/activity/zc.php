<!DOCTYPE html>
<!--HTML5 doctype-->
<html>
<head>
    <title>邻居还能一起众筹装修？最高省20万！</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/static/css/activity/neighbor.css" />
    <style type="text/css">
        .ko{
            background-color: #f0ede8; 
        }
    </style>
    <script type="text/javascript" charset="utf-8" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/fastclick.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/jquery.bxslider.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/activity/neighbor.js"></script>   
</head>

<body class="zc ko">
    <div class="start">
        <a href="/activity/neighbor/apply"><button type="button" class="zc-start-button ">我要发起</button></a>
    </div>

    <div class="info-list">
        <p>机制</p>
        <ul>
            <li>用户可以在小区发起团购，发起者立减1000元</li>
            <li>同小区凑齐5户交定金，签订合同后每户返2000元现金</li>
            <li>同小区凑齐10户交定金，签订合同后每户返5000元现金</li>
            <li>同小区凑齐20户交定金，签订合同后每户返10000元现金</li>
        </ul>
    </div>

    <div class="info-list">
        <p>规则</p>
        <ul>
            <li>参与“众筹优惠”活动用户，以交定金的人数为准，定金金额为1000元人民币。定金在付款时会抵扣装修款。</li>
            <li>同一个“众筹优惠”活动的用户，必须为同一小区同一期交房的业主。</li>
            <li>参与“众筹优惠”用户，在合同签订付款时，享受优惠立减。</li>
        </ul>
    </div>
    <?php if(!empty($list)):?>
    <?php foreach($list as $v):?>
    <div class="privilege" data-id="<?=$v['id'];?>">
        <div class="privilege-area">
            <div class="title">
                <p class="p1"><?=$v['district'];?></p>
                <p class="p2">北京市</p>
            </div>
            <div class="privilege-content">
                <p>发起人：<?=$v['uname'];?></p>
                <p>当前参与人数：<?=$v['current_ucount'];?></p>
                <p>当前优惠金额：<?=$v['cur_money'];?></p>
                <p>距离优惠5000还剩：<?=$v['left_people'];?>人</p>
            </div>
        </div>
        <a href="/activity/neighbor/join/<?=$v['id'];?>/<?=urlencode($v['district']);?>"><button type="button" class="privilege-button " data-id="<?=$v['id'];?>">我要优惠</button></a>
    </div>
    <?php endforeach;?>
    <?php endif;?>

</body>
</html>