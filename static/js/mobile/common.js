window.addEventListener('load', function() {
		  FastClick.attach(document.body);
		}, false);

function checkMobil(id) { 
	var num = $("#"+id).val();
	if (num == "") { 
		alert("手机号码不能为空！");
		$("#"+id).focus(); 
		return false; 
	} 

	if (!num.match(/^(((13[0-9]{1})|159|153)+\d{8})$/)) {
		alert("手机号码格式不正确！"); 
		$("#"+id).focus(); 
		return false; 
	} 
	return true; 
} 