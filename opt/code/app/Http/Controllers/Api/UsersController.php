<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\Practice;
use App\Models\User;
use Attribute;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Support\Str;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
    //     $verifyData = Cache::get($request->verification_key);

    //    if (!$verifyData) {
    //        abort(403, '验证码已失效');
    //     }

    //     if (!hash_equals($verifyData['code'], $request->verification_code)) {
    //         // 返回401
    //         throw new AuthenticationExceptio('验证码错误');
    //     }

        $user = User::create([
            'account' => $request->account,
            'password' => Hash::make($request->password),
            'avatar_url' => 'https://cdn.learnku.com/uploads/images/201710/14/1/xAuDMxteQy.png',
            'nickname' => Str::random(6),
        ]);

        Practice::create([
            'user_id' =>$user->user_id,
        ]);

        // 清除验证码缓存
        // Cache::forget($request->verification_key);

        return new UserResource($user, []);
    }

    public function update(UserRequest $request)
    {
        $user = Auth::guard('api')->user();

        $attributes = ['gender' => (int)$request->gender];
        if($request->avatar_url != ""){
            $attributes['avatar_url'] = $request->avatar_url;
        }
        if($request->nickname != ""){
            $attributes['nickname'] = $request->nickname;
        }
        if($request->birthday != 0){
            $attributes['birthday'] = (int)$request->birthday;
        }
        if($request->education != ""){
            $attributes['education'] = $request->education;
        }

        $user->update($attributes);

        return response()->json([
            'state' => 1,
            'user_id' => $user->user_id,
            'avatar_url' => $user->avatar_url,
            'nickname' => $user->nickname,
            'birthday' => $user->birthday,
            'education' => $user->education,
            'gender' => $user->gender,
        ]);
    }

    public function follow(Request $request)
    {
        $user = Auth::guard('api')->user();

        $target_user_id = (int)$request->target_user_id;

        if($target_user_id == $user->user_id){
            return response()->json([
                'state' => 0,
                'err' => '不能关注自己!'
            ]);
        }

        $isFollow = false;

        if($user->isFollowing($target_user_id)){
            $user->unfollow($target_user_id);
        }
        else{
            $isFollow = true;
            $user->follow($target_user_id);
        }

        $targetUser =  User::find($target_user_id);

        if($isFollow){
            return response()->json([
                'state' => 1,
                'user_id' => $user->user_id,
                'is_follow' => $isFollow,
                'target_user_id' => $target_user_id,
                'target_avatar_url' => $targetUser->avatar_url,
                'target_nickname' => $targetUser->nickname,
                'target_gender' => $targetUser->gender,
            ]);
        }
        else{
            return response()->json([
                'state' => 1,
                'user_id' => $user->user_id,
                'is_follow' => $isFollow,
                'target_user_id' => $target_user_id,
            ]);
        }
    }

    public function followings()
    {
        $user = Auth::guard('api')->user();

        $users = $user->followings()->paginate(30);

        $list = [];
        foreach($users as $value){
            $list[] = [
                'state' => 1,
                'user_id' => $value->user_id,
                'avatar_url' => $value->avatar_url,
                'nickname' => $value->nickname,
                'gender' => $value->gender,
            ];
        }

        return response()->json([
            'state' => 1,
            'user_id' => $user->user_id,
            'list' => $list,
        ]);
    }

    public function followers()
    {
        $user = Auth::guard('api')->user();

        $users = $user->followers()->paginate(30);

        $list = [];

        foreach($users as $value){
            $list[] = [
                'state' => 1,
                'user_id' => $value->user_id,
                'avatar_url' => $value->avatar_url,
                'nickname' => $value->nickname,
                'gender' => $value->gender,
            ];
        }

        return response()->json([
            'state' => 1,
            'list' => $list,
        ]);
    }
}
