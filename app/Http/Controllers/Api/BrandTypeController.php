<?php

namespace App\Http\Controllers\Api;


use App\AdminModel\Acreagement;
use App\AdminModel\Arctype;
use App\AdminModel\Area;
use App\AdminModel\Brandarticle;
use App\AdminModel\InvestmentType;
use App\Scopes\PublishedScope;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandTypeController extends Controller
{
    /**根据品牌名称获取对应品牌
     * @param Request $request
     * @return false|string|void
     */
    public function getBrandId(Request $request){
        $brandidinfos=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('ismake',1)->where('brandname','like','%'.$request->brandname.'%')->orderBy('id','desc')->first(['id','typeid']);
        if (!empty($brandidinfos)){
            $brandcid=Arctype::where('id',$brandidinfos->typeid)->value('reid');
            $brandidinfos=collect(["cid"=>$brandcid,'id'=>$brandidinfos->id,'typeid'=>$brandidinfos->typeid]);
            return json_encode($brandidinfos);
        }else{
            return ;
        }

    }

    /**获取顶级栏目信息
     * @return false|string
     */
    public function getBrandTid(){
        $tids=Arctype::where('mid',1)->where('reid',0)->where('is_write',1)->pluck('typename','id');
        return $tids;
    }

    /**获取对应顶级栏目下对应分类
     * @param Request $request
     * @return false|string
     */
    public function getBrandCid(Request $request){
        $cids=Arctype::where('mid',1)->where('reid',$request->topid)->where('is_write',1)->pluck('typename','id');
        return $cids;
    }

    /**获取对应分类下品牌名称
     * @param Request $request
     * @return false|string
     */
    public function getBrandnames(Request $request){
        $brandnames=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('ismake',1)->where('typeid',$request->brandtypeid)->orderBy('id','desc')->pluck('brandname','id');
        return $brandnames;
    }

    /**获取普通文档栏目分类
     * @return false|string
     */
    public function getArticleType(){
        $types=Arctype::where('mid',0)->where('is_write',1)->get([]);
        return json_encode($types);
    }

    /**获取当前品牌图片列表
     * @param Request $request
     * @return false|string
     */
    public function getBrandPic(Request $request){
        $imagepics=explode(',',Brandarticle::withoutGlobalScope(PublishedScope::class)->where('ismake',1)->where('mid',1)->where('id',$request->brandid)->value('imagepics'));
        preg_match_all("/src=[\"|'|\s]([^\"|^\'|^\s]*?)/isU",Brandarticle::withoutGlobalScope(PublishedScope::class)->where('ismake',1)->where('mid',1)->where('id',$request->brandid)->value('body'),$img_array);
        $bodypics = array_unique($img_array[1]);
        $pics=[];
        foreach (array_filter(array_merge($imagepics,$bodypics)) as $pic){
            $pics[]=config('app.url').str_replace(config('app.url'),'',$pic);
        }
        return json_encode($pics);
    }

    /**获取品牌省份信息
     * @return false|string
     */
    public function getProvinces(){
        $provinces=Area::where('parentid','1')->pluck('regionname','id');
        return json_encode($provinces);
    }

    /**获取品牌对应省份下对应城市
     * @param Request $request
     * @return false|string
     */
    public function getCitys(Request $request){
        $citys=Area::where('parentid',$request->province_id)->pluck('regionname','id');
        return json_encode($citys);
    }

    /**获取投资分类
     * @return false|string
     */
    public function getInvestments(){
        $investments=InvestmentType::orderBy('id','asc')->pluck('type','id');
        return json_encode($investments);

    }

    /**获取面积分类
     * @return false|string
     */
    public function getAcreagements(){
        $acreagements=Acreagement::orderBy('id','asc')->pluck('type','id');
        return json_encode($acreagements);
    }

    /**获取对应品牌投资分类金额
     * @param Request $request
     * @return mixed
     */
    public function getBrandpay(Request $request){
        $tzid=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('ismake',1)->where('id',$request->id)->value('tzid');
        if (!empty($tzid)){
            return InvestmentType::where('id',$tzid)->value('type');
        }
    }
    /**获取对应品牌面积
     * @param Request $request
     * @return mixed
     */
    public function getBrandAcreage(Request $request){
        $acreage=Brandarticle::where('id',$request->id)->value('acreage');
        if (!empty($acreage)){
            return Acreagement::where('id',$acreage)->value('type');
        }
    }
}
