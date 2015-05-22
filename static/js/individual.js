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
        var text = '<div class="individ_select_item">\
        <span>' + name + '</span>\
        <span>' + color + '</span>\
        <a href="javascript:void(0);" class="individ_delete" data-price="' + price + '"></a>\
        </div>';

        $(".individ_right_bottom").append(text);
    })

    $(".individ_delete").live('click', function(){
        var price = parseInt($(this).attr("data-price"));
        var total_price = parseInt($(".individ_order_math .individ_real_math").val());
        $(".individ_order_math .individ_real_math").val(total_price - price);

        $(this).parent().remove();
    })
});