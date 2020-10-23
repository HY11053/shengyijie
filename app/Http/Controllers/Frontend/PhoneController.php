<?php

namespace App\Http\Controllers\Frontend;

use App\AdminModel\Phonemanage;
use App\Events\PhoneEvent;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function PhoneComplate(Request $request){

        if($this->regTel($request->input('phoneno'))  && empty(Phonemanage::where('ip', $request->getClientIp())->where('created_at','>',Carbon::now()->subMinutes(10))->where('created_at','<',Carbon::now())->value('ip')))
        {
            $request['phoneno']=$request->input('phoneno');
            $request['name']=$request->input('name')?$request->input('name'):'未提供';
            $request['ip']=$request->getClientIp();
            $request['host']=$request->input('host');
            $request['referer']=str_limit($request->session()->all()['referer'],100,'');
            $request['note']=$request['note'];
            if (Phonemanage::create($request->all())->wasRecentlyCreated)
            {
                event(new PhoneEvent(Phonemanage::latest()->first()));
            }
            echo '提交成功，我们将尽快与您联系';
        }else{
            echo '电话已存在，请直接点击咨询';
        }
    }

    /**IP校验
     * @param $phone
     * @return bool
     */

    private function regTel($phone)
    {
        $telRegex = "/^1[34578]\d{9}$/";
        if ( preg_match( $telRegex, $phone ) ) {
            return true;
        } else {
            return false;
        }
    }
}
