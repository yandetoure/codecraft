@extends('layouts.admin')

@section('title', isset($pack) ? 'Modifier Pack' : 'Nouveau Pack')

@section('content')
    <div class="max-w-5xl">
        <form action="{{ isset($pack) ? route('admin.packs.update', $pack) : route('admin.packs.store') }}" method="POST">
            @csrf
            @if(isset($pack)) @method('PUT') @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Basic Info -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-10">
                        <h3
                            class="text-lg font-black text-slate-900 mb-8 border-b border-slate-50 pb-4 uppercase tracking-widest">
                            Informations Générales</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Service
                                    Parent</label>
                                <select name="service_id" required
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:outline-none focus:border-primary-500 transition">
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ old('service_id', $pack->service_id ?? '') == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Nom du
                                    Pack</label>
                                <input type="text" name="name" value="{{ old('name', $pack->name ?? '') }}" required
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:outline-none focus:border-primary-500 transition"
                                    placeholder="ex: Starter Pack E-commerce">
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Description</label>
                                <textarea name="description" rows="3"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:outline-none focus:border-primary-500 transition">{{ old('description', $pack->description ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-10">
                        <h3
                            class="text-lg font-black text-slate-900 mb-8 border-b border-slate-50 pb-4 uppercase tracking-widest">
                            Configuration des Fonctionnalités</h3>

                        <div class="space-y-4">
                            @foreach($features as $feature)
                                                    <div
                                                        class="flex items-center justify-between p-4 rounded-2xl border border-slate-50 hover:bg-slate-50 transition group">
                                                        <div class="flex items-center">
                                                            <div
                                                                class="h-10 w-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 mr-4 group-hover:bg-primary-50 group-hover:text-primary-600 transition">
                                                                {{ $feature->icon ?? '+' }}
                                                            </div>
                                                            <div>
                                                                <p class="text-sm font-bold text-slate-900">{{ $feature->name }}</p>
                                                                <p class="text-[10px] text-slate-400 uppercase tracking-widest font-black">
                                                                    {{ number_format($feature->price, 0) }} FCFA</p>
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center gap-6">
                                                            <label class="flex items-center cursor-pointer">
                                                                <?php 
                                                                        $isIncluded = false;
                                if (isset($pack)) {
                                    $isIncluded = $pack->features->where('id', $feature->id)->where('pivot.is_included', true)->isNotEmpty();
                                }
                                                                    ?>
                                                                <input type="checkbox" name="features[{{ $feature->id }}][id]"
                                                                    value="{{ $feature->id }}" {{ $isIncluded ? 'checked' : '' }}
                                                                    class="hidden peer">
                                                                <input type="checkbox" name="features[{{ $feature->id }}][is_included]" value="1" {{ $isIncluded ? 'checked' : '' }}
                                                                    class="rounded border-slate-300 text-primary-600 focus:ring-primary-500 h-5 w-5 rounded-lg">
                                                                <span
                                                                    class="ml-2 text-xs font-black text-slate-500 uppercase tracking-widest">Inclus</span>
                                                            </label>
                                                        </div>
                                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right: Secondary Info -->
                <div class="space-y-8">
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 text-center">
                        <label
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-6 text-left">Paramètres
                            Mobilité</label>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-400 text-left mb-2">Prix (FCFA)</label>
                                <input type="number" name="base_price"
                                    value="{{ old('base_price', $pack->base_price ?? '') }}" required
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 font-bold focus:outline-none focus:border-primary-500">
                            </div>

                            <div class="flex flex-col gap-4">
                                <label
                                    class="flex items-center p-4 rounded-2xl bg-slate-50 border border-slate-100 cursor-pointer hover:border-primary-200 transition">
                                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $pack->is_featured ?? 0) ? 'checked' : '' }}
                                        class="rounded border-slate-300 text-primary-600 focus:ring-primary-500 h-5 w-5">
                                    <span class="ml-3 text-sm font-bold text-slate-700">Mettre en Avant</span>
                                </label>

                                <label
                                    class="flex items-center p-4 rounded-2xl bg-slate-50 border border-slate-100 cursor-pointer hover:border-primary-200 transition">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $pack->is_active ?? 1) ? 'checked' : '' }}
                                        class="rounded border-slate-300 text-primary-600 focus:ring-primary-500 h-5 w-5">
                                    <span class="ml-3 text-sm font-bold text-slate-700">Pack Actif</span>
                                </label>
                            </div>
                        </div>

                        <div class="mt-10 pt-8 border-t border-slate-50">
                            <button type="submit"
                                class="w-full py-5 bg-primary-600 text-white rounded-[1.5rem] font-black text-sm uppercase tracking-widest hover:bg-primary-700 shadow-xl shadow-primary-500/20 transition mb-4">
                                Enregistrer
                            </button>
                            <a href="{{ route('admin.packs.index') }}"
                                class="block w-full py-4 text-slate-400 font-bold text-xs uppercase tracking-widest hover:text-slate-600 transition">Annuler</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection