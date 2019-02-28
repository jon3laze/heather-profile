<header class="py-3 bg-grey-lightest">
    <div class="flex justify-center">
        <span class="py-3">
            <a href="/" class="text-5xl font-sans no-underline text-grey">
                @yield('page-name', 'Jon Ouellette')
            </a>
        </span>
    </div>
    <user-notification></user-notification>
    <ul class="menu pin-r w-48" role="navigation">
        <li class="menu-item bg-blue ml-20 {{ Route::is('about') ? 'active' : '' }}">
            <a href="{{ route('about') }}" class="menu-item-link">
                {{ __('About') }}
            </a>
        </li>
        <li class="menu-item bg-blue ml-20 {{ Route::is('projects') ? 'active' : '' }}">
            <a href="{{ route('projects') }}" class="menu-item-link">
                {{ __('Projects') }}
            </a>
        </li>
        <li class="menu-item bg-blue ml-20 {{ Route::is('posts') ? 'active' : '' }}">
            <a href="{{ route('posts') }}" class="menu-item-link">
                {{ __('Posts') }}
            </a>
        </li>
        @can('create', App\Post::class)
            <li class="menu-item bg-green ml-20">
                <a href="{{ route('create-post') }}" class="menu-item-link">
                    {{ __('New Post') }}
                </a>
            </li>
        @endcan
        @auth
            <li class="menu-item bg-purple ml-20 {{ Route::is('profile') ? 'active' : '' }}">
                <a class="menu-item-link" href="{{ route('profile', Auth::user()) }}">
                    {{ __('Profile') }}
                </a>
            </li>
        @endauth
        <li class="menu-item bg-blue ml-20 {{ Route::is('contact') ? 'active' : '' }}">
            <a href="{{ route('contact') }}" class="menu-item-link">
                {{ __('Contact') }}
            </a>
        </li>
        @guest
            <li class="menu-item bg-blue ml-20 {{ Route::is('login') ? 'active' : '' }}">
                <a class="menu-item-link" href="/login">
                    {{ __('Login') }}
                </a>
            </li>
        @else
            <li class="menu-item bg-red ml-20">
                <a class="menu-item-link"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @endguest
    </ul>
</header>
