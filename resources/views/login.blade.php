<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login | Blog</title>
        @vite('resources/css/app.css')
    </head>
    <body class="h-screen">
        <x-navigation.main />

        <main class="flex justify-center items-center w-full p-5">
            <form method="POST" action="{{ route("login") }}" class="flex flex-col gap-3">
                <div class="flex flex-col">
                    <label for="email">E-Mail</label>
                    <input type="email" name="email" id="email" placeholder="E-Mail" class="text-black" value="{{ old("email") }}" required />
                    @error("email")
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="text-black" required />
                    @error("password")
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <input type="submit" value="Submit" class="py-1 w-full border border-red-900 text-lg hover:text-red-900 hover:cursor-pointer" />
                </div>
                
                @csrf

                @error('error')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </form>
        </main>
    </body>
</html>
