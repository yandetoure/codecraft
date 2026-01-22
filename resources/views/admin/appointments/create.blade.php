@extends('layouts.admin')

@section('title', 'Programmer un Rendez-vous')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
            <form action="{{ route('admin.appointments.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Projet Client
                            concerné</label>
                        <select name="project_id" required
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition">
                            <option value="">Sélectionnez un projet...</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }} ({{ $project->client->name }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Date et
                            Heure</label>
                        <input type="datetime-local" name="scheduled_at" required
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Assigné à
                            l'Expert</label>
                        <select name="assigned_to" required
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition">
                            @foreach($admins as $admin)
                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Objet du
                            RDV</label>
                        <input type="text" name="subject" required
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition"
                            placeholder="ex: Validation du cahier des charges">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Type de
                            RDV</label>
                        <select name="type" required
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition">
                            @foreach(config('codecraft.appointment_types') as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Durée estimée
                            (min)</label>
                        <input type="number" name="duration_minutes" value="30" step="15" required
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Lien de
                            visioconférence ou Lieu</label>
                        <input type="text" name="location"
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition"
                            placeholder="ex: Google Meet, Zoom, ou adresse bureau">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Notes
                            internes</label>
                        <textarea name="description" rows="3"
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:outline-none focus:border-primary-500 transition shadow-inner h-32"></textarea>
                    </div>
                </div>

                <div class="mt-12 flex justify-end gap-6">
                    <a href="{{ route('admin.appointments.index') }}"
                        class="px-8 py-4 text-slate-400 font-bold text-xs uppercase tracking-widest hover:text-slate-600 transition">Annuler</a>
                    <button type="submit"
                        class="px-10 py-4 bg-primary-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary-700 shadow-xl shadow-primary-500/20 transition">Confirmer
                        le RDV</button>
                </div>
            </form>
        </div>
    </div>
@endsection