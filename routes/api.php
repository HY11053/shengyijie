<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//文档生成api
Route::get('/getbrandidapi', 'BrandTypeController@getBrandId');
Route::get('/brandtidapi', 'BrandTypeController@getBrandTid');
Route::get('/brandcidapi', 'BrandTypeController@getBrandCid');
Route::get('/getbdnameapi', 'BrandTypeController@getBrandnames');
Route::get('/getarticletypeapi', 'BrandTypeController@getArticleType');
Route::get('/getbrandpicsapi', 'BrandTypeController@getBrandPic');
Route::get('/getbrandprovince', 'BrandTypeController@getProvinces');
Route::get('/getbrandcitys', 'BrandTypeController@getCitys');
Route::get('/getinvestments', 'BrandTypeController@getInvestments');
Route::get('/getacreagements', 'BrandTypeController@getAcreagements');
Route::get('/getbdpayapi', 'BrandTypeController@getBrandpay');
Route::get('/getbdacreagementapi', 'BrandTypeController@getBrandAcreage');
Route::post('/article/push', 'ArticlePushController@articlePush');
Route::post('/image/push', 'ArticlePushController@Imagepush');
Route::post('/brandarticle/push', 'ArticlePushController@BrandarticlePush');
//用户文档列表统计
Route::get('users/articlescount', 'UserArticlesCount@ArticlesCount');
