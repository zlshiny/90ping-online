<?php
include(dirname(__FILE__) . '/../../header.php');
?>
<link rel="stylesheet" type="text/css" href="/static/css/activity/neighbor_web.css">
<!--	<div id="zc_title">-->
<!--		<span>邻居一起装</span>-->
<!--		<input type="text" placeholde="请输入小区名" class="zc_search"/>-->
<!--	</div>-->
	<div id="zc_fq">
		<div id="zc_fq_main">
			<div class="zc_fq_info">
				<h2>小区名称</h2>
				<input id="district" placeholder="如：朝阳区时代国际嘉园" type="text"/>
				<h2>门牌号</h2>
				<input id="tablet" placeholder="请输入门牌号" type="text"/>
				<h2>姓名</h2>
				<input id="name" placeholder="如：王先生" type="text"/>
				<h2>手机号</h2>
				<input id="phone" placeholder="请输入手机号" type="text"/>
                <h2>众筹目标</h2>
                <div class="found_item">
                    <span class="item item-on" title="1">5人1万</span>
                    <span class="item" title="2">10人5万</span>
                    <span class="item" title="3">20人20万</span>
                </div>
				<h2>宣言</h2>
                <textarea id="slogan" class="text-input left" placeholder="发挥影响力，号召朋友邻居来参与（限200字）" ></textarea>
				<button class="pay-submit" style="cursor:pointer;">提交</button>
				<div class="zc_fq_msg">
					<p>申请条件:预约并支付2000元装修定金</p>
					<a href="/order">去预约</a>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
    $('.item').live('click', function(){
        var inputVal = $(this).index();
        $('.item').removeClass('item-on');
        $(this).addClass('item-on');
    });

    $(".pay-submit").live('click', function(){
        var name = $("#name").val();
        var slogan = $("#slogan").val();
        var phone = $("#phone").val();
        var district = $("#district").val();
        var target= parseInt($(".found_item").children(".item-on").attr('title'));
        var tablet = $("#tablet").val();
        var source = <?=ORDER_SOURCE_NEIGHBOR_WEB;?>;

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

        $.post('/activity/neighbor/found', {name: name, phone: phone, slogan: slogan, district: district, target: target, tablet: tablet, source: source},
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == 0){
                            location.href = '/activity/neighbor/detail/' + data.id;
                        }else if(data.code == -2){
                            alert('手机号非法！');
                            return false;
                        }else if(data.code == -11){
                            alert('您已经发起或参与过了！不可以重复发起哦');
                            return false;
                        }else if(data.code == -10){
                            alert('创建订单错误，请您稍后再试！');
                            return false;
                        }else if(data.code == -20){
                            alert('发起活动异常，请您稍后再试！');
                            return false;
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
</html>
