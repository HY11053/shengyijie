<?php

namespace App\Http\Controllers\Admin;

use App\AdminModel\Acreagement;
use App\AdminModel\Admin;
use App\AdminModel\Archive;
use App\AdminModel\Arctype;
use App\AdminModel\Area;
use App\AdminModel\Brandarticle;
use App\AdminModel\InvestmentType;
use App\AdminModel\KnowedgeNew;
use App\Events\ArticleCacheCreateEvent;
use App\Events\ArticleCacheDeleteEvent;
use App\Events\BaiduCurlLinkSubmitEvent;
use App\Events\BrandArticleCacheCreateEvent;
use App\Events\BrandArticleCacheDeleteEvent;
use App\Events\BrandProvinceEvent;
use App\Events\KnowLedgeCacheCreateEvent;
use App\Http\Requests\CreateArticleRequest;
use App\Helpers\UploadImages;
use App\Http\Requests\CreateBrandArticleRequest;
use App\Notifications\ArticlePublishedNofication;
use App\Scopes\PublishedScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Log;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    /**文档列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function Index()
    {
        $articles = Archive::withoutGlobalScope(PublishedScope::class)->orderBy('id','desc')->paginate(30);
        return view('admin.article',compact('articles'));
    }

    /**品牌文档查看
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function Brands()
    {
        $articles=Brandarticle::withoutGlobalScope(PublishedScope::class)->orderBy('id','desc')->paginate(30);
        return view('admin.brandarticle',compact('articles'));
    }

    /**品牌文档搜索
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function PostArticleBrandSearch(Request $request)
    {
        $articles=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('title','like','%'.$request->input('title').'%')->latest()->paginate(30);
        $title=$request->input('title');
        if(!$articles->total()){
            $this->GuardTitle($request->input('title'));
        }
        return view('admin.brandarticle',compact('articles','title'));
    }

    /**普通文档创建
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function Create()
    {
        $brandnavs=Arctype::where('is_write',1)->where('reid',0)->where('mid',1)->pluck('typename','id');
        $allnavinfos=[1=>'新闻',2=>'问答'];
        return view('admin.article_create',compact('allnavinfos','brandnavs'));
    }
    /**品牌文档创建
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function BrandCreate()
    {
        $allnavinfos=Arctype::where('is_write',1)->where('reid',0)->where('mid',1)->pluck('typename','id');
        $provinces=Area::where('parentid','1')->pluck('regionname','id');
        $investments=InvestmentType::orderBy('id','asc')->pluck('type','id');
        $acreagements=Acreagement::orderBy('id','asc')->pluck('type','id');
        return view('admin.article_brandcreate',compact('allnavinfos','investments','acreagements','provinces'));
    }

    /**文档创建提交数据处理
     * @param CreateArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function PostCreate(CreateArticleRequest $request)
    {
        if(Archive::withoutGlobalScope(PublishedScope::class)->where('title',$request->title)->value('id'))
        {
            exit('标题重复，禁止发布');
        }
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
        $request['origin_time']= Carbon::now();
        $this->RequestProcess($request);
        if (Archive::create($request->all())->wasRecentlyCreated)
        {
            Log::info($request['write'].'=>'.$request['title'].'=>'.Carbon::now());
            $thisarticle=Archive::withoutGlobalScope(PublishedScope::class)->orderBy('id','desc')->first();
            //已审核，预选发布时间小于当前时间
            if ($thisarticle->published_at<Carbon::now() && $thisarticle->ismake ==1)
            {
                $thisarticleurl=config('app.url').'/article/'.$thisarticle->id.'.html';
                event(new ArticleCacheCreateEvent($thisarticle));
                event(new BaiduCurlLinkSubmitEvent($thisarticleurl,'实时发布',$thisarticle->xiongzhang,$thisarticle->id));
            }
            return redirect(action('Admin\ArticleController@Index'));
        }
    }


    /**
     * 品牌文档提交处理
     * @param CreateBrandArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function PostBrandArticle(CreateBrandArticleRequest $request)
    {
        if(Brandarticle::withoutGlobalScope(PublishedScope::class)->where('title',$request->title)->value('id'))
        {
            exit('标题重复，禁止发布');
        }
        $request['origin_time']= Carbon::now();
        $this->RequestProcess($request);
        //图集处理
        $request['imagepics']=rtrim($request->input('imagepics'),',');
        if (empty($request['imagepics'])){
            $request['imagepics']=$this->processImagepics($request['body']);
        }
        if (Brandarticle::create($request->all())->wasRecentlyCreated)
        {
            Log::info($request['write'].'=>'.$request['title'].'=>'.Carbon::now());
            $thisarticle=Brandarticle::withoutGlobalScope(PublishedScope::class)->orderBy('id','desc')->first();
            //已审核并且预选发布时间小于当前时间
            if ($thisarticle->published_at<Carbon::now() && $thisarticle->ismake ==1)
            {
                event(new BrandArticleCacheCreateEvent($thisarticle));
                $thisarticleurl=config('app.url').'/xiangmu/'.$thisarticle->id.'.html';
                event(new BaiduCurlLinkSubmitEvent($thisarticleurl,'实时发布',$thisarticle->xiongzhang,$thisarticle->id));
            }
            return redirect(action('Admin\ArticleController@Brands'));
        }
    }

    /**普通文档文档编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function Edit($id)
    {
        $articleinfos=Archive::withoutGlobalScope(PublishedScope::class)->findOrfail($id);
        if (auth('admin')->user()->type==5 && $articleinfos->dutyadmin!=auth('admin')->user()->id){
            dd('无权限查看');
        }
        $allnavinfos=[1=>'新闻',2=>'问答'];
        $brandnavs=Arctype::where('is_write',1)->where('reid',0)->where('mid',1)->pluck('typename','id');
        $pics=explode(',',trim(Archive::withoutGlobalScope(PublishedScope::class)->where('id',$id)->value('imagepics'),','));
        if($articleinfos->brandid)
        {
            $thisarticlebrandinfos=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('id',$articleinfos->brandid)->first();
        }else{
            $thisarticlebrandinfos=null;
        }
        return view('admin.article_edit',compact('id','articleinfos','allnavinfos','pics','brandnavs','thisarticlebrandinfos'));
    }

    /**品牌文档更新
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function BrandEdit($id)
    {
        $allnavinfos=Arctype::where('is_write',1)->where('reid',0)->where('mid',1)->pluck('typename','id');
        $pics=explode(',',trim(Brandarticle::withoutGlobalScope(PublishedScope::class)->where('id',$id)->value('imagepics'),','));
        $provinces=Area::where('parentid','1')->pluck('regionname','id');
        $articleinfos=Brandarticle::withoutGlobalScope(PublishedScope::class)->findOrfail($id);
        if ($articleinfos->editor_id!=0 && $articleinfos->editor_id !=auth('admin')->id() &&  Admin::where('id',auth('admin')->id())->value('type')==0)
        {
            exit('文档不属于当前用户或您不是管理员，不能编辑');
        }
        $investments=InvestmentType::orderBy('id','asc')->pluck('type','id');
        $acreagements=Acreagement::orderBy('id','asc')->pluck('type','id');
        return view('admin.article_brandedit',compact('id','articleinfos','allnavinfos','pics','investments','acreagements','provinces'));
    }

    /**普通文档编辑提交处理
     * @param CreateArticleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function PostEdit(CreateArticleRequest $request,$id)
    {
        if ($request->brandid)
        {
            $brandinfo=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('id',$request->brandid)->first(['brandname','id','published_at']);
            if (isset($brandinfo->brandname))
            {
                $request['bdname']=$brandinfo->brandname;
                /*if (isset($brandinfo->published_at) && Carbon::parse($brandinfo->published_at)>Carbon::now())
                {
                    $request['published_at']=Carbon::parse($brandinfo->published_at)->addMinutes(rand(1,300))->addSeconds(rand(1,59));
                }*/
            }
        }
        $this->RequestProcess($request);
        $thisarticleinfos=Archive::withoutGlobalScope(PublishedScope::class)->findOrFail($id);
        $request['write']=$thisarticleinfos->write;
        $request['dutyadmin']=$thisarticleinfos->dutyadmin;
        //未审核状态转已审核状态 发布时间小于当前时间
        if ($thisarticleinfos->ismake!=1 && $request->ismake==1 && Carbon::parse($request->published_at) < Carbon::now()){
            $request['created_at']=Carbon::now();
            $request['published_at']=Carbon::now();
            $request['origin_time']= Carbon::now();
            Archive::withoutGlobalScope(PublishedScope::class)->findOrFail($id)->update($request->all());
            $thisarticle=Archive::withoutGlobalScope(PublishedScope::class)->where('id',$thisarticleinfos->id)->first();
            $thisarticleurl=config('app.url').'/article/'.$thisarticle->id.'.html';
            event(new ArticleCacheCreateEvent($thisarticle));
            event(new BaiduCurlLinkSubmitEvent($thisarticleurl,'编辑审核后发布',$thisarticle->xiongzhang,$thisarticle->id));
        }
        //未审核状态转已审核状态 发布时间大于当前时间
        elseif ($thisarticleinfos->ismake!=1 && $request->ismake==1 && Carbon::parse($request->published_at) > Carbon::now()){
            if (strpos($request->published_at,':')==false){
                $request['published_at']=Carbon::parse($request->published_at)->addHours(Carbon::now()->hour)->addMinutes(Carbon::now()->minute)->addSeconds(Carbon::now()->second);
            }
            $request['created_at']= Carbon::parse($request->published_at);
            $request['origin_time']= Carbon::now();
            Archive::withoutGlobalScope(PublishedScope::class)->findOrFail($id)->update($request->all());
        }
        //已审核状态，发布时间大于当前时间
        elseif($thisarticleinfos->ismake ==1 && $request->ismake==1 && Carbon::parse($request->published_at) > Carbon::now()){
            if (strpos($request->published_at,':')==false){
                $request['published_at']=Carbon::parse($request->published_at)->addHours(Carbon::now()->hour)->addMinutes(Carbon::now()->minute)->addSeconds(Carbon::now()->second);
            }
            $request['created_at']= Carbon::parse($request->published_at);
            Archive::withoutGlobalScope(PublishedScope::class)->findOrFail($id)->update($request->all());
        }else{
            Archive::withoutGlobalScope(PublishedScope::class)->findOrFail($id)->update($request->all());
            $thisarticle=Archive::withoutGlobalScope(PublishedScope::class)->where('id',$thisarticleinfos->id)->first();
            event(new ArticleCacheCreateEvent($thisarticle));
        }
        return redirect(action('Admin\ArticleController@Index'));
    }

    /**品牌文档编辑提交处理
     * @param CreateBrandArticleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function PostBrandArticleEditor(CreateBrandArticleRequest $request,$id)
    {
        $this->RequestProcess($request);
        $thisarticleinfos=Brandarticle::withoutGlobalScope(PublishedScope::class)->findOrFail($id);
        $request['write']=$thisarticleinfos->write;
        $request['dutyadmin']=$thisarticleinfos->dutyadmin;
        //图集处理
        $request['imagepics']=rtrim($request->input('imagepics'),',');
        if (empty($request['imagepics'])){
            $request['imagepics']=$this->processImagepics($request['body']);
        }
        //未审核状态转已审核状态 发布时间小于当前时间
        if ($thisarticleinfos->ismake!=1 && $request->ismake==1 && Carbon::parse($request->published_at) < Carbon::now()){
            $request['created_at']=Carbon::now();
            $request['published_at']=Carbon::now();
            $request['origin_time']= Carbon::now();
            Brandarticle::withoutGlobalScope(PublishedScope::class)->findOrFail($id)->update($request->all());
            $thisarticle=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('id',$thisarticleinfos->id)->first();
            $thisarticleurl=config('app.url').'/xiangmu/'.$thisarticle->id.'.html';
            event(new BrandArticleCacheCreateEvent($thisarticle));
            event(new BaiduCurlLinkSubmitEvent($thisarticleurl,'品牌编辑审核后发布',$thisarticle->xiongzhang,$thisarticle->id));
        }
        //未审核状态转已审核状态 发布时间大于当前时间
        elseif ($thisarticleinfos->ismake!=1 && $request->ismake==1 && Carbon::parse($request->published_at) > Carbon::now()){
            if (strpos($request->published_at,':')==false){
                $request['published_at']=Carbon::parse($request->published_at)->addHours(Carbon::now()->hour)->addMinutes(Carbon::now()->minute)->addSeconds(Carbon::now()->second);
            }
            $request['created_at']= Carbon::parse($request->published_at);
            $request['origin_time']= Carbon::now();
            Brandarticle::withoutGlobalScope(PublishedScope::class)->findOrFail($id)->update($request->all());
            event(new BrandProvinceEvent($thisarticleinfos));
        }
        //已审核状态，发布时间大于当前时间
        elseif($thisarticleinfos->ismake ==1 && $request->ismake==1 && Carbon::parse($request->published_at) > Carbon::now()){
            if (strpos($request->published_at,':')==false){
                $request['published_at']=Carbon::parse($request->published_at)->addHours(Carbon::now()->hour)->addMinutes(Carbon::now()->minute)->addSeconds(Carbon::now()->second);
            }
            $request['created_at']= Carbon::parse($request->published_at);
            Brandarticle::withoutGlobalScope(PublishedScope::class)->findOrFail($id)->update($request->all());
        }else{
            Brandarticle::withoutGlobalScope(PublishedScope::class)->findOrFail($id)->update($request->all());
            $thisarticle=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('id',$thisarticleinfos->id)->first();
            event(new BrandArticleCacheCreateEvent($thisarticle));
        }
        return redirect(action('Admin\ArticleController@Brands'));
    }

    /**
     *自定义文档属性及缩略图处理
     * @param Request $request
     * @return Request
     */
    private function RequestProcess(Request $request)
    {
        $request['keywords']=$request['keywords']?$request['keywords']:$request['title'];
        $request['click']=(!empty($request['click']))?$request['click']:rand(100,900);
        $request['description']=(!empty($request['description']))?str_limit($request['description'],180,''):str_limit(str_replace(['&nbsp;',' ','　',PHP_EOL,"\t"],'',strip_tags(htmlspecialchars_decode($request['body']))), $limit = 180, $end = '');
        $request['write']=auth('admin')->user()->name;
        $request['dutyadmin']=auth('admin')->id();
        $request['body']=str_replace('<h2></h2>','',$request->body);
        preg_match_all('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i',$request['body'],$img_array);
        //此处兼容品牌和普通文档图片alt信息替换
        if ($request->mid==0){
            if (isset($request['bdname']) && !empty($request['bdname'])){
                $request['brandname']=$request['bdname'];
            }
            if (empty($request['brandname'])){
                $request->brandname=$request->title;
            }
        }
        $request['brandname']=str_replace('加盟','',$request['brandname']).'加盟';
        if (isset($img_array[0])){
            foreach ($img_array[0] as $image){
                if (!str_contains($image,'alt')){
                    $request['body']=preg_replace("/(<img.+src=[\"|'|\s])([^\"|^\'|^\s]*?)/isU",'${1}${2}" alt="'.$request->brandname.'',$request['body']);
                }else{
                    $request['body']=preg_replace("/(<img.+alt=[\"|'|\s])([^\"|^\'|^\s]*?)/isU",'${1}'.$request['brandname'],$request['body']);
                    $request['body']=preg_replace("/(<img.+title=[\"|'|\s])([^\"|^\'|^\s]*?)/isU",'${1}'.$request['brandname'],$request['body']);
                }
            }
        }
        //自定义文档属性处理
        if(isset($request['flags']))
        {
            $request['flags']=UploadImages::Flags($request['flags']);
        }
        //缩略图处理
        if($request['image'])
        {
            $request['litpic']=UploadImages::UploadImage($request,'image');
            if(empty($request['flags']))
            {
                $request['flags'].='p';
            }else{
                $request['flags'].=',p';
            }
        }elseif (isset($request['litpic']) && !empty($request['litpic']))
        {
            $request['litpic']=$request['litpic'];
        }elseif (preg_match('/<[img|IMG].*?src=[\' | \"](.*?(?:[\.jpg|\.jpeg|\.png|\.gif|\.bmp]))[\'|\"].*?[\/]?>/i',$request['body'],$match)){
            $request['litpic']=$match[1];
            if(empty($request['flags']))
            {
                $request['flags'].='p';
            }else{
                $request['flags'].=',p';
            }
        }
        //首页推荐图处理
        if($request['indexlitpic']) {
            $request['indexpic'] = UploadImages::UploadImage($request, 'indexlitpic');
        }
        if (Admin::where('id',auth('admin')->id())->value('type')==5)
        {
        $request['ismake']=0;
        }
        return $request;
    }

    /**品牌图集提取
     * @param $content
     * @return string
     */
    private function processImagepics($content)
    {
        preg_match_all("/<img(.*)src=\"([^\"]+)\"[^>]+>/isU", $content, $matches);
        if (isset($matches[2]) && !empty($matches[2]) ) {
            $imagepics = array_slice($matches[2],0,4);
            $pics='';
            foreach ($imagepics as $imagepic) {
                $pics.=$imagepic.',';
            }
            return trim($pics,',');
        }
    }
    /**当前用户发布的文档
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function OwnerShip()
    {
        $articles = Archive::withoutGlobalScope(PublishedScope::class)->where('dutyadmin',auth('admin')->user()->id)->latest()->paginate(30);
        return view('admin.article',compact('articles'));
    }

    /**等待审核的文档
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function PendingAudit()
    {
        $articles = Archive::withoutGlobalScope(PublishedScope::class)->where('ismake','<>',1)->latest()->paginate(30);
        return view('admin.article',compact('articles'));
    }
    /**等待审核的品牌文档
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function PendingAuditBrandarticle()
    {
        $articles = Brandarticle::withoutGlobalScope(PublishedScope::class)->where('ismake','<>',1)->latest()->paginate(30);
        return view('admin.brandarticle',compact('articles'));
    }

    /**等待发布的文档
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function PedingPublished(){
        $articles = Archive::withoutGlobalScope(PublishedScope::class)->where('published_at','>',Carbon::now())->latest()->paginate(30);
        return view('admin.article',compact('articles'));
    }

    /**待发布的品牌
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function PedingBrands()
    {
        $articles = Brandarticle::withoutGlobalScope(PublishedScope::class)->where('published_at','>',Carbon::now())->latest()->paginate(30);
        return view('admin.brandarticle',compact('articles'));
    }

    /**待更新的品牌
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function PedingUpdateBrands()
    {
        $articles = Brandarticle::withoutGlobalScope(PublishedScope::class)->where('uid',3)->latest()->paginate(30);
        return view('admin.brandarticle',compact('articles'));
    }

    /**普通文档删除
     * @param $id
     * @return string
     */
    function DeleteArticle($id)
    {
        if (Admin::where('id',auth('admin')->id())->value('type')==5){
            exit('禁止删除');
        }
        if(auth('admin')->user()->id)
        {
            event(new ArticleCacheDeleteEvent(Archive::withoutGlobalScope(PublishedScope::class)->where('id',$id)->first()));
            Archive::withoutGlobalScope(PublishedScope::class)->where('id',$id)->delete();
            return '删除成功 跳转中 请稍后';
        }else{
            return '无权限执行此操作！跳转中 请稍后';
        }
    }

    /**品牌文档删除
     * @param $id
     * @return string
     */
    public function DeleteBrandArticle($id)
    {
        if (Admin::where('id',auth('admin')->id())->value('type')==5){
            exit('禁止删除');
        }
        if(auth('admin')->user()->type ==1)
        {
            event(new BrandArticleCacheDeleteEvent(Brandarticle::withoutGlobalScope(PublishedScope::class)->where('id',$id)->first()));
            Brandarticle::withoutGlobalScope(PublishedScope::class)->where('id',$id)->delete();
            return '删除成功';
        }else{
            return '无权限执行此操作！';
        }
    }


    /**文档搜索
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function PostArticleSearch(Request $request)
    {
        $articles=Archive::withoutGlobalScope(PublishedScope::class)->where('title','like','%'.$request->input('title').'%')->latest()->paginate(30);
        $title=$request->input('title');
        if(!$articles->total()){
            $this->GuardTitle($request->input('title'));
        }
        return view('admin.article',compact('articles','title'));
    }

    /**违禁词检测
     * @param $title
     */
    private function GuardTitle($title){
        if (Storage::exists('guarded.txt'))
        {
            $filtertitles=array_unique(array_filter(explode(PHP_EOL,Storage::get('guarded.txt'))));
            foreach ($filtertitles as $filtertitle)
            {
                if (str_contains($title,str_replace([PHP_EOL,"\r"],'',trim($filtertitle))) || str_contains(trim($filtertitle),str_replace([PHP_EOL,"\r"],'',$title)))
                {
                    exit($title.'违禁词，不允许发布');
                }
            }
        }
    }

    /** 栏目文章查看
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function Type($id)
    {
        switch (Arctype::where('id',$id)->value('mid'))
        {
            case 0:
                $articles=Archive::withoutGlobalScope(PublishedScope::class)->where('typeid',$id)->latest()->paginate(30);
                $view='admin.article';
                break;
            case 1:
                $articles=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('typeid',$id)->latest()->paginate(30);
                $view='admin.brandarticle';
                break;
        }
        return view($view,compact('articles'));
    }

    /**获取地区分类
     * @param Request $request
     * @return mixed
     */
    public function GetAreas(Request $request)
    {
        $citys=Area::where('parentid',$request->province_id)->pluck('regionname','id');
        return $citys;
    }

    /**获取品牌分类
     * @param Request $request
     * @return mixed
     */
    public function GetBdnames(Request $request)
    {
        $brandnames=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('ismake',1)->where('typeid',$request->typeid)->pluck('brandname','id')->toArray();
        $brandnames[0]='Null';
        return $brandnames;
    }

    /**重复标题检测
     * @param Request $request
     * @return int
     */
    public function ArticletitleCheck(Request $request)
    {
        $title=Archive::withoutGlobalScope(PublishedScope::class)->where('title',$request->input('title'))->value('title');
        if (!$title)
        {
            $title=Brandarticle::withoutGlobalScope(PublishedScope::class)->where('title',$request->input('title'))->value('title');
        }
        if (Storage::exists('guarded.txt'))
        {
            $filtertitles=array_unique(array_filter(explode(PHP_EOL,Storage::get('guarded.txt'))));
            foreach ($filtertitles as $filtertitle)
            {
                if (str_contains($request->input('title'),str_replace([PHP_EOL,"\r"],'',trim($filtertitle))))
                {
                    $title='违禁词，不允许发布';
                }
            }
        }
        return $title;
    }

}
