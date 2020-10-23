<?php

namespace App\Listeners;

use App\AdminModel\Baidusubmitlink;
use App\Events\BaiduCurlLinkSubmitEvent;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;
class BaiduCurlLinkSubmitEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BaiduCurlLinkSubmitEvent  $event
     * @return void
     */
    public function handle(BaiduCurlLinkSubmitEvent $event)
    {

        if (isset($event->args) && count($event->args))
        {
            if (isset($event->args[1]))
            {
                $prefxname=$event->args[1];
            }else{
                $prefxname='';
            }
            $this->BaiduCurl(config('app.api'),array_first($event->args),'百度PC主动推送',0);
            $mobile_remain=Baidusubmitlink::where('mid',1)->where('created_at','>=',Carbon::today())->latest()->first();
            if (isset($mobile_remain->id) && $mobile_remain->remain>0)
            {
                $this->BaiduCurl(config('app.mip_api'),str_replace('www.','m.',array_first($event->args)),$prefxname.'熊掌号天级推送',1);
            }elseif(isset($mobile_remain->id) && $mobile_remain->remain<1){
                $this->BaiduCurl(config('app.mip_history'),str_replace('www.','m.',array_first($event->args)),$prefxname.'熊掌号周级推送',2);
            }else{
                $this->BaiduCurl(config('app.mip_api'),str_replace('www.','m.',array_first($event->args)),$prefxname.'熊掌号天级推送',1);
            }
        }
    }


    /**百度主动推送
     * @param $thisarticleurl
     * @param $token
     * @param $type
     */
    private function BaiduCurl($token,$thisarticleurl,$type,$mid=0)
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
        $result = json_decode(curl_exec($ch),true);
        if (!empty($result) && !isset($result['error']))
        {
            $result['url']=$thisarticleurl;
            $result['type']=$type;
            $result['mid']=$mid;
            if ($mid==2)
            {
                $result['remain']=0;
            }
            Baidusubmitlink::create($result);
        }
    }
}
