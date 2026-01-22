@extends('layouts.admin')

@section('title')
    Projet : {{ $project->project_number }}
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left: Project Details -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Main Info -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-10 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-10 opacity-10">
                    <svg class="w-32 h-32 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z"></path>
                    </svg>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <span
                            class="px-3 py-1 bg-primary-50 text-primary-600 text-[10px] font-black uppercase tracking-[0.2em] rounded-lg border border-primary-100">{{ $project->status_label }}</span>
                        <span class="text-slate-300">•</span>
                        <span class="text-xs font-bold text-slate-400">Créé le
                            {{ $project->created_at->format('d/m/Y') }}</span>
                    </div>

                    <h1 class="text-4xl font-black text-slate-900 mb-4 tracking-tight">{{ $project->name }}</h1>
                    <p class="text-slate-500 text-sm max-w-xl leading-relaxed">
                        {{ $project->description ?: 'Aucune description fournie.' }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12 border-t border-slate-50 pt-10">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Pack Sélectionné
                            </p>
                            <p class="font-bold text-slate-900">{{ $project->pack->name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Service
                                Principal</p>
                            <p class="font-bold text-slate-900">{{ $project->pack->service->name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Prix Total</p>
                            <p class="font-black text-primary-600">{{ number_format($project->total_price, 0) }} FCFA</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-10">
                <h3 class="text-lg font-black text-slate-900 mb-8 border-b border-slate-50 pb-4 uppercase tracking-widest">
                    Périmètre Technique</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($project->features as $feature)
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center">
                            <div
                                class="h-8 w-8 rounded-lg bg-white flex items-center justify-center text-slate-400 mr-4 shadow-sm">
                                {{ $feature->icon ?: '✓' }}
                            </div>
                            <span class="text-sm font-bold text-slate-700">{{ $feature->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- History -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-10">
                <h3 class="text-lg font-black text-slate-900 mb-8 border-b border-slate-50 pb-4 uppercase tracking-widest">
                    Audit Trail</h3>
                <div class="space-y-6">
                    @foreach($project->statusHistories as $history)
                        <div class="flex items-start">
                            <div class="shrink-0 h-4 w-4 rounded-full border-2 border-primary-600 bg-white mt-1 mr-4"></div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <p class="text-sm font-bold text-slate-900">Passage au statut : <span
                                            class="text-primary-600 uppercase">{{ config("codecraft.project_statuses.{$history->status}") }}</span>
                                    </p>
                                    <span
                                        class="text-[10px] font-bold text-slate-400">{{ $history->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                @if($history->notes)
                                    <p class="text-xs text-slate-500 mt-2 bg-slate-50 p-3 rounded-xl italic">"{{ $history->notes }}"
                                    </p>
                                @endif
                                <p class="text-[10px] text-slate-400 mt-2 font-bold uppercase tracking-widest">Par
                                    {{ $history->user->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right: Actions & Client -->
        <div class="space-y-8">
            <!-- Client Card -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-6">Informations Client</h3>
                <div class="flex items-center mb-6">
                    <div
                        class="h-12 w-12 rounded-2xl bg-primary-100 text-primary-600 flex items-center justify-center font-black text-lg">
                        {{ substr($project->client->name, 0, 1) }}
                    </div>
                    <div class="ml-4">
                        <p class="font-bold text-slate-900">{{ $project->client->name }}</p>
                        <p class="text-xs text-slate-500">{{ $project->client->email }}</p>
                    </div>
                </div>
                <a href="mailto:{{ $project->client->email }}"
                    class="block w-full text-center py-3 px-4 bg-slate-100 rounded-xl text-xs font-black uppercase tracking-widest text-slate-700 hover:bg-slate-200 transition">Contacter</a>
            </div>

            <!-- Workflow Actions -->
            <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-8">Pilotage du Projet</h3>

                <div class="space-y-4">
                    <form action="{{ route('admin.projects.update-status', $project) }}" method="POST" class="space-y-4">
                        @csrf
                        <select name="status"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-4 py-3 text-sm text-white focus:outline-none focus:border-primary-500 transition">
                            @foreach(config('codecraft.project_statuses') as $key => $label)
                                <option value="{{ $key }}" {{ $project->status == $key ? 'selected' : '' }} class="bg-slate-800">
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                        <textarea name="notes" placeholder="Notes de statut (optionnel)"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-4 py-3 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-primary-500 h-24"></textarea>
                        <button type="submit"
                            class="w-full py-4 bg-primary-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary-700 transition">Mettre
                            à jour le Statut</button>
                    </form>

                    <div class="pt-8 mt-8 border-t border-white/5 space-y-4">
                        @if(!$project->quotes()->exists())
                            <form action="{{ route('admin.projects.generate-quote', $project) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full py-4 bg-white text-slate-900 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-100 transition">Émettre
                                    un Devis</button>
                            </form>
                        @endif

                        @if($project->quotes()->where('status', 'accepted')->exists() && !$project->invoices()->exists())
                            <form action="{{ route('admin.projects.generate-invoice', $project) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full py-4 bg-amber-400 text-slate-900 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-amber-500 transition">Générer
                                    la Facture</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection