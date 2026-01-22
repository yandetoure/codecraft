@extends('layouts.admin')

@section('title', "Ticket Support : #{$ticket->ticket_number}")

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Discussion Thread -->
        <div class="lg:col-span-2 space-y-10">
            <!-- Initial Ticket Post -->
            <div
                class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-indigo-100 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-primary-600/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2">
                </div>

                <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                    <div class="flex gap-4">
                        <span
                            class="px-3 py-1 bg-white/10 rounded-lg text-[10px] font-black uppercase tracking-widest border border-white/20">{{ $ticket->type_label }}</span>
                        <span
                            class="px-3 py-1 bg-white/10 rounded-lg text-[10px] font-black uppercase tracking-widest border border-white/20">{{ $ticket->priority_label }}</span>
                    </div>
                    <form action="{{ route('admin.support.update-status', $ticket) }}" method="POST">
                        @csrf
                        <select name="status" onchange="this.form.submit()"
                            class="bg-white/5 border border-white/10 rounded-lg px-3 py-1 text-[10px] font-black uppercase tracking-widest text-white focus:outline-none focus:border-primary-500">
                            <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }} class="bg-slate-800">
                                Assigné/Ouvert</option>
                            <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}
                                class="bg-slate-800">Résolu</option>
                            <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }} class="bg-slate-800">
                                Clôturé</option>
                        </select>
                    </form>
                </div>

                <h1 class="text-3xl font-black mb-6 leading-tight">{{ $ticket->subject }}</h1>
                <div class="prose prose-invert prose-sm max-w-none opacity-90 leading-relaxed italic">
                    {!! nl2br(e($ticket->description)) !!}
                </div>

                <div
                    class="mt-10 pt-8 border-t border-white/10 flex items-center justify-between text-xs font-bold text-slate-400 italic">
                    <span>Ouvert le {{ $ticket->created_at->format('d/m/Y \à H:i') }}</span>
                    <span>Client : {{ $ticket->client->name }}</span>
                </div>
            </div>

            <!-- Replies List -->
            <div class="space-y-8">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest px-4">Discussion Historique</h3>

                @forelse($ticket->messages as $message)
                    <div class="flex {{ $message->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[85%]">
                            <div
                                class="p-6 rounded-[2rem] shadow-sm {{ $message->is_internal ? 'bg-amber-50 border border-amber-200 text-amber-900' : ($message->user_id == Auth::id() ? 'bg-primary-600 text-white' : 'bg-white text-slate-900 border border-slate-100') }} {{ $message->user_id == Auth::id() ? 'rounded-tr-none' : 'rounded-tl-none' }}">
                                <div class="flex items-center justify-between mb-3">
                                    <p
                                        class="text-[10px] font-black uppercase tracking-widest {{ $message->user_id == Auth::id() ? 'text-primary-200' : 'text-slate-400' }}">
                                        {{ $message->user->name }} • {{ $message->created_at->diffForHumans() }}
                                    </p>
                                    @if($message->is_internal)
                                        <span
                                            class="text-[9px] font-black uppercase bg-amber-200 text-amber-700 px-2 rounded-full">Note
                                            Interne</span>
                                    @endif
                                </div>
                                <p class="text-sm leading-relaxed">{{ $message->message }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-12 text-center text-slate-400 italic text-sm">Pas encore de réponse.</div>
                @endforelse
            </div>

            <!-- Reply Form -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 sticky bottom-8">
                <form action="{{ route('admin.support.reply', $ticket) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <textarea name="message" required placeholder="Tapez votre réponse ou note interne ici..." rows="4"
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition shadow-inner resize-none"></textarea>
                        <div class="flex justify-between items-center">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="is_internal" value="1"
                                    class="h-5 w-5 rounded border-slate-300 text-amber-500 focus:ring-amber-500 mr-3">
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Note interne
                                    (invisible au client)</span>
                            </label>
                            <button type="submit"
                                class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary-600 transition shadow-xl shadow-slate-200">Envoyer
                                au client</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="space-y-10">
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Résumé du Dossier</h4>
                <div class="space-y-4">
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-400 font-bold">Projet</span>
                        <a href="{{ route('admin.projects.show', $ticket->project) }}"
                            class="text-primary-600 font-black hover:underline">{{ $ticket->project->name }}</a>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-400 font-bold">Client</span>
                        <span class="text-slate-900 font-black">{{ $ticket->client->name }}</span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-400 font-bold">Inscrit le</span>
                        <span class="text-slate-900 font-black">{{ $ticket->client->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-blue-600 rounded-[2.5rem] p-8 text-white relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2">
                </div>
                <h4 class="font-black mb-4 relative z-10">Action Rapide</h4>
                <p class="text-sm text-blue-100 mb-6 font-medium italic relative z-10 leading-relaxed">Pensez à clôturer le
                    ticket une fois la solution validée pour maintenir un dashboard propre.</p>
            </div>
        </div>
    </div>
@endsection