<?php

namespace App\Http\Middleware;

use Closure;
use App\Device;

class RequireDeviceID
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
        if($request->request->has('device_id')){
            $device = Device::whereDeviceUuid($request->request->get('device_id'))->first();
            if($device != null){
                return $next($request);
            }
        }
        return response()->json(['status'=>403,'message'=>'A valid device identifier is required.'],403);
    }
}
