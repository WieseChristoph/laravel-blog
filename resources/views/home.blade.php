<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home | Blog</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <x-navigation.main />

        <main class="flex flex-wrap p-5 gap-5">
            @foreach ($posts as $post)
                <a  href="{{ route("post.show", [$post->id]) }}" class="p-5 2xl:w-[24%] lg:w-[49%] w-full border-red-900 border rounded-md bg-gradient-to-r from-zinc-900 to-red-900">
                    <h1 class="font-bold text-xl">{{ $post->title }}</h1>
                    <div class="flex flex-row items-center gap-1 text-sm">
                        @if (file_exists(public_path($post->user->getAvatarPath())))
                            <img src="{{ asset($post->user->getAvatarPath()) }}" alt="{{ $post->user->name }}" width="24" height="24" style="border-radius: 50px">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 11px"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        @endif
                        <span>{{ $post->user->name }} ●︎ {{ $post->created_at }}</span>
                    </div>
                </a>
            @endforeach
        </main>
    </body>
</html>
