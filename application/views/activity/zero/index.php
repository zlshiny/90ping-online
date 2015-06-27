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
    <link rel="stylesheet" type="text/css" href="/static/css/activity/zero/index.css" />
    <script type="text/javascript" charset="utf-8" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/js/util.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select_state").bind('click', function(){
                var val = $(this).attr("data-val");
                var state = $(this).attr("data-id");
                $(".select_state").attr('data-id', 0);
                $(".select_state").attr("src", "/static/image/activity/zero/unselected.jpg")
                if(state == 1){
                    $(this).attr("data-id", 0);
                    $("#state_val").val(0);
                    $(this).attr("src", "/static/image/activity/zero/unselected.jpg");
                }else{
                    $(this).attr("data-id", 1);
                    $("#state_val").val(val);
                    $(this).attr("src", "/static/image/activity/zero/select.jpg");
                }
            });

            $(".city-select-1").change(function(){
                var id = $(".city-select-1 option:selected").attr("data-id");
                $(".coption").hide();
                $("#coption" + id).show();
            });

            $(".button").bind('click', function(){
                var name = $("#name").val();
                var province = $(".city-select-1 option:selected").val();
                var p_id = $(".city-select-1 option:selected").attr("data-id");
                var city = $("#coption" + p_id + " option:selected").val();
                var phone = $("#phone").val();
                var district = $("#district").val();
                var year = $("#year").val();
                var month = $("#month").val();
                var acreage = $("#acreage").val();
                var state = $("#state_val").val();

                if(name == undefined || name == ''){
                    alert('姓名不能为空哦');
                    return false;
                }

                if(province == undefined || province == ''){
                    alert('您需要选择城市哦');
                    return false;
                }

                if(city == undefined || city == ''){
                    alert('您需要选择城区哦');
                    return false;
                }

                if(phone == undefined || phone == ''){
                    alert('您需要填写手机号哦');
                    return false;
                }

                if(!check_phone(phone)){
                    alert('您的手机号不正确哦');
                    return false;
                }

                if(district == undefined || district == ''){
                    alert('你需要填写小区名称哦');
                    return false;
                }

                if(year == undefined || isNaN(year)){
                    alert('装修年份需要填写哦');
                    return false;
                }

                if(month == undefined || isNaN(month) || month <= 0 || month > 12){
                    alert('装修月份需要填写哦');
                    return false;
                }
                var month_len = (month + "").length;
                if(month_len == 1){
                    month = 0 + "" + month;
                }

                var year_len = (year + "").length;
                if(year_len == 2){
                    year = 20 + "" + year;
                }

                if(year < 2015 || year > 2017){
                    alert('你的装修年份非法哦');
                    return false;
                }

                if(acreage == undefined || acreage < 40 || acreage > 500){
                    alert('房子面积介于40到500直接哦');
                    return false;
                }

                if(state != 1 && state != 2){
                    alert('您需要选择期房或现房哦');
                    return false;
                }

                $.post('/activity/zero/found', {
                        name: name, phone: phone, state: state, province: province, city: city, year: year, month: month,
                        acreage: acreage, district: district
                    },
                    function(data, status) {
                        if (status == "success") {
                            data = eval('(' + data + ')');
                            if (data.code == 0) {
                                alert('发起成功,别忘了分享邀请朋友支持哦');
                                location.href = '/activity/zero/detail/' + data.id;
                            }else if(data.code == -11){
                                alert('您已经发起过一次了哦');
                                location.href = '/activity/zero/detail/' + data.id;
                            }else{
                                alert('服务器太忙了，请您稍后再试哦');
                                return false;
                            }
                        }
                    });
            });
         });
</script>
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
        <img src="/static/image/activity/zero/header.jpg">
    </div>
    <div class="content">
        <form class="form">
            <div class="form-line">
                <span class="form-span">你的姓名*</span>
                <input type="text" class="form-input" id="name" name="name" placeholder="如：张伟伟"/>
            </div>
            <div class="form-line">
                <span class="form-span">区域*</span>
                <div class="city-container">
                    <select class="city-select-1">
                        <option data-id="1" value="北京市">北京市</option>
                        <option data-id="2" value="燕郊">燕郊县</option>
                    </select>
                    <select id="coption1" class="coption">
                        <option data-id="1" value="东城区">东城区</option>
                        <option data-id="2" value="西城区">西城区</option>
                        <option data-id="3" value="海淀区">海淀区</option>
                        <option data-id="4" value="朝阳区">朝阳区</option>
                        <option data-id="5" value="昌平区">昌平区</option>
                        <option data-id="6" value="密云">密云</option>
                        <option data-id="7" value="顺义">顺义</option>
                        <option data-id="8" value="门头沟">门头沟</option>
                        <option data-id="9" value="大兴">大兴</option>
                        <option data-id="10" value="丰台">丰台</option>
                        <option data-id="11" value="石景山">石景山</option>
                        <option data-id="12" value="通州">通州</option>
                        <option data-id="13" value="房山">房山</option>
                        <option data-id="14" value="怀柔">怀柔</option>
                        <option data-id="15" value="平谷">平谷</option>
                        <option data-id="16" value="延庆">延庆</option>
                    </select>
                    <select id="coption2"  class="coption" style="display:none;">
                        <option data-id="1" value="燕郊">燕郊</option>
                    </select>
                </div>
            </div>
            <div class="form-line">
                <span class="form-span">联系方式*</span>
                <input type="text" class="form-input" id="phone" name="phone" placeholder="手机号码"/>
            </div>
            <div class="form-line">
                <span class="form-span">小区名称*</span>
                <input type="text" class="form-input" id="district" name="district" placeholder="如：朝阳区时代国际嘉园"/>
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
                <input type="text" class="form-input" id="acreage" name="acreage" placeholder="单位：平米"/>
            </div>
            <div class="form-line">
                <span class="form-span">房子状态*</span>
                <div class="state-cont">
                    <div class="state state1">
                        <span>期房</span>
                        <img class="select_state" data-id="1" data-val="1" src="/static/image/activity/zero/select.jpg">
                    </div>
                    <div class="state">
                        <span>现房</span>
                        <img class="select_state" data-id="0" data-val="2" src="/static/image/activity/zero/unselected.jpg">
                    </div>
                    <input type="hidden" id="state_val" value="1"/>
                </div>
            </div>
            <div class="button">提交</div>
        </form>
    </div>
</body>
</html>
