<?php
    include('header.php');
?>
<script type="text/javascript">
$('.product_change_btn ul li').live('click',function(){
    var num = $(this).index();
    $('.product_change_btn ul li').removeClass('btn_hover');
    $(this).addClass('btn_hover');
    $('.product_change_main').children('div').addClass('dn');
    $('.product_change_main').children('div').eq(num).removeClass('dn');
    
})
$('.pp_icon').live('mouseover',function(){
    $('.pp_img').hide();   
    $(this).next().fadeIn();
})
$('.pp_img').live('mouseout',function(){
    $('.pp_img').fadeOut();
})
</script>
<div class="product_banner">
    <a href="/order" target="_blank">立即预约</a>
    <!--<p>已有<span>12333</span>人排队</p>-->
</div>
<div class="product_banner1"></div>
<div class="product_change_btn">
    <div class="product_wrap">
        <ul>
            <li class="btn_hover">客厅</li>
            <li>餐厅</li>
            <li>厨房</li>
            <li>主卧</li>
            <li>次卧</li>
            <li style="margin-right:0px;">卫生间</li>
        </ul>
    </div>
</div>
<div class="product_change_main">
        <div class="product_img product_img1">
            <div class="p_s_w">
                <div class="pp_icon ppp1">
                    <div></div>
                </div>
                <div class="pp_img ppi1"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp2">
                    <div></div>
                </div>
                <div class="pp_img ppi2"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp3">
                    <div></div>
                </div>
                <div class="pp_img ppi3"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp4">
                    <div></div>
                </div>
                <div class="pp_img ppi4"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp5">
                    <div></div>
                </div>
                <div class="pp_img ppi5"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp6">
                    <div></div>
                </div>
                <div class="pp_img ppi6"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp7">
                    <div></div>
                </div>
                <div class="pp_img ppi7"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp8">
                    <div></div>
                </div>
                <div class="pp_img ppi8"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp9">
                    <div></div>
                </div>
                <div class="pp_img ppi9"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp10">
                    <div></div>
                </div>
                <div class="pp_img ppi10"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp11">
                    <div></div>
                </div>
                <div class="pp_img ppi11"></div>
            </div>
        </div>
        <div class="product_img product_img2 dn">
            <div class="p_s_w">
                <div class="pp_icon ppp12">
                    <div></div>
                </div>
                <div class="pp_img ppi12"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp13">
                    <div></div>
                </div>
                <div class="pp_img ppi13"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp14">
                    <div></div>
                </div>
                <div class="pp_img ppi14"></div>
            </div>
        </div>
        <div class="product_img product_img3 dn">
            
            <div class="p_s_w">
                <div class="pp_icon ppp15">
                    <div></div>
                </div>
                <div class="pp_img ppi15"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp16">
                    <div></div>
                </div>
                <div class="pp_img ppi16"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp17">
                    <div></div>
                </div>
                <div class="pp_img ppi17"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp18">
                    <div></div>
                </div>
                <div class="pp_img ppi18"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp19">
                    <div></div>
                </div>
                <div class="pp_img ppi19"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp20">
                    <div></div>
                </div>
                <div class="pp_img ppi20"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp21">
                    <div></div>
                </div>
                <div class="pp_img ppi21"></div>
            </div>
        </div>
        <div class="product_img product_img4 dn">
            
            <div class="p_s_w">
                <div class="pp_icon ppp22">
                    <div></div>
                </div>
                <div class="pp_img ppi22"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp23">
                    <div></div>
                </div>
                <div class="pp_img ppi23"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp24">
                    <div></div>
                </div>
                <div class="pp_img ppi24"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp25">
                    <div></div>
                </div>
                <div class="pp_img ppi25"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp26">
                    <div></div>
                </div>
                <div class="pp_img ppi26"></div>
            </div>
        </div>
        <div class="product_img product_img5 dn">
            
            <div class="p_s_w">
                <div class="pp_icon ppp27">
                    <div></div>
                </div>
                <div class="pp_img ppi27"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp28">
                    <div></div>
                </div>
                <div class="pp_img ppi28"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp29">
                    <div></div>
                </div>
                <div class="pp_img ppi29"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp30">
                    <div></div>
                </div>
                <div class="pp_img ppi30"></div>
            </div>
        </div>
        <div class="product_img product_img6 dn">
            <div class="p_s_w">
                <div class="pp_icon ppp31">
                    <div></div>
                </div>
                <div class="pp_img ppi31"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp32">
                    <div></div>
                </div>
                <div class="pp_img ppi32"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp33">
                    <div></div>
                </div>
                <div class="pp_img ppi33"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp34">
                    <div></div>
                </div>
                <div class="pp_img ppi34"></div>
            </div>
            <div class="p_s_w">
                <div class="pp_icon ppp35">
                    <div></div>
                </div>
                <div class="pp_img ppi35"></div>
            </div>
                 
                 
        </div>
</div>
<div class="product_pp"></div>
<div class="product_wrap">
    <h1>合作品牌</h1>
</div>

<div class="product_part"></div>
<div class="product_pm"></div>
<!--
<div class="product_wrap">
    <h1>智能家居 一切随心</h1>
    <div class="product_part1">
        <div class="product_block p_block1">
            <img src="<?=IMAGE_PATH . 'g11.png';?>"/>
            <h2>智能灯光</h2>
            <p>电动窗帘 智能灯光 手机开锁 净水 空气净化</p>
        </div>
        <div class="product_block p_block2">
            <img src="<?=IMAGE_PATH . 'g12.png';?>"/>
            <h2>智能灯光</h2>
            <p>电动窗帘 智能灯光 手机开锁 净水 空气净化</p>
        </div>
        <div class="product_block p_block3">
            <img src="<?=IMAGE_PATH . 'g13.png';?>"/>
            <h2>手机开锁</h2>
            <p>电动窗帘 智能灯光 手机开锁 净水 空气净化</p>
        </div>
        <div class="product_block p_block4">
            <img src="<?=IMAGE_PATH . 'g14.png';?>"/>
            <h2>净水 空气净化器</h2>
            <p>电动窗帘 智能灯光 手机开锁 净水 空气净化</p>
        </div>
    </div>
    <h1>时尚潮流 逼格首选</h1>
</div>
<div class="product_banner2"></div>

<div class="product_wrap">
    <div class="product_msg">
        <h3>零增项  轻工辅料主材六不限</h3>
        <p>一口价，合同签订后，绝不增加任何增项</p>
        <p>水电改造不限制米数</p>
        <p>室内门不限樘数</p>
        <p>橱柜不限延米</p>
        <p>厨卫吊顶不限面积</p>
        <p>地砖木地板可互换</p>
        <p>乳胶漆壁纸可互换</p>
    </div>
    <div class="product_msg">
        <h3>零增项  轻工辅料主材六不限</h3>
        <p>一口价，合同签订后，绝不增加任何增项</p>
        <p>水电改造不限制米数</p>
        <p>室内门不限樘数</p>
        <p>橱柜不限延米</p>
        <p>厨卫吊顶不限面积</p>
        <p>地砖木地板可互换</p>
        <p>乳胶漆壁纸可互换</p>
    </div>
    <div class="product_msg" style="margin-right:0px;">
        <h3>零增项  轻工辅料主材六不限</h3>
        <p>一口价，合同签订后，绝不增加任何增项</p>
        <p>水电改造不限制米数</p>
        <p>室内门不限樘数</p>
        <p>橱柜不限延米</p>
        <p>厨卫吊顶不限面积</p>
        <p>地砖木地板可互换</p>
        <p>乳胶漆壁纸可互换</p>
    </div>
    <h4>适用房屋</h4>
    <div class="product_other">
    <p>我们的套餐适用于开发商已完成各功能区墙体分隔、水、电位点预留、配线到位的单位住宅。</p>
    <p class="p_col">室内含一厨、一卫、一阳台，套餐内配置56点位，套餐点位内的移位不再另行收费。套餐价为699元x工程量</p>
    <p>工程量为室内地面装修净面积的1.25倍与房产证产权面积两者比较取最大值。工程量小于80m²的一口价55920元。</p>
    <p>如您家卫生间、阳台（面积小于2m²的生活阳台除外）个数超过一个、土建预留或业主设计超过套餐水电位需另行计价</p>
    <h4>水电部分</h4>
    <p>开发商已完成各功能区水、电点位预留到位，并配线到位的基础上，水、电点位免费升级优化到套餐配置。</p>
    <p class="p_col">套餐点位内的移位不再另行收费。业主设计的水、电点位总数最多56个，超出点位数需在商城另行购买。</p>
    </div>
</div>
-->
<a href="/download/hard" class="p_d1">点击下载硬装主材单</a>
<a href="/download/soft" class="p_d2">点击下载软装主材单</a>
<div class="product_wrap">
    <h1>零增项 十不限，无陷阱消费</h1>
    <div class="p_main_l">
        <span style="font-size:200px;line-height:170px;">0</span>
        <span style="font-size:48px;line-height:85px;">增<br/>项</span>
        <p>一口价，合同签订后保证无增项；<br/>
        水电改造不限延米数；<br/>
        原结构不变，室内门不限樘数；<br/>
        橱柜不限延米数；<br/>
        客厅、餐厅石膏板造型吊顶不限平米数；<br/>
        </p>
    </div>
    <div class="p_main_r">
        <span style="font-size:200px;line-height:145px;">+</span>
        <span style="font-size:48px;line-height:85px;">不<br/>限</span>
        <p>铝扣吊顶不限面积<br/>
        家具尺寸伴随空间需要调整尺寸且价格不变<br/>
        窗帘不限延米数<br/>
        次卧与书房软装可互换且价格不变<br/>
        地砖和木地板可互换且价格不变<br/>
        </p>
    </div>
    <h1>价格说明</h1>
</div>
<div class="p_msg_wrap">
    <div class="product_wrap">
        <p>1.房屋面积范围 80m2≤面积<100m2 ；</p>
        <p>2.房屋面积取房屋室内地面装修净面积的1.25倍与房产证产权面积两者的最大值。房屋面积±5m2恕不另行计费，其它面积另行商议；</p>
        <p>3.90m2一口价整体家装148888.00元；</p>
        <p>4.标准套餐包含一主卧、一次卧（或书房）、一厨、一卫、一餐厅、一阳台、60电点位；</p>
        <p>5.标准配置之外，每增加一个卫生间，费用增加1.69万，每增加一个卧室（或书房）
    硬装免费，软装费用增加1.19万（可选项），每增加一个阳台，费用增加1000元；</p>
        <p>6.旧房改造拆改费用为99元/m2；</p>
        <p>7.如若房屋其它空间增加石膏板造型吊顶，费用另行商议；</p>
        <p>8.如若采用推拉移门，费用另行商议；</p>
    </div>
</div>
<div class="product_wrap">
    <h1>付款方式</h1>
</div>
<div class="p_msg_wrap">
    <div class="product_wrap">
        <!--<p>1.在线预约，支付预约金1元；</p>-->
        <p>1.在线预约；</p>
        <p>2.装修方案确认，签订装修合同后支付合同金额的60%；</p>
        <p>3.装修完成后，软装进场前支付合同进的的40%；</p>
    </div>
</div>
<div class="product_wrap">
    <h1>服务保障</h1>
</div>
<div class="p_msg_wrap">
    <div class="product_wrap p_block_wrap">
        <div>
            <b>1.施工标准保障</b>
        </div>
        <div>
            <b>2.设计团队保障</b>
            <span>2位空间设计师，2位软装设计师，
            1位建筑设计师，调研数百位85
            后业主，经过45天创作研发、精
            心雕琢，为80后打造有性格、有
            品位的的专属整体家装单品！</span>
        </div>
        <div>
            <b>3.过程监控保障</b>
            <span>互联网全程直播监控，
        影像直播，实时互动</span>
        </div>
        <div>
            <b>4.售后服务保障</b>
            <span>整装2年质保</span>
        </div>
    </div>
</div>
<div class="product_step"v>
    <div class="product_wrap">
        <h1>预约流程</h1>
        <div class="product_step_block">
            <img src="<?=IMAGE_PATH .'banner/icon/1.png';?>"/>
            <p>网站注册<br/>填写基本信息<br/>支付一元预约金(不退)</p>
        </div>
        <div class="product_step_block">
            <img src="<?=IMAGE_PATH .'banner/icon/2.png';?>"/>
            <p>网站注册<br/>填写基本信息<br/>支付一元预约金(不退)</p>
        </div>
        <div class="product_step_block">
            <img src="<?=IMAGE_PATH .'banner/icon/3.png';?>"/>
            <p>网站注册<br/>填写基本信息<br/>支付一元预约金(不退)</p>
        </div>
        <div class="product_step_block">
            <img src="<?=IMAGE_PATH .'banner/icon/4.png';?>"/>
            <p>网站注册<br/>填写基本信息<br/>支付一元预约金(不退)</p>
        </div>
<!--
        <div class="product_step_block">
            <img src="<?=IMAGE_PATH .'banner/icon/5.png';?>"/>
            <p>网站注册<br/>填写基本信息<br/>支付一元预约金(不退)</p>
        </div>
        <div class="product_step_block" style="margin-right:0px;">
            <img src="<?=IMAGE_PATH .'banner/icon/6.png';?>"/>
            <p>网站注册<br/>填写基本信息<br/>支付一元预约金(不退)</p>
        </div>
-->    
    </div>
</div>

<?php
    include('footer.php');
?>
