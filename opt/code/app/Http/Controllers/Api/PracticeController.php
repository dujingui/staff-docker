<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PracticeController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::guard('api')->user();

        $practice = $user->practice;

        $attributes = $request->all();

        $practice->update($attributes);

        return response()->json([
            'state' => 1,
            'user_id' => $user->user_id,
        ]);
    }
}
