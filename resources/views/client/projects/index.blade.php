@extends('layouts.client')

@section('title', 'Mes Projets')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($projects as $project)
            <div
                class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 flex flex-col hover:shadow-xl hover:shadow-indigo-50 transition-all duration-500 group">
                <div class="flex justify-between items-start mb-6">
                    <span
                        class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest rounded-lg">{{ $project->status_label }}</span>
                    <span
                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $project->project_number }}</span>
                </div>

                <h3 class="text-xl font-black text-slate-900 mb-2 group-hover:text-primary-600 transition">{{ $project->name }}
                </h3>
                <p class="text-slate-500 text-sm italic mb-8">{{ $project->pack->name }}</p>

                <div class="flex-1 space-y-4 mb-8">
                    <div class="flex justify-between text-xs">
                        <span class="text-slate-400 font-bold uppercase tracking-widest">Date de début</span>
                        <span class="text-slate-900 font-bold">{{ $project->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-slate-400 font-bold uppercase tracking-widest">Budget Total</span>
                        <span class="text-primary-600 font-black">{{ number_format($project->total_price, 0) }} FCFA</span>
                    </div>
                </div>

                <a href="{{ route('client.projects.show', $project) }}"
                    class="block w-full py-4 bg-slate-900 text-white text-center rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-primary-600 transition shadow-lg shadow-slate-200 group-hover:shadow-primary-100">Détails
                    du projet</a>
            </div>
        @empty
            <div class="col-span-full py-20 bg-slate-50 rounded-[3rem] text-center">
                <div
                    class="h-20 w-20 bg-white rounded-full flex items-center justify-center text-slate-300 mx-auto mb-6 shadow-sm">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 mb-2">Aucun projet en cours</h3>
                <p class="text-slate-500 mb-8 max-w-sm mx-auto">Prêt à lancer votre prochaine grande idée ? Nos experts sont là
                    pour vous accompagner.</p>
                <a href="{{ route('packs.index') }}"
                    class="inline-block px-8 py-4 bg-primary-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary-700 transition shadow-xl shadow-primary-500/20">Démarrer
                    un projet</a>
            </div>
        @endforelse
    </div>
@endsection