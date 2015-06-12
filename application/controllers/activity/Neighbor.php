<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Neighbor extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index(){
        $this->lists();
    }

    public function detail($id){
        if($id > 0){
            $this->load->model('neighbor_model', 'neighbor');
            $data['detail'] = $this->neighbor->get_nt_detail($id);

            if(check_device()) {
                $this->load->view('activity/detail.php', $data);
            }else{
                $this->load->view('activity/neighbor/detail.php', $data);
            }
        }else{
            exit('id required');
        }
    }

    public function lists($limit = 10){
        if(!$user_id = check_login()){
            $data['user_id'] = $user_id;
        }

        $this->load->model('neighbor_model', 'neighbor');
        $data['list'] = $this->neighbor->get_list($limit);
        if(check_device()){
            $this->load->view('activity/zc.php', $data);
        }else{
            $this->load->view('activity/neighbor/list.php', $data);
        }
    }

    public function apply(){
        if(check_device()) {
            $this->load->view('activity/apply');
        }else{
            $this->load->view('activity/neighbor/apply');
        }
    }

    public function join($id = 0, $name = ''){
        if($id <= 0 || !is_numeric($id)){
            exit('活动非法');
        }
        
        $data['id'] = $id;
        $data['name'] = urldecode($name);

        if(check_device()) {
            $this->load->view('activity/join', $data);
        }else{
            $this->load->view('activity/neighbor/join', $data);
        }
    }

    public function found(){
        /*
        if(!$user_id = check_login()){
            exit(json_encode(array(
                    'code' => -1,
                    'msg' => 'login required',
                )
            ));
        }
        */

        if(!$phone = $this->input->post('phone')){
            exit(json_encode(array(
                    'code' => -1,
                    'msg' => 'phone required',
                )
            ));
        }

        if(!$name = $this->input->post('name')){
            exit(json_encode(array(
                    'code' => -1,
                    'msg' => 'name required',
                )
            ));
        }

        if(!$slogan = $this->input->post('slogan')){
            exit(json_encode(array(
                    'code' => -2,
                    'msg' => 'slogan required',
                )
            ));
        }

        if(!$district = $this->input->post('district')){
            exit(json_encode(array(
                    'code' => -3,
                    'msg' => 'district required',
                )
            ));
        }

        if(!$tablet = $this->input->post('tablet')){
            exit(json_encode(array(
                    'code' => -6,
                    'msg' => 'tablet required',
                )
            ));
        }

        if(mb_strlen($slogan) > $this->config->item('max_slogan', 'neighbor')){
            exit(json_encode(array(
                    'code' => -4,
                    'msg' => 'slogan invalid',
                )
            ));
        }

        if(!($target = $this->input->post('target')) || $target > $this->config->item('max_state', 'neighbor')
            || $target <= 0){
            exit(json_encode(array(
                    'code' => -5,
                    'msg' => 'target invalid',
                )
            ));
        }

        $this->load->model('user_model', 'user');
        $this->load->model('order_model', 'order');
        $this->load->model('neighbor_model', 'neighbor');


        $is_order = false;
        if($user_id = check_login()){
            $is_order = $this->order->is_order_by_uid($user_id);
            $arr = array('user_id' => $user_id, 'phone' => $phone, 'target_state' => $target, 'slogan' => $slogan, 'district' => $district, 'uname' => $name);
        }else{
            $user_id = 0;
            $is_order = $this->order->is_order_by_phone($phone);
            $arr = array('phone' => $phone, 'target_state' => $target, 'slogan' => $slogan, 'district' => $district, 'uname' => $name);
        }

        if(!$is_order){
            exit(json_encode(array(
                            'code' => -20,
                            'msg' => 'not ordered',
                            )
                        ));
        }

        $arr['tablet'] = $tablet;
        if(($id = $this->neighbor->found($arr)) > 0){
            exit(json_encode(array(
                            'code' => 0,
                            'id' => $id,
                            'msg' => 'found success',
                            )
                        ));
        }else{
            exit(json_encode(array(
                            'code' => -10,
                            'msg' => 'found failed',
                            )
                        ));
        }
    }

    public function partin(){
        /*if(!$user_id = check_login()){
            exit(json_encode(array(
                    'code' => -1,
                    'msg' => 'login required',
                )
            ));
        }*/

        if(!$nt_id = $this->input->post('nt_id')){
            exit(json_encode(array(
                            'code' => -2,
                            'msg' => 'nt_id required',
                            )
                        ));
        }

        if(!$phone = $this->input->post('phone')){
            exit(json_encode(array(
                            'code' => -1,
                            'msg' => 'phone required',
                            )
                        ));
        }

        if(!$name = $this->input->post('name')){
            exit(json_encode(array(
                    'code' => -1,
                    'msg' => 'name required',
                )
            ));
        }

        if(!$tablet = $this->input->post('tablet')){
            exit(json_encode(array(
                    'code' => -6,
                    'msg' => 'tablet required',
                )
            ));
        }

        $is_order = false;
        $this->load->model('order_model', 'order');
        $this->load->model('user_model', 'user');
        $this->load->model('neighbor_model', 'neighbor');
        if($user_id = check_login()){
            $is_order = $this->order->is_order_by_uid($user_id);
            $arr = array('user_id' => $user_id, 'phone' => $phone, 'uname' => $name);
        }else{
            $user_id = 0;
            $is_order = $this->order->is_order_by_phone($phone);
            $arr = array('phone' => $phone, 'uname' => $name);
        }

        if(!$is_order){
            exit(json_encode(array(
                            'code' => -20,
                            'msg' => 'not ordered',
                            )
                        ));
        }

        $this->load->model('neighbor_model', 'neighbor');
        if($user_id){
            if($this->neighbor->is_partin_by_uid($user_id)){
                exit(json_encode(array(
                                'code' => -21,
                                'msg' => 'partin already',
                                )
                            ));
            }
        }else{
            if($this->neighbor->is_partin_by_phone($phone)){
                exit(json_encode(array(
                                'code' => -21,
                                'msg' => 'partin already',
                                )
                            ));
            }
        }

        if(($ret = $this->neighbor->partin($user_id, $nt_id, $name, $phone, $tablet)) == 0){
            exit(json_encode(array(
                            'code' => 0,
                            'id' => $nt_id,
                            'msg' => 'success',
                            )
                        ));
        }else if($ret == -2){
            exit(json_encode(array(
                            'code' => -11,
                            'msg' => 'not exists',
                            )
                        ));
        }else if($ret == -3){
            exit(json_encode(array(
                            'code' => -12,
                            'msg' => 'fulled',
                            )
                        ));
        }else{
            exit(json_encode(array(
                            'code' => -10,
                            'msg' => 'fail',
                            )
                        ));
        }
    }

}
