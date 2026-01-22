@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-20 flex flex-col justify-center sm:py-12 bg-slate-50 relative overflow-hidden">
        <!-- Abstract Background -->
        <div
            class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-primary-400 opacity-20 blur-3xl filter animate-blob">
        </div>
        <div
            class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-indigo-400 opacity-20 blur-3xl filter animate-blob animation-delay-2000">
        </div>

        <div class="relative py-3 sm:max-w-xl sm:mx-auto w-full px-4">
            <div
                class="absolute inset-0 bg-gradient-to-r from-primary-400 to-indigo-500 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl opacity-20">
            </div>
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20 border border-slate-100 p-8">
                <div class="max-w-md mx-auto">
                    <div class="divide-y divide-slate-200">
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <div class="mb-10 text-center">
                                <h2 class="text-3xl font-black text-slate-900 tracking-tight mb-2">Bon retour 👋</h2>
                                <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Connectez-vous à votre
                                    espace</p>
                            </div>

                            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                                @csrf

                                <div>
                                    <label for="email"
                                        class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Adresse
                                        Email</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                        autofocus
                                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 focus:outline-none focus:border-primary-500 transition @error('email') border-red-500 @enderror">
                                    @error('email')
                                        <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <label for="password"
                                            class="block text-xs font-black text-slate-400 uppercase tracking-widest">Mot de
                                            passe</label>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}"
                                                class="text-xs font-bold text-primary-600 hover:text-primary-500">Oublié ?</a>
                                        @endif
                                    </div>
                                    <input id="password" type="password" name="password" required
                                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 focus:outline-none focus:border-primary-500 transition @error('password') border-red-500 @enderror">
                                    @error('password')
                                        <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="flex items-center">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                                            class="h-4 w-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                                        <span class="ml-2 text-sm font-bold text-slate-500">Se souvenir de moi</span>
                                    </label>
                                </div>

                                <div class="pt-4">
                                    <button type="submit"
                                        class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-xl shadow-primary-500/20 text-sm font-black text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 uppercase tracking-widest transition transform hover:-translate-y-0.5">
                                        Se connecter
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="pt-6 text-base font-bold leading-6 sm:text-lg sm:leading-7 text-center">
                            <p class="text-sm text-slate-500">Pas encore de compte ?
                                <a href="{{ route('register') }}"
                                    class="text-primary-600 hover:text-primary-500 font-black">Créer un compte</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection