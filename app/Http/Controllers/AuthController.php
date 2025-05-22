<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "email" => "required|email|max:255",
                "password" => "required|string",
            ]);

            if (!Auth::attempt($validatedData)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials',
                    'errors' => [
                        'email' => ['These credentials do not match our records.']
                    ]
                ], 401);
            }

            $user = Auth::user();
            $token = $user->createToken("authToken")->plainTextToken;

            return response()->json([
                'success' => true,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'profile_image' => $user->profile_image,
                ],
                'token' => $token
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function Register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "name" => "required|string|max:255",
                "email" => "required|email|max:255|unique:users",
                "password" => "required|string|min:6|confirmed",
            ]);

            $user = User::create([
                "name" => $validatedData["name"],
                "email" => $validatedData["email"],
                "password" => Hash::make($validatedData["password"]),
                "profile_image" => "default-profile.jpg",
            ]);

            Auth::login($user);
            $token = $user->createToken("authToken")->plainTextToken;

            return response()->json([
                'success' => true,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'profile_image' => $user->profile_image,
                ],
                'token' => $token
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }


    public function update(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profiles', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return response()->json(['message' => 'Profile updated successfully', 'user' => $user]);
    }
}
