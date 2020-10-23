<div class="clearfix"></div>
<div class="clear"></div>
<div class="ny-khly ny-khly-b" id="div5">
    <h3>客服留言</h3>
    <ul id="textUL">
        <li><span class="data">06-26 07:24</span>巴彦淖尔盟的<span class="red">王先生&nbsp;&nbsp;180******33</span>对该项目产生意向：你们的总部在哪里？</li>
        <li><span class="data">06-26 11:42</span>万宁的<span class="red">王女士&nbsp;&nbsp;181******88</span>对该项目产生意向：你们的总部在哪里？</li>
        <li><span class="data">06-27 04:15</span>吐鲁番的<span class="red">罗先生&nbsp;&nbsp;181******53</span>对该项目产生意向：你们的总部在哪里？</li>
        <li><span class="data">06-27 08:35</span>马鞍山的<span class="red">李女士&nbsp;&nbsp;138******78</span>对该项目产生意向：我想加盟，请联系我。</li>
        <li><span class="data">06-27 12:55</span>巴中的<span class="red">张先生&nbsp;&nbsp;150******23</span>对该项目产生意向：我想加盟，请来电告知加盟细节。</li>
        <li><span class="data">06-27 05:16</span>驻马店的<span class="red">侯女士&nbsp;&nbsp;177******23</span>对该项目产生意向：你们的总部在哪里？</li>
        <li><span class="data">06-27 09:55</span>海南的<span class="red">王先生&nbsp;&nbsp;186******75</span>对该项目产生意向：你们的总部在哪里？</li>
        <li><span class="data">06-28 02:29</span>揭阳的<span class="red">王先生&nbsp;&nbsp;138******40</span>对该项目产生意向：你好！我想加盟代理你们的品牌，请联系我。</li>
        <li><span class="data">06-28 06:51</span>阜阳的<span class="red">张先生&nbsp;&nbsp;186******14</span>对该项目产生意向：我想加盟，请来电告知加盟细节。</li>
        <li><span class="data">06-28 11:08</span>惠州的<span class="red">陆女士&nbsp;&nbsp;156******70</span>对该项目产生意向：你们的总部在哪里？</li>
    </ul>
    <script>
        var Marquee1=new Marquee("textUL");Marquee1.Step=1; Marquee1.Start();
    </script>
</div>
<div class="clear"></div>
<div class="hy-mfdh">
    <a name="msg"></a>
    <h3>
        如果您对该项目感兴趣，请使用 <em>免费电话咨询</em>
        或者
        <strong>留言</strong>
    </h3>
    <div class="leaveCon-left fl">
        <div class="leaveCon-tit">3198企业在线</div>
        <div class="leaveCon-list">
            <ul>
                <li>
                    <i class="icon-angle"></i>
                    <h5>口碑胜于一切</h5>
                    <p>3198网站成功收获财富</p>
                </li>
                <li>
                    <i class="icon-angle"></i>
                    <h5>诚信招商项目</h5>
                    <p>3198只推荐拥有合法资质与证件齐全的项目</p>
                </li>
                <li style="border-bottom: none;">
                    <i class="icon-angle"></i>
                    <h5>信息安全保护</h5>
                    <p>采取严格安全信息，保证您的个人信息安全</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="hy-mfdh-r">
        <form onsubmit="return false" id="dform" >
            <input type="hidden" name="realm" value="www.3198.com">
            <input type="hidden" name="job" value="guestbook">
            <input type="hidden" name="project_id" id="project_id" value="{{$thisArticleInfos->id}}">
            <input type="hidden" name="cid" id="cid" value="{{$thisArticleTopTypeInfo->typename}}">
            <input type="hidden" name="title" id="fm_title" value="{{$thisArticleInfos->brandname}}"/>
            <input type="hidden" name="cla" id="cla" value="{{$thisArticleTypeInfo->tyname}}"/>
            <input type="hidden" name="combrand" id="combrand" value="{{$thisArticleTypeInfo->brandname}}"/>
            <input type="hidden" name="resolution" id="resolution"/>
            <ul class="ull">
                <li>
                    <span><i>*</i>姓名：</span>
                    <input id="truename" name="username" type="text" class="ny-xm" placeholder="您的真实姓名" value="" />
                </li>
                <li>
                    <span><i>*</i>手机：</span>
                    <input id="telephone" name="iphone" type="text" class="ny-xm" placeholder="电话是与您联系的重要方式" value="" />
                </li>
                <li>
                    <span><i>*</i>金额：</span>
                    <select name="jine" style="line-height:32px;height:32px;">
                        <option value="0">请选择金额</option>
                        <option value="1">1万元以下</option>
                        <option value="2">1~5万元</option>
                        <option value="3">5~10万元</option>
                        <option value="4">10~20万元</option>
                        <option value="5">20~50万元</option>
                        <option value="6">50~100万元</option>
                        <option value="7">100万以上</option>
                    </select>
                </li>
            </ul>
            <div class="ullll">
                <strong>留言：</strong>
                <textarea id="content" class="ny-txt" name="content" cols="" rows="" placeholder="请输入您的留言内容或选择快捷留言" ></textarea>
                <div class="clear"></div>
                <div class="kuaijie" id="kuaijie">
                    <div class="kuaijie-title">您可以选择以下快捷留言</div>
                    <ul class="kuaijie-list">
                        <li>我有意向，请问加盟费是多少？</li>
                        <li>很想合作来电话细谈吧。</li>
                        <li>请问具体的加盟流程是怎样的？</li>
                        <li>请问贵公司哪里有样板店或直营店？</li>
                        <li>请给我打电话并寄送加盟资料。</li>
                    </ul>
                </div>
                <script src="/public/js/js.js"></script>
            </div>
            <script>
                $(function () {
                    $('.pinglun_list dl').on('mouseover mouseleave',function(e){
                        e.type=='mouseover' ? $(this).addClass("jg") :
                            $(this).removeClass("jg")
                    })
                });
            </script>
            <input name="" type="submit" class="ny-ly-anniu" id="sub_btn" value="提交留言" />
        </form>
    </div>
    <div class="clearfix"></div>
</div>
<script src="/public/js/main.js"></script>
