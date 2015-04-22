<?php

function build_order_no(){
    $order_sn = (intval(@date('Y'))- 2014) . strtoupper(dechex(@date('m'))) . strtoupper(dechex(@date('d'))).
        substr(time(),-5).substr(microtime(),2,5).sprintf('%d',rand(0,99));

    return $order_sn;
}

function check_phone($phone){
    if(preg_match("/^1[34578]\d{9}$/", $phone)){
        return TRUE;
    }else{
        return FALSE;
    }
}

function generate_code($num = 4){
    if($num > 20 || $num <= 0) return '';

    $code = '';
    for($i = 0; $i < $num; $i ++){
        $code .= rand(0, 9); 
    }

    return $code;
}

function crypt_passwd($passwd){
    if(!$passwd) return -1;
    $passwd_crypt = array('salt' => PASSWD_CONS);
    return password_hash($passwd, PASSWORD_BCRYPT, $passwd_crypt);
}

function encrypt_userid($user_id){
    if(!$user_id) return FALSE;
    $salt = "+:2-'\\(i.0";
    $ret = $user_id;
    for($i = 0; $i < 5; $i ++){
        $ret = md5($salt . $ret);
    }

    return substr($ret, 2, 20);
}

function set_login_cookie($user_id){
    if(!$user_id || $user_id < 0) return FALSE;

    $encrypt = encrypt_userid($user_id);
    $cookie_val = $user_id . ":" . $encrypt;
    $CI = &get_instance();
    $CI->load->model('user_model', 'user');
    $CI->user->update_encrypt($user_id, $encrypt);
    set_cookie(LOGIN_COOKIE_KEY, $cookie_val, LOGIN_EXPIRED_DEFAULT);

    return TRUE;
}

function check_login(){
    if($val = get_cookie(LOGIN_COOKIE_KEY)){
        $val = explode(":", $val);
        if(count($val) != 2) return false;

        $user_id = $val[0];
        $encrypt = $val[1];
        $CI = &get_instance();
        $CI->load->model('user_model', 'user');
        if($user = $CI->user->get_user_by_id($user_id)){
            if($user->encrypt_cookie == $encrypt){
                return $user_id;
            }else{
                return false;
            }
        }else{
            delete_cookie(LOGIN_COOKIE_KEY);
            return false;
        }
    }else{
        return false;
    }
}

