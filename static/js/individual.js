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
    })
});