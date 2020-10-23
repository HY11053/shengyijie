<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatMentController extends Controller
{
    public function about(){
        return view('frontend.about');
    }
    public function sitemap(){
        return view('frontend.sitemap');
    }
    public function copyright(){
        return view('frontend.copyright');
    }
    public function contact(){
        return view('frontend.contact');
    }
}
