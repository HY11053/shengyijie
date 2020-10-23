<?php

namespace App\Http\Controllers\Api;

use App\AdminModel\Admin;
use App\AdminModel\Archive;
use App\AdminModel\Brandarticle;
use App\AdminModel\Phonemanage;
use App\Models\Arctype;
use App\Scopes\PublishedScope;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class UserPhoneCount extends Controller
{
    public function PhoneCount(){
        $userdatas=Cache::get('userphonecount');
        return $userdatas;
    }
}
