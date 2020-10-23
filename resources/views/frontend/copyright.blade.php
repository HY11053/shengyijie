@extends('frontend.frontend')
@section('title')法律声明 - 3198创业致富网@stop
@section('keywords')法律声明@stop
@section('description')法律声明@stop
@section('headlibs')
    <script src="/public/js/lanrenzhijia.js" type="text/javascript"></script>
    <script type="text/javascript" src="/public/js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" src="/public/js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="/public/js/MSClass.js"></script>
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
            <span><a href="/" target="_blank">3198创业商机网</a>&gt;<a target="_blank">法律声明</a></span>
        </div>
        <div style="border-top:2px solid #d81f13;margin-top:10px;"></div>

        <div class="about_us">
            <div class="h2">法律声明</div>
            <p>1、3198创业商机网所提供的项目、资讯等相关信息，内容大多来自互联网或者由商家直接提供，其所涉及的项目、商品、联络信息等，商家对其真实性承担责任。如若您认为本网站网页的相关内容，侵害到您的合法权益，您应及时联系本网站，并提供相关证明（如身份证明、权属证明等），本网站将及时删除涉嫌侵权的内容。</p><br>

            <p>2、本网站（除商家提供的项目信息外）版权属于上海佐赛网络科技有限公司所有，未经允许，任何企业、网站以及个人不得擅自使用。经过授权使用作品的，应在授权使用范围内使用，并注明来源于“3198创业商机网”，违者本网站将有权追究法律责任。</p><br>


            <p>3、尊重用户隐私是3198创业商机网的一项基本政策。3198创业商机网不会在未经合法用户授权时向第三方公开或透露。以下情况除外：</p>
            <p>⑴用户对自身信息保密不当原因，导致用户非公开信息泄露；</p>
            <p>⑵由于网络线路、黑客攻击、计算机病毒、政府管制等原因造成的资料泄露、丢失、被盗用或被篡改等；</p>
            <p>⑶有关法律要求提供用户的个人信息；</p>
            <p>⑷在紧急情况下为维护用户和公众的生命、财产安全。</p>

        </div>


    </div>
@stop

