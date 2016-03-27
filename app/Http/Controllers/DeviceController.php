<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use Faker\Factory as FakerGen;

class DeviceController extends Controller
{


    /**
     * DeviceController constructor.
     */
    public function __construct()
    {
        $this->middleware('device.registered',['except'=>['registerForDeviceId','index']]);
    }

    public function index(){
        $device = $this->getCurrentDevice();
        return response()->json(['registered'=>($device != null)]);
    }

    public function registerForDeviceId(){
        $device = $this->getCurrentDevice();
        if($device == null) {
            $device = new Device();
            $faker = FakerGen::create();
            $device->device_uuid = $faker->uuid;
            $device->save();
        }
        return response()->json(['device_id'=>$device->device_uuid]);
    }

    public function signInWithCurrentDevice(){
        $device = $this->getCurrentDevice();
        $username = request()->request->get('username');
        $password = request()->request->get('password');
        if(Auth::once(['username'=>$username,'password'=>$password])){
            $user = User::whereUsername($username)->first();
            $device->user_id = $user->id;
            return response()->json(['signed_in'=>$device->save()]);
        } else {
            return response()->json(['signed_in'=>false],401);
        }
    }

    public function logOutOfCurrentDevice(){
        $device = $this->getCurrentDevice();
        $device->user_id = null;
        $isSignedOut = $device->save();
        return response()->json(['signed_out'=>$isSignedOut],$isSignedOut?200:422);
    }

    public function getUserForCurrentDevice(){
        $device = $this->getCurrentDevice();
        $user_id = $device->user_id;
        return User::find($user_id);
    }

    public function getCurrentDevice(){
        $device_id = request()->request->get('device_id');
        if($device_id == null){
            return null;
        } else {
            $device = Device::whereDeviceUuid($device_id)->first();
            return $device;
        }
    }
}
