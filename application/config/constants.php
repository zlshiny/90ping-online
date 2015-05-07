<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('BASE_HOST', '91haizibang');
define('BASE_URL', 'http://' . BASE_HOST . '.com');
define('PASSWD_CONS', '90PINGHULIANWANGZHINENGJIAZHUANG');

define('SP_ID', '6281');
define('SP_PASSWD', 'kidjec029');
define('SP_HOST', 'esms.etonenet.com');
define('SP_PORT', '80');
define('SP_CONTENT_PRE', '您的验证码:');

define('STATIC_PATH', '/static/');
define('JS_PATH', STATIC_PATH . 'js/');
define('CSS_PATH', STATIC_PATH . 'css/');
define('IMAGE_PATH', STATIC_PATH . 'image/');

//wechat config
define('WECHAT_TOKEN', 'kobe8tracy');//微信token
define('WECHAT_AESKEY', 'Y7Kr9DQl28wKixTBlnTxK4rrXkxjoQJ4YKwK76d1CI8');//密钥

//订单来源
define('ORDER_SOURCE_WEB', 0);
define('ORDER_SOURCE_WECHAT', 1);


//wechat test config
define('WECHAT_APPID', 'wxc501347c0242c244');
define('WECHAT_APPSECRET', 'd7f73a30dce6887399c6582b13db242a');

//最大面积
define('MAX_ACREAGE', 200);
define('MIN_ACREAGE', 40);

define('LOGIN_COOKIE_KEY', 'zjw');
define('LOGIN_EXPIRED_DEFAULT', 86400);

//预约阶段状态码
define('ORDER_STATUS_FIRST', '0');
define('ORDER_STATUS_SEC', '1');
define('ORDER_STATUS_THIRD', '2');

//年龄代码
define('AGE_85_PRE', 0);
define('AGE_85_AFTER', 1);

//用户注册阶段
define('USER_STATUS_FIR', 0);//只用手机号预约过,未使用密码注册
define('USER_STATUS_SEC', 1);//完善了密码信息
define('GENDER_MAN', 1);
define('GENDER_WOMEN', 2);

define('INIT_DEPOSIT', 1);
define('TOTAL_PRICE', 156000);

define('ALIPAY_ID', '2088911439730551');
define('ALIPAY_EMAIL', 'zhaojiangwei@90pingfang.com');
define('ALIPAY_KEY', '');
define('ALIPAY_LIB_PATH', APPPATH . 'libraries/alipay/');
define('ALIPAY_SERVICE', 'create_direct_pay_by_user');

//预约金额1块钱
define('ORDER_DEFAULT_FEE', 1);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
