var check_phone = function(phone){
    var reg = /^1[34578]\d{9}$/;
    if(!reg.test(phone)){
        return false;
    }

    return true;
}