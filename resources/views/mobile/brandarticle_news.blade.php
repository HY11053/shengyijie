@extends('mobile.mobile')
@section('title'){{$thisArticleInfos->brandname}}新闻- {{config('app.indexname')}}@stop
@section('keywords'){{$thisArticleInfos->brandname}}新闻@stop
@section('description'){{$thisArticleInfos->brandname}}新闻提供最新{{$thisArticleInfos->brandname}}动态信息。@stop
@section('main_content')
    <div class="weizhi_locations">
        <span> <a href="/"><i class="iconfont icon-dingwei"></i> 首页</a> > <a href="/{{$thisArticleTopTypeInfo->real_path}}">{{$thisArticleTopTypeInfo->typename}}</a>
            &gt;<a href="/{{$thisArticleTopTypeInfo->real_path}}/{{$thisArticleTypeInfo->id}}">{{$thisArticleTypeInfo->typename}}</a>
            &gt;<a class="dq">{{$thisArticleInfos->brandname}}连锁</a></span>
    </div>
    @include('mobile.brand_header')
    <div class="list_middle_models">
        <div class="list_middle_text_centre">
            <ul>
                @foreach($brandnews as $brandnew)
                    <li>
                        <a href="/news/{{$brandnew->id}}">
                            <div class="img_show"><img src="{{$brandnew->litpic}}" class="img_list"></div>
                            <div class="cont">
                                <p class="tit_1">{{$brandnew->title}}</p>
                                <p class="info">{{$brandnew->description}}</p>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @include('mobile.liuyan')
    <div id="brandlist-cmodel">
        <div class="brandlist-cmodelbox clearfix">
            <i></i>
            <div class="title">同类品牌</div>
            <div class="brandlist-cmodelcontent">
                @foreach($tongleibrands as $tongleibrand)
                    <div class="brandlist-cmodellist  @if($loop->iteration %2==0) fl @else fr @endif ">
                        <a href="/xm/{{$tongleibrand->id}}">
                            <img src="{{$tongleibrand->litpic}}" alt="{{$tongleibrand->brandname}}">
                            <div class="brandlist-cmodellistcontent">
                                <div class="model-listtitle">{{$tongleibrand->brandname}}</div>
                                <div class="model-listtext">
                                    <p></p>
                                </div>
                                <div class="textleft fl">¥{{$investmentlists[$tongleibrand->tzid]}}</div>
                                <div class="textright fr">
                                    {{date('m-d',strtotime($tongleibrand->created_at))}}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @if(count($brandnews))
        <div id="newslist-cmodels">
            <div class="newslist-3198modelboxs clearfix">
                <i></i>
                <div class="title">项目资讯</div>
                <div class="newslist-3198_models">
                    @foreach($brandnews as $brandnew)
                        <div class="newslist-cmodelslist">
                            <a href="/news/{{$brandnew->id}}">
                                <div class="left fl">
                                    <div class="lefttitle">{{$brandnew->title}}</div>
                                    <div class="text">
                                        <div class="message">来源：{{config('app.indexname')}}</div>
                                    </div>
                                </div>
                                <div class="right fr">
                                    <img src="{{$brandnew->litpic}}">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@stop
