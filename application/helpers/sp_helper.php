<?php

function spSingleMt($code, $phone) {
    if(!$code || !$phone) return false;

    //预定义参数，参数说明见文档
    $spid = SP_ID;
    $spsc = "00";//区分不同业务,比如主站注册是00,H5注册是01之类
    $sppassword = SP_PASSWD;
    $sa = "10";
    $da = "86{$phone}";
    $dc = "15";//8:unicode 15:gbk
    $sm = SP_CONTENT_PRE . "{$code}";
    $host = SP_HOST;
    $port = SP_PORT;

    $request = "/sms/mt";
    $request .= "?command=MT_REQUEST&spid=".$spid."&spsc=".$spsc."&sppassword=".$sppassword;
    $request .= "&sa=".$sa."&da=".$da."&dc=".$dc."&sm=";
    $request .= encodeHexStr($dc,$sm);//下发内容转换HEX编码
    $content = doGetRequest($host,$port,$request);//调用发送方法发送

    return $content;
}

function doGetRequest($host,$port,$request) {
    $httpGet  = "GET ". $request. " HTTP/1.1\r\n";
    $httpGet .= "Host: $host\r\n";
    $httpGet .= "Connection: Close\r\n";

    //  $httpGet .= "User-Agent: Mozilla/4.0(compatible;MSIE 7.0;Windows NT 5.1)\r\n";
    $httpGet .= "Content-type: text/plain\r\n";
    $httpGet .= "Content-length: " . strlen($request) . "\r\n";
    $httpGet .= "\r\n";
    $httpGet .= $request;
    $httpGet .= "\r\n\r\n";

    return httpSend($host,$port,$httpGet);
}

function encodeHexStr($dataCoding,$binStr,$encode="UTF-8"){
    //return bin2hex($binStr);
    if ($dataCoding == 15) {//GBK
        return bin2hex(mb_convert_encoding($binStr,"GBK",$encode));
    } elseif (($dataCoding & 0x0C) == 8) {//UCS-2BE
        return bin2hex(mb_convert_encoding($binStr,"UCS-2BE",$encode));
    } else {//ISO8859-1
        return bin2hex(mb_convert_encoding($binStr,"ASCII",$encode));
    }
}

function httpSend($host,$port,$request) {
    $result = "";
    $fp = @fsockopen($host, $port,$errno,$errstr,5);
    if ( $fp ) {
        fwrite($fp, $request);
        while(! feof($fp)) {
            $result .= fread($fp, 1024);
        }
        fclose($fp);
    }
    else
    {
        return "连接短信网关超时！";//超时标志
    }
    list($header, $foo)  = explode("\r\n\r\n", $result);
    list($foo, $content) = explode($header, $result);
    $content=str_replace("\r\n","",$content);
    //返回调用结果


    return $content;
}

/**
 * 相同内容群发示例
 *
 * @return String
 */
function testMultiMt() {
    //预定义参数，参数说明见文档
    $spid="1234";
    $spsc="00";
    $sppassword="1234";
    $sa="10";
    $das="8613472504787,8613472504787";
    $dc="15";
    $sm="PHP相同内容群发测试";
    $host="esms.etonenet.com";
    //发送端口，默认80.
    $port=80;
    //拼接URI
    $request = "/sms/mt";
    $request.="?command=MULTI_MT_REQUEST&spid=".$spid."&spsc=".$spsc."&sppassword=".$sppassword;
    $request.="&sa=".$sa."&das=".$das."&dc=".$dc."&sm=";
    $request.=encodeHexStr($dc,$sm);//下发内容转换HEX编码
    $content = doGetRequest($host,$port,$request);//调用发送方法发送
    return $content;
}

/**
 * 不同内容群发示例
 *
 * @return String
 */
function testMultiXMt() {
    //下发号码与内容，最多100条短信
    $dasmArray = array( '8613444455551' => '不同内容群发测试1', '8613444455552' => '不同内容群发测试2');
    
    //预定义参数，参数说明见文档
    $spid="1234";
    $spsc="00";
    $sppassword="1234";
    $sa="10";
    $dc="15";
    $host="esms.etonenet.com";
    //发送端口，默认80.
    $port=80;
    //拼接URI
    $request = "/sms/mt";
    $request.="?command=MULTIX_MT_REQUEST&spid=".$spid."&spsc=".$spsc."&sppassword=".$sppassword;
    $request.="&sa=".$sa."&dc=".$dc."&dasm=";
    $i=0;
    foreach ($dasmArray as $da=>$sm) {
        $i++;
        if($i > 100){
            break;
        }
        $sm=encodeHexStr($dc,$sm);//下发内容转换HEX编码
        $request.=$da."/".$sm.",";
    }
    $content = doPostRequest($host,$port,$request);//调用发送方法发送,只能使用POST方式
    return $content;
}
