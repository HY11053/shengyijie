<?php

namespace App\Http\Controllers\Frontend;

use App\AdminModel\Archive;
use App\AdminModel\Arctype;
use App\AdminModel\Brandarticle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function Index(){
        $latestnewslists=Cache::remember('index_latestnewslists',config('app.cachetime')+rand(3600,3600*24),function(){
            return Archive::where('mid',1)->take(12)->orderBy('id','desc')->get(['id','title']);
        });
        $latestbrandlists=Cache::remember('index_latestbrands',config('app.cachetime')+rand(3600,3600*24),function(){
            return Brandarticle::take(12)->orderBy('id','desc')->get(['id','brandname']);
        });
        $asklists=Cache::remember('index_asklists',config('app.cachetime')+rand(3600,3600*24),function(){
            return Archive::where('mid','>',1)->take(12)->orderBy('click','desc')->get(['id','title']);
        });

        $brandcounts=Cache::remember('index_brandcount', 60*24*365+rand(1,100), function(){
            return Brandarticle::count();
        });


        $paihangbangs=Cache::remember('index_paihangbangs',config('app.cachetime')+rand(3600,3600*24),function(){
            return Brandarticle::take(12)->orderBy('click','desc')->get(['id','brandname','litpic']);
        });
        $latestbrandlist2s=Cache::remember('index_latestbrand2s',config('app.cachetime')+rand(3600,3600*24),function(){
            return Brandarticle::skip(12)->take(108)->orderBy('id','desc')->get(['id','brandname','litpic']);
        });
        $allnavs=Cache::remember('index_allnavs',config('app.cachetime')+rand(3600,3600*24),function(){
            $toplists=Arctype::where('reid',0)->orderBy('sortrank','asc')->take(12)->pluck('real_path','id');
            $allnavs=[];
            foreach ($toplists as $topid=>$toplist){
                $allnavs[$toplist]=Arctype::where('reid',$topid)->pluck('typename','id')->toArray();
            }
         return $allnavs;
        });
        $latestbrandlist3s=Cache::remember('index_latestbrand3s',config('app.cachetime')+rand(3600,3600*24),function(){
            return Brandarticle::take(27)->orderBy('click','desc')->get(['id','brandname','litpic']);
        });
        $newslist2s=Cache::remember('index_newslist2s',config('app.cachetime')+rand(3600,3600*24),function(){
            $newslists= Archive::where('mid',1)->skip(12)->take(13)->orderBy('id','desc')->get(['id','title','typeid'])->toArray();
            foreach ($newslists as $key=>$newslist) {
                $newslists[$key]['typename']=Arctype::where('id',$newslist['typeid'])->value('typename');
                $newslists[$key]['topreal_path']=Arctype::where('id',Arctype::where('id',$newslist['typeid'])->value('reid'))->value('real_path');
            }
            return $newslists;
        });
        return view('frontend.index',compact('latestnewslists','latestbrandlists','asklists','brandcounts','latestbrandlist2s','paihangbangs','latestbrandlist3s','newslist2s','allnavs'));
    }
}
