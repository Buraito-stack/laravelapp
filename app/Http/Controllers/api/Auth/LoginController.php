<?php

namespace App\Http\Controllers\api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    'errors' => $validator->errors(),
                ],
            ], 422);
        }

        $user = User::where('email', $request->string('email'))->first();

        if (!$user || !Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'data' => [
                    'errors' => 'Invalid email or password',
                ],
            ], 401);
        }

        return response()->json([
            'data' => [
                'user'  => $user,
                'token' => $user->createToken('API Token')->plainTextToken,
            ],
            'message' => 'Login successful',
        ], 200);
    }
}
