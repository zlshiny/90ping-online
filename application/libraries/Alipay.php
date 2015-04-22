<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(ALIPAY_LIB_PATH . "alipay_submit.class.php");

class Alipay{
    protected $CI;

    //支付类型
    private $payment_type = "1";
    //服务器异步通知页面路径
    private $notify_url = BASE_URL . ":8084/pay/notify";
    //页面跳转同步通知页面路径
    private $return_url = BASE_URL . ":8084/pay/callback";
    //订单名称
    private $subject = '90平方预约';
    //订单描述
    private $body = '订单描述';
    //商品展示地址
    private $show_url = BASE_URL . ":8084/static/logo.jpg";
    //防钓鱼时间戳,若要使用请调用类文件submit中的query_timestamp函数
    private $anti_phishing_key = "";


    /*todo*/
    //1.生成反钓鱼时间戳

    
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->config->load('alipay');
    }

    public function pay($order_no){
        //客户端的IP地址
        $exter_invoke_ip = $_SERVER['REMOTE_ADDR'];

        //构造要请求的参数数组，无需改动
        $parameter = array(
                "service" => ALIPAY_SERVICE,
                "partner" => trim($this->CI->config->item('partner', 'alipay')),
                "seller_email" => trim($this->CI->config->item('seller_email', 'alipay')),
                "payment_type"	=> $this->payment_type,
                "notify_url"	=> $this->notify_url,
                "return_url"	=> $this->return_url,
                "out_trade_no"	=> $order_no,
                "subject"	=> $this->subject,
                "total_fee"	=> ORDER_DEFAULT_FEE,//预约金额
                "body"	=> $this->body,
                "show_url"	=> $this->show_url,
                "anti_phishing_key"	=> $this->anti_phishing_key,
                "exter_invoke_ip"	=> $exter_invoke_ip,
                "_input_charset"	=> trim(strtolower($this->CI->config->item('input_charset', 'alipay'))),
                );

print_r($parameter);die();
        //建立请求
        $alipay_config = $this->CI->config->item('alipay');
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        return $html_text;
    }
    
}
