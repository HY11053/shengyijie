// JavaScript Document




$(function(){
	var nrW = $('.content2').width();
	$('.content2 img').each(function(){
		
			$(this).css('max-width',nrW);
			$(this).css('height','auto');
		
	});
});


$(function(){
    $(".in_xiangmu ul li:odd").addClass("bd");
	$(".in_xiangmu ul li:eq(4)").addClass("red");
	$(".in_xiangmu ul li:eq(5)").addClass("red");
	$(".in_xiangmu ul li:eq(10)").addClass("red");
	$(".in_xiangmu ul li:eq(11)").addClass("red");
	$(".in_xiangmu ul li:eq(16)").addClass("red");
	$(".in_xiangmu ul li:eq(17)").addClass("red");
})


$(function(){
	var bheight=$('.viewport').height()-44;
	$('.bg000').css({height:bheight});
	$(".h_open_nav").click(function(){
			$(this).hide();
			$('.h_open_nava').show();
			$('.nava').slideDown(400);
			$('.bg000').slideDown(400);
	  });
	
	$(".h_open_nava").click(function(){
			$(this).hide();
			$('.h_open_nav').show();
			$('.nava').slideUp(400);
			$('.bg000').slideUp(400);
	  });

	$(".bg000").click(function(){
			$('.h_open_nav').show();
			$('.h_open_nava').hide();
			$('.nava').slideUp(400);
			$(this).slideUp(400);
	  });
	
	
});
		
	
	
$(function(){
	var bheight=$(document.body).height()-44;
	if($('.pic404_h').height()<bheight){
		$('.pic404_h').css({height:bheight});
	}
	
});
	
		
		



