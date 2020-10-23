<div class="ny_r">
    <div class="ny_r-rm">
        <div class="ny_l-t1">
            <strong>热门品牌</strong>
        </div>
        <ul class="ny_r-rm-c">
            @foreach($hotbrsnds as $hotbrand)
                <li>
                        <span>
                            <a href="/xm/{{$hotbrand->id}}" target="_blank">
                                <img alt="{{str_replace('加盟','',$hotbrand->brandname)}}" src="{{$hotbrand->litpic}}"></a>
                        </span>
                    <strong><a href="/xm/{{$hotbrand->id}}" target="_blank">{{str_replace('加盟','',$hotbrand->brandname)}}</a></strong>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="ny_r-rm">
        <div class="ny_l-t1">
            <strong>同类品牌推荐</strong>
        </div>
        <ul class="ny_r-rm-c">
            @foreach($tongleibrands as $tongleibrand)
                <li>
                            <span>
                                <a href="/xm/{{$tongleibrand->id}}" target="_blank">
                                    <img alt="{{str_replace('加盟','',$tongleibrand->brandname)}}" src="{{$tongleibrand->litpic}}"></a>
                            </span>
                    <strong><a href="/xm/{{$tongleibrand->id}}" target="_blank">{{str_replace('加盟','',$tongleibrand->brandname)}}</a></strong>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="ny_r-rm">
        <div class="ny_l-t1"><strong>品牌排行榜</strong> </div>
        <div class="clearfix"></div>
        <ul class="zc_text1">
            @foreach($paihangbangs as $paihangbang)
                <li>
                    <strong>{{$loop->iteration}}</strong>
                    <p class="on"> <em>{{$paihangbang->click}}</em>
                        {{$paihangbang->brandname}}
                    </p>
                    <dl class="case1">
                        <dt>
                            <a href="/xm/{{$paihangbang->id}}">
                                <img src="{{$paihangbang->litpic}}" />
                            </a>
                        </dt>
                        <dd>
                            <div class="h3">
                                <a href="/xm/{{$paihangbang->id}}"></a>
                            </div>
                            <span>投资金额：{{$investmentlists[$paihangbang->tzid]}}</span>
                        </dd>
                    </dl>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="ny_r-rm">
        <div class="ny_l-t1">
            <strong>最新入住品牌</strong>
        </div>
        <ul class="ny_r-rm-c">
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
