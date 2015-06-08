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
            if($row = $query->row_array()) {
                $tmp['id'] = $row['id'];
                $tmp['current_ucount'] = $row['current_ucount'];
                $tmp['current_state'] = $row['current_state'];
                $tmp['user_id'] = $row['user_id'];
                $tmp['slogan'] = $row['slogan'];
                $tmp['target_state'] = $row['target_state'];
                $tmp['create_time'] = date('m.d', strtotime($row['create_time']));
                $tmp['left_time'] = $this->cal_left_date($row['create_time'], 5);
                $tmp['district'] = $row['district'];
                $tmp['uname'] = $row['uname'];
                $tmp['phone'] = $row['phone'];
                $tmp['tablet'] = $row['tablet'];

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
                $tmp['partin'][] = array('user_id' => $tmp['user_id'],'tablet' => $tmp['tablet'], 'create_time' => $tmp['create_time'], 'name' => $tmp['uname'], 'phone' => $tmp['phone']);
            }
        }

        return $tmp;
    }

    private function cal_left_date($create_time, $base = 5){
        $ori = strtotime($create_time);
        $item = $ori + 86400 * 5;
        $now = time();
        $diff = $item - $now;

        $d = intval(floor($diff / 86400));
        $left = $diff - 86400 * $d;
        $h = intval(floor($left / 3600));
        $left = $left - 3600 * $h;
        $i = intval(floor($left / 60));
        $left = $left - $i;
        $s = $left - 60 * $i;
        if($s < 0) $s = 0;
        return array('d' => $d, 'h' => $h, 'i' => $i, 's' => $s);
    }

    public function get_partin_user($nt_id){
        if($nt_id <= 0) return array();

        $sql = 'select ntu.user_id as user_id, ntu.create_time as create_time, ntu.uname as name, ntu.tablet as tablet,
                ntu.phone as phone from neighbor_together_user ntu
                where ntu.nt_id = ?';

        $ret = array();
        if($query = $this->master_db->query($sql, $nt_id)){
            foreach($query->result_array() as $row){
                $tmp = array();
                $tmp['user_id'] = $row['user_id'];
                $tmp['create_time'] = date('m.d', strtotime($row['create_time']));
                $tmp['name'] = $row['name'];
                $tmp['phone'] = $row['phone'];
                $tmp['tablet'] = $row['tablet'];
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

    public function partin($user_id, $nt_id, $name, $phone, $tablet){
        if($nt_id <= 0) return -1;
        if(!$nt = $this->get_nt($nt_id)) return -2;

        $cur_state = $nt->current_state;
        $cur_ucount = $nt->current_ucount;

        $config = $this->config->item('neighbor');
        if($cur_state == $config['max_state']) return -3;
        if($cur_ucount > $config['state'][$cur_state]['max_user']){
            return -4;
        }

        if($cur_ucount == $config['state'][$cur_state]['max_user']){
            $cur_state ++;
        }
        $cur_ucount ++;

        $arr = array('current_state' => $cur_state, 'current_ucount' => $cur_ucount);
        $this->update($nt_id, $arr);

        $part_user = array('user_id' => $user_id, 'nt_id' => $nt_id, 'uname' => $name, 'phone' => $phone, 'tablet' => $tablet);
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

    public function is_partin_by_uid($user_id){
        if($user_id < 0) return false;
        $this->master_db->select('id');
        $this->master_db->from('neighbor_together_user');
        $this->master_db->where('user_id', $user_id);
        if($query = $this->master_db->get()){
            if($query->row_array()) return true;
        }

        return false;
    }

    public function is_partin_by_phone($phone){
        if(!$phone) return false;
        $this->master_db->select('id');
        $this->master_db->from('neighbor_together_user');
        $this->master_db->where('phone', $phone);
        if($query = $this->master_db->get()){
            if($query->row_array()) return true;
        }

        return false;
    }

}