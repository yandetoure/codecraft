@extends('layouts.app')

@section('content')
    <div class="relative overflow-hidden pt-16 pb-24">
        <!-- Hero Background -->
        <div class="absolute inset-0 bg-slate-950">
            <div class="absolute inset-0 bg-gradient-to-b from-primary-900/20 via-slate-950/80 to-slate-950"></div>
            <div
                class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[800px] h-[800px] bg-primary-600/20 rounded-full blur-[120px] animate-pulse-slow">
            </div>
            <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-pink-600/20 rounded-full blur-[100px] animate-pulse-slow"
                style="animation-delay: 2s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16 text-center">
            <span
                class="inline-block py-1 px-3 rounded-full bg-slate-800/50 border border-slate-700 backdrop-blur-md text-primary-400 text-sm font-semibold mb-6 animate-fade-in">
                Catalogue de Fonctionnalités
            </span>
            <h1 class="text-4xl md:text-6xl font-display font-bold text-white mb-6 tracking-tight animate-slide-up">
                Tout ce dont votre <span class="gradient-text">projet a besoin</span>
            </h1>
            <p class="text-xl text-slate-400 max-w-2xl mx-auto mb-10 animate-slide-up" style="animation-delay: 0.1s;">
                Des modules techniques robustes aux outils marketing performants. Découvrez nos briques logicielles prêtes à
                l'emploi.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 -mt-20 relative z-10" x-data="{ activeFilter: 'all' }">
        <!-- Filter Tabs -->
        <div class="flex flex-wrap justify-center gap-3 mb-16 animate-fade-in" style="animation-delay: 0.2s;">
            <button @click="activeFilter = 'all'"
                :class="activeFilter === 'all' ? 'bg-primary-600 text-white shadow-lg shadow-primary-900/20' : 'bg-white/10 backdrop-blur-md text-slate-600 hover:bg-white hover:text-primary-600 border border-slate-200/50'"
                class="px-5 py-2 rounded-full font-semibold transition hover:scale-105 text-sm">Tout</button>

            <button @click="activeFilter = 'technical'"
                :class="activeFilter === 'technical' ? 'bg-white text-blue-600 shadow-xl ring-2 ring-blue-100' : 'bg-white/50 text-slate-600 hover:bg-white border border-slate-200'"
                class="px-5 py-2 rounded-full font-medium transition hover:scale-105 text-sm">Technique</button>
            <button @click="activeFilter = 'marketing'"
                :class="activeFilter === 'marketing' ? 'bg-white text-emerald-600 shadow-xl ring-2 ring-emerald-100' : 'bg-white/50 text-slate-600 hover:bg-white border border-slate-200'"
                class="px-5 py-2 rounded-full font-medium transition hover:scale-105 text-sm">Marketing</button>
            <button @click="activeFilter = 'support'"
                :class="activeFilter === 'support' ? 'bg-white text-orange-600 shadow-xl ring-2 ring-orange-100' : 'bg-white/50 text-slate-600 hover:bg-white border border-slate-200'"
                class="px-5 py-2 rounded-full font-medium transition hover:scale-105 text-sm">Support</button>

            <button @click="activeFilter = 'ecommerce'"
                :class="activeFilter === 'ecommerce' ? 'bg-white text-purple-600 shadow-xl ring-2 ring-purple-100' : 'bg-white/50 text-slate-600 hover:bg-white border border-slate-200'"
                class="px-5 py-2 rounded-full font-medium transition hover:scale-105 text-sm">E-commerce</button>
            <button @click="activeFilter = 'health'"
                :class="activeFilter === 'health' ? 'bg-white text-red-600 shadow-xl ring-2 ring-red-100' : 'bg-white/50 text-slate-600 hover:bg-white border border-slate-200'"
                class="px-5 py-2 rounded-full font-medium transition hover:scale-105 text-sm">Santé</button>
            <button @click="activeFilter = 'delivery'"
                :class="activeFilter === 'delivery' ? 'bg-white text-amber-600 shadow-xl ring-2 ring-amber-100' : 'bg-white/50 text-slate-600 hover:bg-white border border-slate-200'"
                class="px-5 py-2 rounded-full font-medium transition hover:scale-105 text-sm">Livraison</button>
            <button @click="activeFilter = 'hotel'"
                :class="activeFilter === 'hotel' ? 'bg-white text-cyan-600 shadow-xl ring-2 ring-cyan-100' : 'bg-white/50 text-slate-600 hover:bg-white border border-slate-200'"
                class="px-5 py-2 rounded-full font-medium transition hover:scale-105 text-sm">Hôtellerie</button>
            <button @click="activeFilter = 'stock'"
                :class="activeFilter === 'stock' ? 'bg-white text-indigo-600 shadow-xl ring-2 ring-indigo-100' : 'bg-white/50 text-slate-600 hover:bg-white border border-slate-200'"
                class="px-5 py-2 rounded-full font-medium transition hover:scale-105 text-sm">Stock</button>
            <button @click="activeFilter = 'transport'"
                :class="activeFilter === 'transport' ? 'bg-white text-slate-800 shadow-xl ring-2 ring-slate-200' : 'bg-white/50 text-slate-600 hover:bg-white border border-slate-200'"
                class="px-5 py-2 rounded-full font-medium transition hover:scale-105 text-sm">Transport</button>
            <button @click="activeFilter = 'culinary'"
                :class="activeFilter === 'culinary' ? 'bg-white text-orange-500 shadow-xl ring-2 ring-orange-100' : 'bg-white/50 text-slate-600 hover:bg-white border border-slate-200'"
                class="px-5 py-2 rounded-full font-medium transition hover:scale-105 text-sm">Culinaire</button>
            <button @click="activeFilter = 'real_estate'"
                :class="activeFilter === 'real_estate' ? 'bg-white text-emerald-700 shadow-xl ring-2 ring-emerald-100' : 'bg-white/50 text-slate-600 hover:bg-white border border-slate-200'"
                class="px-5 py-2 rounded-full font-medium transition hover:scale-105 text-sm">Immobilier</button>
        </div>

        @php
            $groupedFeatures = $features->groupBy('type');
            $types = [
                'technical' => ['label' => 'Architecture & Technique', 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4', 'color' => 'from-blue-500 to-indigo-600'],
                'marketing' => ['label' => 'Croissance & Marketing', 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'color' => 'from-emerald-400 to-teal-600'],
                'support' => ['label' => 'Support & Maintenance', 'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'from-orange-400 to-pink-600'],
                'ecommerce' => ['label' => 'E-commerce & Vente en ligne', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'color' => 'from-purple-500 to-fuchsia-600'],
                'health' => ['label' => 'Santé & Médical', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'color' => 'from-red-500 to-rose-600'],
                'delivery' => ['label' => 'Logistique & Livraison', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'color' => 'from-amber-400 to-orange-600'],
                'showcase' => ['label' => 'Sites Vitrines & Portfolios', 'icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9', 'color' => 'from-sky-400 to-blue-500'],
                'hotel' => ['label' => 'Hôtellerie & Restauration', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'color' => 'from-cyan-400 to-teal-500'],
                'stock' => ['label' => 'Gestion de Stock & Inventaire', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'color' => 'from-indigo-400 to-violet-600'],
                'transport' => ['label' => 'Transport & Flotte', 'icon' => 'M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z', 'color' => 'from-slate-600 to-zinc-800'],
                'culinary' => ['label' => 'Gastronomie & Cuisine', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'color' => 'from-orange-400 to-red-600'],
                'real_estate' => ['label' => 'Gestion Immobilière', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'color' => 'from-emerald-600 to-teal-800'],
            ];
        @endphp

        @foreach($types as $key => $meta)
            @if(isset($groupedFeatures[$key]))
                <div class="mb-24" x-show="activeFilter === 'all' || activeFilter === '{{ $key }}'"
                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="p-3 rounded-2xl bg-gradient-to-br {{ $meta['color'] }} shadow-lg text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $meta['icon'] }}">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-display font-bold text-slate-900">{{ $meta['label'] }}</h2>
                        <div class="h-px flex-grow bg-gradient-to-r from-slate-200 to-transparent"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($groupedFeatures[$key] as $feature)
                            <div
                                class="group relative bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl hover:shadow-primary-900/5 transition-all duration-300 card-hover border border-slate-100 overflow-hidden">
                                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-100 transition-opacity">
                                    <span class="text-6xl">{{ $feature->icon ?? '⚡' }}</span>
                                </div>

                                <div class="relative z-10">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-2xl mb-6 shadow-sm group-hover:scale-110 transition-transform duration-300">
                                        {{ $feature->icon ?? '⚡' }}
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary-600 transition-colors">
                                        {{ $feature->name }}
                                    </h3>
                                    <p class="text-slate-500 text-sm leading-relaxed mb-6">
                                        {{ $feature->description ?? 'Améliorez votre projet avec cette fonctionnalité essentielle.' }}
                                    </p>

                                    <div class="flex items-center justify-between border-t border-slate-50 pt-4 mt-auto">
                                        <span class="text-sm font-semibold text-slate-400">Prix unitaire</span>
                                        <span
                                            class="text-lg font-bold bg-clip-text text-transparent bg-gradient-to-r {{ $meta['color'] }}">
                                            {{ number_format($feature->price, 0, ',', ' ') }} FCFA
                                        </span>
                                    </div>
                                </div>

                                <!-- Hover Border Gradient -->
                                <div
                                    class="absolute inset-0 border-2 border-transparent group-hover:border-primary-100 rounded-3xl transition-colors pointer-events-none">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- CTA Footer -->
    <div class="py-24 bg-gradient-to-br from-slate-900 to-slate-950 relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[url('/img/grid.svg')] opacity-10"></div>
        </div>
        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">
            <h2 class="text-4xl font-display font-bold text-white mb-6">Besoin d'une solution sur-mesure ?</h2>
            <p class="text-slate-400 text-lg mb-10">
                Nos packs incluent déjà la plupart de ces fonctionnalités. Configurez votre pack idéal dès maintenant.
            </p>
            <a href="{{ route('packs.index') }}"
                class="inline-flex items-center px-8 py-4 bg-white text-slate-900 rounded-xl font-bold text-lg hover:bg-primary-50 hover:text-primary-600 transition-all shadow-[0_0_40px_-10px_rgba(255,255,255,0.3)]">
                Configurer mon Pack
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                </svg>
            </a>
        </div>
    </div>
@endsection