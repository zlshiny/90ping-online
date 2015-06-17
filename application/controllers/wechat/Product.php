<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    
    public function index(){
        /*$data = array();
        $this->load->view('wechat.php', $data);
        */

        if(check_device()){
            $this->load->view('h5_v2.php');
        }else{
            $data = array();
            $this->load->view('product2.php', $data);
        }
    }

    public function v2(){
        if(check_device()){
            $this->load->view('h5_v2.php');
        }else{
            $data = array();
            $this->load->view('product2.php', $data);
        }
    }

    public function kobe($id, $name = ''){
        $this->load->model('user_model', 'user');
        if(!$user = $this->user->get_wechat_user_by_id($id)){
            exit('用户非法');
        }

        
        $login_user = array();
        if($login = get_cookie('WECHAT_ACCESS')){
            $l = explode("^", $login);
            $login_user['name'] = $l[1];
            $login_user['uid'] = $l[0];
            $login_user['head_img_url'] = urldecode($l[2]);
        }else{
            if($name){
                $login_user['name'] = $name;
            }else{
                $login_user['name'] = '';
            }
            $login_user['uid'] = 0;
            $login_user['head_img_url'] = '';
        }

        $partin = $this->user->get_iphone_partin($id);
        $data['user'] = $user;
        $data['partin'] = $partin;
        $data['login_user'] = $login_user;
        //$this->load->view('activity/iphone', $data);
        $this->load->view('kobe.php', $data);
    }

    public function lebron(){
        $this->load->view('lebron.php');
    }

    public function test(){
        $this->load->view('test.php');
    }

    public function problem(){
        $this->load->view('problem.php');
    }

}
