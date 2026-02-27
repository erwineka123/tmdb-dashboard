<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard TMDb</title>


    {{-- Tabler CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/tabler.min.css" rel="stylesheet" />


    {{-- Tabler JS (WAJIB untuk hamburger) --}}
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core/dist/js/tabler.min.js"></script>


    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/css/dashboard.css', 'resources/js/app.js', 'resources/js/dashboard.js'])


    {{-- ApexCharts --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{-- Additional Styles --}}
    @stack('styles')


</head>

<body>

    <div class="page">
        {{-- SIDEBAR NAVBAR --}}
        <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">

            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                    aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <h1 class="navbar-brand navbar-brand-autodark">
                    TMDB DASHBOARD
                </h1>

                <div class="collapse navbar-collapse" id="sidebar-menu">
                    <ul class="navbar-nav pt-lg-3">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                    </svg>
                                </span>

                                <span class="nav-link-title">
                                    Dashboard
                                </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('movies*') ? 'active' : '' }}" href="/movies">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                        <path d="M8 4l0 16" />
                                        <path d="M16 4l0 16" />
                                        <path d="M4 8l4 0" />
                                        <path d="M4 16l4 0" />
                                        <path d="M4 12l16 0" />
                                        <path d="M16 8l4 0" />
                                        <path d="M16 16l4 0" />
                                    </svg>
                                </span>

                                <span class="nav-link-title">
                                    Movies
                                </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            {{-- <a class="nav-link {{ request()->is('sync-history*') ? 'active' : '' }}"
                           href="/sync-history">

                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                                </svg>
                            </span>

                            <span class="nav-link-title">
                                Sync History
                            </span>

                        </a> --}}

                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <div class="page-wrapper">
            <div class="container-xl pt-4">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Stack Scripts --}}
    @stack('scripts')

</body>
</html>