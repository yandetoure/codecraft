@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Cards -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 transition hover:shadow-md">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-500">Projets Actifs</p>
                    <h3 class="text-2xl font-bold text-slate-900">{{ $stats['active_projects'] }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 transition hover:shadow-md">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-green-50 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-500">Revenu Encaissé</p>
                    <h3 class="text-2xl font-bold text-slate-900">{{ number_format($stats['revenue'], 0, ',', ' ') }} FCFA
                    </h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 transition hover:shadow-md">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-amber-50 text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-500">Devis en Attente</p>
                    <h3 class="text-2xl font-bold text-slate-900">{{ $stats['pending_quotes'] }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 transition hover:shadow-md">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-indigo-50 text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-500">Tickets Ouverts</p>
                    <h3 class="text-2xl font-bold text-slate-900">{{ $stats['open_tickets'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Projects -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-900">Derniers Projets</h3>
                <a href="{{ route('admin.projects.index') }}"
                    class="text-sm font-semibold text-primary-600 hover:text-primary-700">Voir tout</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-3">Projet</th>
                            <th class="px-6 py-3">Client</th>
                            <th class="px-6 py-3">Statut</th>
                            <th class="px-6 py-3 text-right">Montant</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recent_projects as $project)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <p class="text-sm font-bold text-slate-900">{{ $project->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $project->project_number }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $project->client->name }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                        {{ $project->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-slate-900 text-right">
                                    {{ number_format($project->total_price, 0) }} FCFA</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-slate-500">Aucun projet récent.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Tickets -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900">Nouveaux Tickets</h3>
            </div>
            <div class="p-6 space-y-4">
                @forelse($recent_tickets as $ticket)
                    <div class="flex items-start p-3 rounded-xl hover:bg-slate-50 transition">
                        <div class="shrink-0 h-10 w-10 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                            <span class="text-xs font-bold">{{ $ticket->priority }}</span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-bold text-slate-900">{{ $ticket->subject }}</p>
                            <p class="text-xs text-slate-500">{{ $ticket->client->name }} •
                                {{ $ticket->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-slate-500 py-8">Aucun ticket en attente.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection