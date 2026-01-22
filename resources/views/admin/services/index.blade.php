@extends('layouts.admin')

@section('title', 'Gestion des Services')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <p class="text-slate-500">Gérez les types de produits digitaux que vous proposez.</p>
        <a href="{{ route('admin.services.create') }}"
            class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-primary-700 shadow-lg shadow-primary-500/20 transition">
            Nouveau Service
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50 text-xs font-bold text-slate-500 uppercase tracking-[0.2em]">
                    <th class="px-6 py-4">Service</th>
                    <th class="px-6 py-4">Prix de base</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($services as $service)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($service->getFirstMediaUrl('images'))
                                    <img src="{{ $service->getFirstMediaUrl('images') }}"
                                        class="h-10 w-10 rounded-lg object-cover mr-3">
                                @else
                                    <div
                                        class="h-10 w-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 mr-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $service->name }}</p>
                                    <p class="text-xs text-slate-400">{{ Str::limit($service->description, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-slate-700">{{ number_format($service->base_price, 0) }} FCFA
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $service->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $service->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.services.edit', $service) }}"
                                class="inline-flex p-2 text-slate-400 hover:text-primary-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Supprimer ce service ?')">
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
                        <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic">Aucun service configuré.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection