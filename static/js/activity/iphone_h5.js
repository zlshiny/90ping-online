window.addEventListener('load', function() {
		  FastClick.attach(document.body);
		}, false);
$(function(){
    var bwidth = $(window).width();
    var bheight = $(window).height();
    /*$('section').width(bwidth);
    $('section').height(bheight);*/

    $('#view-5').width(bwidth);
    $('#view-5').height(bheight);

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
						var headimgurl = $("#head_img_url").val();
                        var slogan = generate_slogan(name, money);
                        var html = '';
						
						html += '<li>';
						html += '<div class="li-left-2">';
						html += '<img src="' + headimgurl + '">';
						html += '</div>';
						html += '<div class="li-right-2">';
						//html += '<font class="font-1">' + name + '</font>支持了<font class="font-2">' + money + '</font>元 拿着钞票去拯救世界吧';
                        html += slogan;
						html += '</div>';
						html += '</li>';
                        $('.content-ul').prepend(html);
                        
                        $(".left-money").text(5488 - data.left);
                        //$(".left-money2").text(parseInt(data.left) - parseInt(money));
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

function generate_slogan(name, money){
        if(money == 0) return '系统被砍出问题了';

        if(money <= -150){
            return '<span class="partin-user">' + name + '</span> 对楼主有意见，干掉你<span class="partin-user">' + money + '</span>元';
        }else if(money <= -100){
            return '<span class="partin-user">' + name + '</span> 天生捣蛋王，减你<span class="partin-user">' + money + '</span>元';
        }else if(money < 0){
            return '<span class="partin-user">' + name + '</span> 砍掉你<span class="partin-user">' + money + '</span>元，谁叫你太帅';
        }else if(money < 30){
            return '<span class="partin-user">' + name + '</span> 人品好，给你一个<span class="partin-user">' + money + '</span>元大红包';
        }else if(money < 60){
            return '<span class="partin-user">' + name + '</span> 气势如虹，一进来就给你加了<span class="partin-user">' + money + '</span>元';
        }else if(money < 90){
            return '<span class="partin-user">' + name + '</span> 大喊我去，房子都买上了，赞助<span class="partin-user">' + money + '</span>元去装修房子吧';
        }else if(money < 120){
            return '<span class="partin-user">' + name + '</span> 羡慕的说品味可以啊，都预约超级Home了，<span class="partin-user">' + money + '</span>元';
        }else if(money < 150){
            return '<span class="partin-user">' + name + '</span> 送你<span class="partin-user">' + money + '</span>元，还我玫瑰花啊';
        }else if(money < 180){
            return '<span class="partin-user">' + name + '</span> 好基友，<span class="partin-user">' + money + '</span>元，不用还';
        }else if(money < 210){
            return '<span class="partin-user">' + name + '</span> 为了iPhone6，我给你豁出去了，<span class="partin-user">' + money + '</span>元';
        }else if(money < 240){
            return '<span class="partin-user">' + name + '</span> 死党的钱你也敢要？给你<span class="partin-user">' + money + '</span>元';
        }else if(money <= 300){
            return '<span class="partin-user">' + name + '</span> 天降异才, 快拿着这<span class="partin-user">' + money + '</span>元钞票去拯救世界吧';
        }else{
            return '<span class="partin-user">' + name + '</span> <span class="partin-user">' + money + '</span>元，我去,怎么不直接给你砍完啊';
        }
}
