<nav class="py-3 px-5 flex flex-row items-center gap-5 shadow-sm shadow-red-900">
    <ul class="flex flex-row w-full gap-5">
        <li>
            <a href="{{ route('dashboard.users.show') }}" class="flex flex-row gap-2 hover:underline">
                <span class="{{ Route::is("dashboard.users.show") ? 'text-red-900' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </span>
                <span>Users</span>
            </a>
        </li>
        <li>
            <a href="{{ route('dashboard.posts.show') }}" class="flex flex-row gap-2 hover:underline">
                <span class="{{ Route::is("dashboard.posts.show") ? 'text-red-900' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 6h4"/><path d="M2 10h4"/><path d="M2 14h4"/><path d="M2 18h4"/><rect width="16" height="20" x="4" y="2" rx="2"/><path d="M9.5 8h5"/><path d="M9.5 12H16"/><path d="M9.5 16H14"/></svg>
                </span>
                <span>Posts</span>
            </a>
        </li>
        <li>
            <a href="{{ route('dashboard.comments.show') }}" class="flex flex-row gap-2 hover:underline">
                <span class="{{ Route::is("dashboard.comments.show") ? 'text-red-900' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M13 8H7"/><path d="M17 12H7"/></svg>
                </span>
                <span>Comments</span>
            </a>
        </li>
    </ul>
</nav>