@extends('layouts.app')

@section('content')
    @php
        $par = explode('/', $file);
        $paar2 = explode('-', $par[4]);

        $link = $par[0] . '/' . $par[1] . '/' . $par[2] . '/' . $par[3] . '/encode-' . $paar2[1];
        $link2 = $par[0] . '/' . $par[1] . '/' . $par[2] . '/' . $par[3] . '/' . $paar2[1];
    @endphp

    <div class="min-h-screen bg-[#090406] text-white">

        {{-- HERO --}}
        <section class="relative overflow-hidden border-b border-white/10">

            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(190,24,93,0.30),transparent_35%),radial-gradient(circle_at_bottom_left,rgba(251,191,36,0.16),transparent_30%)]">
            </div>

            <div class="relative mx-auto max-w-7xl px-6 py-10">

                <div class="flex flex-wrap items-center gap-4">

                    <a href="./"
                        class="inline-flex rounded-full bg-white/10 px-5 py-3 text-sm font-bold text-white ring-1 ring-white/10 transition hover:bg-white/15">
                        ← Retour à la galerie
                    </a>

                    @php
                        $essais = \App\Panier::query()
                            ->where('id_photo', '=', $photo->id)
                            ->where('id_user', '=', \Illuminate\Support\Facades\Auth::user()->id)
                            ->get();
                    @endphp

                    @if (count($essais) == 1)
                        <button id="reservePhoto" data-photo="{{ $link2 }}"
                            class="rounded-full bg-amber-300 px-5 py-3 text-sm font-bold text-[#12070d] transition hover:bg-amber-200">
                            Retirer du panier
                        </button>
                    @else
                        <button id="reservePhoto" data-photo="{{ $link2 }}"
                            class="rounded-full bg-emerald-500 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-400">
                            Ajouter au panier
                        </button>
                    @endif

                    <button id="tournerplus"
                        class="rounded-full bg-white/10 px-5 py-3 text-sm font-bold text-white ring-1 ring-white/10 transition hover:bg-white/15">
                        Tourner la photo
                    </button>

                </div>

            </div>

        </section>

        {{-- PHOTO --}}
        <section class="mx-auto max-w-7xl px-6 py-10">

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-6 shadow-[0_20px_60px_rgba(0,0,0,0.45)]">

                <div class="flex items-center justify-center overflow-hidden rounded-[1.5rem] bg-black/30 p-6">

                    <img id="photounique" data-rotate="0" src="/{{ $link }}"
                        class="max-h-[80vh] max-w-full rounded-2xl object-contain transition duration-500">

                </div>

                <div class="mt-6 flex flex-wrap items-center justify-center gap-4">

                    {{-- AJOUT PANIER --}}
                    @if (count($essais) == 1)
                        <button id="reservePhotoBottom" data-photo="{{ $link2 }}"
                            class="rounded-full bg-amber-300 px-6 py-3 text-sm font-bold text-[#12070d] transition hover:bg-amber-200">
                            Retirer du panier
                        </button>
                    @else
                        <button id="reservePhotoBottom" data-photo="{{ $link2 }}"
                            class="rounded-full bg-emerald-500 px-6 py-3 text-sm font-bold text-white transition hover:bg-emerald-400">
                            Ajouter au panier
                        </button>
                    @endif

                    {{-- INFO --}}
                    <a href="#info"
                        class="inline-flex rounded-full bg-white/10 px-5 py-3 text-sm font-bold text-white ring-1 ring-white/10 transition hover:bg-white/15">
                        + d'informations
                    </a>

                </div>

            </div>

        </section>

        {{-- INFOS --}}
        <section class="mx-auto max-w-5xl px-6 pb-16">

            @if (session('status'))
                <div
                    class="mb-8 rounded-[1.5rem] border border-emerald-500/30 bg-emerald-500/10 px-6 py-5 text-lg text-emerald-200">
                    {{ session('status') }}
                </div>
            @endif

            <div class="rounded-[2rem] border border-white/10 bg-[#160910] p-8 shadow-[0_20px_60px_rgba(0,0,0,0.45)]">

                <h2 id="info" class="text-3xl font-black">
                    Informations & Tarifs
                </h2>

                <div class="mt-8 space-y-5 text-lg text-rose-100/80">

                    <div class="rounded-2xl bg-white/5 p-5">
                        <span class="font-black text-white">
                            Prix unitaire :
                        </span>
                        5,00 € version numérique
                        <br>
                        10,00 € version tirage au format 10:15 (frais de port inclus)
                    </div>

                    <div class="rounded-2xl bg-white/5 p-5">
                        <span class="font-black text-white">
                            Pack concours :
                        </span>
                        35€ pour le pack numérique complet d'une même personne
                    </div>

                </div>

                {{-- FORMULAIRE --}}
                <div class="mt-12">

                    <h3 class="text-2xl font-black">
                        Commander votre photo en tirage
                    </h3>

                    <form method="post" action="{{ route('envoi') }}" class="mt-8 space-y-6">
                        @csrf

                        <div>

                            <label class="mb-3 block text-sm font-bold uppercase tracking-[0.2em] text-rose-100/60">
                                Adresse email
                            </label>

                            <input type="email" name="email" placeholder="Taper votre adresse mail"
                                class="w-full rounded-2xl border border-white/10 bg-white/5 px-5 py-4 text-white placeholder:text-rose-100/30 focus:border-amber-300 focus:outline-none">

                        </div>

                        <div class="space-y-4">

                            <label class="flex items-center gap-4 rounded-2xl bg-white/5 p-4 transition hover:bg-white/10">

                                <input type="checkbox" name="unite[]" value="photounite"
                                    class="h-5 w-5 rounded border-white/20 bg-white/10 text-amber-300 focus:ring-amber-300">

                                <span class="text-lg font-semibold">
                                    Photo à l'unité
                                </span>

                            </label>

                            <label class="flex items-center gap-4 rounded-2xl bg-white/5 p-4 transition hover:bg-white/10">

                                <input type="checkbox" name="unite[]" value="pack"
                                    class="h-5 w-5 rounded border-white/20 bg-white/10 text-amber-300 focus:ring-amber-300">

                                <span class="text-lg font-semibold">
                                    Pack numérique de cette personne
                                </span>

                            </label>

                        </div>

                        <div>

                            <label class="mb-3 block text-sm font-bold uppercase tracking-[0.2em] text-rose-100/60">
                                Votre message
                            </label>

                            <textarea name="text" rows="5"
                                class="w-full rounded-2xl border border-white/10 bg-white/5 px-5 py-4 text-white placeholder:text-rose-100/30 focus:border-amber-300 focus:outline-none"></textarea>

                        </div>

                        <input type="hidden" name="photo" value="{{ $file }}">

                        <button type="submit"
                            class="rounded-full bg-amber-300 px-8 py-4 text-lg font-black text-[#12070d] transition hover:bg-amber-200">
                            Envoyer la demande
                        </button>

                    </form>

                </div>

            </div>

        </section>

    </div>
@endsection


@section('js')
    <script>
     $(document).on("click", "#reservePhoto, #reservePhotoBottom", function() {

            let photo = this.dataset.photo;
            let topBtn = $("#reservePhoto");
            let bottomBtn = $("#reservePhotoBottom");

            $.ajax({
                type: "POST",
                url: "/add-panier",
                data: {
                    photo_name: photo
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(result) {
                    if (result === "success") {
topBtn.add(bottomBtn)
    .html('Ajouter au panier')
                            .removeClass('bg-emerald-500 hover:bg-emerald-400 text-white')
                            .addClass('bg-amber-300 hover:bg-amber-200 text-[#12070d]');

                        let cpt = parseInt($("#cptPanier").html()) || 0;
                        $("#cptPanier").html(cpt + 1);

                        let cptMobile = parseInt($("#cptPanierMobile").html()) || 0;
                        $("#cptPanierMobile").html(cptMobile + 1);

                    } else {

                        topBtn.add(bottomBtn)
                            .html('Ajouter au panier')
                            .removeClass('bg-amber-300 hover:bg-amber-200 text-[#12070d]')
                            .addClass('bg-emerald-500 hover:bg-emerald-400 text-white');

                        let cpt = parseInt($("#cptPanier").html()) || 0;
                        $("#cptPanier").html(Math.max(cpt - 1, 0));

                        let cptMobile = parseInt($("#cptPanierMobile").html()) || 0;
                        $("#cptPanierMobile").html(Math.max(cptMobile - 1, 0));
                    }
                }
            });
        });

        $(document).on("click", "#tournerplus", function() {

            let rotate = parseFloat($("#photounique")[0].dataset.rotate);

            $("#photounique").attr("data-rotate", rotate + 90);

            $("#photounique").css(
                "transform",
                "rotate(" + (rotate + 90) + "deg)"
            );
        });
    </script>
@endsection
