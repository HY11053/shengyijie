@extends('frontend.frontend')
{{--@section('title'){{config('app.webname')}}@stop
@section('keywords'){{config('app.keywords')}}@stop
@section('description'){{config('app.description')}}@stop--}}
@section('headlibs')
    <link href="/public/css/search.css" rel="stylesheet" type="text/css" />
    <script src="/public/js/lanrenzhijia.js" type="text/javascript"></script>
    <script type="text/javascript" src="/public/js/index.js"></script>
@stop
@section('main')
<div class="search_select search_selectaa">
    <ul>
        <li s_type="project" type=1 class=searchOn title="项目"><a href='/search?type=1&key={{$key}}' style="cursor:pointer;">项目</a></li>
        <li s_type="news" type=2  title="知识"><a href="/search?type=2&key={{$key}}" style="cursor:pointer;">知识</a></li>
        <li s_type="article" type=3  title="资讯"><a href="/search?type=3&key={{$key}}" style="cursor:pointer;">资讯</a></li>
    </ul>
</div>
<div class="search_jg">3198为您找到与<b style="color:red;">『{{$key}}』</b>相关结果约 {{$articles->total()}} 个</div>
<div class="bk weizhi_locations" style="margin-top:4px;">
        <span>
        <a href="/" target="_blank">{{config('app.indexname')}}</a>
        >
        <a>『{{$key}}』</a>
        </span>
</div>

<!--搜索 End-->
<script type="text/javascript">

    $(function(){setTimeout(onWidthChange,1000)})

    function onWidthChange()
    {
        if( $(window).width() < 1110 ) {
            $("#search_box").addClass('search_box2')

        }
        setTimeout(onWidthChange,1000);
    }
</script>

<div class="clearfix" style="text-align:left;" id="search_box" >

    <div class="m_xm_c">
        <div class="s_xm_list" >
            <ul>
                @foreach($articles as $article)
                <li class="clearfix">
                    <h3><a href="/{{$path}}/{{$article->id}}">{{$article->title}}</a></h3>
                    <p>
                        {{$article->description}}</p>
                    <p class="hs">{{config('app.url')}}/{{$path}}/{{$article->id}}&nbsp;&nbsp;{{date('Y-m-d',strtotime($article->created_at))}}</p>
                </li>
                @endforeach

            </ul>

            <script>
                var jingguo = $('.s_xm_list ul li');
                jingguo.bind('mouseover', function (){
                    $(this).addClass('jg');
                });
                jingguo.bind('mouseout', function (){
                    $(this).removeClass('jg');
                });
            </script>
            <div class="page">
            </div>
        </div>
    </div>

    <div class="s_right">

        <a href="/xm"><img src="/public/images/find_240x80.jpg" /></a>

        <div class="s_tjpp">
            <h2>最新入住商家</h2>
            <ul class="clearfix">
                @foreach($latestbrands as $latestbrand)
                <li>
                    <span><a href="/xm/{{$latestbrand->id}}"><img src="{{$latestbrand->litpic}}" alt="{{$latestbrand->brandname}}" /></a></span>
                    <strong><a href="/xm/{{$latestbrand->id}}">{{$latestbrand->brandname}}</a></strong>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@stop
