window.addEventListener('load', function() {
		  FastClick.attach(document.body);
		}, false);
$(function(){
    // $('#ten,#drawing-room,#master-room,#subaltern-room,#rest-room,#kitchen-room,#dining-room').bxSlider({
    //     displaySlideQty:2,
    //     moveSlideQty: 1,
    //     captions: true,
    //     auto: false,
    //     pager: false,
    //     speed: 1000,
    //     oneToOneTouch: false
    // });    
    var bwidth = $(window).width();
    var bheight = $(window).height();
    $('.bx-prev, .bx-next').css('margin-top', -parseInt(bheight*0.5));

    $('.gender-button').on('click',function(){
        var inputVal = $(this).index();
        $('.gender-button').removeClass('on');
        $(this).addClass('on');
        $('.gender').val(inputVal);
    })
    $('.month').on('click', function(){
        var inputVal = $(this).index();
        $('.month').removeClass('on');
        $(this).addClass('on');
        $('#month-input').val(inputVal);
    })
    
})



