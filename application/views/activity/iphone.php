<!DOCTYPE html>
<!--HTML5 doctype-->
<html>
<head>
    <title>Iphone6众筹</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/static/css/activity/iphone.css" />
    <script type="text/javascript" charset="utf-8" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/fastclick.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/activity/iphone.js"></script>
</head>

<body>
<input type="hidden" id="name" value="<?php if($login_user):?><?=$login_user['name'];?><?php endif;?>" />
<input type="hidden" id="head_img_url" value="<?php if($login_user):?><?=$login_user['head_img_url'];?><?php endif;?>" />

<section id="view-5" class="section">
    <div class="title"><h3 style="display:inline;"><?=$user['nickname'];?></h3> 还差<font class="font"><?=$user['left_money'];?></font>元即可获得</div>

    <div class="content-block">
        <div class="button-block">
			<button class="support left" data-id="<?=$user['id'];?>">支持TA</button>
            <a href="/activity/iphone/found"><button class="right">我也想要</button></a>
        </div>

        <div class="content">
            <ul class="content-ul">
				<?php if(!empty($partin)):?>
                <?php foreach($partin as $p):?>
                <li>
                    <div class="li-left-2">
                        <img src="<?=$p['head_img_url'];?>">
                    </div>

                    <div class="li-right-2">
                        <?=$p['slogan'];?>
                    </div>
                </li>
				<?php endforeach;?>
                <?php endif;?>
            </ul>
        </div>

    </div>
</section>

<section id="view-4" class="section">
    <a href="/wechat/product"><div class="invite-activity">进入活动</div></a>
</section>

<section id="view-1" class="section"> 
</section>

<section id="view-2" class="section">    
</section>

<section id="view-3" class="section">
</section>


</body>
</html>
