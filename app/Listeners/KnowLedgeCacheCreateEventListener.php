<?php

namespace App\Listeners;

use App\AdminModel\Arctype;
use App\AdminModel\Brandarticle;
use App\AdminModel\KnowedgeNew;
use App\Events\KnowLedgeCacheCreateEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class KnowLedgeCacheCreateEventListener
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
     * @param  KnowLedgeCacheCreateEvent  $event
     * @return void
     */
    public function handle(KnowLedgeCacheCreateEvent $event)
    {
        $id=$event->knowledge->id;
        if (KnowedgeNew::find($id) )
        {
            Cache::forget('thisKnownsArticleInfos'.$id);
            //获取当前文档并缓存
            $thisArticleInfos=Cache::remember('thisKnownsArticleInfos'.$id,  config('app.cachetime')+rand(60,60*24), function() use ($id){
                return KnowedgeNew::findOrFail($id);
            });
            $thisArticleTypeInfo=Cache::remember('thisArticleTypeInfo'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleInfos){
                return Arctype::where('id',$thisArticleInfos->typeid)->first(['id','typename','reid']);
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
            Cache::remember('knowledgelists'.$thisArticleTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use($thisArticleTypeInfo) {
                return KnowedgeNew::where('typeid',$thisArticleTypeInfo->id)->take(10)->orderBy('id','desc')->get(['id','title']);
            });

            //品牌文档页面=>品牌相关文档缓存处理
            if ($thisArticleInfos->brandid && Brandarticle::where('id',$thisArticleInfos->brandid)->value('id')){
                $thisBrandArticleInfos=Cache::remember('thisBrandArticleInfos'.$id,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleInfos){
                    return Brandarticle::where('id',$thisArticleInfos->brandid)->first();
                });
                //品牌文档下品牌问答
                Cache::forget('thisArticlebrandasks'.$thisBrandArticleInfos->id);
                Cache::remember('thisArticlebrandasks'.$thisBrandArticleInfos->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisBrandArticleInfos){
                    return KnowedgeNew::where('brandid',$thisBrandArticleInfos->id)->take(5)->orderBy('id','desc')->get(['id','title']);
                });
                //品牌问答页面知识列表
                Cache::forget('thisArticlebrandasks'.$thisBrandArticleInfos->id);
                Cache::remember('thisArticlebrandListask'.$thisBrandArticleInfos->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisBrandArticleInfos){
                    return KnowedgeNew::where('brandid',$thisBrandArticleInfos->id)->take(10)->orderBy('id','desc')->get(['id','title','description','created_at']);
                });

            }
            //xm下知识
            Cache::forget('thisXmTypeKnowledges');
            Cache::remember('thisXmTypeKnowledges',  config('app.cachetime')+rand(60,60*24), function(){
                return KnowedgeNew::take(6)->orderBy('id','desc')->get(['id','title']);
            });
            //顶级分类下知识
            Cache::forget('thisTypeKnowledges'.$thisArticleTopTypeInfo->id);
            Cache::remember('thisTypeKnowledges'.$thisArticleTopTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisTypeSonids){
                return KnowedgeNew::whereIn('typeid',$thisTypeSonids)->take(6)->orderBy('id','desc')->get(['id','title','litpic']);
            });
            //当前品牌分类下知识
            Cache::forget('thisTypeKnowledges'.$thisArticleTypeInfo->id);
            Cache::remember('thisTypeKnowledges'.$thisArticleTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleTypeInfo){
                return KnowedgeNew::where('typeid',$thisArticleTypeInfo->id)->take(6)->orderBy('id','desc')->get(['id','title','litpic']);
            });
            //新闻列表下分类知识
            Cache::forget('latestknowledges'.$thisArticleTypeInfo->id);
            Cache::remember('latestknowledges'.$thisArticleTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleTypeInfo){
                return KnowedgeNew::take(10)->where('typeid',$thisArticleTypeInfo->id)->orderBy('id','desc')->get(['id','title']);
            });
            //封面新闻下分类知识
            Cache::forget('zhishicarticles'.$thisArticleTypeInfo->id);
            Cache::forget('thisTypeIndexZhishiArticles'.$thisArticleTypeInfo->id);
            Cache::forget('latestknowledges');
            Cache::remember('latestknowledges',  config('app.cachetime')+rand(60,60*24), function(){
                return KnowedgeNew::take(10)->orderBy('id','desc')->get(['id','title']);
            });
            //顶级新闻分类下知识
            Cache::forget('topszhishicarticles');
            Cache::forget('topsTypeIndexZhishiArticles');
            Cache::forget('index_zhishilists');
            Cache::forget('mobile_zhishilists');
            Cache::forget('mobile_thisArticlebrandListask');
            Cache::remember('mobile_thisArticlebrandListask'.$thisArticleInfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
                return KnowedgeNew::where('brandid',$thisArticleInfos->id)->take(10)->orderBy('id','desc')->get(['id','title','description','created_at','litpic']);
            });
            Cache::forget('mobile_knowledgelists'.$thisArticleTypeInfo->id);
            Cache::remember('mobile_knowledgelists'.$thisArticleTypeInfo->id,  config('app.cachetime')+rand(3600,3600*24), function() use($thisArticleTypeInfo) {
                return KnowedgeNew::where('typeid',$thisArticleTypeInfo->id)->take(5)->orderBy('id','desc')->get(['id','title','litpic']);
            });
            Cache::forget('mobile_latestknowledges'.$thisArticleTypeInfo->id);
            Cache::forget('mobile_latestknowledges');
        }

    }
}
