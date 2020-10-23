<?php

namespace App\Listeners;
use App\AdminModel\Archive;
use App\AdminModel\Arctype;
use App\AdminModel\Brandarticle;
use App\Events\ArticleCacheCreateEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class ArticleCacheCreateEventListener
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
     * @param  ArticleCacheCreateEvent  $event
     * @return void
     */
    public function handle(ArticleCacheCreateEvent $event)
    {
        $id=$event->arcvhive->id;
        $mid=$event->arcvhive->mid;
        if (Archive::find($id) )
        {
            if ( $mid==1){
                //清除当前普通文档缓存 重新写入 兼容Update
                Cache::forget('thisNewsArticleInfos'.$id);
                //获取当前文档并缓存
                $thisArticleInfos = Cache::remember('thisNewsArticleInfos'.$id, config('app.cachetime')+rand(60,60*24), function() use($id){
                    return Archive::where('mid',1)->findOrFail($id);
                });
            }elseif ($mid>1){
                //清除当前问答文档缓存 重新写入 兼容Update
                Cache::forget('thisAskArticleInfos'.$id);
                $thisArticleInfos=Cache::remember('thisAskArticleInfos'.$id,  config('app.cachetime')+rand(60,60*24), function() use ($id){
                    return Archive::where('mid','>',1)->findOrFail($id);
                });
            }
            //当前文档所属行业分类
            $thisArticleTypeInfo=Cache::remember('thisArticleTypeInfo'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleInfos){
                return Arctype::where('id',$thisArticleInfos->typeid)->first(['id','typename','reid']);
            });

            //当前文档所属行业父分类
            $thisArticleTopTypeInfo=Cache::remember('thisArticleTopTypeInfo'.$thisArticleTypeInfo->reid,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleTypeInfo){
                return Arctype::where('id',$thisArticleTypeInfo->reid)->first(['id','typename','real_path']);
            });
            //当前文档所属同级分类
            $thisTypeSonids=Cache::remember('thisTypeSonids'.$thisArticleTopTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleTopTypeInfo){
                return Arctype::where('reid',$thisArticleTopTypeInfo->id)->pluck('id');
            });
            //当前文档所属行业最新文档
            Cache::forget('thisarticlelatestnewslists'.$thisArticleTypeInfo->typeid);
            Cache::remember('thisarticlelatestnewslists'.$thisArticleTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use($thisArticleTypeInfo) {
                return Archive::where('mid',1)->where('typeid',$thisArticleTypeInfo->id)->take(10)->orderBy('id','desc')->get(['id','title']);
            });


            //品牌文档页面=>品牌相关文档缓存处理
            if ($thisArticleInfos->brandid && Brandarticle::where('id',$thisArticleInfos->brandid)->value('id')){
                $thisBrandArticleInfos=Cache::remember('thisBrandArticleInfos'.$id,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleInfos){
                    return Brandarticle::where('id',$thisArticleInfos->brandid)->first();
                });
                //品牌文档底部相关品牌资讯
                Cache::forget('thisBrandArticlebrandnews'.$thisBrandArticleInfos->id);
                Cache::remember('thisBrandArticlebrandnews'.$thisBrandArticleInfos->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisBrandArticleInfos){
                    return Archive::where('brandid',$thisBrandArticleInfos->id)->where('mid',1)->take(5)->orderBy('id','desc')->get(['id','title']);
                });
                //品牌文档=>品牌新闻下相关品牌资讯
                Cache::forget('thisArticlebrandListnews'.$thisBrandArticleInfos->id);
                Cache::remember('thisArticlebrandListnews'.$thisBrandArticleInfos->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisBrandArticleInfos){
                    return Archive::where('brandid',$thisBrandArticleInfos->id)->where('mid',1)->take(10)->orderBy('id','desc')->get(['id','title','description','created_at']);
                });
            }
            //xm下最新相关资讯
            Cache::forget('thisXmTypeNews');
            Cache::remember('thisXmTypeNews',  config('app.cachetime')+rand(60,60*24), function() {
                return Archive::where('mid',1)->take(6)->orderBy('id','desc')->get(['id','title','litpic']);
            });
            //顶级分类下所属分类最新资讯
            Cache::forget('thisTypeNews'.$thisArticleTopTypeInfo->id);
            Cache::remember('thisTypeNews'.$thisArticleTopTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisTypeSonids){
                return Archive::where('mid',1)->whereIn('typeid',$thisTypeSonids)->take(6)->orderBy('id','desc')->get(['id','title','litpic']);
            });
            //品牌分类列表页下当前分类下相关资讯
            Cache::forget('thisTypeNews'.$thisArticleTypeInfo->id);
            Cache::remember('thisTypeNews'.$thisArticleTypeInfo->id,  config('app.cachetime')+rand(60,60*24), function() use ($thisArticleTypeInfo){
                return Archive::where('mid',1)->where('typeid',$thisArticleTypeInfo->id)->take(6)->orderBy('id','desc')->get(['id','title','litpic']);
            });
            //新闻封面列表页缓存清理
            Cache::forget('newscarticles'.$thisArticleTopTypeInfo->id);
            Cache::forget('thisTypeIndexNewsArticles'.$thisArticleTopTypeInfo->id);
            Cache::forget('topsnewscarticles');
            //首页缓存清理
            Cache::forget('index_latestnewslists');
            Cache::forget('index_newslist2s');
            Cache::forget('mobile_latestnewslist2s');
            //移动端品牌文档
            Cache::forget('mobile_thisBrandArticlebrandnews');
            Cache::remember('mobile_thisBrandArticlebrandnews'.$thisArticleInfos->brandid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
                return Archive::where('brandid',$thisArticleInfos->brandid)->where('mid',1)->take(5)->orderBy('id','desc')->get(['id','title','litpic']);
            });
            Cache::forget('mobile_thisArticlebrandListnews');
            Cache::remember('mobile_thisArticlebrandListnews'.$thisArticleInfos->brandid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
                return Archive::where('brandid',$thisArticleInfos->brandid)->where('mid',1)->take(10)->orderBy('id','desc')->get(['id','title','description','created_at','litpic']);
            });
            Cache::forget('mobile_thisarticlelatestnewslists'.$thisArticleTypeInfo->id);
            Cache::remember('mobile_thisarticlelatestnewslists'.$thisArticleTypeInfo->id,  config('app.cachetime')+rand(3600,3600*24), function() use($thisArticleTypeInfo) {
                return Archive::where('mid',1)->where('typeid',$thisArticleTypeInfo->id)->take(5)->orderBy('id','desc')->get(['id','title','litpic']);
            });
        }

    }
}
