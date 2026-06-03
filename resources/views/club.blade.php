@extends('layouts.app')

@section('content')
    @csrf

    <div class="min-h-screen bg-[#090406] text-white">

        {{-- HERO --}}
        <section class="relative overflow-hidden border-b border-white/10">

            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(190,24,93,0.30),transparent_35%),radial-gradient(circle_at_bottom_left,rgba(251,191,36,0.16),transparent_30%)]">
            </div>

            <div class="relative mx-auto max-w-7xl px-6 py-12">

                <a href="./"
                   class="inline-flex rounded-full bg-white/10 px-5 py-3 text-sm font-bold text-white ring-1 ring-white/10 transition hover:bg-white/15">
                    ← Retour aux choix
                </a>

                <h1 class="mt-8 text-4xl font-black sm:text-5xl">
                    {{ str_replace('_', ' ', $club) }}
                </h1>

                <p class="mt-4 text-rose-100/70">
                    Choisissez vos photos et ajoutez-les à votre panier.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">

                    <button id="packBuy"
                            class="rounded-full bg-emerald-500 px-6 py-3 font-bold text-white transition hover:bg-emerald-400">
                        Acheter le pack complet
                    </button>

                </div>

            </div>

        </section>

        {{-- GALERIE --}}
        <section class="mx-auto max-w-7xl px-6 py-12">

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

                @foreach ($files as $file)

                    @if (preg_match('/vignette/i', $file) > 0 && strpos($file, 'preview') != true)

                        @php
                            $photoName = 'img/galerie/' . $name . '/' . $club . '/' . str_replace('vignette-', 'encode-', $file);
                        @endphp

                        <div
                            class="group overflow-hidden rounded-[2rem] border border-white/10 bg-[#160910] shadow-[0_20px_60px_rgba(0,0,0,0.45)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_25px_80px_rgba(190,24,93,0.25)]">

                            <div class="relative aspect-[4/5] overflow-hidden">

                                <img
                                    src="/img/galerie/{{ $name }}/{{ $club }}/{{ $file }}"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                    alt="Photo {{ $file }}"
                                >

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent">
                                </div>

                                <div class="absolute bottom-0 left-0 right-0 z-20 p-5">

                                    <div class="grid grid-cols-2 gap-3">

                                        {{-- VOIR PHOTO --}}
                                        <a
                                            href="{{ route('reserve', ['name' => $name, 'club' => $club, 'file' => $file]) }}"
                                            class="rounded-full bg-white/20 px-4 py-3 text-center text-sm font-bold text-white backdrop-blur transition hover:bg-amber-300 hover:text-[#12070d]"
                                        >
                                            Voir
                                        </a>

                                        {{-- AJOUT PANIER --}}
                                        <button
                                            type="button"
                                            class="addSpeed rounded-full bg-white/10 px-4 py-3 text-sm font-bold text-white ring-1 ring-white/10 backdrop-blur transition hover:bg-emerald-500"
                                            data-id="{{ $photoName }}"
                                        >
                                            + Panier
                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endif

                @endforeach

            </div>

        </section>

    </div>
@endsection

@section('js')
<script>

    $(document).ready(function () {

        // ACHAT PACK
     $(document).on("click", "#packBuy", function () {
    let tab = [];

    $(".addSpeed").each(function () {
        tab.push($(this).data("id"));
    });

    let cle = window.location.pathname.replace(/^\/galerie\//, "img/galerie/");

    $.ajax({
        type: "POST",
        url: "/add_pack",
        data: {
            cle: cle,
            tab: tab
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function (result) {
            if (result === "good") {
                window.location.href = "/panier";
            } else {
                console.log(result);
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});

        // AJOUT RAPIDE PANIER
        $(document).on("click", ".addSpeed", function (event) {

            event.preventDefault();
            event.stopPropagation();

            let photo = $(this).data("id");
            let thissave = $(this);

            console.log("photo envoyée :", photo);

            $.ajax({
                type: "POST",
                url: "/add_panier_speed",
                data: {
                    photo_name: photo
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {

                    let currentDesktop = parseInt($("#cptPanier").html()) || 0;
                    let currentMobile = parseInt($("#cptPanierMobile").html()) || 0;

                    if (result === "good") {

                        $("#cptPanier").html(currentDesktop + 1);
                        $("#cptPanierMobile").html(currentMobile + 1);

                        thissave
                            .removeClass('bg-white/10 hover:bg-emerald-500')
                            .addClass('bg-emerald-500')
                            .html("✓ Ajouté");

                    } else {

                        $("#cptPanier").html(Math.max(currentDesktop - 1, 0));
                        $("#cptPanierMobile").html(Math.max(currentMobile - 1, 0));

                        thissave
                            .removeClass('bg-emerald-500')
                            .addClass('bg-white/10 hover:bg-emerald-500')
                            .html("+ Panier");
                    }

                }
            });

        });

    });

</script>
@endsection