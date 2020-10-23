@extends('frontend.frontend')
@section('title'){{config('app.webname')}}@stop
@section('keywords'){{config('app.keywords')}}@stop
@section('description'){{config('app.description')}}@stop
@section('headlibs')
<meta http-equiv="mobile-agent" content="format=wml; url={{str_replace('http://www.','http://m.',config('app.url'))}}/" />
    <meta http-equiv="mobile-agent" content="format=xhtml; url={{str_replace('http://www.','http://m.',config('app.url'))}}/" />
    <meta http-equiv="mobile-agent" content="format=html5; url={{str_replace('http://www.','http://m.',config('app.url'))}}/" />
    <link rel="alternate" media="only screen and(max-width: 640px)" href="{{str_replace('http://www.','http://m.',config('app.url'))}}/" >
    <link rel="canonical" href="{{config('app.url')}}{{Request::getrequesturi()}}/"/>
@stop
@section('main')
    <div class="main">
        <div class="index_l fl">
            <div id="js_bnn" class="bnn">
                <div class="hd">
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div class="bdd">
                    <ul>
                        <li> <a target="_blank" href="/xm/3080"><img src="/uploads/images/2016/04-12/ea207c9800be.jpg" alt="上臣地板加盟"/></a></li>
                        <li><a target="_blank" href="/xm/3067"><img src="/uploads/images/2016/04-12/c70320578956.jpg" alt="帽牌货冒菜加盟"/></a></li>
                        <li><a target="_blank" href="/xm/3088"> <img src="/uploads/images/2016/04-12/fe4d60a22d50.png" alt="禾禾面吧加盟"/></a></li>
                        <li><a target="_blank" href="/xm/3100"><img src="/uploads/images/2016/04-12/22d0cfdd5694.jpg" alt="鱼乐贝贝加盟"/></a></li>
                    </ul>
                </div>
            </div>
            <div class="index_jm" id="js_index_jm">
                <div class="index_jm_tab">
                    <ul>
                        <li class="on"><a href="/news" target="_blank">商机资讯</a></li>
                        <li><a href="/xm" target="_blank">加盟品牌</a></li>
                    </ul>
                </div>
                <div class="index_jm_cont">
                    <div class="index_jm_list">
                        <ul>
                            @foreach($latestnewslists as $latestnewslist)
                                <li><a href="/news/{{$latestnewslist->id}}" target="_blank">{{$latestnewslist->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="index_jm_list">
                        <ul>
                            @foreach($latestbrandlists as $latestbrandlist)
                            <li><a href="/xm/{{$latestbrandlist->id}}" target="_blank">{{$latestbrandlist->brandname}}</a> </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="index_r fr">
            <div class="index_r_jiameng"><span class="ic1"><strong><i>精品商机项目</i></strong><em>35167</em>个</span>
                <span><strong><i>创业知识</i></strong><em>189150</em>条</span></div>
            <div class="index_r_pinming">
                <ul>
                    @foreach($asklists as $asklist)
                    <li @if($loop->iteration<4) class="top" @endif>
                        <i class="num">{{$loop->iteration}}</i><a href="/wenda/{{$asklist->id}}"target="_blank" title="{{$asklist->title}}">{{str_limit($asklist->title,30,'...')}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="index-title"><strong><em>诚信</em>项目推荐</strong><i>诚信项目要求三证齐全，至少有两家开业一年以上的加盟店； 严苛的审核机制，保障您的创业梦想！</i></div>
        <div class="index-chuanye">
            <div class="index-chuanye-1010">
                @foreach($latestbrandlist2s as $latestbrandlist2)
                    @if($loop->iteration<7)
                    <div class="fl index-chuanye-img">
                        <a href="/xm/{{$latestbrandlist2->id}}" title="{{$latestbrandlist2->brandname}}" target="_blank"><img src="{{$latestbrandlist2->litpic}}" alt="{{$latestbrandlist2->brandname}}"   title="{{$latestbrandlist2->brandname}}"/></a>
                    </div>
                    @else
                        @break
                    @endif
                @endforeach
                <ul class="cb">
                    @foreach($latestbrandlist2s as $latestbrandlist2)
                        @if($loop->iteration>6 && $loop->iteration<55 )
                            <li class=""><a href="/xm/{{$latestbrandlist2->id}}" target="_blank" title="{{$latestbrandlist2->brandname}}">{{$latestbrandlist2->brandname}}</a> </li>
                        @endif
                    @endforeach
                </ul>
                    @foreach($latestbrandlist2s as $latestbrandlist2)
                        @if($loop->iteration>54 && $loop->iteration<61 )
                            <div class="fl index-chuanye-img">
                                <a href="/xm/{{$latestbrandlist2->id}}" title="{{$latestbrandlist2->brandname}}" target="_blank"><img src="{{$latestbrandlist2->litpic}}" alt="{{$latestbrandlist2->brandname}}"   title="{{$latestbrandlist2->brandname}}"/></a>
                            </div>
                        @endif
                    @endforeach

                <ul class="cb">
                    @foreach($latestbrandlist2s as $latestbrandlist2)
                        @if($loop->iteration>60)
                            <li class=""><a href="/xm/{{$latestbrandlist2->id}}" target="_blank" title="{{$latestbrandlist2->brandname}}">{{$latestbrandlist2->brandname}}</a> </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="guanggao">
            <a href="/xm/199" target="_blank"><img title="" alt="" src="/public/images/index_34.jpg"> </a>
        </div>
        <div class="clearfix"></div>
        <div class="clearfix"></div>
        <div class="guanggao"><img title="" alt="" src="/public/images/index_35.png"></div>
        <div class="index-yqlj">
            <span>友情链接</span>
            <ul class="clearfix">

            </ul>
    </div>
@stop
