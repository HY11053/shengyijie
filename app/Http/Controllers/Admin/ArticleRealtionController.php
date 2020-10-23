<?php

namespace App\Http\Controllers\Admin;

use App\AdminModel\Brandarticle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleRealtionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    /**品牌名称信息处理
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ArticleRelationShip()
    {
        $articles=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('typeid',4)->orderBy('id','desc')->paginate(300);
        return view('admin.brandarticle_update',compact('articles'));
    }
    /**品牌名称信息处理
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function BrandNameStatus(Request $request)
    {
        Brandarticle::where('id',$request->id)->update(['title'=>$request->title,'status'=>1]);
        return 1;
    }
}
