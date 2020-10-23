<?php

namespace App\Listeners;

use App\AdminModel\Arctype;
use App\AdminModel\Brandarticle;
use App\AdminModel\KnowedgeNew;
use App\Events\KnowLedgeCacheDeleteEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class KnowLedgeCacheDeleteEventListener
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
     * @param  KnowLedgeCacheDeleteEvent  $event
     * @return void
     */
    public function handle(KnowLedgeCacheDeleteEvent $event)
    {
        $id=$event->knowledge->id;
        $typeid=$event->knowledge->typeid;
        $brandid=$event->knowledge->brandid;
        Cache::forget('thisKnownsArticleInfos'.$id);
        $thisArticleTypeInfo=Cache::remember('thisArticleTypeInfo'.$typeid,  config('app.cachetime')+rand(60,60*24), function() use ($typeid){
            return Arctype::where('id',$typeid)->first(['id','typename','reid']);
        });
        $thisArticleTopTypeInfo=Cache::remember('thisArticleTopTypeInfo'.$thisArticleTypeInfo->reid,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleTypeInfo){
            return Arctype::where('id',$thisArticleTypeInfo->reid)->first(['id','typename','real_path']);
        });
        $thisTypeSonsInfos=Cache::remember('thisTypeSonsInfos'.$thisArticleTopTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleTopTypeInfo){
            return Arctype::where('reid',$thisArticleTopTypeInfo->id)->get(['id','typename',]);
        });
        $thisTypeSonids=Cache::remember('thisTypeSonids'.$thisArticleTopTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleTopTypeInfo){
            return Arctype::where('reid',$thisArticleTopTypeInfo->id)->pluck('id');
        });
        //普通文档页面最新分类下知识
        Cache::forget('knowledgelists'.$thisArticleTypeInfo->id);
        //品牌文档页面=>品牌相关文档缓存处理
        if ($brandid && Brandarticle::where('id',$brandid)->value('id')){
            $thisBrandArticleInfos=Cache::remember('thisBrandArticleInfos'.$id,  config('app.cachetime')+rand(60,60*24), function() use ($brandid){
                return Brandarticle::where('id',$brandid)->first();
            });
            //品牌文档下品牌问答
            Cache::forget('thisArticlebrandasks'.$thisBrandArticleInfos->id);
            //品牌问答页面知识列表
            Cache::forget('thisArticlebrandasks'.$thisBrandArticleInfos->id);

        }
        //xm下知识
        Cache::forget('thisXmTypeKnowledges');
        //顶级分类下知识
        Cache::forget('thisTypeKnowledges'.$thisArticleTopTypeInfo->id);
        //当前品牌分类下知识
        Cache::forget('thisTypeKnowledges'.$thisArticleTypeInfo->id);
        //新闻列表下分类知识
        Cache::forget('latestknowledges'.$thisArticleTypeInfo->id);
        //封面新闻下分类知识
        Cache::forget('zhishicarticles'.$thisArticleTypeInfo->id);
        Cache::forget('thisTypeIndexZhishiArticles'.$thisArticleTypeInfo->id);
        Cache::forget('latestknowledges');
        //顶级新闻分类下知识
        Cache::forget('topszhishicarticles');
        Cache::forget('topsTypeIndexZhishiArticles');
        Cache::forget('index_zhishilists');
        Cache::forget('mobile_zhishilists');
        Cache::forget('mobile_thisArticlebrandListask');
        Cache::forget('mobile_knowledgelists'.$thisArticleTypeInfo->id);
        Cache::forget('mobile_latestknowledges');
    }
}
