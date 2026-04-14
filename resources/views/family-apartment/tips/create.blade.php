@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
@endpush

@section('content')
    <div class="min-h-screen w-full bg-stone-50 text-stone-800 pb-32">

        {{-- HEADER --}}
        <header class="fixed inset-x-0 top-0 z-50 border-b border-stone-200/60 bg-white/80 backdrop-blur-xl">
            <div class="mx-auto flex w-full max-w-3xl items-center justify-between px-6 py-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('family-apartment.tips.index') }}"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-full text-emerald-700 transition hover:bg-stone-100">
                        ←
                    </a>

                    <h1 class="text-2xl font-bold tracking-tight text-emerald-700">
                        Ajouter un bon plan
                    </h1>
                </div>

                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 font-bold">
                    EH
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-3xl px-6 pt-24">
            <section class="relative mb-10 overflow-hidden rounded-3xl bg-amber-100 p-8">
                <div class="relative z-10">
                    <h2 class="mb-2 text-3xl font-extrabold leading-tight text-amber-900">
                        Partage une
                        <br>
                        nouvelle pépite.
                    </h2>

                    <p class="font-medium text-amber-800/80">
                        Un parc, un resto, un coin secret ?
                    </p>
                </div>

                <div class="pointer-events-none absolute -bottom-6 -right-6 text-8xl opacity-10">
                    ❤
                </div>
            </section>

            @if ($errors->any())
                <div class="mb-6 rounded-3xl border border-red-200 bg-red-50 p-5 text-red-800 shadow-sm">
                    <p class="mb-2 font-bold">Le formulaire contient quelques erreurs :</p>
                    <ul class="space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('family-apartment.tips.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-8">
                @csrf

                {{-- NOM --}}
                <div class="space-y-3">
                    <label for="title" class="px-1 text-sm font-semibold uppercase tracking-wide text-stone-500">
                        Nom du lieu
                    </label>

                    <input id="title" name="title" type="text" value="{{ old('title') }}"
                        placeholder="Ex : Le Jardin des Curieux"
                        class="w-full rounded-2xl border-0 bg-stone-100 px-6 py-4 text-lg font-medium placeholder:text-stone-400 focus:ring-2 focus:ring-emerald-300">
                </div>

                {{-- CATEGORIE --}}
                <div class="space-y-3">
                    <label class="px-1 text-sm font-semibold uppercase tracking-wide text-stone-500">
                        Catégorie
                    </label>

                    <div class="flex flex-wrap gap-2">
                        @php
                            $categoryOptions = [
                                'food' => 'Restaurant',
                                'nature' => 'Parc & Nature',
                                'culture' => 'Culture',
                                'practical' => 'Activités',
                            ];
                        @endphp

                        @foreach ($categoryOptions as $value => $label)
                            <label class="cursor-pointer">
                                <input type="radio" name="category" value="{{ $value }}" class="peer sr-only"
                                    {{ old('category') === $value ? 'checked' : '' }}>

                                <span
                                    class="inline-flex rounded-full border border-stone-200 bg-white px-5 py-2.5 font-medium text-stone-600 transition peer-checked:border-emerald-600 peer-checked:bg-emerald-600 peer-checked:text-white hover:bg-stone-100">
                                    {{ $label }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- LOCALISATION --}}
                <div class="space-y-3">
                    <label for="address" class="px-1 text-sm font-semibold uppercase tracking-wide text-stone-500">
                        Localisation
                    </label>

                    <div class="grid grid-cols-1 gap-3 md:grid-cols-[1fr_auto]">
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-stone-400">
                                📍
                            </span>

                            <input id="address" name="address" type="text" value="{{ old('address') }}"
                                placeholder="Adresse ou indication du lieu"
                                class="w-full rounded-2xl border-0 bg-stone-100 py-4 pl-12 pr-6 font-medium placeholder:text-stone-400 focus:ring-2 focus:ring-emerald-300">
                        </div>

                        <button id="geocode-address-btn" type="button"
                            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-100 px-6 py-4 font-bold text-emerald-800 shadow-sm transition active:scale-95">
                            <span>🗺️</span>
                            <span>Placer sur la carte</span>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <input id="lat" name="lat" type="text" value="{{ old('lat') }}"
                            placeholder="Latitude"
                            class="w-full rounded-2xl border-0 bg-stone-100 px-5 py-4 font-medium placeholder:text-stone-400 focus:ring-2 focus:ring-emerald-300">

                        <input id="lng" name="lng" type="text" value="{{ old('lng') }}"
                            placeholder="Longitude"
                            class="w-full rounded-2xl border-0 bg-stone-100 px-5 py-4 font-medium placeholder:text-stone-400 focus:ring-2 focus:ring-emerald-300">
                    </div>

                    <div id="geocode-status" class="text-sm text-stone-500"></div>

                    <div class="overflow-hidden rounded-2xl border border-stone-200 bg-stone-100">
                        <div id="tip-create-map" class="h-64 w-full"></div>
                    </div>

                    <p class="text-sm text-stone-500">
                        Astuce : clique directement sur la carte pour placer le point exactement où tu veux.
                    </p>
                </div>

                <div class="space-y-3">
                    <label class="px-1 text-sm font-semibold uppercase tracking-wide text-stone-500">
                        Note de la famille
                    </label>

                    <div id="rating-stars" class="flex flex-wrap gap-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button"
                                class="rating-star inline-flex h-12 w-12 items-center justify-center rounded-full border border-stone-200 bg-white text-2xl transition hover:scale-105"
                                data-value="{{ $i }}" aria-label="Donner la note {{ $i }} sur 5">
                                ★
                            </button>
                        @endfor
                    </div>

                    <input type="hidden" name="rating" id="rating" value="{{ old('rating') }}">

                    <p id="rating-label" class="text-sm text-stone-400">
                        Choisis une note de 1 à 5.
                    </p>
                </div>

                {{-- DESCRIPTION --}}
                <div class="space-y-3">
                    <label for="description" class="px-1 text-sm font-semibold uppercase tracking-wide text-stone-500">
                        Votre avis
                    </label>

                    <textarea id="description" name="description" rows="5"
                        placeholder="Qu’est-ce qui vous a plu ? Pourquoi c’est un bon plan ?"
                        class="w-full resize-none rounded-2xl border-0 bg-stone-100 px-6 py-4 font-medium placeholder:text-stone-400 focus:ring-2 focus:ring-emerald-300">{{ old('description') }}</textarea>
                </div>

                {{-- IMAGE --}}
                <div class="space-y-3">
                    <label for="image" class="px-1 text-sm font-semibold uppercase tracking-wide text-stone-500">
                        Photo
                    </label>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label for="image"
                            class="group flex aspect-square cursor-pointer flex-col items-center justify-center gap-2 rounded-2xl border-2 border-dashed border-stone-300 bg-stone-100 text-stone-400 transition hover:bg-stone-200">
                            <span class="text-4xl transition group-hover:scale-110">📷</span>
                            <span class="text-xs font-bold uppercase tracking-widest">Ajouter</span>
                        </label>

                        <div
                            class="flex aspect-square items-center justify-center overflow-hidden rounded-2xl bg-stone-100 text-sm text-stone-400">
                            <img id="image-preview" src="" alt=""
                                class="hidden h-full w-full object-cover">
                            <span id="image-preview-placeholder">Aperçu photo</span>
                        </div>
                    </div>

                    <input id="image" name="image" type="file" accept="image/*"
                        class="block w-full text-sm text-stone-500 file:mr-4 file:rounded-full file:border-0 file:bg-white file:px-4 file:py-2 file:font-semibold file:text-stone-700 hover:file:bg-stone-100">
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="flex w-full items-center justify-center gap-3 rounded-full bg-gradient-to-br from-emerald-600 to-emerald-400 py-5 text-xl font-bold text-white shadow-xl shadow-emerald-200 transition hover:scale-[1.01] active:scale-[0.99]">
                        <span>➤</span>
                        <span>Partager avec la famille</span>
                    </button>
                </div>
            </form>
        </main>

        {{-- NAV MOBILE --}}
        <nav class="fixed inset-x-0 bottom-0 border-t bg-white py-3 md:hidden">
            <div class="flex items-center justify-around">
                <a href="{{ route('family-apartment.dashboard') }}" class="text-sm text-stone-500">Accueil</a>
                <a href="{{ route('family-apartment.tips.index') }}" class="text-sm font-bold text-emerald-600">Bons
                    plans</a>
                <a href="{{ route('family-apartment.infos') }}" class="text-sm text-stone-500">Infos</a>
                <a href="{{ route('family-apartment.history') }}" class="text-sm text-stone-500">Historique</a>
            </div>
        </nav>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {



            const ratingInput = document.getElementById('rating');
            const ratingLabel = document.getElementById('rating-label');
            const ratingStars = Array.from(document.querySelectorAll('.rating-star'));

            function updateStars(activeValue = 0) {
                ratingStars.forEach((star, index) => {
                    const value = index + 1;

                    if (value <= activeValue) {
                        star.classList.remove('bg-white', 'text-stone-300', 'border-stone-200');
                        star.classList.add('bg-amber-100', 'text-amber-500', 'border-amber-300');
                    } else {
                        star.classList.remove('bg-amber-100', 'text-amber-500', 'border-amber-300');
                        star.classList.add('bg-white', 'text-stone-300', 'border-stone-200');
                    }
                });

                if (activeValue > 0) {
                    ratingLabel.textContent = `Note sélectionnée : ${activeValue}/5`;
                } else {
                    ratingLabel.textContent = 'Choisis une note de 1 à 5.';
                }
            }

            ratingStars.forEach((star) => {
                star.addEventListener('mouseenter', function() {
                    updateStars(Number(this.dataset.value));
                });

                star.addEventListener('click', function() {
                    const value = Number(this.dataset.value);
                    ratingInput.value = value;
                    updateStars(value);
                });
            });

            document.getElementById('rating-stars').addEventListener('mouseleave', function() {
                updateStars(Number(ratingInput.value || 0));
            });

            updateStars(Number(ratingInput.value || 0));


            const latInput = document.getElementById('lat');
            const lngInput = document.getElementById('lng');
            const addressInput = document.getElementById('address');
            const geocodeBtn = document.getElementById('geocode-address-btn');
            const geocodeStatus = document.getElementById('geocode-status');
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');
            const imagePreviewPlaceholder = document.getElementById('image-preview-placeholder');

            const defaultLat = parseFloat(latInput.value) || 48.8566;
            const defaultLng = parseFloat(lngInput.value) || 2.3522;

            const map = L.map('tip-create-map', {
                scrollWheelZoom: false,
            }).setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let marker = null;

            function setMarker(lat, lng, shouldCenter = true) {
                latInput.value = Number(lat).toFixed(7);
                lngInput.value = Number(lng).toFixed(7);

                if (marker) {
                    marker.setLatLng([lat, lng]);
                } else {
                    marker = L.marker([lat, lng], {
                        draggable: true
                    }).addTo(map);

                    marker.on('dragend', function(event) {
                        const position = event.target.getLatLng();
                        latInput.value = Number(position.lat).toFixed(7);
                        lngInput.value = Number(position.lng).toFixed(7);
                    });
                }

                if (shouldCenter) {
                    map.setView([lat, lng], 15);
                }
            }

            if (latInput.value && lngInput.value) {
                setMarker(parseFloat(latInput.value), parseFloat(lngInput.value), true);
            }

            map.on('click', function(event) {
                const {
                    lat,
                    lng
                } = event.latlng;
                setMarker(lat, lng, false);
                geocodeStatus.textContent = 'Point placé sur la carte.';
            });

            geocodeBtn.addEventListener('click', async function() {
                const address = addressInput.value.trim();

                if (!address) {
                    geocodeStatus.textContent = 'Entre une adresse avant de placer le point.';
                    return;
                }

                geocodeStatus.textContent = 'Recherche de l’adresse en cours...';

                try {
                    const url = new URL('https://nominatim.openstreetmap.org/search');
                    url.searchParams.set('format', 'jsonv2');
                    url.searchParams.set('q', address);
                    url.searchParams.set('limit', '1');

                    const response = await fetch(url.toString(), {
                        headers: {
                            'Accept': 'application/json',
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Erreur pendant la recherche');
                    }

                    const results = await response.json();

                    if (!results.length) {
                        geocodeStatus.textContent =
                            'Adresse introuvable. Essaie une adresse plus précise.';
                        return;
                    }

                    const result = results[0];
                    const lat = parseFloat(result.lat);
                    const lng = parseFloat(result.lon);

                    setMarker(lat, lng, true);
                    geocodeStatus.textContent = 'Adresse trouvée et point placé sur la carte.';
                } catch (error) {
                    console.error(error);
                    geocodeStatus.textContent = 'Impossible de récupérer cette adresse pour le moment.';
                }
            });

            latInput.addEventListener('change', function() {
                const lat = parseFloat(latInput.value);
                const lng = parseFloat(lngInput.value);

                if (!Number.isNaN(lat) && !Number.isNaN(lng)) {
                    setMarker(lat, lng, true);
                }
            });

            lngInput.addEventListener('change', function() {
                const lat = parseFloat(latInput.value);
                const lng = parseFloat(lngInput.value);

                if (!Number.isNaN(lat) && !Number.isNaN(lng)) {
                    setMarker(lat, lng, true);
                }
            });

            imageInput.addEventListener('change', function(event) {
                const file = event.target.files?.[0];

                if (!file) {
                    imagePreview.classList.add('hidden');
                    imagePreview.removeAttribute('src');
                    imagePreviewPlaceholder.classList.remove('hidden');
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    imagePreviewPlaceholder.classList.add('hidden');
                };

                reader.readAsDataURL(file);
            });

            setTimeout(() => {
                map.invalidateSize();
            }, 200);
        });
    </script>
@endpush
