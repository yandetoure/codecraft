@extends('layouts.app')

@section('content')
    <div class="py-24 bg-white" x-data="{ 
        total: {{ (float) $pack->base_price }},
        features: [],
        toggleFeature(id, price) {
            if (this.features.includes(id)) {
                this.features = this.features.filter(f => f !== id);
                this.total -= price;
            } else {
                this.features.push(id);
                this.total += price;
            }
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <!-- Left: Info & Features -->
                <div class="lg:col-span-2">
                    <nav class="flex mb-8 text-sm font-bold text-slate-400 gap-2 items-center">
                        <a href="{{ route('packs.index') }}" class="hover:text-primary-600 uppercase tracking-widest">Nos
                            Packs</a>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-slate-900 uppercase tracking-widest">{{ $pack->name }}</span>
                    </nav>

                    <h1 class="text-5xl font-black text-slate-900 mb-6 tracking-tight">{{ $pack->name }}</h1>
                    <p class="text-xl text-slate-500 mb-12 leading-relaxed">{{ $pack->description }}</p>

                    <div class="space-y-12">
                        <!-- Included -->
                        <div>
                            <h3
                                class="text-lg font-black text-slate-900 border-b-2 border-slate-100 pb-4 mb-6 uppercase tracking-widest">
                                Inclus dans la solution</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($pack->features as $feature)
                                    @if($feature->pivot->is_included)
                                        <div class="p-4 rounded-2xl bg-green-50 flex items-start">
                                            <div
                                                class="shrink-0 h-6 w-6 rounded-full bg-green-200 text-green-700 flex items-center justify-center mr-4">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-900 text-sm">{{ $feature->name }}</p>
                                                <p class="text-xs text-slate-500 mt-1">{{ $feature->description }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Optional Features -->
                        <div>
                            <h3
                                class="text-lg font-black text-slate-900 border-b-2 border-slate-100 pb-4 mb-6 uppercase tracking-widest">
                                Options & Extensions</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($pack->features as $feature)
                                    @if(!$feature->pivot->is_included)
                                        <label class="cursor-pointer group">
                                            <input type="checkbox" class="hidden"
                                                @change="toggleFeature({{ $feature->id }}, {{ $feature->price }})" name="features[]"
                                                value="{{ $feature->id }}">
                                            <div class="p-6 rounded-3xl border-2 transition-all duration-300"
                                                :class="features.includes({{ $feature->id }}) ? 'bg-primary-50 border-primary-500' : 'bg-white border-slate-100 hover:border-primary-200 shadow-sm'">
                                                <div class="flex justify-between items-start mb-3">
                                                    <div class="h-10 w-10 rounded-xl flex items-center justify-center text-xl"
                                                        :class="features.includes({{ $feature->id }}) ? 'bg-primary-600 text-white' : 'bg-slate-100 text-slate-500'">
                                                        {{ $feature->icon ?? '+' }}
                                                    </div>
                                                    <span class="text-sm font-black text-primary-600">+
                                                        {{ number_format($feature->price, 0) }} FCFA</span>
                                                </div>
                                                <p class="font-bold text-slate-900 group-hover:text-primary-700 transition">
                                                    {{ $feature->name }}</p>
                                                <p class="text-xs text-slate-500 mt-2">{{ $feature->description }}</p>
                                            </div>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Order Card -->
                <div class="lg:col-span-1">
                    <div
                        class="sticky top-24 bg-slate-900 rounded-[3rem] p-10 text-white shadow-2xl shadow-indigo-200 overflow-hidden relative">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-primary-600/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2">
                        </div>

                        <h2 class="text-2xl font-black mb-8">Ma Configuration</h2>

                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-slate-400 font-bold text-sm uppercase tracking-widest">
                                <span>Solution de base</span>
                                <span class="text-white">{{ number_format($pack->base_price, 0) }} FCFA</span>
                            </div>
                            <div class="flex justify-between text-slate-400 font-bold text-sm uppercase tracking-widest"
                                x-show="features.length > 0" x-cloak>
                                <span>Options sélectionnées</span>
                                <span class="text-primary-400">+ <span
                                        x-text="number_format(total - {{ $pack->base_price }}, 0, ',', ' ')"></span>
                                    FCFA</span>
                            </div>
                        </div>

                        <div class="border-t border-white/10 pt-8 mb-10">
                            <p class="text-slate-400 font-bold text-xs uppercase tracking-[0.2em] mb-2">Total estimé</p>
                            <div class="flex flex-col">
                                <span class="text-4xl font-black text-white"
                                    x-text="number_format(total, 0, ',', ' ')"></span>
                                <span class="text-primary-400 font-black">FCFA</span>
                            </div>
                        </div>

                        <form action="{{ route('packs.order', $pack) }}" method="POST" id="order-form">
                            @csrf
                            <template x-for="id in features" :key="id">
                                <input type="hidden" name="features[]" :value="id">
                            </template>

                            <div class="space-y-4 mb-8">
                                <div>
                                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Nom
                                        du projet</label>
                                    <input type="text" name="name" required placeholder="ex: Boutique de Mode"
                                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-600 focus:outline-none focus:border-primary-500 transition">
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Mode
                                        de paiement</label>
                                    <select name="payment_type" required
                                        class="w-full bg-slate-800 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary-500 transition">
                                        <option value="total">Paiement Total</option>
                                        <option value="installment">Paiement en Versements</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit"
                                class="block w-full py-5 bg-white text-slate-900 rounded-2xl font-black text-lg hover:bg-primary-400 transition transform active:scale-95 shadow-xl shadow-black/20">Commander</button>
                        </form>

                        <p class="mt-6 text-center text-xs text-slate-500 font-medium">Une fois la commande passée, un
                            expert vous contactera pour valider le cahier des charges.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function number_format(number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ' ' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + (Math.round(n * k) / k).toFixed(prec);
                };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }
    </script>
@endsection