@extends('layouts.client')

@section('title', 'Ouvrir un Ticket Support')

@section('content')
    <div class="max-w-3xl">
        <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100">
            <form action="{{ route('client.support.store') }}" method="POST">
                @csrf

                <div class="space-y-8">
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Projet
                            concerné</label>
                        <select name="project_id" required
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition shadow-sm">
                            <option value="">Sélectionnez un projet...</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }} ({{ $project->project_number }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Nature de
                                la demande</label>
                            <select name="type" required
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition shadow-sm">
                                @foreach(config('codecraft.ticket_types') as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Niveau
                                d'urgence</label>
                            <select name="priority" required
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition shadow-sm">
                                @foreach(config('codecraft.ticket_priorities') as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Sujet de votre
                            message</label>
                        <input type="text" name="subject" required placeholder="ex: Problème d'intégration WhatsApp"
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition shadow-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Description
                            détaillée</label>
                        <textarea name="description" rows="6" required
                            placeholder="Décrivez votre besoin ou le problème rencontré avec le plus de précisions possibles..."
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition shadow-sm h-48"></textarea>
                    </div>
                </div>

                <div class="mt-12 flex justify-end gap-6">
                    <a href="{{ route('client.support.index') }}"
                        class="px-8 py-4 text-slate-400 font-bold text-xs uppercase tracking-widest hover:text-slate-600 transition">Annuler</a>
                    <button type="submit"
                        class="px-10 py-4 bg-primary-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary-700 shadow-xl shadow-primary-500/20 transition">Envoyer
                        ma demande</button>
                </div>
            </form>
        </div>
    </div>
@endsection