<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all posts
        $posts = Post::with('user')->get();
        return response()->json([
            'posts' =>$posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $request->user()->id;
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $user_id = $request->user()->id;

        $post = Post::create([
            'user_id' => $user_id,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $user_id)
    {
        // get posts for one user
        $user = User::find($user_id);
        $posts = Post::with('user')->where('user_id', $user->id)->get();
        return response()->json([
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
//        $post = Post::find($id);
        $data = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);
        $post = Post::where('id', $id)->update($data);

        return response()->json([
            'message' => 'Post updated successfully',
            'post' => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $post = Post::find($id);
        if ($post->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $post->delete();
        return response()->json([
            'message' => 'Post deleted successfully',
        ],200);
    }
}
