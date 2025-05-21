<?php

// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;
    public function Index()
    {
        return Post::with('user')->latest()->get(); // or paginate if needed
    }

    public function Store(Request $request)
    {


        $postData = $request->only(['content', 'user_id']);
        $postData['user_id'];
        if ($request->hasFile('image')) {
            $postData['image'] = $request->file('image')->store('posts', 'public');
        }
        $post = Post::create($postData);

        return response()->json($postData, 201);


    }




    public function show(Post $post)
    {
        return $post->load('user');
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'string|max:255',
            'content' => 'string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $postData = $request->only(['title', 'content']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $postData['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($postData);

        return $post->load('user');
    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Ensure only the post owner can delete
        if ($post->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Delete image if exists
        if ($post->image) {
            \Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }



    public function userPosts()
    {
        return Post::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
    }

}