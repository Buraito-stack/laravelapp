<?php

namespace App\Http\Controllers\api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    'errors' => $validator->errors(),
                ],
            ], 422);
        }

        $user = User::create([
            'name'     => $request->string('name'),
            'email'    => $request->string('email'),
            'password' => Hash::make($request->string('password')),
        ]);

        return response()->json([
            'data' => [
                'user'  => $user,
                'token' => $user->createToken('API Token')->plainTextToken,
            ],
            'message' => 'Registration successful',
        ], 201);
    }
}
