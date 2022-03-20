<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request, Report $report)
    {
        $user = Auth::guard('api')->user();

        $report->fill($request->all());
        $report->user_id = $user->user_id;
        $report->save();

        return response()->json([
            'state' => 1,
            'user_id' => $user->user_id,
            'id' => $report->id,
        ]);
    }
}
