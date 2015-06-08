<?php
    include('header.php');
?>
<div style="display:none;">
        <form action="/pay/success" method="post" id="sec_order">
            <input type="hidden" name="order_id" class="order_id" value="<?=$order_id;?>"/>
            <input type="hidden" name="user_id" class="user_id" value="<?=$user_id;?>"/>
            <input type="hidden" name="serial_number" class="serial_number" value="<?=$out_trade_no;?>"/>
            <input type="hidden" name="phone" class="phone" value="<?=$phone;?>"/>
        </form>
</div>
<div id="choose_banner" class="choose_banner_appoint">
    <div class="wechat_wrap">
        <div class="wechat_main" id="qrcode">
             <h1>使用微信支付&nbsp;<span>1元预约金</span></h1>
        </div>
    </div>
</div>
	<script src="/static/js/qrcode.js"></script>
	<script>
		if(<?php echo $unifiedOrderResult["code_url"] != NULL; ?>)
		{
			var url = "<?php echo $code_url;?>";
			//参数1表示图像大小，取值范围1-10；参数2表示质量，取值范围'L','M','Q','H'
			var qr = qrcode(10, 'M');
			qr.addData(url);
			qr.make();
			var wording=document.createElement('p');
			//wording.innerHTML = "支付一元预约金";
			var code=document.createElement('DIV');
			code.innerHTML = qr.createImgTag();
			var element=document.getElementById("qrcode");
			//element.appendChild(wording);
			element.appendChild(code);
            var a = document.createElement('a');
            element.appendChild(a);
		}

        var t;
        var loop = 1;
        function orderCheck(){
            loop ++;
            if(loop > 100){
                alert('支付超时');
                location.href="/";
            }

            var oid = $(".order_id").val();
            $.get('/wechat/pay/check_succ/' + oid, function(data, status){
                    if(status == "success"){
                        data = eval('(' + data + ')');
                        if(data.code == '0'){
                            clearTimeout(t);
                            $("#sec_order").submit();
                        }else{
                            t = setTimeout("orderCheck()", 3000);
                        }
                    }else{
                        t = setTimeout("orderCheck()", 3000);
                    }
            });
            /*var st = getCookie('pay_status')
            if (st !=null && st !="" && st == 1){
                setCookie('pay_status', '0', 1);
                clearTimeout(t);
                location.href="/";
            }else{
                t = setTimeout("orderCheck()", 1000);
            }*/
        }

        function setCookie(c_name,value,expiredays){
            var exdate=new Date()
            exdate.setDate(exdate.getDate() - expiredays)
            document.cookie=c_name+ "=" +escape(value)+
            ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
        }

        function getCookie(c_name){
            if (document.cookie.length>0){
                c_start=document.cookie.indexOf(c_name + "=")
                if (c_start!=-1){ 
                    c_start=c_start + c_name.length+1 
                    c_end=document.cookie.indexOf(";",c_start)
                    if (c_end==-1) c_end=document.cookie.length
                        return unescape(document.cookie.substring(c_start,c_end))
                    } 
            }

            return ""
        }

        $(document).ready(function(){
            orderCheck(); 
        });
	</script>

<?php
    include('footer.php');
?>
