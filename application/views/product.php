<?php
    include('header.php');
?>
<script type="text/javascript">
$('.product_change_btn ul li').live('click',function(){
    var num = $(this).index();
    $('.product_change_btn ul li').removeClass('btn_hover');
    $(this).addClass('btn_hover');
    $('.product_change_main div').addClass('dn');
    $('.product_change_main div').eq(num).removeClass('dn');
    
})
</script>
<div class="product_banner"></div>
<div class="product_banner1"></div>
<div class="product_change_btn">
    <div class="product_wrap">
        <ul>
            <li class="btn_hover">客厅</li>
            <li>餐厅</li>
            <li>厨房</li>
            <li>主卧</li>
            <li>次卧</li>
            <li>卫生间</li>
        </ul>
    </div>
</div>
<div class="product_change_main">
        <div class="product_img1"></div>
        <div class="product_img1 dn"></div>
        <div class="product_img1 dn"></div>
        <div class="product_img1 dn"></div>
        <div class="product_img1 dn"></div>
        <div class="product_img1 dn"></div>
</div>
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
        <div class="product_step_block">
            <img src="<?=IMAGE_PATH .'banner/icon/5.png';?>"/>
            <p>网站注册<br/>填写基本信息<br/>支付一元预约金(不退)</p>
        </div>
        <div class="product_step_block" style="margin-right:0px;">
            <img src="<?=IMAGE_PATH .'banner/icon/6.png';?>"/>
            <p>网站注册<br/>填写基本信息<br/>支付一元预约金(不退)</p>
        </div>
    </div>
</div>
<div class="product_part"></div>
<?php
    include('footer.php');
?>
