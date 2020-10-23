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
        <div class="weizhi_locations1"><span><a href="/">{{config('app.indexname')}}</a>&gt;<a href="/{{$catepath}}">@if($catepath=='news')加盟资讯 @else 加盟知识 @endif</a></span></div>
        <div class="w720" style="overflow:hidden;">
            <div class="lb_huandeng">
                <div class="h2">最新资讯</div>
                <!-- 幻灯片 Start -->
                <div class="flexslider">
                    <ul class="slides">
                        @foreach($carticles as $carticle)
                        <li>
                            <strong><a href="/{{$catepath}}/{{$carticle['id']}}">{{$carticle['title']}}</a></strong>
                            <p>{{$carticle['description']}}...</p>
                            <span><a href="/{{$catepath}}/{{$carticle['id']}}" class="zx_xq">详情></a>来自：
						<a href="/{{$catepath}}/{{$thisTypeinfos->real_path}}/{{$carticle['typeid']}}">
						{{$carticle['typename']}}</a></span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <script src="/public/js/jquery.flexslider-min.js"></script>
                <script>
                    $(function(){
                        $('.flexslider').flexslider({
                            directionNav: true,
                            pauseOnAction: false
                        });
                        $(".flexslider").hover(function(){
                            $(".flexslider .flex-direction-nav").fadeIn()
                        },function(){
                            $(".flexslider .flex-direction-nav").fadeOut()
                        });
                    });
                </script>

            </div>
            <!-- 幻灯片 End -->

            <div class="clearfix w7201">
                @foreach($listcollections as $typename=>$listcollection)
                <div class="zx_3198ullb1">
                    <div class="h2"><a href="/{{$catepath}}/{{$thisTypeinfos->real_path}}/{{\App\AdminModel\Arctype::where('typename',$typename)->value('id')}}">{{$typename}}</a></div>
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
                <script type="text/javascript">
                    $(function(){
                        $('.zx_3198ullb1 ul li:first-child').addClass('bold');
                    });
                </script>
            </div>
        </div>


        <div class="w260">
            <div class="rbk zx_nav">
                <div class="h2">加盟要点</div>
                <div class="rbka">
                    <ul class="clearfix">
                        <li><a href="/xm">加盟</a></li>
                        <li><a href="/news">加盟知识</a></li>
                    </ul>
                </div>
            </div>

            <div class="rbk r_biaoqian">
                <div class=h2>相关推荐</div>
                <div class="rbka">
                    <div class="bqgao">
                        <ul class="clearfix">
                            <li><a href="/cyms">餐饮美食加盟</a></li>
                            <li><a href="/fzxb">服装鞋包加盟</a></li>
                            <li><a href="/mrbj">美容保健加盟</a></li>
                            <li><a href="/shfw">生活服务加盟</a></li>
                            <li><a href="/jjyp">家居用品加盟</a></li>
                            <li><a href="/jczs">建材装饰加盟</a></li>
                            <li><a href="/lpsp">礼品饰品加盟</a></li>
                            <li><a href="/qcfw">汽车服务加盟</a></li>
                            <li><a href="/jywl">教育网络加盟</a></li>
                            <li><a href="/myyp">母婴生活加盟</a></li>
                            <li><a href="/hbjx">环保机械加盟</a></li>
                            <li><a href="/jsyl">酒水饮料加盟</a></li>
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
                <div class="h2">最热加盟知识</div>
                <div class="rbka">
                    <ul class="clearfix">
                        @foreach($latestKnowledges as $latestKnowledge)
                        <li><a href="/zhishi/{{$latestKnowledge->id}}">{{$latestKnowledge->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="rbk r_ullb2">
                <div class="h2">最新入住商家</div>
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
