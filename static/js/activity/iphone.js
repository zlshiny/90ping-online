window.addEventListener('load', function() {
		  FastClick.attach(document.body);
		}, false);
$(function(){
    var bwidth = $(window).width();
    var bheight = $(window).height();
    $('section').width(bwidth);
    $('section').height(bheight);

    $('.support').click(function(){ 
        var uid = $(this).attr("data-id");
        support(uid); 
    });
})

//点击“支持他”
function support(uid){
    if(uid <= 0) return false;

    $.get('/activity/iphone/support/' + uid,
            function(data, status){
                if(status == "success") {
                    data = eval('(' + data + ')');
                    if (data.code == 0) {
                        var money = data.money;
                        var name = $("#name").val();
                        var html = '';
                        html += '<li>';
                        html += '<div class="li-left">';
                        html += '<font class="font-1">' + name + '</font>支持了<font class="font-2">' + money + '</font>元';
                        html += '</div>';
                        html += '<div class="li-right">拿着钞票去拯救世界吧</div>';
                        html += '</li>';
                        $('.content-ul').prepend(html);
                    }else if(data.code == -3){
                        alert('您已经支持过了哦');
                        return false;
                    }else if(data.code == -1){
                        location.href="/activity/iphone/index/" + uid;  
                        return true;
                    }else{
                        alert('系统开小差了，请您稍后再试');
                        return false;
                    }
                }
            });
    /**
     * 处理请求
     */
}

