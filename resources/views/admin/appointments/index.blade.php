@extends('layouts.admin')

@section('title', 'Planning des Rendez-vous')

@section('content')
    <div class="mb-10 flex justify-between items-center">
        <p class="text-slate-500 font-medium italic">Gérez vos sessions de cadrage, démos et points de suivi avec vos
            clients.</p>
        <a href="{{ route('admin.appointments.create') }}"
            class="px-6 py-4 bg-primary-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary-700 shadow-xl shadow-primary-500/20 transition">
            Programmer un RDV
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                    <th class="px-6 py-5">Date & Heure</th>
                    <th class="px-6 py-5">Sujet & Projet</th>
                    <th class="px-6 py-5">Client & Distant</th>
                    <th class="px-6 py-5 text-center">Status</th>
                    <th class="px-6 py-5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($appointments as $apt)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4">
                            <p class="text-sm font-black text-slate-900">{{ $apt->scheduled_at->format('d M Y') }}</p>
                            <p class="text-xs font-bold text-primary-600 uppercase">{{ $apt->scheduled_at->format('H:i') }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-slate-900">{{ $apt->subject }}</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $apt->project->name }}
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-slate-700">{{ $apt->client->name }}</p>
                            <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest">
                                {{ $apt->assignedUser->name }} (Assigné)</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="inline-flex px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-amber-50 text-amber-600 border border-amber-100">
                                {{ $apt->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.appointments.update-status', $apt) }}" method="POST"
                                class="inline-block">
                                @csrf
                                <select name="status" onchange="this.form.submit()"
                                    class="bg-slate-50 border border-slate-100 rounded-lg px-2 py-1 text-[10px] font-black uppercase tracking-widest text-slate-500 focus:outline-none focus:border-primary-500">
                                    <option value="scheduled" {{ $apt->status == 'scheduled' ? 'selected' : '' }}>Prévu</option>
                                    <option value="confirmed" {{ $apt->status == 'confirmed' ? 'selected' : '' }}>Confirmé
                                    </option>
                                    <option value="completed" {{ $apt->status == 'completed' ? 'selected' : '' }}>Terminé</option>
                                    <option value="cancelled" {{ $apt->status == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-slate-400 italic">Aucun rendez-vous planifié.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection