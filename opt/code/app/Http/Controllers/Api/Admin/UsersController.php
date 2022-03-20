<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request, User $user){
        $users = [];

        if($request->user_id > 0){
            $users[] = User::find($request->user_id);
        }
        else{
            $users = $user->withOrder($request->sort)
                ->paginate($request->limit, ['*'], 0, $request->page);
        }

        foreach($users as $value){
            $list[] = [
                'user_id' => $value->user_id,
                'avatar_url' => $value->avatar_url,
                'nickname' => $value->nickname,
                'gender' => $value->gender,
                'birthday' => $value->birthday,
                'account' => $value->account,
                'register_time' => $value->created_at,
                'status' => $value->status,
            ];
        }

        return response()->json([
            'code' => 20000,
            'list' => $list,
            'total' => User::count(),
        ]);
    }

	public function destroy(User $user)
	{
        // $this->authorize('destroy', $user);
        $user_id = $user->user_id;
        $user->status = 2;

        $user->save();

        return response()->json([
            'code' => 20000,
            'user_id' => $user_id,
        ]);
	}
}
