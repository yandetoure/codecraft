@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-slate-950 pt-16 pb-32 lg:pt-32 lg:pb-48">
        <div class="absolute inset-0 z-0 opacity-40">
            <img src="/brain/8f5b7891-7684-4d29-b436-84607e708de6/codecraft_hero_abstract_1769078863127.png"
                alt="Code Craft Hero" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-slate-950/80 to-slate-950 z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 text-center">
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black text-white tracking-tight mb-8">
                Façonnez votre <span
                    class="bg-gradient-to-r from-primary-400 to-indigo-400 bg-clip-text text-transparent">succès
                    digital</span> avec Code Craft
            </h1>
            <p class="max-w-2xl mx-auto text-xl text-slate-400 mb-12">
                Nous transformons vos idées complexes en plateformes digitales élégantes, robustes et performantes. De
                l'application métier au SaaS sur-mesure.
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ route('packs.index') }}"
                    class="w-full sm:w-auto px-8 py-4 bg-primary-600 text-white rounded-2xl font-bold text-lg hover:bg-primary-700 transition shadow-2xl shadow-primary-500/20">Explorer
                    nos solutions</a>
                <a href="#services"
                    class="w-full sm:w-auto px-8 py-4 bg-white/10 text-white rounded-2xl font-bold text-lg hover:bg-white/20 transition glass">En
                    savoir plus</a>
            </div>

            <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-8 text-center opacity-60">
                <div>
                    <span class="block text-3xl font-bold text-white mb-1">99%</span>
                    <span class="text-slate-500 text-sm uppercase font-bold tracking-widest">Client Satisfaction</span>
                </div>
                <div>
                    <span class="block text-3xl font-bold text-white mb-1">24/7</span>
                    <span class="text-slate-500 text-sm uppercase font-bold tracking-widest">Premium Support</span>
                </div>
                <div>
                    <span class="block text-3xl font-bold text-white mb-1">10X</span>
                    <span class="text-slate-500 text-sm uppercase font-bold tracking-widest">Perf Boost</span>
                </div>
                <div>
                    <span class="block text-3xl font-bold text-white mb-1">Wave</span>
                    <span class="text-slate-500 text-sm uppercase font-bold tracking-widest">Payment Ready</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Grid -->
    <div id="services" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-xs font-black text-primary-600 uppercase tracking-[0.3em] mb-4">Nos Services Expert</h2>
                <h3 class="text-4xl font-black text-slate-900 leading-tight">Solutions digitales de bout en bout</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service Card 1 -->
                <div
                    class="group p-8 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-2xl hover:shadow-slate-200 transition-all duration-300 border border-transparent hover:border-slate-100">
                    <div
                        class="h-16 w-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-4">Sites Web & E-commerce</h4>
                    <p class="text-slate-600 leading-relaxed mb-6">Des interfaces ultra-rapides, optimisées SEO et conçues
                        pour maximiser vos conversions mobiles.</p>
                    <div class="flex items-center space-x-2 text-primary-600 font-bold text-sm">
                        <span>Voir plus</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>
                </div>

                <!-- Service Card 2 -->
                <div
                    class="group p-8 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-2xl hover:shadow-slate-200 transition-all duration-300 border border-transparent hover:border-slate-100">
                    <div
                        class="h-16 w-16 bg-violet-100 text-violet-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-4">SaaS & Applications Métiers</h4>
                    <p class="text-slate-600 leading-relaxed mb-6">Plateformes complexes sur-mesure pour automatiser vos
                        opérations et piloter votre croissance.</p>
                    <div class="flex items-center space-x-2 text-primary-600 font-bold text-sm">
                        <span>Voir plus</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>
                </div>

                <!-- Service Card 3 -->
                <div
                    class="group p-8 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-2xl hover:shadow-slate-200 transition-all duration-300 border border-transparent hover:border-slate-100">
                    <div
                        class="h-16 w-16 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-4">Applications Mobiles Native</h4>
                    <p class="text-slate-600 leading-relaxed mb-6">Des expériences fluides sur iOS et Android pour rester
                        connecté à vos clients partout.</p>
                    <div class="flex items-center space-x-2 text-primary-600 font-bold text-sm">
                        <span>Voir plus</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="py-24 bg-primary-600 relative overflow-hidden">
        <!-- Abstract shape decor -->
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-white/10 rounded-full blur-3xl">
        </div>
        <div
            class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-96 h-96 bg-indigo-900/20 rounded-full blur-3xl">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-4xl font-black text-white mb-6 leading-tight">Prêt à digitaliser votre vision ?</h2>
            <p class="text-xl text-primary-100 mb-10 max-w-2xl mx-auto opacity-90">Rejoignez les leaders qui nous font
                confiance pour leur infrastructure digitale.</p>
            <a href="{{ route('register') }}"
                class="inline-block px-10 py-5 bg-white text-primary-600 rounded-2xl font-black text-lg hover:bg-slate-50 transition shadow-xl">Démarrer
                gratuitement</a>
        </div>
    </div>
@endsection