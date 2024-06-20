<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get("/", "showHome")->name("home.show");
});

Route::controller(PostController::class)->group(function () {
    Route::get("/post/{postId}", "showPost")->name("post.show");
    Route::post("/post/{postId}/delete", "deletePost")->name("post.delete");
    Route::post("/post/{postId}/comment", "commentPost")->middleware(["auth"])->name("post.comment");
    Route::post("/post/{postId}/comment/{commentId}/delete", "deleteComment")->middleware(["auth"])->name("post.comment.delete");
});

Route::controller(DashboardController::class)->middleware(["auth", "authorize:admin"])->prefix("dashboard")->group(function () {
    Route::get("/users", "showUsersDashboard")->name("dashboard.users.show");
    Route::get("/posts", "showPostsDashboard")->name("dashboard.posts.show");
    Route::get("/posts/new", "showCreatePost")->name("dashboard.posts.new.show");
    Route::post("/posts/new", "createPost")->name("dashboard.posts.new");
    Route::get("/comments", "showCommentsDashboard")->name("dashboard.comments.show");
});

Route::controller(UserController::class)->group(function () {
    Route::get("/login", "showLogin")->name("login.show");
    Route::post("/login", "login")->name("login");
    Route::get("/register", "showRegister")->name("register.show");
    Route::post("/register", "register")->name("register");
    Route::middleware(["auth"])->get("/logout", "logout")->name("logout");
});
