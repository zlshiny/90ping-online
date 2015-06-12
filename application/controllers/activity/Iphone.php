<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iphone extends CI_Controller {

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
    public function index($user_id = 0){
        if($id = get_cookie('WECHAT_ACCESS')){
            $user = explode("^", $id);
            $this->user($user[0]);
        }else{
            $redirect_url = urlencode(BASE_URL . "/activity/iphone/redirect/");
            $url = WECHAT_OAUTH_URL . "?appid=" . WECHAT_APPID . "&redirect_uri=" . $redirect_url . "&response_type=code&scope=snsapi_userinfo&state=" . $user_id . "#wechat_redirect"; 
            Header("Location: $url");
        }
    }

    public function refresh_token($refresh_token){
        $url = WECHAT_API_URL."/refresh_token?appid=" . WECHAT_APPID . "&grant_type=refresh_token&refresh_token=" . $refresh_token;
        if($ret = file_get_contents($url)){
            $ret = json_decode($ret, TRUE);
            if(isset($ret['errcode'])){
                return array();
            }

            return $ret;
        }

        return array();
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
                    $user['left_money'] = $this->config->item('price', 'iphone');

                    $this->load->model('user_model', 'user');
                    if(($id = $this->user->add_wechat_user($user)) > 0){
                        $hurl = urlencode($user['head_img_url']);
                        $save = "{$id}^{$user['nickname']}^{$hurl}";
                        set_cookie("WECHAT_ACCESS", $save, 86400 * 15);
                        if($r_uid){
                            $this->user($r_uid, $user['nickname']);
                        }else{
                            $this->user($id, $user['nickname']);
                        }
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

    public function user($id, $name = ''){
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
        $this->load->view('activity/iphone', $data);
    }

    public function found(){
        if(!$id = get_cookie('WECHAT_ACCESS')){
            $this->index();
            exit();
        }else{
            $user = explode("^", $id);
            //$this->user($user[0]);
            $url = BASE_URL . "/activity/iphone/user/" . $user[0];
            Header("Location: $url");
        }
    }

    public function support($user_id){
        if(!$id = get_cookie('WECHAT_ACCESS')){
            exit(json_encode(array(
                            'code' => -1,
                            'msg' => 'access required',
                            )
                        ));
        }

        $this->load->model('user_model', 'user');
        $active = $this->user->get_wechat_user_by_id($user_id);
        if(!$active){
            exit(json_encode(array(
                    'code' => -2,
                    'msg' => 'invalid active',
                )
            ));
        }

        $supporter = explode("^", $id);
        $support_id = $supporter[0];
        $s_name = $supporter[1];
        $s_hurl = urldecode($supporter[2]);


        if($this->user->is_support_iphone($user_id, $support_id)){
            exit(json_encode(array(
                    'code' => -3,
                    'msg' => 'support already',
                )
            ));
        }

        $left = $active['left_money'];
        $total_price = $this->config->item('price', 'iphone');

        $already = $total_price - $left;
        $a_rand = 0;
        if($already > 1000){
            $a_rand = -rand(1, 100);
        }

        $l_rand = 0;
        if($left > 200){
            $p = $left > 200 ? 200 : ($left - 1);
            $l_rand = rand(1, $p);
        }

        $ret = 0;
        if($a_rand == 0){
            $ret = $l_rand;
        }else if($l_rand == 0){
            $ret = $a_rand;
        }else{
            $rand = array(0 => $a_rand, 1 => $l_rand);
            $l = rand(0, 1);
            $ret = $rand[$l];
        }
        
        $db = $left - $ret;
        if($db <= 0){
            $db = 1;
        }

        $this->user->update_wechat_iphone($user_id, $db);
        $this->user->add_wechat_iphone_partin($user_id, $support_id, $s_name, $s_hurl, $ret);
        exit(json_encode(array(
                        'code' => 0,
                        'money' => $ret,
                        'left' => $db,
                        'msg' => 'succ',
                        )
                    ));
    }

}
