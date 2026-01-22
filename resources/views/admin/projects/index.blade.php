@extends('layouts.admin')

@section('title', 'Gestion des Projets')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div class="flex gap-4">
            @foreach(config('codecraft.project_statuses') as $key => $label)
                <a href="?status={{ $key }}"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-widest transition {{ request('status') == $key ? 'bg-primary-600 text-white shadow-lg shadow-primary-500/30' : 'bg-white text-slate-500 border border-slate-100 hover:bg-slate-50' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left font-sans">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                    <th class="px-6 py-5">Référence & Nom</th>
                    <th class="px-6 py-5">Client</th>
                    <th class="px-6 py-5">Pack & Montant</th>
                    <th class="px-6 py-5">Statut</th>
                    <th class="px-6 py-5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($projects as $project)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div
                                    class="h-9 w-9 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-500 mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-900 leading-tight">{{ $project->name }}</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                        {{ $project->project_number }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-slate-700">{{ $project->client->name }}</p>
                            <p class="text-[10px] text-slate-400">{{ $project->client->email }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-xs font-black text-slate-900 uppercase tracking-tight">{{ $project->pack->name }}</p>
                            <p class="text-sm font-bold text-primary-600">{{ number_format($project->total_price, 0) }} FCFA</p>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-blue-50 text-blue-600 border border-blue-100">
                                {{ $project->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.projects.show', $project) }}"
                                class="inline-flex px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-primary-600 transition shadow-sm">
                                Gérer
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div
                                    class="h-16 w-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-slate-400 italic">Aucun projet trouvé avec ces critères.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $projects->links() }}
    </div>
@endsection