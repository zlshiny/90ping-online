<?php
class Loan_Model extends CI_Model{
    public $master_db = FALSE;

    public function __construct(){
        parent::__construct();
        $this->master_db = $this->load->database('master', TRUE);
    }

    public function apply($req){
        if(empty($req)) return -1;
        if(!isset($req['phone'])) return -2;

        if(!$user = $this->user->get_user($req['phone'])) return -3;
        if($this->get_loan($user->user_id)) return -5;
        if(!$order_list = $this->order->get_order_list($user->user_id)) return -4;
        
        $ins = array('user_id' => $user->user_id, 'status' => 0, 'org' => $req['org'], 'income' => $req['income'], 'expect' => $req['expect'],
                    'location' => $req['location'], 'acreage' => $req['acreage']);

        $up_user = array('name' => $req['name'], 'gender' => $req['gender']);
        $this->user->update_user($user->user_id, $up_user);
        return $this->insert_loan($ins);
    }

    public function get_loan($user_id){
        if(!$user_id || $user_id <= 0) return false;

        $this->master_db->select('*');
        $this->master_db->from('loan');
        $this->master_db->where('user_id', $user_id);

        if($query = $this->master_db->get()){
            return $query->row();
        }

        return false;
    }

    public function insert_loan($arr){
        if(!$arr) return -1;

        $loan = array('user_id' => $arr['user_id'], 'status' => $arr['status'], 'organization' => $arr['org'], 'income' => $arr['income'], 
                'expect_amount' => $arr['expect'], 'location' => $arr['location'], 'acreage' => $arr['acreage']);
        if($this->master_db->insert('loan', $loan)){
            return $this->master_db->insert_id();
        }else{
            return -2;
        }
    }

}
