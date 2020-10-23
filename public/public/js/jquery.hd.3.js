// JavaScript Document
$.fn.slider3=function(options){
	var defaults={
		area:".ban .ks-switchable-content",//ulclassid
		autoTime:0,		                   //Զʱ	
		stopTime:2000,                     //ͣʱ
		mouseOverArea:"#slide-box",        //긲
		left:'#J_next',                    //ưť
		right:'#J_prev'                    //ưť
	};
	
	if(options)
	{
	    $.extend(defaults,options);
	}
   	
	var $imgul = $(defaults.area);
	var $mouseOverArea = $(defaults.mouseOverArea);
    var $sWidth = $imgul.find("li:first").width();
	
	
	//ߵť
	$(defaults.left).click(function(){
	    autoScollLeft();
	});
	
	//ұߵť
	$(defaults.right).click(function(){
	    autoScollRight();
	});	
	
	var set = setInterval(function(){autoScollRight();},defaults.autoTime+defaults.stopTime);
	
	$mouseOverArea.mouseenter(function(){
	    clearInterval(set);
	}).mouseleave(function(){
	    set = setInterval(function(){autoScollRight();},defaults.autoTime+defaults.stopTime);
	});
	
	function autoScollRight(){
		$imgul.animate({ 'marginLeft': -$sWidth}, defaults.autoTime, function () {
			$imgul.css('marginLeft', '0');
			$imgul.find('li:first').appendTo($imgul);
		});
	}

	function autoScollLeft(){
		//ȡpicInnerԪ(ҪԪ)
		var field = $imgul.find("li:last");
		$imgul.find('li:last').prependTo($imgul);
        $imgul.css('marginLeft', -$sWidth);
		//ͨmargin-leftֵʵֹЧ
		$imgul.animate({"margin-left":'0px'},defaults.autoTime,function(){
			//Ժ, Ԫmargin-leftΪʼֵ
			//Ҳ׷ӵйԪǰ
			field.css("margin-left",'0px').prependTo($imgul);
	    });
	}

};