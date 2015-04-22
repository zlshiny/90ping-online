<?php
/* *
 * 支付宝配置文件
 */
 
//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
//合作身份者id，以2088开头的16位纯数字
$config['alipay']['partner']		= ALIPAY_ID;

//收款支付宝账号
$config['alipay']['seller_email']	= ALIPAY_EMAIL;

//安全检验码，以数字和字母组成的32位字符
$config['alipay']['key']			= ALIPAY_KEY;

//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑



//签名方式 不需修改
$config['alipay']['sign_type']    = strtoupper('MD5');

//字符编码格式 目前支持 gbk 或 utf-8
$config['alipay']['input_charset']= strtolower('utf-8');

//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
$config['alipay']['cacert']    = ALIPAY_LIB_PATH . 'cacert.pem';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$config['alipay']['transport']    = 'http';

?>
