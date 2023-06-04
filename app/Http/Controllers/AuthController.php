<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Invalid login credentials.'], 401);
    }

    return response()->json(['user' => Auth::user(), 'api_token' => Auth::user()->api_token]);
}

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(60), // Generate a random API token
        ]);

        return response()->json(['user' => $user, 'message' => 'Created successfully', 'api_token' => $user->api_token], 201);
    }


}
