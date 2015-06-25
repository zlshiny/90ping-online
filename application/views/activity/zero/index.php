<!DOCTYPE html>
<!--HTML5 doctype-->
<html>
<head>
    <title>抢零元装修名额！</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/static/css/activity/zero/index.css" />
    <script type="text/javascript" charset="utf-8" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/activity/zero/index.js"></script>
</head>
<body>
    <div class="header">
        <img src="/static/image/activity/zero/header.jpg">
    </div>
    <div class="content">
        <form class="form">
            <div class="form-line">
                <span class="form-span">你的姓名*</span>
                <input type="text" class="form-input" placeholder="如：张伟伟"/>
            </div>
            <div class="form-line">
                <span class="form-span">区域*</span>
                <div class="city-container">
                    <select class="city-select-1">
                        <option value="1">北京市</option>
                        <option value="2">燕郊</option>
                    </select>
                    <select>
                        <option value="1">东城区</option>
                        <option value="1">西城区</option>
                        <option value="1">海淀区</option>
                        <option value="1">朝阳区</option>
                        <option value="1">昌平区</option>
                        <option value="1">密云</option>
                        <option value="1">顺义</option>
                        <option value="1">门头沟</option>
                    </select>
                </div>
            </div>
            <div class="form-line">
                <span class="form-span">联系方式*</span>
                <input type="text" class="form-input" placeholder="手机号码"/>
            </div>
            <div class="form-line">
                <span class="form-span">小区名称*</span>
                <input type="text" class="form-input" placeholder="如：朝阳区时代国际嘉园"/>
            </div>
            <div class="form-line">
                <span class="form-span">装修时间*</span>
                <div class="time_container">
                    <input type="text" id="year" class="time1 time"/>
                    <input type="text" value="年" class="time2 time" readonly/>
                    <input id="month" class="time3 time" type="text"/>
                    <input type="text" value="月" class="time4 time" readonly/>
                </div>
            </div>
            <div class="form-line">
                <span class="form-span">房子面积*</span>
                <input type="text" class="form-input" placeholder="单位：平米"/>
            </div>
            <div class="form-line">
                <span class="form-span">房子状态*</span>
                <div class="state-cont">
                    <div class="state state1">
                        <span>期房</span>
                        <img class="select_state" data-state="1" src="/static/image/activity/zero/select.jpg">
                    </div>
                    <div class="state">
                        <span>现房</span>
                        <img class="select_state" data-state="0" src="/static/image/activity/zero/unselected.jpg">
                    </div>
                </div>
            </div>
            <div class="button">提交</div>
        </form>
    </div>
</body>
<script type="text/javascript">
    $(".select_state").live('click', function(){
        var state = $(this).attr("data-state");
        $(".select_state").attr('data-state', 0);
        $(".select_state").attr("src", "/static/image/activity/zero/unselected.jpg")
        if(state == 1){
            $(this).attr("data-state", 0);
            $(this).attr("src", "/static/image/activity/zero/unselected.jpg");
        }else{
            $(this).attr("data-state", 1);
            $(this).attr("src", "/static/image/activity/zero/select.jpg");
        }
    });
</script>
</html>