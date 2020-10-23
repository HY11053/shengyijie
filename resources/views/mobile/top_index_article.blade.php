@extends('mobile.mobile')
@if($catepath=='news')
@section('title')加盟新闻——超有用的加盟行业新闻，呈现每一个超有用的加盟商机！ - {{config('app.indexname')}}@stop
@elseif($catepath=='zhishi')
@section('title')加盟指南——专业实用的加盟指南，给加盟者最贴心的加盟指导！ - {{config('app.indexname')}}@stop
@endif

@section('main_content')
    <div class="weizhi_locations">
        <span><a href="/"><i class="iconfont icon-dingwei"></i>   首页</a> &nbsp;&gt; <a href="/{{$catepath}}">@if($catepath=='news')加盟资讯 @else 加盟知识 @endif</a> </span>
    </div>
    <div class="list_middle_models">
        <div class="list_middle_text_centre">
            @foreach($listcollections as $typename=>$listcollection)
                <div class="zx_3198ullb1">
                    <div class="h2"><a href="/{{$catepath}}/{{\App\AdminModel\Arctype::where('typename',$typename)->value('real_path')}}">{{$typename}}</a></div>
                    <ul>
                        @foreach($listcollection as $articlecollection)
                            <li>
                                <em>{{date('Y-m-d',strtotime($articlecollection->created_at))}}</em>
                                <a href="/{{$catepath}}/{{$articlecollection->id}}">
                                    {{$articlecollection->title}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
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
