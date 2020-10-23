<div class="w260">
    <div class="rbk r_biaoqian">
        <div class="h2">相关推荐</div>
        <div class="rbka">
            <div class="bqgao">
                <ul class="clearfix" oriheight="150" style="height: 90px;">
                    @foreach($thisTypeSonsInfos as $thisTypeSonsInfo)
                    <li><a href="/{{$thisArticleTopTypeInfo->real_path}}/{{$thisTypeSonsInfo->id}}">{{$thisTypeSonsInfo->typename}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="more22"><span>更多</span></div>

            <script type="text/javascript">

                $(function () {

                    $('.bqgao ul').each(function () {
                        if ($(this).height() > 90) {
                            $(this).attr('oriheight', $(this).height())
                            $(this).animate({height: "90px"})
                            $(this).parent().next('.more22').show()
                        } else {
                            $(this).parent().next('.more22').hide()
                        }

                    })

                    $('.more22 span').on('click', function (e) {
                        // alert($(this).prev().children('.bqgao').height() )
                        var target = $(this).parent().prev('div').children('ul')
                        if ($(this).parent().prev('div').children('ul').height() > 90) {
                            $(this).parent().removeClass('morea22').children('span').html('查看详情')
                            target.animate({height: "90"})
                        } else {
                            $(this).parent().addClass('morea22').children('span').html('收起内容')
                            target.animate({height: target.attr('oriheight')})
                        }

                    })
                });
            </script>

        </div>
    </div>


    <div class="rbk r_ullb1">
        <div class="h2" style="overflow:hidden;"><em><a href="/zhishi/{{$thisArticleTopTypeInfo->real_path}}/{{$thisArticleTypeInfo->id}}">更多&gt;&gt;</a></em>{{$thisArticleTypeInfo->typename}}知识</div>
        <div class="rbka">
            <ul class="clearfix">
                @foreach($knowledgelists as $knowledgelist)
                <li><a href="/zhishi/{{$knowledgelist->id}}">{{$knowledgelist->title}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="rbk r_ullb1">
        <div class="h2"><em><a href="/news/{{$thisArticleTopTypeInfo->real_path}}/{{$thisArticleTypeInfo->id}}">更多&gt;&gt;</a></em>{{$thisArticleTypeInfo->typename}}资讯</div>
        <div class="rbka">
            <ul class="clearfix">
                @foreach($thisarticlelatestnewslists as $thisarticlelatestnewslist)
                <li><a href="/news/{{$thisarticlelatestnewslist->id}}">{{$thisarticlelatestnewslist->title}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="rbk r_ullb2">
        <div class="h2">干洗最新入住商家</div>
        <div class="rbka">
            <ul class="clearfix">

                @foreach($latestBrands as $latestbrand)
                    <li>
                        <span>
                            <a href="/xm/{{$latestbrand->id}}" target="_blank">
                                <img alt="{{$latestbrand->brandname}}" src="{{$latestbrand->litpic}}"></a>
                        </span>
                        <strong>
                            <a href="/xm/{{$latestbrand->id}}" target="_blank">{{$latestbrand->brandname}}</a>
                        </strong>
                    </li>
                @endforeach

            </ul>
        </div>

    </div>


</div>
