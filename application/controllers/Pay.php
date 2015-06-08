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

        if((!$phone = $this->input->post('phone'))){
            /*exit(json_encode(array(
                            'code' => -2,
                            'msg' => '缺少用户ID',
                            )
                        ));*/
            exit('缺少手机号');
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
            //exit('订单价格错误');
            $price = BASE_PRICE;
        }

        $data['serial_number'] = $serial_number;
        $data['price'] = $price;


        //update order status
        $this->load->model('order_model', 'order');
        $arr = array('deposit' => ORDER_FEE, 'status' => ORDER_STATUS_THIRD);
        $ret = $this->order->update_order_arr($order_id, $arr);

        //send message
        $code = "您已成功预约【超级Home1.2】产品，非常感谢您选择我们，系统已自动分配项目经理朱兆闯 18501761049，设计师高琳琳 13611778161，稍后与您沟通，谢谢！相关动态请您持续关注公众号【超级Home智能家装】";
        $this->load->helper('sp');
        if(!$ret = spSingleMt($code, $phone)){
            log_message('error', 'send order succ message fail, phone[' . $phone . ']');
        }else{
            log_message('error', 'send order succ message succ, phone[' . $phone . ']');
        }

        $native_msg = "预约用户电话:" . $phone;
        spSingleMt($native_msg, ZC_PHONE);
		
		if(check_device()){
			$this->load->view('mobile/pay_ret', $data);
		}else{
			$this->load->view('pay_ret.php', $data);
		}
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
