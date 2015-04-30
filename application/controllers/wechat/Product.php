<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    
    public function index(){
        $data = array();
        $this->load->view('wechat.php', $data);
    }

}
