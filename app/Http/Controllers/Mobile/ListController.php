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

class ListController extends Controller
{

    public function XmLists(Request $request){
        $thisTypeinfos=collect(['typename'=>'加盟项目',
            'title'=>'最新创业加盟好项目，全国连锁投资项目加盟',
            'keywords'=>'最新创业加盟好项目,全国连锁投资项目加盟',
            'description'=>'3198商机网提供最新、最好的全国连锁加盟项目，只为您呈现最赚钱的项目，让您投资获得巨额回报。好的加盟项目就在这里，点击开始赚钱吧',
            'real_path'=>'xm']);
        $thisTypeSonsInfos=Cache::remember('thisXmTypeSonsInfos',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Arctype::where('reid',0)->get(['id','typename','real_path']);
        });

        $thisTypeSonids=Cache::remember('thisXmTypeSonids',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Arctype::where('reid',0)->pluck('id');
        });

        $investmentlists=Cache::remember('investmentlists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return InvestmentType::orderBy('id','asc')->pluck('type','id');
        });
        $arealists=Cache::remember('arealists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Area::where('parentid',1)->orderBy('id','asc')->pluck('regionname','id');
        });
        $brands=Brandarticle::when($request->level, function ($query) use ($request) {

            return $query->where('tzid', $request->level);

        })->when($request->province, function ($query) use ($request) {

            return $query->where('province_id',$request->province);

        })->orderBy('id','desc')->paginate(10);
        if ($brands->total()<1){
            $tuijianbrands=Brandarticle::orderBy('id','desc')->paginate(10);
        }else{
            $tuijianbrands=null;
        }
        $thisTypeKnowledges=Cache::remember('thisXmTypeKnowledges',  config('app.cachetime')+rand(3600,3600*24), function(){
            return KnowedgeNew::take(6)->orderBy('id','desc')->get(['id','title']);
        });
        $thisTypeNews=Cache::remember('thisXmTypeNews',  config('app.cachetime')+rand(3600,3600*24), function() {
            return Archive::where('mid',1)->take(6)->orderBy('id','desc')->get(['id','title']);
        });
        $province=Area::where('id',$request->province)->value('regionname');
        $level=isset($investmentlists[$request->level])?$investmentlists[$request->level]:'';
        return view('mobile.xmbrands',compact('thisTypeinfos','thisTypeSonsInfos','brands','tuijianbrands','investmentlists','arealists','thisTypeKnowledges','thisTypeNews','province','level'));
    }
    /**顶级栏目品牌分类
     * @param Request $request
     * @param $path
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function TopbrandList(Request $request,$path){
        $thisTypeinfos=Arctype::where('real_path',$path)->first();
        if (empty($thisTypeinfos) || $thisTypeinfos->reid){
            abort(404);
        }
        $thisTypeSonsInfos=Cache::remember('thisTypeSonsInfos'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeinfos){
            return Arctype::where('reid',$thisTypeinfos->id)->get(['id','typename',]);
        });

        $thisTypeSonids=Cache::remember('thisTypeSonids'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeinfos){
            return Arctype::where('reid',$thisTypeinfos->id)->pluck('id');
        });

        $investmentlists=Cache::remember('investmentlists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return InvestmentType::orderBy('id','asc')->pluck('type','id');
        });
        $arealists=Cache::remember('arealists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Area::where('parentid',1)->orderBy('id','asc')->pluck('regionname','id');
        });
        $brands=Brandarticle::whereIn('typeid',Arctype::where('reid',$thisTypeinfos->id)->pluck('id'))->when($request->level, function ($query) use ($request) {

            return $query->where('tzid', $request->level);

        })->when($request->province, function ($query) use ($request) {

            return $query->where('province_id',$request->province);

        })->orderBy('id','desc')->paginate(10);
        if ($brands->total()<1){
            $tuijianbrands=Brandarticle::whereIn('typeid',Arctype::where('reid',$thisTypeinfos->id)->pluck('id'))->orderBy('id','desc')->paginate(10);
        }else{
            $tuijianbrands=null;
        }
        $thisTypeKnowledges=Cache::remember('thisTypeKnowledges'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeinfos,$thisTypeSonids){
            return KnowedgeNew::whereIn('typeid',$thisTypeSonids)->take(6)->orderBy('id','desc')->get(['id','title','litpic']);
        });
        $thisTypeNews=Cache::remember('thisTypeNews'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeinfos,$thisTypeSonids){
            return Archive::where('mid',1)->whereIn('typeid',$thisTypeSonids)->take(6)->orderBy('id','desc')->get(['id','title','litpic']);
        });
        $thisTypelatestbrands=Cache::remember('thisTypelatestbrands'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeinfos,$thisTypeSonids){
            return Brandarticle::where('mid',1)->whereIn('typeid',$thisTypeSonids)->skip(10)->take(6)->orderBy('id','desc')->get(['id','brandname','litpic']);
        });
        $thisTypepaihangbangs=Cache::remember('thisTypepaihangbangs'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeinfos,$thisTypeSonids){
            return Brandarticle::where('mid',1)->whereIn('typeid',$thisTypeSonids)->take(10)->orderBy('click','desc')->get(['id','brandname','litpic','click','tzid']);
        });
        $province=Area::where('id',$request->province)->value('regionname');
        $level=isset($investmentlists[$request->level])?$investmentlists[$request->level]:'';
        return view('mobile.brands',compact('thisTypeinfos','thisTypeSonsInfos','brands','tuijianbrands','investmentlists','arealists','thisTypeKnowledges','thisTypeNews','thisTypelatestbrands','thisTypepaihangbangs','province','level'));
    }

    /**二级品牌行业分类
     * @param Request $request
     * @param $path
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function BrandList(Request $request,$path,$id){
        $thisTypeinfos=Arctype::where('id',$id)->first();
        if (empty($thisTypeinfos)){
            abort(404);
        }
        $thisTypeTopInfo=Arctype::where('id',$thisTypeinfos->reid)->first();
        if (empty($thisTypeTopInfo) || $thisTypeTopInfo->real_path!=$path){
            abort(404);
        }
        $thisTypeSonsInfos=Cache::remember('thisTypeSonsInfos'.$thisTypeTopInfo->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeTopInfo){
            return Arctype::where('reid',$thisTypeTopInfo->id)->get(['id','typename',]);
        });
        $investmentlists=Cache::remember('investmentlists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return InvestmentType::orderBy('id','asc')->pluck('type','id');
        });
        $arealists=Cache::remember('arealists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Area::where('parentid',1)->orderBy('id','asc')->pluck('regionname','id');
        });
        $brands=Brandarticle::where('typeid',$thisTypeinfos->id)->when($request->level, function ($query) use ($request) {

            return $query->where('tzid', $request->level);

        })->when($request->province, function ($query) use ($request) {

            return $query->where('province_id',$request->province);

        })->orderBy('id','desc')->paginate(10);
        if ($brands->total()<1){
            $tuijianbrands=Brandarticle::where('typeid',$thisTypeinfos->id)->orderBy('id','desc')->paginate(10);
        }else{
            $tuijianbrands=null;
        }
        $thisTypeKnowledges=Cache::remember('thisTypeKnowledges'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeinfos){
            return KnowedgeNew::where('typeid',$thisTypeinfos->id)->take(6)->orderBy('id','desc')->get(['id','title']);
        });
        $thisTypeNews=Cache::remember('thisTypeNews'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeinfos){
            return Archive::where('mid',1)->where('typeid',$thisTypeinfos->id)->take(6)->orderBy('id','desc')->get(['id','title']);
        });

        $thisTypelatestbrands=Cache::remember('thisTypelatestbrands'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeinfos){
            return Brandarticle::where('mid',1)->where('typeid',$thisTypeinfos->id)->skip(10)->take(6)->orderBy('id','desc')->get(['id','brandname','litpic']);
        });
        $thisTypepaihangbangs=Cache::remember('thisTypepaihangbangs'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeinfos){
            return Brandarticle::where('mid',1)->where('typeid',$thisTypeinfos->id)->take(10)->orderBy('click','desc')->get(['id','brandname','litpic','click','tzid']);
        });
        $province=Area::where('id',$request->province)->value('regionname');
        $level=isset($investmentlists[$request->level])?$investmentlists[$request->level]:'';
        return view('mobile.brand_lists',compact('thisTypeinfos','thisTypeTopInfo','thisTypeSonsInfos','brands','tuijianbrands','investmentlists','arealists','thisTypeKnowledges','thisTypeNews','thisTypelatestbrands','thisTypepaihangbangs','province','level'));
    }

    /**新闻分类列表页
     * @param Request $request
     * @param $path
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function NewsArticleList(Request $request,$path,$id){
        $thisTypeinfos=Arctype::where('id',$id)->first();
        if (empty($thisTypeinfos)){
            abort(404);
        }
        $thisTypeTopInfo=Arctype::where('id',$thisTypeinfos->reid)->first();
        if (empty($thisTypeTopInfo) || $thisTypeTopInfo->real_path!=$path){
            abort(404);
        }
        $thisTypeSonsInfos=Cache::remember('thisTypeSonsInfos'.$thisTypeTopInfo->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeTopInfo){
            return Arctype::where('reid',$thisTypeTopInfo->id)->get(['id','typename',]);
        });
        if (str_contains($request->path(),'news')){
            $listarticles=Archive::where('mid',1)->where('typeid',$id)->orderBy('id','desc')->paginate(30);
            $catepath='news';
        }elseif(str_contains($request->path(),'zhishi')){
            $listarticles=KnowedgeNew::where('typeid',$id)->orderBy('id','desc')->paginate(30);
            $catepath='zhishi';
        }

        //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
        $latestKnowledges=Cache::remember('mobile_latestknowledges'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeinfos){
            return KnowedgeNew::take(5)->where('typeid',$thisTypeinfos->id)->orderBy('id','desc')->get(['id','title','litpic']);
        });
        //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
        $latestBrands=Cache::remember('mobile_article_latestbrands'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use($thisTypeinfos){
            return Brandarticle::take(4)->orderBy('id','desc')->where('typeid',$thisTypeinfos->id)->get(['id','litpic','brandname','tzid','created_at']);
        });
        $investmentlists=Cache::remember('investmentlists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return InvestmentType::orderBy('id','asc')->pluck('type','id');
        });
        return view('mobile.list_article',compact('thisTypeinfos','thisTypeTopInfo','listarticles','thisTypeSonsInfos','latestKnowledges','latestBrands','catepath','investmentlists'));
    }

    /**新闻封面列表页
     * @param Request $request
     * @param $path
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function IndexArticleList(Request $request,$path){
        $thisTypeinfos=Arctype::where('real_path',$path)->first();
        if (empty($thisTypeinfos) || $thisTypeinfos->reid){
            abort(404);
        }
        $thisTypeSonsInfos=Cache::remember('thisTypeSonsInfos'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeinfos){
            return Arctype::where('reid',$thisTypeinfos->id)->get(['id','typename',]);
        });
        $thisTypeSonids=Cache::remember('thisTypeSonids'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeinfos){
            return Arctype::where('reid',$thisTypeinfos->id)->pluck('id');
        });
        if (str_contains($request->path(),'news')){
            $carticles=Cache::remember('newscarticles'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeSonids){
                $carticlelists= Archive::where('mid',1)->whereIn('typeid',$thisTypeSonids)->where('flags','like','%h%')->take(5)->get(['id','title','typeid','description'])->toArray();
                foreach ($carticlelists as $key=>$carticlelist) {
                    $carticlelists[$key]['typename']=Arctype::where('id',$carticlelist['typeid'])->value('typename');
                }
                return $carticlelists;
            });
            //******************
            $listcollections=Cache::remember('thisTypeIndexNewsArticles'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeSonsInfos){
                $listcollections=[];
                foreach ($thisTypeSonsInfos as $thisTypeSonsInfo){
                    $listcollections[$thisTypeSonsInfo->typename]=Archive::where('mid',1)->where('typeid',$thisTypeSonsInfo->id)->take(5)->orderBy('id','desc')->get(['id','title','created_at']);
                }
                return $listcollections;
            });
            $catepath='news';
        }elseif(str_contains($request->path(),'zhishi')){
            $carticles=Cache::remember('zhishicarticles'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeSonids){
                $carticlelists= KnowedgeNew::whereIn('typeid',$thisTypeSonids)->where('flags','like','%h%')->take(5)->get(['id','title','typeid','description'])->toArray();
                foreach ($carticlelists as $key=>$carticlelist) {
                    $carticlelists[$key]['typename']=Arctype::where('id',$carticlelist['typeid'])->value('typename');
                }
                return $carticlelists;
            });
            $listcollections=Cache::remember('thisTypeIndexZhishiArticles'.$thisTypeinfos->id,  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeSonsInfos){
                $listcollections=[];
                foreach ($thisTypeSonsInfos as $thisTypeSonsInfo){
                    $listcollections[$thisTypeSonsInfo->typename]=KnowedgeNew::where('typeid',$thisTypeSonsInfo->id)->take(5)->orderBy('id','desc')->get(['id','title','created_at']);
                }
                return $listcollections;
            });
            $catepath='zhishi';
        }

        //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
        $latestKnowledges=Cache::remember('mobile_latestknowledges',  config('app.cachetime')+rand(3600,3600*24), function(){
            return KnowedgeNew::take(5)->orderBy('id','desc')->get(['id','title']);
        });
        //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
        $latestBrands=Cache::remember('mobile_article_latestbrands',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Brandarticle::take(4)->orderBy('id','desc')->get(['id','litpic','brandname','tzid']);
        });
        $investmentlists=Cache::remember('investmentlists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return InvestmentType::orderBy('id','asc')->pluck('type','id');
        });
        return view('mobile.index_article',compact('thisTypeinfos','listcollections','carticles','latestKnowledges','latestBrands','catepath','investmentlists'));

    }

    public function TopIndexArticleList(Request $request){

        $thisTypeSonsInfos=Cache::remember('TopsTypeInfos',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Arctype::where('reid',0)->get(['id','typename',]);
        });
        $thisTypeSonids=Cache::remember('TopsTypeSonids',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Arctype::where('reid',0)->pluck('id');
        });
        if (str_contains($request->path(),'news')){
            $carticles=Cache::remember('topsnewscarticles',  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeSonids){
                $carticlelists= Archive::where('mid',1)->where('flags','like','%h%')->take(5)->get(['id','title','typeid','description'])->toArray();
                foreach ($carticlelists as $key=>$carticlelist) {
                    $carticlelists[$key]['typename']=Arctype::where('id',$carticlelist['typeid'])->value('typename');
                    $carticlelists[$key]['real_path']=Arctype::where('id',$carticlelist['typeid'])->value('real_path');
                }
                return $carticlelists;
            });
            $listcollections=Cache::remember('topsTypeIndexNewsArticles',  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeSonsInfos){
                $listcollections=[];
                foreach ($thisTypeSonsInfos as $thisTypeSonsInfo){
                    $listcollections[$thisTypeSonsInfo->typename]=Archive::where('mid',1)->whereIn('typeid',Arctype::where('reid',$thisTypeSonsInfo->id)->pluck('id'))->take(5)->orderBy('id','desc')->get(['id','title','created_at']);
                }
                return $listcollections;
            });
            $catepath='news';
        }elseif(str_contains($request->path(),'zhishi')){
            $carticles=Cache::remember('topszhishicarticles',  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeSonids){
                $carticlelists= KnowedgeNew::where('flags','like','%h%')->take(5)->get(['id','title','typeid','description'])->toArray();
                foreach ($carticlelists as $key=>$carticlelist) {
                    $carticlelists[$key]['typename']=Arctype::where('id',$carticlelist['typeid'])->value('typename');
                    $carticlelists[$key]['real_path']=Arctype::where('id',$carticlelist['typeid'])->value('real_path');
                }
                return $carticlelists;
            });
            $listcollections=Cache::remember('topsTypeIndexZhishiArticles',  config('app.cachetime')+rand(3600,3600*24), function() use ($thisTypeSonsInfos){
                $listcollections=[];
                foreach ($thisTypeSonsInfos as $thisTypeSonsInfo){
                    $listcollections[$thisTypeSonsInfo->typename]=KnowedgeNew::whereIn('typeid',Arctype::where('reid',$thisTypeSonsInfo->id)->pluck('id'))->take(5)->orderBy('id','desc')->get(['id','title','created_at']);
                }
                return $listcollections;
            });
            $catepath='zhishi';
        }

        //&&&&&&&&&&&&&&&
        $latestKnowledges=Cache::remember('mobile_latestknowledges',  config('app.cachetime')+rand(3600,3600*24), function(){
            return KnowedgeNew::take(5)->orderBy('id','desc')->get(['id','title']);
        });
        //&&&&&&&&&&&&&&&&&
        $latestBrands=Cache::remember('mobile_article_latestbrands',  config('app.cachetime')+rand(3600,3600*24), function(){
            return Brandarticle::take(4)->orderBy('id','desc')->get(['id','litpic','brandname','tzid']);
        });
        $investmentlists=Cache::remember('investmentlists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return InvestmentType::orderBy('id','asc')->pluck('type','id');
        });

        return view('mobile.top_index_article',compact('catepath','carticles','listcollections','latestKnowledges','latestBrands','investmentlists'));
    }
}
