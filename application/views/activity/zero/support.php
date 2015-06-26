<!DOCTYPE html>
<!--HTML5 doctype-->
<html>
<head>
    <title>专注80后互联网智能家装—超级Home，“免费装修”名额申请中</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/static/css/activity/zero/support.css" />
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
    <input type="hidden" id="ori_uid" value="<?=$w_uid;?>"/>
    <input type="hidden" id="cur_uid" value="<?=$cur_uid;?>"/>
    <div class="header">
        <div class="user_img"><img src="/static/image/activity/zero/head.png"></div>
        <div class="img_cont">
            <p class="img_name"><?=$name;?></p>
            <p class="slogan">“免费装修”众筹支持，急需你的帮助</p>
        </div>
    </div>
    <div class="body">
        <div class="content">
            <div class="ongoing"><img src="/static/image/activity/zero/ongoing.jpg"></div>
            <div class="xuanyan">
                <?=$name;?>：邻居们，帮助别人就是帮助自己。赢得十万元免费装修券就靠你们啦！感谢大家，期待支持！
            </div>
        </div>
        <div class="money">
            <p class="p-title">每个好友仅限1元</p>
            <div class="money_cons">支持金额：&nbsp;1元</div>
        </div>
        <div class="comment">
            <p class="p-title">对你的朋友说点什么…</p>
            <textarea id="say" placeholder="拿着这笔钱去拯救地球吧"></textarea>
        </div>
    </div>
    <div class="button">确认支付，去付款</div>

        <form action="/wechat/pay/zero" method="post" id="sec_order">
            <input type="hidden" name="cur_id" class="cur_id" value="<?=$cur_uid;?>"/>
            <input type="hidden" name="ori_id" class="ori_id" value="<?=$w_uid;?>"/>
        </form>
</body>
<script type="text/javascript">
    $(".button").bind('click', function(){
        var ori_uid = $("#ori_uid").val();
        var cur_uid = $("#cur_uid").val();

        if(ori_uid <= 0){
            alert('服务器开小差了哦');
            return false;
        }

        var say = $("#say").val();

        $.post('/activity/zero/tribute', {uid: ori_uid, say: say},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == 0){
                            $("#sec_order").submit();
                        }else if(data.code == -10){
                            alert('您已经支持过了哦');
                            return false;
                        }else{
                            alert('服务器开小差了哦, 请您稍后重试');
                            return false;
                        }
                    }
                });
    });
</script>
</html>
