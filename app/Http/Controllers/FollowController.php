<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowUnfollowRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class FollowController extends Controller
{
    public function follow(Request $request) {
        if(!auth()->user()){
            return redirect('/redirect');
        }

        $userToFollow = User::findOrFail($request->user_id);

        if ($userToFollow->id === auth()->user()->id) {
            // return response()->json(['error' => 'Cannot follow yourself.'], 422);
            return redirect()->back();
        }

        auth()->user()->follow($userToFollow);
        return redirect()->back();
    }

    public function unfollow(Request $request) {
        if(!auth()->user()){
            return redirect('/redirect');
        }

        $userToUnfollow = User::findOrFail($request->user_id);

        if ($userToUnfollow->id === auth()->user()->id) {
            // return response()->json(['error' => 'Cannot follow yourself.'], 422);
            return redirect()->back();
        }

        auth()->user()->unfollow($userToUnfollow);
        return redirect()->back();
    }
}
