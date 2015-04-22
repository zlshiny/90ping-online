<?php

function build_order_no(){
    $year_code = array('a','b','c','d','e','f','g','h','i','j');
    $order_sn = (intval(date('Y'))- 2014) . strtoupper(dechex(date('m'))) . strtoupper(dechex(date('d'))).
        substr(time(),-5).substr(microtime(),2,5).sprintf('%d',rand(0,99));

    return $order_sn;
}

$num = 0;
while($num < 20){
    echo @build_order_no() . "\r\n";
    $num ++;
}
