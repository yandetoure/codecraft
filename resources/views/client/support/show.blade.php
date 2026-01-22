@extends('layouts.client')

@section('title', "Ticket #{$ticket->ticket_number}")

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Discussion Thread -->
        <div class="lg:col-span-2 space-y-10">
            <!-- Initial Ticket Post -->
            <div
                class="bg-indigo-900 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-indigo-100 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-primary-600/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2">
                </div>

                <div class="flex flex-wrap items-center gap-4 mb-8">
                    <span
                        class="px-3 py-1 bg-white/10 rounded-lg text-[10px] font-black uppercase tracking-widest border border-white/20">{{ $ticket->type_label }}</span>
                    <span
                        class="px-3 py-1 bg-white/10 rounded-lg text-[10px] font-black uppercase tracking-widest border border-white/20">{{ $ticket->priority_label }}</span>
                </div>

                <h1 class="text-3xl font-black mb-6 leading-tight">{{ $ticket->subject }}</h1>
                <div class="prose prose-invert prose-sm max-w-none opacity-90 leading-relaxed italic">
                    {!! nl2br(e($ticket->description)) !!}
                </div>

                <div
                    class="mt-10 pt-8 border-t border-white/10 flex items-center justify-between text-xs font-bold text-indigo-300 italic">
                    <span>Ouvert le {{ $ticket->created_at->format('d/m/Y \à H:i') }}</span>
                    <span>Projet : {{ $ticket->project->name }}</span>
                </div>
            </div>

            <!-- Replies List -->
            <div class="space-y-8">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest px-4">Échanges
                    ({{ $ticket->messages->count() }})</h3>

                @forelse($ticket->messages as $message)
                    <div class="flex {{ $message->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[85%]">
                            <div
                                class="p-6 rounded-[2rem] shadow-sm {{ $message->user_id == Auth::id() ? 'bg-primary-600 text-white rounded-tr-none' : 'bg-white text-slate-900 border border-slate-100 rounded-tl-none' }}">
                                <p
                                    class="text-xs font-black uppercase tracking-widest mb-3 {{ $message->user_id == Auth::id() ? 'text-primary-200' : 'text-slate-400' }}">
                                    {{ $message->user->name }} • {{ $message->created_at->diffForHumans() }}
                                </p>
                                <p class="text-sm leading-relaxed">{{ $message->message }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-12 text-center text-slate-400 italic text-sm">Prise en charge en cours... Notre équipe vous
                        répondra dans les plus brefs délais.</div>
                @endforelse
            </div>

            <!-- Reply Form -->
            @if($ticket->status == 'open')
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 sticky bottom-8">
                    <form action="{{ route('client.support.reply', $ticket) }}" method="POST">
                        @csrf
                        <div class="flex gap-4">
                            <textarea name="message" required placeholder="Tapez votre réponse ici..." rows="1"
                                class="flex-1 bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition shadow-inner resize-none min-h-[56px]"></textarea>
                            <button type="submit"
                                class="shrink-0 h-[56px] w-[56px] bg-primary-600 text-white rounded-2xl flex items-center justify-center hover:bg-primary-700 transition shadow-lg shadow-primary-500/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div
                    class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2.5rem] p-10 text-center text-slate-400 font-bold italic">
                    Ce ticket a été clôturé. Vous ne pouvez plus y répondre.
                </div>
            @endif
        </div>

        <!-- Info Sidebar -->
        <div class="space-y-8">
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Détails du Ticket</h4>
                <div class="space-y-4">
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-400 font-bold">Référence</span>
                        <span class="text-slate-900 font-black">{{ $ticket->ticket_number }}</span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-400 font-bold">Urgence</span>
                        <span
                            class="px-2 py-0.5 rounded bg-red-50 text-red-500 font-black uppercase text-[9px]">{{ $ticket->priority_label }}</span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-400 font-bold">Délai moyen</span>
                        <span class="text-slate-900 font-black">~ 2h</span>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 border border-slate-100 rounded-[2.5rem] p-8 text-center">
                <div
                    class="h-20 w-20 bg-white rounded-full flex items-center justify-center text-3xl mx-auto mb-6 shadow-sm">
                    👨‍💻</div>
                <h4 class="text-sm font-black text-slate-900 mb-2">Support Dédié</h4>
                <p class="text-xs text-slate-500 italic">Un membre de notre équipe technique gère actuellement votre
                    demande.</p>
            </div>
        </div>
    </div>
@endsection