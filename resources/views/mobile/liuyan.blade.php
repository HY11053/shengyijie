@if(isset($thisBrandArticleInfos) && !empty($thisBrandArticleInfos))
<div id="phone-model" class="clearfix">
    <div class="phone-modelbox">
        <i></i>
        <div class="title">在线留言</div>
        <form onsubmit="return false;">
            <input type="hidden" name="project_id" id="{{$thisBrandArticleInfos->id}}" value="43790">
            <input type="hidden" name="cid" id="cid" value="{{$thisArticleTopTypeInfo->typename}}">
            <input type="hidden" name="title" id="fm_title" value="{{$thisBrandArticleInfos->brandname}}">
            <input type="hidden" name="cla" id="cla" value="{{$thisArticleTypeInfo->typename}}">
            <input type="hidden" name="combrand" id="combrand" value="{{$thisBrandArticleInfos->brandname}}">
            <div class="inputbox">
                <input type="text" name="username" id="guestname" placeholder="您的真实姓名">
                <span>姓名：</span>
                <div class="tip">*姓名不可以为空</div>
            </div>
            <div class="inputbox">
                <input type="tel" name="iphone" id="phonenum" placeholder="电话是与您联系的重要方式">
                <span>手机：</span>
                <div class="tip">*不是完整的11位手机号或者正确的手机号前七位</div>
            </div>
            <div class="inputbox">
                <input type="text" name="note" id="note" placeholder="我对此项目很感兴趣，请联系我。">
                <span>留言：</span>
                <div class="tip">*留言不可以为空</div>
            </div>
            <button type="submit" id="tj_btn" class="submitmessagebtn">提交留言</button>
        </form>
        <div class="lysm">
            本站为资讯展示网站，本网页信息来源互联网，本平台不保证信息的真实性，请用户自行与商家联系核对真实性。此次留言将面向网站内所有页面项目产生留言。
        </div>
    </div>
</div>
@if(!Jenssegers\Agent\Facades\Agent::isRobot())
    <div class="popup_mask" style="visibility: visible; display: none;">
        <div class="lastCeng"></div>
        <div class="CengBox">
            <img src="/mobile/images/kai.png" class="money">
            <span class="popup_close"></span>
            <p class="top1"><span id="brand_name_UNM">立即获取</span><span><font id="fengex">|</font></span><span>加盟方案</span></p>
            <form class="modalbox" onsubmit="return false">
                <input type="hidden" name="msg_project_id" id="msg_project_id" value="{{$thisArticleInfos->id}}">
                <input type="hidden" name="msg_cid" id="msg_cid" value="{{$thisArticleTopTypeInfo->typename}}">
                <input type="hidden" name="msg_fm_title" id="msg_fm_title" value="{{$thisBrandArticleInfos->brandname}}">
                <input type="hidden" name="msg_cla" id="msg_cla" value="{{$thisArticleTypeInfo->typename}}">
                <input type="hidden" name="msg_combrand" id="msg_combrand" value="{{$thisBrandArticleInfos->brandname}}">
                <input type="text" maxlength="11" id="msg_phone" placeholder="请输入手机号码">
                <input type="text" id="msg_name" placeholder="请输入您的称呼">
                <button type="submit" id="msg_sub" class="sure">立即咨询</button>
            </form>
        </div>
    </div>
@endif
@elseif(isset($thisArticleInfos) && !empty($thisArticleInfos->brandname))
    <div id="phone-model" class="clearfix">
        <div class="phone-modelbox">
            <i></i>
            <div class="title">在线留言</div>
            <form onsubmit="return false;">
                <input type="hidden" name="project_id" id="{{$thisArticleInfos->id}}" value="43790">
                <input type="hidden" name="cid" id="cid" value="{{$thisArticleTopTypeInfo->typename}}">
                <input type="hidden" name="title" id="fm_title" value="{{$thisArticleInfos->brandname}}">
                <input type="hidden" name="cla" id="cla" value="{{$thisArticleTypeInfo->typename}}">
                <input type="hidden" name="combrand" id="combrand" value="{{$thisArticleInfos->brandname}}">
                <div class="inputbox">
                    <input type="text" name="username" id="guestname" placeholder="您的真实姓名">
                    <span>姓名：</span>
                    <div class="tip">*姓名不可以为空</div>
                </div>
                <div class="inputbox">
                    <input type="tel" name="iphone" id="phonenum" placeholder="电话是与您联系的重要方式">
                    <span>手机：</span>
                    <div class="tip">*不是完整的11位手机号或者正确的手机号前七位</div>
                </div>
                <div class="inputbox">
                    <input type="text" name="note" id="note" placeholder="我对此项目很感兴趣，请联系我。">
                    <span>留言：</span>
                    <div class="tip">*留言不可以为空</div>
                </div>
                <button type="submit" id="tj_btn" class="submitmessagebtn">提交留言</button>
            </form>
            <div class="lysm">
                本站为资讯展示网站，本网页信息来源互联网，本平台不保证信息的真实性，请用户自行与商家联系核对真实性。此次留言将面向网站内所有页面项目产生留言。
            </div>
        </div>
    </div>
    @if(!Jenssegers\Agent\Facades\Agent::isRobot())
        <div class="popup_mask" style="visibility: visible; display: none;">
            <div class="lastCeng"></div>
            <div class="CengBox">
                <img src="/mobile/images/kai.png" class="money">
                <span class="popup_close"></span>
                <p class="top1"><span id="brand_name_UNM">立即获取</span><span><font id="fengex">|</font></span><span>加盟方案</span></p>
                <form class="modalbox" onsubmit="return false">
                    <input type="hidden" name="msg_project_id" id="msg_project_id" value="{{$thisArticleInfos->id}}">
                    <input type="hidden" name="msg_cid" id="msg_cid" value="{{$thisArticleTopTypeInfo->typename}}">
                    <input type="hidden" name="msg_fm_title" id="msg_fm_title" value="{{$thisArticleInfos->brandname}}">
                    <input type="hidden" name="msg_cla" id="msg_cla" value="{{$thisArticleTypeInfo->typename}}">
                    <input type="hidden" name="msg_combrand" id="msg_combrand" value="{{$thisArticleInfos->brandname}}">
                    <input type="text" maxlength="11" id="msg_phone" placeholder="请输入手机号码">
                    <input type="text" id="msg_name" placeholder="请输入您的称呼">
                    <button type="submit" id="msg_sub" class="sure">立即咨询</button>
                </form>
            </div>
        </div>
    @endif
@endif

@if(!Jenssegers\Agent\Facades\Agent::isRobot())
<div class="zxNavBar">
    <div class="zxnavbarcon">
        <button role="button" tabindex="0" id="btn-open" class="zxHdImgcons">
            <div class="zxHdImg">
                <img src="/mobile/images/hdimg2.jpg">
            </div>
            <div class="zxHdName">
                <div class="zxHdName-peo">3198创业致富网</div>
                <p>招商经理  <span>联系她</span></p>
            </div>
        </button>
        <div class="mfcall js_popup">免费通话</div>
        <div class="mfcsain js_popup">立即咨询</div>
    </div>
</div>
@endif
