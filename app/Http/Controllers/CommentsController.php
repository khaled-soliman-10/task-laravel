<?php

namespace App\Http\Controllers;

use App\Mail\commentAdded;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $data = $request->validate([
            'content' => 'required|string',
        ]);
        $post = Post::find($id);
        $post_owner = User::find($post->user_id);
        $user_id = $request->user()->id;
        $post_id = $post->id;

        $comment = Comment::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'content' => $data['content'],
        ]);

        Mail::to($post_owner->email)->send(new CommentAdded($post, $comment, $post_owner));

        return response()->json([
            'message' => 'comment added successfully and email sent to post owner',
            'comment' => $comment,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Comment::where('id', $id)->delete();
        return response()->json([
            'message' => 'comment deleted successfully',
        ]);
    }
}
