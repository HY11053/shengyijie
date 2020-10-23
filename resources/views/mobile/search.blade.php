@extends('mobile.mobile')
@section('main_content')
    @include('mobile.lunbo')
    <div class="weizhi_locations">
        <span>3198为您找到与<b style="color:red;">『{{$key}}』</b>相关结果约 {{$articles->total()}} 个</span>
    </div>
    <div class="brand-filters">
        <div class="brand-filter-item">
            <h5>项目 <i class="iconfont iconfont icon-xiala"></i></h5>
        </div>
        <div class="brand-filter-item">
            <h5>知识 <i class="iconfont iconfont icon-xiala"></i></h5>
        </div>
        <div class="brand-filter-item">
            <h5>资讯 <i class="iconfont iconfont icon-xiala"></i></h5>
        </div>
    </div>
    @if($path=='xm')
    <div class="brand_list">
        @foreach($articles as $article)
            <div class="brandlists">
                <dl class="branditem">
                    <dt class="brand-topinfo">
                        <div class="brandlist-logo">
                            <img src="{{$article->litpic}}" alt="{{$article->brandname}}">
                        </div>
                        <div class="brand-typeinfo">
                            <h2><a href="/xm/{{$article->id}}">{{$article->brandname}}</a></h2>
                            <ul>
                                <li><i class="iconfont icon-jiamengfei"></i>投资金额: <strong> {{$investmentlists[$article->tzid]}}</strong></li>
                                <li><i class="iconfont icon-mendian"></i>门店总数: {{$article->brandnum}}家</li>
                                <li><i class="iconfont icon-chanp"></i>品牌分类:{{$article->arctype->typename}}</li>
                            </ul>
                        </div>
                    </dt>
                    <dd class="brand-msginfo">
                        {{$article->description}}
                    </dd>
                    <div class="brnad-confirm">
                        <i class="iconfont icon-yirenzheng"></i>
                    </div>
                </dl>
            </div>
        @endforeach
    </div>
    @else
        <div class="list_middle_models">
            <div class="list_middle_text_centre">
                <ul>
                    @foreach($articles as $article)
                        <li>
                            <a href="/{{$path}}/{{$article->id}}">
                                <div class="img_show"><img src="{{$article->litpic}}" class="img_list"></div>
                                <div class="cont">
                                    <p class="tit_1">{{$article->title}}</p>
                                    <p class="info">{{$article->description}}</p>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@stop
