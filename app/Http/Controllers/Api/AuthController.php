<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function Illuminate\Session\userId;
use function Symfony\Component\HttpFoundation\Session\Storage\Proxy\validateId;

class AuthController extends Controller
{
    public function register(Request $request)
    {
       $validate = $request->validate([
           'name' => 'required|min:3',
           'email' => 'required|email',
           'password' => 'required|min:6',
       ]);

       $validate['password'] = bcrypt($validate['password']);

       $user = User::create($validate);

       $token = $user->createToken('app_token')->accessToken;

       return response()->json(['status' => 'success', 'message' => 'User Registered Successfully','token' => $token, 'data' => $user]);
    }

    public function login(Request $request)
    {
       $validate = $request->validate([
           'email' => 'required|email',
           'password' => 'required|min:6',
       ]);

       $user = Auth::attempt(['email' => $request->email, 'password' => $request->password]);


       $userInfo = Auth::user();

        Auth::login($userInfo);

        $token = $userInfo->createToken('app_token')->accessToken;

       return response()->json(['status' => 'success', 'message' => 'User Login Successfully','token' => $token, 'data' => $user]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);

        return response()->json(['status' => 'success', 'message' => 'Logout Successfully']);
    }
}
