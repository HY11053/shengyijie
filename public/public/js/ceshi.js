$(function() { 
    
       var title=$("input[name='title']").val();
       var cla=$("input[name='combrand']").val();
       var combrand=$("input[name='combrand']").val();


	var htmlzhuijia='<div class="liuyan_wx" style="font-size:12px;"></div><div class="liuyan_ka">';
		    htmlzhuijia+='<span style="color:gray;margin-left:58px;">加盟提醒：多留言、多咨询、可获得更精准的加盟帮助</span>';
		   htmlzhuijia+='<div class="clearfix" style="background-color:#fff; padding:0 0 14px 20px;font-size:12px;">';
                 htmlzhuijia+='<div class="liuyan_k">';
                      htmlzhuijia+='<form  method="post" action="https://i.u88.com/store"  id="dform" onsubmit="return check();" >';
                      htmlzhuijia+='<input type="hidden" name="job" value="guestbook"><input type="hidden" name="realm" value="www.3198.com">';
                      htmlzhuijia+="<input type='hidden' name='title' value="+title+"/>";
                      htmlzhuijia+="<input type='hidden' name='cla' value="+cla+">";
                      htmlzhuijia+="<input type='hidden' name='combrand' value="+combrand+">";
                      htmlzhuijia+="<input type='hidden' name='resolution' value='resolution'/>";
                      htmlzhuijia+='<ul>';
                      htmlzhuijia+='<li><strong><code>*</code>姓名：</strong><input type="text" class="ly_text1" name="username" id="truename"/><input name="x" type="radio" class="ly_radio"/><em>先生</em><input  name="x" type="radio"  class="ly_radio"/><em>女士</em></li>';
                      htmlzhuijia+='<li><strong><code>*</code>手机：</strong><input type="text" class="ly_text1" name="iphone"  id="telephone"/></li><li><strong>邮箱：</strong><input type="text" class="ly_text2"  name="email" id="email" /></li><li><strong>地址：</strong><input type="text" class="ly_text2"  name="adr" id="adr"/></li><li style="height:99px;"><strong><code>*</code>留言：</strong><textarea id="content"  name="content" class="ly_textarea"  ></textarea>';
                      htmlzhuijia+='<div class="kjly">+快捷留言</div>';
                      htmlzhuijia+='<div id="msgList" class="ly_msglist">';
                      htmlzhuijia+='<h3><div class="close_jhly">&times;</div>您可以选择已下快捷留言 ↓</h3>';
                      htmlzhuijia+='<ul>';
                      htmlzhuijia+='<li><a onclick="avals(this);" href="javascript:;">我有意向，请问加盟费是多少?</a></li><li><a onclick="avals(this);" href="javascript:;">很想合作，来电话细谈吧。</a></li><li><a onclick="avals(this);" href="javascript:;">请问具体加盟流程是怎么样的?</a></li><li><a onclick="avals(this);" href="javascript:;">请问贵公司哪里有样板店或直营店？</a></li><li><a onclick="avals(this);" href="javascript:;">请给我打电话，并寄送加盟资料。</a></li>';

                      htmlzhuijia+='</ul>';

                      htmlzhuijia+='</div>';
                      htmlzhuijia+='<li style="height:37px; padding-left:104px;"><input type="submit" value="提交留言" class="ly_submit" /></li>';
                      htmlzhuijia+='</ul>';


                
                      htmlzhuijia+='</form>';
                 htmlzhuijia+='</div>';
	       htmlzhuijia+='</div>';
           
	htmlzhuijia+='</div>';
		
     
$("#zhuijia").before(htmlzhuijia);
});
