<?php
    include('header.php');
?>
<div class="loan_banner"></div>
<div class="loan_title">申请说明</div>
<div class="loan_wrap">
    <p>申请对象：90平方装修用户</p>

    <p>最高额度：年收入的6倍</p>

    <p>批款时间：2-3天</p>

    <p>支持期数：3期、6期、12期、24期、36期（1期为1个月）</p>

    <p>手续费率：分期手续费0.75%/期；提前还款手续费为剩余本金的3%</p>

    <p>申请材料：</p>
    <p>一、户口：</p>
    <p>1、提供工作证明（有照片的工作证原件或公积金缴存证明）；</p>
    <p>2、申请人身份证复印件1份；</p>
    <p>3、90平方装修定金收据或合同；</p>

    <p>办理地址：北京市朝阳区双井时代国际嘉园1号楼3单元1504</p>
</div>
<div class="loan_title">申请流程</div>
<div class="loan_wrap">
   <p> 1、合同：预约装修服务（交定金即可申请贷款）；</p>
   <p> 2、申请：提出华夏易达金装修贷款申请；</p>
   <p> 3、办理：1个工作日内，华夏银行将与您联系，预约办理时间；</p>
   <p> 4、寄卡：资料齐全后，10个工作日内，您的信用卡将由北京总行寄出；</p>
   <p>5、放款：您可通过网上银行、短信、电话激活您的卡片；</p>
   <p> 6、还款：根据约定，按期还款。</p>
</div>
<div class="loan_title">申请人信息</div>
<div class="loan_wrap">
    <span>姓名</span>
    <input type="text" value="" name="user_name"/>
    <span>手机</span>
    <input type="text" value="" name="phone"/>
    <span>性别</span>
    <div class="loan_select">
        <div class="loan_hover">先生</div>
        <div>女士</div>
    </div>
    <span>工作单位性质</span>
    <div class="loan_select">
        <div class="loan_hover">国有企业</div>
        <div>事业单位</div>
        <div>私营企业</div>
    </div>
    <span>月收入(请输入数字)</span>
    <input type="text" value="" name="income"/>
    <span>期望贷款金额</span>
    <input type="text" value=""/>
    <span>房屋地址</span>
    <input type="text" value=""/>
    <span>房屋面积(请输入数字)</span>
    <input type="text" value="" name="acreage"/>
    <div class="loan_sub">提交</div>
    <div class="clearfix loan_p"></div>
</div>
<script type="text/javascript">
    $('.loan_select').find('div').live('click',function(){
        $(this).parent().find('div').removeClass('loan_hover');
        $(this).addClass('loan_hover');
    });
    $('.loan_sub').live('click',function(){
        var reg = /^[0-9]*$/ , type = true;
        $('.loan_wrap input').each(function(){
            $(this).removeClass('loan_error');
           
            if($(this).val() == ''){
                $(this).addClass('loan_error');
                type = false;
            }else if($(this).attr('name') == 'income'){
                if(!reg.test($(this).val())){
                    $(this).addClass('loan_error');
                    alert('月收入只能为数字!');
                    type = false;
                }
            }else if($(this).attr('name') == 'acreage'){
                if(!reg.test($(this).val())){
                    $(this).addClass('loan_error');
                    alert('房屋面积只能为数字');
                    type = false;
                }
            }else{
                type = true;
            }
        })
        if(type){
            $.post('##',{},function(){
            
            })
        }
    })
</script>
