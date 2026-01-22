@extends('layouts.admin')

@section('title', 'Gestion des Packs')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <p class="text-slate-500">Combinez services et fonctionnalités pour créer des offres packagées.</p>
        <a href="{{ route('admin.packs.create') }}"
            class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-primary-700 shadow-lg shadow-primary-500/20 transition">
            Nouveau Pack
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50 text-xs font-bold text-slate-500 uppercase tracking-[0.2em]">
                    <th class="px-6 py-4">Pack</th>
                    <th class="px-6 py-4">Service Parent</th>
                    <th class="px-6 py-4">Prix Base</th>
                    <th class="px-6 py-4 text-center">Featured</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($packs as $pack)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($pack->is_featured)
                                    <div class="h-2 w-2 rounded-full bg-amber-400 mr-2 shadow-[0_0_8px_rgba(251,191,36,0.5)]"></div>
                                @endif
                                <p class="text-sm font-bold text-slate-900">{{ $pack->name }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $pack->service->name }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-slate-700">{{ number_format($pack->base_price, 0) }} FCFA
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($pack->is_featured)
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-md bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest">Oui</span>
                            @else
                                <span class="text-slate-300 text-[10px] font-bold uppercase tracking-widest">Non</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.packs.edit', $pack) }}"
                                class="inline-flex p-2 text-slate-400 hover:text-primary-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </a>
                            <form action="{{ route('admin.packs.destroy', $pack) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Supprimer ce pack ?')">
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
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic">Aucun pack configuré.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection