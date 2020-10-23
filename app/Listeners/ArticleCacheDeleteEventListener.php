<?php

namespace App\Listeners;

use App\AdminModel\Archive;
use App\AdminModel\Arctype;
use App\AdminModel\Brandarticle;
use App\Events\ArticleCacheDeleteEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class ArticleCacheDeleteEventListener
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
     * @param  ArticleCacheDeleteEvent  $event
     * @return void
     */
    public function handle(ArticleCacheDeleteEvent $event)
    {
        $eventinfo=$event->archive;
        $id=$eventinfo->id;
        $mid=$eventinfo->mid;
        $typeid=$eventinfo->typeid;
        $brandid=$eventinfo->brandid;
        //清除当前缓存
        if ($mid==1){
            //清除当前普通文档缓存 重新写入 兼容Update
            Cache::forget('thisNewsArticleInfos'.$id);

        }elseif($mid>1){
            //清除当前问答文档缓存 重新写入 兼容Update
            Cache::forget('thisAskArticleInfos'.$id);
        }
        //当前文档所属行业分类
        $thisArticleTypeInfo=Cache::remember('thisArticleTypeInfo'.$typeid,  config('app.cachetime')+rand(60,60*24), function() use ($typeid){
            return Arctype::where('id',$typeid)->first(['id','typename','reid']);
        });

        //当前文档所属行业父分类
        $thisArticleTopTypeInfo=Cache::remember('thisArticleTopTypeInfo'.$thisArticleTypeInfo->reid,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleTypeInfo){
            return Arctype::where('id',$thisArticleTypeInfo->reid)->first(['id','typename','real_path']);
        });
        //当前文档所属行业最新文档
        Cache::forget('thisarticlelatestnewslists'.$thisArticleTypeInfo->typeid);
        //品牌文档页面=>品牌相关文档缓存处理
        if ($brandid && Brandarticle::where('id',$brandid)->value('id')){
            $thisBrandArticleInfos=Cache::remember('thisBrandArticleInfos'.$id,  config('app.cachetime')+rand(60,60*24), function() use ($brandid){
                return Brandarticle::where('id',$brandid)->first();
            });
            //品牌文档底部相关品牌资讯
            Cache::forget('thisBrandArticlebrandnews'.$thisBrandArticleInfos->id);
            //品牌文档=>品牌新闻下相关品牌资讯
            Cache::forget('thisArticlebrandListnews'.$thisBrandArticleInfos->id);
        }
        //xm下最新相关资讯
        Cache::forget('thisXmTypeNews');
        //顶级分类下所属分类最新资讯
        Cache::forget('thisTypeNews'.$thisArticleTopTypeInfo->id);
        //品牌分类列表页下当前分类下相关资讯
        Cache::forget('thisTypeNews'.$thisArticleTypeInfo->id);
        //新闻封面列表页缓存清理
        Cache::forget('newscarticles'.$thisArticleTopTypeInfo->id);
        Cache::forget('topsnewscarticles');
        //首页缓存清理
        Cache::forget('index_latestnewslists');
        Cache::forget('index_newslist2s');
        Cache::forget('mobile_latestnewslist2s');
        Cache::forget('mobile_thisBrandArticlebrandnews');
        Cache::forget('mobile_thisArticlebrandListnews');
        Cache::forget('mobile_thisarticlelatestnewslists'.$thisArticleTypeInfo->id);
    }

}
