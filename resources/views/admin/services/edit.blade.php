@extends('layouts.admin')

@section('title', isset($service) ? 'Modifier Service' : 'Nouveau Service')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 md:p-12">
            <form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($service)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Nom du
                            Service</label>
                        <input type="text" name="name" value="{{ old('name', $service->name ?? '') }}" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:outline-none focus:border-primary-500 transition"
                            placeholder="ex: Application Web Sur-mesure">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Prix de Base
                            (FCFA)</label>
                        <input type="number" name="base_price" value="{{ old('base_price', $service->base_price ?? '') }}"
                            required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:outline-none focus:border-primary-500 transition"
                            placeholder="0">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Statut</label>
                        <select name="is_active"
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:outline-none focus:border-primary-500 transition">
                            <option value="1" {{ old('is_active', $service->is_active ?? 1) == 1 ? 'selected' : '' }}>Actif
                            </option>
                            <option value="0" {{ old('is_active', $service->is_active ?? 1) == 0 ? 'selected' : '' }}>Inactif
                            </option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Brève
                            Description</label>
                        <textarea name="description" rows="2"
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:outline-none focus:border-primary-500 transition">{{ old('description', $service->description ?? '') }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Image de
                            Couverture</label>
                        <div
                            class="flex items-center gap-6 p-6 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl">
                            @if(isset($service) && $service->getFirstMediaUrl('images'))
                                <img src="{{ $service->getFirstMediaUrl('images') }}" class="h-20 w-20 rounded-xl object-cover">
                            @endif
                            <input type="file" name="image"
                                class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-primary-50 file:text-primary-600 hover:file:bg-primary-100">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-12 border-t border-slate-100 pt-8">
                    <a href="{{ route('admin.services.index') }}"
                        class="px-8 py-4 bg-slate-100 text-slate-600 rounded-2xl font-bold text-sm hover:bg-slate-200 transition">Annuler</a>
                    <button type="submit"
                        class="px-10 py-4 bg-primary-600 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-primary-700 shadow-xl shadow-primary-500/20 transition">
                        {{ isset($service) ? 'Sauvegarder' : 'Créer le Service' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection