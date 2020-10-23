<?php

namespace App\Console\Commands;

use App\AdminModel\Brandarticle;
use App\Scopes\PublishedScope;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BrandArticleReleation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'brandarticle:releation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'BrandArticle ReleationShip';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $brands=Brandarticle::withoutGlobalScope(PublishedScope::class)->orderBy('id','asc')->get(['id','brandname']);

        foreach ($brands as $brand){
            $bandname=str_replace('加盟','',$brand->brandname);
            $u88brandinfo=DB::connection('u88cms')->select("select brandnum,brandname,brandarea,brandmap,brandattch,brandperson,brandapply,brandchat,brandgroup,brandaddr,registeredcapital,texuid,url from u88_brandarticles where title like '%$bandname%'");
            if (!empty($u88brandinfo)){
                Brandarticle::withoutGlobalScope(PublishedScope::class)->update([
                    'brandnum'=>$u88brandinfo[0]->brandnum,
                    'brandarea'=>$u88brandinfo[0]->brandarea,
                    'brandmap'=>$u88brandinfo[0]->brandmap,
                    'brandattch'=>$u88brandinfo[0]->brandattch,
                    'brandperson'=>$u88brandinfo[0]->brandperson,
                    'brandapply'=>$u88brandinfo[0]->brandapply,
                    'brandchat'=>$u88brandinfo[0]->brandchat,
                    'brandgroup'=>$u88brandinfo[0]->brandgroup,
                    'brandaddr'=>$u88brandinfo[0]->brandaddr,
                    'registeredcapital'=>$u88brandinfo[0]->registeredcapital,
                    //'url'=>$u88brandinfo[0]->url,
                ]);
            }
        }
    }
}
