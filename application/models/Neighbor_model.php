<?php

class Neighbor_Model extends CI_Model
{
    public $master_db = FALSE;
    private $_dbname = 'neighbor_together';

    public function __construct()
    {
        parent::__construct();
        $this->master_db = $this->load->database('master', TRUE);
    }

    public function found($arr){
        if(empty($arr)) return -1;
        if($this->master_db->insert($this->_dbname, $arr)){
            return $this->master_db->insert_id();
        }else{
            return -1;
        }
    }

    public function get_nt_detail($nt_id){
        if($nt_id <= 0) return array();
        $this->master_db->select('*');
        $this->master_db->from($this->_dbname);
        $this->master_db->where('id', $nt_id);

        $tmp = array();
        $config = $this->config->item('neighbor');
        if($query = $this->master_db->get()){
            if($row = $query->row()) {
                $tmp['id'] = $row['id'];
                $tmp['current_ucount'] = $row['current_ucount'];
                $tmp['current_state'] = $row['current_state'];
                $tmp['user_id'] = $row['user_id'];
                $tmp['slogan'] = $row['slogan'];
                $tmp['target_state'] = $row['target_state'];
                $tmp['create_time'] = date('m.d', strtotime($row['create_time']));
                $tmp['district'] = $row['district'];
                $tmp['uname'] = $row['uname'];

                $tmp['target_money'] = $config['state'][intval($tmp['target_state'])]['favorable'];
                $tmp['cur_money'] = $config['state'][intval($tmp['current_state'])]['favorable'];
                if ($tmp['current_state'] < $config['max_state']) {
                    $tmp['next_money'] = $config['state'][intval($tmp['current_state']) + 1]['favorable'];
                } else {
                    $tmp['next_money'] = 0;
                }

                $tmp['left_next_people'] = $config['state'][intval($tmp['current_state'])]['max_user'] - $tmp['current_ucount'] + 1;
                $index = intval($tmp['target_state']) - 1;
                $tmp['left_target_people'] = $config['state'][$index]['max_user'] - $tmp['current_ucount'] + 1;
                $tmp['partin'] = $this->get_partin_user($tmp['id']);
            }
        }

        return $tmp;
    }

    public function get_partin_user($nt_id){
        if($nt_id <= 0) return array();

        $sql = 'select ntu.user_id as user_id, ntu.create_time as create_time, user.name as name,
                user.phone as phone from neighbor_together_user ntu inner join user u on ntu.user_id = u.user_id
                where ntu.nt_id = ?';

        $ret = array();
        if($query = $this->master_db->query($sql, $nt_id)){
            foreach($query->result_array() as $row){
                $tmp = array();
                $tmp['user_id'] = $row['user_id'];
                $tmp['create_time'] = date('m-d H:i', strtotime($row['create_time']));
                $tmp['name'] = $row['name'];
                $tmp['phone'] = $row['phone'];
                $ret[] = $tmp;
            }
        }

        return $ret;
    }

    public function get_list($limit, $offset = 0){
        $ret = array();

        $this->master_db->select('*');
        $this->master_db->from($this->_dbname);
        $this->master_db->limit($limit, $offset);

        $config = $this->config->item('neighbor');
        if($query = $this->master_db->get()){
            foreach($query->result_array() as $row){
                $tmp = array();
                $tmp['id'] = $row['id'];
                $tmp['current_ucount'] = $row['current_ucount'];
                $tmp['current_state'] = $row['current_state'];
                $tmp['user_id'] = $row['user_id'];
                $tmp['slogan'] = $row['slogan'];
                $tmp['target_state'] = $row['target_state'];
                $tmp['create_time'] = $row['create_time'];
                $tmp['district'] = $row['district'];
                $tmp['uname'] = $row['uname'];

                $tmp['target_money'] = $config['state'][intval($tmp['target_state'])]['favorable'];
                $tmp['cur_money'] = $config['state'][intval($tmp['current_state'])]['favorable'];
                if($tmp['current_state'] < $config['max_state']){
                    $tmp['next_money'] = $config['state'][intval($tmp['current_state']) + 1]['favorable'];
                }else{
                    $tmp['next_money'] = 0;
                }

                $tmp['left_people'] = $config['state'][intval($tmp['current_state'])]['max_user'] - $tmp['current_ucount'] + 1;

                $ret[] = $tmp;
            }
        }

        return $ret;
    }

    public function get_nt($nt_id){
        $this->master_db->select('*');
        $this->master_db->from($this->_dbname);
        $this->master_db->where('id', $nt_id);
        if($query = $this->master_db->get()){
            return $query->row();
        }

        return array();
    }

    public function partin($user_id, $nt_id){
        if($user_id <= 0 || $nt_id <= 0) return -1;
        if(!$nt = $this->get_nt($nt_id)) return -2;

        $cur_state = $nt->current_state;
        $cur_ucount = $nt->current_ucount;

        $config = $this->config->item('neighbor');
        if($cur_state == $config['max_state']) return -3;
        if($cur_ucount > $config[$cur_state]['max_user']){
            return -4;
        }

        if($cur_ucount == $config[$cur_state]['max_user']){
            $cur_state ++;
        }
        $cur_ucount ++;

        $arr = array('current_state' => $cur_state, 'current_ucount' => $cur_ucount);
        $this->update($nt_id, $arr);

        $part_user = array('user_id' => $user_id, 'nt_id' => $nt_id);
        $this->add_part_user($part_user);
        return 0;
    }

    public function add_part_user($arr){
        if(empty($arr)) return -1;
        if($this->master_db->insert('neighbor_together_user', $arr)){
            return $this->master_db->insert_id();
        }else{
            return -1;
        }
    }

    public function update($id, $arr){
        if($id <= 0 || empty($arr)) return false;
        $this->master_db->where('id', $id);
        return $this->master_db->update($this->_dbname, $arr);
    }

}