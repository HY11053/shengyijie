@extends('frontend.frontend')
@section('title')联系我们 - 3198创业致富网@stop
@section('keywords')联系我们@stop
@section('description')联系我们@stop
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
            <span><a href="/" target="_blank">3198创业致富网</a>&gt;<a target="_blank">联系我们</a></span>
        </div>
        <div style="border-top:2px solid #d81f13;margin-top:10px;"></div>

        <div class="about_us">
            <div class="h2">联系我们</div>
            <p>上班时间：周一至周六8：30－17：30</p>
            <p>下班时间：可通过在线客服或在留言栏填地址索取加盟资料</p>
            <p>商务合作：17091425988</p>
            <p>联系人：伍经理 </p>
            <p>网址：http://www.3198.com/</p>
            <p>地址：中国上海市沪太路3100号尚大国际D座513室</p>
        </div>
        <br>
        <a href="http://www.3198.com/" target="_blank"><img src="/public/images/bu5.jpg"></a>
    </div>
@stop

