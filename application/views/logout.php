<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>退出登录-90平方智能家装</title>

    <style type="text/css">
        .regist{
            height:400px;
            width:1000px;
        }

        .phone{
            margin-left:10px; 
        }

        .passwd{
            margin-left:25px; 
        }
    </style>
</head>
<body>
<div class="body">
    <div>
        <span><?php if(check_login()):?>已登录<?php else:?>未登录<?php endif;?></span>
    </div>
    <a href="/user/logout">退出</a>
</div>
</body>
</html>
