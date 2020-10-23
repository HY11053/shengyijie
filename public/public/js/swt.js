// 商务通弹出图片链接
//document.writeln("<div id=\'dingwei\' style=\'width:580px; box-shadow:1px 3px 5px #ccc; height:350px; position:fixed; left:50%; top:50%; margin:-175px 0 0 -290px; z-index:10008; display:none;\'>");
//document.writeln("<img src=\'http://www.ysg.cn/templets/ysg/images/shangwutong88.gif\'  width=\'580\' height=\'350\' class=\'img_shadow\' usemap=\'#swt_center\' border=\'0\'/><map name=\'swt_center\'><area  shape=\'rect\' coords=\'542,0,580,35\' href=\'javascript:;\' onclick=\'yicang()\'  /><area shape=\'poly\' coords=\'1,0,535,1,536,40,580,40,580,354,-8,349\' href=\'http://m.3198.com/choujiang/index.html'  /></map></div>");

document.writeln("<div id=\'dingwei\' style=\'width:463; height:257;  position:fixed; left:50%; top:50%; margin:-175px 0 0 -230px; z-index:10008; display:none;\'>");
document.writeln("<img src=\'/public/images/swt.png\' width=\'463\' height=\'257\' class=\'img_shadow\' usemap=\'#swt_center\' border=\'0\'/><map name=\'swt_center\'><area  shape=\'rect\' coords=\'423,1,461,36\' href=\'javascript:;\' onclick=\'yicang()\'  /><area shape=\'poly\' coords=\'3,3,420,3,420,37,460,39,462,253,4,254\' href=\'http://m.3198.com/choujiang/index.html\' target=\'_blank\'  /></map></div>");

var LiveAutoInvite0='';
var LiveAutoInvite1='';
var LrinviteTimeout=1;
var LR_next_invite_seconds = 3;
//商务通弹出图片
if (!getCookie('choujiangIsAction')) {
	setTimeout("chuxian()", 4000);
}


function chuxian(){
	document.getElementById('dingwei').style.display='block';
}


function yicang(){
	setCookie('choujiangIsAction', 1)
	document.getElementById('dingwei').style.display='none';

}

function setCookie(name, value) {
	var Days = 30;
	var exp = new Date();
	exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
	document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
}


//读取cookies
function getCookie(name) {
	var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");

	if (arr = document.cookie.match(reg))

		return unescape(arr[2]);
	else
		return null;
}
;

