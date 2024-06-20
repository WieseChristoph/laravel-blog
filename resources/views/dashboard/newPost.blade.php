<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>New Post | Blog Dashboard</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <x-navigation.main />
        <x-navigation.dashboard />
        
        <main class="p-5">
            <form method="POST" action="{{ route("dashboard.posts.new") }}">
                <div>
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" required maxlength="512" class="text-black">
                </div>
                <div>
                    <label for="content">Content</label>
                    <br>
                    <textarea name="content" id="content" cols="30" rows="10" class="text-black"></textarea>
                </div>
                <input type="submit" value="Submit" class="px-3 py-1 border border-red-900 text-lg hover:cursor-pointer">

                @csrf
            </form>
        </main>
    </body>
</html>
