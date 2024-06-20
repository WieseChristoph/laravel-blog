<nav class="py-3 px-5 flex flex-row items-center gap-5 shadow-sm shadow-red-900">
    <span class="font-bold text-3xl">Blog</span>
    <ul class="flex flex-row w-full gap-5">
        <li>
            <a href="/" class="flex flex-row gap-2 hover:underline">
                <span class="{{ Route::is("home.show") ? 'text-red-900' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </span>
                <span>Home</span>
            </a>
        </li>
        @auth
            @if (Auth::user()->hasMinRole(App\Enums\Role::ADMIN))
                <li>
                    <a href="{{ route('dashboard.users.show') }}" class="flex flex-row gap-2 hover:underline">
                        <span class="{{ Request::is('dashboard/*') ? 'text-red-900' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                        </span>
                        <span>Dashboard</span>
                    </a>
                </li>
            @endif
        @endauth
    </ul>
    <div class="flex flex-row items-center gap-5">
        @if (Route::has('login.show'))
            @auth
                <a href="{{ route('logout') }}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                </a>
                @if (file_exists(public_path(Auth::user()->getAvatarPath())))
                    <img src="{{ asset(Auth::user()->getAvatarPath()) }}" alt="{{ Auth::user()->name }}" width="32" height="32" style="border-radius: 50px">
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 11px"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                @endif
            @else
                <a href="{{ route('login.show') }}" role="button" class="border border-red-900 px-3 py-1 text-nowrap text-lg hover:text-red-900">Log in</a>
                @if (Route::has('register.show'))
                    <a href="{{ route('register.show') }}" role="button" class="border border-red-900 px-3 py-1 text-nowrap text-lg hover:text-red-900">Register</a>
                @endif
            @endauth
        @endif
    </div>
</nav>