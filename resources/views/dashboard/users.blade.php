<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Users | Blog Dashboard</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <x-navigation.main />
        <x-navigation.dashboard />

        <main class="p-5">
            <table>
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Role</th>
                    <th>Created at</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name() }}</td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </body>
</html>
