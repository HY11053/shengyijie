<?php

namespace App\Listeners;

use App\AdminModel\Acreagement;
use App\AdminModel\Arctype;
use App\AdminModel\Brandarticle;
use App\Events\BrandArticleCacheDeleteEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class BrandArticleCacheDeleteEventListener
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
     * @param  BrandArticleCacheDeleteEvent  $event
     * @return void
     */
    public function handle(BrandArticleCacheDeleteEvent $event)
    {
        $eventinfo=$event->brandarticle;
        $id=$eventinfo->id;
        $typeid=$eventinfo->typeid;
        //清除当前品牌缓存数据
        Cache::forget('thisBrandArticleInfos'.$id);
        //当前品牌所属分类
        $thisArticleTypeInfo=Cache::remember('thisArticleTypeInfo'.$typeid,  config('app.cachetime')+rand(60,60*24), function() use ($typeid){
            return Arctype::where('id',$typeid)->first(['id','typename','reid']);
        });
        //当前品牌所属父分类
        $thisArticleTopTypeInfo=Cache::remember('thisArticleTopTypeInfo'.$thisArticleTypeInfo->reid,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleTypeInfo){
            return Arctype::where('id',$thisArticleTypeInfo->reid)->first(['id','typename','real_path']);
        });
        //热门品牌
        Cache::forget('hotbrsnds');
        //同类品牌
        Cache::forget('tongleibrands'.$typeid);
        //排行榜
        Cache::forget('thisArticleInfosphb'.$typeid);
        //最新品牌
        Cache::forget('article_latestbrands');
        //XM下最新品牌
        Cache::forget('thisXmTypelatestbrands');
        //XM下品牌排行榜
        Cache::forget('thisXmTypepaihangbangs');
        //顶级分类下最新所属分类下品牌
        Cache::forget('thisTypelatestbrands'.$thisArticleTopTypeInfo->id);
        //顶级分类下所属分类排行榜
        Cache::forget('thisTypepaihangbangs'.$thisArticleTopTypeInfo->id);
        //当前分类下最新所属分类下品牌
        Cache::forget('thisTypelatestbrands'.$thisArticleTypeInfo->id);
        //当前分类下所属分类排行榜
        Cache::forget('thisTypepaihangbangs'.$thisArticleTypeInfo->id);
        //新闻分类列表页最新品牌
        Cache::forget('article_latestbrands'.$thisArticleTypeInfo->id);
        //新闻封面页最新品牌
        Cache::forget('article_latestbrands');
        //搜索页最新品牌
        Cache::forget('search_latestbrands');
        Cache::forget('index_latestbrands');
        Cache::forget('index_latestbrand2s');
        Cache::forget('index_latestbrand3s');
        Cache::forget('mobile_latestbrands');
        Cache::forget('mobile_canyinbrands');
        Cache::forget('mobile_jiaoyubrands');
        Cache::forget('mobile_muyingbrands');
        Cache::forget('mobile_tongleibrands'.$id);
        Cache::forget('mobile_types_tongleibrands'.$typeid);
        Cache::forget('mobile_article_latestbrands');

    }
}
