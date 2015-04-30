<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    
    public function index(){
        $data = array();
        $this->load->view('wechat.php', $data);
    }

    public function kobe(){
        $this->load->view('kobe.php');
    }

    public function lebron(){
        $this->load->view('lebron.php');
    }

    public function test(){
        $this->load->view('test.php');
    }

}
