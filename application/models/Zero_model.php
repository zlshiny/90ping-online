<?php

class Zero_Model extends CI_Model{
    public $master_db = FALSE;
    private $_dbname = 'activity_zero';

    public function __construct(){
        parent::__construct();
        $this->master_db = $this->load->database('master', TRUE);
    }

    public function insert_arr($arr){
        if(empty($arr)) return -1;
        if($this->master_db->insert($this->_dbname, $arr)){
            return $this->master_db->insert_id();
        }else{
            return -1;
        }
    }

    public function get_rank($money){
        $this->master_db->select('count(*) as num');
        $this->master_db->from($this->_dbname);
        $this->master_db->where('money >= ', $money);

        $row = array();
        if($query = $this->master_db->get()){
            $row = $query->row_array();
            return $row['num'];
        }

        return 1;
    }

    public function get_instance_by_wechat_uid($uid){
        if($uid <= 0) return array();

        $this->master_db->select('id, wechat_uid, money, create_time');
        $this->master_db->from($this->_dbname);
        $this->master_db->where('wechat_uid', $uid);

        $row = array();
        if($query = $this->master_db->get()){
            $row = $query->row_array();

            if($user = $this->user->get_wechat_user_by_id($row['wechat_uid'])){
                $row['nickname'] = $user['nickname'];
                $row['head_img_url'] = $user['head_img_url'];
                $len = strlen($row['head_img_url']);
                $row['head_img_url'][$len - 1] = '9';
                $row['head_img_url'] .= '6';
            }else{
                return array();
            }
        }

        return $row;
    }

    public function get_instance_by_id($id){
        if($id <= 0) return array();

        $this->master_db->select('id, wechat_uid, money, create_time');
        $this->master_db->from($this->_dbname);
        $this->master_db->where('id', $id);

        $row = array();
        if($query = $this->master_db->get()){
            $row = $query->row_array();

            if($user = $this->user->get_wechat_user_by_id($row['wechat_uid'])){
                $row['nickname'] = $user['nick_name'];
                $row['head_img_url'] = $user['head_img_url'];
                $len = strlen($row['head_img_url']);
                $row['head_img_url'][$len - 1] = '9';
                $row['head_img_url'] .= '6';
            }else{
                return array();
            }
        }

        return $row;
    }

    public function get_partin($user_id){
        if($user_id <= 0) return array();
        $this->master_db->select('*');
        $this->master_db->from("activity_zero_partin");
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
                    $row['s_head_img_url'][$len - 1] = '9';
                    $row['s_head_img_url'] .= '6';
                    $tmp['head_img_url'] = $row['s_head_img_url'];
                }else{
                    $tmp['head_img_url'] = $row['s_head_img_url'];
                }

                $tmp['money'] = $row['money'];
                $tmp['slogan'] = $row['slogan'];
                $tmp['create_time'] = $row['create_time'];
                if(empty($tmp['slogan'])){
                    $tmp['slogan'] = '拿着这些钱去拯救世界吧！';
                }

                $ret[] = $tmp;
            }
        }

        return $ret;
    }

    public function is_partin($user_id, $support_id){
        if($user_id <= 0 || $support_id <= 0){
            return true;
        }

        $this->master_db->select('id');
        $this->master_db->from('activity_zero_partin');
        $this->master_db->where('founder_id', $user_id);
        $this->master_db->where('supporter_id', $support_id);

        if($query = $this->master_db->get()){
            if($query->row_array()) return true;
        }

        return false;
    }

    public function is_lauch($user_id){
        if($user_id <= 0){
            return true;
        }

        $this->master_db->select('id');
        $this->master_db->from('activity_zero');
        $this->master_db->where('wechat_uid', $user_id);

        if($query = $this->master_db->get()){
            if($query->row_array()) return true;
        }

        return false;
    }

    public function add_partin($partin){
        if(empty($partin)) return -1;

        if($this->master_db->insert('activity_zero_partin', $partin)){
            return $this->master_db->insert_id();
        }else{
            return -1;
        }
    }

    public function update_money($ori_uid, $cur_uid){
        if($ori_uid <= 0 || $cur_uid <= 0) return false;

        $arr['money'] = 1;

        $this->master_db->where('founder_id', $ori_uid);
        $this->master_db->where('supporter_id', $cur_uid);
        $this->master_db->update('activity_zero_partin', $arr);

        return $this->add_money($ori_uid);
    }

    public function add_money($ori_uid){
        if($ori_uid <= 0) return false;

        $sql = 'update activity_zero set money=money+1 where wechat_uid = ?';
        if($query = $this->master_db->query($sql, array($ori_uid))){
            return true;
        }

        return false;
    }

}
