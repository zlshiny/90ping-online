<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zero extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->view('activity/zero/index.php');
    }

    public function detail($id){
        $this->load->view('activity/zero/detail.php');
    }

    public function found(){
        if(!$phone = $this->input->post('phone')){
            exit(json_encode(array(
                    'code' => -1,
                    'msg' => '缺少手机号码',
                )
            ));
        }

        if(!check_phone($phone)){
            exit(json_encode(array(
                    'code' => -2,
                    'msg' => '手机号码不合法',
                )
            ));
        }

        if(!$name = $this->input->post('name')){
            exit(json_encode(array(
                    'code' => -3,
                    'msg' => '姓名不合法',
                )
            ));
        }

        if(!($acreage = $this->input->post('acreage')) || $acreage < MIN_ACREAGE || $acreage > 500){
            exit(json_encode(array(
                    'code' => -4,
                    'msg' => '面积不合法',
                )
            ));
        }

        if(!$district = $this->input->post('district')){
            exit(json_encode(array(
                    'code' => -5,
                    'msg' => '小区名不合法',
                )
            ));
        }

        $cur_year = intval(date('Y'));
        if(!($year = $this->input->post('year')) || intval($year) < $cur_year || intval($year) > 2017){
            exit(json_encode(array(
                    'code' => -6,
                    'msg' => '装修年份不合法',
                )
            ));
        }

        $cur_month = intval(date('m'));
        if(!($month = $this->input->post('month')) || $month < $cur_month || $month > 12){
            exit(json_encode(array(
                    'code' => -7,
                    'msg' => '装修月份不合法',
                )
            ));
        }
        $decor_time = $year . '-' . $month . '-' . date('d') . ' ' . date('H:i:s');

        if(!($state = $this->input->post('state')) || ($state != 1 && $state != 2)){
            exit(json_encode(array(
                    'code' => -8,
                    'msg' => '房子状态不合法',
                )
            ));
        }

        if(!($province = $this->input->post('province'))){
            exit(json_encode(array(
                    'code' => -9,
                    'msg' => '城市不合法',
                )
            ));
        }

        if(!($city = $this->input->post('city'))){
            exit(json_encode(array(
                    'code' => -10,
                    'msg' => '城区不合法',
                )
            ));
        }

        $this->load->model("zero_model", 'zero');
        $this->load->model("user_model", 'user');
        $arr = array('name' => $name, 'decor_time' => $decor_time, 'acreage' => $acreage, 'phone' => $phone,
                    'province' => $province, 'city' => $city, 'district' => $district, 'house_type' => $state);
        if(($ret = $this->zero->insert_arr($arr)) > 0){
            exit(json_encode(array(
                    'code' => 0,
                    'id' => $ret,
                    'name' => $name,
                    'msg' => 'succ',
                )
            ));
        }else{
            exit(json_encode(array(
                    'code' => -20,
                    'msg' => 'fail',
                )
            ));
        }
    }

}