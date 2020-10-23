// JavaScript Document
$(function(){
  $(".kuaijie-list li").click(function(){
	
	 $(".ny-txt").val($('.ny-txt').val()+$(this).text());  
  })	
})




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


