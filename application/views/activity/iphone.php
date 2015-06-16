<!DOCTYPE html>
<!--HTML5 doctype-->
<html>
<head>
    <title>超级Home1.2上线预约，赠送Iphone6</title>
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
    <div class="title"><h3 style="display:inline;"><?=$user['nickname'];?></h3> 还差<font class="font"><?=$user['left_money'];?></font>元就要成功了</div>
    <div class="home"><a href="/wechat/product/">进入超级Home</a></div>

    <div class="content-block">
        <div class="button-block">
			<button class="support left" data-id="<?=$user['id'];?>">支持TA</button>
            <?php if($login_user['uid'] == $user['id']):?>
            <!--<a href="javascript:invite();"><button class="right invite_friend">邀请好友支持</button></a>-->
            <a href="#" class="invite_friend"><button class="right">邀请好友支持</button></a>
            <?php else:?>
            <a href="/activity/iphone/found"><button class="right">我也要</button></a>
            <?php endif;?>
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
<div id="shareit">
  <img class="arrow" src="/static/image/activity/iphone/11.png">
  <!--
  <a href="#" id="follow">
    <img id="share-text" src="http://dev.vxtong.com/cases/nuannan/imgs/share-text.png">
  </a>
  -->
</div>

<section id="view-4" class="section" style="margin-top:auto;">
    <a href="/wechat/product"><div class="invite-activity">进入活动</div></a>
</section>

<section id="view-1" class="section"> 
</section>

<section id="view-2" class="section">
</section>

<section id="view-3" class="section">
</section>


</body>
<script type="text/javascript">
    var invite = function(){
        alert('点击右上角，分享到朋友圈或直接分享给好友');
    }

    $(".invite_friend").on("click", function() {
      $("#shareit").show();
    });
   
   
    $("#shareit").on("click", function(){
        $("#shareit").hide(); 
    });

</script>
</html>
