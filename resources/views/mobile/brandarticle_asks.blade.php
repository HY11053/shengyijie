@extends('mobile.mobile')
@section('title'){{$thisArticleInfos->brandname}}问答- {{config('app.indexname')}}@stop
@section('keywords'){{$thisArticleInfos->brandname}}@stop
@section('description'){{$thisArticleInfos->brandname}}问答提供关于{{$thisArticleInfos->brandname}}的各种问题和解答@stop
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
                @foreach($brandasks as $brandask)
                    <li>
                        <a href="/zhishi/{{$brandask->id}}">
                            <div class="img_show"><img src="{{$brandask->litpic}}" class="img_list"></div>
                            <div class="cont">
                                <p class="tit_1">{{$brandask->title}}</p>
                                <p class="info">{{$brandask->description}}</p>
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
@stop
