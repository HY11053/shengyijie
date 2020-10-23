<?php

namespace App\Listeners;

use App\AdminModel\Acreagement;
use App\AdminModel\Arctype;
use App\AdminModel\Brandarticle;
use App\Events\BrandArticleCacheCreateEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class BrandArticleCacheCreateEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BrandArticleCacheCreateEvent  $event
     * @return void
     */
    public function handle(BrandArticleCacheCreateEvent $event)
    {
        $id=$event->brandarticle->id;
        if (Brandarticle::find($id))
        {
            //清除当前缓存 重新写入 兼容Update
            Cache::forget('thisBrandArticleInfos'.$id);
            //当前品牌文档信息，请保持缓存名称和普通文档的所属品牌缓存名称相同
            $thisArticleInfos=Cache::remember('thisBrandArticleInfos'.$id,  config('app.cachetime')+rand(60,60*24), function() use ($id){
                return Brandarticle::findOrFail($id);
            });
            //当前品牌所属分类
            $thisArticleTypeInfo=Cache::remember('thisArticleTypeInfo'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleInfos){
                return Arctype::where('id',$thisArticleInfos->typeid)->first(['id','typename','reid']);
            });
            //当前品牌所属父分类
            $thisArticleTopTypeInfo=Cache::remember('thisArticleTopTypeInfo'.$thisArticleTypeInfo->reid,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleTypeInfo){
                return Arctype::where('id',$thisArticleTypeInfo->reid)->first(['id','typename','real_path']);
            });
            $thisTypeSonids=Cache::remember('thisTypeSonids'.$thisArticleTopTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleTopTypeInfo){
                return Arctype::where('reid',$thisArticleTopTypeInfo->id)->pluck('id');
            });
            //热门品牌
            Cache::forget('hotbrsnds');
            Cache::remember('hotbrsnds',  config('app.cachetime')+rand(60,60*24), function() {
                return Brandarticle::take(6)->orderBy('click','desc')->get(['id','litpic','brandname']);
            });
            //同类品牌
            Cache::forget('tongleibrands'.$thisArticleInfos->typeid);
            Cache::remember('tongleibrands'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleInfos){
                return Brandarticle::where('typeid',$thisArticleInfos->typeid)->skip(10)->take(6)->orderBy('click','desc')->get(['id','litpic','brandname']);
            });
            //排行榜
            Cache::forget('thisArticleInfosphb'.$thisArticleInfos->typeid);
            Cache::remember('thisArticleInfosphb'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleInfos){
                return Brandarticle::where('typeid',$thisArticleInfos->typeid)->take(10)->orderBy('click','desc')->get(['id','litpic','brandname','click','tzid']);
            });
            //最新品牌
            Cache::forget('article_latestbrands');
            Cache::remember('article_latestbrands',  config('app.cachetime')+rand(60,60*24), function(){
                return Brandarticle::take(6)->orderBy('id','desc')->get(['id','litpic','brandname']);
            });
            //XM下最新品牌
            Cache::forget('thisXmTypelatestbrands');
            Cache::remember('thisXmTypelatestbrands',  config('app.cachetime')+rand(60,60*24), function(){
                return Brandarticle::where('mid',1)->skip(10)->take(6)->orderBy('id','desc')->get(['id','brandname','litpic']);
            });
            //XM下品牌排行榜
            Cache::forget('thisXmTypepaihangbangs');
            Cache::remember('thisXmTypepaihangbangs',  config('app.cachetime')+rand(60,60*24), function() {
                return Brandarticle::where('mid',1)->take(10)->orderBy('click','desc')->get(['id','brandname','litpic','click','tzid']);
            });
            //顶级分类下最新所属分类下品牌
            Cache::forget('thisTypelatestbrands'.$thisArticleTopTypeInfo->id);
            Cache::remember('thisTypelatestbrands'.$thisArticleTopTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisTypeSonids){
                return Brandarticle::where('mid',1)->whereIn('typeid',$thisTypeSonids)->skip(10)->take(6)->orderBy('id','desc')->get(['id','brandname','litpic']);
            });
            //顶级分类下所属分类排行榜
            Cache::forget('thisTypepaihangbangs'.$thisArticleTopTypeInfo->id);
            Cache::remember('thisTypepaihangbangs'.$thisArticleTopTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisTypeSonids){
                return Brandarticle::where('mid',1)->whereIn('typeid',$thisTypeSonids)->take(10)->orderBy('click','desc')->get(['id','brandname','litpic','click','tzid']);
            });

            //当前分类下最新所属分类下品牌
            Cache::forget('thisTypelatestbrands'.$thisArticleTypeInfo->id);
            Cache::remember('thisTypelatestbrands'.$thisArticleTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleTypeInfo){
                return Brandarticle::where('mid',1)->where('typeid',$thisArticleTypeInfo->id)->skip(10)->take(6)->orderBy('id','desc')->get(['id','brandname','litpic']);
            });
            //当前分类下所属分类排行榜
            Cache::forget('thisTypepaihangbangs'.$thisArticleTypeInfo->id);
            Cache::remember('thisTypepaihangbangs'.$thisArticleTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleTypeInfo){
                return Brandarticle::where('mid',1)->where('typeid',$thisArticleTypeInfo->id)->take(10)->orderBy('click','desc')->get(['id','brandname','litpic','click','tzid']);
            });
            //新闻分类列表页最新品牌
            Cache::forget('article_latestbrands'.$thisArticleTypeInfo->id);
            Cache::remember('article_latestbrands'.$thisArticleTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use($thisArticleTypeInfo){
                return Brandarticle::take(6)->orderBy('id','desc')->where('typeid',$thisArticleTypeInfo->id)->get(['id','litpic','brandname']);
            });
            //新闻封面页最新品牌
            Cache::forget('article_latestbrands');
            Cache::remember('article_latestbrands',  config('app.cachetime')+rand(60,60*24), function(){
                return Brandarticle::take(6)->orderBy('id','desc')->get(['id','litpic','brandname']);
            });
            //搜索页最新品牌
            Cache::forget('search_latestbrands');
            Cache::remember('search_latestbrands',  config('app.cachetime')+rand(60,60*24), function(){
                return Brandarticle::take(20)->orderBy('id','desc')->get(['id','litpic','brandname']);
            });
            Cache::forget('index_latestbrands');
            $latestbrandlists=Cache::remember('index_latestbrands', 60, function(){
                return Brandarticle::take(12)->orderBy('id','desc')->get(['id','brandname']);
            });
            Cache::forget('index_latestbrand2s');
            $latestbrandlist2s=Cache::remember('index_latestbrand2s', 60, function(){
                return Brandarticle::skip(12)->take(108)->orderBy('id','desc')->get(['id','brandname','litpic']);
            });
            Cache::forget('index_latestbrand3s');
            $latestbrandlist3s=Cache::remember('index_latestbrand3s', 60, function(){
                return Brandarticle::take(27)->orderBy('click','desc')->get(['id','brandname','litpic']);
            });
            Cache::forget('mobile_latestbrands');
            Cache::remember('mobile_latestbrands',config('app.cachetime')+rand(3600,3600*24),function(){
                $brands= Brandarticle::take(4)->orderBy('id','desc')->get(['id','brandname','litpic','tzid','typeid'])->toArray();
                foreach ($brands as $key=>$brand) {
                    $brands[$key]['typename']=Arctype::where('id',$brand['typeid'])->value('typename');
                    $brands[$key]['topreal_path']=Arctype::where('id',Arctype::where('id',$brand['typeid'])->value('reid'))->value('real_path');
                }
                return $brands;
            });
            Cache::forget('mobile_canyinbrands');
            Cache::remember('mobile_canyinbrands',config('app.cachetime')+rand(3600,3600*24),function(){
                $brands= Brandarticle::whereIn('typeid',Arctype::where('reid',1)->pluck('id'))->take(4)->orderBy('id','desc')->get(['id','brandname','litpic','tzid','typeid'])->toArray();
                foreach ($brands as $key=>$brand) {
                    $brands[$key]['typename']=Arctype::where('id',$brand['typeid'])->value('typename');
                    $brands[$key]['topreal_path']=Arctype::where('id',Arctype::where('id',$brand['typeid'])->value('reid'))->value('real_path');
                }
                return $brands;
            });
            Cache::forget('mobile_jiaoyubrands');
            Cache::remember('mobile_jiaoyubrands',config('app.cachetime')+rand(3600,3600*24),function(){
                $brands= Brandarticle::whereIn('typeid',Arctype::where('reid',130)->pluck('id'))->take(4)->orderBy('id','desc')->get(['id','brandname','litpic','tzid','typeid'])->toArray();
                foreach ($brands as $key=>$brand) {
                    $brands[$key]['typename']=Arctype::where('id',$brand['typeid'])->value('typename');
                    $brands[$key]['topreal_path']=Arctype::where('id',Arctype::where('id',$brand['typeid'])->value('reid'))->value('real_path');
                }
                return $brands;
            });
            Cache::forget('mobile_muyingbrands');
            Cache::remember('mobile_muyingbrands',config('app.cachetime')+rand(3600,3600*24),function(){
                $brands= Brandarticle::whereIn('typeid',Arctype::where('reid',141)->pluck('id'))->take(4)->orderBy('id','desc')->get(['id','brandname','litpic','tzid','typeid'])->toArray();
                foreach ($brands as $key=>$brand) {
                    $brands[$key]['typename']=Arctype::where('id',$brand['typeid'])->value('typename');
                    $brands[$key]['topreal_path']=Arctype::where('id',Arctype::where('id',$brand['typeid'])->value('reid'))->value('real_path');
                }
                return $brands;
            });
            Cache::forget('mobile_tongleibrands'.$thisArticleInfos->id);
            Cache::remember('mobile_tongleibrands'.$thisArticleInfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
                $brandarticlekey=array_search($thisArticleInfos->id,Brandarticle::where('typeid',$thisArticleInfos->typeid)->orderBy('id','asc')->pluck('id')->toArray());
                $brandarticles=Brandarticle::where('typeid',$thisArticleInfos->typeid)->skip($brandarticlekey*4)->take(4)->get(['id','brandname','created_at','litpic','tzid','created_at']);
                if (!count($brandarticles))
                {
                    $brandarticles=Brandarticle::where('typeid',$thisArticleInfos->typeid)->skip($brandarticlekey-4)->orderBy('id','asc')->take(4)->get(['id','brandname','litpic','brandpay','tzid','created_at']);
                }
                return $brandarticles;
            });
            //无关联品牌同类品牌推荐
            Cache::forget('mobile_types_tongleibrands'.$thisArticleInfos->typeid);
            Cache::remember('mobile_types_tongleibrands'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
                return Brandarticle::where('typeid',$thisArticleInfos->typeid)->take(4)->orderBy('click','desc')->get(['id','litpic','brandname','tzid']);
            });
            //移动端资讯列表页
            Cache::forget('mobile_article_latestbrands');
        }

    }
}
