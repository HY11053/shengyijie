function abc(){
    $('#k_s_ol_inviteWin').fadeOut(600).delay(45000).fadeIn(function(){openSwt();})
}
function openSwt() {
    $("#k_s_ol_inviteWin").css('visibility','visible').fadeIn(600);
}
setTimeout(openSwt,20000);

(function (doc, win) {
    var docEl = doc.documentElement,
        resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
        recalc = function () {
            var clientWidth = docEl.clientWidth;
            if (!clientWidth) return;
            docEl.style.fontSize = 100 * (clientWidth / 640) + 'px';
        };
    if (!doc.addEventListener) return;
    win.addEventListener(resizeEvt, recalc, false);
    doc.addEventListener('DOMContentLoaded', recalc, false);
})(document, window);
//选项卡收起
var  ind1 = 1, ind2 = 1, ind3 = 1;
var arr = [ind1, ind2, ind3];
function tabsNext(o, i) {
    var tabsCTN = $(o).parents(".tabs-tit").next(".tabs-ctn");
    var indLen = tabsCTN.children().length;
    tabsCTN.children().hide().eq(arr[i]).show();
    arr[i]++;
    if (arr[i] == indLen) {
        arr[i] = 0;
    }
}

$(function () {
    $(".search .message b").click(function(){
        $('.d_nav').slideToggle();
    });
    $(".favor-header-bar ul li").click(function () {
        $(".news-content").hide().eq($(this).index()).show();
        $(this).addClass("on").siblings().removeClass("on");
    });
    //查看更多
    $(".wec_tftable").css('width','100%');
    $(".display").on("click",function(){
        $(this).hide()
        $(".jm_xq_con").removeClass("on")
        $(this).next().show()
    });
    $(".hidden").on("click",function(){
        $(this).hide()
        $(this).prev().show()
        $(".jm_xq_con").addClass("on")
    })
    $(".a_content img").attr({"width":"100%",'height':'auto'}).addClass("img-responsive center-block").css('width','100%').css('height','auto').css('border-radius','5px');
    $(".jm_xq_con img").attr({"width":"100%",'height':'auto'}).addClass("img-responsive center-block").css('height','auto').css('width','100%').css('border-radius','5px');
});
var mySwiper = new Swiper ('.swiper-container', {
    direction: 'horizontal',
    loop: true,
    autoplay: {
        delay: 5000,
        stopOnLastSlide: false,
        disableOnInteraction: true,
    },
    pagination: {
        el: '.swiper-pagination',
    },
})

$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#tj_btn").click(function(){
        var phoneno = $("#phonenum").val();
        var name = $("#guestname").val();
        var note = $("#note").val();
        var project_id = $("#project_id").val();
        var cid = $("#cid").val();
        var title = $("#fm_title").val();
        var cla = $("#cla").val();
        var combrand = $("#combrand").val();
        var host=window.location.href;
        if( phoneno  && /^1[3|4|5|8]\d{9}$/.test(phoneno) ){
            $.ajax({
                //提交数据的类型 POST GET
                type:"POST",
                //提交的网址
                url:"/phonecomplate",
                //提交的数据
                data:{"phoneno":phoneno,"host":host,"name":name,"note":note,"project_id":project_id,"cid":cid,"title":title,"cla":cla,"combrand":combrand},
                //返回数据的格式
                datatype: "html",    //"xml", "html", "script", "json", "jsonp", "text"
                success:function (response, stutas, xhr) {
                    alert(response);
                }
            });
        } else{
            alert("您输入的手机号码"+phoneno+"不正确，请重新输入")
        }
    });
//弹窗
    $("#msg_sub").click(function(){
        var phoneno = $("#msg_phone").val();
        var name = $("#msg_name").val();
        var project_id = $("#msg_project_id").val();
        var cid = $("#msg_cid").val();
        var title = $("#msg_fm_title").val();
        var cla = $("#msg_cla").val();
        var combrand = $("#msg_combrand").val();
        var host=window.location.href+'?referer=tc';
        if( phoneno  && /^1[3|4|5|8]\d{9}$/.test(phoneno) ){
            $.ajax({
                //提交数据的类型 POST GET
                type:"POST",
                //提交的网址
                url:"/phonecomplate/",
                //提交的数据
                data:{"phoneno":phoneno,"host":host,"name":name,"project_id":project_id,"cid":cid,"title":title,"cla":cla,"combrand":combrand},
                //返回数据的格式
                datatype: "html",    //"xml", "html", "script", "json", "jsonp", "text"
                success:function (response, stutas, xhr) {
                    alert(response);
                }
            });
        } else{
            alert("您输入的手机号码"+phoneno+"不正确，请重新输入")
        }
    });
    //弹窗留言
    $("#js_popup,.js_popup").click(function(){
        $(".popup_mask").show();
    });
    $(".popup_close").click(function(){
        $(".popup_mask").stop();
        $(".popup_mask").fadeOut(600).delay(35000).fadeIn(function(){openSwt();})
    });
});
function openSwt() {
    $(".popup_mask").css('visibility','visible').fadeIn(600);
}
setTimeout(openSwt,20000);

