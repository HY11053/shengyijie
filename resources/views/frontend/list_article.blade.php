@extends('frontend.frontend')
@if($catepath=='news')
@section('title'){{$thisTypeinfos->ntitle}} - {{config('app.indexname')}}@stop
@section('keywords'){{$thisTypeinfos->nkeywords}}@stop
@section('description'){{$thisTypeinfos->ndescription}}@stop
@elseif($catepath=='zhishi')
@section('title'){{$thisTypeinfos->ktitle}} - {{config('app.indexname')}}@stop
@section('keywords'){{$thisTypeinfos->kkeywords}}@stop
@section('description'){{$thisTypeinfos->kdescription}}@stop
@endif
@section('headlibs')
    <script src="/public/js/lanrenzhijia.js" type="text/javascript"></script>
    <link href="/public/css/news1.css" rel="stylesheet" type="text/css" />
    <meta http-equiv="mobile-agent" content="format=wml; url={{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" />
    <meta http-equiv="mobile-agent" content="format=xhtml; url={{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" />
    <meta http-equiv="mobile-agent" content="format=html5; url={{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" />
    <link rel="alternate" media="only screen and(max-width: 640px)" href="{{str_replace('http://www.','http://m.',config('app.url'))}}{!! Request::getrequesturi() !!}" >
    <link rel="canonical" href="{{config('app.url')}}/{{Request::path()}}"/>
@stop
@section('main')
    <div class="box clearfix" style="position:relative;">
        <div class="weizhi_locations1">
	<span>
		<a href="/">{{config('app.indexname')}}</a>&gt;
		<a href="/{{$catepath}}">@if($catepath=='news')加盟资讯 @else 加盟知识 @endif</a>&gt;
		<a href="/{{$catepath}}/{{$thisTypeTopInfo->real_path}}">{{$thisTypeTopInfo->typename}}</a>&gt;
		<a>{{$thisTypeinfos->typename}}</a>
	</span></div>
        <div class="w720" style="overflow:hidden;">
            <div class="zixun_bt"><h1>{{$thisTypeinfos->typename}}</h1></div>
            <div class="zixun_list">
                <ul>
                    @foreach($listarticles as $listarticle)
                        <li><em>{{date('Y-m-d',strtotime($listarticle->created_at))}}</em><a href="/{{$catepath}}/{{$listarticle->id}}">{{$listarticle->title}}</a></li>
                        @if($loop->iteration%5==0)<li class="fg"></li>@endif
                    @endforeach
                </ul>

                <div class="page">
                    {{$listarticles->links()}}
                </div>
            </div>
        </div>

        <div class="w260">
            <div class="rbk r_biaoqian">
                <div class="h2">相关推荐</div>
                <div class="rbka">
                    <div class="bqgao">
                        <ul class="clearfix" oriheight="210" style="height: 90px;">
                            @foreach($thisTypeSonsInfos as $thisTypeSonsInfo)
                                <li><a href="/{{$thisTypeTopInfo->real_path}}/{{$thisTypeSonsInfo->id}}">{{$thisTypeSonsInfo->typename}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="more22"><span>更多</span></div>

                    <script type="text/javascript">

                        $(function(){

                            $('.bqgao ul').each(function(){
                                if($(this).height() > 90){
                                    $(this).attr('oriheight',$(this).height())
                                    $(this).animate({height:"90px"})
                                    $(this).parent().next('.more22').show()
                                }else{
                                    $(this).parent().next('.more22').hide()
                                }

                            })

                            $('.more22 span').on('click',function(e){
                                // alert($(this).prev().children('.bqgao').height() )
                                var target = $(this).parent().prev('div').children('ul')
                                if($(this).parent().prev('div').children('ul').height() > 90){
                                    $(this).parent().removeClass('morea22').children('span').html('查看详情')
                                    target.animate({height:"90"})
                                }else{
                                    $(this).parent().addClass('morea22').children('span').html('收起内容')
                                    target.animate({height:target.attr('oriheight')})
                                }

                            })
                        });
                    </script>

                </div>
            </div>

            <div class="rbk r_ullb1">
                <div class="h2"><em><a href="/zhishi/{{$thisTypeTopInfo->real_path}}/{{$thisTypeinfos->id}}">更多&gt;&gt;</a></em>{{$thisTypeinfos->typename}}加盟知识</div>
                <div class="rbka">
                    <ul class="clearfix">

                        @foreach($latestKnowledges as $latestKnowledge)
                            <li><a href="/zhishi/{{$latestKnowledge->id}}">{{$latestKnowledge->title}}</a></li>
                        @endforeach

                    </ul>
                </div>
            </div>

            <div class="rbk r_ullb2">
                <div class="h2">{{$thisTypeinfos->typename}}最新入住商家</div>
                <div class="rbka">
                    <ul class="clearfix">
                        @foreach($latestBrands as $latestBrand)
                            <li>
                                <span><a href="/xm/{{$latestBrand->id}}"><img src="{{$latestBrand->litpic}}" alt="{{str_replace('加盟','',$latestBrand->brandname)}}" /></a></span>
                                <strong><a href="/xm/{{$latestBrand->id}}">{{str_replace('加盟','',$latestBrand->brandname)}}</a></strong>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>

@stop
