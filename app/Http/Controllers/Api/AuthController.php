<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->apiResponse(
                message: 'The given data was invalid.',
                error: $validator->errors(),
                status: false,
                code: 400
            );
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->apiResponse(
                message: 'Login successful',
                data: [
                    'user' => new UserResource(Auth::user()),
                ],
            );
        } else {
            return response()->apiResponse(
                message: 'Invalid credentials',
                status: false,
                code: 401
            );
        }
    }
}
