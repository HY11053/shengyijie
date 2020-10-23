@extends('mobile.mobile')
@if($catepath=='news')
@section('title'){{$thisTypeinfos->ntitle}} - {{config('app.indexname')}}@stop
@section('keywords'){{$thisTypeinfos->nkeywords}}@stop
@section('description'){{$thisTypeinfos->ndescription}}@stop
@elseif($catepath=='zhishi')
@section('title'){{$thisTypeinfos->ktitle}} - {{config('app.indexname')}}@stop
@section('keywords'){{$thisTypeinfos->kkeywords}}@stop
@section('description'){{$thisTypeinfos->kdescription}}@stop
@endif
@section('main_content')
    <div class="weizhi_locations">
        <span><a href="/"><i class="iconfont icon-dingwei"></i>   首页</a> &nbsp;&gt; <a href="/{{$catepath}}">@if($catepath=='news')加盟资讯 @else 加盟知识 @endif</a> <a href="/{{$catepath}}/{{$thisTypeTopInfo->real_path}}">{{$thisTypeTopInfo->typename}}</a></span>
    </div>
    <div class="list_middle_models">
        <div class="list_middle_text_centre">
            <ul>
                @foreach($listarticles as $listarticle)
                    <li>
                        <a href="/{{$catepath}}/{{$listarticle->id}}">
                            <div class="img_show"><img src="{{$listarticle->litpic}}" class="img_list"></div>
                            <div class="cont">
                                <p class="tit_1">{{$listarticle->title}}</p>
                                <p class="info">{{$listarticle->description}}</p>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="page">
    {{$listarticles->links()}}
    </div>
    <div id="newslist-cmodels">
        <div class="newslist-3198modelboxs clearfix">
            <i></i>
            <div class="title">项目资讯</div>
            <div class="newslist-3198_models">
                @foreach($latestKnowledges as $latestKnowledge)
                    <div class="newslist-cmodelslist">
                    <a href="/zhishi/{{$latestKnowledge->id}}">
                        <div class="left fl">
                            <div class="lefttitle">{{$latestKnowledge->title}}</div>
                            <div class="text">
                                <div class="message">来源：{{config('app.indexname')}}</div>
                            </div>
                        </div>
                        <div class="right fr">
                            <img src="{{$latestKnowledge->litpic}}">
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div id="brandlist-cmodel">
        <div class="brandlist-cmodelbox clearfix">
            <i></i>
            <div class="title">最新上线项目</div>
            <div class="brandlist-cmodelcontent">
                @foreach($latestBrands as $latestBrand)
                <div class="brandlist-cmodellist  @if($loop->iteration %2==0) fl @else fr @endif ">
                    <a href="/xm/{{$latestBrand->id}}">
                        <img src="{{$latestBrand->litpic}}" alt="{{$latestBrand->brandname}}">
                        <div class="brandlist-cmodellistcontent">
                            <div class="model-listtitle">{{$latestBrand->brandname}}</div>
                            <div class="model-listtext">
                                <p></p>
                            </div>
                            <div class="textleft fl">￥{{$investmentlists[$latestBrand->tzid]}}
                            </div>
                            <div class="textright fr">
                                {{date('m-d',strtotime($latestBrand->created_at))}}
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
