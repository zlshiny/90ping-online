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

    public function insert_user_arr($user){
        if(empty($user)) return -1;
        if($this->master_db->insert('user', $user)){
            return $this->master_db->insert_id();
        }else{
            return -1;
        }
    }

    public function add_wechat_user($user){
        if(empty($user)) return -1;
        if(!isset($user['openid'])) return -2;

        if($ret = $this->get_wechat_user($user['openid'])){
            return $ret->id;
        }

        if($this->master_db->insert('wechat_user', $user)){
            return $this->master_db->insert_id();
        }else{
            return -1;
        }
    }

    public function get_wechat_user($openid){
        if(!$openid) return array();

        $this->master_db->select('id, nickname, head_img_url, left_money');
        $this->master_db->from('wechat_user');
        $this->master_db->where('openid', $openid);

        if($query = $this->master_db->get()){
            return $query->row();
        }

        return array();
    }

    public function get_wechat_user_by_id($id){
        if(!$id) return array();

        $this->master_db->select('id, nickname, head_img_url, left_money');
        $this->master_db->from('wechat_user');
        $this->master_db->where('id', $id);

        if($query = $this->master_db->get()){
            return $query->row_array();
        }

        return array();
    }

    public function is_support_iphone($user_id, $support_id){
        if($user_id <= 0 || $support_id <= 0){
            return true;
        }

        $this->master_db->select('id');
        $this->master_db->from('wechat_iphone_partin');
        $this->master_db->where('founder_id', $user_id);
        $this->master_db->where('supporter_id', $support_id);

        if($query = $this->master_db->get()){
            if($query->row_array()) return true;
        }

        return false;
    }

    public function update_wechat_iphone($id, $left){
        $max = $this->config->item('price', 'iphone');
        if($id <= 0 || $left <= 0 || $left > $max) return false;

        $arr = array('left_money' => $left);
        $this->master_db->where('id', $id);
        return $this->master_db->update('wechat_user', $arr);
    }

    public function add_wechat_iphone_partin($user_id, $support_id, $name, $url, $money){
        $max = $this->config->item('price', 'iphone');
        $min = -$max;
        if($user_id <= 0 || $support_id <= 0 || $money >= $max || $money <= $min || !$url || !$name){
            return -1;
        }

        $arr = array('founder_id' => $user_id, 'supporter_id' => $support_id, 'money' => $money, 's_name' => $name, 's_head_img_url' => $url);
        if($this->master_db->insert('wechat_iphone_partin', $arr)){
            return $this->master_db->insert_id();
        }else{
            return -2;
        }
    }

    public function get_iphone_partin($user_id){
        if($user_id <= 0) return array();
        $this->master_db->select('*');
        $this->master_db->from("wechat_iphone_partin");
        $this->master_db->where('founder_id', $user_id);
        $this->master_db->order_by('create_time', 'desc');
        $this->master_db->limit(20);

        $ret = array();
        if($query = $this->master_db->get()){
            foreach($query->result_array() as $row){
                $tmp = array();
                $tmp['name'] = $row['s_name'];
                if($row['s_head_img_url']){
                    $len = strlen($row['s_head_img_url']);
                    $row['s_head_img_url'][$len - 1] = '4';
                    $row['s_head_img_url'] .= '6';
                    $tmp['head_img_url'] = $row['s_head_img_url'];
                }else{
                    $tmp['head_img_url'] = $row['s_head_img_url'];
                }

                $tmp['money'] = $row['money'];
                $tmp['slogan'] = $this->generate_iphone_slogan($tmp['name'], $tmp['money']);
                
                $ret[] = $tmp;
            }
        }

        return $ret;
    }

    public function generate_iphone_slogan($user, $money){
        if($money == 0) return '系统被砍出问题了';

        if($money < 0){
            return $user . ' 对楼主有意见，帮楼主砍了' . $money . '元';
        }else if($money < 50){
            return $user . ' 用尽全力帮助楼主砍了' . $money . '元';
        }else if($money < 150){
            return $user . ' 气势如虹，一进来就砍了' . $money . '元';
        }else if($money < 200){
            return $user . ' 砍了' . $money . '元, 快拿着这些钞票去拯救世界吧';
        }else{
            return '系统被砍出问题了';
        }
    }

}
