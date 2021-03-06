<?php
include('header.php');
?>
<link href="<?=CSS_PATH . 'main.css';?>" rel="stylesheet" type="text/css" />

<link href="/static/css/individual.css" rel="stylesheet" type="text/css" />
<div>
    <input type="hidden" id="min_acreage" value="<?=MIN_ACREAGE;?>"/>
    <input type="hidden" id="max_acreage" value="<?=MAX_ACREAGE;?>"/>
    <input type="hidden" id="order_id" value="<?=$order_id;?>"/>
    <input type="hidden" id="user_id" value="<?=$user_id;?>"/>
    <input type="hidden" id="serial_number" value="<?=$serial_number;?>"/>
</div>
<div class="individ_page">
    <div class="individ_nag">
        <div class="individ_wrap">
            <ul>
                <li class="individ_btn_hover individ_btn1" data-id="1">客厅</li>
                <li class="individ_btn2" data-id="2">主卧</li>
                <li class="individ_btn3" data-id="3">次卧</li>
                <li class="individ_btn4" data-id="4">卫生间</li>
                <li class="individ_btn5" data-id="5">餐厅</li>
                <li class="individ_btn6" data-id="6">厨房</li>
                <li style="margin-right:0px;" class="individ_btn7" data-id="7">阳台</li>
            </ul>
        </div>
    </div>
    <div class="individ_content">
        <div class="individ_real_content">
            <div class="individ_left">
                <div class="individ_left_top">
                    <span class="individ_left_top_font">标准配置</span>
                </div>
                <div class="individ_left_mid">
                    <div class="individ_left_mid_left">
                        <span class="standard_nav_char">硬装</span>
                    </div>
                    <div class="individ_left_mid_right individ_left_mid_right_1">
                        <ul class="individ_config_list">
                            <li>西门子开关插座<span class="individ_config_list_1">12</span></li>
                            <li>超级Home筒灯<span class="individ_config_list_1">12</span></li>
                            <li>超级Home灯带<span class="individ_config_list_1">12</span></li>
                            <li>马可波罗地砖<span class="individ_config_list_2">不限</span></li>
                            <li>大自然踢脚线<span class="individ_config_list_2">不限</span></li>
                        </ul>
                        <ul class="individ_config_list individ_config_list_right">
                            <li>欧雅壁纸<span class="individ_config_list_2">不限</span></li>
                            <li>石膏板圈顶<span class="individ_config_list_2">不限</span></li>
                            <li>多乐士乳胶漆<span class="individ_config_list_2">不限</span></li>
                            <li>石英石窗台板<span class="individ_config_list_2">不限</span></li>
                        </ul>
                    </div>
                    <div class="individ_left_mid_right individ_left_mid_right_2">
                        <ul class="individ_config_list">
                            <li>西门子开关插座<span class="individ_config_list_1">10</span></li>
                            <li>TATA木门<span class="individ_config_list_1">1</span></li>
                            <li>马可波罗地砖<span class="individ_config_list_2">不限</span></li>
                            <li>多乐士乳胶漆<span class="individ_config_list_2">不限</span></li>
                        </ul>
                        <ul class="individ_config_list individ_config_list_right">
                            <li>大自然踢脚线<span class="individ_config_list_2">不限</span></li>
                            <li>石英石窗台板<span class="individ_config_list_2">不限</span></li>
                            <li>石膏线<span class="individ_config_list_2">不限</span></li>
                            <li>欧雅壁纸<span class="individ_config_list_2">不限</span></li>
                        </ul>
                    </div>
                    <div class="individ_left_mid_right individ_left_mid_right_3">
                        <ul class="individ_config_list">
                            <li>TATA木门<span class="individ_config_list_1">1</span></li>
                            <li>西门子开关插座<span class="individ_config_list_1">8</span></li>
                            <li>马可波罗地砖<span class="individ_config_list_2">不限</span></li>
                            <li>多乐士乳胶漆<span class="individ_config_list_2">不限</span></li>
                        </ul>
                        <ul class="individ_config_list individ_config_list_right">
                            <li>石英石窗台板<span class="individ_config_list_2">不限</span></li>
                            <li>石膏线<span class="individ_config_list_2">不限</span></li>
                            <li>大自然踢脚线<span class="individ_config_list_2">不限</span></li>
                            <li>欧雅壁纸<span class="individ_config_list_2">不限</span></li>
                        </ul>
                    </div>
                    <div class="individ_left_mid_right individ_left_mid_right_4">
                        <ul class="individ_config_list">
                            <li>科勒水龙头<span class="individ_config_list_1">1</span></li>
                            <li>科勒五级旋风马桶<span class="individ_config_list_1">1</span></li>
                            <li>TATA木门<span class="individ_config_list_1">1</span></li>
                            <li>科勒脸盆<span class="individ_config_list_1">1</span></li>
                            <li>马可波罗墙地砖<span class="individ_config_list_2">不限</span></li>
                        </ul>
                        <ul class="individ_config_list individ_config_list_right">
                            <li>科勒花洒<span class="individ_config_list_1">1</span></li>
                            <li>方太浴室柜<span class="individ_config_list_1">1</span></li>
                            <li>西门子USB插口开关<span class="individ_config_list_1">5</span></li>
                            <li>潜水艇地漏<span class="individ_config_list_1">1</span></li>
                            <li>友邦吊顶<span class="individ_config_list_2">不限</span></li>
                        </ul>
                    </div>
                    <div class="individ_left_mid_right individ_left_mid_right_5">
                        <ul class="individ_config_list">
                            <li>西门子开关插座<span class="individ_config_list_1">4</span></li>
                            <li>超级Home筒灯<span class="individ_config_list_1">8</span></li>
                            <li>超级Home灯带<span class="individ_config_list_1">9米</span></li>
                            <li>马可波罗地砖<span class="individ_config_list_2">不限</span></li>
                        </ul>
                        <ul class="individ_config_list individ_config_list_right">
                            <li>大自然踢脚线<span class="individ_config_list_2">不限</span></li>
                            <li>石膏板圈顶<span class="individ_config_list_2">不限</span></li>
                            <li>多乐士乳胶漆<span class="individ_config_list_2">不限</span></li>
                        </ul>
                    </div>
                    <div class="individ_left_mid_right individ_left_mid_right_6">
                        <ul class="individ_config_list">
                            <li>科勒水龙头<span class="individ_config_list_1">1</span></li>
                            <li>方太油烟机<span class="individ_config_list_1">1</span></li>
                            <li>方太燃气灶<span class="individ_config_list_1">1</span></li>
                            <li>潜水艇地漏<span class="individ_config_list_1">1</span></li>
                            <li>友邦吊顶<span class="individ_config_list_2">不限</span></li>
                        </ul>
                        <ul class="individ_config_list individ_config_list_right">
                            <li>TATA木门<span class="individ_config_list_1">1</span></li>
                            <li>科勒水槽<span class="individ_config_list_1">1</span></li>
                            <li>西门子开关插座<span class="individ_config_list_1">11</span></li>
                            <li>马可波罗地砖<span class="individ_config_list_2">不限</span></li>
                            <li>方太整体橱柜<span class="individ_config_list_2">不限</span></li>
                        </ul>
                    </div>
                    <div class="individ_left_mid_right individ_left_mid_right_7">
                        <ul class="individ_config_list">
                            <li>西门子开关插座<span class="individ_config_list_1">2</span></li>
                            <li>马可波罗地砖<span class="individ_config_list_2">不限</span></li>
                            <li>大自然踢脚线<span class="individ_config_list_2">不限</span></li>
                        </ul>
                        <ul class="individ_config_list individ_config_list_right">
                            <li>窗台板<span class="individ_config_list_2">不限</span></li>
                            <li>多乐士乳胶漆<span class="individ_config_list_2">不限</span></li>
                        </ul>
                    </div>
                </div>
                <div class="individ_left_bottom">
                    <div class="individ_left_bottom_left">
                        <span class="standard_nav_char">软装</span>
                    </div>
                    <div class="individ_left_mid_right individ_left_mid_right_soft_1">
                        <ul class="individ_config_list">
                            <li>电视柜<span class="individ_config_list_1">1</span></li>
                            <li>多人沙发<span class="individ_config_list_1">1</span></li>
                            <li>茶几<span class="individ_config_list_1">1</span></li>
                            <li>边几<span class="individ_config_list_1">2</span></li>
                            <li>欧雅壁纸<span class="individ_config_list_1">1</span></li>
                        </ul>
                        <ul class="individ_config_list individ_config_list_right">
                            <li>单人椅<span class="individ_config_list_1">1</span></li>
                            <li>挂画<span class="individ_config_list_1">1</span></li>
                            <li>吊灯<span class="individ_config_list_1">1</span></li>
                            <li>落地灯<span class="individ_config_list_1">1</span></li>
                            <li>窗帘<span class="individ_config_list_1">1</span></li>
                        </ul>
                    </div>
                    <div class="individ_left_mid_right individ_left_mid_right_soft_2">
                        <ul class="individ_config_list">
                            <li>双人床<span class="individ_config_list_1">1</span></li>
                            <li>曲美床头柜<span class="individ_config_list_1">2</span></li>
                            <li>Centro衣柜<span class="individ_config_list_1">1</span></li>
                            <li>窗帘<span class="individ_config_list_1">1</span></li>
                        </ul>
                        <ul class="individ_config_list individ_config_list_right">
                            <li>吸顶灯<span class="individ_config_list_1">1</span></li>
                            <li>吊灯<span class="individ_config_list_1">2</span></li>
                            <li>欧雅壁纸<span class="individ_config_list_1">1</span></li>
                        </ul>
                    </div>
                    <div class="individ_left_mid_right individ_left_mid_right_soft_3">
                        <ul class="individ_config_list">
                            <li>曲美床头柜<span class="individ_config_list_1">1</span></li>
                            <li>吸顶灯<span class="individ_config_list_1">1</span></li>
                            <li>Centro衣柜<span class="individ_config_list_1">1</span></li>
                            <li>窗帘<span class="individ_config_list_1">1</span></li>
                        </ul>
                        <ul class="individ_config_list individ_config_list_right">
                            <li>双人床<span class="individ_config_list_1">1</span></li>
                            <li>吊灯<span class="individ_config_list_1">2</span></li>
                            <li>欧雅壁纸<span class="individ_config_list_1">1</span></li>
                        </ul>
                    </div>
                    <div class="individ_left_mid_right individ_left_mid_right_soft_4">

                    </div>
                    <div class="individ_left_mid_right individ_left_mid_right_soft_5">
                        <ul class="individ_config_list">
                            <li>餐桌<span class="individ_config_list_1">1</span></li>
                            <li>餐椅<span class="individ_config_list_1">4</span></li>
                            <li>吊灯<span class="individ_config_list_1">1</span></li>

                        </ul>
                    </div>
                    <div class="individ_left_mid_right individ_left_mid_right_soft_6">

                    </div>
                    <div class="individ_left_mid_right individ_left_mid_right_soft_7">

                    </div>
                </div>
            </div>
            <div class="individ_right">
                <div class="individ_right_top">
                    <span class="individ_personal">个性化</span>
                </div>
                <div class="individ_right_mid">
                    <ul>
                        <?php foreach($list as $v):?>
                        <li>
                            <span class="individ_right_list individ_right_list_1"><?=$v['name'];?></span>
                            <span class="individ_right_list individ_right_list_2"><?=$v['price'];?></span>

<!--                            --><?php //if (!empty($v['color'])): ?>
<!--                                --><?php //for($i = 0; $i < count($v['color']) && $i < 2; $i ++):?>
<!--                                    <span class="individ_right_list individ_right_list_color-->
<!--                                    --><?php //if($i == 0):?><!--individ_right_list_color_2--><?php //else:?><!--individ_right_list_color_1--><?php //endif;?><!--">--><?//=$v['color'][$i];?><!--</span>-->
<!--                                --><?php //endfor;?>
<!--                                --><?php //if (count($v['color']) == 1): ?>
<!--                                    <span class="individ_right_list individ_right_list_color"></span>-->
<!--                                --><?php //endif;?>
<!--                            --><?php //else:?>
<!--                                <span class="individ_right_list individ_right_list_color"></span>-->
<!--                                <span class="individ_right_list individ_right_list_color"></span>-->
<!--                            --><?php //endif;?>
                                <span title="点击添加" class="individ_right_list individ_right_list_5 individ_right_list_price" data-price="<?=$v['price'];?>"
                                      data-color="<?php if(!empty($v['color'])):?><?=$v['color'][0];?><?php endif;?>" data-id="<?=$v['id'];?>" data-name="<?=$v['name'];?>"></span>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="individ_right_bottom">
                </div>
            </div>
        </div>
    </div>
    <div class="individ_order">
        <div class="individ_order_content">
            <div class="individ_acreage">
                <span>请输入面积：</span>
                <input type="text" value="<?=$acreage;?>" data-ovalue="<?=$acreage;?>" name="acreage" class="individ_real_acreage" required="required"/>
                <span style="font-size:25px;margin-left:10px;">m<sup>2</sup></span>
            </div>
            <div class="individ_order_math">
                <span>订单总价：</span>
                <input type="text" value="<?php echo BASE_PRICE + ($acreage - BASE_ACREAGE) * PRICE_PER_ACR;?>" name="price" class="individ_real_math" required="required"/>
                <span style="font-size:25px;margin-left:10px;">元</span>
            </div>
            <div class="individ_order_button">提交</div>
        </div>
    </div>
</div>
<form action="/pay/success" method="post" id="sec_order">
    <input type="hidden" name="order_id" class="order_id" value="<?=$order_id;?>"/>
    <input type="hidden" name="user_id" class="user_id" value="<?=$user_id;?>"/>
    <input type="hidden" name="price" class="price" value="0"/>
    <input type="hidden" name="serial_number" class="serial_number" value="<?=$serial_number;?>"/>
</form>

<link rel="stylesheet" href="/static/css/jquery.mCustomScrollbar.min.css">
<script type="text/javascript" src="/static/js/individual.js"></script>
<script type="text/javascript" src="/static/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
    if (!$.browser.webkit) {
        //$.mCustomScrollbar.defaults.scrollButtons.enable = true; //enable scrolling buttons by default
        $.mCustomScrollbar.defaults.axis = "y"; //enable 2 axis scrollbars by default
        $(".individ_right_mid").mCustomScrollbar({theme: "minimal", width: "5"});
    }
</script>
</body>
</html>