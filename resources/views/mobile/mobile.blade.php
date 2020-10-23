<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <meta name="wap-font-scale" content="no"/>
    <meta name="format-detection" content="telephone=no">
    <meta name="applicable-device" content="mobile">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <meta name="csrf-token" content=" {{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="description" content="@yield('description')"/>
    <link rel="canonical" href="{{config('app.url')}}{{Request::getrequesturi()}}" >
    <link href="/mobile/css/common.css" rel="stylesheet" type="text/css"/>
    <link href="/mobile/css/iconfont.css" rel="stylesheet" type="text/css"/>
    <link href="/mobile/css/swiper.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="clearfix anxjm-mtop84">
    <div class="search clearfix">
        <div class="logo fl">
            <a href="/"><img src="/mobile/images/logo.png" alt="3198创业致富网"/></a>
        </div>
        <div class="searchCon fl">
            <form action="/search" method="get">
                {{csrf_field()}}
                <div class="ipt-box"></div>
                <input class="ipt-placeholder" name="key" placeholder="输入您想找的项目" />
                <input type="hidden" name="type" value="1">
                <button type="submit" class="search_btn"></button>
            </form>
        </div>
        <div class="message fr">
            <b>项目分类</b>
        </div>
        <div class="d_nav">
            <ul>
                <li><a href="/" target="_self"><span>首页</span></a></li>
                <li><a href="/xm" target="_self"><span>项目大全</span></a></li>
                <li><a href="/cyms" target="_self"><span>餐饮</span></a></li>
                <li><a href="/fzxb" target="_self"><span>服装</span></a></li>
                <li><a href="/mrbj" target="_self"><span>美容</span></a></li>
                <li><a href="/shfw" target="_self"><span>服务</span></a></li>
                <li><a href="/jjyp/" target="_self"><span>家居</span></a></li>
                <li>热门行业</li>
                <li><a href="/jczs/" target="_self"><span>建材</span></a></li>
                <li><a href="/lpsp" target="_self"><span>礼品</span></a></li>
                <li><a href="/qcfw" target="_self"><span>汽车</span></a></li>
                <li><a href="/jywl" target="_self"><span>教育</span></a></li>
                <li><a href="/myyp" target="_self"><span>母婴</span></a></li>
                <li><a href="/shfw/179" target="_self"><span>干洗</span></a></li>
                <li><a href="/cyms" target="_self"><span>火锅</span></a></li>
                <li><a href="/fcyms/3" target="_self"><span>饮品</span></a></li>
                <li><a href="/cyms/204" target="_self"><span>烧烤</span></a></li>
                <li><a href="/cyms/2" target="_self"><span>小吃</span></a></li>
            </ul>
        </div>
    </div>
</div>

@yield('main_content')

<div class="clearfix">
    <div class="related-tit bg-fff mgt20 tabs-tit">
        <b>隐私保护</b>
        <div class="btn-one-more fr">
        </div>
    </div>
    <div class="tabs-ctn">
        <ul class="content1 cy-item ">
            <li><a href="javascript:;">
                    <p class="online-name1">1. 投资有风险，加盟需谨慎</p>
                    <p class="online-name1">2.多打电话、多咨询、实地考察，可降低投资风险！</p>
                    <p class="online-name1">3. 我方平台为信息发布平台，内容由用户自行提供，内容的真实性、准确性由用户自行负责，本平台对此不承担任何法律风险</p>
                    <p class="online-name1">4. 网站信息如涉嫌违规或违反相关法律规定，请联系我们，我们删除</p>
                </a>
            </li>
        </ul>
    </div>
</div>
<footer>
    <div class="link-box ">
        <a href="{{config('app.url')}}" class="foot-link">电脑版</a><span class="v-line">|</span>
        <a href="/xm/" class="foot-link">品牌大全</a><span class="v-line">|</span>
        <a href="/about.html" class="foot-link" rel="nofollow">关于我们</a><span class="v-line">|</span>
        <a href="/contact.html" class="foot-link"  rel="nofollow">联系我们</a><span class="v-line">|</span>
        <a href="/copyright.html" class="foot-link"  rel="nofollow">法律声明</a>
    </div>
    <p class="firm clearfix">
        <span class="foot-text mgr15">上海佐赛网络科技有限公司 	 版权所有</span>
    </p>
</footer>
<script type="text/javascript" src="/mobile/js/jquery.min.js"></script>
<script type="text/javascript" src="/mobile/js/swiper.min.js"></script>
<script type="text/javascript" src="/mobile/js/index.js"></script>
@yield('footer_libs')
</body>
</html>
