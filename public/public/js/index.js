$(function(){
//app下拉	
$("#js_phone_app,#js_add_wx").hover(function(){
	$(this).addClass("hover");
	},function(){
	$(this).removeClass("hover");
});

	
	
//头部幻灯片
jQuery("#js_bn").slide({mainCell:".bd ul",effect:"top",autoPlay:true});
jQuery("#js_bnn").slide({mainCell:".bdd ul",effect:"top",autoPlay:true});


//首页排行榜
$('.index_jm_cont .index_jm_list').eq(0).show().siblings().hide();
$('.index_jm_tab').each(function(){
	$('.index_jm_tab > ul >li').hover(function(){
		$(this).addClass('on').siblings().removeClass('on');
		$('.index_jm_cont .index_jm_list').eq($(this).index()).show().siblings().hide();
	}).eq(0).hover();
});

//感兴趣

$('.list_int_cont .list_int_list').eq(0).show().siblings().hide();
$('.list_int_tab').each(function(){
	$('.list_int_tab > ul >li').hover(function(){
		$(this).addClass('on').siblings().removeClass('on');
		$('.list_int_cont .list_int_list').eq($(this).index()).show().siblings().hide();
	}).eq(0).hover();
});

	
});



 //排行榜切换
$(function(){
	var rand = 0;
	var menu = $(".zc_text1");
	menu.each(function(i){
		rand = Math.ceil(Math.random()*0);
		$(".zc_text1:eq("+i+") li dl").each(function(m){
			if(m!=rand){
				$(this).hide();
				$(this).prev().removeClass('on');
				$(this).parent().removeClass('block_li');
			}else{
				$(this).show();
				$(this).prev().addClass('on');
				$(this).parent().addClass('block_li');
			}
		});
		
		$(".zc_text1:eq("+i+") li").each(function(j){
			var o = $(this);
			o.children('p').mouseover(function(){
				$(".zc_text1:eq("+i+") li dl").each(function(j){
					$(this).hide();
					$(this).prev().removeClass('on');
					$(this).parent().removeClass('block_li');
				});
				$(this).addClass('on').next().show();
				$(this).parent().addClass('block_li');
			});
		});
	});
	$('.zc_text1 li:eq(0)').children('strong').addClass('zc_1');
	$('.zc_text1 li:eq(1)').children('strong').addClass('zc_2');
	$('.zc_text1 li:eq(2)').children('strong').addClass('zc_3');
	
	$('.zc_text1 li:last').addClass('qline');
});
