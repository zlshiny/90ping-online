<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(WEPAY_ROOT_PATH . "/lib/log_.php");
include_once(WEPAY_ROOT_PATH . "/WxPayPubHelper/WxPayPubHelper.php");
class Pay extends CI_Controller {
public function kobe(){
    $this->load->view('wepay');
}
    public function check_succ($order_id = 0){
        if($order_id == 0){
            exit(json_encode(array(
                            'code' => -1,
                            'msg' => 'fail',
                            )
                        ));
        }

        $this->load->model('order_model', 'order');
        $order = $this->order->get_order($order_id);
        if($order && $order->status == ORDER_STATUS_THIRD){
            exit(json_encode(array(
                            'code' => 0,
                            'msg' => 'succ',
                            )
                        ));
        }else{
            exit(json_encode(array(
                            'code' => -2,
                            'msg' => 'fail',
                            )
                        ));
        }
    }

    public function index(){
        /**
         * JS_API支付
         * ====================================================
         * 在微信浏览器里面打开H5网页中执行JS调起支付。接口输入输出数据格式为JSON。
         * 成功调起支付需要三个步骤：
         * 步骤1：网页授权获取用户openid
         * 步骤2：使用统一支付接口，获取prepay_id
         * 步骤3：使用jsapi调起支付
         */

        /*if(!$xml = file_get_contents("php://input")){
            exit('post data required');
        }*/

        if(isset($_GET['rcode'])){
            $request_data = array();
            $tmp = explode('-', $_GET['rcode']);
            foreach($tmp as $fv){
                $t = explode('|', $fv);
                $request_data[$t[0]] = $t[1];
            }

            if(!$out_trade_no = $request_data['serial_number']){
                exit('serial_number required:' . $out_trade_no);
            }

            if(!($user_id = $request_data['user_id'])){
                exit('user_id required');
            }

            if(!($order_id = $request_data['order_id'])){
                exit('order_id required');
            }

            if(!$phone = $request_data['phone']){
                exit('phone required');
            }
        }else{
            if(!$out_trade_no = $this->input->post('serial_number')){
                exit('serial_number required:' . $out_trade_no);
            }

            if(!$user_id = $this->input->post('user_id')){
                exit('user_id required');
            }

            if(!$order_id = $this->input->post('order_id')){
                exit('order_id required');
            }

            if(!$phone = $this->input->post('phone')){
                exit('phone required');
            }
        }

        //使用jsapi接口
        $jsApi = new JsApi_pub();

        //=========步骤1：网页授权获取用户openid============
        //通过code获得openid
        if (!isset($_GET['code']))
        {
            //触发微信返回code码
            $params_format = "order_id|{$order_id}-user_id|{$user_id}-serial_number|{$out_trade_no}-phone|{$phone}";
            $suffix = "rcode={$params_format}";
            $url = $jsApi->createOauthUrlForCode(WxPayConf_pub::JS_API_CALL_URL . '?' . $suffix);
            Header("Location: $url");
        }else
        {
            //获取code码，以获取openid
            $code = $_GET['code'];
            $jsApi->setCode($code);
            $openid = $jsApi->getOpenId();
        }

        //=========步骤2：使用统一支付接口，获取prepay_id============
        //使用统一支付接口
        $unifiedOrder = new UnifiedOrder_pub();

        //设置统一支付接口参数
        //设置必填参数
        //appid已填,商户无需重复填写
        //mch_id已填,商户无需重复填写
        //noncestr已填,商户无需重复填写
        //spbill_create_ip已填,商户无需重复填写
        //sign已填,商户无需重复填写
        $unifiedOrder->setParameter("openid","$openid");//商品描述
        $unifiedOrder->setParameter("body","超级Home");//商品描述
        //自定义订单号，此处仅作举例
        $timeStamp = time();

        /*if(!$out_trade_no = $this->input->post('serial_number')){
            exit('<div style="font-size:44px;margin-top:200px;text-align:center;">缺少订单号</div>');
        }*/
        $unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
        $unifiedOrder->setParameter("total_fee", ORDER_FEE);//总金额
        $unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址
        $unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
        //非必填参数，商户可根据实际情况选填
        //$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号
        //$unifiedOrder->setParameter("device_info","XXXX");//设备号 
        //$unifiedOrder->setParameter("attach","XXXX");//附加数据
        //$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
        //$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间
        //$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记
        //$unifiedOrder->setParameter("openid","XXXX");//用户标识
        //$unifiedOrder->setParameter("product_id","XXXX");//商品ID

        $prepay_id = $unifiedOrder->getPrepayId();
        //=========步骤3：使用jsapi调起支付============
        $jsApi->setPrepayId($prepay_id);

        $data['jsApiParameters'] = $jsApi->getParameters();
        $data['order_id'] = $order_id;
        $data['user_id'] = $user_id;
        $data['serial_number'] = $out_trade_no;
        $data['phone'] = $phone;

        $this->load->view('wepay', $data);
    }

    public function scan(){
        if(!$out_trade_no = $this->input->post('serial_number')){
            exit('out_trade_no required');
        }

        if(!$order_id = $this->input->post('order_id')){
            exit('order id required');
        }

        if(!$user_id = $this->input->post('user_id')){
            exit('user id required');
        }

        if(!$phone = $this->input->post('phone')){
            exit('phone required');
        }

        //使用统一支付接口
        $unifiedOrder = new UnifiedOrder_pub();

        //设置统一支付接口参数
        //设置必填参数
        //appid已填,商户无需重复填写
        //mch_id已填,商户无需重复填写
        //noncestr已填,商户无需重复填写
        //spbill_create_ip已填,商户无需重复填写
        //sign已填,商户无需重复填写
        $unifiedOrder->setParameter("body","超级Home");//商品描述
        //自定义订单号，此处仅作举例
        $timeStamp = time();
        $unifiedOrder->setParameter("out_trade_no","$out_trade_no" . "a" . "$order_id");//商户订单号 
        $unifiedOrder->setParameter("total_fee", ORDER_FEE);//总金额
        $unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址 
        $unifiedOrder->setParameter("trade_type","NATIVE");//交易类型

        //非必填参数，商户可根据实际情况选填
        //$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号  
        //$unifiedOrder->setParameter("device_info","XXXX");//设备号 
        //$unifiedOrder->setParameter("order_id","{$out_trade_no}");//附加数据 
        //$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
        //$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间 
        //$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
        //$unifiedOrder->setParameter("openid","XXXX");//用户标识
        //$unifiedOrder->setParameter("product_id","XXXX");//商品ID

        //获取统一支付接口结果
        $unifiedOrderResult = $unifiedOrder->getResult();

        //商户根据实际情况设置相应的处理流程
        if ($unifiedOrderResult["return_code"] == "FAIL") 
        {
            //商户自行增加处理流程
            echo "通信出错：".$unifiedOrderResult['return_msg']."<br>";
        }
        elseif($unifiedOrderResult["result_code"] == "FAIL")
        {
            //商户自行增加处理流程
            echo "错误代码：".$unifiedOrderResult['err_code']."<br>";
            echo "错误代码描述：".$unifiedOrderResult['err_code_des']."<br>";
        }
        elseif($unifiedOrderResult["code_url"] != NULL)
        {
            //从统一支付接口获取到code_url
            $code_url = $unifiedOrderResult["code_url"];
            //商户自行增加处理流程
            //......

            $data['out_trade_no'] = $out_trade_no;
            $data['order_id'] = $order_id;
            $data['user_id'] = $user_id;
            $data['unifiedOrderResult'] = $unifiedOrderResult;
            $data['code_url'] = $code_url;
            $data['phone'] = $phone;
            $this->load->view('pay_wechat', $data);
        }
    }

    public function notify(){
        //使用通用通知接口
        $notify = new Notify_pub();

        //存储微信的回调
        //$xml = $GLOBALS['HTTP_RAW_POST_DATA'];	
        $xml = file_get_contents("php://input");
        $notify->saveData($xml);

        //验证签名，并回应微信。
        //对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
        //微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
        //尽可能提高通知的成功率，但微信不保证通知最终能成功。
        if($notify->checkSign() == FALSE){
            $notify->setReturnParameter("return_code","FAIL");//返回状态码
            $notify->setReturnParameter("return_msg","签名失败");//返回信息
        }else{
            $notify->setReturnParameter("return_code","SUCCESS");//设置返回码
        }
        $returnXml = $notify->returnXml();
        echo $returnXml;

        //==商户根据实际情况设置相应的处理流程，此处仅作举例=======

        //以log文件形式记录回调信息
        $log_ = new Log_();
        $log_name= $this->config->item('log_path') . "wechat_notify.log";//log文件路径
        $log_->log_result($log_name,"【接收到的notify通知】:\n".$xml."\n");

        if($notify->checkSign() == TRUE)
        {
            if ($notify->data["return_code"] == "FAIL") {
                //此处应该更新一下订单状态，商户自行增删操作
                $log_->log_result($log_name,"【通信出错】:\n".$xml."\n");
            }
            elseif($notify->data["result_code"] == "FAIL"){
                //此处应该更新一下订单状态，商户自行增删操作
                $log_->log_result($log_name,"【业务出错】:\n".$xml."\n");
            }
            else{
                //此处应该更新一下订单状态，商户自行增删操作
            }

            //商户自行增加处理流程,
            //例如：更新订单状态
            //例如：数据库操作
            //例如：推送支付完成信息
            if(!isset($notify->data["out_trade_no"])){
                $log_->log_result($log_name,"【order_id required】:\n");
                exit('order id required');
            }

            $this->load->model('order_model', 'order');
            $order_id = explode("a", $notify->data['out_trade_no'])[1];
            $arr = array('deposit' => ORDER_FEE, 'status' => ORDER_STATUS_THIRD);
            $log_->log_result($log_name, "order_id:" . $order_id);
            $ret = $this->order->update_order_arr($order_id, $arr);
            if(!$ret){
                $log_->log_result($log_name,"update order status fail:ret:" . $ret . "\n");
            }else{
                $log_->log_result($log_name,"update order status succ\n");
            }
        }else{
            $log_->log_result($log_name,"checkSign fail\n");
        }
    }
}
