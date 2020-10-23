<?php

namespace App\Console\Commands;

use App\AdminModel\Archive;
use App\AdminModel\Brandarticle;
use App\AdminModel\KnowedgeNew;
use App\Scopes\PublishedScope;
use Illuminate\Console\Command;

class ArticleReleation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:releation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'article releation';

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
        $this->processArchiverelation();
        $this->processKnowledgerelation();
    }

    /**
     * 普通文档关联typeid
     */
    private function processArchiverelation(){
        $brandarticles=Brandarticle::withoutGlobalScope(PublishedScope::class)->get(['brandname','id','typeid']);
        //已存在brandid关联typeid
        $brandrelationids=Archive::withoutGlobalScope(PublishedScope::class)->where('typeid',0)->where('brandid','>',0)->get(['id','brandid']);
        foreach ($brandrelationids as $brandrelationid){
            Archive::withoutGlobalScope(PublishedScope::class)->where('typeid',0)->where('brandid',$brandrelationid->brandid)->update(['typeid'=>Brandarticle::withoutGlobalScope(PublishedScope::class)->where('id',$brandrelationid->brandid)->value('typeid')?Brandarticle::withoutGlobalScope(PublishedScope::class)->where('id',$brandrelationid->brandid)->value('typeid'):0]);
        }
        //无关联信息模糊关联
        foreach ($brandarticles as $brandname) {
            $releationarticleids=Archive::withoutGlobalScope(PublishedScope::class)->where('typeid',0)->where('brandid',0)->where('title','like','%'.str_replace('加盟','',$brandname->brandname).'%')->get(['id']);
            foreach ($releationarticleids as $releationarticleid) {
                Archive::withoutGlobalScope(PublishedScope::class)->where('id',$releationarticleid->id)->update(['brandid'=>$brandname->id,'typeid'=>$brandname->typeid]);
            }

        }
    }

    /**
     * 知识文档关联typeid
     */
    private function processKnowledgerelation(){
        $brandarticles=Brandarticle::withoutGlobalScope(PublishedScope::class)->get(['brandname','id','typeid']);
        //已存在brandid关联typeid
        $brandrelationids=KnowedgeNew::withoutGlobalScope(PublishedScope::class)->where('typeid',0)->where('brandid','>',0)->get(['id','brandid']);
        foreach ($brandrelationids as $brandrelationid){
            KnowedgeNew::withoutGlobalScope(PublishedScope::class)->where('typeid',0)->where('brandid',$brandrelationid->brandid)->update(['typeid'=>Brandarticle::withoutGlobalScope(PublishedScope::class)->where('id',$brandrelationid->brandid)->value('typeid')?Brandarticle::withoutGlobalScope(PublishedScope::class)->where('id',$brandrelationid->brandid)->value('typeid'):0]);
        }
        //无关联信息模糊关联
        foreach ($brandarticles as $brandname) {
            $releationarticleids=KnowedgeNew::withoutGlobalScope(PublishedScope::class)->where('typeid',0)->where('brandid',0)->where('title','like','%'.str_replace('加盟','',$brandname->brandname).'%')->get(['id']);
            foreach ($releationarticleids as $releationarticleid) {
                KnowedgeNew::withoutGlobalScope(PublishedScope::class)->where('id',$releationarticleid->id)->update(['brandid'=>$brandname->id,'typeid'=>$brandname->typeid]);
            }

        }
    }
}
