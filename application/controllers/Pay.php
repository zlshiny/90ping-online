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

    public function success(){
        if((!$order_id = $this->input->post('order_id')) || $order_id < 0){
            /*exit(json_encode(array(
                            'code' => -1,
                            'msg' => '缺少订单ID',
                            )
                        ));*/
            exit('缺少订单ID');
        }

        if((!$user_id = $this->input->post('user_id')) || $user_id < 0){
            /*exit(json_encode(array(
                            'code' => -2,
                            'msg' => '缺少用户ID',
                            )
                        ));*/
            exit('缺少用户ID');
        }

        if((!$serial_number = $this->input->post('serial_number')) || $serial_number < 0){
            /*exit(json_encode(array(
                            'code' => -3,
                            'msg' => '缺少订单序列号',
                            )
                        ));*/
            exit('缺少订单序列号');
        }

        if((!$price = $this->input->post('price')) || $price < 0){
            /*exit(json_encode(array(
                            'code' => -3,
                            'msg' => '缺少订单序列号',
                            )
                        ));*/
            exit('订单价格错误');
        }

        $data['serial_number'] = $serial_number;
        $data['price'] = $price;
        $this->load->view('pay_ret.php', $data);
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
