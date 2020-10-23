<?php

namespace App\Http\Controllers\Mobile;

use App\AdminModel\Archive;
use App\AdminModel\Arctype;
use App\AdminModel\Area;
use App\AdminModel\Brandarticle;
use App\AdminModel\InvestmentType;
use App\AdminModel\KnowedgeNew;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    /**品牌文档
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function BrandArticle(Request $request,$id){
        $thisArticleInfos=Cache::remember('thisBrandArticleInfos'.$id,  config('app.cachetime')+rand(3600,3600*24), function() use ($id){
            return Brandarticle::findOrFail($id);
        });
        $investmentlists=Cache::remember('investmentlists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return InvestmentType::orderBy('id','asc')->pluck('type','id');
        });
        $thisArticleTypeInfo=Cache::remember('thisArticleTypeInfo'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return Arctype::where('id',$thisArticleInfos->typeid)->first(['id','typename','reid']);
        });
        $thisArticleTopTypeInfo=Cache::remember('thisArticleTopTypeInfo'.$thisArticleTypeInfo->reid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleTypeInfo){
            return Arctype::where('id',$thisArticleTypeInfo->reid)->first(['id','typename','real_path']);
        });
        $arealists=Cache::remember('arealists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Area::where('parentid',1)->orderBy('id','asc')->pluck('regionname','id');
        });
        //&&&&&&&&&&&&&&&&&
        $brandnews=Cache::remember('mobile_thisBrandArticlebrandnews'.$thisArticleInfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return Archive::where('brandid',$thisArticleInfos->id)->where('mid',1)->take(5)->orderBy('id','desc')->get(['id','title','litpic']);
        });
        //&&&&&&&&&&&&
        $tongleibrands=Cache::remember('mobile_tongleibrands'.$thisArticleInfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            $brandarticlekey=array_search($thisArticleInfos->id,Brandarticle::where('typeid',$thisArticleInfos->typeid)->orderBy('id','asc')->pluck('id')->toArray());
            $brandarticles=Brandarticle::where('typeid',$thisArticleInfos->typeid)->skip($brandarticlekey*4)->take(4)->get(['id','brandname','created_at','litpic','tzid','created_at']);
            if (!count($brandarticles))
            {
                $brandarticles=Brandarticle::where('typeid',$thisArticleInfos->typeid)->skip($brandarticlekey-4)->orderBy('id','asc')->take(4)->get(['id','brandname','litpic','brandpay','tzid','created_at']);
            }
            return $brandarticles;
        });
        return view('mobile.brandarticle',compact('thisArticleInfos','investmentlists','thisArticleTypeInfo','thisArticleTopTypeInfo','arealists','brandnews','tongleibrands'));
    }

    /**品牌文档品牌新闻
     * @param Request $request
     * @param $id
     */
    public function BrandArticleNews(Request $request,$id){
        $thisArticleInfos=Cache::remember('thisBrandArticleInfos'.$id,  config('app.cachetime')+rand(3600,3600*24), function() use ($id){
            return Brandarticle::findOrFail($id);
        });
        $investmentlists=Cache::remember('investmentlists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return InvestmentType::orderBy('id','asc')->pluck('type','id');
        });
        $thisArticleTypeInfo=Cache::remember('thisArticleTypeInfo'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return Arctype::where('id',$thisArticleInfos->typeid)->first(['id','typename','reid']);
        });
        $thisArticleTopTypeInfo=Cache::remember('thisArticleTopTypeInfo'.$thisArticleTypeInfo->reid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleTypeInfo){
            return Arctype::where('id',$thisArticleTypeInfo->reid)->first(['id','typename','real_path']);
        });
        $arealists=Cache::remember('arealists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Area::where('parentid',1)->orderBy('id','asc')->pluck('regionname','id');
        });
        $brandnews=Cache::remember('mobile_thisArticlebrandListnews'.$thisArticleInfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return Archive::where('brandid',$thisArticleInfos->id)->where('mid',1)->take(10)->orderBy('id','desc')->get(['id','title','description','created_at','litpic']);
        });
        $tongleibrands=Cache::remember('mobile_tongleibrands'.$thisArticleInfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            $brandarticlekey=array_search($thisArticleInfos->id,Brandarticle::where('typeid',$thisArticleInfos->typeid)->orderBy('id','asc')->pluck('id')->toArray());
            $brandarticles=Brandarticle::where('typeid',$thisArticleInfos->typeid)->skip($brandarticlekey*4)->take(4)->get(['id','brandname','created_at','litpic','tzid','created_at']);
            if (!count($brandarticles))
            {
                $brandarticles=Brandarticle::where('typeid',$thisArticleInfos->typeid)->skip($brandarticlekey-4)->orderBy('id','asc')->take(4)->get(['id','brandname','litpic','brandpay','tzid','created_at']);
            }
            return $brandarticles;
        });
        return view('mobile.brandarticle_news',compact('thisArticleInfos','investmentlists','thisArticleTypeInfo','thisArticleTopTypeInfo','arealists','brandnews','tongleibrands'));
    }

    /**品牌文档问答页面
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function BrandArticleAsks(Request $request,$id){
        $thisArticleInfos=Cache::remember('thisBrandArticleInfos'.$id,  config('app.cachetime')+rand(3600,3600*24), function() use ($id){
            return Brandarticle::findOrFail($id);
        });
        $investmentlists=Cache::remember('investmentlists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return InvestmentType::orderBy('id','asc')->pluck('type','id');
        });
        $thisArticleTypeInfo=Cache::remember('thisArticleTypeInfo'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return Arctype::where('id',$thisArticleInfos->typeid)->first(['id','typename','reid']);
        });
        $thisArticleTopTypeInfo=Cache::remember('thisArticleTopTypeInfo'.$thisArticleTypeInfo->reid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleTypeInfo){
            return Arctype::where('id',$thisArticleTypeInfo->reid)->first(['id','typename','real_path']);
        });
        $arealists=Cache::remember('arealists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Area::where('parentid',1)->orderBy('id','asc')->pluck('regionname','id');
        });
        $brandasks=Cache::remember('mobile_thisArticlebrandListask'.$thisArticleInfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return KnowedgeNew::where('brandid',$thisArticleInfos->id)->take(10)->orderBy('id','desc')->get(['id','title','description','created_at','litpic']);
        });
        $tongleibrands=Cache::remember('mobile_tongleibrands'.$thisArticleInfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            $brandarticlekey=array_search($thisArticleInfos->id,Brandarticle::where('typeid',$thisArticleInfos->typeid)->orderBy('id','asc')->pluck('id')->toArray());
            $brandarticles=Brandarticle::where('typeid',$thisArticleInfos->typeid)->skip($brandarticlekey*4)->take(4)->get(['id','brandname','created_at','litpic','tzid','created_at']);
            if (!count($brandarticles))
            {
                $brandarticles=Brandarticle::where('typeid',$thisArticleInfos->typeid)->skip($brandarticlekey-4)->orderBy('id','asc')->take(4)->get(['id','brandname','litpic','brandpay','tzid','created_at']);
            }
            return $brandarticles;
        });

        return view('mobile.brandarticle_asks',compact('thisArticleInfos','investmentlists','thisArticleTypeInfo','thisArticleTopTypeInfo','arealists','brandasks','tongleibrands'));
    }

    /**普通新闻
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newsArticle(Request $request,$id){
        if (str_contains($request->path(),'news')){
            $thisArticleInfos=Cache::remember('thisNewsArticleInfos'.$id,  config('app.cachetime')+rand(3600,3600*24), function() use ($id){
                return Archive::findOrFail($id);
            });
            $path='news';
        }elseif(str_contains($request->path(),'zhishi')){
            $thisArticleInfos=Cache::remember('thisKnownsArticleInfos'.$id,  config('app.cachetime')+rand(3600,3600*24), function() use ($id){
                return KnowedgeNew::findOrFail($id);
            });
            $path='zhishi';
        }elseif(str_contains($request->path(),'wenda')){
            $thisArticleInfos=Cache::remember('thisAskArticleInfos'.$id,  config('app.cachetime')+rand(3600,3600*24), function() use ($id){
                return Archive::findOrFail($id);
            });
            $path='news';
        }

        if ($thisArticleInfos->brandid && Brandarticle::where('id',$thisArticleInfos->brandid)->value('id')){
            $thisBrandArticleInfos=Cache::remember('thisBrandArticleInfos'.$id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
                return Brandarticle::where('id',$thisArticleInfos->brandid)->first();
            });
            $thisArticleTypeInfo=Cache::remember('thisArticleTypeInfo'.$thisBrandArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisBrandArticleInfos){
                return Arctype::where('id',$thisBrandArticleInfos->typeid)->first(['id','typename','reid']);
            });
            $thisArticleTopTypeInfo=Cache::remember('thisArticleTopTypeInfo'.$thisArticleTypeInfo->reid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleTypeInfo){
                return Arctype::where('id',$thisArticleTypeInfo->reid)->first(['id','typename','real_path']);
            });
            //&&&&&&&&&&&&&&&&&&&&&
            $tongleibrands=Cache::remember('mobile_tongleibrands'.$thisBrandArticleInfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisBrandArticleInfos){
                $brandarticlekey=array_search($thisBrandArticleInfos->id,Brandarticle::where('typeid',$thisBrandArticleInfos->typeid)->orderBy('id','asc')->pluck('id')->toArray());
                $brandarticles=Brandarticle::where('typeid',$thisBrandArticleInfos->typeid)->skip($brandarticlekey*4)->take(4)->get(['id','brandname','created_at','litpic','tzid','created_at']);
                if (!count($brandarticles))
                {
                    $brandarticles=Brandarticle::where('typeid',$thisBrandArticleInfos->typeid)->skip($brandarticlekey-4)->orderBy('id','asc')->take(4)->get(['id','brandname','litpic','brandpay','tzid','created_at']);
                }
                return $brandarticles;
            });
        }else{
            $thisBrandArticleInfos=null;
            $thisArticleTypeInfo=Cache::remember('thisArticleTypeInfo'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
                return Arctype::where('id',$thisArticleInfos->typeid)->first(['id','typename','reid']);
            });
            $thisArticleTopTypeInfo=Cache::remember('thisArticleTopTypeInfo'.$thisArticleTypeInfo->reid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleTypeInfo){
                return Arctype::where('id',$thisArticleTypeInfo->reid)->first(['id','typename','real_path']);
            });
            //&&&&&&&&&&&&&&&&&&&
            $tongleibrands=Cache::remember('mobile_types_tongleibrands'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
                return Brandarticle::where('typeid',$thisArticleInfos->typeid)->take(4)->orderBy('click','desc')->get(['id','litpic','brandname','tzid','created_at']);
            });
        }
        $thisTypeSonsInfos=Cache::remember('thisTypeSonsInfos'.$thisArticleTopTypeInfo->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleTopTypeInfo){
            return Arctype::where('reid',$thisArticleTopTypeInfo->id)->get(['id','typename',]);
        });
        $thisTypeSonids=Cache::remember('thisTypeSonids'.$thisArticleTopTypeInfo->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleTopTypeInfo){
            return Arctype::where('reid',$thisArticleTopTypeInfo->id)->pluck('id');
        });
        $investmentlists=Cache::remember('investmentlists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return InvestmentType::orderBy('id','asc')->pluck('type','id');
        });
        $arealists=Cache::remember('arealists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Area::where('parentid',1)->orderBy('id','asc')->pluck('regionname','id');
        });
        $knowledgelists=Cache::remember('mobile_knowledgelists'.$thisArticleTypeInfo->id,  config('app.cachetime')+rand(3600,3600*24), function() use($thisArticleTypeInfo) {
            return KnowedgeNew::where('typeid',$thisArticleTypeInfo->id)->take(5)->orderBy('id','desc')->get(['id','title','litpic']);
        });
        $thisarticlelatestnewslists=Cache::remember('mobile_thisarticlelatestnewslists'.$thisArticleTypeInfo->id,  config('app.cachetime')+rand(3600,3600*24), function() use($thisArticleTypeInfo) {
            return Archive::where('mid',1)->where('typeid',$thisArticleTypeInfo->id)->take(5)->orderBy('id','desc')->get(['id','title','litpic']);
        });

        return view('mobile.article_article',compact('thisArticleInfos','thisBrandArticleInfos','thisArticleTypeInfo','thisArticleTopTypeInfo','investmentlists','arealists','tongleibrands','thisTypeSonsInfos','thisTypeSonids','knowledgelists','thisarticlelatestnewslists','path'));
    }
}
