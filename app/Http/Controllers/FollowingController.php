<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Following;


class FollowingController extends Controller
{
    //フォローする
    public function following(User $user, Request $request)
    {
        $follow=New Following();
        $follow->user_id=$user->id;
        $follow->following_user_id=\Auth::user()->id;
        $follow->save();
        return back();
    }
    //フォロー解除する
    public function unfollowing(User $user, Request $request)
    {
        $auth_user=\Auth::user()->id;
        $follow=Following::where('user_id', $user->id)->where('following_user_id', $auth_user)->first();
        $follow->delete();
        return back();
    }   

    public function following_list(User $user, Request $request)
    {
        return view('following_list')->with(['follows' => $user->getPaginateFollows(6, $user->id), 'user' => $user]);
    }

    public function follower_list(User $user, Request $request)
    {
        return view('follower_list')->with(['followers' => $user->getPaginateFollowers(6, $user->id), 'user' => $user]);
    }
}
