<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    
    public function index(){
        if(check_device()){
            $data = array();
            $this->load->view('wechat.php', $data);
        }else{
            $data = array();
            $this->load->view('product.php', $data);
        }
    }

    public function config_detail($type = 1){
        $data['type'] = $type;
        $this->load->view('config_detail.php', $data);
    }

}
