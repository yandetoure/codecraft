@extends('layouts.app')

@section('content')
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10 gap-6">
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-2">Mes Rendez-vous</h1>
                    <p class="text-slate-500 font-medium">Gérez vos réunions et sessions de travail avec nos experts.</p>
                </div>
                <a href="{{ route('client.appointments.create') }}"
                    class="inline-flex items-center justify-center px-6 py-4 bg-primary-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary-700 shadow-xl shadow-primary-500/20 transition transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Demander un RDV
                </a>
            </div>

            <!-- Appointments Grid -->
            <div class="grid grid-cols-1 gap-6">
                @forelse($appointments as $apt)
                    <div
                        class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-slate-100 hover:shadow-md transition group">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                            <!-- Date & Time Box -->
                            <div class="flex-shrink-0">
                                <div class="bg-slate-50 rounded-2xl p-4 text-center border border-slate-100 min-w-[100px]">
                                    <span
                                        class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-1">{{ $apt->scheduled_at->format('M') }}</span>
                                    <span
                                        class="block text-2xl font-black text-slate-900">{{ $apt->scheduled_at->format('d') }}</span>
                                    <span
                                        class="block text-xs font-bold text-primary-600 mt-1 bg-primary-50 py-1 px-2 rounded-lg">{{ $apt->scheduled_at->format('H:i') }}</span>
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="flex-grow">
                                <div class="flex items-center gap-3 mb-2">
                                    <span
                                        class="px-3 py-1 bg-slate-100 rounded-lg text-[10px] font-black uppercase tracking-widest text-slate-500">{{ $apt->project->name }}</span>
                                    <span
                                        class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $apt->status == 'scheduled' ? 'bg-amber-100 text-amber-600' : ($apt->status == 'confirmed' ? 'bg-green-100 text-green-600' : 'bg-slate-100 text-slate-400') }}">
                                        {{ $apt->status_label }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900 mb-1 group-hover:text-primary-600 transition">
                                    {{ $apt->subject }}</h3>
                                <p class="text-sm text-slate-500 line-clamp-2">{{ $apt->description ?? 'Aucune description' }}
                                </p>

                                @if($apt->assignedUser)
                                    <div class="flex items-center mt-4">
                                        <div
                                            class="h-6 w-6 rounded-full bg-primary-100 flex items-center justify-center text-[10px] font-bold text-primary-600 mr-2">
                                            {{ substr($apt->assignedUser->name, 0, 1) }}
                                        </div>
                                        <span class="text-xs font-medium text-slate-400">Avec <span
                                                class="text-slate-700 font-bold">{{ $apt->assignedUser->name }}</span></span>
                                    </div>
                                @endif
                            </div>

                            <!-- Action -->
                            <div class="flex-shrink-0 flex items-center">
                                <a href="{{ route('client.appointments.show', $apt) }}"
                                    class="p-3 rounded-xl bg-slate-50 text-slate-400 hover:bg-primary-600 hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-[2.5rem] p-12 text-center border border-slate-100 shadow-sm">
                        <div
                            class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-black text-slate-900 mb-2">Aucun rendez-vous</h3>
                        <p class="text-slate-500 mb-8 max-w-sm mx-auto">Vous n'avez pas encore de réunions planifiées. Commencez
                            par demander un rendez-vous pour votre projet.</p>
                        <a href="{{ route('client.appointments.create') }}"
                            class="inline-block px-8 py-3 bg-slate-900 text-white rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-primary-600 transition">Planifier
                            maintenant</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $appointments->links() }}
            </div>
        </div>
    </div>
@endsection