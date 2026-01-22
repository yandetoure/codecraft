@extends('layouts.admin')

@section('title', isset($feature) ? 'Modifier Option' : 'Nouvelle Option')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
            <form action="{{ isset($feature) ? route('admin.features.update', $feature) : route('admin.features.store') }}"
                method="POST">
                @csrf
                @if(isset($feature)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="md:col-span-2 text-center py-6 bg-slate-50 rounded-2xl mb-4">
                        <span class="text-[4rem] block mb-2">{{ old('icon', $feature->icon ?? '⚙️') }}</span>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Aperçu de
                            l'Icône</label>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Nom de la
                            fonctionnalité</label>
                        <input type="text" name="name" value="{{ old('name', $feature->name ?? '') }}" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:outline-none focus:border-primary-500 transition"
                            placeholder="ex: Chat en direct">
                    </div>

                    <div>
                        <label
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Catégorie</label>
                        <select name="type" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:outline-none focus:border-primary-500 transition">
                            <option value="technical" {{ old('type', $feature->type ?? '') == 'technical' ? 'selected' : '' }}>Technique</option>
                            <option value="design" {{ old('type', $feature->type ?? '') == 'design' ? 'selected' : '' }}>
                                Design</option>
                            <option value="marketing" {{ old('type', $feature->type ?? '') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="maintenance" {{ old('type', $feature->type ?? '') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Icône
                            (Emoji)</label>
                        <input type="text" name="icon" value="{{ old('icon', $feature->icon ?? '⚙️') }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:outline-none focus:border-primary-500 transition"
                            placeholder="ex: 💬">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Prix de
                            l'Option (FCFA)</label>
                        <input type="number" name="price" value="{{ old('price', $feature->price ?? '') }}" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 font-bold focus:outline-none focus:border-primary-500 transition"
                            placeholder="0">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Ordre
                            d'affichage</label>
                        <input type="number" name="order" value="{{ old('order', $feature->order ?? 0) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:outline-none focus:border-primary-500 transition">
                    </div>

                    <div class="md:col-span-2">
                        <label
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Description</label>
                        <textarea name="description" rows="3" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:outline-none focus:border-primary-500 transition"
                            placeholder="Décrivez l'intérêt de cette option pour le client...">{{ old('description', $feature->description ?? '') }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label
                            class="flex items-center p-6 bg-slate-50 rounded-2xl border border-slate-100 cursor-pointer hover:bg-slate-100 transition">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $feature->is_active ?? 1) ? 'checked' : '' }}
                                class="h-6 w-6 rounded text-primary-600 border-slate-300 focus:ring-primary-500">
                            <span class="ml-4 text-sm font-black text-slate-700 uppercase tracking-widest">Activer cette
                                fonctionnalité</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end gap-6 pt-10 border-t border-slate-50">
                    <a href="{{ route('admin.features.index') }}"
                        class="px-8 py-4 text-slate-400 font-bold text-xs uppercase tracking-widest">Annuler</a>
                    <button type="submit"
                        class="px-10 py-4 bg-primary-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary-700 shadow-xl shadow-primary-500/20 transition">
                        {{ isset($feature) ? 'Enregistrer' : 'Créer l\'Option' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection