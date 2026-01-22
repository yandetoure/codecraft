@extends('layouts.app')

@section('content')
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('client.appointments.index') }}"
                class="inline-flex items-center text-sm font-bold text-slate-400 hover:text-slate-600 mb-8 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Retour aux rendez-vous
            </a>

            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200 border border-slate-100 overflow-hidden">
                <div class="p-10 md:p-12">
                    <div class="mb-10 text-center">
                        <div class="inline-block p-4 rounded-2xl bg-primary-50 text-primary-600 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-2">Demander un Rendez-vous</h1>
                        <p class="text-slate-500 text-sm font-medium max-w-md mx-auto">Choisissez une date idéale pour
                            échanger sur votre projet. Notre équipe validera le créneau rapidement.</p>
                    </div>

                    <form action="{{ route('client.appointments.store') }}" method="POST" class="space-y-8">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 pl-1">Projet
                                    concerné</label>
                                <select name="project_id" required
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition appearance-none">
                                    <option value="">Sélectionnez un projet...</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }} ({{ $project->status_label }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 pl-1">Type
                                    de session</label>
                                <select name="type" required
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition appearance-none">
                                    <option value="consultation">Consultation Stratégique</option>
                                    <option value="support">Support Technique</option>
                                    <option value="training">Formation / Démo</option>
                                    <option value="other">Autre Sujet</option>
                                </select>
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 pl-1">Date
                                    souhaitée</label>
                                <input type="datetime-local" name="preferred_date" required
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition">
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 pl-1">Sujet
                                    principal</label>
                                <input type="text" name="subject" required
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition"
                                    placeholder="ex: Validation des maquettes homepage">
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 pl-1">Détails
                                    (Optionnel)</label>
                                <textarea name="description" rows="3"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition resize-none"
                                    placeholder="Précisez votre besoin..."></textarea>
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit"
                                class="w-full flex justify-center py-5 px-4 border border-transparent rounded-2xl shadow-xl shadow-primary-500/30 text-sm font-black text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 uppercase tracking-widest transition transform hover:-translate-y-1">
                                Envoyer la demande
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-slate-50 p-6 text-center">
                    <p class="text-xs text-slate-400 font-medium">Nos experts confirment généralement les créneaux sous 24h
                        ouvrées.</p>
                </div>
            </div>
        </div>
    </div>
@endsection