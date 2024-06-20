<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts | Blog Dashboard</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <x-navigation.main />
        <x-navigation.dashboard />
        
        <main class="p-5">
            <a href="{{ route("dashboard.posts.new.show") }}" class="px-3 py-1 border border-red-900 text-lg hover:text-red-900 hover:cursor-pointer">New Post</a>

            <table class="mt-5">
                <thead>
                    <th>ID</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Created at</th>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td><a href="{{ route("post.show", $post->id) }}">{{ $post->id }}</a></td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </body>
</html>
