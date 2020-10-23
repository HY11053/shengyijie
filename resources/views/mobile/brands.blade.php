@extends('mobile.mobile')
@if(empty($province) && empty($level))
@section('title'){{$thisTypeinfos->title}} - {{config('app.indexname')}}@stop
@section('keywords'){{$thisTypeinfos->keywords}}@stop
@section('description'){{$thisTypeinfos->description}}@stop
@elseif(!empty($level) && empty($province))
@section('title'){{$level}}{{$thisTypeinfos->typename}}项目_开{{$level}}{{$thisTypeinfos->typename}}店好项目 - {{config('app.indexname')}}@stop
@section('keywords'){{$thisTypeinfos->keywords}}@stop
@section('description'){{$level}}{{$thisTypeinfos->typename}}好项目大全，{{$level}}资金开{{$thisTypeinfos->typename}}店优秀项目推荐！致富好项目不容错过，机会就在3198商机网！@stop
@else
@section('title'){{$province}}{{$level}}{{$thisTypeinfos->typename}}好项目_{{$province}}{{str_replace('加盟','',$thisTypeinfos->typename)}}致富项目 - {{config('app.indexname')}}@stop
@section('keywords'){{$thisTypeinfos->keywords}}@stop
@section('description'){{$province}}{{$level}}{{$thisTypeinfos->typename}}好项目大全，在{{$province}}{{$level}}开{{$thisTypeinfos->typename}}店优秀项目推荐！致富好项目不容错过，机会就在3198商机网！@stop
@endif
@section('main_content')
@include('mobile.lunbo')
    <div class="weizhi_locations">
        <span><a href="/"><i class="iconfont icon-dingwei"></i>   首页</a> &gt;   <a href="/{{$thisTypeinfos->real_path}}">{{$thisTypeinfos->typename}}</a></span>
    </div>
    <div class="brand-filters">
        <div class="brand-filter-item">
            <h5>加盟行业 <i class="iconfont iconfont icon-xiala"></i></h5>
        </div>
        <div class="brand-filter-item">
            <h5>投资金额 <i class="iconfont iconfont icon-xiala"></i></h5>
        </div>
        <div class="brand-filter-item">
            <h5>加盟地区 <i class="iconfont iconfont icon-xiala"></i></h5>
        </div>
    </div>
    <div class="bg-fff mg-section">
        <ul class="filter-list-types none">
            @foreach($thisTypeSonsInfos as $thisTypeSonsInfo)
                <li @if(trim(Request::getrequesturi(),'/') == $thisTypeSonsInfo->real_path)  class="dq" @endif  ><a href="/{{$thisTypeinfos->real_path}}/{{$thisTypeSonsInfo->id}}">{{$thisTypeSonsInfo->typename}}</a></li>
            @endforeach
        </ul>
        <ul class="filter-list-types none">
            @foreach($investmentlists as $id=>$investmentlist)
                @if($province)
                    <li @if(array_search($level,$investmentlists->toArray())==$id ) class="dq" @endif><a href="/{{$thisTypeinfos->real_path}}?level={{$id}}&province={{array_search($province,$arealists->toArray())}}">{{$investmentlist}}</a></li>
                @else
                    <li @if(array_search($level,$investmentlists->toArray())==$id ) class="dq" @endif><a href="/{{$thisTypeinfos->real_path}}?level={{$id}}">{{$investmentlist}}</a></li>
                @endif
            @endforeach
        </ul>
        <ul class="filter-list-types none">
            @foreach($arealists as $areaid=>$arealist)
                @if($level)
                    <li @if(array_search($province,$arealists->toArray())==$areaid ) class="dq" @endif><a href="/{{$thisTypeinfos->real_path}}?level={{array_search($level,$investmentlists->toArray())}}&province={{$areaid}}">{{$arealist}}</a></li>
                @else
                    <li @if(array_search($province,$arealists->toArray())==$areaid ) class="dq" @endif><a href="/{{$thisTypeinfos->real_path}}?province={{$areaid}}">{{$arealist}}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="brand_list">
        @foreach($brands as $brand)
        <div class="brandlists">
            <dl class="branditem">
                <dt class="brand-topinfo">
                    <div class="brandlist-logo">
                        <img src="{{$brand->litpic}}" alt="{{$brand->brandname}}">
                    </div>
                    <div class="brand-typeinfo">
                        <h2><a href="/xm/{{$brand->id}}">{{$brand->brandname}}</a></h2>
                        <ul>
                            <li><i class="iconfont icon-jiamengfei"></i>投资金额: <strong> {{$investmentlists[$brand->tzid]}}</strong></li>
                            <li><i class="iconfont icon-mendian"></i>门店总数: {{$brand->brandnum}}家</li>
                            <li><i class="iconfont icon-chanp"></i>品牌分类:{{$thisTypeinfos->typename}}</li>
                        </ul>
                    </div>
                </dt>
                <dd class="brand-msginfo">
                    {{$brand->description}}
                 </dd>
                <div class="brnad-confirm">
                    <i class="iconfont icon-yirenzheng"></i>
                </div>
            </dl>
        </div>
        @endforeach
        <div class="page">
        {{$brands->links()}}
        </div>
    </div>
    <div id="newslist-cmodels">
        <div class="newslist-3198modelboxs clearfix">
            <i></i>
            <div class="title">{{$thisTypeinfos->typename}}资讯</div>
            <div class="newslist-3198_models">
                @foreach($thisTypeNews as $thisTypeNew)
                <div class="newslist-cmodelslist">
                    <a href="/news/{{$thisTypeNew->id}}">
                        <div class="left fl">
                            <div class="lefttitle">{{$thisTypeNew->title}}</div>
                            <div class="text">
                                <div class="message">来源：{{config('app.indexname')}}</div>
                            </div>
                        </div>
                        <div class="right fr">
                            <img src="{{$thisTypeNew->litpic}}">
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div id="newslist-cmodels">
    <div class="newslist-3198modelboxs clearfix">
        <i></i>
        <div class="title">{{$thisTypeinfos->typename}}知识</div>
        <div class="newslist-3198_models">
            @foreach($thisTypeKnowledges as $thisTypeKnowledge)
                <div class="newslist-cmodelslist">
                    <a href="/zhishi/{{$thisTypeKnowledge->id}}">
                        <div class="left fl">
                            <div class="lefttitle">{{$thisTypeKnowledge->title}}</div>
                            <div class="text">
                                <div class="message">来源：{{config('app.indexname')}}</div>
                            </div>
                        </div>
                        <div class="right fr">
                            <img src="{{$thisTypeKnowledge->litpic}}">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop
@section('footer_libs')
    <script>
        $(".brand-filters .brand-filter-item").click(function () {
            $(".filter-list-types").hide().eq($(this).index()).show();
            $(this).addClass("cur").siblings().removeClass("cur");
        });
    </script>
@stop
