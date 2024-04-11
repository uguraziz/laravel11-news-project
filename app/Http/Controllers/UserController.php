<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create_user(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'data' => $user
        ]);

    }

    public function get_user(Request $request)
    {
        $user = Auth::user();
        if(!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'User information successfully fetched',
            'data' => $user
        ]);
    }

    public function login(UserLoginRequest $request)
    {
        $user = Auth::attempt($request->only('email', 'password'));
        if(!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid login details'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'User logged in successfully',
            'data' =>  Auth::user()
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => true,
            'message' => 'User logged out successfully'
        ]);
    }

    public function get_user_from_id(int $user_id){

        $user = User::find($user_id);
        if(!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'User information successfully fetched',
            'data' => $user
        ]);
    }
}
