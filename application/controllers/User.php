<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function login(){
        if(check_login()){
            $this->load->view('logout.php');
        }else{
            if(check_device()){
                $this->load->view('mobile/login.php');
            }else{
                $this->load->view('login.php');
            }
        }
    }

    public function sign_in(){
        if(check_login()){
            exit(json_encode(array(
                            'code' => -1,
                            'msg' => '已登录',
                            )
                        ));
        }

        if(!$phone = $this->input->post('phone')){
            exit(json_encode(array(
                            'code' => -1,
                            'msg' => '请提交手机号码',
                            )
                        ));
        }

        if(!$passwd = $this->input->post('passwd')){
            exit(json_encode(array(
                            'code' => -2,
                            'msg' => '请提交密码',
                            )
                        ));
        }

        if(!check_phone($phone)){
            exit(json_encode(array(
                            'code' => -3,
                            'msg' => '手机号码非法',
                            )
                        ));
        }

        if(check_login()){
            exit(json_encode(array(
                            'code' => -4,
                            'msg' => '已登录',
                            )
                        ));
        }

        $this->load->model('user_model', 'user');
        if($user = $this->user->get_user($phone)){
            if($user->passwd == crypt_passwd($passwd)){ 
                set_login_cookie($user->user_id);
                exit(json_encode(array(
                                'code' => 0,
                                'msg' => 'login success',
                                )
                            ));
            }else if($user->status == USER_STATUS_FIR){
                exit(json_encode(array(
                                'code' => -5,
                                'msg' => '您还没注册哦',
                                )
                            ));
            }else{
                exit(json_encode(array(
                                'code' => -6,
                                'msg' => '密码错误',
                                )
                            ));
            }
        }else{
            exit(json_encode(array(
                            'code' => -7,
                            'msg' => '用户不存在',
                            )
                        ));
        }
    }

    public function logout(){
        if($val = get_cookie(LOGIN_COOKIE_KEY)){
            delete_cookie(LOGIN_COOKIE_KEY);
        }
        /*    exit();
            exit(json_encode(array(
                            'code' => 0,
                            'msg' => 'success',
                            )
                        ));
        }else{
            exit(json_encode(array(
                            'code' => -1,
                            'msg' => 'not logged in',
                            )
                        ));
        }*/

        header('Location: ' . BASE_URL);
        exit();
    }

    public function phone_verify(){
        if(!$phone = $this->input->post('phone')){
            exit(json_encode(array(
                            'code' => -1,
                            'msg' => '请提交手机号码',
                            )
                        ));
        }

        if(!check_phone($phone)){
            exit(json_encode(array(
                            'code' => -2,
                            'msg' => '手机号码错误',
                            )
                        ));
        }

        $code = generate_code(4);
        $this->load->helper('sp');
        if(!$ret = spSingleMt($code, $phone)){
            log_message('error', 'generate code fail, code[' . $code . '], phone[' . $phone . ']');
            exit(json_encode(array(
                            'code' => -2,
                            'msg' => '发送验证码错误',
                            )
                        ));
        }

        log_message('error', 'generate code succ[' . $code . '], phone[' . $phone . ']');

        $this->load->library('session');
        unset($_SESSION['phone_verify_number']);
        $expired = $this->config->item('phone_verify_expired');
        $this->session->set_tempdata('phone_verify_number', $code, $expired);

        exit(json_encode(array(
                        'code' => 0,
                        'msg' => '发送验证码成功',
                        )
                    ));
    }

    public function signup(){
        if(check_login()){
            $this->load->view('logout.php');
        }else{
            $this->load->view('regist.php');
        }
    }

    public function regist(){
        if(!$phone = $this->input->post('phone')){
            exit(json_encode(array(
                            'code' => -1,
                            'msg' => '缺少手机号码',
                            )
                        ));
        }

        if(!$passwd = $this->input->post('passwd')){
            exit(json_encode(array(
                            'code' => -2,
                            'msg' => '需要密码',
                            )
                        ));
        }

        if(!$spasswd = $this->input->post('spasswd')){
            exit(json_encode(array(
                            'code' => -3,
                            'msg' => '需要重复密码',
                            )
                        ));
        }

        if(!$pverify_number = $this->input->post('verify_number')){
            exit(json_encode(array(
                            'code' => -4,
                            'msg' => '需要验证码',
                            )
                        ));
        }

        if(!check_phone($phone)){
            exit(json_encode(array(
                            'code' => -5,
                            'msg' => '手机号码不正确',
                            )
                        ));
        }

        if($passwd != $spasswd){
            exit(json_encode(array(
                            'code' => -6,
                            'msg' => '密码不一致',
                            )
                        ));
        }

        $this->load->library('session');
        if(!isset($_SESSION['phone_verify_number'])){
            exit(json_encode(array(
                            'code' => -7,
                            'msg' => '验证码已过期',
                            )
                        ));
        }

        if($pverify_number != $_SESSION['phone_verify_number']){
            exit(json_encode(array(
                            'code' => -8,
                            'msg' => '验证码不正确',
                            )
                        ));
        }

        unset($_SESSION['phone_verify_number']);

        if(check_login()){
            exit(json_encode(array(
                            'code' => -20,
                            'msg' => '已登录',
                            )
                        ));
        }

        $this->load->model('user_model', 'user');
        $user_id = $this->user->regist($phone, $passwd);
        if($user_id > 0){
            set_login_cookie($user_id);
            exit(json_encode(array(
                            'code' => 0,
                            'user_id' => $user_id,
                            'msg' => '注册成功',
                            )
                        ));
        }else{
            if($user_id == -10){
                exit(json_encode(array(
                                'code' => -9,
                                'msg' => '用户已存在, 您可以直接登录',
                                )
                            ));
            }else if($user_id == -3){
                exit(json_encode(array(
                                'code' => -10,
                                'msg' => '未知状态',
                                )
                            ));
            }else{
                exit(json_encode(array(
                                'code' => -11,
                                'msg' => '注册失败',
                                )
                            ));
            }
        }
    }

}
