@extends('layouts.admin')

@section('title', 'Configuration des Fonctionnalités')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <p class="text-slate-500 italic">Définissez les options techniques et design que les clients peuvent ajouter à leurs
            packs.</p>
        <a href="{{ route('admin.features.create') }}"
            class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-primary-700 shadow-lg shadow-primary-500/20 transition">
            Nouvelle Fonctionnalité
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50 text-xs font-bold text-slate-500 uppercase tracking-[0.2em]">
                    <th class="px-6 py-4">Option</th>
                    <th class="px-6 py-4">Type</th>
                    <th class="px-6 py-4">Prix</th>
                    <th class="px-6 py-4 text-center">Statut</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($features as $feature)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div
                                    class="h-10 w-10 rounded-xl bg-slate-50 flex items-center justify-center text-xl mr-3 border border-slate-100 shadow-sm">
                                    {{ $feature->icon ?? '⚙️' }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $feature->name }}</p>
                                    <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest">
                                        {{ Str::limit($feature->description, 40) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs font-black text-slate-500 uppercase tracking-widest">{{ $feature->type }}
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-primary-600">{{ number_format($feature->price, 0) }} FCFA
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ $feature->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $feature->is_active ? 'Activé' : 'Désactivé' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.features.edit', $feature) }}"
                                class="inline-flex p-2 text-slate-400 hover:text-primary-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </a>
                            <form action="{{ route('admin.features.destroy', $feature) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Sûr ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-600 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic">Aucune fonctionnalité créée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection