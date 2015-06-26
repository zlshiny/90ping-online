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
    public function index(){
        $this->load->view('activity/zero/index.php');
    }

    public function lauch(){
        if(!$id = get_cookie('WECHAT_ACCESS')){
            $redirect_url = urlencode(BASE_URL . "/activity/zero/redirect/");
            $url = WECHAT_OAUTH_URL . "?appid=" . WECHAT_APPID . "&redirect_uri=" . $redirect_url . "&response_type=code&scope=snsapi_userinfo#wechat_redirect"; 
            Header("Location: $url");
        }else{
            $user = explode("^", $id);
            $is_lauch = $this->zero->is_lauch($user[0]);
            $data['is_lauch'] = $is_lauch;
            if(!$is_lauch){
                $this->load->view('activity/zero/index.php');
            }else{
                $this->detail($user[0]);
            }
        }
    }

    public function support($w_uid){
        /*if(!$w_uid = $this->input->post('wid')){
            exit(json_encode(array(
                    'code' => -1,
                    'msg' => 'wechat uid required',
                )
            ));
        }

        if(!$name = $this->input->post('name')){
            exit(json_encode(array(
                    'code' => -2,
                    'msg' => 'nickname required',
                )
            ));
        }

        if(!$head_img_url = $this->input->post('head_img_url')){
            exit(json_encode(array(
                    'code' => -3,
                    'msg' => 'head_img_url required',
                )
            ));
        }*/

        if(!$id = get_cookie('WECHAT_ACCESS')){
            $redirect_url = urlencode(BASE_URL . "/activity/zero/redirect/");
            $url = WECHAT_OAUTH_URL . "?appid=" . WECHAT_APPID . "&redirect_uri=" . $redirect_url . "&response_type=code&state=" . $w_uid . "&scope=snsapi_userinfo#wechat_redirect"; 
            Header("Location: $url");
            exit();
        }

        $user = explode("^", $id);
        $cur_uid = $user[0];


        $this->load->model("zero_model", 'zero');
        $this->load->model("user_model", 'user');

        $act = $this->zero->get_instance_by_wechat_uid($w_uid);
        $data['w_uid'] = $act['wechat_uid'];
        $data['name'] = $act['nickname'];
        $data['head_img_url'] = $act['head_img_url'];
        $data['cur_uid'] = $cur_uid;

        $this->load->view('activity/zero/support.php', $data);
    }

    public function detail($w_id){
        $uid = 0;
        $is_found = 0;

        $this->load->model("zero_model", 'zero');
        $this->load->model("user_model", 'user');

        if($id = get_cookie('WECHAT_ACCESS')){
            $user = explode("^", $id);
            $uid = $user[0];
            $found = $this->zero->get_instance_by_wechat_uid($uid);

            $is_found = empty($found) ? 0 : 1;
        }

        $data['act'] = $this->zero->get_instance_by_wechat_uid($w_id);
        $data['partin'] = $this->zero->get_partin($w_id);
        $data['cur_uid'] = $uid;
        $data['me'] = $uid == $w_id ? 1 : 0;
        $data['is_found'] = $is_found;
        $data['rank'] = $this->zero->get_rank($data['act']['money']);

        $this->load->view('activity/zero/detail.php', $data);
    }

    public function tribute(){
        if(!$uid = $this->input->post('uid')){
            exit(json_encode(array(
                    'code' => -1,
                    'msg' => 'uid required',
                )
            ));
        }

        if(!($login_user = get_cookie('WECHAT_ACCESS'))){
            exit(json_encode(array(
                    'code' => -2,
                    'msg' => 'login required',
                )
            ));
        }

        $slogan = $this->input->post('say');
        
        $login_user = explode("^", $login_user);
        $login_uid = $login_user[0];
        $login_name = $login_user[1];
        $login_imgurl = urldecode($login_user[2]);

        $arr = array('founder_id' => $uid, 'supporter_id' => $login_uid, 's_name' => $login_name, 's_head_img_url' => $login_imgurl, 'slogan' => $slogan);
        $this->load->model("zero_model", 'zero');

        if($is_partin = $this->zero->is_partin($uid, $login_uid)){
            exit(json_encode(array(
                    'code' => -10,
                    'msg' => 'partin already',
                )
            ));
        }

        if(($id = $this->zero->add_partin($arr)) > 0){
            exit(json_encode(array(
                    'code' => 0,
                    'msg' => 'succ',
                    'id' => $id,
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

    public function found(){
        if(!($id = get_cookie('WECHAT_ACCESS'))){
            exit(json_encode(array(
                    'code' => -30,
                    'msg' => 'login required',
                )
            ));
        }

        $login_user = explode("^", $id);
        $wechat_uid = $login_user[0];

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

        if($is_found = $this->zero->get_instance_by_wechat_uid($wechat_uid)){
            exit(json_encode(array(
                    'code' => -11,
                    'id' => $wechat_uid,
                    'msg' => 'found already',
                )
            ));
        }

        $arr = array('name' => $name, 'decor_time' => $decor_time, 'acreage' => $acreage, 'phone' => $phone,
                    'province' => $province, 'city' => $city, 'district' => $district, 'house_type' => $state, 'wechat_uid' => $wechat_uid);
        if(($ret = $this->zero->insert_arr($arr)) > 0){
            exit(json_encode(array(
                    'code' => 0,
                    'id' => $wechat_uid,
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

    public function redirect(){
        $user = array();
        if(isset($_GET['code'])){
            $url = WECHAT_API_URL."/access_token?appid=" . WECHAT_APPID . "&secret=" . WECHAT_APPSECRET . "&code=" . $_GET['code'] . "&grant_type=authorization_code";
            if($ret = file_get_contents($url)){
                $ret = json_decode($ret, TRUE);
                if(isset($ret['errcode'])){
                    exit('errmsg:' . $ret['errmsg']);
                }

                $access = $ret;
                $user['openid'] = $ret['openid'];
                $user['access_token'] = $ret['access_token'];
                $user['refresh_token'] = $ret['refresh_token'];
                $user['expires_in'] = time() + $ret['expires_in'] - 10;

                $r_uid = 0;
                if(isset($_GET['state'])){
                    $r_uid = $_GET['state'];
                }

                $user_url = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access['access_token'] . "&openid=" . $access['openid'] . '&lang=zh_CN';
                if($ret = file_get_contents($user_url)){
                    $ret = json_decode($ret, TRUE);
                    if(isset($ret['errcode'])){
                        exit('errmsg:' . $ret['errmsg']);
                    }

                    $user['nickname'] = $ret['nickname'];
                    $user['gender'] = $ret['sex'];
                    $user['province'] = $ret['province'];
                    $user['city'] = $ret['city'];
                    $user['head_img_url'] = $ret['headimgurl'];
                    $user['source'] = 1;//来自0元装修,0:来自iphone砍价
                    //$user['left_money'] = $this->config->item('price', 'iphone');

                    $this->load->model('user_model', 'user');
                    if(($id = $this->user->add_wechat_user($user)) > 0){
                        $hurl = urlencode($user['head_img_url']);
                        $save = "{$id}^{$user['nickname']}^{$hurl}";
                        set_cookie("WECHAT_ACCESS", $save, 86400 * 15);

                        if($r_uid > 0){
                            $this->support($r_uid);
                        }else{
                            $this->load->view('activity/zero/index.php');
                        }

                        /*
                        if($r_uid){
                            $this->user($r_uid, $user['nickname']);
                        }else{
                            $this->user($id, $user['nickname']);
                        }
                        */
                    }else{
                        exit('系统错误');
                    }
                }
            }else{
                exit('非法请求');
            }
        }else{
            exit('非法请求');
        }
    }

    public function pay_succ(){
        $data['cur_id'] = $this->input->post('cur_id');
        $data['ori_id'] = $this->input->post('ori_id');

		$this->load->view('activity/zero/pay_ret.php', $data);
    }

}
