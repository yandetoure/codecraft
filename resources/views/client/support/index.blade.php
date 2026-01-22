@extends('layouts.client')

@section('title', 'Support Technique')

@section('content')
    <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <p class="text-slate-500 max-w-lg font-medium italic">Suivez vos demandes d'assistance et interagissez avec nos
            experts techniques.</p>
        <a href="{{ route('client.support.create') }}"
            class="px-8 py-4 bg-primary-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary-700 shadow-xl shadow-primary-500/20 transition">
            Ouvrir un nouveau ticket
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($tickets as $ticket)
            <a href="{{ route('client.support.show', $ticket) }}"
                class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 flex flex-col hover:shadow-xl hover:shadow-indigo-50 transition-all duration-500 group">
                <div class="flex justify-between items-start mb-6">
                    <span
                        class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $ticket->status == 'open' ? 'bg-green-50 text-green-600' : 'bg-slate-50 text-slate-400' }}">
                        {{ $ticket->status == 'open' ? 'Ouvert' : 'Fermé' }}
                    </span>
                    <span
                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $ticket->ticket_number }}</span>
                </div>

                <h3 class="text-lg font-black text-slate-900 mb-4 group-hover:text-primary-600 transition truncate">
                    {{ $ticket->subject }}</h3>

                <div class="space-y-3 mb-8">
                    <div class="flex items-center text-xs">
                        <span class="text-slate-400 font-bold uppercase tracking-widest mr-2">Priorité :</span>
                        <span
                            class="font-bold {{ $ticket->priority == 'high' ? 'text-red-500' : 'text-slate-700' }} uppercase">{{ $ticket->priority }}</span>
                    </div>
                    <div class="flex items-center text-xs">
                        <span class="text-slate-400 font-bold uppercase tracking-widest mr-2">Projet :</span>
                        <span class="text-slate-700 font-bold">{{ $ticket->project->name }}</span>
                    </div>
                </div>

                <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                    <span class="text-[10px] text-slate-400 font-bold italic">{{ $ticket->updated_at->diffForHumans() }}</span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-primary-600">Voir la discussion →</span>
                </div>
            </a>
        @empty
            <div class="col-span-full py-20 bg-slate-50 rounded-[3rem] text-center border-2 border-dashed border-slate-200">
                <h3 class="text-xl font-black text-slate-900 mb-2">Aucun ticket en cours</h3>
                <p class="text-slate-500 max-w-xs mx-auto text-sm italic">Vous n'avez pas de demande d'assistance active pour le
                    moment.</p>
            </div>
        @endforelse
    </div>
@endsection