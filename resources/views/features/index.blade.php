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
        <div class="flex flex-wrap justify-center gap-4 mb-16 animate-fade-in" style="animation-delay: 0.2s;">
            <button 
                @click="activeFilter = 'all'"
                :class="activeFilter === 'all' ? 'bg-white text-primary-600 shadow-lg shadow-primary-900/5 ring-2 ring-primary-100' : 'bg-white/5 backdrop-blur-md text-slate-600 hover:bg-white hover:text-primary-600 border border-slate-200/50'"
                class="px-6 py-2 rounded-full font-semibold transition hover:scale-105">
                Tout voir
            </button>
            <button 
                @click="activeFilter = 'technical'"
                :class="activeFilter === 'technical' ? 'bg-white text-primary-600 shadow-lg shadow-primary-900/5 ring-2 ring-primary-100' : 'bg-white/5 backdrop-blur-md text-slate-600 hover:bg-white hover:text-primary-600 border border-slate-200/50'"
                class="px-6 py-2 rounded-full font-semibold transition hover:scale-105">
                Technique
            </button>
            <button 
                 @click="activeFilter = 'marketing'"
                 :class="activeFilter === 'marketing' ? 'bg-white text-primary-600 shadow-lg shadow-primary-900/5 ring-2 ring-primary-100' : 'bg-white/5 backdrop-blur-md text-slate-600 hover:bg-white hover:text-primary-600 border border-slate-200/50'"
                class="px-6 py-2 rounded-full font-semibold transition hover:scale-105">
                Marketing
            </button>
            <button 
                @click="activeFilter = 'support'"
                :class="activeFilter === 'support' ? 'bg-white text-primary-600 shadow-lg shadow-primary-900/5 ring-2 ring-primary-100' : 'bg-white/5 backdrop-blur-md text-slate-600 hover:bg-white hover:text-primary-600 border border-slate-200/50'"
                class="px-6 py-2 rounded-full font-semibold transition hover:scale-105">
                Support
            </button>
        </div>

        @php
            $groupedFeatures = $features->groupBy('type');
            $types = [
                'technical' => ['label' => 'Architecture & Technique', 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4', 'color' => 'from-blue-500 to-indigo-600'],
                'marketing' => ['label' => 'Croissance & Marketing', 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'color' => 'from-emerald-400 to-teal-600'],
                'support' => ['label' => 'Support & Maintenance', 'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'from-orange-400 to-pink-600'],
            ];
        @endphp

        @foreach($types as $key => $meta)
            @if(isset($groupedFeatures[$key]))
                <div class="mb-24" x-show="activeFilter === 'all' || activeFilter === '{{ $key }}'" x-transition.duration.300ms>
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
                                        {{ $feature->name }}</h3>
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