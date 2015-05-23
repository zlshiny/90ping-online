<?php
class House_Model extends CI_Model{
    public $master_db = FALSE;

    public function __construct(){
        parent::__construct();
        $this->master_db = $this->load->database('master', TRUE);
    }

    public function insert_house($order_id, $user_id, $acr){
        if(!$order_id || $order_id < 0 || !$user_id || $user_id < 0 || !$acr || $acr < 0 || $acr > MAX_ACREAGE) return -1;

        $house = array('order_id' => $order_id, 'user_id' => $user_id, 'acreage' => $acr);
        if($this->master_db->insert('house', $house)){
            return $this->master_db->insert_id();
        }else{
            return -1;
        }
    }

    public function insert_house_arr($house){
        if(empty($house)) return -1;
        if($this->master_db->insert('house', $house)){
            return $this->master_db->insert_id();
        }else{
            return -1;
        }
    }

    public function update_house($house_id, $arr){
        if($house_id <= 0 || empty($arr)) return false;

        $this->master_db->where('id', $house_id);
        return $this->master_db->update('house', $arr);
    }

}
