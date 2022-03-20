<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthorizationRequest;
use App\Http\Resources\Api\UserResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthorizationsController extends Controller
{
    public function store(AuthorizationRequest $request)
    {
        $username = $request->username;

        // filter_var($username, FILTER_VALIDATE_EMAIL) ?
        //     $credentials['email'] = $username :
        //     $credentials['phone'] = $username;

        $credentials['account'] = $request->account;
        $credentials['password'] = $request->password;

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            throw new AuthenticationException('用户名或密码错误');
        }

        $tokenData = [];
        $tokenData['access_token'] = $token;
        $tokenData['token_type'] = 'Bearer';
        $tokenData['expires_in'] = Auth::guard('api')->factory()->getTTL() * 60;

        return new UserResource(Auth::guard('api')->user(), $tokenData);
    }
}
