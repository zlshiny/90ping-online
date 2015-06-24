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

<body class="apply">

<div class="apply-title">
    <img src="/static/image/activity/neighbor/mobile/header.jpg">
    <img src="/static/image/activity/neighbor/mobile/former.jpg">
</div>

<div class="apply-form">
<input type="hidden" id="nt_id" value="<?=$id;?>"/>
<input type="hidden" id="nt_name" value="<?=$name;?>"/>
    <form>
        <div class="form-element">
            <p>小区名称</p>
            <div class="form-input">
                <input type="text" class="text-input left" id="district" disabled="true" readOnly="true" value="<?=$name;?>">
            </div>
        </div>
        <div class="form-element">
            <p>门牌号</p>
            <div class="form-input">
                <input type="text" class="text-input left"  id="tablet" placeholder="如：1号楼3单元1504" >
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
            <button type="button" class="info-form-button pay-form-submit">提交</button>
        </div>
    </form>
</div>

<div class="apply-footer">
    <span class="p">参与活动需支付1000元定金</span>
    <a href="/wechat/product/v2"><span class="a" style="color:#fff;">了解超级Home1.2</span></a>
</div>
<script type="text/javascript">
    $(".pay-form-submit").live('click', function(){
        var name = $("#name").val();
        var phone = $("#phone").val();
        var nt_id = $("#nt_id").val();
        var tablet = $("#tablet").val();
        var source = <?=ORDER_SOURCE_NEIGHBOR_WECHAT;?>;

        if(name == undefined || name == ''){
            alert('姓名为空');
            return false;
        }

        if(phone == undefined || phone == ''){
            alert('手机号为空');
            return false;
        }

        if(nt_id == undefined || nt_id <= 0){
            alert('活动非法');
            return false;
        }

        if(tablet == undefined || tablet <= 0){
            alert('门牌号为空');
            return false;
        }

        $.post('/activity/neighbor/partin', {name: name, phone: phone, nt_id: nt_id, tablet: tablet, source: source},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == 0){
                            alert('参与成功');
                            location.href = '/activity/neighbor/detail/' + data.id;
                        }else if(data.code == -20){
                            alert('您需要先预约哦');
                            location.href = '/wechat/product/v2';
                        }else if(data.code == -21){
                            alert('您已经参与过了哦');
                            return false;
                        }else if(data.code == -11){
                            alert('活动不存在');
                            location.href = '/wechat/product/v2';
                        }else if(data.code == -12){
                            alert('参与人数已满,您可以自己发起哦');
                            location.href = '/activity/neighbor/apply';
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
