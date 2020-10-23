<?php
/**
 * Created by PhpStorm.
 * User: liang
 * Date: 2017/2/19
 * Time: 21:05
 */

use App\AdminModel\Archive;
use App\AdminModel\BrandProvinceNum;
use Illuminate\Support\Facades\Cache;

/**
 * 对栏目返回的多维数组按照一定格式递归遍历出来
 * @param array
 *
 * @return arraydatas
 */
function Recursivestypeinfos($arr){
    if(!is_array($arr)){
        return false;
    }else{
        foreach ($arr as $key=>$value)
        {

            if(isset($value['list']))
            {
                //dd($value);
                echo " <li><a class=\"arctype\" href=\"/admin/article/type/{$key}\"><i class=\"fa fa-envelope-o\"></i> {$value['list']}</a>
                                <span class=\"label label-danger pull-right\" data-toggle=\"modal\" data-target=\".modal-sm{$key}\">删除</span>                               
                                 <span class=\"label label-success pull-right\" onclick=\"link({$key},'admin/category/edit')\">编辑</span> 
                                 <span class=\"label label-warning pull-right\" onclick=\"link({$key},'admin/category/create')\">添加子类</span></li>";
                if (isset($value['next']))
                {
                    echo "<div class=\"box box-solid collapsed-box\">
                                                <div class=\"box-header with-border\">
                                                    <h3 class=\"box-title\"><i class='fa fa-long-arrow-down' style='padding-left: 10px;'>{$value['list']}</i></h3>
    
                                                    <div class=\"box-tools\">
                                                        <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\"><i class=\"fa fa-plus\"></i></button>
                                                    </div>
                                                </div>
                                                <div class=\"box-body no-padding\">
                                                    <ul class=\"nav nav-pills nav-stacked\">";
                    foreach ($value['next'] as $item=>$items)
                    {
                        if(isset($items['list']))
                        {

                            echo "<li class=\"active\"><a class=\"arctype\" href=\"/admin/article/type/{$item}\"><i class=\"fa fa-inbox\"></i>".$items['list']."</a>
                            <span class=\"label label-danger pull-right\" data-toggle=\"modal\" data-target=\".modal-sm{$item}\">删除</span>                                                        
                             <span class=\"label label-success pull-right\" onclick=\"link({$item},'admin/category/edit')\">编辑</span> <span class=\"label label-warning pull-right\" onclick=\"link({$item},'admin/category/create')\">添加子类</span></li>";
                            if(isset($items['next'])){

                                Recursivestypeinfos($items['next']);
                            }
                        }else{
                            echo "<li class=\"active\"><a class=\"arctype\" href=\"/admin/article/type/{$item}\"><i class=\"fa fa-inbox\"></i>".$items." </a> 
                            <span class=\"label label-danger pull-right\" data-toggle=\"modal\" data-target=\".modal-sm$item\">删除</span>                             
                            <span class=\"label label-success pull-right\" onclick=\"link({$item},'admin/category/edit')\">编辑</span> <span class=\"label label-warning pull-right\" onclick=\"link({$item},'admin/category/create')\">添加子类</span></li>";

                        }

                     }
                    echo "</ul>
                                    </div>
                                            </div>";
                }
            }else{
                echo " <li><a class=\"arctype\" href=\"/admin/article/type/{$key}\"><i class=\"fa fa-envelope-o\"></i> {$value}</a>                       
                                <span class=\"label label-danger pull-right\" data-toggle=\"modal\" data-target=\".modal-sm{$key}\">删除</span>                                
                                 <span class=\"label label-success pull-right\" onclick=\"link({$key},'admin/category/edit')\">编辑</span> <span class=\"label label-warning pull-right\" onclick=\"link({$key},'admin/category/create')\">添加子类</span></li>";

            }

        }
    }

}
function Brandcount($id){
    //门店数据统计
    $brandmaps=Cache::remember('brand_shopnum_'.$id,  config('app.cachetime')+rand(60,60*24), function() use ($id){
        return BrandProvinceNum::where('brandid',$id)->orderBy('shopnum','desc')->distinct('province')->get(['shopnum','province','address','square','payment']);
    });
    $countnum=0;
    foreach ($brandmaps as $brandmap)
    {
        $countnum+=$brandmap->shopnum;
    }
    return $countnum;
}

function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}



