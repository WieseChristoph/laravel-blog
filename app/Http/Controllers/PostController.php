<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showPost(int $postId)
    {
        $post = Post::where("id", $postId)->first();
        if (empty($post))
            return response(status: 404);

        $comments = Comment::where("post_id", $postId)->get();

        return view("post", ["post" => $post, "comments" => $comments]);
    }

    public function deletePost(int $postId)
    {
        if (empty($postId))
            return back()->withErrors([
                "error" => "A post id is required.",
            ])->withInput();
        
        try {
            $post = Post::where([
                ["id", "=", $postId], 
                ["user_id", "=", Auth::user()->id]
            ])->first();

            $post->comments()->delete();
            $post->delete();
        } catch (\Exception $e) {
            return back()->withErrors([
                "error" => $e->getMessage(),
            ]);
        }
       
        return redirect()->route("home.show");
    }

    public function commentPost(Request $request, int $postId)
    {
        if (empty($postId))
            return back()->withErrors([
                "error" => "A post id is required.",
            ])->withInput();

        $input = $request->validate([
            "message" => ["required", "max:1024"],
        ]);

        $comment = new Comment();
        $comment->message = $input["message"];
        $comment->post_id = $postId;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return back();
    }

    public function deleteComment(int $postId, int $commentId): RedirectResponse
    {
        if (empty($postId) || empty($commentId))
            return back()->withErrors([
                "error" => "A post and comment id is required.",
            ])->withInput();
        
        try {
            Comment::where([
                ["id", "=", $commentId], 
                ["post_id", "=", $postId], 
                ["user_id", "=", Auth::user()->id]
            ])->delete();
        } catch (\Exception $e) {
            return back()->withErrors([
                "error" => $e->getMessage(),
            ]);
        }
       
        return back();
    }
}
