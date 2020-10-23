<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatMentController extends Controller
{
    public function about(){
        return view('mobile.about');
    }
    public function sitemap(){
        return view('mobile.sitemap');
    }
    public function copyright(){
        return view('mobile.copyright');
    }
    public function contact(){
        return view('mobile.contact');
    }
}
