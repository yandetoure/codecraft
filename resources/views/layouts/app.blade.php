<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Code Craft') }} - Professional SaaS Solutions</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#faf5ff',
                            100: '#f3e8ff',
                            200: '#e9d5ff',
                            300: '#d8b4fe',
                            400: '#c084fc',
                            500: '#a855f7',
                            600: '#9333ea',
                            700: '#7e22ce',
                            800: '#6b21a8',
                            900: '#581c87',
                            950: '#3b0764',
                        },
                        accent: {
                            cyan: '#06b6d4',
                            pink: '#ec4899',
                            orange: '#f97316',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif'],
                    },
                    animation: {
                        'gradient': 'gradient 8s linear infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'fade-in': 'fadeIn 0.6s ease-out',
                    },
                    keyframes: {
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        }
                    },
                    backgroundSize: {
                        '300%': '300%',
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(147, 51, 234, 0.1);
        }
        
        .glass-nav.scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 40px 0 rgba(147, 51, 234, 0.15);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #9333ea 0%, #ec4899 50%, #06b6d4 100%);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient 8s ease infinite;
        }
        
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
        }
        
        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
</head>
<body class="font-sans antialiased h-full bg-gradient-to-br from-slate-50 via-purple-50/30 to-pink-50/20">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav x-data="{ 
            open: false, 
            scrolled: false,
            init() {
                window.addEventListener('scroll', () => {
                    this.scrolled = window.scrollY > 20;
                });
            }
        }" 
        :class="scrolled ? 'glass-nav scrolled' : 'glass-nav'" 
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <div class="shrink-0 flex items-center">
                            <a href="/" class="flex items-center space-x-3 group">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-gradient-to-r from-primary-600 to-pink-500 rounded-xl blur-lg opacity-50 group-hover:opacity-75 transition"></div>
                                    <div class="relative bg-gradient-to-br from-primary-600 to-pink-500 p-2 rounded-xl">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-2xl font-display font-bold gradient-text">Code Craft</span>
                            </a>
                        </div>
                        <div class="hidden md:flex md:ml-10 md:space-x-1">
                            <a href="/#services" class="relative px-4 py-2 text-sm font-semibold text-slate-700 hover:text-primary-600 transition-colors group">
                                <span>Services</span>
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary-600 to-pink-500 group-hover:w-full transition-all duration-300"></span>
                            </a>
                            <a href="{{ route('features.index') }}" class="relative px-4 py-2 text-sm font-semibold text-slate-700 hover:text-primary-600 transition-colors group">
                                <span>Fonctionnalités</span>
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary-600 to-pink-500 group-hover:w-full transition-all duration-300"></span>
                            </a>
                            <a href="{{ route('packs.index') }}" class="relative px-4 py-2 text-sm font-semibold text-slate-700 hover:text-primary-600 transition-colors group">
                                <span>Packs</span>
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary-600 to-pink-500 group-hover:w-full transition-all duration-300"></span>
                            </a>
                        </div>
                    </div>

                    <div class="hidden md:flex md:items-center md:space-x-4">
                        @auth
                            @role('admin|super_admin')
                                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-semibold text-slate-700 hover:text-primary-600 transition-colors">
                                    Admin
                                </a>
                            @else
                                <a href="{{ route('client.dashboard') }}" class="px-4 py-2 text-sm font-semibold text-slate-700 hover:text-primary-600 transition-colors">
                                    Dashboard
                                </a>
                            @endrole
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="px-4 py-2 text-sm font-semibold text-red-600 hover:text-red-700 transition-colors">
                                    Déconnexion
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-slate-700 hover:text-primary-600 transition-colors">
                                Connexion
                            </a>
                            <a href="{{ route('register') }}" class="relative group px-6 py-3 font-bold text-white overflow-hidden rounded-xl">
                                <div class="absolute inset-0 bg-gradient-to-r from-primary-600 via-pink-500 to-cyan-500 bg-size-300% animate-gradient"></div>
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity shimmer"></div>
                                <span class="relative z-10 text-sm">Démarrer un projet</span>
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex items-center md:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-600 hover:text-primary-600 hover:bg-primary-50 transition-all">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 class="md:hidden bg-white/95 backdrop-blur-xl border-t border-slate-200"
                 x-cloak>
                <div class="px-4 pt-2 pb-3 space-y-1">
                    <a href="/#services" class="block px-4 py-3 text-base font-semibold text-slate-700 hover:text-primary-600 hover:bg-primary-50 rounded-xl transition">Services</a>
                    <a href="{{ route('features.index') }}" class="block px-4 py-3 text-base font-semibold text-slate-700 hover:text-primary-600 hover:bg-primary-50 rounded-xl transition">Fonctionnalités</a>
                    <a href="{{ route('packs.index') }}" class="block px-4 py-3 text-base font-semibold text-slate-700 hover:text-primary-600 hover:bg-primary-50 rounded-xl transition">Packs</a>
                    @guest
                        <a href="{{ route('login') }}" class="block px-4 py-3 text-base font-semibold text-slate-700 hover:text-primary-600 hover:bg-primary-50 rounded-xl transition">Connexion</a>
                        <a href="{{ route('register') }}" class="block px-4 py-3 text-base font-bold text-white bg-gradient-to-r from-primary-600 to-pink-500 rounded-xl text-center">Démarrer un projet</a>
                    @endguest
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="pt-20">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="relative bg-slate-950 text-white py-16 mt-32 overflow-hidden">
            <!-- Animated background -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-500 rounded-full blur-3xl animate-pulse-slow"></div>
                <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-pink-500 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s;"></div>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <div class="col-span-1 md:col-span-2">
                        <span class="text-3xl font-display font-bold gradient-text">Code Craft</span>
                        <p class="mt-6 text-slate-400 max-w-md leading-relaxed">Solutions digitales sur-mesure pour propulser votre business. Du site web à l'application métier complexe.</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-6 text-white">Liens</h4>
                        <ul class="space-y-3 text-slate-400">
                            <li><a href="/" class="hover:text-primary-400 transition inline-flex items-center group">
                                <span class="w-0 group-hover:w-2 h-0.5 bg-primary-400 mr-0 group-hover:mr-2 transition-all"></span>
                                Accueil
                            </a></li>
                            <li><a href="{{ route('packs.index') }}" class="hover:text-primary-400 transition inline-flex items-center group">
                                <span class="w-0 group-hover:w-2 h-0.5 bg-primary-400 mr-0 group-hover:mr-2 transition-all"></span>
                                Nos Packs
                            </a></li>
                            <li><a href="/#services" class="hover:text-primary-400 transition inline-flex items-center group">
                                <span class="w-0 group-hover:w-2 h-0.5 bg-primary-400 mr-0 group-hover:mr-2 transition-all"></span>
                                Services
                            </a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-6 text-white">Légal</h4>
                        <ul class="space-y-3 text-slate-400">
                            <li><a href="#" class="hover:text-primary-400 transition inline-flex items-center group">
                                <span class="w-0 group-hover:w-2 h-0.5 bg-primary-400 mr-0 group-hover:mr-2 transition-all"></span>
                                CGV
                            </a></li>
                            <li><a href="#" class="hover:text-primary-400 transition inline-flex items-center group">
                                <span class="w-0 group-hover:w-2 h-0.5 bg-primary-400 mr-0 group-hover:mr-2 transition-all"></span>
                                Confidentialité
                            </a></li>
                            <li><a href="#" class="hover:text-primary-400 transition inline-flex items-center group">
                                <span class="w-0 group-hover:w-2 h-0.5 bg-primary-400 mr-0 group-hover:mr-2 transition-all"></span>
                                Mentions légales
                            </a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-16 pt-8 border-t border-slate-800 text-center">
                    <p class="text-slate-500 text-sm">&copy; {{ date('Y') }} Code Craft. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
