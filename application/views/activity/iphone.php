<!DOCTYPE html>
<!--HTML5 doctype-->
<html>
<head>
    <title>0元众筹iphone6！</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/static/css/activity/iphone.css" />
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
    <input type="hidden" id="user_id" value="<?=$user['id'];?>"/>
    <input type="hidden" id="nickname" value="<?=$user['nickname'];?>"/>
    <div class="view view1">
        <div><?=$user['nickname'];?> 还差 <?=$user['left_money'];?> </div>
        <a href="/activity/iphone/support/<?=$user['id'];?>">支持他</a>
        <a href="/activity/iphone/found">我也想要</a>

        <?php if(!empty($partin)):?>
        <div>
            <ul>
                <?php foreach($partin as $p):?>
                <li><img src="<?=$p['head_img_url'];?>"><?=$p['name'];?>支持了<?=$p['money'];?></li>
                <?php endforeach;?>
            </ul>
        </div>
        <?php endif;?>
    </div>
</body>
</html>
