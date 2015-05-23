$(document).ready(function(){
    $(".individ_left_mid_right").hide();
    $(".individ_left_mid_right_1").show();
    $(".individ_left_mid_right_soft_1").show();

    $(".individ_wrap ul li").live('click', function(){
        var id = $(this).attr("data-id");
        $(".individ_left_mid_right").hide();
        $(".individ_left_mid_right_" + id).show();
        $(".individ_left_mid_right_soft_" + id).show();

        $(".individ_wrap ul li").removeClass("individ_btn_hover");
        $(this).addClass("individ_btn_hover");
    })

    $(".individ_right_list_price").live('click', function(){
        var price = parseInt($(this).attr("data-price"));
        var total_price = parseInt($(".individ_order_math .individ_real_math").val());
        $(".individ_order_math .individ_real_math").val(price + total_price);

        var name = $(this).attr("data-name");
        var color = $(this).attr("data-color");
        var id = $(this).attr("data-id");
        var text = '<div class="individ_select_item" data-id="' + id + '" data-color="' + color + '">\
        <span>' + name + '</span>\
        <span>' + color + '</span>\
        <a href="javascript:void(0);" class="individ_delete" data-price="' + price + '"></a>\
        </div>';

        $(".individ_right_bottom").append(text);
    })

    $(".individ_right_list_color").live('click', function(){
        var color = $(this).text();
        $(this).parent().children(".individ_right_list_price").attr('data-color', color);
        $(this).parent().children('.individ_right_list_color_2').addClass('individ_right_list_color_1');
        $(this).parent().children('.individ_right_list_color_2').removeClass('individ_right_list_color_2');
        $(this).addClass('individ_right_list_color_2');
    })

    $(".individ_delete").live('click', function(){
        var price = parseInt($(this).attr("data-price"));
        var total_price = parseInt($(".individ_order_math .individ_real_math").val());
        $(".individ_order_math .individ_real_math").val(total_price - price);

        $(this).parent().remove();
    })

    $(".individ_real_acreage").live('change', function(){
        var acreage = parseInt($(this).val());
        var ovalue = parseInt($(this).attr("data-ovalue"));

        var min_acreage = $("#min_acreage").val();
        var max_acreage = $("#max_acreage").val();
        if(acreage < min_acreage || acreage > max_acreage){
            alert('面积非法');
            $(this).val(ovalue);
            return false;
        }

        $(this).attr("data-ovalue", acreage);
        var total_price = parseInt($(".individ_real_math").val()) + (acreage - ovalue) * 899;
        $(".individ_real_math").val(total_price);
    })

    $(".individ_order .individ_order_button").live('click', function(){
        var price = parseInt($(".individ_real_math").val());
        if(price <= 0){
            alert('价格非法');
            return false;
        }

        var acreage = parseInt($(".individ_real_acreage").val());
        var min_acreage = $("#min_acreage").val();
        var max_acreage = $("#max_acreage").val();
        if(acreage < min_acreage || acreage > max_acreage){
            alert('面积非法');
            return false;
        }

        var order_id = parseInt($("#order_id").val());
        if(order_id <= 0){
            alert('订单ID不存在');
            return false;
        }
        var user_id = parseInt($("#user_id").val());
        if(user_id <= 0){
            alert('用户不存在');
            return false;
        }

        var config = '';
        var tmp = new Array();
        var index = 0;
        $(".individ_right_bottom").children().each(function(){
            tmp[index] = $(this).attr("data-id") + ':' + $(this).attr("data-color");
            index ++;
        });

        config = tmp.join('|');
        $.post('/individual/add',
            {order_id: order_id, user_id: user_id, acreage: acreage, config: config, price: price},
            function(data, status){
                if(status == "success") {
                    data = eval('(' + data + ')');
                    if (data.code == 0) {
                        $(".order_id").val(data.order_id);
                        $(".user_id").val(data.user_id);
                        $(".serial_number").val($("#serial_number").val());
                        $(".price").val(data.price);
                        $("#sec_order").submit();
                    }else{
                        alert(data.msg);
                        return false;
                    }
                }else{
                    alert('服务器错误');
                    return false;
                }
            });
    })
});