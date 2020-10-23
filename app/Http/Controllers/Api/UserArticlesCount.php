<?php

namespace App\Http\Controllers\Api;

use App\AdminModel\Admin;
use App\AdminModel\Archive;
use App\AdminModel\Brandarticle;
use App\Scopes\PublishedScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserArticlesCount extends Controller
{
    public function ArticlesCount(){
        $articleids=Archive::withoutGlobalScope(PublishedScope::class)->where('origin_time','>',Carbon::now()->startOfMonth())->where('origin_time','<',Carbon::now()->endOfMonth())->distinct()->pluck('dutyadmin','write')->toArray();
        $brandarticleids=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('origin_time','>',Carbon::now()->startOfMonth())->where('origin_time','<',Carbon::now()->endOfMonth())->distinct()->pluck('dutyadmin','write')->toArray();
        $duyuadmids=array_merge($articleids,$brandarticleids);
        $users=[];
        foreach ($duyuadmids as $duyuadmid){
            $users[$duyuadmid]['yesbrandcount']=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('origin_time','>',Carbon::yesterday())->where('origin_time','<',Carbon::today())->where('dutyadmin',$duyuadmid)->count();
            $users[$duyuadmid]['todaybrandcount']=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('origin_time','>',Carbon::today())->where('origin_time','<',Carbon::tomorrow())->where('dutyadmin',$duyuadmid)->count();
            $users[$duyuadmid]['monthbrandcount']=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('origin_time','>',Carbon::now()->startOfMonth())->where('origin_time','<',Carbon::now()->endOfMonth())->where('dutyadmin',$duyuadmid)->count();
            $users[$duyuadmid]['yesarticlecount']=Archive::withoutGlobalScope(PublishedScope::class)->where('origin_time','>',Carbon::yesterday())->where('origin_time','<',Carbon::today())->where('dutyadmin',$duyuadmid)->count();
            $users[$duyuadmid]['todayarticlecount']=Archive::withoutGlobalScope(PublishedScope::class)->where('origin_time','>',Carbon::today())->where('origin_time','<',Carbon::tomorrow())->where('dutyadmin',$duyuadmid)->count();
            $users[$duyuadmid]['montharticlecount']=Archive::withoutGlobalScope(PublishedScope::class)->where('origin_time','>',Carbon::now()->startOfMonth())->where('origin_time','<',Carbon::now()->endOfMonth())->where('dutyadmin',$duyuadmid)->count();
            $users[$duyuadmid]['name']=Admin::where('id',$duyuadmid)->value('name');
        }
       return json_encode($users);
    }
}
