$(function(){
    menuClick();
    menuMouse();
    desMouse();
    zeroMouse();
    constructMouse();
    packageMouse();
    individualityMouse();
    returnTop();
})

function menuClick(){
    $('.nav-ul li').click(function(){
        $('.nav-ul li').removeClass('on');
        $(this).addClass('on');
        var index = $(this).index();
        $('.menu-area').hide();
        $('.menu-area-'+(index+1) ).show();
    })
}

function menuMouse(){
    $('.menu-area-ul li').mouseover(function(){
        var index = $(this).index();
        $('.menu-area-ul li').removeClass('on');
        $(this).addClass('on');
    })
}

//设计鼠标悬浮效果
function desMouse(){
    $('.des-img').mouseover(function(){
        var index = $(this).index();
        $(this).attr('src','/static/image/product2/ling'+(index+1)+'-on.png');
    })
    $('.des-img').mouseout(function(){
        var index = $(this).index();
        $(this).attr('src','/static/image/product2/ling'+(index+1)+'.png');
    })

    $('.des-img2').mouseover(function(){
        var index = $(this).index();
        $(this).attr('src','/static/image/product2/ling'+(index+4)+'-on.png');
    })
    $('.des-img2').mouseout(function(){
        var index = $(this).index();
        $(this).attr('src','/static/image/product2/ling'+(index+4)+'.png');
    })
}

//设计鼠标悬浮效果
function zeroMouse(){
    $('.zero-content-ul li').mouseover(function(){
        var index = $(this).index();
        $('.zero-content-ul li').removeClass('on');
        $(this).addClass('on');
        $('.zero-content-img img').attr('src','/static/image/product2/zero-img-0'+(index+1)+'.jpg');
    })
    $('.zero-content-ul li').mouseout(function(){
        var index = $(this).index();
        $('.zero-content-img img').attr('src','/static/image/product2/zero-img-0'+(index+1)+'.jpg');
    })
}

function constructMouse(){
    $('.construct-ul li').mouseover(function(){
        var index = $(this).index();
        $(this).children('img').attr('src','/static/image/product2/construct_0'+(index+1)+'_on.jpg');
    })
    $('.construct-ul li').mouseout(function(){
        var index = $(this).index();
        $(this).children('img').attr('src','/static/image/product2/construct_0'+(index+1)+'.jpg');
    })
}

function packageMouse(){
    $('.package-ul li').mouseover(function(){
        if(!$(this).hasClass('package-two')){
            var index = $(this).index();
            $(this).children('img').attr('src','/static/image/product2/package-1-'+(index+1)+'-on.jpg');
        }
    })
    $('.package-ul li').mouseout(function(){
        if(!$(this).hasClass('package-two')){
            var index = $(this).index();
            $(this).children('img').attr('src','/static/image/product2/package-1-'+(index+1)+'.jpg');
        }
    })
    $('.package-two img').mouseover(function(){
        var index = $(this).index();
        $(this).attr('src','/static/image/product2/package-1-4-'+(index+1)+'-on.jpg');
    })
    $('.package-two img').mouseout(function(){
        var index = $(this).index();
        $(this).attr('src','/static/image/product2/package-1-4-'+(index+1)+'.jpg');
    })
}

function individualityMouse(){
    $('.individuality-ul li').mouseover(function(){
        var index = $(this).index();
        $(this).children('img').attr('src','/static/image/product2/individuality-'+(index+1)+'-on.jpg');
    })
    $('.individuality-ul li').mouseout(function(){
        var index = $(this).index();
        $(this).children('img').attr('src','/static/image/product2/individuality-'+(index+1)+'.jpg');
    })
}
function returnTop(){
    $('#return-top').click(function(){
        $('body,html').animate({scrollTop:0},1000);
        return false;
    })
}