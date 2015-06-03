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
        $this->load->view('activity/neighbor.php');
    }

    public function detail($id){
        if($id > 0){
            $this->load->model('neighbor_model', 'neighbor');
            $data['detail'] = $this->neighbor->get_nt_detail($id);
        }
    }

    public function lists($limit = 10){
        $this->load->model('neighbor_model', 'neighbor');
        $data['list'] = $this->neighbor->get_list($limit);
    }

    public function found(){
        if(!$user_id = check_login()){
            exit(json_encode(array(
                    'code' => -1,
                    'msg' => 'login required',
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

        if(mb_strlen($slogan) > $this->config->item('max_slogan', 'neighbor')){
            exit(json_encode(array(
                    'code' => -4,
                    'msg' => 'slogan invalid',
                )
            ));
        }

        if(!$target = $this->input->post('target') || $target > $this->config->item('max_state', 'neighbor')
            || $target <= 0){
            exit(json_encode(array(
                    'code' => -5,
                    'msg' => 'target invalid',
                )
            ));
        }

        $this->load->model('user_model', 'user');
        $this->load->model('neighbor_model', 'neighbor');

        $user = $this->user->get_user_by_id($user_id);
        $arr = array('user_id' => $user_id, 'target_state' => $target, 'slogan' => $slogan, 'district' => $district, 'name' => $user->name);
        if(($id = $this->neighbor->found($arr)) > 0){
            exit(json_encode(array(
                    'code' => 0,
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
        if(!$user_id = check_login()){
            exit(json_encode(array(
                    'code' => -1,
                    'msg' => 'login required',
                )
            ));
        }

        if(!$nt_id = $this->input->post('nt_id')){
            exit(json_encode(array(
                    'code' => -2,
                    'msg' => 'nt_id required',
                )
            ));
        }

        $this->load->model('neighbor_model', 'neighbor');
        if($this->neighbor->partin($user_id, $nt_id) == 0){
            exit(json_encode(array(
                    'code' => 0,
                    'msg' => 'success',
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
