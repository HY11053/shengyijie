@extends('mobile.mobile')
@section('title'){{config('app.webname')}}@stop
@section('keywords'){{config('app.keywords')}}@stop
@section('description'){{config('app.description')}}@stop
@section('main_content')
    <div class="lunbo">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <li class="swiper-slide"><a href="/busInfo/31402.html"><img src="/mobile/images/dongfangruili.jpg" alt="东方瑞丽洗衣" /></a></li>
                <li class="swiper-slide"><a href="/busInfo/20582.html"><img src="/mobile/images/juneng.png" alt="聚能教育加盟" /></a></li>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="smalllist clearfix">
        <div class="small-box">
            <a href="/cyms">
                <img src="/mobile/images/canyin.png"/><span>餐饮美食</span>
            </a>
        </div>
        <div class="small-box">
            <a href="/jywl" class="rightbox">
                <img src="/mobile/images/jiaoyu.png"/><span>教育培训</span>
            </a>
        </div>
        <div class="small-box">
            <a href="/myyp">
                <img src="/mobile/images/muying.png"/><span>母婴幼儿</span>
            </a>
        </div>
        <div class="small-box rightbox">
            <a href="/jjyp" class="rightbox">
                <img src="/mobile/images/jiaju.png"/><span>家居用品</span>
            </a>
        </div>
        <div class="small-box rightbox">
            <a href="/lpsp" class="rightbox">
                <img src="/mobile/images/shipin.png"/><span>礼品饰品</span>
            </a>
        </div>
        <div class="small-box rightbox">
            <a href="/jczs" class="rightbox">
                <img src="/mobile/images/jiancai.png"/><span>建材装饰</span>
            </a>
        </div>
        <div class="small-box rightbox">
            <a href="/hbjx" class="rightbox">
                <img src="/mobile/images/jixie.png"/><span>机械环保</span>
            </a>
        </div>
        <div class="small-box rightbox">
            <a href="/mrbj" class="rightbox">
                <img src="/mobile/images/meirong.png"/><span>美容养生</span>
            </a>
        </div>
        <div class="small-box rightbox">
            <a href="/shfw/179" class="rightbox">
                <img src="/mobile/images/ganxi.png"/><span>干洗加盟</span>
            </a>
        </div>
        <div class="small-box rightbox">
            <a href="/shfw/282" class="rightbox">
                <img src="/mobile/images/lingshou.png"/><span>零售加盟</span>
            </a>
        </div>
    </div>
    <div class="recommend clearfix">
        <img src="/mobile/images/icon-kmtt.png">
        <div id="moocBox">
            <ul data-id="m_n_a02" data-type="cmsadpos">
                @foreach($latestnewslists as $latestnewslist)
                <li><a href="/news/{{$latestnewslist->id}}">{{$latestnewslist->title}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="brand-containers">
        <div class="bg-fff mt10 pt20">
            <div class="mt10 catering-tab-box">
                <div class="tab-box-flex">
                    <span class="cur">优选</span>
                    <span class="">最新</span>
                    <span class="">餐饮</span>
                    <span class="">教育</span>
                    <span class="">母婴</span>
                </div>
                <div>
                    <ul class="catering-list ">
                        @foreach($youxuanrandlists as $youxuanrandlist)
                            <li class="anxjm-mper-cnxh fl"> <a href="/xm/{{$youxuanrandlist['id']}}" class="d-b anxjm-mcnxh-img" title="{{$youxuanrandlist['brandname']}}">
                                    <img alt="{{$youxuanrandlist['brandname']}}" src="{{$youxuanrandlist['litpic']?$youxuanrandlist['litpic']:$youxuanrandlist['litpic']}}"  /></a> <a href="/xm/{{$youxuanrandlist['id']}}" title="{{$youxuanrandlist['brandname']}}" class="d-b anxjm-mcnxh-name text-e font30 color-000 font-weight">{{$youxuanrandlist['brandname']}}</a>
                                <div class="anxjm-mbjtj-msg o-h">
                                    <span class="fl font20 color-f85100">&yen;</span>
                                    <span class="fl font34 color-f85100 font-weight">{{$investmentlists[$youxuanrandlist['tzid']]}}</span>
                                    <a href="/{{$youxuanrandlist['topreal_path']}}/{{$youxuanrandlist['typeid']}}" title="{{$youxuanrandlist['typename']}}" class="fr anxjm-mtype">{{$youxuanrandlist['typename']}}</a>
                                </div>
                            </li>
                        @endforeach
                        <div class="clear" style="clear: both;"></div>
                    </ul>
                    <ul class="catering-list none">
                        @foreach($latestbrandlists as $latestbrandlist)
                            <li class="anxjm-mper-cnxh fl"> <a href="/xm/{{$latestbrandlist['id']}}" class="d-b anxjm-mcnxh-img" title="{{$latestbrandlist['brandname']}}">
                                    <img alt="{{$latestbrandlist['brandname']}}" src="{{$latestbrandlist['litpic']}}"  /></a> <a href="/xm/{{$latestbrandlist['id']}}" title="{{$latestbrandlist['brandname']}}" class="d-b anxjm-mcnxh-name text-e font30 color-000 font-weight">{{$latestbrandlist['brandname']}}</a>
                                <div class="anxjm-mbjtj-msg o-h">
                                    <span class="fl font20 color-f85100">&yen;</span>
                                    <span class="fl font34 color-f85100 font-weight">{{$investmentlists[$latestbrandlist['tzid']]}}</span>
                                    <a href="/{{$latestbrandlist['topreal_path']}}/{{$latestbrandlist['typeid']}}" title="{{$latestbrandlist['typename']}}" class="fr anxjm-mtype">{{$latestbrandlist['typename']}}</a>
                                </div>
                            </li>
                        @endforeach
                        <div class="clear"></div>
                    </ul>
                    <ul class="catering-list none">
                        @foreach($canyinbrandlists as $canyinbrandlist)
                            <li class="anxjm-mper-cnxh fl"> <a href="/xm/{{$canyinbrandlist['id']}}" class="d-b anxjm-mcnxh-img" title="{{$canyinbrandlist['brandname']}}">
                                    <img alt="{{$canyinbrandlist['brandname']}}" src="{{$canyinbrandlist['litpic']}}"  /></a> <a href="/xm/{{$canyinbrandlist['id']}}" title="{{$canyinbrandlist['brandname']}}" class="d-b anxjm-mcnxh-name text-e font30 color-000 font-weight">{{$canyinbrandlist['brandname']}}</a>
                                <div class="anxjm-mbjtj-msg o-h">
                                    <span class="fl font20 color-f85100">&yen;</span>
                                    <span class="fl font34 color-f85100 font-weight">{{$investmentlists[$canyinbrandlist['tzid']]}}</span>
                                    <a href="/{{$canyinbrandlist['topreal_path']}}/{{$canyinbrandlist['typeid']}}" title="{{$canyinbrandlist['typename']}}" class="fr anxjm-mtype">{{$canyinbrandlist['typename']}}</a>
                                </div>
                            </li>
                        @endforeach
                        <div class="clear"></div>
                    </ul>
                    <ul class="catering-list none">
                        @foreach($jiaoyubrandlists as $jiaoyubrandlist)
                            <li class="anxjm-mper-cnxh fl"> <a href="/xm/{{$jiaoyubrandlist['id']}}" class="d-b anxjm-mcnxh-img" title="{{$jiaoyubrandlist['brandname']}}">
                                    <img alt="{{$jiaoyubrandlist['brandname']}}" src="{{$jiaoyubrandlist['litpic']}}"  /></a> <a href="/xm/{{$jiaoyubrandlist['id']}}" title="{{$jiaoyubrandlist['brandname']}}" class="d-b anxjm-mcnxh-name text-e font30 color-000 font-weight">{{$jiaoyubrandlist['brandname']}}</a>
                                <div class="anxjm-mbjtj-msg o-h">
                                    <span class="fl font20 color-f85100">&yen;</span>
                                    <span class="fl font34 color-f85100 font-weight">{{$investmentlists[$jiaoyubrandlist['tzid']]}}</span>
                                    <a href="/{{$jiaoyubrandlist['topreal_path']}}/{{$jiaoyubrandlist['typeid']}}" title="{{$jiaoyubrandlist['typename']}}" class="fr anxjm-mtype">{{$jiaoyubrandlist['typename']}}</a>
                                </div>
                            </li>
                        @endforeach
                        <div class="clear"></div>
                    </ul>
                    <ul class="catering-list none">
                        @foreach($muyingbrandlists as $muyingbrandlist)
                            <li class="anxjm-mper-cnxh fl"> <a href="/xm/{{$muyingbrandlist['id']}}" class="d-b anxjm-mcnxh-img" title="{{$muyingbrandlist['brandname']}}">
                                    <img alt="{{$muyingbrandlist['brandname']}}" src="{{$muyingbrandlist['litpic']}}"  /></a> <a href="/xm/{{$muyingbrandlist['id']}}" title="{{$muyingbrandlist['brandname']}}" class="d-b anxjm-mcnxh-name text-e font30 color-000 font-weight">{{$muyingbrandlist['brandname']}}</a>
                                <div class="anxjm-mbjtj-msg o-h">
                                    <span class="fl font20 color-f85100">&yen;</span>
                                    <span class="fl font34 color-f85100 font-weight">{{$investmentlists[$muyingbrandlist['tzid']]}}</span>
                                    <a href="/{{$muyingbrandlist['topreal_path']}}/{{$muyingbrandlist['typeid']}}" title="{{$muyingbrandlist['typename']}}" class="fr anxjm-mtype">{{$muyingbrandlist['typename']}}</a>
                                </div>
                            </li>
                        @endforeach
                        <div class="clear"></div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="news-container">
        <div class="anxjm-mper-section">
            <div class="o-h">
                <h3 class="o-h fl"><span class="fl d-b font40 color-000 font-weight m-r10"><i class="iconfont icon-kaocha"></i> 加盟资讯</span></h3>
            </div>
            <ul class="anxjm-mjmxx-list">
                @foreach($latestnewslist2s as $latestnewslist2)
                <li class="anxjm-mper-jmxx o-h">
                    <a href="/news/{{$latestnewslist2['id']}}" class="d-b anxjm-mjmxx-img fl" title="{{$latestnewslist2['title']}}"><img src="{{$latestnewslist2['litpic']}}" alt="{{$latestnewslist2['title']}}"></a>
                    <div class="fr anxjm-mjmxx-msg">
                        <a href="/news/{{$latestnewslist2['id']}}"  title="{{$latestnewslist2['title']}}" class="d-b color-333 anxjm-mjmxx-title font-weight">{{$latestnewslist2['title']}}</a>
                        <p class="o-h"><a href="/news/{{$latestnewslist2['topreal_path']}}/{{$latestnewslist2['typeid']}}" class="fl font32 color-999" title="{{$latestnewslist2['typename']}}"><i class="iconfont icon-leixing-biaoqian"></i> {{$latestnewslist2['typename']}}</a><span class="fr anxjm-mtime">{{date('Y-m-d',strtotime($latestnewslist2['created_at']))}}</span></p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="news-container">
        <div class="anxjm-mper-section">
            <div class="o-h">
                <h3 class="o-h fl"><span class="fl d-b font40 color-000 font-weight m-r10"><i class="iconfont icon-kaocha"></i> 加盟知识</span></h3>
            </div>
            <ul class="anxjm-mjmxx-list">
                @foreach($zhishilists as $zhishilist)
                    <li class="anxjm-mper-jmxx o-h">
                        <a href="/zhishi/{{$zhishilist['id']}}" class="d-b anxjm-mjmxx-img fl" title="{{$zhishilist['title']}}"><img src="{{$zhishilist['litpic']}}" alt="{{$zhishilist['title']}}"></a>
                        <div class="fr anxjm-mjmxx-msg">
                            <a href="/zhishi/{{$zhishilist['id']}}"  title="{{$zhishilist['title']}}" class="d-b color-333 anxjm-mjmxx-title font-weight">{{$zhishilist['title']}}</a>
                            <p class="o-h"><a href="/zhishi/{{$zhishilist['topreal_path']}}/{{$zhishilist['typeid']}}" class="fl font32 color-999" title="{{$zhishilist['typename']}}"><i class="iconfont icon-leixing-biaoqian"></i> {{$zhishilist['typename']}}</a><span class="fr anxjm-mtime">{{date('Y-m-d',strtotime($zhishilist['created_at']))}}</span></p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@stop
@section('footer_libs')
    <script>
        $(function () {
            iliHeight = $("#moocBox").height();
            setTimeout(startScroll, delay);
        });
        //滚动
        var iliHeight;
        var area = document.getElementById('moocBox');
        var speed = 2;
        var time;
        var delay = 3000;
        area.scrollTop = 0;
        area.innerHTML += area.innerHTML;

        function startScroll() {
            time = setInterval("scrollUp()", speed);
            area.scrollTop++;
        }

        function scrollUp() {
            if (area.scrollTop % (iliHeight) == 0) {
                clearInterval(time);
                setTimeout(startScroll, delay);
            } else {
                area.scrollTop++;
                if (area.scrollTop >= area.scrollHeight / 2) {
                    area.scrollTop = 0;
                }
            }
        }
        $(".tab-box-flex span").click(function () {
            $(".catering-list").hide().eq($(this).index()).show();
            $(this).addClass("cur").siblings().removeClass("cur");
        });
    </script>
@stop
