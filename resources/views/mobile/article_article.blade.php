@extends('mobile.mobile')
@section('title'){{$thisArticleInfos->title}} - {{config('app.indexname')}}@stop
@section('keywords'){{$thisArticleInfos->keywords}}@stop
@section('description'){{$thisArticleInfos->description}}@stop
@section('main_content')
    <div class="weizhi_locations"><span>
            <a href="/"><i class="iconfont icon-dingwei"></i>首页</a> &gt;<a href="/{{$path}}">@if($path=='news')加盟资讯 @else 加盟知识 @endif</a>&gt;@if($thisArticleTopTypeInfo) <a href="/{{$path}}/{{$thisArticleTopTypeInfo->real_path}}">{{$thisArticleTopTypeInfo->typename}}</a> &gt; <a href="/{{$path}}/{{$thisArticleTopTypeInfo->real_path}}/{{$thisArticleTypeInfo->id}}">{{$thisArticleTypeInfo->typename}}</a> @endif </span> </div>
    <div class="list_middle_models">
        <div class="a_content_brand">
            <div class="a_content  padding-bottom0">
                <h1>{{$thisArticleInfos->title}}</h1>
                <small>时间：{{$thisArticleInfos->created_at}}&nbsp;&nbsp;&nbsp;&nbsp;浏览量:{{$thisArticleInfos->click}}</small>
            </div>
        </div>
        @if($thisBrandArticleInfos)
            <div class="brand-3198headerinfo margin-bottom0">
                <div class="brand-top">
                    <div class="brand-3198logo">
                        <img src="{{$thisBrandArticleInfos->litpic}}" alt="{{$thisBrandArticleInfos->brandname}}">
                    </div>
                    <div class="brand_middle-model">
                        <h2><a href="/xm/{{$thisBrandArticleInfos->id}}">{{$thisBrandArticleInfos->brandname}}</a></h2>
                        <div class="brandpay">
                            基本投资:    <em>{{$investmentlists[$thisBrandArticleInfos->tzid]}}</em>
                        </div>
                        <div class="brand_types_model">
                            <em>所属分类:</em><span><a href="/{{$thisArticleTopTypeInfo->real_path}}">{{$thisArticleTopTypeInfo->typename}}</a></span> <span><a href="{{$thisArticleTopTypeInfo->real_path}}/{{$thisArticleTypeInfo->id}}">{{$thisArticleTypeInfo->typename}}</a></span>
                        </div>
                        <div class="others_brand_model">
                            <span>所属公司:</span><span>{{$thisBrandArticleInfos->brandgroup}}</span>
                        </div>
                    </div>
                </div>
                <button rel="nofollow" class="kd-btn fr ml10 btn-marklog  js_popup">开店方案</button>
            </div>
        @endif
        <div class="a_content">
            @php
                $content=preg_replace(["/style=.+?['|\"]/i","/width=.+?['|\"]/i","/height=.+?['|\"]/i"],'',$thisArticleInfos->body);
               $content=str_replace(PHP_EOL,'',$content);
               $content=str_replace(['<p >','<strong >','<br >','<br />'],['<p>','<strong>','<br>','<br/>'],$content);
               $content=str_replace(
               [
               '<p><strong><br/></strong></p>',
               '<p><strong><br></strong></p>',
               '<p><br></p>',
               '<p><br/></p>',
               '　　'
               ],'',$content
               );
                $content=str_replace(["\r","\t",'<span >　　</span>','&nbsp;','　','bgcolor="#FFFFFF"'],'',$content);
                $content=str_replace(["<br  /><br  />"],'<br/>',$content);
                $content=str_replace(["<br/><br/>"],'<br/>',$content);
                $content=str_replace(["<br/> <br/>"],'<br/>',$content);
                $content=str_replace(["<br />　　<br />"],'<br/>',$content);
                $content=str_replace(["<br/>　　<br/>"],'<br/>',$content);
                $content=str_replace(["<br /><br />"],'<br/>',$content);
               $pattens=array(
               "#<p>[\s| |　]?<strong>[\s| |　]?</strong></p>#",
               "#<p>[\s| |　]?<strong>[\s| |　]+</strong></p>#",
               "#<p>[\s| |　]+<strong>[\s| |　]+</strong></p>#",
               "#<p>[\s| |　]?</p>#",
               "#<p>[\s| |　]+</p>#"
               );
               $content=preg_replace($pattens,'',$content);
               echo $content;
            @endphp
        </div>
    </div>
    @include('mobile.liuyan')
    <div id="newslist-cmodels">
        <div class="newslist-3198modelboxs clearfix">
            <i></i>
            <div class="title">项目资讯</div>
            <div class="newslist-3198_models">
                @foreach($thisarticlelatestnewslists as $thisarticlelatestnewslist)
                    @if(!empty($thisarticlelatestnewslist->litpic) && $thisarticlelatestnewslist->litpic!='/receptions/images/nopic.png')
                        <div class="newslist-cmodelslist">
                            <a href="/news/{{$thisarticlelatestnewslist->id}}">
                                <div class="left fl">
                                    <div class="lefttitle">{{$thisarticlelatestnewslist->title}}</div>
                                    <div class="text">
                                        <div class="message">来源：{{config('app.indexname')}}</div>
                                    </div>
                                </div>
                                <div class="right fr">
                                    <img src="{{$thisarticlelatestnewslist->litpic}}">
                                </div>
                            </a>
                        </div>
                    @else
                        <li class="anxjm-per-jmxx anxjm_brandnews">
                            <h3 class="anxjm_brandnews_title"><a href="/news/{{$thisarticlelatestnewslist->id}}" >{{$thisarticlelatestnewslist->title}}</a></h3>
                            <div class="newsdesc">
                                {{str_limit($thisarticlelatestnewslist->description,120,'...')}}
                            </div>
                        </li>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
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

