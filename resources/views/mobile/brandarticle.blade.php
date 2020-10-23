@extends('mobile.mobile')
@section('title'){{$thisArticleInfos->title}}- {{config('app.indexname')}}@stop
@section('keywords'){{$thisArticleInfos->keywords}}@stop
@section('description'){{$thisArticleInfos->description}}@stop
@section('main_content')
    <div class="weizhi_locations">
        <span> <a href="/"><i class="iconfont icon-dingwei"></i> 首页</a> > <a href="/{{$thisArticleTopTypeInfo->real_path}}">{{$thisArticleTopTypeInfo->typename}}</a>
            &gt;<a href="/{{$thisArticleTopTypeInfo->real_path}}/{{$thisArticleTypeInfo->id}}">{{$thisArticleTypeInfo->typename}}</a>
            &gt;<a class="dq">{{$thisArticleInfos->brandname}}连锁</a></span>
    </div>
    @include('mobile.brand_header')
    <div class="content-main" id="b-info">
        <div class="jm_xq_con on linear-gradient">
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
        <div class="display" style="display: block;"><span>展开全文 <i class="iconfont icon-jiantou-xia"></i></span></div>
        <div class="hidden" style="display: none;"><span>收起全文 <i class="iconfont icon-jiantou-shang"></i></span></div>
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
    @if(count($brandnews))
        <div id="newslist-cmodels">
            <div class="newslist-3198modelboxs clearfix">
                <i></i>
                <div class="title">项目资讯</div>
                <div class="newslist-3198_models">
                    @foreach($brandnews as $brandnew)
                        <div class="newslist-cmodelslist">
                            <a href="/news/{{$brandnew->id}}">
                                <div class="left fl">
                                    <div class="lefttitle">{{$brandnew->title}}</div>
                                    <div class="text">
                                        <div class="message">来源：{{config('app.indexname')}}</div>
                                    </div>
                                </div>
                                <div class="right fr">
                                    <img src="{{$brandnew->litpic}}">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@stop
