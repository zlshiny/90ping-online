<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pay extends CI_Controller {
    
    public function index(){
        if((!$order_id = $this->input->post('order_id')) || $order_id < 0){
            exit(json_encode(array(
                            'code' => -1,
                            'msg' => '缺少订单ID',
                            )
                        ));
        }

        if((!$user_id = $this->input->post('user_id')) || $user_id < 0){
            exit(json_encode(array(
                            'code' => -2,
                            'msg' => '缺少USERID',
                            )
                        ));
        }

        $data['order_id'] = $order_id;
        $data['user_id'] = $user_id;
        $this->load->view('pay.php', $data);
    }

    public function wechat(){
        $this->load->view('pay_wechat.php');
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
