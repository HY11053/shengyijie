<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="applicable-device" content="pc" />
    <meta name="csrf-token" content=" {{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="description" content="@yield('description')"/>
    <link href="/public/css/daohang.css" rel="stylesheet" type="text/css"/>
    <link href="/public/css/css.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/public/js/index.js"></script>
    <!--[if lte IE 6]>
    <script type="text/javascript" src="/public/js/DD_belatedPNG_0.0.7a.js"></script>
    <script>
        DD_belatedPNG.fix('.png_bg,.png_bg a:hover,.all_sort_all ul li a span');
    </script>
    <![endif]-->
    @yield('headlibs')
</head>
<body>
<!--header 开始-->
<div class="header">
    <div class="top">
        <div class="inner">
            <div class="top_l"> 欢迎您来到生意杰致富网！
                <a href="/news"><span>商机资讯</span></a>
            </div>
            <div class="top_r">
                <div class="phone_app" id="js_phone_app">
                    <div class="t_mobile">手机APP<i class="ico_dropdown"></i></div>
                    <div class="app_drop_down"><i class="app_download"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="header_box_wrap">
        <div class="header_box">
            <div class="logo"><a href="/" target="_blank"><img src="/public/images/logo.jpg" alt="3198创业致富网"/></a></div>
            <!--搜索 开始-->
            <div class="search">
                <div class="search_box">
                    <form id="search_form" action="/search" target="_blank" method="get">
                        <input type="text"
                               onblur="if (this.value == '') {this.value = this.attributes['def'].value;this.className='search_input';}"
                               onfocus="if (this.value == this.attributes['def'].value) {this.value='';this.className='search_input1';}"
                               def="想找什么项目？" class="search_input" value="想找什么项目？" name="key">
                        <input type=hidden name="type" value="1"/>
                        <input type="submit" class="search_btn" value="搜索">
                    </form>
                </div>
                <div class="search_hot">热门搜索：
                    <a href="/search?key=黄焖鸡米饭&type=1" target="_blank">黄焖鸡米饭加盟</a>
                    <a class="red" href="/search?key=小吃&type=1" target="_blank">特色小吃加盟</a>
                    <a href="/search?key=冒菜&type=1" target="_blank">冒菜加盟</a>
                    <a href="/search?key=奶茶&type=1" target="_blank">奶茶加盟店</a>
                </div>
            </div>
            <!--搜索 结束-->

            <!--幻灯片 开始-->
            <div id="js_bn" class="bn">
                <div class="hd">
                    <ul>
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </ul>
                </div>
                <div class="bd">
                    <ul>
                        <li><a href="/myyp" target="_blank"><img src="/public/images/myjmd.jpg" width="220" height="64"
                                                                 alt=""/></a></li>
                        <li><a href="/myyp/223" target="_blank"><img src="/public/images/yyjm.jpg" width="220"
                                                                     height="64" alt=""/></a></li>
                        <li><a href="/cyms/2" target="_blank"><img src="/public/images/tsxc.jpg" width="220" height="64"
                                                                   alt=""/></a></li>
                    </ul>
                </div>
            </div>
            <!--幻灯片 结束-->
        </div>
    </div>
    <script type="text/javascript" src="/public/js/jquery.SuperSlide.2.1.1.js"></script>
    <!--导航 开始-->
    <div class="nav_bj">
        <div class="nav">
            <ul class="sy1_ul">
                <div class="sy2_inside">
                    <li class="home02"><a href="/">首页</a></li>
                    @foreach(\App\AdminModel\Arctype::where('mid',1)->get(['typename','real_path']) as $typeinfo)
                        <li class="sy1_li navli1">
                            <a class="sy1_tit " href="/{{$typeinfo->real_path}}"><span class="navspan"> {{$typeinfo->typename}}</span></a>
                        </li>
                    @endforeach
                    <div class="clearit"></div>
                </div>
            </ul>
        </div>
    </div>
    <script src="/public/js/main1.js"></script>
    <script src="/public/js/shouye_tab.js"></script>
    <script>
        $(document).ready(function () {
            $(".tc").find(".tz_box").hide(0);
            $(".tc").hover(
                function () {
                    $(this).css("z-index", "20").find(".tz_box").css("z-index", "50").stop(true, true).animate({opacity: "show"});
                },
                function () {
                    $(this).css("z-index", "1").find(".tz_box").css("z-index", "1").stop(true, true).animate({opacity: "hide"});
                }
            );
            $(".search_text").focus(function () {
                $(this).addClass("focus");
            }).blur(function () {
                $(this).removeClass("focus");
            });
        })
    </script>
    <!--导航 结束--></div>
<!--header 结束-->
<!--主体开始-->
@yield('main')
<!--主体结束-->
<div class="clearfix"></div>
<!--footer开始-->
<!--footer开始-->
<div class="footer">
    <div class="footer_nav">
        <a href="/about.html">关于我们</a>　|　<a href="/sitemap.html">网站地图</a>　|　<a href="/copyright.html">法律声明</a>　|　<a
            href="/contact.html">联系我们</a>
    </div>
    <div class="cert"><img src="/public/images/index07.jpg" alt="信用保障"/></div>
    <div class="copyright">
        <p>3198创业致富网友情提示：多打电话、多咨询、实地考察，可降低投资风险！</p>
        <p>Copyright © 2015 www.3198.com Corporation, All Rights Reserved 上海佐赛网络科技有限公司 版权所有</p>
        <p><a href="http://www.miitbeian.gov.cn" rel="nofollow" target="_blank">沪ICP备14037163号-32</a></p>
        <p><a href="/flgw.html" rel="nofollow">本站常年法律顾问：曹憬律师</a></p>
        <div style="width:300px;margin:0 auto; padding:20px 0;">
            <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=31011302003783"
               style="display:inline-block;text-decoration:none;height:20px;line-height:20px;">
                <img src="/public/images/ba.png" style="float:left;"/>
                <p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#939393;">沪公网安备
                    31011302003783号</p></a>
        </div>
    </div>
</div>
<!--footer结束--><!--footer结束-->
@yield('footer_libs')
</body>
</html>
