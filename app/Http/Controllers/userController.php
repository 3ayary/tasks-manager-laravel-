<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]
        );

        return response()->json(['message' => 'user registered successfully', 'User' => $user], 201);

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json('invalid email or password', 401);
        }
        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'login successfully',
            'User' => $user,
            'token' => $token,
        ], 201);

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete() ;

        return response()->json([
            'message' => 'logout successfully'
        ], 201);
    }

    public function getAllUsers()
    {
        $users = User::all();

        return response()->json($users, 200);
    }

    public function getOneUser(int $id)
    {
        $user = User::findOrFail($id);

        return response()->json($user, 200);
    }

    public function getProfile(int $id)
    {

        $profile = User::findOrFail($id)->profile;

        return response()->json($profile, 200);
    }

    public function getUserTasks(int $id)
    {

        $tasks = User::findOrFail($id)->tasks;

        return response()->json($tasks, 200);
    }
}
