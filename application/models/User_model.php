<?php

class User_Model extends CI_Model{
    public $master_db = FALSE;

    public function __construct(){
        parent::__construct();
        $this->master_db = $this->load->database('master', TRUE);
    }

    public function regist($phone, $passwd){
        if(!$phone) return -1;
        if(!check_phone($phone)) return -2;
        
        if($user = $this->get_user($phone)){
            if($user->status == USER_STATUS_SEC){
                return -10;
            }else if($user->status == USER_STATUS_FIR){
                if($this->update_passwd_status($user->user_id, $passwd, USER_STATUS_SEC)){
                    return $user->user_id;
                }else{
                    return -11;//更新密码失败
                }
            }else{
                return -3;
            }
        }else{
            if($user_id = $this->insert_user($phone, $passwd)){
                return $user_id;
            }else{
                return -20;
            }
        }
    }

    public function update_user($user_id, $arr){
        if(!$user_id || $user_id <= 0 || !$arr) return false;
        $this->master_db->where('user_id', $user_id);
        return $this->master_db->update('user', $arr);
    }

    public function update_user_agerange($user_id, $age){
        if(!$user_id || $user_id < 0 || ($age != 2 && $age != 1)) return false;
        $arr = array('age_range' => $age);
        $this->master_db->where('user_id', $user_id);
        return $this->master_db->update('user', $arr);
    }

    public function get_user_by_id($user_id){
        if(!$user_id || $user_id < 0) return array();

        $this->master_db->select('*');
        $this->master_db->from('user');
        $this->master_db->where('user_id', $user_id);

        if($query = $this->master_db->get()){
            return $query->row();
        }

        return array();
    }

    public function get_user($phone){
        if(!$phone) return array();
        if(!check_phone($phone)) return array();

        $this->master_db->select('*');
        $this->master_db->from('user');
        $this->master_db->where('phone', $phone);

        if($query = $this->master_db->get()){
            return $query->row();
        }

        return array();
    }

    //@param $regist 1:已注册 0:已预约,但未注册
    public function check_user_condition($phone, $regist = 1){
        if(!$phone) return -1;
        if(!check_phone($phone)) return -2;

        $this->master_db->select('user_id');
        $this->master_db->from('user');
        $this->master_db->where('phone', $phone);
        $this->master_db->where('status', $regist);

        if($query = $this->master_db->get()){
            return $query->row()->user_id;
        }else{
            return -1;
        }
    }

    public function update_passwd_status($user_id, $passwd, $status){
        if(!$passwd || !$user_id || $user_id < 0 || $status < 0) return false;

        $passwd = crypt_passwd($passwd);
        $arr = array('passwd' => $passwd, 'status' => $status);
        $this->master_db->where('user_id', $user_id);
        return $this->master_db->update('user', $arr);
    }

    public function update_encrypt($user_id, $val){
        if(!$val || strlen($val) != 20 || !$user_id || $user_id < 0) return false;
        $arr = array('encrypt_cookie' => $val);
        $this->master_db->where('user_id', $user_id);
        return $this->master_db->update('user', $arr);
    }

    //@passwd 如果$passwd为空则只是用手机号预约,不需要输入密码
    public function insert_user($phone, $passwd = ''){
        if(!$phone) return -1;

        if(!check_phone($phone)){
            return -2;
        }

        $user = array();
        $user['phone'] = $phone;
        if($passwd){
            $user['passwd'] = crypt_passwd($passwd);
            $user['status'] = 1;
        }else{
            $user['status'] = 0;
        }

        if($this->master_db->insert('user', $user)){
            return $this->master_db->insert_id();
        }else{
            return 0;
        }
    }

}
