<?php

namespace App\Http\Controllers\Frontend;

use App\AdminModel\Archive;
use App\AdminModel\Brandarticle;
use App\AdminModel\KnowedgeNew;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function Search(Request $request){

        if ($request->type==1){
            $articles=Brandarticle::where('title','like','%'.$request->key.'%')->paginate(30);
            $path='xm';
        }elseif ($request->type==3){
            $articles=KnowedgeNew::where('title','like','%'.$request->key.'%')->paginate(30);
            $path='zhishi';
        }else{
            $articles=Archive::where('mid',1)->where('title','like','%'.$request->key.'%')->paginate(30);
            $path='news';
        }
        $key=$request->key;
        $latestbrands=Cache::remember('search_latestbrands',  config('app.cachetime')+rand(60,60*24), function(){
            return Brandarticle::take(20)->orderBy('id','desc')->get(['id','litpic','brandname']);
        });
        return view('frontend.search',compact('articles','path','key','latestbrands'));
    }
}
