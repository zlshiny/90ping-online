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

<body class="apply">

<div class="apply-title">
    <img src="/static/image/activity/apply-title.jpg">
</div>

<div class="apply-form">
    <form>
        <div class="form-element">
            <p>小区名称</p>
            <div class="form-input">
                <input type="text" class="text-input left" id="district"  placeholder="如：朝阳区时代国际嘉园" >
            </div>
        </div>
        <div class="form-element">
            <p>门牌号</p>
            <div class="form-input">
                <input type="text" class="text-input left" id="tablet" placeholder="门牌号" >
            </div>
        </div>
        <div class="form-element">
            <p>姓名</p>
            <div class="form-input">
                <input type="text" class="text-input left"  id="name" placeholder="如：王先生" >
            </div>
        </div>
        <div class="form-element">
            <p>手机号</p>
            <div class="form-input">
                <input type="text" class="text-input left" id="phone"  placeholder="请输入手机号" >
            </div>
        </div>
         <div class="form-element">            
            <p>众筹目标</p>            
            <div class="month-list">                
                <div class="month on" title="1">优惠1万</div>                
                <div class="month" title="2">优惠5万</div>                
                <div class="month" title="3">优惠20万</div>                
            </div>            
            <input type="hidden" id="month-input" name="month" value="">        
        </div>
        <div class="form-element">
            <p>宣言</p>
            <div class="form-input">
                <!--<input type="text" class="text-input left" id="slogan"  placeholder="发挥影响力，号召朋友邻居来参与（限200字）" >-->
                <textarea class="text-input left" id="slogan" style="height:60px;line-height:20px;" placeholder="发挥影响力，号召朋友邻居来参与（限200字）" ></textarea>
            </div>
        </div>

        <div class="form-element">
            <button type="button" class="info-form-button pay-form-submit">提交</button>
        </div>
    </form>
</div>

<div class="apply-footer">
    <span class="p">发起活动需支付1000元定金</span>
    <a href="/wechat/product/v2"><span class="a" style="color:#fff;">了解超级Home1.2</span></a>
</div>
<script type="text/javascript">
    $(".pay-form-submit").live('click', function(){
        var name = $("#name").val();
        var slogan = $("#slogan").val();
        var phone = $("#phone").val();
        var district = $("#district").val();
        var target= parseInt($(".month-list").children(".on").attr('title'));
        var tablet = $("#tablet").val();

        if(name == undefined || name == ''){
            alert('姓名为空');
            return false;
        }

        if(phone == undefined || phone == ''){
            alert('手机号为空');
            return false;
        }

        if(slogan == undefined || slogan == ''){
            alert('宣言为空');
            return false;
        }

        if(district == undefined || district == ''){
            alert('地区为空');
            return false;
        }

        if(tablet == undefined || tablet == ''){
            alert('门牌号为空');
            return false;
        }

        $.post('/activity/neighbor/found', {name: name, phone: phone, slogan: slogan, district: district, target: target, tablet: tablet}, 
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == 0){
                            alert('发起成功');
                            location.href = '/activity/neighbor/detail/' + data.id;
                        }else if(data.code == -20){
                            alert('您需要先预约哦');
                            location.href = '/wechat/product/v2';
                        }else{
                            alert('系统错误，请稍后再试！');
                            return false;
                        }
                    }else{
                        alert('系统错误，请稍后再试！');
                        return false;
                    }
        });
    });
</script>

</body>
</html>
