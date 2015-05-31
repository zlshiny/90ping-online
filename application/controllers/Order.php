<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function test(){
        $this->load->view('test.php');
    }

    //加载预约第一步(验证手机)
    public function index(){
        if(check_device()){
            $this->load->view('mobile/appoint.php');
        }else{
            $this->load->view('appoint.php');
        }
    }

    //加载预约第二步(完善订单信息)
    public function improve(){
        $order_id = $this->input->post('order_id');
        $user_id = $this->input->post('user_id');
        $serial_number = $this->input->post('serial_number');
        if(!$order_id || $order_id < 0 || !$user_id || $user_id < 0 || $serial_number <= 0){
            exit("订单不存在"); 
        }

        $data['order_id'] = $order_id;
        $data['user_id'] = $user_id;
        $data['cur_mon'] = @date('n');
        $data['serial_number'] = $serial_number;

        if(check_device()){
            $this->load->view('mobile/choose.php', $data);
        }else{
            $this->load->view('choose.php', $data);
        }
    }

    public function detail($order_id){
        if(!$user_id = check_login()){
            if(check_device()){
                $this->load->view('mobile/login.php');
            }else {
                $this->load->view('login.php');
            }
        }else{
            if(!$order_id || $order_id < 0){
                exit("订单不存在"); 
            }

            $this->load->model('order_model', 'order');
            if($order = $this->order->get_order_detail($order_id)){
                $data['order'] = $order;
                $data['user_id'] = $user_id;
                $data['order'] = $order;
                if(check_device()){
                    $this->load->view('mobile/order_detail', $data);
                }else{
                    $this->load->view('order_detail', $data);
                }
            }else{
                exit("订单不存在");
            }
        }
    }

    public function myorder(){
        if(!$user_id = check_login()){
            if(check_device()){
                $this->load->view('mobile/login.php');
            }else{
                $this->load->view('login.php');
            }
        }else{
            $data = array();
            $data['user_id'] = $user_id;
            $data['list'] = array();
            $this->load->model('order_model', 'order');
            if($list = $this->order->get_my_order($user_id)){
                $data['list'] = $list;
            }

            if(check_device()){
                $this->load->view('mobile/order_list', $data);
            }else{
                $this->load->view('order_list', $data);
            }
        }
    }

    /*执行预约第二步,完善预约信息*/
    public function appointsec(){
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

//        $age = $this->input->post('age');
//        if(!isset($_POST['age']) || ($age != 2 && $age != 1)){
//            exit(json_encode(array(
//                            'code' => -3,
//                            'msg' => '非法年龄',
//                            )
//                        ));
//        }

        $serial_number = $this->input->post('serial_number');
        if(!isset($_POST['serial_number']) || $serial_number <= 0){
            exit(json_encode(array(
                            'code' => -3,
                            'msg' => '非法序列号',
                            )
                        ));
        }

        $decor_date = $this->input->post('decor_date');
        $cur_month = @date('n');
        if(!$decor_date || intval($decor_date) < $cur_month || intval($decor_date) > 12){
            exit(json_encode(array(
                            'code' => -4,
                            'msg' => '日期不合法',
                            )
                        ));
        }
        $decor_date = intval($decor_date);

        if((!$acreage = $this->input->post('acreage')) || $acreage < MIN_ACREAGE || $acreage > MAX_ACREAGE){
            exit(json_encode(array(
                            'code' => -5,
                            'msg' => '面积非法',
                            )
                        ));
        }

        if((!$city = $this->input->post('city')) || $city != $this->config->item('北京市', 'city')){
            exit(json_encode(array(
                    'code' => -6,
                    'msg' => '当前只开放北京预约，请您耐心等候',
                )
            ));
        }

        if((!$name = $this->input->post('name')) || empty($name)){
            exit(json_encode(array(
                    'code' => -7,
                    'msg' => 'name required',
                )
            ));
        }
        $name = htmlspecialchars(trim($name));

        if((!$xiaoqu = $this->input->post('xiaoqu')) || empty($xiaoqu)){
            exit(json_encode(array(
                    'code' => -8,
                    'msg' => 'xiaoqu required',
                )
            ));
        }
        $xiaoqu = htmlspecialchars(trim($xiaoqu));

        $price = BASE_PRICE + ($acreage - BASE_ACREAGE) * PRICE_PER_ACR;

        $order = array('order_id' => $order_id, 'user_id' => $user_id, 'decor_date' => $decor_date,
            'acreage' => $acreage, 'status' => ORDER_STATUS_SEC, 'price' => $price, 'city' => $city, 'name' => $name,
            'xiaoqu' => $xiaoqu);
        $this->load->model('order_model', 'order');
        $this->load->model('user_model', 'user');
        $this->load->model('house_model', 'house');
        if(($ret = $this->order->appointsec($order)) == 0){
            exit(json_encode(array(
                            'code' => 0,
                            'user_id' => $user_id,
                            'order_id' => $order_id,
                            'serial_number' => $serial_number,
                            'price' => $price,
                            'msg' => '提交成功',
                            )
                        ));
        }else{
            if($ret == -3){
                exit(json_encode(array(
                                'code' => -6,
                                'msg' => '已完善过信息',
                                )
                            ));
            }else if($ret == -4){
                exit(json_encode(array(
                                'code' => -7,
                                'msg' => '已完成支付',
                                )
                            ));
            }else{
                exit(json_encode(array(
                                'code' => -8,
                                'msg' => '提交错误',
                                )
                            ));
            }
        }
    }

    /*h5预约*/
    public function appoint_wechat(){
        if(!$phone = $this->input->post('phone')){
            exit(json_encode(array(
                    'code' => -1,
                    'msg' => '缺少手机号码',
                )
            ));
        }

        if(!$pverify_number = $this->input->post('phone_verify_number')){
            exit(json_encode(array(
                    'code' => -2,
                    'msg' => '缺少验证码',
                )
            ));
        }

        if(!check_phone($phone)){
            exit(json_encode(array(
                    'code' => -3,
                    'msg' => '手机号码不合法',
                )
            ));
        }

        $source = ORDER_SOURCE_WEB;
        if(isset($_POST['source'])){
            $source = $this->input->post('source');
        }

        if(!$name = $this->input->post('name')){
            exit(json_encode(array(
                    'code' => -11,
                    'msg' => '姓名不合法',
                )
            ));
        }

        if(!$gender = $this->input->post('gender') || $gender != GENDER_MAN || $gender != GENDER_WOMEN){
            exit(json_encode(array(
                    'code' => -12,
                    'msg' => '性别不合法',
                )
            ));
        }

        if(!$year = $this->input->post('year') || $year > 2010 || $year < 1960){
            exit(json_encode(array(
                    'code' => -13,
                    'msg' => '年龄不合法',
                )
            ));
        }
        $age = intval(date('Y')) - $year;

        if(!$acreage = $this->input->post('acreage') || $acreage < MIN_ACREAGE || $acreage > MAX_ACREAGE){
            exit(json_encode(array(
                    'code' => -14,
                    'msg' => '面积不合法',
                )
            ));
        }

        if(!$location = $this->input->post('location')){
            exit(json_encode(array(
                    'code' => -15,
                    'msg' => '地址不合法',
                )
            ));
        }

        if(!$decor_time = $this->input->post('decor_time') || intval($decor_time) <= 0 || intval($decor_time) > 12){
            exit(json_encode(array(
                    'code' => -16,
                    'msg' => '装修时间不合法',
                )
            ));
        }
        $decor_time = date('Y') . '-' . $decor_time . '-' . date('d') . ' ' . date('H:i:s');


        $this->load->library('session');
        if(!isset($_SESSION['phone_verify_number'])){
            exit(json_encode(array(
                    'code' => -4,
                    'msg' => '验证码已过期',
                )
            ));
        }

        if($pverify_number != $_SESSION['phone_verify_number']){
            exit(json_encode(array(
                    'code' => -5,
                    'msg' => '验证码不正确',
                )
            ));
        }

        unset($_SESSION['phone_verify_number']);
        $this->load->model("user_model", 'user');
        $this->load->model('order_model', 'order');
        $product_id = 1;

        if($ret = $this->order->appointment_wechat($name, $phone, $gender, $age, $acreage, $location,
            $decor_time, $product_id, $source)){
            exit(json_encode(array(
                    'code' => 0,
                    'order_id' => $ret['order_id'],
                    'user_id' => $ret['user_id'],
                    'serial_number' => $ret['serial_number'],
                    'msg' => '预约成功',
                )
            ));
        }else{
            exit(json_encode(array(
                    'code' => -6,
                    'msg' => '预约失败',
                )
            ));
        }
    }

    /*执行预约第一步*/
    public function appointment(){
        if(!$phone = $this->input->post('phone')){
            exit(json_encode(array(
                            'code' => -1,
                            'msg' => '缺少手机号码',
                            )
                        ));
        }

        if(!$pverify_number = $this->input->post('phone_verify_number')){
            exit(json_encode(array(
                            'code' => -2,
                            'msg' => '缺少验证码',
                            )
                        ));
        }

        if(!check_phone($phone)){
            exit(json_encode(array(
                            'code' => -3,
                            'msg' => '手机号码不合法',
                            )
                        ));
        }

        $source = ORDER_SOURCE_WEB;
        if(isset($_POST['source'])){
            $source = $this->input->post('source');
        }


        $this->load->library('session');
        if(!isset($_SESSION['phone_verify_number'])){
            exit(json_encode(array(
                            'code' => -4,
                            'msg' => '验证码已过期',
                            )
                        ));
        }

        if($pverify_number != $_SESSION['phone_verify_number']){
            exit(json_encode(array(
                            'code' => -5,
                            'msg' => '验证码不正确',
                            )
                        ));
        }

        unset($_SESSION['phone_verify_number']);
        $this->load->model("user_model", 'user');
        $this->load->model('order_model', 'order');
        $product_id = 1;
        if($ret = $this->order->appointment($phone, $product_id, $source)){
            exit(json_encode(array(
                            'code' => 0,
                            'order_id' => $ret['order_id'],
                            'user_id' => $ret['user_id'],
                            'serial_number' => $ret['serial_number'],
                            'msg' => '预约成功',
                            )
                        ));
        }else{
            exit(json_encode(array(
                            'code' => -6,
                            'msg' => '预约失败',
                            )
                        ));
        }
    }
    
}

?>
