<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<title>微信安全支付</title>
<style type="text/css">
.pay{
  width: 100%;  
  background: url(/static/image/activity/pay-bg.jpg) no-repeat;
  background-size: 100%;
  text-align: center;
  position: absolute;
}
.pay-button{
  width: 70%;
  margin-top: 70%;
  margin-left: auto;
  margin-right: auto;
  overflow: hidden;
}
.pay-money{
  width: 100%;
  height: 40px;
  margin-left: auto;
  margin-right: auto;
  border: 0;
  background-color: #1dd2af;
  color: #fff;
  font-weight: bold;
  font-size: 16px;
  border-radius: 3px;
  overflow: hidden;
}
.pay-button a img{
  width: 100%;
}
</style>
	<script type="text/javascript">
		//调用微信JS api 支付
		function jsApiCall()
		{
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				<?php echo $jsApiParameters; ?>,
				function(res){
					WeixinJSBridge.log(res.err_msg);
					//alert(res.err_code+res.err_desc+res.err_msg);
                    document.getElementById('sec_order').submit();
				}
			);
		}

		function callpay()
		{
			if (typeof WeixinJSBridge == "undefined"){
			    if( document.addEventListener ){
			        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			    }else if (document.attachEvent){
			        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
			        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			    }
			}else{
			    jsApiCall();
			}
		}
	</script>
</head>
<body class="pay">
	<div class="pay-button">
        <!--
		<button style="width:240px; height:60px; background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:24px;" type="button" onclick="callpay()" >支付一元预约金</button>
        -->
		<button class="pay-money" type="button" onclick="callpay()">支付一元预约金</button>
	</div>
</body>
<div style="display:none;">
    <form action="/pay/success" method="post" id="sec_order">
        <input type="hidden" name="order_id" class="order_id" value="<?=$order_id;?>"/>
        <input type="hidden" name="user_id" class="user_id" value="<?=$user_id;?>"/>
        <input type="hidden" name="serial_number" class="serial_number" value="<?=$serial_number;?>"/>
        <input type="hidden" name="phone" class="phone" value="<?=$phone;?>"/>
    </form>
</div>
</html>
