<div class="ny-yop">
    <div class="ny-yop-l">
        <a href="/xm/{{$thisArticleInfos->id}}"><img src="{{$thisArticleInfos->litpic}}" alt="{{$thisArticleInfos->brandname}}"/></a><a href="/xm/{{$thisArticleInfos->id}}">
            <strong> <h1>{{$thisArticleInfos->brandname}}</h1> </strong>
        </a>
        <p>
            项目官方：{{$thisArticleInfos->brandgroup}}
            <br/>
            投资金额：{{$investmentlists[$thisArticleInfos->tzid]}}
        </p>
    </div>
    <div class="ny-yop-r">
        <ul>
            <li>
                <a href="#msg">
                    <img src="/public/images/ny_ic1.jpg" alt="立即留言"/>
                    <p>立即留言</p>
                </a>
            </li>
            <li>
                <a href="#msg">
                    <img src="/public/images/ny_ic2.jpg" alt="联系电话"/>
                    <p>联系电话</p>
                </a>
            </li>
            <li>
                <a onClick="AddFavorite('http://www.3198.com/xm/{{$thisArticleInfos->id}}','3198创业致富网')" href="javascript:void(0)">
                    <img src="/public/images/ny_ic3.jpg" alt="我要收藏"/>
                    <p>我要收藏</p>
                </a>
            </li>
        </ul>
    </div>
    <script>
        function AddFavorite(sURL, sTitle) {

            sURL = encodeURI(sURL);

            try {

                window.external.addFavorite(sURL, sTitle);

            } catch (e) {

                try {

                    window.sidebar.addPanel(sTitle, sURL, "");

                } catch (e) {

                    alert("加入收藏失败,请使用Ctrl+D进行添加,或手动在浏览器里进行设置.");

                }

            }

        }
    </script>
    <div class="clearfix"></div>
    <div class="ny-nav ">
        <ul class="ce">
            <li>
                <a href="/xm/{{$thisArticleInfos->id}}"
                   class="xz">品牌主页</a>
            </li>
            <li>
                <a id="navon2"
                   href="javascript:void(0)" >加盟优势</a>
            </li>
            <li>
                <a href="/xm/{{$thisArticleInfos->id}}/news"
                   target="_blank">品牌新闻</a>
            </li>
            <li>
                <a href="/xm/{{$thisArticleInfos->id}}/wenda"
                   target="_blank">品牌问答</a>
            </li>
            <li>
                <a id="navon6"
                   href="javascript:void(0)" >条件流程</a>
            </li>
            <li>
                <a id="navon4"
                   href="javascript:void(0)" >产品展示</a>
            </li>
            <li>
                <a id="navon5" href="#msg">在线留言</a>
            </li>
        </ul>
    </div>
</div>
<div class="ny_js">
    <!-- 幻灯片 Start -->
    <div class="flexslider">
        <ul class="slides">
            @foreach(explode(',',$thisArticleInfos->imagepics) as $pic)
                <li>
                    <img src="{{$pic}}" alt="{{$thisArticleInfos->brandname}}" />
                    <span>{{$thisArticleInfos->brandname}}</span>
                </li>
            @endforeach
        </ul>
    </div>
    <script>
        $(function(){
            $('.flexslider').flexslider({
                directionNav: true,
                pauseOnAction: false
            });

        });
    </script>
    <!-- 幻灯片 End -->
    <ul class="ny-jsxq">
        <li><span>品牌名称：</span>{{str_replace('加盟','',$thisArticleInfos->brandname)}}</li>
        <li><span>行业分类：</span>{{$thisArticleTypeInfo->typename}}</li>
        <li><span>加盟范围：</span>{{$thisArticleInfos->brandmap}}</li>
        <li><span>品牌发源：</span>{{$arealists[$thisArticleInfos->province_id]}}</li>
        <li><span>投资金额：</span>{{$investmentlists[$thisArticleInfos->tzid]}}</li>
        <li><span>合作模式：</span></li>
        <li class="ic1"><span>主营产品：</span>{{$thisArticleInfos->brandmap}}</li>
        <li class="ic1"><span>运营机构：</span>{{$thisArticleInfos->brandgroup}}</li>
        <li class="ic1"><span>标签：{{$thisArticleInfos->tags}}</span></li>
    </ul>
    <ul class="ny-jsxq-zx">
        <li>
            <a href="#msg">
                <img src="/public/images/ny_zx1.jpg" alt="马上留言" />
            </a>
        </li>
        <li>
            <a href="#msg">
                <img src="/public/images/ny_zx2.jpg" alt="免费通话" />
            </a>
        </li>
        <li>
            <a href="#msg">
                <img src="/public/images/ny_zx3.jpg" alt="在线咨询" />
            </a>
        </li>
    </ul>
</div>
