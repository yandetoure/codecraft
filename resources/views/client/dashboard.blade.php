@extends('layouts.client')

@section('title', 'Mon Tableau de Bord')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Quick Stats -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Total Projets</p>
            <h3 class="text-2xl font-black text-slate-900">{{ $stats['total_projects'] }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Projets en Cours</p>
            <h3 class="text-2xl font-black text-primary-600">{{ $stats['active_projects'] }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Paiements à Venir</p>
            <h3 class="text-2xl font-black text-slate-900">{{ number_format($stats['pending_payments'], 0) }} <span
                    class="text-xs">FCFA</span></h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Tickets Support</p>
            <h3 class="text-2xl font-black text-slate-900">{{ $stats['open_tickets'] }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Active Projects List -->
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-black text-slate-900">Mes Projets Récents</h2>
                <a href="{{ route('client.projects.index') }}" class="text-sm font-bold text-primary-600">Voir tous</a>
            </div>

            @forelse($recent_projects as $project)
                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between hover:border-primary-200 transition">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-slate-900">{{ $project->name }}</h4>
                            <p class="text-sm text-slate-500">{{ $project->pack->name }} • {{ $project->project_number }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600 mb-2">
                            {{ $project->status_label }}
                        </span>
                        <a href="{{ route('client.projects.show', $project) }}"
                            class="block text-xs font-black text-slate-400 hover:text-primary-600 uppercase tracking-widest">Gérer</a>
                    </div>
                </div>
            @empty
                <div class="bg-slate-50 rounded-2xl p-12 text-center">
                    <p class="text-slate-500 font-medium italic">Vous n'avez pas encore de projet actif.</p>
                    <a href="{{ route('packs.index') }}"
                        class="mt-4 inline-block text-primary-600 font-bold underline">Découvrir nos solutions</a>
                </div>
            @endforelse
        </div>

        <!-- Appointments & Support -->
        <div class="space-y-8">
            <div>
                <h2 class="text-xl font-black text-slate-900 mb-6">Prochains Rendez-vous</h2>
                <div class="space-y-4">
                    @forelse($next_appointments as $apt)
                        <div class="bg-indigo-600 p-4 rounded-2xl text-white shadow-lg shadow-indigo-200">
                            <p class="text-xs font-bold opacity-80 uppercase tracking-widest mb-1">{{ $apt->type_label }}</p>
                            <h4 class="font-bold text-lg leading-tight mb-3">{{ $apt->subject }}</h4>
                            <div class="flex items-center text-sm opacity-90">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                {{ $apt->scheduled_at->format('d M \à H:i') }}
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-400 text-sm italic">Aucun rendez-vous prévu.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h3 class="font-bold text-slate-900 mb-4">Besoin d'aide ?</h3>
                <p class="text-sm text-slate-500 mb-4">Notre équipe technique est à votre disposition pour vous accompagner.
                </p>
                <a href="{{ route('client.support.create') }}"
                    class="block w-full py-3 px-4 bg-slate-50 text-center rounded-xl text-sm font-bold text-slate-900 hover:bg-slate-100 transition">Ouvrir
                    un ticket</a>
            </div>
        </div>
    </div>
@endsection