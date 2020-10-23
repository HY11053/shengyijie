<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Facades\Agent;
use Log;
class RedirectUrlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ((str_contains($request->url(),'www.')) && Agent::isMobile())
        {
            $redirecturl=str_replace('www.','m.',config('app.url').$_SERVER['REQUEST_URI']);
            return redirect($redirecturl,302);
        }
        return $next($request);
    }
}
