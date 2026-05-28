@extends("layouts.app")

@section("content")

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-[#12070d] text-white">

        {{-- LUEURS --}}
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_75%_20%,rgba(190,24,93,0.45),transparent_35%),radial-gradient(circle_at_20%_80%,rgba(180,83,9,0.35),transparent_35%)]"></div>

        <div class="relative mx-auto max-w-7xl px-6 py-24 text-center">

            <p class="mb-3 text-sm font-semibold uppercase tracking-[0.30em] text-amber-300/70">
                Equicode
            </p>

            <h1 class="text-4xl font-black tracking-tight sm:text-5xl md:text-6xl">
                Galeries photos
            </h1>

            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-rose-100/80">
                Retrouvez vos souvenirs et vos plus beaux instants capturés par Equicode.
            </p>

        </div>

    </section>

    {{-- GALERIES --}}
    <section class="bg-[#090406] py-12 sm:py-16">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

                @forelse($files as $file)

                    @continue($file === "." || $file === "..")

                    @php
                        $previewPath = public_path('img/galerie/' . $file . '/preview.jpg');
                        $hasPreview = file_exists($previewPath);
                    @endphp

                    <a
                        href="{{ route('under-galerie', ['name' => $file]) }}"
                        class="group block overflow-hidden rounded-[2rem] bg-[#160910] shadow-[0_20px_60px_rgba(0,0,0,0.45)] ring-1 ring-white/10 transition duration-300 hover:-translate-y-1 hover:shadow-[0_25px_80px_rgba(190,24,93,0.25)]"
                    >

                        @if($hasPreview)

                            <div class="relative aspect-[4/3] overflow-hidden">

                                <img
                                    src="{{ asset('img/galerie/' . $file . '/preview.jpg') }}"
                                    alt="Galerie {{ $file }}"
                                    class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                >

                                {{-- OVERLAY --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-[#050205] via-[#12070d]/45 to-transparent"></div>

                                {{-- CONTENU --}}
                                <div class="absolute bottom-0 left-0 right-0 p-6">

                                    <h2 class="text-2xl font-black text-white drop-shadow-lg">
                                        {{ str_replace('_', ' ', $file) }}
                                    </h2>

                                    <span class="mt-4 inline-flex rounded-full bg-white/15 px-4 py-2 text-sm font-medium text-white backdrop-blur transition group-hover:bg-amber-300 group-hover:text-[#12070d]">
                                        Voir la galerie
                                    </span>

                                </div>

                            </div>

                        @else

                            {{-- PAS ENCORE DE PREVIEW --}}
                            <div class="relative flex aspect-[4/3] items-center justify-center overflow-hidden bg-[radial-gradient(circle_at_70%_20%,rgba(190,24,93,0.35),transparent_35%),linear-gradient(135deg,#1a0810,#050205)] p-6">

                                <div class="text-center text-white">

                                    {{-- SPINNER --}}
                                    <div class="mx-auto mb-6 h-16 w-16 animate-spin rounded-full border-4 border-white/20 border-t-amber-300"></div>

                                    <h2 class="text-3xl font-black drop-shadow">
                                        {{ str_replace('_', ' ', $file) }}
                                    </h2>

                                    <p class="mt-3 text-rose-100/70">
                                        Traitement en cours
                                    </p>

                                    <span class="mt-5 inline-flex rounded-full bg-white/10 px-4 py-2 text-sm font-medium text-white backdrop-blur">
                                        Photos bientôt disponibles
                                    </span>

                                </div>

                            </div>

                        @endif

                    </a>

                @empty

                    <div class="col-span-full">

                        <div class="rounded-[2rem] border border-white/10 bg-white/5 px-6 py-16 text-center backdrop-blur">

                            <h2 class="text-3xl font-black text-white">
                                Aucune galerie disponible
                            </h2>

                            <p class="mt-3 text-rose-100/70">
                                Les photos seront bientôt en ligne.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </section>

@endsection