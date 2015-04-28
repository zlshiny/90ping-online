<?php
    include('header.php');
?>
<div class="loan_banner"></div>
<div class="loan_title">申请说明</div>
<div class="loan_wrap">
    <p>申请对象：90平方装修用户</p>

    <p>年龄范围：25~55周岁</p>

    <p>最高额度：50万</p>

    <p>批款时间：最快2小时</p>

    <p>支持期数：12期、24期、36期、48期（1期为1个月）</p>

    <!--<p>手续费率：分期手续费0.75%/期；提前还款手续费为剩余本金的3%</p>-->

    <p>申请材料：</p>
    <p>1、提供工作证明（有照片的工作证原件或公积金缴存证明）；</p>
    <p>2、申请人身份证复印件1份；</p>
    <p>3、90平方装修定金收据或合同；</p>

    <p>办理地址：北京市朝阳区双井时代国际嘉园1号楼3单元1504</p>
</div>
<div class="loan_title">申请流程</div>
<div class="loan_wrap">
   <p> 1、合同：预约装修服务（交定金即可申请贷款）；</p>
   <p> 2、申请：提出贷款申请；</p>
   <p> 3、办理：1个工作日内，将与您联系，预约办理时间；</p>
   <p> 4、放款：您可通过网上银行、短信、电话激活您的卡片；</p>
   <p> 5、还款：根据约定，按期还款。</p>
</div>
<div class="loan_title">申请人信息</div>
<div class="loan_wrap">
    <span>姓名</span>
    <input type="text" value="" name="user_name"/>
    <span>手机</span>
    <input type="text" value="" name="phone"/>
    <span>性别</span>
    <div class="loan_select loan_gender">
        <div class="loan_hover" title="1">先生</div>
        <div title="2">女士</div>
    </div>
    <span>工作单位性质</span>
    <div class="loan_select loan_org">
        <div class="loan_hover" title="1">国有企业</div>
        <div title="2">事业单位</div>
        <div title="3">私营企业</div>
    </div>
    <span>月收入(请输入数字)</span>
    <input type="text" value="" name="income"/>
    <span>期望贷款金额</span>
    <input type="text" value="" name="expect"/>
    <span>房屋地址</span>
    <input type="text" value="" name="location"/>
    <span>房屋面积(请输入数字)</span>
    <input type="text" value="" name="acreage"/>
    <div class="loan_sub">提交</div>
    <div class="clearfix loan_p"></div>

    <div style="display:none">
        <input type="hidden" value="1" id="sub_gender"/>
        <input type="hidden" value="1" id="sub_org"/>
    </div>
</div>
<script type="text/javascript">
    $('.loan_org').find('div').live('click',function(){
        $(this).parent().find('div').removeClass('loan_hover');
        $(this).addClass('loan_hover');
        $("#sub_org").val($(this).attr('title'));
    });

    $('.loan_gender').find('div').live('click',function(){
        $(this).parent().find('div').removeClass('loan_hover');
        $(this).addClass('loan_hover');
        $("#sub_gender").val($(this).attr('title'));
    });

    $('.loan_sub').live('click',function(){
        var reg = /^[0-9]*\.*[0-9]*$/ , type = true;
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

        if(!type) return false;

        var phone = $('input[name="phone"]').val();
        var name = $('input[name="user_name"]').val();
        var income = $('input[name="income"]').val();
        var expect = $('input[name="expect"]').val();
        var locat = $('input[name="location"]').val();
        var acreage = $('input[name="acreage"]').val();
        var gender = $("#sub_gender").val();
        var org = $("#sub_org").val();

        if(gender != 1 && gender != 2){
            alert('性别非法');
            return fasle;
        }

        if(org != 1 && org != 2 && org != 3){
            alert('工作单位非法');
            return false;
        }

        if(type){
            $.post('/loan/apply',
                {phone: phone, name: name, income: income, expect: expect, location: locat, acreage: acreage, gender: gender, org: org},
                function(data, status){
                        if(status == "success"){
                            data = eval('(' + data + ')');
                            if(data.code != 0){
                                alert(data.msg);
                                return false;
                            }else{
                                window.location.href = "/loan/success";
                            }
                        }else{
                            alert('服务器繁忙');
                            return false;
                        }
            
            })
        }
    })
</script>
