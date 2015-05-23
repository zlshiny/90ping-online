<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Individual extends CI_Controller {

    public function index(){
        if((!$order_id = $this->input->post('order_id')) || $order_id < 0){
            exit(json_encode(array(
                    'code' => -1,
                    'msg' => '订单ID不合法',
                )
            ));
        }

        if((!$user_id = $this->input->post('user_id')) || $user_id < 0){
            exit(json_encode(array(
                    'code' => -2,
                    'msg' => '用户ID不合法',
                )
            ));
        }

        if((!$serial_number = $this->input->post('serial_number')) || $serial_number < 0){
            exit(json_encode(array(
                            'code' => -3,
                            'msg' => '缺少订单序列号',
                            )
                        ));
        }

        if((!$acreage = $this->input->post('acreage')) || $acreage < MIN_ACREAGE || $acreage > MAX_ACREAGE){
            exit(json_encode(array(
                    'code' => -4,
                    'msg' => '面积不合法',
                )
            ));
        }

        $this->load->model('order_model', 'order');

        $data['list'] = $this->order->get_personal_config();
        $data['user_id'] = $user_id;
        $data['order_id'] = $order_id;
        $data['acreage'] = $acreage;
        $data['serial_number'] = $serial_number;
        $this->load->view('individual.php', $data);
    }

    public function add(){
        if((!$order_id = $this->input->post('order_id')) || $order_id < 0){
            exit(json_encode(array(
                    'code' => -1,
                    'msg' => '订单ID不合法',
                )
            ));
        }

        if((!$user_id = $this->input->post('user_id')) || $user_id < 0){
            exit(json_encode(array(
                    'code' => -2,
                    'msg' => '用户ID不合法',
                )
            ));
        }

        if((!$acreage = $this->input->post('acreage')) || $acreage < MIN_ACREAGE || $acreage > MAX_ACREAGE){
            exit(json_encode(array(
                    'code' => -3,
                    'msg' => '面积不合法',
                )
            ));
        }

        if((!$price = $this->input->post('price')) || $price <= 0){
            exit(json_encode(array(
                    'code' => -4,
                    'msg' => '价格不合法',
                )
            ));
        }

        if(!$config = $this->input->post('config')){
            $config = '';
        }else{
            $config = htmlspecialchars(trim($config));
        }

        $arr = array('price' => $price, 'personal_config' => $config, 'acreage' => $acreage);
        $this->load->model('order_model', 'order');
        $this->load->model('house_model', 'house');
        if(($ret_code = $this->order->appoint_personal($order_id, $price, $config, $acreage)) == 0){
            exit(json_encode(array(
                    'code' => 0,
                    'msg' => 'succ',
                    'order_id' => $order_id,
                    'user_id' => $user_id,
                    'price' => $price,
                )
            ));
        }else{
            if($ret_code == -2) {
                exit(json_encode(array(
                        'code' => -5,
                        'msg' => '订单不存在',
                    )
                ));
            }else{
                exit(json_encode(array(
                        'code' => -6,
                        'msg' => '更新订单失败',
                    )
                ));
            }
        }
    }

}