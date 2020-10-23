$(function() { 
    
       var titlex=$("input[name='title']").val();
       var clax=$("input[name='cla']").val();
       var combrandx=$("input[name='combrand']").val();


	var htmlzhuijiax='<div class="liuyan_wx" style="font-size:12px;"></div><div class="liuyan_ka">';
		    htmlzhuijiax+='<span style="color:gray;margin-left:58px;">加盟提醒：多留言、多咨询、可获得更精准的加盟帮助</span>';
		   htmlzhuijiax+='<div class="clearfix" style="background-color:#fff; padding:0 0 14px 20px;font-size:12px;">';
                 htmlzhuijiax+='<div class="liuyan_k">';
                      htmlzhuijiax+='<form  method="post" action="http://message.5988.com/index.php/my_ci/into/"  id="dform" onsubmit="return check();" >';
                      htmlzhuijiax+='<input type="hidden" name="job" value="guestbook"><input type="hidden" name="realm" value="www.5988.com">';
                      htmlzhuijiax+="<input type='hidden' name='title' value="+titlex+"/>";
                      htmlzhuijiax+="<input type='hidden' name='cla' value="+clax+"/>";
                      htmlzhuijiax+="<input type='hidden' name='combrand' value="+combrandx+"/>";
                      htmlzhuijiax+="<input type='hidden' name='resolution' value='resolution'/>";
                      htmlzhuijiax+='<ul>';
                      htmlzhuijiax+='<li><strong><code>*</code>姓名：</strong><input type="text" class="ly_text1" name="username" id="truename"/><input type="radio" class="ly_radio"/><em>先生</em><input type="radio"  class="ly_radio"/><em>女士</em></li>';
                      htmlzhuijiax+='<li><strong><code>*</code>手机：</strong><input type="text" class="ly_text1" name="iphone"  id="telephone"/></li><li><strong>邮箱：</strong><input type="text" class="ly_text2"  name="email" id="email" /></li><li><strong>地址：</strong><input type="text" class="ly_text2"  name="adr" id="adr"/></li><li style="height:99px;"><strong><code>*</code>留言：</strong><textarea id="content"  name="content" class="ly_textarea"  ></textarea>';
                      htmlzhuijiax+='<div class="kjly">+快捷留言</div>';
                      htmlzhuijiax+='<div id="msgList" class="ly_msglist">';
                      htmlzhuijiax+='<h3><div class="close_jhly">&times;</div>您可以选择已下快捷留言 ↓</h3>';
                      htmlzhuijiax+='<ul>';
                      htmlzhuijiax+='<li><a onclick="avals(this);" href="javascript:;">我有意向，请问加盟费是多少?</a></li><li><a onclick="avals(this);" href="javascript:;">很想合作，来电话细谈吧。</a></li><li><a onclick="avals(this);" href="javascript:;">请问具体加盟流程是怎么样的?</a></li><li><a onclick="avals(this);" href="javascript:;">请问贵公司哪里有样板店或直营店？</a></li><li><a onclick="avals(this);" href="javascript:;">请给我打电话，并寄送加盟资料。</a></li>';

                      htmlzhuijiax+='</ul>';

                      htmlzhuijiax+='</div>';
                      htmlzhuijiax+='<li style="height:37px; padding-left:104px;"><input type="submit" value="提交留言" class="ly_submit" /></li>';
                      htmlzhuijiax+='</ul>';


                
                      htmlzhuijiax+='</form>';
                 htmlzhuijiax+='</div>';
	       htmlzhuijiax+='</div>';
           
	htmlzhuijiax+='</div>';
		
     
$("#tuisong").before(htmlzhuijiax);
});


