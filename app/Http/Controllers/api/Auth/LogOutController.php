<?php

namespace App\Http\Controllers\api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogOutController extends Controller
{
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout successful',
        ], 200);
    }
}
