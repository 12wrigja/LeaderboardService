<?php

namespace App\Http\Controllers;

use App\Leaderboard;
use App\Transformers\LeaderboardTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

use App\Http\Requests;

class LeaderboardController extends Controller
{

    /**
     * LeaderboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('device.registered');
    }

    public function index(){
        if(request()->has('type')){
            $leaderboardResults = Leaderboard::where('match_type','=',request()->get('type'))->orderBy('score','DESC')->paginate(100);
        } else {
            $leaderboardResults = Leaderboard::orderBy('score','DESC')->paginate(100);
        }
        return Fractal::collection($leaderboardResults, new LeaderboardTransformer())->responseJson(200);
    }

    public function addToLeaderboard(Requests\SubmitLeaderboardScoreRequest $request){
        $leaderboard = (new Leaderboard)->fill($request->request->all());
        $device = (new DeviceController())->getCurrentDevice();
        $leaderboard->device_id = $device->device_uuid;
        $leaderboard->user_id = $device->user_id;
        $success = $leaderboard->save();
        return response()->json(['uploaded'=>$success],$success?200:500);
    }

    public function upgradeDeviceIDToPlayerID(){

    }
}
