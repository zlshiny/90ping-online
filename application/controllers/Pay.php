<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pay extends CI_Controller {
    
    public function index(){
        $this->load->view('alipay.php');
    }

    public function alipay(){
        //商户订单号
        $order_no = $this->input->post('order_no');
        $this->load->library('alipay');        
        $a = $this->alipay->pay($order_no);
        echo $a;
    }

    public function test(){
        $this->load->view('alipayapi.php');
    }
}
