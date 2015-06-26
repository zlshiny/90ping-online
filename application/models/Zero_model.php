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

}