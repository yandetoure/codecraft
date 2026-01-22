@extends('layouts.client')

@section('title')
    Projet : {{ $project->name }}
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Left: Timeline & Content -->
        <div class="lg:col-span-2 space-y-10">
            <!-- Progress Tracker -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-10">Progression du Projet</h3>
                <div class="flex flex-col md:flex-row items-start justify-between gap-6 relative">
                    <div
                        class="absolute top-4 left-4 md:left-0 md:top-1/2 w-0.5 md:w-full h-full md:h-0.5 bg-slate-100 -z-0">
                    </div>

                    @php
                        $steps = ['pending', 'quoting', 'accepted', 'developing', 'testing', 'completed'];
                        $currentIdx = array_search($project->status, $steps);
                    @endphp

                    @foreach($steps as $idx => $step)
                        <div class="relative z-10 flex md:flex-col items-center text-center">
                            <div
                                class="h-8 w-8 rounded-full border-4 {{ $idx <= $currentIdx ? 'bg-primary-600 border-primary-100' : 'bg-white border-slate-50' }} flex items-center justify-center transition-all duration-500">
                                @if($idx < $currentIdx)
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                @endif
                            </div>
                            <span
                                class="ml-4 md:ml-0 md:mt-4 text-[10px] font-black uppercase tracking-widest {{ $idx <= $currentIdx ? 'text-slate-900' : 'text-slate-300' }}">
                                {{ config("codecraft.project_statuses.{$step}") }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Quote Area -->
            @if($project->quotes()->exists())
                <div class="bg-indigo-900 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-indigo-100">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
                        <div>
                            <h3 class="text-2xl font-black mb-2">Votre Devis est Prêt</h3>
                            <p class="text-indigo-300 text-sm">Référence : {{ $project->quotes->last()->quote_number }}</p>
                        </div>
                        @if($project->quotes->last()->status == 'sent')
                            <div class="flex gap-4">
                                <form action="{{ route('client.quotes.accept', $project->quotes->last()) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="px-8 py-3 bg-white text-indigo-900 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-indigo-50 transition">Accepter</button>
                                </form>
                                <form action="{{ route('client.quotes.reject', $project->quotes->last()) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="px-8 py-3 bg-indigo-800 text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition">Refuser</button>
                                </form>
                            </div>
                        @else
                            <span
                                class="px-4 py-2 bg-white/10 rounded-xl font-black text-xs uppercase tracking-widest border border-white/20">
                                Status : {{ $project->quotes->last()->status }}
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 pt-10 border-t border-white/10">
                        <div>
                            <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-2">Montant HT</p>
                            <p class="font-bold text-lg">{{ number_format($project->total_price, 0) }} FCFA</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-2">Validité</p>
                            <p class="font-bold text-lg">30 jours</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Configuration -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-8">Ma Configuration Plateforme
                </h3>
                <form action="{{ route('client.projects.update-configuration', $project) }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nom de
                            l'entreprise</label>
                        <input type="text" name="company_name" value="{{ $project->configuration->company_name }}"
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Numéro
                            WhatsApp Business</label>
                        <input type="text" name="whatsapp_number" value="{{ $project->configuration->whatsapp_number }}"
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Email
                            Expéditeur</label>
                        <input type="email" name="email_sender" value="{{ $project->configuration->email_sender }}"
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition">
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full py-4 bg-primary-100 text-primary-600 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary-600 hover:text-white transition">Enregistrer
                            les réglages</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right: Sidebar -->
        <div class="space-y-10">
            <!-- Pack Info -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Résumé de la Solution</h3>
                <div class="space-y-6">
                    <div class="flex items-center">
                        <div
                            class="h-10 w-10 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center text-lg">
                            🛍️</div>
                        <div class="ml-4">
                            <p class="text-xs font-black text-slate-900 uppercase tracking-tight">{{ $project->pack->name }}
                            </p>
                            <p class="text-[10px] text-slate-500">{{ $project->pack->service->name }}</p>
                        </div>
                    </div>
                    <div class="pt-6 border-t border-slate-50 space-y-3">
                        @foreach($project->features as $feature)
                            <div class="flex items-center text-xs text-slate-600">
                                <svg class="w-3.5 h-3.5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                                {{ $feature->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Support Access -->
            <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white text-center relative overflow-hidden group">
                <div class="absolute inset-0 bg-primary-600 opacity-0 group-hover:opacity-10 transition duration-500"></div>
                <h4 class="text-lg font-black mb-2 relative z-10">Besoin d'assistance ?</h4>
                <p class="text-slate-400 text-sm mb-8 relative z-10 font-bold italic">Une question sur ce projet ? Notre
                    équipe est là pour vous répondre.</p>
                <a href="{{ route('client.support.create', ['project_id' => $project->id]) }}"
                    class="block py-4 border-2 border-white/10 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-white hover:text-slate-900 transition relative z-10">Contacter
                    le support</a>
            </div>
        </div>
    </div>
@endsection