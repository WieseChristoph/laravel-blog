<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showUsersDashboard()
    {
        $users = User::all();

        return view("dashboard.users", ["users" => $users]);
    }

    public function showPostsDashboard()
    {
        $posts = Post::all();

        return view("dashboard.posts", ["posts" => $posts]);
    }

    public function showCreatePost()
    {
        return view("dashboard.newPost");
    }

    public function createPost(Request $request)
    {
        $input = $request->validate([
            "title" => ["required", "max:512"],
            "content" => ["required"]
        ]);

        $post = new Post();
        $post->title = $input["title"];
        $post->content = $input["content"];
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route("dashboard.posts.show");
    }

    public function showCommentsDashboard()
    {
        $comments = Comment::all();

        return view("dashboard.comments", ["comments" => $comments]);
    }
}
