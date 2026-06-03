@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-[#090406] text-white">

        {{-- HERO --}}
        <section class="relative overflow-hidden border-b border-white/10">

            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(190,24,93,0.30),transparent_35%),radial-gradient(circle_at_bottom_left,rgba(251,191,36,0.16),transparent_30%)]">
            </div>

            <div class="relative mx-auto max-w-7xl px-6 py-20">

                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-300/70">
                    Historique
                </p>

                <h1 class="mt-4 text-4xl font-black tracking-tight sm:text-5xl">
                    Vos achats photo
                </h1>

                <p class="mt-5 max-w-2xl text-lg text-rose-100/70">
                    Retrouvez tous vos packs et vos photos achetées sur Equicode.
                </p>

            </div>

        </section>

        <section class="mx-auto max-w-7xl px-6 py-14">

            {{-- PACKS --}}
            <div class="mb-16">

                <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">

                    <div>
                        <h2 class="text-3xl font-black">
                            Vos packs photo
                        </h2>

                        <p class="mt-2 text-rose-100/60">
                            Retrouvez vos packs déjà achetés.
                        </p>
                    </div>

                    <div class="rounded-full bg-white/5 px-5 py-3 text-sm font-bold text-rose-100/70 ring-1 ring-white/10">
                        {{ count($packs) }} pack(s)
                    </div>

                </div>

                @if (count($packs) > 0)
                    <div class="grid gap-8">

                        @foreach ($packs as $pack)
                            <a href="{{ route('showPack', ['id' => $pack->id]) }}"
                                class="group overflow-hidden rounded-[2rem] border border-white/10 bg-[#160910] shadow-[0_20px_60px_rgba(0,0,0,0.35)] transition hover:-translate-y-1 hover:shadow-[0_25px_80px_rgba(190,24,93,0.25)]">

                                <div class="flex flex-col gap-6 p-6 lg:flex-row lg:items-center">

                                    <div class="overflow-hidden rounded-[1.5rem]">

                                        <img src="/{{ $pack->preview }}"
                                            class="h-[260px] w-full object-cover transition duration-700 group-hover:scale-105 lg:w-[320px]"
                                            alt="Pack photo">

                                    </div>

                                    <div class="flex-1">

                                        <div
                                            class="inline-flex rounded-full bg-amber-300 px-4 py-2 text-sm font-black text-[#12070d]">
                                            Pack acheté
                                        </div>

                                        <h3 class="mt-5 text-3xl font-black">
                                            Pack photo
                                        </h3>

                                        <p class="mt-3 text-lg text-rose-100/70">
                                            Acheté le
                                            <strong>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pack->created_at)->format('d/m/Y') }}
                                            </strong>
                                        </p>

                                        <div class="mt-6 font-bold text-amber-300 transition group-hover:translate-x-1">
                                            Voir le pack →
                                        </div>

                                    </div>

                                </div>

                            </a>
                        @endforeach

                    </div>
                @else
                    <div class="rounded-[2rem] border border-white/10 bg-white/5 px-8 py-16 text-center backdrop-blur">

                        <h3 class="text-3xl font-black">
                            Aucun pack acheté
                        </h3>

                        <p class="mt-4 text-rose-100/70">
                            Vos futurs packs apparaîtront ici.
                        </p>

                    </div>
                @endif

            </div>

            {{-- PHOTOS UNITAIRES --}}
            <div>

                <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">

                    <div>
                        <h2 class="text-3xl font-black">
                            Vos photos achetées à l’unité
                        </h2>

                        <p class="mt-2 text-rose-100/60">
                            Téléchargez et retrouvez vos souvenirs.
                        </p>
                    </div>

                    <div class="rounded-full bg-white/5 px-5 py-3 text-sm font-bold text-rose-100/70 ring-1 ring-white/10">
                        {{ count($achats) }} photo(s)
                    </div>

                </div>

                @if (count($achats) > 0)
                    <div class="grid gap-8 sm:grid-cols-2 xl:grid-cols-3">

                        @foreach ($achats as $achat)
                            @php
                                $result = explode('/', $achat->photo()->first()->name);
                                $newResult = '';
                                $cpt = 0;

                                foreach ($result as $item) {
                                    $cpt++;

                                    if ($cpt != count($result)) {
                                        $newResult .= $item . '/';
                                    }
                                }

                                $url = $newResult . 'traiter-' . $achat->photo()->first()->encode . '.jpg';
                            @endphp

                            <div
                                class="group overflow-hidden rounded-[2rem] border border-white/10 bg-[#160910] shadow-[0_20px_60px_rgba(0,0,0,0.35)] transition hover:-translate-y-1 hover:shadow-[0_25px_80px_rgba(190,24,93,0.25)]">

                                <div class="relative aspect-[4/5] overflow-hidden">

                                    <img src="{{ $url }}"
                                        class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                        alt="Photo achetée">

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent">
                                    </div>

                                    <div
                                        class="absolute bottom-0 left-0 right-0 flex items-center justify-between gap-3 p-5">

                                        <div
                                            class="inline-flex rounded-full bg-emerald-500 px-4 py-2 text-sm font-black text-white">
                                            Photo achetée
                                        </div>

                                        <a href="{{ $url }}" download
                                            class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-amber-300 to-yellow-500 px-4 py-2 text-xs font-black text-[#12070d] shadow-lg shadow-amber-500/20 transition hover:scale-[1.02]">
                                            Télécharger
                                        </a>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="rounded-[2rem] border border-white/10 bg-white/5 px-8 py-16 text-center backdrop-blur">

                        <h3 class="text-3xl font-black">
                            Aucune photo achetée
                        </h3>

                        <p class="mt-4 text-rose-100/70">
                            Vos futures photos apparaîtront ici.
                        </p>

                    </div>
                @endif

            </div>

        </section>

    </div>

@endsection
