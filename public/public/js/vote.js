$(function() {

       var like=$("input[name='like']").val();
       var unlike=$("input[name='unlike']").val();
       var statusx=$("input[name='status']").val();
	var htmlia='<div class="dingcai clearfix">';
		    htmlia+='<a href="javascript:void(0);"   class="news_ding"><strong>顶</strong><span class="ding">'+like+'</span></a>';
        htmlia+='<a href="javascript:void(0);"   class="news_cai"><strong>顶</strong><span class="cai">'+unlike+'</span></a>';
  htmlia+='</div>';

        htmlia+='<div class="tancbg" ></div>';
        htmlia+='<div class="tanc">';
          htmlia+='<div class="pinta-1">';
              htmlia+='<div class="bth2"><a class="tc_cai_close" href="javascript:void(0);">×</a>您想看的招商具体信息</div>';
              htmlia+='<div class="pinta-2">';
                  htmlia+='<form method="post" class="registerform" name="form1">';
                    htmlia+='<ul>';
                       htmlia+='<li style="height:120px;"><strong><code>*</code>提交问题：</strong>';
                       htmlia+='<textarea placeholder="请尽量提交详细的建议，以便我们做出更优秀、更有价值的内容！" class="pinta-textarea" id="content" name="text"></textarea></li>';
                       htmlia+='<li><strong><code>*</code>联系方式：</strong>';
                       htmlia+='<input type="text" placeholder="QQ/电话/邮件均可，以便我们与您取得必要的联系" class="pinta-text2" name="contact"></li>';
                       htmlia+='<li style="height:37px; padding-left:104px;">';
                       htmlia+='<input type="button" class="pinta-submit" value="提交留言" onClick="userCheck()"></li></ul>';

                    htmlia+='</ul>'

                  htmlia+='</form>';
              htmlia+='</div>';

          htmlia+='</div>';

          htmlia+='<div class="pinta-3">';
               htmlia+='<ul>';
                   htmlia+='<li><strong>提交说明：</strong></li>';
                   htmlia+='<li>1.为了让我们提供更专业、更实用的内容，我们鼓励您提供尽量详细的反馈信息。</li>';
                   htmlia+='<li>2.我们建议您留下您的联系方式，以便我们能与您取得联系！</li>';

               htmlia+='</ul>'

          htmlia+='</div>';

        htmlia+='</div>';


$(".liuyan_wx").before(htmlia);


$('.news_cai').click(function(){
          var vid = $("input[name='vid']").val();
          var status=statusx;
           var cai=parseInt($(".cai").html())+1;

         $.post("/feedbac", { vid:vid,status:status},
         function(data){
          var data1=$.parseJSON(data);
           if(data1.status=="faile")
           {
              alert("您今天已经踩过！！");
           }
           if(data1.status=="done")
           {
             $(".cai").html(cai);
              $('.tancbg').show();
             $('.tanc').show();
           }
      });

  });
  $('.tc_cai_close').click(function(){
    $('.tancbg').hide();
    $('.tanc').hide();
  });
  $('.tancbg').click(function(){
    $(this).hide();
    $('.tanc').hide();
  });

    $('.news_ding').click(function(){
      var vid = $("input[name='vid']").val();
          var status=statusx;
           var ding=parseInt($(".ding").html())+1;

         $.post("/feedback", { vid:vid,status:status},
         function(data){
          var data1=$.parseJSON(data);
           if(data1.status=="faile")
           {
              alert("您今天已经顶过！！");
           }
           else if(data1.status=="done")
           {
              $(".ding").html(ding);

           }

      });

  });


});
