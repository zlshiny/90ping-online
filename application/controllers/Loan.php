<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loan extends CI_Controller{

    public function index(){
        $this->load->view('loan.php');
    }

    public function apply(){
        if(!$phone = $this->input->post('phone')){
            exit(json_encode(array(
                            'code' => -1,
                            'msg' => '缺少手机号码',
                            )
                        ));
        }

        if(!$name = $this->input->post('name')){
            exit(json_encode(array(
                            'code' => -2,
                            'msg' => '需要姓名',
                            )
                        ));
        }
        $name = htmlspecialchars($name);

        if((!$gender = $this->input->post('gender')) || ($gender != 2 && $gender != 1)){
            exit(json_encode(array(
                            'code' => -3,
                            'msg' => '性别非法',
                            )
                        ));
        }

        if((!$org = $this->input->post('org')) || ($org != 3 && $org != 1 && $org != 2)){
            exit(json_encode(array(
                            'code' => -4,
                            'msg' => '单位性质非法',
                            )
                        ));
        }

        if(!$income = $this->input->post('income')){
            exit(json_encode(array(
                            'code' => -5,
                            'msg' => '需要月收入',
                            )
                        ));
        }

        if(!$loan = $this->input->post('expect')){
            exit(json_encode(array(
                            'code' => -6,
                            'msg' => '需要贷款金额',
                            )
                        ));
        }

        if(!$location = $this->input->post('location')){
            exit(json_encode(array(
                            'code' => -7,
                            'msg' => '需要房屋地址',
                            )
                        ));
        }
        $location = htmlspecialchars($location);

        if((!$acreage = $this->input->post('acreage')) || $acreage <= 10 || $acreage > 1000){
            exit(json_encode(array(
                            'code' => -8,
                            'msg' => '房屋面积非法',
                            )
                        ));
        }

        if(!check_phone($phone)){
            exit(json_encode(array(
                            'code' => -9,
                            'msg' => '手机号码不正确',
                            )
                        ));
        }

        $this->load->model('loan_model', 'loan');
        $this->load->model('order_model', 'order');
        $this->load->model('user_model', 'user');

        $req = array('phone' => $phone, 'name' => $name, 'gender' => $gender, 'org' => $org, 'income' => $income, 'expect' => $loan, 
                  'location' => $location, 'acreage' => $acreage);
        if(($ret = $this->loan->apply($req)) > 0){
            exit(json_encode(array(
                            'code' => 0,
                            'msg' => '申请成功',
                            )
                        ));
        }else{
            if($ret == -3 || $ret == -4){
                exit(json_encode(array(
                                'code' => -10,
                                'msg' => '请您先预约',
                                )
                            ));
            }else if($ret == -5){
                exit(json_encode(array(
                                'code' => -11,
                                'msg' => '您已经申请过贷款，请耐心等候客服与您联系',
                                )
                            ));
            }else{
                exit(json_encode(array(
                                'code' => -12,
                                'msg' => '申请失败',
                                )
                            ));
            }
        }
    }
}
