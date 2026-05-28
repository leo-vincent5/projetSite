@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#090406] text-white">

    {{-- HERO --}}
    <section class="relative overflow-hidden border-b border-white/10">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(190,24,93,0.30),transparent_35%),radial-gradient(circle_at_bottom_left,rgba(251,191,36,0.16),transparent_30%)]"></div>

        <div class="relative mx-auto max-w-7xl px-6 py-20">

            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-300/70">
                Espace client
            </p>

            <h1 class="mt-4 text-4xl font-black tracking-tight sm:text-5xl">
                Bonjour {{ Auth::user()->name ?? '' }}
            </h1>

            <p class="mt-5 max-w-2xl text-lg text-rose-100/70">
                Retrouvez vos photos, votre panier et les galeries disponibles.
            </p>

        </div>
    </section>

    {{-- CONTENU --}}
    <section class="mx-auto mt-5 max-w-7xl px-6 py-14">

        @if (session('status'))
            <div class="mb-8 rounded-[1.5rem] border border-emerald-500/30 bg-emerald-500/10 px-6 py-5 text-emerald-200">
                {{ session('status') }}
            </div>
        @endif

        <div class="grid gap-8 md:grid-cols-3">

            <a
                href="{{ route('history') }}"
                class="group rounded-[2rem] border border-white/10 bg-[#160910] p-8 shadow-[0_20px_60px_rgba(0,0,0,0.35)] transition hover:-translate-y-1 hover:shadow-[0_25px_80px_rgba(190,24,93,0.25)]"
            >
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-300 text-2xl font-black text-[#12070d]">
                    📸
                </div>

                <h2 class="text-2xl font-black">
                    Mes photos achetées
                </h2>

                <p class="mt-3 text-rose-100/65">
                    Accédez aux photos que vous avez déjà achetées.
                </p>

                <div class="mt-6 font-bold text-amber-300 transition group-hover:translate-x-1">
                    Voir mes photos →
                </div>
            </a>

            <a
                href="{{ route('panier') }}"
                class="group rounded-[2rem] border border-white/10 bg-[#160910] p-8 shadow-[0_20px_60px_rgba(0,0,0,0.35)] transition hover:-translate-y-1 hover:shadow-[0_25px_80px_rgba(190,24,93,0.25)]"
            >
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-500 text-2xl font-black text-white">
                    🛒
                </div>

                <h2 class="text-2xl font-black">
                    Votre panier
                </h2>

                <p class="mt-3 text-rose-100/65">
                    Retrouvez vos photos sélectionnées avant paiement.
                </p>

                <div class="mt-6 font-bold text-emerald-300 transition group-hover:translate-x-1">
                    Voir le panier →
                </div>
            </a>

            <a
                href="{{ route('gallery') }}"
                class="group rounded-[2rem] border border-white/10 bg-[#160910] p-8 shadow-[0_20px_60px_rgba(0,0,0,0.35)] transition hover:-translate-y-1 hover:shadow-[0_25px_80px_rgba(190,24,93,0.25)]"
            >
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10 text-2xl font-black text-white ring-1 ring-white/10">
                    ✨
                </div>

                <h2 class="text-2xl font-black">
                    Galeries disponibles
                </h2>

                <p class="mt-3 text-rose-100/65">
                    Découvrez les événements et photos disponibles.
                </p>

                <div class="mt-6 font-bold text-rose-100 transition group-hover:translate-x-1">
                    Voir les galeries →
                </div>
            </a>

        </div>

    </section>

</div>

@endsection