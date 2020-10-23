@extends('frontend.frontend')
@section('title'){{config('app.webname')}}@stop
@section('keywords'){{config('app.keywords')}}@stop
@section('description'){{config('app.description')}}@stop
@section('headlibs')
<meta http-equiv="mobile-agent" content="format=wml; url={{str_replace('http://www.','http://m.',config('app.url'))}}/" />
    <meta http-equiv="mobile-agent" content="format=xhtml; url={{str_replace('http://www.','http://m.',config('app.url'))}}/" />
    <meta http-equiv="mobile-agent" content="format=html5; url={{str_replace('http://www.','http://m.',config('app.url'))}}/" />
    <link rel="alternate" media="only screen and(max-width: 640px)" href="{{str_replace('http://www.','http://m.',config('app.url'))}}/" >
    <link rel="canonical" href="{{config('app.url')}}{{Request::getrequesturi()}}/"/>
@stop
@section('main')
    <div class="main">
        <div class="index_l fl">
            <div id="js_bnn" class="bnn">
                <div class="hd">
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div class="bdd">
                    <ul>
                        <li> <a target="_blank" href="/xm/3080"><img src="/uploads/images/2016/04-12/ea207c9800be.jpg" alt="上臣地板加盟"/></a></li>
                        <li><a target="_blank" href="/xm/3067"><img src="/uploads/images/2016/04-12/c70320578956.jpg" alt="帽牌货冒菜加盟"/></a></li>
                        <li><a target="_blank" href="/xm/3088"> <img src="/uploads/images/2016/04-12/fe4d60a22d50.png" alt="禾禾面吧加盟"/></a></li>
                        <li><a target="_blank" href="/xm/3100"><img src="/uploads/images/2016/04-12/22d0cfdd5694.jpg" alt="鱼乐贝贝加盟"/></a></li>
                    </ul>
                </div>
            </div>
            <div class="index_jm" id="js_index_jm">
                <div class="index_jm_tab">
                    <ul>
                        <li class="on"><a href="/news" target="_blank">商机资讯</a></li>
                        <li><a href="/xm" target="_blank">加盟品牌</a></li>
                    </ul>
                </div>
                <div class="index_jm_cont">
                    <div class="index_jm_list">
                        <ul>
                            @foreach($latestnewslists as $latestnewslist)
                                <li><a href="/news/{{$latestnewslist->id}}" target="_blank">{{$latestnewslist->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="index_jm_list">
                        <ul>
                            @foreach($latestbrandlists as $latestbrandlist)
                            <li><a href="/xm/{{$latestbrandlist->id}}" target="_blank">{{$latestbrandlist->brandname}}</a> </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="index_r fr">
            <div class="index_r_jiameng"><span class="ic1"><strong><i>精品商机项目</i></strong><em>35167</em>个</span>
                <span><strong><i>创业知识</i></strong><em>189150</em>条</span></div>
            <div class="index_r_pinming">
                <ul>
                    @foreach($asklists as $asklist)
                    <li @if($loop->iteration<4) class="top" @endif>
                        <i class="num">{{$loop->iteration}}</i><a href="/wenda/{{$asklist->id}}"target="_blank" title="{{$asklist->title}}">{{str_limit($asklist->title,30,'...')}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="index-title"><strong><em>诚信</em>项目推荐</strong><i>诚信项目要求三证齐全，至少有两家开业一年以上的加盟店； 严苛的审核机制，保障您的创业梦想！</i></div>
        <div class="index-chuanye">
            <div class="index-chuanye-1010">
                @foreach($latestbrandlist2s as $latestbrandlist2)
                    @if($loop->iteration<7)
                    <div class="fl index-chuanye-img">
                        <a href="/xm/{{$latestbrandlist2->id}}" title="{{$latestbrandlist2->brandname}}" target="_blank"><img src="{{$latestbrandlist2->litpic}}" alt="{{$latestbrandlist2->brandname}}"   title="{{$latestbrandlist2->brandname}}"/></a>
                    </div>
                    @else
                        @break
                    @endif
                @endforeach
                <ul class="cb">
                    @foreach($latestbrandlist2s as $latestbrandlist2)
                        @if($loop->iteration>6 && $loop->iteration<55 )
                            <li class=""><a href="/xm/{{$latestbrandlist2->id}}" target="_blank" title="{{$latestbrandlist2->brandname}}">{{$latestbrandlist2->brandname}}</a> </li>
                        @endif
                    @endforeach
                </ul>
                    @foreach($latestbrandlist2s as $latestbrandlist2)
                        @if($loop->iteration>54 && $loop->iteration<61 )
                            <div class="fl index-chuanye-img">
                                <a href="/xm/{{$latestbrandlist2->id}}" title="{{$latestbrandlist2->brandname}}" target="_blank"><img src="{{$latestbrandlist2->litpic}}" alt="{{$latestbrandlist2->brandname}}"   title="{{$latestbrandlist2->brandname}}"/></a>
                            </div>
                        @endif
                    @endforeach

                <ul class="cb">
                    @foreach($latestbrandlist2s as $latestbrandlist2)
                        @if($loop->iteration>60)
                            <li class=""><a href="/xm/{{$latestbrandlist2->id}}" target="_blank" title="{{$latestbrandlist2->brandname}}">{{$latestbrandlist2->brandname}}</a> </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="guanggao">
            <a href="/xm/199" target="_blank"><img title="" alt="" src="/public/images/index_34.jpg"> </a>
        </div>
        <div class="clearfix"></div>
        <div class="index-title"><strong><em>创业</em>商机汇</strong><i>以下是12个特色商机板块，等待您的开拓！ 也可直接搜索您需要的商机</i></div>
        <div class="index-sjh">
            <div class="index-sjh-l fl">
                @foreach($allnavs as $real_path=>$allnavinfos)
                <div class="column lm{{$loop->iteration}}">
                    <div class="column_bt"><strong><a href="/{{$real_path}}" target="_blank">{{\App\AdminModel\Arctype::where('real_path',$real_path)->value('typename')}}</a></strong><span><a href="/{{$real_path}}" target="_blank">{{\App\AdminModel\Arctype::where('real_path',$real_path)->value('typename')}} 轻松赚钱</a></span></div>
                    <p>
                        @foreach($allnavinfos as $typeid=>$allnavinfo)
                        <a href="/{{$real_path}}/{{$typeid}}" target="_blank">{{$allnavinfo}}</a>
                        @endforeach
                    </p>
                </div>
                @endforeach
            </div>

            <div class="index-sjh-r fr">
                <ul>
                    @foreach($paihangbangs as $paihangbang)
                        <li>
                            <a href="/xm/{{$paihangbang->id}}"><img src="{{$paihangbang->litpic}}" alt="{{$paihangbang->brandname}}" title="{{$paihangbang->brandname}}"/>{{str_limit($paihangbang->brandname,10,'')}} </a>
                        </li>
                    @endforeach
                </ul>
                <p><a class=" blue "href="/xm/2669">好煎道生煎</a></p>
                <p><a class=""href="/xm/79">金玉良缘婚庆</a></p>
                <p><a class="blue" href="/xm">更多商机>></a></p>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="index_brand4">
            <div class="tit"></div>
            <ul>
                @foreach($latestbrandlist3s as $latestbrandlist3)
                <li>
                    <a target="_blank" href="/xm/{{$latestbrandlist3->id}}"><img title="{{$latestbrandlist3->brandname}}" alt="{{$latestbrandlist3->brandname}}" src="{{$latestbrandlist3->litpic}}"></a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="clearfix"></div>
        <div class="index-xwzx">
            <div class="index-xwzx-zs">
                <div class="index-xwzx-zs-t">
                    <strong>创业知识</strong><span><a href="/zhishi" target="_blank">更多&gt;&gt;</a></span></div>
                <div class="clearfix"></div>
                <div class="index-xwzx-zs-c">
                    <ul>
                        {{--@foreach($zhishilists as $zhishilist)
                            <li><strong><a href="/zhishi/{{$zhishilist['topreal_path']}}/{{$zhishilist['typeid']}}"> [{{$zhishilist['typename']}}]</a></strong><a href="/zhishi/{{$zhishilist['id']}}">{{$zhishilist['title']}}</a></li>
                        @endforeach--}}
                    </ul>
                </div>
            </div>
            <div class="index-xwzx-zs">
                <div class="index-xwzx-zs-t">
                    <strong>商机资讯</strong><span><a href="/news" target="_blank">更多&gt;&gt;</a></span></div>
                <div class="clearfix"></div>
                <div class="index-xwzx-zs-c">
                    <ul>
                        @foreach($newslist2s as $newslist2)
                            <li><strong><a href="/news/{{$newslist2['topreal_path']}}/{{$newslist2['typeid']}}"> [{{$newslist2['typename']}}]</a></strong><a href="/news/{{$newslist2['id']}}">{{$newslist2['title']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="guanggao"><img title="" alt="" src="/public/images/index_35.png"></div>
        <div class="index-yqlj">
            <span>友情链接</span>
            <ul class="clearfix">
                <li><a target="_blank" href="http://www.3198.com/">3198创业致富</a></li>
                <li><a target="_blank" href="http://www.meilele.com/category-ertongfang/">儿童房家具</a></li>
                <li><a target="_blank" href="http://www.35838.com/">猪价格网</a></li>
                <li><a target="_blank" href="http://cyyl.91cy.cn/">赚钱项目</a></li>
                <li><a target="_blank" href="http://www.tzcy37.com/">餐饮加盟</a></li>
                <li><a target="_blank" href="http://bj.qizuang.com/">北京装修网</a></li>
                <li><a target="_blank" href="http://www.kufang365.com/">库房365网</a></li>
                <li><a target="_blank" href="http://wenda.hao315.com/">问答平台</a></li>
                <li><a target="_blank" href="http://yinshi.jiameng.com/">银饰代理</a></li>
                <li><a target="_blank" href="http://dan-gao-gui.com/">蛋糕冷藏柜</a></li>
                <li><a target="_blank" href="http://shaokao.qudao.com/">烧烤加盟</a></li>
                <li><a target="_blank" href="http://www.shang.cn/">广州商机速配</a></li>
                <li><a target="_blank" href="http://www.auak.com/">爱客商务网</a></li>
                <li><a target="_blank" href="http://www.ccalu.com/">中医养生馆加盟</a></li>
                <li><a target="_blank" href="http://www.youlebaba.com/">中国游乐设备网</a></li>
                <li><a target="_blank" href="http://www.really.cn/">东方瑞丽</a></li>
                <li><a target="_blank" href="https://www.jjedu.com.cn/">教育招商网</a></li>
            </ul>
    </div>
@stop
