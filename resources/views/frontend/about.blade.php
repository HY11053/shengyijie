@extends('frontend.frontend')
@section('title')关于我们 - 3198创业致富网@stop
@section('keywords')关于我们@stop
@section('description')关于我们@stop
@section('headlibs')
    <script src="/public/js/lanrenzhijia.js" type="text/javascript"></script>
    <script type="text/javascript" src="/public/js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" src="/public/js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="/public/js/MSClass.js"></script>
    <link href="/public/css/news1.css" rel="stylesheet" type="text/css" />
    <meta http-equiv="mobile-agent" content="format=wml; url={{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" />
    <meta http-equiv="mobile-agent" content="format=xhtml; url={{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" />
    <meta http-equiv="mobile-agent" content="format=html5; url={{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" />
    <link rel="alternate" media="only screen and(max-width: 640px)" href="{{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" >
    <link rel="canonical" href="{{config('app.url')}}/{{Request::path()}}"/>
@stop
@section('main')
    <div class="box clearfix" style="position:relative;">

        <div class="weizhi_locations1">
            <span><a href="/" target="_blank">3198创业致富网</a>&gt;<a target="_blank">关于我们</a></span>
        </div>
        <div style="border-top:2px solid #d81f13;margin-top:10px;"></div>

        <div class="about_us">
            <div class="h2">关于我们</div>
            <p>3198创业致富网隶属于上海佐赛网络科技有限公司，是由国内著名企业——UCC国际洗衣集团投资成立，是深受投资者喜爱的招商信息平台，是权威的互联网方案解决商。</p><br>
            <p>3198致力于为每一位加盟商提供最齐全的加盟项目、最权威的加盟知识和最及时的加盟资讯，帮助加盟商开一家最成功的加盟店。网站目前项目涵盖餐饮美食、服装鞋包、美容保健、生活服务、家居用品、汽车服务等12个大类别、上百种小类别，包含上万个精品商机项目，能够完全满足不同投资者多元化的投资需求。而且，除了丰富的加盟项目，网站还拥有权威的行业加盟知识和实时的加盟资讯，让投资者掌握加盟的小技巧，了解加盟的最新消息，帮助投资者抢占加盟市场的先机，让投资者走向成功之路！</p><br>
            <p><b>对于投资者：</b></p>
            <p>我们帮您寻找最值得信赖的商家，最值得投资的项目</p>
            <p>我们保证每一位商家都是有信誉的好商家，加盟骗局绝不会出现</p>
            <p>我们拥有上万个投资项目，相信总有一款适合您</p><br>

            <p><b>对于品牌商：</b></p>
            <p>我们帮您找到对您项目最感兴趣的投资者</p>
            <p>我们的推广方式安全可靠见效快，让您轻松找到目标顾客</p>
            <p>我们是专业的招商信息平台，推广合作有保障，免去您的后顾之忧</p><br>

            <p>上3198创业致富网，轻松找到投资好项目，一本万利不是梦！</p><br>

        </div>
        <a href="http://www.3198.com/" target="_blank"><img src="/public/images/bu5.jpg"></a>

    </div>
@stop

