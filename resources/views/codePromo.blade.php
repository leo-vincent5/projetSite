@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#050505] text-white py-10 overflow-hidden relative">

    {{-- BACKGROUND GLOW --}}
    <div class="absolute top-0 left-0 w-[40rem] h-[40rem] bg-purple-700/20 blur-3xl rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[35rem] h-[35rem] bg-yellow-400/10 blur-3xl rounded-full"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ALERTES --}}
        @if(session()->has('success'))
            <div class="mb-5 rounded-3xl border border-emerald-500/30 bg-emerald-500/10 backdrop-blur-xl px-6 py-4 text-emerald-200 shadow-2xl">
                {!! session()->get('success') !!}
            </div>
        @endif

        <div id="success"
             class="hidden mb-5 rounded-3xl border border-emerald-500/30 bg-emerald-500/10 backdrop-blur-xl px-6 py-4 text-emerald-200 shadow-2xl">
        </div>

        <div id="error"
             class="hidden mb-5 rounded-3xl border border-red-500/30 bg-red-500/10 backdrop-blur-xl px-6 py-4 text-red-200 shadow-2xl">
        </div>

        @if(session()->has('errors'))
            <div class="mb-5 rounded-3xl border border-red-500/30 bg-red-500/10 backdrop-blur-xl px-6 py-4 text-red-200 shadow-2xl">
                {{ session()->get('errors') }}
            </div>
        @endif

        {{-- HERO --}}
        <div class="relative overflow-hidden rounded-[2rem] border border-yellow-400/30 bg-gradient-to-br from-[#1a1028] via-[#10070f] to-[#050505] shadow-[0_0_80px_rgba(168,85,247,0.35)] mb-10">

            <div class="absolute -top-24 -right-20 w-80 h-80 bg-purple-600/40 blur-3xl rounded-full"></div>
            <div class="absolute -bottom-24 -left-20 w-80 h-80 bg-yellow-400/25 blur-3xl rounded-full"></div>

            <div class="relative p-8 sm:p-12">

                <div class="inline-flex items-center gap-2 rounded-full border border-yellow-300/50 bg-yellow-300/15 px-5 py-2 text-sm font-black text-yellow-200 shadow-lg shadow-yellow-500/10 mb-8">
                    ✨ Code promo Equicode
                </div>

                <h1 class="text-4xl sm:text-6xl font-black leading-tight bg-gradient-to-r from-yellow-200 via-yellow-400 to-purple-300 bg-clip-text text-transparent">
                    Débloquez vos photos
                </h1>

                <p class="mt-6 max-w-2xl text-lg text-gray-200 leading-relaxed">
                    Utilisez vos crédits promo pour récupérer gratuitement vos clichés favoris en qualité HD.
                </p>

            </div>
        </div>

        {{-- ETAPES --}}
        <div class="grid gap-5 md:grid-cols-3 mb-10">

            @foreach([
                ['num' => 1, 'title' => 'Ajoutez une photo', 'text' => 'Sélectionnez une photo depuis la galerie.', 'color' => 'from-purple-500 to-fuchsia-600'],
                ['num' => 2, 'title' => 'Entrez votre code', 'text' => 'Chaque code ajoute des crédits photo à utiliser immédiatement.', 'color' => 'from-yellow-300 to-yellow-500'],
                ['num' => 3, 'title' => 'Débloquez vos photos', 'text' => 'Utilisez 1 crédit pour récupérer une photo HD.', 'color' => 'from-purple-600 to-yellow-400'],
            ] as $step)

                <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-gradient-to-br from-[#211827] to-[#0c070b] p-7 shadow-[0_0_40px_rgba(168,85,247,0.18)] hover:border-yellow-300/40 hover:-translate-y-1 transition-all duration-300">

                    <div class="absolute -top-16 -right-16 w-40 h-40 bg-purple-500/20 blur-3xl rounded-full"></div>

                    <div class="relative">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $step['color'] }} flex items-center justify-center text-black text-2xl font-black shadow-xl mb-6">
                            {{ $step['num'] }}
                        </div>

                        <h3 class="text-xl font-black text-white mb-3">
                            {{ $step['title'] }}
                        </h3>

                        <p class="text-gray-300 leading-relaxed">
                            @if($step['num'] === 1)
                                Sélectionnez une photo depuis
                                <a href="{{ route('gallery') }}" class="text-yellow-300 font-black hover:underline">
                                    la galerie
                                </a>.
                            @else
                                {{ $step['text'] }}
                            @endif
                        </p>
                    </div>
                </div>

            @endforeach

        </div>

        {{-- FORMULAIRE --}}
        <div class="relative overflow-hidden rounded-[2rem] border border-purple-400/30 bg-gradient-to-br from-[#20112c] via-[#120910] to-[#080808] p-7 sm:p-8 shadow-[0_0_70px_rgba(168,85,247,0.25)] mb-8">

            <div class="absolute -top-20 right-10 w-64 h-64 bg-purple-600/30 blur-3xl rounded-full"></div>
            <div class="absolute -bottom-24 left-10 w-64 h-64 bg-yellow-400/20 blur-3xl rounded-full"></div>

            <div class="relative">

                <h2 class="text-3xl font-black mb-6 bg-gradient-to-r from-yellow-200 to-purple-300 bg-clip-text text-transparent">
                    Entrer un code promo
                </h2>

                <div class="flex flex-col sm:flex-row gap-4">

                    <input
                        type="text"
                        id="codePromo"
                        placeholder="Exemple : SPIRIT5"
                        class="flex-1 rounded-2xl border border-yellow-300/20 bg-black/40 px-6 py-4 text-lg text-white placeholder:text-gray-500 outline-none focus:border-yellow-300 focus:ring-4 focus:ring-yellow-400/20 transition-all"
                    >

                    <button
                        id="valider"
                        class="rounded-2xl bg-gradient-to-r from-yellow-300 via-yellow-500 to-yellow-300 px-9 py-4 text-lg font-black text-black shadow-[0_0_35px_rgba(250,204,21,0.35)] hover:scale-[1.04] hover:shadow-[0_0_55px_rgba(250,204,21,0.5)] transition-all duration-300">
                        Valider
                    </button>

                </div>

                <p class="mt-4 text-sm text-gray-400">
                    Attention, le nombre d’essais est limité afin d’éviter toute tentative de fraude.
                </p>

            </div>
        </div>

        {{-- CREDIT --}}
        <div class="relative overflow-hidden rounded-[2rem] border border-yellow-400/20 bg-gradient-to-r from-[#171717] via-[#1d1425] to-[#171717] p-7 shadow-[0_0_60px_rgba(250,204,21,0.08)] mb-10">

            <div class="absolute inset-0 opacity-30 bg-[radial-gradient(circle_at_top_left,rgba(250,204,21,0.15),transparent_35%)]"></div>

            <div class="relative">

                @if ($nbPhoto == null)

                    <h2 class="text-2xl font-black text-yellow-200">
                        Vous n’avez actuellement aucun crédit photo.
                    </h2>

                @else

                    <div class="flex flex-wrap items-center gap-4">

                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-yellow-300 to-yellow-500 text-black flex items-center justify-center text-2xl font-black shadow-xl">
                            <span id="cptPhoto">{{ $nbPhoto->nb_photo }}</span>
                        </div>

                        <div>
                            <h2 class="text-2xl sm:text-3xl font-black">
                                Crédit(s) disponible(s)
                            </h2>

                            <p class="text-gray-400 mt-1">
                                Utilisez-les pour débloquer vos photos HD.
                            </p>
                        </div>

                    </div>

                @endif

            </div>
        </div>

        {{-- PHOTOS --}}
        <div class="space-y-6">

            @forelse($paniers as $panier)

                @php
                    $photo = $panier->photo()->first();
                @endphp

                <div class="group rounded-[2rem] border border-white/10 bg-gradient-to-br from-[#1a1a1a] to-[#0a0a0a] backdrop-blur-xl overflow-hidden hover:border-purple-400/30 hover:shadow-[0_0_60px_rgba(168,85,247,0.18)] transition-all duration-300">

                    <div class="flex flex-col lg:flex-row items-center gap-6 p-5">

                        {{-- IMAGE --}}
                        <div class="relative overflow-hidden rounded-[1.5rem] bg-black/40 border border-white/10 w-full lg:w-[340px]">

                            <img
                                src="/{{ $photo->name_notbuy }}"
                                alt="Photo"
                                class="w-full h-[320px] object-cover group-hover:scale-105 transition duration-500"
                            >

                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                        </div>

                        {{-- TEXTE --}}
                        <div class="flex-1">

                            <div class="inline-flex items-center gap-2 rounded-full bg-purple-500/10 border border-purple-400/20 px-4 py-2 text-sm font-bold text-purple-200 mb-4">
                                📸 Photo prête à être débloquée
                            </div>

                            <h3 class="text-3xl font-black mb-3">
                                Débloquez cette photo en HD
                            </h3>

                            <p class="text-gray-400 leading-relaxed max-w-xl">
                                Utilisez un crédit promo pour récupérer cette photo en haute qualité sans paiement supplémentaire.
                            </p>

                            <div class="mt-6">

                                <a
                                    href="{{ route('useCodePromo', ['id' => $photo->id]) }}"
                                    data-id="{{ $photo->id }}"
                                    class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-purple-600 via-fuchsia-600 to-purple-700 px-7 py-4 text-lg font-black text-white shadow-2xl shadow-purple-900/40 hover:scale-[1.03] hover:shadow-[0_0_45px_rgba(168,85,247,0.45)] transition-all duration-300">

                                    Débloquer pour 1 crédit ✨
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="rounded-[2rem] border border-white/10 bg-gradient-to-br from-[#1a1a1a] to-[#090909] backdrop-blur-xl p-12 text-center">

                    <div class="text-6xl mb-5">📸</div>

                    <h3 class="text-3xl font-black mb-3">
                        Aucune photo dans votre panier
                    </h3>

                    <p class="text-gray-400 max-w-xl mx-auto leading-relaxed">
                        Rendez-vous dans la galerie pour sélectionner vos plus beaux clichés avant d’utiliser vos crédits promo.
                    </p>

                    <a
                        href="{{ route('gallery') }}"
                        class="mt-7 inline-flex rounded-2xl bg-gradient-to-r from-yellow-300 via-yellow-500 to-yellow-300 px-7 py-4 text-lg font-black text-black shadow-[0_0_35px_rgba(250,204,21,0.35)] hover:scale-[1.03] transition-all duration-300">

                        Voir la galerie
                    </a>

                </div>

            @endforelse

        </div>

    </div>
</div>
@endsection

@section('js')
<script>

    $(document).ready(function () {

        $("#error").hide();
        $("#success").hide();

        $("#codePromo").keydown(function(e) {

            if(e.code === 'Enter') {
                $("#valider").click();
            }

        });

    });

    $(document).on('click','#valider',function () {

        let codePromo = $("#codePromo").val();

        $("#error").hide().html('');
        $("#success").hide().html('');

        $.ajax({
            type: "POST",
            url: "/sendCodePromo",
            data: {
                codePromo: codePromo,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function (result) {

                if(result['success'] === undefined){

                    $("#error")
                        .html(result['errors'])
                        .fadeIn(200);

                } else {

                    $("#success")
                        .html(result['success'])
                        .fadeIn(200);

                    $("#cptPhoto").html(result['nb']);

                }

            },

            error: function () {

                $("#error")
                    .html("Une erreur est survenue, merci de réessayer.")
                    .fadeIn(200);

            }

        });

    });

</script>
@endsection