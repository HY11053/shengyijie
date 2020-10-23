<?php

namespace App\Http\Controllers\Frontend;

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
        $brandnews=Cache::remember('thisBrandArticlebrandnews'.$thisArticleInfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return Archive::where('brandid',$thisArticleInfos->id)->where('mid',1)->take(5)->orderBy('id','desc')->get(['id','title']);
        });
        $brandasks=Cache::remember('thisArticlebrandasks'.$thisArticleInfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return KnowedgeNew::where('brandid',$thisArticleInfos->id)->take(5)->orderBy('id','desc')->get(['id','title']);
        });
        $hotbrsnds=Cache::remember('hotbrsnds',  config('app.cachetime')+rand(3600,3600*24), function() {
            return Brandarticle::take(6)->orderBy('click','desc')->get(['id','litpic','brandname']);
        });
        $tongleibrands=Cache::remember('tongleibrands'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return Brandarticle::where('typeid',$thisArticleInfos->typeid)->skip(10)->take(6)->orderBy('click','desc')->get(['id','litpic','brandname']);
        });
        $paihangbangs=Cache::remember('thisArticleInfosphb'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return Brandarticle::where('typeid',$thisArticleInfos->typeid)->take(10)->orderBy('click','desc')->get(['id','litpic','brandname','click','tzid']);
        });
        $latestBrands=Cache::remember('article_latestbrands',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Brandarticle::take(6)->orderBy('id','desc')->get(['id','litpic','brandname']);
        });
        return view('frontend.brandarticle',compact('thisArticleInfos','investmentlists','thisArticleTypeInfo','thisArticleTopTypeInfo','arealists','brandnews','brandasks','hotbrsnds','paihangbangs','tongleibrands','latestBrands'));
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
        //&&&&&&&&&&&&&&&&&&
        $brandnews=Cache::remember('thisArticlebrandListnews'.$thisArticleInfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return Archive::where('brandid',$thisArticleInfos->id)->where('mid',1)->take(10)->orderBy('id','desc')->get(['id','title','description','created_at']);
        });
        $hotbrsnds=Cache::remember('hotbrsnds',  config('app.cachetime')+rand(3600,3600*24), function() {
            return Brandarticle::take(6)->orderBy('click','desc')->get(['id','litpic','brandname']);
        });
        $tongleibrands=Cache::remember('tongleibrands'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return Brandarticle::where('typeid',$thisArticleInfos->typeid)->skip(10)->take(6)->orderBy('click','desc')->get(['id','litpic','brandname']);
        });
        $paihangbangs=Cache::remember('thisArticleInfosphb'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return Brandarticle::where('typeid',$thisArticleInfos->typeid)->take(10)->orderBy('click','desc')->get(['id','litpic','brandname','click','tzid']);
        });
        $latestBrands=Cache::remember('article_latestbrands',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Brandarticle::take(6)->orderBy('id','desc')->get(['id','litpic','brandname']);
        });
        return view('frontend.brandarticle_news',compact('thisArticleInfos','investmentlists','thisArticleTypeInfo','thisArticleTopTypeInfo','arealists','brandnews','hotbrsnds','paihangbangs','tongleibrands','latestBrands'));
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
        //&&&&&&&&&&&&&&&&&&★★★★★★★★★★★★★★★★★★
        $brandasks=Cache::remember('thisArticlebrandListask'.$thisArticleInfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return KnowedgeNew::where('brandid',$thisArticleInfos->id)->take(10)->orderBy('id','desc')->get(['id','title','description','created_at']);
        });
        $hotbrsnds=Cache::remember('hotbrsnds',  config('app.cachetime')+rand(3600,3600*24), function() {
            return Brandarticle::take(6)->orderBy('click','desc')->get(['id','litpic','brandname']);
        });
        $tongleibrands=Cache::remember('tongleibrands'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return Brandarticle::where('typeid',$thisArticleInfos->typeid)->skip(10)->take(6)->orderBy('click','desc')->get(['id','litpic','brandname']);
        });
        $paihangbangs=Cache::remember('thisArticleInfosphb'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
            return Brandarticle::where('typeid',$thisArticleInfos->typeid)->take(10)->orderBy('click','desc')->get(['id','litpic','brandname','click','tzid']);
        });
        $latestBrands=Cache::remember('article_latestbrands',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Brandarticle::take(6)->orderBy('id','desc')->get(['id','litpic','brandname']);
        });
        return view('frontend.brandarticle_asks',compact('thisArticleInfos','investmentlists','thisArticleTypeInfo','thisArticleTopTypeInfo','arealists','brandasks','hotbrsnds','paihangbangs','tongleibrands','latestBrands'));
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
            $tongleibrands=Cache::remember('tongleibrands'.$thisBrandArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisBrandArticleInfos){
                return Brandarticle::where('typeid',$thisBrandArticleInfos->typeid)->skip(10)->take(6)->orderBy('click','desc')->get(['id','litpic','brandname']);
            });
            $paihangbangs=Cache::remember('thisArticleInfosphb'.$thisBrandArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisBrandArticleInfos){
                return Brandarticle::where('typeid',$thisBrandArticleInfos->typeid)->take(10)->orderBy('click','desc')->get(['id','litpic','brandname','click','tzid']);
            });
        }else{
            $thisBrandArticleInfos=null;
            $thisArticleTypeInfo=Cache::remember('thisArticleTypeInfo'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
                return Arctype::where('id',$thisArticleInfos->typeid)->first(['id','typename','reid']);
            });
            $thisArticleTopTypeInfo=Cache::remember('thisArticleTopTypeInfo'.$thisArticleTypeInfo->reid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleTypeInfo){
                return Arctype::where('id',$thisArticleTypeInfo->reid)->first(['id','typename','real_path']);
            });
            $tongleibrands=Cache::remember('tongleibrands'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
                return Brandarticle::where('typeid',$thisArticleInfos->typeid)->skip(10)->take(6)->orderBy('click','desc')->get(['id','litpic','brandname']);
            });
            $paihangbangs=Cache::remember('thisArticleInfosphb'.$thisArticleInfos->typeid,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisArticleInfos){
                return Brandarticle::where('typeid',$thisArticleInfos->typeid)->take(10)->orderBy('click','desc')->get(['id','litpic','brandname','click','tzid']);
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
        $knowledgelists=Cache::remember('knowledgelists'.$thisArticleTypeInfo->id,  config('app.cachetime')+rand(3600,3600*24), function() use($thisArticleTypeInfo) {
            return KnowedgeNew::where('typeid',$thisArticleTypeInfo->id)->take(10)->orderBy('id','desc')->get(['id','title']);
        });
        $thisarticlelatestnewslists=Cache::remember('thisarticlelatestnewslists'.$thisArticleTypeInfo->id,  config('app.cachetime')+rand(3600,3600*24), function() use($thisArticleTypeInfo) {
            return Archive::where('mid',1)->where('typeid',$thisArticleTypeInfo->id)->take(10)->orderBy('id','desc')->get(['id','title']);
        });
        $hotbrsnds=Cache::remember('hotbrsnds',  config('app.cachetime')+rand(3600,3600*24), function() {
            return Brandarticle::take(6)->orderBy('click','desc')->get(['id','litpic','brandname']);
        });
        $latestBrands=Cache::remember('article_latestbrands',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Brandarticle::take(6)->orderBy('id','desc')->get(['id','litpic','brandname']);
        });
        return view('frontend.article_article',compact('thisArticleInfos','thisBrandArticleInfos','thisArticleTypeInfo','thisArticleTopTypeInfo','investmentlists','arealists','hotbrsnds','tongleibrands','paihangbangs','latestBrands','thisTypeSonsInfos','thisTypeSonids','knowledgelists','thisarticlelatestnewslists','path'));
    }
}
