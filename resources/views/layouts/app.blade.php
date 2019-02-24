<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Homenaje|IBM+Plex+Mono|IBM+Plex+Serif" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header class="py-3">
            <div class="flex justify-center">
                <span class="text-5xl font-sans text-grey py-3">
                    <a href="/" class="no-underline text-grey">Jon Ouellette</a>
                </span>
            </div>
            <div class="menu {{ Route::is('home') ? '' : 'sm:hidden' }}">
                <a class="menu-item {{ Route::is('about') ? 'active' : '' }}" href="/about">
                    About
                </a>
                <a class="menu-item {{ Route::is('projects') ? 'active' : '' }}" href="/projects">
                    Projects
                </a>
                <a class="menu-item {{ Route::is('writing') ? 'active' : '' }}" href="/writing">
                    Writing
                </a>
                <a class="menu-item {{ Route::is('contact') ? 'active' : '' }}" href="/contact">
                    Contact
                </a>
            </div>
        </header>

        <main class="py-3 mb-32 h-full">
            @yield('content')
        </main>

        <footer class="fixed pin-x pin-b h-32 bg-white">
            <div class="flex justify-center text-grey text-5xl py-5">
                <a href="https://github.com/jon3laze" class="text-grey px-2">
                    <i class="fab fa-github"></i>
                </a>
                <a href="https://stackexchange.com/users/172014/jon3laze" class="text-grey px-2">
                    <i class="fab fa-stack-exchange"></i>
                </a>
                <a href="https://www.linkedin.com/in/jonouellette/" class="text-grey px-2">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
            <div class="flex justify-center text-grey font-sans text-lg self-end">
                    &copy;
            </div>
        </footer>
    </div>
</body>
</html>
