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

        /*if($money <= -200){
            return $user . ' 对楼主有意见,干掉你' . $money . '元';
        }else if($money <= -100){
            return $user . ' 天生捣蛋王,减你' . $money . '元';
        }else if($money < 0){
            return $user . ' 砍掉你' . $money . '元,谁叫你太帅';
        }else if($money < 20){
            return $user . ' 人品好,给你一个+' . $money . '元大红包';
        }else if($money < 40){
            return $user . ' 气势如虹,一进来就给你+' . $money . '元';
        }else if($money < 60){
            return $user . ' 大喊我去,房子都买上了,赞助+' . $money . '元去装修房子吧';
        }else if($money < 80){
            return $user . ' 品味可以啊,都预约超级Home了,+' . $money . '元';
        }else if($money < 100){
            return $user . ' 送你+' . $money . '元,还我玫瑰花啊';
        }else if($money < 120){
            return $user . ' 好基友，+' . $money . '元,不用还';
        }else if($money < 150){
            return $user . ' 为了iPhone6,我给你豁出去了,+' . $money . '元';
        }else if($money < 180){
            return $user . ' 死党的钱你也敢要?给你+' . $money . '元';
        }else if($money <= 200){
            return $user . ' 天降异才,快拿着这+' . $money . '元钞票去拯救世界吧';
        }else{
            return '系统被砍出问题了';
        }*/

        if($money <= -150){
            return ' 对楼主有意见,干掉你<span class="partin-user">' . $money . '</span>元';
        }else if($money <= -90){
            return ' <span class="partin-user">' . $money . '</span>元，皇上，臣妾不是故意的';
        }else if($money <= -70){
            return ' 砍掉你<span class="partin-user">' . $money . '</span>元，谁叫你在背后嫉妒我长得帅';
        }else if($money <= -50){
            return ' <span class="partin-user">' . $money . '</span>，小爷就不给你，求我啊求啊';
        }else if($money <= -30){
            return ' 天若有情天亦老,干掉<span class="partin-user">' . $money . '</span>好不好';
        }else if($money <= -20){
            return ' 天生捣蛋王,减你<span class="partin-user">' . $money . '</span>元';
        }else if($money <= -10){
            return ' <span class="partin-user">' . $money . '</span>元,来呀 来呀 来打我呀';
        }else if($money <= -5){
            return ' 减掉你<span class="partin-user">' . $money . '</span>元,只是想提醒你:该减肥了';
        }else if($money < 0){
            return ' 砍掉你<span class="partin-user">' . $money . '</span>元,谁叫你太帅';
        }else if($money < 20){
            return ' 支持<span class="partin-user">' . $money . '</span>,尼玛，太抠门啦，100块都不给，鄙视';
        }else if($money < 60){
            return ' 哥请客，<span class="partin-user">+' . $money . '</span>，拿去吧';
        }else if($money < 100){
            return ' 人品好,给你一个<span class="partin-user">+' . $money . '</span>元大红包';
        }else if($money < 130){
            return ' 好基友，<span class="partin-user">+' . $money . '</span>，只能帮到这了';
        }else if($money < 160){
            return ' 气势如虹,一进来就给你<span class="partin-user">+' . $money . '</span>元';
        }else if($money < 190){
            return ' 熊孩子，<span class="partin-user">+' . $money . '</span>元,带你装逼带你飞';
        }else if($money < 220){
            return ' 我去,房子都买上了,赞助<span class="partin-user">+' . $money . '</span>元去装修房子吧';
        }else if($money < 250){
            return ' 品味可以啊,都预约超级Home了,<span class="partin-user">+' . $money . '</span>元';
        }else if($money < 280){
            return ' 送你<span class="partin-user">+' . $money . '</span>元,还我玫瑰花啊';
        }else if($money < 310){
            return ' 好基友，<span class="partin-user">+' . $money . '</span>元,不用还';
        }else if($money < 340){
            return ' 为了iPhone6,我给你豁出去了,<span class="partin-user">+' . $money . '</span>元';
        }else if($money < 370){
            return ' 死党的钱你也敢要?给你<span class="partin-user">+' . $money . '</span>元';
        }else if($money < 390){
            return ' 爷穷的就剩钱了 拿去<span class="partin-user">+' . $money . '</span>元！随便花';
        }else if($money <= 400){
            return ' 天降异才,快拿着这<span class="partin-user">+' . $money . '</span>元钞票去拯救世界吧';
        }else{
            return ' <span class="partin-user">+' . $money . '</span>元，我去，怎么不直接给你砍完啊';
        }
    }

}
