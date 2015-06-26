<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    
    public function index(){
        if(check_device()){
            $data = array();
            $this->load->view('h5_v2.php');
        }else{
            $data = array();
            $this->load->view('product2.php', $data);
        }
    }

    public function v2(){
        $data = array();
        if(check_device()){
            $data = array();
            $this->load->view('h5_v2.php');
        }else{
            $data = array();
            $this->load->view('product2.php', $data);
        }
    }

    public function config_detail($type = 1){
        $data['type'] = $type;
        $this->load->view('config_detail.php', $data);
    }

    public function detail($id){
        $data['id'] = $id;
        $this->load->view('detail', $data);
    }

}
