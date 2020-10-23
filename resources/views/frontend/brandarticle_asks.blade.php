@extends('frontend.frontend')
@section('title'){{$thisArticleInfos->brandname}}问答- {{config('app.indexname')}}@stop
@section('keywords'){{$thisArticleInfos->brandname}}@stop
@section('description'){{$thisArticleInfos->brandname}}问答提供关于{{$thisArticleInfos->brandname}}的各种问题和解答@stop
@section('headlibs')
    <script src="/public/js/lanrenzhijia.js" type="text/javascript"></script>
    <script type="text/javascript" src="/public/js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" src="/public/js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="/public/js/MSClass.js"></script>
    <meta http-equiv="mobile-agent" content="format=wml; url={{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" />
    <meta http-equiv="mobile-agent" content="format=xhtml; url={{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" />
    <meta http-equiv="mobile-agent" content="format=html5; url={{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" />
    <link rel="alternate" media="only screen and(max-width: 640px)" href="{{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" >
    <link rel="canonical" href="{{config('app.url')}}/{{Request::path()}}"/>
@stop
@section('main')
    <!--主体开始-->
    <div class="main">
        <div class="bk weizhi_locations" style="margin-top:4px;">
            <span><a href="/">{{config('app.indexname')}}</a>&gt;<a href="/{{$thisArticleTopTypeInfo->real_path}}/{{$thisArticleTypeInfo->id}}">{{$thisArticleTypeInfo->typename}}</a>&gt;<a href="/xm/{{$thisArticleInfos->id}}">{{$thisArticleInfos->brandname}}连锁</a>&gt;<a class="dq">新闻</a></span>
        </div>
        @include('frontend.brand_header')
        <div class="clearfix"></div>

        <div class="ny_l">
            <div class="ny_l-js">
                <ul class="ny-list">
                    @foreach($brandasks as $brandask)
                        <li>
                            <div class="ny-list1"> <strong><a href="/zhishi/{{$brandask->id}}">{{$brandask->title}}</a></strong>
                                <i>{{date('Y-m-d',strtotime($brandask->created_at))}}</i>
                            </div>
                            <div class="ny-list2">
                                {{$brandask->description}}
                            </div>
                            <div class="ny-list3">
                                <i><a href="/zhishi/{{$brandask->id}}">阅读全文</a></i>
                            </div>
                        </li>
                    @endforeach
                    <div class="page clearfix">
                    </div>
                </ul>
            </div>
            <!--主体结束-->
            <div class="clearfix"></div>
            @include('frontend.liuyan')
        </div>
        @include('frontend.brand_right')
    </div>
@stop
