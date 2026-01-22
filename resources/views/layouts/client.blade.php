<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Espace Client - {{ config('app.name', 'Code Craft') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased h-full">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex flex-col md:flex-row overflow-hidden bg-slate-50">

        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64">
                <div class="flex flex-col h-0 flex-1 bg-white border-r border-slate-200">
                    <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                        <div class="flex items-center flex-shrink-0 px-6 mb-8">
                            <a href="/">
                                <span
                                    class="text-2xl font-bold italic bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent">Code
                                    Craft</span>
                            </a>
                        </div>
                        <nav class="flex-1 px-4 space-y-1">
                            <a href="{{ route('client.dashboard') }}"
                                class="{{ request()->routeIs('client.dashboard') ? 'bg-primary-50 text-primary-600 border-primary-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-transparent' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl border-l-4 transition-all">
                                Dashboard
                            </a>
                            <a href="{{ route('client.projects.index') }}"
                                class="{{ request()->routeIs('client.projects.*') ? 'bg-primary-50 text-primary-600 border-primary-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-transparent' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl border-l-4 transition-all">
                                Mes Projets
                            </a>
                            <a href="{{ route('client.support.index') }}"
                                class="{{ request()->routeIs('client.support.*') ? 'bg-primary-50 text-primary-600 border-primary-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-transparent' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl border-l-4 transition-all">
                                Support
                            </a>
                        </nav>
                    </div>
                    <div class="flex-shrink-0 flex p-6 border-t border-slate-100">
                        <div class="flex items-center w-full">
                            <div
                                class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-bold text-slate-900">{{ Auth::user()->name }}</p>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="text-xs font-semibold text-slate-500 hover:text-red-500">Déconnexion</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <header
                class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-6 shrink-0 lg:px-8">
                <button @click="sidebarOpen = true" class="md:hidden text-slate-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="text-lg font-bold text-slate-900">@yield('title', 'Espace Client')</div>
                <div><!-- Notifications placeholder --></div>
            </header>

            <main class="flex-1 relative overflow-y-auto focus:outline-none py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @if (session('success'))
                        <div class="bg-indigo-50 border-l-4 border-indigo-500 text-indigo-700 p-4 mb-8 rounded-r-xl shadow-sm"
                            role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>

</html>