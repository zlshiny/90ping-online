<?php
include(dirname(__FILE__) . '/../../header.php');
?>
<link rel="stylesheet" type="text/css" href="/static/css/activity/neighbor_web.css">
<!--	<div id="zc_title">-->
<!--		<span>邻居一起装</span>-->
<!--		<input type="text" placeholde="请输入小区名" class="zc_search"/>-->
<!--	</div>-->
	<div id="zc_fq">
        <input type="hidden" id="nt_id" value="<?=$id;?>"/>
        <input type="hidden" id="nt_name" value="<?=$name;?>"/>
		<div id="zc_fq_main">
			<div class="zc_fq_info">
				<h2>小区名称</h2>
                <input type="text" id="district" disabled="true" readOnly="true" value="<?=$name;?>">
				<h2>门牌号</h2>
				<input placeholder="请输入门牌号" id="tablet" type="text"/>
				<h2>姓名</h2>
				<input placeholder="请输入姓名" id="name" type="text"/>
				<h2>手机号</h2>
				<input placeholder="请输入手机号" id="phone" type="text"/>
				<button class="pay-form-submit">提交</button>
				<div class="zc_fq_msg">
					<p>申请条件:参与活动需支付1000元定金</p>
					<a href="/order">去预约</a>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
    $(".pay-form-submit").live('click', function(){
        var name = $("#name").val();
        var phone = $("#phone").val();
        var nt_id = $("#nt_id").val();
        var tablet = $("#tablet").val();

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

        $.post('/activity/neighbor/partin', {name: name, phone: phone, nt_id: nt_id, tablet: tablet}, 
                function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == 0){
                            alert('参与成功');
                            location.href = '/activity/neighbor/detail/' + data.id;
                        }else if(data.code == -20){
                            alert('您需要先预约哦');
                            location.href = '/product';
                        }else if(data.code == -21){
                            alert('您已经参与过了哦');
                            return false;
                        }else if(data.code == -11){
                            alert('活动不存在');
                            location.href = '/product';
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
</html>  
