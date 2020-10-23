<?php

namespace App\Http\Controllers\Mobile;

use App\AdminModel\Archive;
use App\AdminModel\Arctype;
use App\AdminModel\Brandarticle;
use App\AdminModel\InvestmentType;
use App\AdminModel\KnowedgeNew;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function Index(){
        $investmentlists=Cache::remember('investmentlists',  config('app.cachetime')+rand(3600,3600*24), function(){
            return InvestmentType::orderBy('id','asc')->pluck('type','id');
        });
        //***************
        $latestnewslists=Cache::remember('index_latestnewslists',config('app.cachetime')+rand(3600,3600*24),function(){
            return Archive::where('mid',1)->take(12)->orderBy('id','desc')->get(['id','title']);
        });
        $youxuanrandlists=Cache::remember('mobile_youxuanbrands',config('app.cachetime')+rand(3600,3600*24),function(){
            $brands= Brandarticle::take(4)->orderBy('click','desc')->get(['id','brandname','litpic','tzid','typeid','indexpic'])->toArray();
            foreach ($brands as $key=>$brand) {
                $brands[$key]['typename']=Arctype::where('id',$brand['typeid'])->value('typename');
                $brands[$key]['topreal_path']=Arctype::where('id',Arctype::where('id',$brand['typeid'])->value('reid'))->value('real_path');
            }
            return $brands;
        });
        $latestbrandlists=Cache::remember('mobile_latestbrands',config('app.cachetime')+rand(3600,3600*24),function(){
            $brands= Brandarticle::take(4)->orderBy('id','desc')->get(['id','brandname','litpic','tzid','typeid'])->toArray();
            foreach ($brands as $key=>$brand) {
                $brands[$key]['typename']=Arctype::where('id',$brand['typeid'])->value('typename');
                $brands[$key]['topreal_path']=Arctype::where('id',Arctype::where('id',$brand['typeid'])->value('reid'))->value('real_path');
            }
            return $brands;
        });
        $canyinbrandlists=Cache::remember('mobile_canyinbrands',config('app.cachetime')+rand(3600,3600*24),function(){
            $brands= Brandarticle::whereIn('typeid',Arctype::where('reid',1)->pluck('id'))->take(4)->orderBy('id','desc')->get(['id','brandname','litpic','tzid','typeid'])->toArray();
            foreach ($brands as $key=>$brand) {
                $brands[$key]['typename']=Arctype::where('id',$brand['typeid'])->value('typename');
                $brands[$key]['topreal_path']=Arctype::where('id',Arctype::where('id',$brand['typeid'])->value('reid'))->value('real_path');
            }
            return $brands;
        });
        $jiaoyubrandlists=Cache::remember('mobile_jiaoyubrands',config('app.cachetime')+rand(3600,3600*24),function(){
            $brands= Brandarticle::whereIn('typeid',Arctype::where('reid',130)->pluck('id'))->take(4)->orderBy('id','desc')->get(['id','brandname','litpic','tzid','typeid'])->toArray();
            foreach ($brands as $key=>$brand) {
                $brands[$key]['typename']=Arctype::where('id',$brand['typeid'])->value('typename');
                $brands[$key]['topreal_path']=Arctype::where('id',Arctype::where('id',$brand['typeid'])->value('reid'))->value('real_path');
            }
            return $brands;
        });
        $muyingbrandlists=Cache::remember('mobile_muyingbrands',config('app.cachetime')+rand(3600,3600*24),function(){
            $brands= Brandarticle::whereIn('typeid',Arctype::where('reid',141)->pluck('id'))->take(4)->orderBy('id','desc')->get(['id','brandname','litpic','tzid','typeid'])->toArray();
            foreach ($brands as $key=>$brand) {
                $brands[$key]['typename']=Arctype::where('id',$brand['typeid'])->value('typename');
                $brands[$key]['topreal_path']=Arctype::where('id',Arctype::where('id',$brand['typeid'])->value('reid'))->value('real_path');
            }
            return $brands;
        });
        $latestnewslist2s=Cache::remember('mobile_latestnewslist2s',config('app.cachetime')+rand(3600,3600*24),function(){
            $news= Archive::where('mid',1)->skip(6)->take(5)->orderBy('id','desc')->get(['id','title','typeid','litpic','created_at'])->toArray();
            foreach ($news as $key=>$new) {
                $news[$key]['typename']=Arctype::where('id',$new['typeid'])->value('typename');
                $news[$key]['topreal_path']=Arctype::where('id',Arctype::where('id',$new['typeid'])->value('reid'))->value('real_path');
            }
            return $news;
        });
        $zhishilists=Cache::remember('mobile_zhishilists',config('app.cachetime')+rand(3600,3600*24),function(){
            $news= KnowedgeNew::take(5)->orderBy('id','desc')->get(['id','title','typeid','litpic','created_at'])->toArray();
            foreach ($news as $key=>$new) {
                $news[$key]['typename']=Arctype::where('id',$new['typeid'])->value('typename');
                $news[$key]['topreal_path']=Arctype::where('id',Arctype::where('id',$new['typeid'])->value('reid'))->value('real_path');
            }
            return $news;
        });
        return view('mobile.index',compact('latestnewslists','latestbrandlists','investmentlists','youxuanrandlists','latestnewslist2s','zhishilists','canyinbrandlists','jiaoyubrandlists','muyingbrandlists'));
    }
}
