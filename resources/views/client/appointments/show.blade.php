@extends('layouts.app')

@section('content')
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('client.appointments.index') }}"
                    class="inline-flex items-center text-sm font-bold text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour à la liste
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="md:col-span-2 space-y-8">
                    <div
                        class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-10 relative overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-primary-50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2">
                        </div>

                        <div class="flex justify-between items-start mb-6">
                            <span
                                class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest {{ $appointment->status == 'scheduled' ? 'bg-amber-100 text-amber-600' : ($appointment->status == 'confirmed' ? 'bg-green-100 text-green-600' : 'bg-slate-100 text-slate-400') }}">
                                {{ $appointment->status_label }}
                            </span>
                            <span class="text-xs font-bold text-slate-400">Réf:
                                #APT-{{ str_pad($appointment->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        <h1 class="text-2xl md:text-3xl font-black text-slate-900 mb-2 leading-tight">
                            {{ $appointment->subject }}</h1>
                        <p class="text-base font-medium text-primary-600 mb-8">{{ $appointment->type_label }}</p>

                        <div class="prose prose-slate prose-sm max-w-none mb-8">
                            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Description / Notes
                            </h4>
                            <p class="text-slate-600 leading-relaxed">{{ $appointment->description }}</p>
                        </div>

                        @if($appointment->location)
                            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                                <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Lieu / Lien de
                                    connexion</h4>
                                <div class="flex items-center text-slate-900 font-bold">
                                    <svg class="w-5 h-5 mr-3 text-primary-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $appointment->location }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Date Card -->
                    <div class="bg-primary-600 rounded-[2.5rem] p-8 text-white text-center shadow-xl shadow-primary-500/30">
                        <span
                            class="block text-sm font-bold text-primary-200 uppercase tracking-widest mb-1">{{ $appointment->scheduled_at->format('F Y') }}</span>
                        <span class="block text-5xl font-black mb-1">{{ $appointment->scheduled_at->format('d') }}</span>
                        <span
                            class="block text-xl font-bold text-white mb-6">{{ $appointment->scheduled_at->format('l') }}</span>
                        <div class="inline-block bg-white/20 rounded-xl px-4 py-2 backdrop-blur-sm">
                            <span class="font-black tracking-widest">{{ $appointment->scheduled_at->format('H:i') }}</span>
                        </div>
                        <p class="mt-4 text-xs font-medium text-primary-200">Durée : {{ $appointment->duration_minutes }}
                            min</p>
                    </div>

                    <!-- Expert Card -->
                    @if($appointment->assignedUser)
                        <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Expert Assigné</h4>
                            <div class="flex items-center">
                                <div
                                    class="h-12 w-12 rounded-full bg-slate-900 flex items-center justify-center text-white text-lg font-black mr-4 shadow-lg shadow-slate-200">
                                    {{ substr($appointment->assignedUser->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">{{ $appointment->assignedUser->name }}</p>
                                    <p class="text-xs text-slate-500 font-medium">Chef de Projet</p>
                                </div>
                            </div>
                            <div class="mt-6 pt-6 border-t border-slate-50">
                                <button
                                    class="w-full py-3 bg-slate-50 text-slate-600 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-slate-100 transition">Contacter</button>
                            </div>
                        </div>
                    @else
                        <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 text-center">
                            <div
                                class="h-12 w-12 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4 text-slate-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-slate-900 mb-1">En attente de confirmation</p>
                            <p class="text-xs text-slate-500">Un expert vous sera assigné bientôt.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection