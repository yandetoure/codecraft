@extends('layouts.admin')

@section('title', 'Gestion des Tickets Support')

@section('content')
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                    <th class="px-6 py-5">Ticket</th>
                    <th class="px-6 py-5">Client & Projet</th>
                    <th class="px-6 py-5">Sujet</th>
                    <th class="px-6 py-5">Priorité</th>
                    <th class="px-6 py-5 text-center">Status</th>
                    <th class="px-6 py-5 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($tickets as $ticket)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4">
                            <span
                                class="text-xs font-black text-slate-900 uppercase tracking-widest">{{ $ticket->ticket_number }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-slate-700">{{ $ticket->client->name }}</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                {{ $ticket->project->name }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-slate-600 truncate max-w-xs">{{ $ticket->subject }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-0.5 rounded text-[9px] font-black uppercase {{ $ticket->priority == 'high' ? 'bg-red-50 text-red-500' : 'bg-slate-100 text-slate-500' }}">
                                {{ $ticket->priority_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="inline-flex px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $ticket->status == 'open' ? 'bg-green-50 text-green-600' : 'bg-slate-100 text-slate-400' }}">
                                {{ $ticket->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.support.show', $ticket) }}"
                                class="inline-flex px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-primary-600 transition">Répondre</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center text-slate-400 italic">Aucun ticket de support actif.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $tickets->links() }}
    </div>
@endsection