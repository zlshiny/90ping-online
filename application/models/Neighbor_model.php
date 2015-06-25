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
                $index = intval($tmp['target_state']) - 1;
                $tmp['create_time'] = date('m.d', strtotime($row['create_time']));
                $tmp['left_time'] = $this->cal_left_date($row['create_time'], $this->config->item('last_day', 'neighbor'));
                $tmp['left_seconds'] = $this->cal_left_seconds($row['create_time']);
                $tmp['district'] = $row['district'];
                $tmp['uname'] = $this->generate_name_less($row['uname']);
                $tmp['name'] = $row['uname'];
                $tmp['phone'] = $row['phone'];
                $tmp['tablet'] = $row['tablet'];

                $tmp['target_money'] = $config['state'][intval($tmp['target_state'])]['favorable'];
                $tmp['target_total_money'] = $tmp['target_money'] * ($config['state'][$index]['max_user'] + 1);
                $tmp['cur_money'] = $config['state'][intval($tmp['current_state'])]['favorable'];
                if ($tmp['current_state'] < $config['max_state']) {
                    $tmp['next_money'] = $config['state'][intval($tmp['current_state']) + 1]['favorable'];
                } else {
                    $tmp['next_money'] = 0;
                }

                $tmp['left_next_people'] = $config['state'][intval($tmp['current_state'])]['max_user'] - $tmp['current_ucount'] + 1;
                $tmp['left_target_people'] = $config['state'][$index]['max_user'] - $tmp['current_ucount'] + 1;
                $tmp['target_people'] = $config['state'][$index]['max_user'] + 1;
                $tmp['partin'] = $this->get_partin_user($tmp['id']);
                $tmp['partin'][] = array('user_id' => $tmp['user_id'],'tablet' => $tmp['tablet'], 'create_time' => $tmp['create_time'],
                    'name' => $tmp['uname'], 'phone' => $tmp['phone'], 'phone_less' => $this->generate_phone_less($tmp['phone']));

                $tmp['percent'] = ($tmp['current_ucount'] * 100) / ($config['state'][$tmp['target_state'] - 1]['max_user'] + 1);

                if($tmp['cur_money'] == 0){
                    $tmp['save_money'] = 1000;
                }else{
                    $tmp['save_money'] = $tmp['cur_money'] * $tmp['current_ucount'];
                }
            }
        }

        return $tmp;
    }

    private function generate_name_less($name){
        if(!$name || strlen($name) == 0) return '';
        $len = mb_strlen($name);
        $tmp = mb_substr($name, 0, 1);
        for($i = 0; $i < $len; $i ++){
            $tmp .= '*';
        }

        return $tmp;
    }

    private function generate_phone_less($phone){
        if(!$phone || strlen($phone) != 11) return '';
        $phone[3] = '*';
        $phone[4] = '*';
        $phone[5] = '*';
        $phone[6] = '*';

        return $phone;
    }

    private function cal_left_seconds($create_time, $base = 45){
        $ori = strtotime($create_time);
        $item = $ori + 86400 * $base;

        if($item <= time()) return 0;
        return $item - time();
    }

    private function cal_left_date($create_time, $base = 5){
        $ori = strtotime($create_time);
        $item = $ori + 86400 * $base;

        if($item <= time()){
            return array();
        }

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
                $tmp['name'] = $this->generate_name_less($row['name']);
                $tmp['phone'] = $row['phone'];
                $tmp['tablet'] = $row['tablet'];
                $tmp['phone_less'] = $this->generate_phone_less($tmp['phone']);
                $ret[] = $tmp;
            }
        }

        return $ret;
    }

    public function get_list($limit, $offset = 0){
        $ret = array();

        $last_day = $this->config->item('last_day', 'neighbor');

        $this->master_db->select('*');
        $this->master_db->from($this->_dbname);
        $this->master_db->order_by('create_time', 'desc');
        $this->master_db->where('create_time >', date('Y-m-d H:i:s', time() - $last_day * 86400));
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
                $tmp['tablet'] = $row['tablet'];

                $tmp['target_money'] = $config['state'][intval($tmp['target_state'])]['favorable'];
                $tmp['cur_money'] = $config['state'][intval($tmp['current_state'])]['favorable'];
                if($tmp['current_state'] < $config['max_state']){
                    $tmp['next_money'] = $config['state'][intval($tmp['current_state']) + 1]['favorable'];
                }else{
                    $tmp['next_money'] = 0;
                }

                $tmp['left_people'] = $config['state'][intval($tmp['current_state'])]['max_user'] - $tmp['current_ucount'] + 1;
                $tmp['left_target_people'] = $config['state'][$tmp['target_state'] - 1]['max_user'] + 1 - $tmp['current_ucount'];
                $tmp['percent'] = ($tmp['current_ucount'] * 100) / ($config['state'][$tmp['target_state'] - 1]['max_user'] + 1);
                
                if($tmp['cur_money'] == 0){
                    $tmp['save_money'] = 1000;
                }else{
                    $tmp['save_money'] = $tmp['cur_money'] * $tmp['current_ucount'];
                }

                $tmp['left_time'] = $this->cal_left_date($row['create_time'], $last_day);
                $ret[] = $tmp;
            }
        }

        return $ret;
    }

    public function is_found($user_id){
        $this->master_db->select('id');
        $this->master_db->from($this->_dbname);
        $this->master_db->where('user_id', $user_id);
        if($query = $this->master_db->get()){
            if($query->row_array()) return true;
        }

        return false;
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

    public function partin($user_id, $nt_id, $name, $phone, $tablet, $source){
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

        $part_user = array('user_id' => $user_id, 'nt_id' => $nt_id, 'uname' => $name, 'phone' => $phone, 'tablet' => $tablet, 'source' => $source);
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

        $this->master_db->select('id');
        $this->master_db->from('neighbor_together');
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
