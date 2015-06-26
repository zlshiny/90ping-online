<!DOCTYPE html>
<!--HTML5 doctype-->
<html>
<head>
    <title><?=$act['nickname'];?>申请了超级Home”免费装修“名额，请小伙伴们来支持！</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/static/css/activity/zero/detail.css" />
    <script type="text/javascript" charset="utf-8" src="/static/js/jquery.min.js"></script>
    <script>
    var _hmt = _hmt || [];
    (function() {
     var hm = document.createElement("script");
     hm.src = "//hm.baidu.com/hm.js?f6c15189a037831e314d611395fd9dfe";
     var s = document.getElementsByTagName("script")[0]; 
     s.parentNode.insertBefore(hm, s);
     })();
    </script>
</head>
<body>
<div class="header">
    <div>
        <img class="header_img" src="/static/image/activity/zero/detail_header.jpg">
        <div class="header_cw">
            <span class="cw_name"><?=$act['nickname'];?></span>
            <span>已众筹好友支持的<strong>188</strong>元</span>&nbsp;&nbsp;
            <span>现在排名<strong>79</strong>位</span>
        </div>
    </div>
    <img style="margin-top: -2px;">
    <div class="middle">小伙伴们：给力支持1元，得免费装修靠你啦!</div>
    <img src="/static/image/activity/zero/detail_1.jpg">
    <img src="/static/image/activity/zero/detail_2.jpg">
    <img src="/static/image/activity/zero/detail_3.jpg">
</div>
<div class="content">
    <div class="content-tip">
        <div class="tip"></div>
        <div class="support">支持你的好友</div>
    </div>
    <div class="founder">
        <div class="user_img"><img src="/static/image/activity/zero/head.png"></div>
        <div class="bubble"></div>
        <div class="slogan">
            <div class="table_top">
                <strong>姜海涌</strong><span>发布了最新动态</span>
            </div>
            <p>亲爱的邻居们，感谢你们一路的支持，坚持就是胜利，有你们的支持我一定能够成功，加油！祝大家装修顺利，合家欢乐，开开心心！</p>
            <div class="date">06-22 12:53</div>
        </div>
    </div>
    <div class="founder">
        <div class="user_img"><img src="/static/image/activity/zero/head.png"></div>
        <div class="bubble"></div>
        <div class="slogan">
            <div class="table_top">
                <strong>姜海涌</strong><span>支持了1元</span>
            </div>
            <p>亲爱的邻居们，感谢你们一路的支持，坚持就是胜利，有你们的支持我一定能够成功，加油！祝大家装修顺利，合家欢乐，开开心心！</p>
            <div class="date">06-22 12:53</div>
        </div>
    </div>
</div>
<div class="home"><img src="/static/image/activity/zero/home.jpg"></div>
<div class="info">
    <p>长按识别二维码</p>
    <img src="/static/image/activity/zero/two.png">
    <div class="nav">
        <a href="/wechat/product"><span>超级Home</span></a>&nbsp;|&nbsp;
        <a href="/activity/neighbor"><span>邻居众筹优惠</span></a>&nbsp;|&nbsp;
        <a href="/"><span>官方网站</span></a>
    </div>
</div>
<div class="footer">
    <a href="/activity/zero/support/<?=$act['wechat_uid'];?>"><div class="button button1">支持Ta</div></a>
    <!--<a href="/activity/zero/lauch"><div class="button button2">我也想要</div></a>-->
    <div class="button button2">我也想要</div>
    <form id="support_post" action="/activity/zero/support" method="post">
        <input type="hidden" name="name" value="<?=$act['nickname'];?>"/>
        <input type="hidden" name="head_img_url" value="<?=$act['head_img_url'];?>"/>
        <input type="hidden" name="wid" value="<?=$act['wechat_uid'];?>"/>
    </form>
</div>
</body>
<script type="text/javascript">
    $(".button2").click(function(){
        var me = <?=$me;?>;
        var found = <?=$is_found;?>;

        if(found == 0){
            location.href = "/activity/zero/lauch";
        }else{
            if(me == 1){
                alert('您已经发起过了哦');
                return false;
            }else{
                location.href = "/activity/zero/detail/" + <?=$cur_uid;?>;
            }
        }
    });
</script>
</html>
