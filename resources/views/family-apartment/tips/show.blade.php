@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endpush

@section('content')
    <div class="min-h-screen bg-stone-50 text-stone-800 pb-32">

        {{-- HEADER --}}
        <header
            class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-xl flex items-center justify-between px-6 h-16 border-b">
            <div class="flex items-center gap-4">
                <a href="{{ route('family-apartment.tips.index') }}" class="text-emerald-600">←</a>
                <h1 class="text-xl font-bold">Bon Plan</h1>
            </div>
        </header>

        <main class="pt-20 max-w-5xl mx-auto px-4 md:px-8">

            {{-- IMAGE HERO --}}
            <section class="mb-10">
                <div class="relative w-full h-[350px] md:h-[530px] rounded-xl overflow-hidden shadow-lg">
                    @if ($tip->image_url)
                        <img src="{{ $tip->image_url }}" alt="{{ $tip->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex h-full w-full items-center justify-center bg-stone-100 text-6xl">
                            {{ $tip->icon }}
                        </div>
                    @endif

                    <div class="absolute top-6 left-6">
                        <span
                            class="rounded-full bg-emerald-100 px-5 py-2 text-sm font-semibold tracking-wide text-emerald-700 shadow-sm">
                            {{ $tip->category_label }}
                        </span>
                    </div>
                </div>
            </section>
            {{-- HEADER --}}
            <section class="mb-10">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">

                    <div>
                        <h2 class="text-4xl font-extrabold mb-3">
                            {{ $tip->title }}
                        </h2>

                        <div class="flex items-center gap-4">

                            {{-- NOTE --}}
                            @if ($tip->rating)
                                <div class="flex items-center bg-amber-100 px-3 py-1 rounded-full gap-1">
                                    <span class="text-amber-500">★</span>
                                    <span class="font-bold text-sm">{{ $tip->rating }}/5</span>
                                </div>
                            @endif

                            {{-- USER --}}
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-xs font-bold">
                                    {{ $tip->author_initial }}
                                </div>

                                <span class="text-sm text-stone-500">
                                    Posté par {{ $tip->author_name }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- GOOGLE MAPS --}}
                    @if ($tip->lat && $tip->lng)
                        <a href="https://www.google.com/maps?q={{ $tip->lat }},{{ $tip->lng }}" target="_blank"
                            class="bg-emerald-600 text-white px-6 py-3 rounded-full font-bold hover:scale-105 transition">
                            Ouvrir sur Maps
                        </a>
                    @endif

                </div>
            </section>

            {{-- CONTENU --}}
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

                {{-- DESCRIPTION --}}
                <div class="md:col-span-8 space-y-6">

                    <div class="bg-white p-6 rounded-xl shadow">
                        <h3 class="text-xl font-bold mb-4">Avis de la famille</h3>

                        <p class="text-stone-600 leading-relaxed">
                            {{ $tip->description ?? 'Aucune description pour le moment.' }}
                        </p>
                    </div>

                </div>

                {{-- SIDEBAR --}}
                <div class="md:col-span-4 space-y-6">

                    {{-- INFOS --}}
                    <div class="bg-white p-6 rounded-xl border">
                        <h3 class="font-bold mb-4">Infos pratiques</h3>

                        @if ($tip->address)
                            <p class="text-sm text-stone-500 mb-2">
                                📍 {{ $tip->address }}
                            </p>
                        @endif

                        @if ($tip->lat && $tip->lng)
                            <p class="text-xs text-stone-400">
                                {{ $tip->lat }}, {{ $tip->lng }}
                            </p>
                        @endif
                    </div>

                    {{-- MAP --}}
                    @if ($tip->lat && $tip->lng)
                        <div class="bg-white rounded-xl overflow-hidden border">
                            <div id="tip-map" class="h-64"></div>
                        </div>
                    @endif

                </div>

            </div>
        </main>
    </div>
@endsection

@push('scripts')
    @if ($tip->lat && $tip->lng)
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const map = L.map('tip-map', {
                    scrollWheelZoom: false
                }).setView([{{ $tip->lat }}, {{ $tip->lng }}], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap'
                }).addTo(map);

                L.marker([{{ $tip->lat }}, {{ $tip->lng }}]).addTo(map)
                    .bindPopup(`{{ addslashes($tip->title) }}`)
                    .openPopup();

            });
        </script>
    @endif
@endpush
