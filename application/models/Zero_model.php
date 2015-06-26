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

    public function get_instance_by_id($id){
        if($id <= 0) return array();

        $this->master_db->select('id, wechat_uid');
        $this->master_db->from($this->_dbname);
        $this->master_db->where('id', $id);

        $row = array();
        if($query = $this->master_db->get()){
            $row = $query->row_array();

            if($user = $this->user->get_wechat_user_by_id($row['wechat_uid'])){
                $row['nickname'] = $user['nick_name'];
                $row['head_img_url'] = $user['head_img_url'];
                $len = strlen($row['head_img_url']);
                $row['head_img_url'][$len - 1] = '4';
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

}