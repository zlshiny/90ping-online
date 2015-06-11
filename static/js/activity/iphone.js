window.addEventListener('load', function() {
		  FastClick.attach(document.body);
		}, false);
$(function(){
    var bwidth = $(window).width();
    var bheight = $(window).height();
    $('section').width(bwidth);
    $('section').height(bheight);

    $('.support').click(function(){ support(); });
})

//点击“支持他”
function support(){
    /**
     * 处理请求
     */
    var html = '';
    html += '<li>';
    html += '<div class="li-left">';
    html += '<font class="font-1">美国队长2</font>支持了<font class="font-2">329</font>元';
    html += '</div>';
    html += '<div class="li-right">拿着钞票去拯救世界吧</div>';
    html += '</li>';
    $('.content-ul').prepend(html);
}   

