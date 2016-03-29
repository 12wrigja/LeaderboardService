<?php

namespace App\Http\Middleware;

use Closure;
use App\AppKey;

class CheckForAppKey
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
        if($request->request->has('app_key')){
            $potentialKey = $request->request->get('app_key');
            $keySearchRes = AppKey::whereAppKey($potentialKey)->exists();
            if($keySearchRes){
                return $next($request);
            }
        }
        return response()->json(['status'=>403,'message'=>'A valid application key is required.'],403);
    }
}
