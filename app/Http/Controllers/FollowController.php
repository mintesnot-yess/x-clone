<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function toggleFollow($id)
    {
        $user = Auth::user();
        $target = User::findOrFail($id);

        if ($user->id === $target->id) {
            return response()->json(['message' => "You can't follow yourself"], 400);
        }

        if ($user->followings()->where('following_id', $id)->exists()) {
            $user->followings()->detach($id);
            return response()->json(['message' => 'Unfollowed']);
        } else {
            $user->followings()->attach($id);
            return response()->json(['message' => 'Followed']);
        }
    }

    public function followers($id)
    {
        $user = User::with('followers')->findOrFail($id);
        return response()->json($user->followers);
    }

    public function followings($id)
    {
        $user = User::with('followings')->findOrFail($id);
        return response()->json($user->followings);
    }
}
