<?php

namespace App\Http\Controllers\Api;

use App\AdminModel\Admin;
use App\AdminModel\Archive;
use App\AdminModel\Brandarticle;
use App\AdminModel\KnowedgeNew;
use App\Events\ArticleCacheCreateEvent;
use App\Events\BaiduCurlLinkSubmitEvent;
use App\Events\BrandArticleCacheCreateEvent;
use App\Events\KnowLedgeCacheCreateEvent;
use App\Http\Requests\CreateBrandArticleRequest;
use App\Scopes\PublishedScope;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Log;
use Ramsey\Uuid\Uuid;

class ArticlePushController extends Controller
{
    /**数据推送处理
     * @param Request $request
     * @return string
     */
    public function articlePush(Request $request){
        if (empty($request->title) || empty($request->keywords) || empty($request->brandcid) || empty($request->brandtypeid) || empty($request->brandid) || empty($request->typeid) || empty($request->body) || empty($request->write)){
            return '数据不合法';
        }
        if(Archive::withoutGlobalScope(PublishedScope::class)->where('title',$request->title)->value('id'))
        {
            exit('标题重复，禁止发布');
        }
        $request['bdname']=Brandarticle::where('id',$request->brandid)->value('brandname');
        $request['mid']=1;
        if ($request->brandid)
        {
            $brandinfo=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('id',$request->brandid)->first(['brandname','id','published_at']);
            if (isset($brandinfo->brandname))
            {
                $request['bdname']=$brandinfo->brandname;
                if (isset($brandinfo->published_at) && Carbon::parse($brandinfo->published_at)>Carbon::now())
                {
                    $request['published_at']=Carbon::parse($brandinfo->published_at)->addMinutes(rand(1,300))->addSeconds(rand(1,59));
                }
            }
        }
        $this->processRequest($request);
        $request['litpic']=$this->getLitpic($request->body);
        if ($request->articletype==1){
            if ( Archive::create($request->all())->wasRecentlyCreated){
                Log::info($request['write'].'=>资讯'.$request['title'].'=>'.Carbon::now());
                //百度相关数据提交
                $thisarticle=Archive::withoutGlobalScope(PublishedScope::class)->orderBy('id','desc')->first();
                if ($thisarticle->published_at>Carbon::now() || $thisarticle->ismake !=1){
                    echo '发布成功';
                }else{
                    $thisarticleurl=config('app.url').'/news/'.$thisarticle->id;
                    event(new BaiduCurlLinkSubmitEvent($thisarticleurl,'SC实时提交',$thisarticle->xiongzhang,$thisarticle->id));
                    event(new ArticleCacheCreateEvent($thisarticle));
                    echo '发布成功,并成功推送';
                }
            }
        }elseif($request->articletype==2){
            if ( KnowedgeNew::create($request->all())->wasRecentlyCreated){
                Log::info($request['write'].'=>知识'.$request['title'].'=>'.Carbon::now());
                //百度相关数据提交
                $thisarticle=KnowedgeNew::withoutGlobalScope(PublishedScope::class)->orderBy('id','desc')->first();
                if ($thisarticle->published_at>Carbon::now() || $thisarticle->ismake !=1){
                    echo '发布成功';
                }else{
                    $thisarticleurl=config('app.url').'/zhishi/'.$thisarticle->id;
                    event(new BaiduCurlLinkSubmitEvent($thisarticleurl,'SC实时提交',$thisarticle->xiongzhang,$thisarticle->id));
                    event(new KnowLedgeCacheCreateEvent($thisarticle));
                    echo '发布成功,并成功推送';
                }
            }
        }

    }

    /**品牌文档推送
     * @param CreateBrandArticleRequest $request
     * @return string
     */
    public function BrandarticlePush(CreateBrandArticleRequest $request){
        if (empty($request->title) || empty($request->keywords) ||empty($request->typeid) || empty($request->body) || empty($request->write) || empty($request->litpic) || empty($request->imagepics)){
            return '数据不合法';
        }
        if(Brandarticle::withoutGlobalScope(PublishedScope::class)->where('title',$request->title)->value('id'))
        {
            exit('标题重复，禁止发布');
        }
        $request['bdname']=$request->brandname;
        $request['mid']=1;
        $this->processRequest($request);
        if ( Brandarticle::create($request->all())->wasRecentlyCreated){
            Log::info($request['write'].'=>'.$request['title'].'=>'.Carbon::now());
            //百度相关数据提交
            $thisarticle=Brandarticle::withoutGlobalScope(PublishedScope::class)->orderBy('id','desc')->first();
            if ($thisarticle->published_at>Carbon::now() || $thisarticle->ismake !=1){
                echo '发布成功';
            }else{
                $thisarticleurl=config('app.url').'/busInfo/'.$thisarticle->id.'.html';
                event(new BaiduCurlLinkSubmitEvent($thisarticleurl,'SC实时提交',$thisarticle->xiongzhang,$thisarticle->id));
                event(new BrandArticleCacheCreateEvent($thisarticle));
                echo '发布成功,并成功推送';
            }
        }
    }

    /**导入内容处理
     * @param Request $request
     */
    private function processRequest(Request $request){
        if(!empty($request['published_at']) && strpos($request['published_at'],':')==false &&  Carbon::parse($request['published_at'])>Carbon::now())
        {
            $request['published_at']=  Carbon::parse($request['published_at'])->addHours(Carbon::now()->hour)->addMinutes(Carbon::now()->minute)->addSeconds(Carbon::now()->second);
            $request['created_at']=$request['published_at'];
        }else{
            $request['published_at']=Carbon::now();
            $request['created_at']=Carbon::now();
        }
        $request['origin_time']= Carbon::now();
        $request['click']=rand(1000,2000);
        $request['body']=$this->processContent($request->body,$request['bdname']);
        $request['description']=(!empty($request['description']))?str_limit($request['description'],180,''):str_limit(str_replace(['&nbsp;',' ','　',PHP_EOL,"\t"],'',strip_tags(htmlspecialchars_decode($request['body']))), $limit = 180, $end = '');
        $request['dutyadmin']=Admin::where('name',$request->write)->value('id');
        if (empty($request['dutyadmin'])){
            exit('未授权');
        }
        $request['ispush']=0;
    }
    /**远程图片上传
     * @param Request $request
     * @return string
     */
    public function Imagepush(Request $request){
        $data = $request->getContent();
        if ($data){
            $storePath='/uploads'.date('/Y/m/d/',time());
            if(!is_dir($storePath))
            {
                Storage::makeDirectory('public'.$storePath);
            }
            $uuid=Uuid::uuid1();
            $filepath='storage'.$storePath.$uuid->getHex().'.png';
            $file = file_put_contents($filepath, $data);
            if ($file){
                return '/'.$filepath;
            }
        }
    }
    /**图片本地化处理
     * @param $content
     * @param $brandname
     * @return mixed
     */
    private function processContent($content,$brandname){
        $content=preg_replace('#<h1>([\s\S]*?)</h1>#','',htmlspecialchars_decode($content));
        preg_match_all("/src=[\"|'|\s]([^\"|^\'|^\s]*?)/isU",$content,$img_array);
        $img_arrays = array_unique($img_array[1]);
        Log::info($img_arrays);
        $storePath='uploads/'.date('Y/m/d/',time());
        if(!is_dir($storePath))
        {
            Storage::makeDirectory('public/'.$storePath);
        }
        foreach ($img_arrays as $image){
            if (!str_contains($image,config('app.url'))){
                if (!str_contains($image,"http") && str_contains($image,"//")){
                    $content=str_replace($image,str_replace("//",'http://',$image),$content);
                    $image=str_replace("//",'http://',$image);
                }
                $uuid=Uuid::uuid1();
                $filename='storage/'.$storePath.$uuid->getHex().'.jpg';
                Image::make($image)->resize(600, 400)->save($filename);
                $content=str_replace($image,'/'.$filename,$content);
            }
        }
        /*preg_match_all("/title=[\"|'|\s]([^\"|^\']*?)/isU",$content,$title_arrays);
        foreach ($title_arrays[1] as $title_array){
            $content=str_replace($title_array,$brandname,$content);
        }
        preg_match_all("/alt=[\"|'|\s]([^\"|^\']*?)/isU",$content,$alt_arrays);
        foreach ($alt_arrays[1] as $alt_array){
            $content=str_replace($alt_array,$brandname,$content);
        }*/
        return $content;
    }

    /**缩略图处理
     * @param $content
     * @return mixed
     */
    private function getLitpic($content){
        preg_match_all("/src=[\"|'|\s]([^\"|^\'|^\s]*?)/isU",$content,$img_array);
        $img_arrays = array_unique($img_array[1]);
        if (count($img_arrays)){
            return $img_arrays[0];
        }
    }


    /**百度主动推送
     * @param $thisarticleurl
     * @param $token
     * @param $type
     */
    private function BaiduCurl($token,$thisarticleurl,$type)
    {
        $urls = array($thisarticleurl);
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL =>$token,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        Log::info($thisarticleurl);
        Log::info($type);
        Log::info($result);
    }
}
