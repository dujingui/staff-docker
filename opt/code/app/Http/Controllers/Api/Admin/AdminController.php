<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $token = [];
        $token['admin'] = ['token' => 'admin-token'];
        $token['editor'] = ['token' => 'editor-token'];

        $token = $token[$request->username];

        return response()->json([
            'code' => 20000,
            'data' => $token,
        ]);;
    }

    public function getLoginInfo(Request $request)
    {
        $tokens = [
            'admin-token'=> [
                'roles' => ['admin'],
                'introduction' => 'I am a super administrator',
                'avatar' => 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif',
                'name' => 'Super Admin'
            ],
            'editor-token'=> [
                'roles' => ['editor'],
                'introduction' => 'I am an editor',
                'avatar' => 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif',
                'name' => 'Normal Editor'
            ]
        ];

        $token = $tokens[$request->token];

        return response()->json([
            'code' => 20000,
            'data' => $token,
        ]);;
    }
}
