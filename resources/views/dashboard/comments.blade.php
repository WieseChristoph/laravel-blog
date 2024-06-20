<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Comments | Blog Dashboard</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <x-navigation.main />
        <x-navigation.dashboard />
        
        <main class="p-5">
            <table>
                <thead>
                    <th>ID</th>
                    <th>Post ID</th>
                    <th>User</th>
                    <th>Message</th>
                    <th>Created at</th>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td><a href="{{ route("post.show", $comment->post_id) }}">{{ $comment->post_id }}</a></td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->message }}</td>
                            <td>{{ $comment->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </body>
</html>
