<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $post->title }} | Blog</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <x-navigation.main />

        <main class="flex flex-col gap-3 p-5">
            <div class="flex flex-row items-center">
                <div class="flex flex-col gap-2">
                    <h1 class="text-5xl">{{ $post->title }}</h1>
                    <h2 class="flex flex-row gap-1">
                        @if (file_exists(public_path($post->user->getAvatarPath())))
                            <img src="{{ asset($post->user->getAvatarPath()) }}" alt="{{ $post->user->name }}" width="24" height="24" style="border-radius: 50px">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 11px"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        @endif
                        <span>{{ $post->user->name }} ●︎ {{ $post->created_at }}</span>
                    </h2>
                </div>
                @auth
                    @if (Auth::user() == $post->user)
                        <form method="POST" action="{{ route("post.delete", $post->id) }}" class="ml-auto mr-5">
                            <button type="submit" class="hover:cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                            </button>
                            @csrf
                        </form>
                    @endif
                @endauth
            </div>

            <hr class="border-red-900">
            
            <pre class="text-wrap">{{ $post->content }}</pre>

            <hr class="border-red-900">

            <div>
                <h3 class="text-xl">Comments</h3>
                @auth
                    <form method="POST" action="{{ route("post.comment", $post->id) }}" class="flex flex-row gap-2">
                        @error('message')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                        <textarea name="message" id="message" cols="30" rows="2" class="text-black"></textarea>
                        <input type="submit" value="Submit" class="px-3 py-2 h-full border border-red-900 text-lg hover:text-red-900 hover:cursor-pointer">
                        @csrf
                    </form>
                    @error('error')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                @endauth

                <div class="flex flex-col gap-5 mt-5">
                    @if (!$comments->isEmpty())
                         @foreach ($comments as $comment)
                            <div class="p-5 w-full border-red-900 border rounded-md bg-gradient-to-r from-zinc-900 to-red-900">
                                <div class="flex flex-row items-center gap-1 text-sm">
                                    @if (file_exists(public_path($comment->user->getAvatarPath())))
                                        <img src="{{ asset($comment->user->getAvatarPath()) }}" alt="{{ $comment->user->name }}" width="24" height="24" style="border-radius: 50px">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 11px"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    @endif
                                    <span>{{ $comment->user->name }} ●︎ {{ $comment->created_at }}</span>
                                    @auth
                                        @if (Auth::user() == $comment->user)
                                            <form method="POST" action="{{ route("post.comment.delete", ["postId" => $post->id, "commentId" => $comment->id]) }}" class="ml-auto">
                                                <button type="submit" class="hover:cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                </button>
                                                @csrf
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                                <pre class="text-wrap mt-2">{{ $comment->message }}</pre>
                            </div>
                        @endforeach
                    @else
                        <span>No comments</span>
                    @endif
                </div>
            </div>
        </main>
    </body>
</html>
