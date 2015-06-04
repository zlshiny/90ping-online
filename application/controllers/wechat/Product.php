<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    
    public function index(){
        $data = array();
        $this->load->view('wechat.php', $data);
    }

    public function v2(){
        $this->load->view('h5_v2.php');
    }

    public function kobe(){
        $this->load->view('mobile/index2.php');
    }

    public function lebron(){
        $this->load->view('lebron.php');
    }

    public function test(){
        $this->load->view('test.php');
    }

}
