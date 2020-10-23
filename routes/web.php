<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['domain' => 'm.3198.com'], function () {
    Route::get('/','Mobile\IndexController@Index');
    Route::get('about.html','Mobile\StatMentController@about');
    Route::get('sitemap.html','Mobile\StatMentController@sitemap');
    Route::get('copyright.html','Mobile\StatMentController@copyright');
    Route::get('contact.html','Mobile\StatMentController@contact');
    Route::get('xm','Mobile\ListController@XmLists');
    Route::get('xm/{id}','Mobile\ArticleController@BrandArticle')->where(['id'=>'[0-9]+']);
    Route::get('xm/{id}/news','Mobile\ArticleController@BrandArticleNews')->where(['id'=>'[0-9]+']);
    Route::get('xm/{id}/wenda','Mobile\ArticleController@BrandArticleAsks')->where(['id'=>'[0-9]+']);
    Route::get('wenda/{id}','Mobile\ArticleController@NewsArticle')->where(['id'=>'[0-9]+']);
    Route::get('news','Mobile\ListController@TopIndexArticleList');
    Route::get('news/{id}','Mobile\ArticleController@NewsArticle')->where(['id'=>'[0-9]+']);
    Route::get('news/{path}','Mobile\ListController@IndexArticleList')->where(['path'=>'[a-z]+']);;
    Route::get('news/{path}/{id}','Mobile\ListController@NewsArticleList')->where(['path'=>'[a-z]+','id'=>'[0-9]+']);;
    Route::get('zhishi','Mobile\ListController@TopIndexArticleList');
    Route::get('zhishi/{id}','Mobile\ArticleController@NewsArticle')->where(['id'=>'[0-9]+']);
    Route::get('zhishi/{path}','Mobile\ListController@IndexArticleList')->where(['path'=>'[a-z]+']);
    Route::get('zhishi/{path}/{id}','Mobile\ListController@NewsArticleList')->where(['path'=>'[a-z]+','id'=>'[0-9]+']);
    Route::get('search','Mobile\SearchController@Search');
    Route::get('{path}','Mobile\ListController@TopbrandList')->where(['path'=>'[a-z]+']);;
    Route::get('{path}/{id}','Mobile\ListController@BrandList')->where(['path'=>'[a-zA-Z]+','id'=>'[0-9]+']);
});
Route::get('/','Frontend\IndexController@Index');
Route::get('about.html','Frontend\StatMentController@about');
Route::get('sitemap.html','Frontend\StatMentController@sitemap');
Route::get('copyright.html','Frontend\StatMentController@copyright');
Route::get('contact.html','Frontend\StatMentController@contact');
Route::post('phonecomplate','Frontend\PhoneController@PhoneComplate');
Route::get('xm','Frontend\ListController@XmLists');
Route::get('xm/{id}','Frontend\ArticleController@BrandArticle')->where(['id'=>'[0-9]+']);
Route::get('xm/{id}/news','Frontend\ArticleController@BrandArticleNews')->where(['id'=>'[0-9]+']);
Route::get('xm/{id}/wenda','Frontend\ArticleController@BrandArticleAsks')->where(['id'=>'[0-9]+']);
Route::get('wenda/{id}','Frontend\ArticleController@NewsArticle')->where(['id'=>'[0-9]+']);
Route::get('news','Frontend\ListController@TopIndexArticleList');
Route::get('news/{id}','Frontend\ArticleController@NewsArticle')->where(['id'=>'[0-9]+']);
Route::get('news/{path}','Frontend\ListController@IndexArticleList')->where(['path'=>'[a-z]+']);;
Route::get('news/{path}/{id}','Frontend\ListController@NewsArticleList')->where(['path'=>'[a-z]+','id'=>'[0-9]+']);;
Route::get('zhishi','Frontend\ListController@TopIndexArticleList');
Route::get('zhishi/{id}','Frontend\ArticleController@NewsArticle')->where(['id'=>'[0-9]+']);
Route::get('zhishi/{path}','Frontend\ListController@IndexArticleList')->where(['path'=>'[a-z]+']);
Route::get('zhishi/{path}/{id}','Frontend\ListController@NewsArticleList')->where(['path'=>'[a-z]+','id'=>'[0-9]+']);
Route::get('search','Frontend\SearchController@Search');
Route::post('feedback','Frontend\FeedController@Feedback');
Route::post('feedbac','Frontend\FeedController@Feedback');
Route::get('{path}','Frontend\ListController@TopbrandList')->where(['path'=>'[a-z]+']);;
Route::get('{path}/{id}','Frontend\ListController@BrandList')->where(['path'=>'[a-zA-Z]+','id'=>'[0-9]+']);

