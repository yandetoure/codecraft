@extends('layouts.app')

@section('content')
    <div class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-5xl font-black text-slate-900 mb-6 tracking-tight">Nos Solutions <span
                        class="text-primary-600">Tout-en-un</span></h1>
                <p class="text-xl text-slate-500 max-w-2xl mx-auto">Choisissez le pack qui correspond à votre étape de
                    croissance. Des forfaits pensés pour votre réussite.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($packs as $pack)
                    <div
                        class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100 flex flex-col hover:shadow-2xl hover:shadow-primary-100 transition-all duration-500 hover:-translate-y-2 relative group">
                        @if($pack->is_featured)
                            <div
                                class="absolute -top-4 left-10 px-4 py-1 bg-primary-600 text-white text-xs font-black uppercase tracking-widest rounded-full shadow-lg shadow-primary-500/30">
                                Top Vente</div>
                        @endif

                        <div class="mb-8">
                            <h3 class="text-2xl font-black text-slate-900 mb-2">{{ $pack->name }}</h3>
                            <p class="text-slate-500 text-sm italic">{{ $pack->service->name }}</p>
                        </div>

                        <div class="mb-8 p-6 rounded-3xl bg-slate-50 group-hover:bg-primary-50 transition duration-500">
                            <span class="text-4xl font-black text-slate-900">{{ number_format($pack->base_price, 0) }}</span>
                            <span class="text-slate-500 font-bold">FCFA</span>
                            <div class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-widest">Prix de base</div>
                        </div>

                        <div class="flex-1 space-y-4 mb-10">
                            @foreach($pack->features as $feature)
                                @if($feature->pivot->is_included)
                                    <div class="flex items-start">
                                        <div
                                            class="shrink-0 h-5 w-5 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3 mt-0.5">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span class="text-slate-600 text-sm">{{ $feature->name }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <a href="{{ route('packs.show', $pack) }}"
                            class="block w-full py-4 px-6 text-center rounded-2xl font-black text-sm uppercase tracking-widest bg-slate-900 text-white group-hover:bg-primary-600 transition-all duration-300 shadow-xl shadow-slate-200 group-hover:shadow-primary-200">Choisir
                            ce pack</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection