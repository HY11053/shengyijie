@extends('frontend.frontend')
@if(empty($province) && empty($level))
@section('title'){{$thisTypeinfos["title"]}} - {{config('app.indexname')}}@stop
@section('keywords'){{$thisTypeinfos["keywords"]}}@stop
@section('description'){{$thisTypeinfos["description"]}}@stop
@elseif(!empty($level) && empty($province))
@section('title'){{$level}}{{$thisTypeinfos["typename"]}}项目_开{{$level}}{{$thisTypeinfos["typename"]}}店好项目 - {{config('app.indexname')}}@stop
@section('keywords'){{$thisTypeinfos["keywords"]}}@stop
@section('description'){{$level}}{{$thisTypeinfos["typename"]}}好项目大全，{{$level}}资金开{{$thisTypeinfos["typename"]}}店优秀项目推荐！致富好项目不容错过，机会就在3198商机网！@stop
@else
@section('title'){{$province}}{{$level}}{{$thisTypeinfos["typename"]}}好项目_{{$province}}{{str_replace('加盟','',$thisTypeinfos["typename"])}}致富项目 - {{config('app.indexname')}}@stop
@section('keywords'){{$thisTypeinfos["keywords"]}}@stop
@section('description'){{$province}}{{$level}}{{$thisTypeinfos["typename"]}}好项目大全，在{{$province}}{{$level}}开{{$thisTypeinfos["typename"]}}店优秀项目推荐！致富好项目不容错过，机会就在3198商机网！@stop
@endif

@section('headlibs')
    <link href="/public/css/list.css" rel="stylesheet" type="text/css" />
    <script src="/public/js/lanrenzhijia.js" type="text/javascript"></script>
    <meta http-equiv="mobile-agent" content="format=wml; url={{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" />
    <meta http-equiv="mobile-agent" content="format=xhtml; url={{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" />
    <meta http-equiv="mobile-agent" content="format=html5; url={{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" />
    <link rel="alternate" media="only screen and(max-width: 640px)" href="{{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" >
    <link rel="canonical" href="{{config('app.url')}}/{{Request::path()}}"/>
@stop

@section('main')
    <div class="box">
        <div class="bk weizhi_locations" style="margin-top:4px;"><span><a href="/">3198创业致富网</a>&gt;<a class="dq" href="/xm">{{$thisTypeinfos["typename"]}}</a></span></div>
        <div class="search_k">
            <div class="xuanze clearfix">
                <div class="h3">加盟行业：</div>
                <span  @if($thisTypeinfos["real_path"]==Request::path())  class="dq" @endif   ><a href="/{{$thisTypeinfos["real_path"]}}">全部</a></span>
                <ul>
                    @foreach($thisTypeSonsInfos as $thisTypeSonsInfo)
                    <li @if(trim(Request::getrequesturi(),'/') == $thisTypeSonsInfo->real_path)  class="dq" @endif  ><a href="/{{$thisTypeSonsInfo->real_path}}">{{$thisTypeSonsInfo->typename}}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="xuanze clearfix">
                <div class="h3">投资金额：</div>
                <span @if(!$level) class=dq @endif>@if($province)<a href="/{{$thisTypeinfos["real_path"]}}?province={{array_search($province,$arealists->toArray())}}">不限</a> @else <a href="/{{$thisTypeinfos["real_path"]}}">不限</a> @endif </span>
                <ul>
                    @foreach($investmentlists as $id=>$investmentlist)
                        @if($province)
                            <li @if(array_search($level,$investmentlists->toArray())==$id ) class="dq" @endif><a href="/{{$thisTypeinfos["real_path"]}}?level={{$id}}&province={{array_search($province,$arealists->toArray())}}">{{$investmentlist}}</a></li>
                        @else
                            <li @if(array_search($level,$investmentlists->toArray())==$id ) class="dq" @endif><a href="/{{$thisTypeinfos["real_path"]}}?level={{$id}}">{{$investmentlist}}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>


            <div class="xuanzea clearfix">
                <div class="h3">加盟地区：</div>
                <span  @if(!$province) class=dq @endif >@if($level)  <a href="/{{$thisTypeinfos["real_path"]}}?level={{array_search($level,$investmentlists->toArray())}}">全部</a> @else <a href="/{{$thisTypeinfos["real_path"]}}">全部</a> @endif </span>
                <ul>
                    @foreach($arealists as $areaid=>$arealist)
                        @if($level)
                            <li @if(array_search($province,$arealists->toArray())==$areaid ) class="dq" @endif><a href="/{{$thisTypeinfos["real_path"]}}?level={{array_search($level,$investmentlists->toArray())}}&province={{$areaid}}">{{$arealist}}</a></li>
                        @else
                            <li @if(array_search($province,$arealists->toArray())==$areaid ) class="dq" @endif><a href="/{{$thisTypeinfos["real_path"]}}?province={{$areaid}}">{{$arealist}}</a></li>
                        @endif
                    @endforeach
                </ul>
                <div class="more"><a style="cursor:pointer;">更多</a></div>
                <script type="text/javascript">
                    $(function(){
                        $('div.more a','.xuanzea').click(function(e){
                            e.preventDefault();
                            if($(this).text()=='更多'){
                                $(this).addClass('more1').text('收起');
                                $(this).parents('.xuanzea').height('auto').find('ul').height('auto');
                            }else{
                                $(this).removeClass('more1').text('更多');
                                $(this).parents('.xuanzea').height('32px').find('ul').height('32px');
                            }
                        })
                    });
                </script>
            </div>

        </div>

    </div>
    <div class="box clearfix"  style="position:relative;">
        <div class="w720">
            <div class="zhonghe">
                <div class="zh_bt">@if($brands->total()){{$province}}{{$thisTypeinfos["typename"]}}{{$level}}项目共<i  style="color:red;">{{$brands->total()}}</i>个匹配商家 @else {{$province}}{{$thisTypeinfos->typename}}{{$level}}项目未找到相关品牌 为您推荐以下品牌 @endif</div>
                <div class="pailie">
                </div>
            </div>

            <div class="pinpai_list">
                @if($brands->total())
                @foreach($brands as $brand)
                    <div class="pinpai_h">
                        <div class="pinpai_h_pic"><span><a href="/xm/{{$brand->id}}" title="{{$brand->brandname}}" target="_blank"><img src="{{$brand->litpic}}" alt="{{$brand->brandname}}" /></a></span></div>
                        <div class="pinpai_h_c">
                            <div class="pp_bt"><strong><a href="/xm/{{$brand->id}}" title="{{$brand->brandname}}" target="_blank">{{$brand->brandname}}</a></strong>{{--[<a href="/{{$thisTypeinfos->real_path}}">{{$thisTypeinfos->typename}}</a> > <a href="/{{$thisTypeinfos->real_path}}/{{$brand->arctype->id}}">{{$brand->arctype->typename}}</a>]--}}</div>
                            <span><em><strong>合作模式：{{$brand->brandmoshi}}</strong></em><strong>品牌总部：</strong>{{$brand->brandorigin}}</span>
                            <span><strong>运营机构：</strong>{{$brand->brandgroup}}</span>
                            <p>{{$brand->description}}...</p>
                        </div>
                        <div class="pinpai_h_r">
                            <strong class="pp_pic1">投资金额：<em>{{$investmentlists[$brand->tzid]}}</em></strong>
                            <span class="pp_pic1">加盟费用：{{$brand->brandpay}}</span>
                            <span class="pp_pic2">项目人气：<code>{{$brand->num}}</code>人</span>
                            <span><a href="/xm/{{$brand->id}}#msg" title="{{$brand->brandname}}" >立即留言咨询</a></span>
                        </div>
                    </div>
                @endforeach

                <div class="page">
                    {{$brands->links()}}
                </div>
                @else
                    @foreach($tuijianbrands as $brand)
                        <div class="pinpai_h">
                            <div class="pinpai_h_pic"><span><a href="/xm/{{$brand->id}}" title="{{$brand->brandname}}" target="_blank"><img src="{{$brand->litpic}}" alt="{{$brand->brandname}}" /></a></span></div>
                            <div class="pinpai_h_c">
                                <div class="pp_bt"><strong><a href="/xm/{{$brand->id}}" title="{{$brand->brandname}}" target="_blank">{{$brand->brandname}}</a></strong>[<a href="/{{$thisTypeinfos->real_path}}">{{$thisTypeinfos->typename}}</a> > <a href="/{{$thisTypeinfos->real_path}}/{{$brand->arctype->id}}">{{$brand->arctype->typename}}</a>]</div>
                                <span><em><strong>合作模式：{{$brand->brandmoshi}}</strong></em><strong>品牌总部：</strong>{{$brand->brandorigin}}</span>
                                <span><strong>运营机构：</strong>{{$brand->brandgroup}}</span>
                                <p>{{$brand->description}}...</p>
                            </div>
                            <div class="pinpai_h_r">
                                <strong class="pp_pic1">投资金额：<em>{{$investmentlists[$brand->tzid]}}</em></strong>
                                <span class="pp_pic1">加盟费用：{{$brand->brandpay}}</span>
                                <span class="pp_pic2">项目人气：<code>{{$brand->num}}</code>人</span>
                                <span><a href="/xm/{{$brand->id}}#msg" title="{{$brand->brandname}}" >立即留言咨询</a></span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <script>
                $(function(){
                    $('.pagination').addClass('am-pagination')
                })
                var jingguo = $('.pinpai_h');
                jingguo.bind('mouseover', function (){
                    $(this).addClass('jg');
                });
                jingguo.bind('mouseout', function (){
                    $(this).removeClass('jg');
                });
            </script>

        </div>

        <div class="w270">

            <div class="bk r_ullb1">
                <div class="h2"><a href=/zhishi/cyms >{{$thisTypeinfos["typename"]}}知识</a></div>
                <ul>
                    @foreach($thisTypeKnowledges as $thisTypeKnowledge)
                    <li><a href="/zhishi/{{$thisTypeKnowledge->id}}" title="{{$thisTypeKnowledge->title}}" target="_blank">{{$thisTypeKnowledge->title}}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="bk r_ullb1">
                <div class="h2">
                    <a >{{$thisTypeinfos["typename"]}}资讯</a>
                </div>
                <ul>
                    @foreach($thisTypeNews as $thisTypeNew)
                    <li><a href="/news/{{$thisTypeNew->id}}" title="{{$thisTypeNew->title}}" target="_blank">{{$thisTypeNew->title}}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="bk r_ullb2">
                <div class="h2">{{$thisTypeinfos['typename']}}最新入驻</div>
                <ul class="clearfix">
                    @foreach($thisTypelatestbrands as $thisTypelatestbrand)
                    <li>
                        <span><a href="/xm/{{$thisTypelatestbrand->id}}" title="{{$thisTypelatestbrand->brandname}}" target="_blank"><img alt="{{$thisTypelatestbrand->brandname}}" src="{{$thisTypelatestbrand->litpic}}"></a></span>
                        <strong><a href="/xm/{{$thisTypelatestbrand->id}} " title="{{$thisTypelatestbrand->brandname}}" target="_blank">{{$thisTypelatestbrand->brandname}}</a></strong>
                    </li>
                    @endforeach
                </ul>
            </div>


            <div class="bk r_paihang">
                <div class="h2">{{$thisTypeinfos['typename']}}同类型品牌排行</div>
                <ul class="zc_text1">
                    @foreach($thisTypepaihangbangs as $thisTypepaihangbang)
                    <li>
                        <strong>{{$loop->iteration}}</strong>
                        <p class="on">
                            <em>{{$thisTypepaihangbang->click}}</em>{{$thisTypepaihangbang->brandname}}</p>
                        <dl class="case1">
                            <dt><a href="/xm/{{$thisTypepaihangbang->id}}" title="{{$thisTypepaihangbang->brandname}}" target="_blank"><img src="{{$thisTypepaihangbang->litpic}}" /></a></dt>
                            <dd>
                                <div class="h3"><a href="/xm/{{$thisTypepaihangbang->id}}" title="{{$thisTypepaihangbang->brandname}}" target="_blank">{{$thisTypepaihangbang->brandname}}</a></div>
                                <span>投资金额：{{$investmentlists[$thisTypepaihangbang->tzid]}}元</span>
                            </dd>
                        </dl>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop
