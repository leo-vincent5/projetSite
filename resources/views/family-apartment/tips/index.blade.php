@extends('layouts.app')

@push('styles')
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        crossorigin=""
    />
@endpush


@section('content')
<div class="min-h-screen w-full bg-stone-50 text-stone-800 pb-32">

    {{-- HEADER --}}
    <header class="fixed inset-x-0 top-0 z-50 border-b border-stone-200/60 bg-white/80 backdrop-blur-xl">
        <div class="mx-auto flex w-full max-w-6xl items-center justify-between px-6 py-4">
               <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 font-bold">
                DEOS
            </div>

            <h1 class="text-xl font-extrabold">Paris s’éveille</h1>
        </div>

            <nav class="hidden items-center gap-6 text-sm font-medium md:flex">
                <a href="{{ route('family-apartment.dashboard') }}"
                   class="{{ request()->routeIs('family-apartment.dashboard') ? 'font-bold text-emerald-600' : 'text-stone-500 hover:text-black' }}">
                    Accueil
                </a>

                <a href="{{ route('family-apartment.tips.index') }}"
                   class="{{ request()->routeIs('family-apartment.tips.*') ? 'font-bold text-emerald-600' : 'text-stone-500 hover:text-black' }}">
                    Bons plans
                </a>

                <a href="{{ route('family-apartment.infos') }}"
                   class="{{ request()->routeIs('family-apartment.infos') ? 'font-bold text-emerald-600' : 'text-stone-500 hover:text-black' }}">
                    Infos
                </a>

                <a href="{{ route('family-apartment.history') }}"
                   class="{{ request()->routeIs('family-apartment.history') ? 'font-bold text-emerald-600' : 'text-stone-500 hover:text-black' }}">
                    Historique
                </a>

                <a href="{{ route('family-apartment.bookings.create') }}"
                   class="{{ request()->routeIs('family-apartment.bookings.create') ? 'font-bold text-emerald-600' : 'text-stone-500 hover:text-black' }}">
                    Ajouter
                </a>
            </nav>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl px-6 pt-24">
        {{-- HERO --}}
        <section class="mb-8">
            <div class="relative overflow-hidden rounded-3xl shadow-sm">
                <div class="h-[220px] w-full bg-gradient-to-br from-emerald-600 via-emerald-500 to-emerald-300"></div>

                <div class="absolute inset-0 flex flex-col justify-end p-6 text-white">
                    <h2 class="text-3xl font-extrabold md:text-4xl">
                        Bons plans du coin
                    </h2>

                    <p class="mt-2 max-w-2xl text-sm text-white/90 md:text-base">
                        Les meilleures adresses et idées testées par la famille autour de l’appartement.
                    </p>
                </div>
            </div>
        </section>

        <section class="mb-8">
    <div class="overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-stone-100 px-5 py-4">
            <div>
                <h3 class="text-xl font-bold text-stone-900">Carte des bons plans</h3>
                <p class="text-sm text-stone-500">Retrouve les adresses recommandées autour de l’appartement.</p>
            </div>

            <span class="rounded-full bg-emerald-100 px-3 py-1 text-sm font-bold text-emerald-700">
                {{ $mapTips->count() }} pin{{ $mapTips->count() > 1 ? 's' : '' }}
            </span>
        </div>

        <div id="tips-map" class="h-[280px] w-full sm:h-[360px] lg:h-[420px]"></div>
    </div>
</section>

        {{-- FILTRES --}}
        <section class="mb-8 overflow-hidden">
            <div class="flex gap-3 overflow-x-auto pb-1">
                @foreach($categories as $category)
                    @php
                        $isActive = $selectedCategory === $category['key'];
                    @endphp

                    <a href="{{ route('family-apartment.tips.index', ['category' => $category['key']]) }}"
                       class="shrink-0 rounded-full px-5 py-2.5 text-sm font-medium transition
                              {{ $isActive
                                ? 'bg-emerald-600 text-white shadow-sm'
                                : 'border border-stone-200 bg-white text-stone-600 hover:bg-stone-100' }}">
                        {{ $category['label'] }}
                    </a>
                @endforeach
            </div>
        </section>

        {{-- TITRE --}}
        <section class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h3 class="text-3xl font-extrabold tracking-tight">Bons plans</h3>
                <p class="mt-1 text-stone-500">
                    Les petites adresses utiles pour profiter du séjour.
                </p>
            </div>

            <span class="inline-flex w-fit rounded-full bg-emerald-100 px-3 py-1 text-sm font-bold text-emerald-700">
                {{ $tips->count() }} recommandation{{ $tips->count() > 1 ? 's' : '' }}
            </span>
        </section>

        {{-- LISTE --}}
        <section>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse($tips as $tip)
                    <article class="overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                        <div class="relative h-48 bg-gradient-to-br from-stone-200 to-stone-100">
                            @if(!empty($tip->image))
                                <img
                                    src="{{ \Illuminate\Support\Str::startsWith($tip->image, ['http://', 'https://']) ? $tip->image : asset('storage/' . $tip->image) }}"
                                    alt="{{ $tip->title }}"
                                    class="h-full w-full object-cover"
                                >
                            @else
                                <div class="flex h-full w-full items-center justify-center text-5xl">
                                    {{ $tip->icon }}
                                </div>
                            @endif

                            <div class="absolute left-4 top-4">
                                <span class="rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $tip->category_color }}">
                                    {{ $tip->category_label }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="mb-2 flex items-start justify-between gap-3">
                                <h4 class="text-xl font-bold text-stone-900">
                                    {{ $tip->title }}
                                </h4>

                                @if(!is_null($tip->rating))
                                    <div class="flex shrink-0 items-center gap-1 text-amber-500">
                                        <span>★</span>
                                        <span class="text-sm font-bold text-stone-700">
                                            {{ number_format((float) $tip->rating, 1, ',', ' ') }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <p class="mb-4 line-clamp-3 text-sm leading-relaxed text-stone-600">
                                {{ $tip->description }}
                            </p>

                            @if(!empty($tip->address))
                                <p class="mb-4 text-sm text-stone-500">
                                    📍 {{ $tip->address }}
                                </p>
                            @endif

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-xs font-bold text-emerald-700">
                                        {{ $tip->author_initial }}
                                    </div>

                                    <span class="text-xs font-medium text-stone-500">
                                        Ajouté par {{ $tip->author_name }}
                                    </span>
                                </div>

                                <a href="{{ route('family-apartment.tips.show', $tip) }}"
                                   class="text-sm font-bold text-emerald-700 hover:underline">
                                    Voir →
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="md:col-span-2 xl:col-span-3 rounded-3xl border border-dashed border-stone-300 bg-white p-10 text-center text-stone-500">
                        Aucun bon plan dans cette catégorie.
                    </div>
                @endforelse
            </div>
        </section>
    </main>

    {{-- BOUTON AJOUT --}}
    <a href="{{ route('family-apartment.tips.create') }}"
       class="fixed bottom-24 right-6 z-40 flex h-14 w-14 items-center justify-center rounded-full bg-emerald-600 text-2xl font-bold text-white shadow-lg transition hover:scale-105 md:bottom-8">
        +
    </a>

    {{-- NAV MOBILE --}}
    <nav class="fixed inset-x-0 bottom-0 border-t bg-white py-3 md:hidden">
        <div class="flex items-center justify-around">
            <a href="{{ route('family-apartment.dashboard') }}" class="text-sm text-stone-500">Accueil</a>
            <a href="{{ route('family-apartment.tips.index') }}" class="text-sm font-bold text-emerald-600">Bons plans</a>
            <a href="{{ route('family-apartment.infos') }}" class="text-sm text-stone-500">Infos</a>
            <a href="{{ route('family-apartment.history') }}" class="text-sm text-stone-500">Historique</a>
        </div>
    </nav>
</div>
@endsection

@push('scripts')

   <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        crossorigin=""
    ></script>
<script>

    
    document.addEventListener('DOMContentLoaded', function () {
        const tips = @json($mapTips);

        const map = L.map('tips-map', {
            scrollWheelZoom: false,
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        if (!tips.length) {
            map.setView([48.8566, 2.3522], 12); // Paris par défaut
            return;
        }

        const bounds = [];

        tips.forEach((tip) => {
            const marker = L.marker([tip.lat, tip.lng]).addTo(map);

            marker.bindPopup(`
                <div style="min-width: 180px;">
                    <div style="font-weight: 700; margin-bottom: 4px;">${tip.title}</div>
                    <div style="font-size: 12px; margin-bottom: 6px;">${tip.category_label ?? ''}</div>
                    <div style="font-size: 12px; color: #666; margin-bottom: 8px;">${tip.address ?? ''}</div>
                    <a href="${tip.url}" style="color: #0f766e; font-weight: 700; text-decoration: none;">
                        Voir le bon plan →
                    </a>
                </div>
            `);

            bounds.push([tip.lat, tip.lng]);
        });

        if (bounds.length === 1) {
            map.setView(bounds[0], 15);
        } else {
            map.fitBounds(bounds, { padding: [30, 30] });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Leaflet dispo ?', typeof L !== 'undefined');
        console.log('Map tips:', @json($mapTips));
    });
</script>
@endpush

