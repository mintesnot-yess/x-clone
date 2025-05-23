<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\Post;


Route::get('/user', function (Request $request) {
    return response()->json([
        'user' => $request->user()
    ]);
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'Login']);
Route::post('/register', [AuthController::class, 'Register']);





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = $request->user();
    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'description' => $user->description ?? null,
        'profile_image' => $user->profile_image,
        'created_at' => $user->created_at

    ]);
});




Route::get('/posts', function () {
    $posts = Post::all();
    return response()->json([
        'success' => true,
        'posts' => $posts
    ]);
});

Route::post('/posts', [PostController::class, 'Store']);
Route::get('/posts', [PostController::class, 'Index']);
Route::middleware('auth:sanctum')->get('/user-posts', [PostController::class, 'userPosts']);
Route::middleware('auth:sanctum')->delete('/posts/{id}', [PostController::class, 'destroy']);
Route::middleware('auth:sanctum')->put('/user/update', [AuthController::class, 'update']);

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logged out']);
});


Route::get('/users/{email}', function ($email) {
    $user = User::where('email', $email)->withCount('posts')->with('posts')->first();
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    return response()->json($user);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/follow/{id}', [FollowController::class, 'toggleFollow']);
    Route::get('/user/{id}/followers', [FollowController::class, 'followers']);
    Route::get('/user/{id}/followings', [FollowController::class, 'followings']);
});
