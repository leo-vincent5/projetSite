<!DOCTYPE html>
<html class="dark" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="robots" content="noindex, nofollow, noarchive">
    <meta name="googlebot" content="noindex, nofollow, noarchive">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Chemin de travers</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;700;800;900&family=Manrope:wght@400;500;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-secondary-container": "#d2d0cf",
                        "primary-fixed": "#d978ff",
                        "surface-container": "#1a1a1a",
                        "surface-container-highest": "#262626",
                        "primary-container": "#d978ff",
                        "on-secondary-fixed-variant": "#5c5b5b",
                        "inverse-surface": "#fcf9f8",
                        "surface-container-lowest": "#000000",
                        "tertiary-fixed": "#ff928a",
                        "secondary-fixed-dim": "#d6d4d3",
                        "inverse-on-surface": "#565555",
                        "on-tertiary-fixed": "#3a0003",
                        "surface-dim": "#0e0e0e",
                        "primary-dim": "#bc00fb",
                        "secondary-fixed": "#e5e2e1",
                        "tertiary": "#ff928a",
                        "secondary-container": "#474746",
                        "surface-tint": "#e08dff",
                        "surface-variant": "#262626",
                        "on-primary-container": "#3d0055",
                        "on-secondary-fixed": "#403f3f",
                        "primary-fixed-dim": "#d160ff",
                        "surface-bright": "#2c2c2c",
                        "on-primary": "#4f006c",
                        "error-container": "#a70138",
                        "tertiary-fixed-dim": "#fc7d75",
                        "secondary-dim": "#d6d4d3",
                        "on-surface": "#ffffff",
                        "on-secondary": "#525151",
                        "error-dim": "#d73357",
                        "inverse-primary": "#9a00cf",
                        "background": "#0e0e0e",
                        "error": "#ff6e84",
                        "surface-container-high": "#20201f",
                        "tertiary-container": "#fc7d75",
                        "outline": "#767575",
                        "on-primary-fixed": "#000000",
                        "on-tertiary-container": "#530006",
                        "on-error-container": "#ffb2b9",
                        "on-tertiary": "#650b0e",
                        "on-tertiary-fixed-variant": "#711516",
                        "tertiary-dim": "#f57870",
                        "surface-container-low": "#131313",
                        "on-error": "#490013",
                        "on-primary-fixed-variant": "#4c0068",
                        "outline-variant": "#484847",
                        "surface": "#0e0e0e",
                        "primary": "#e08dff",
                        "secondary": "#e5e2e1",
                        "on-background": "#ffffff",
                        "on-surface-variant": "#adaaaa"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "1rem",
                        xl: "1.5rem",
                        full: "9999px"
                    },
                    fontFamily: {
                        headline: ["Epilogue"],
                        body: ["Manrope"],
                        label: ["Manrope"]
                    }
                }
            }
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            overflow-x: hidden;
        }

        body {
            min-height: 50dvh;
        }
    </style>
</head>

<body class="bg-background text-on-surface font-body selection:bg-primary selection:text-on-primary">
    @php
        $mySeries = [
            [
                'title' => 'The Last Frontier',
                'episode' => 'S2 : E4 • 12m left',
                'progress' => '66%',
                'image' =>
                    'https://images.unsplash.com/photo-1446776811953-b23d57bd21aa?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'title' => 'Director\'s Cut',
                'episode' => 'S1 : E8 • 44m left',
                'progress' => '25%',
                'image' =>
                    'https://images.unsplash.com/photo-1485846234645-a62644f84728?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'title' => 'London Noir',
                'episode' => 'S3 : E2 • 3m left',
                'progress' => '85%',
                'image' =>
                    'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?q=80&w=1200&auto=format&fit=crop',
            ],
        ];

        $trending = [
            [
                'title' => 'Synapse',
                'match' => '98% Match',
                'rating' => '18+',
                'image' =>
                    'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'title' => 'The Masked',
                'match' => '94% Match',
                'rating' => '16+',
                'image' =>
                    'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'title' => 'Noir Theory',
                'match' => '91% Match',
                'rating' => 'PG-13',
                'image' =>
                    'https://images.unsplash.com/photo-1513106580091-1d82408b8cd6?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'title' => 'The Watcher',
                'match' => '89% Match',
                'rating' => '18+',
                'image' =>
                    'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=800&auto=format&fit=crop',
            ],
        ];
    @endphp

    <!-- TopAppBar -->
    <header
        class="fixed top-0 w-full z-50 bg-neutral-950/60 backdrop-blur-xl flex justify-between items-center px-6 h-16">
        <div class="flex items-center gap-4">
            <span class="text-xl font-black tracking-tighter text-fuchsia-500 uppercase font-headline">
                Knockturn Alley
            </span>
        </div>

        <nav class="hidden md:flex items-center gap-8">
            <a class="text-fuchsia-400 font-bold text-sm tracking-widest uppercase" href="#">Accueil</a>
            <a class="text-neutral-400 font-bold text-sm tracking-widest uppercase hover:text-fuchsia-300 transition-colors duration-300"
                href="#">Découvrir</a>
            <a class="text-neutral-400 font-bold text-sm tracking-widest uppercase hover:text-fuchsia-300 transition-colors duration-300"
                href="#">Ma Liste</a>
        </nav>

        <div class="flex items-center">
            <div
                class="w-8 h-8 rounded-full bg-surface-container-highest overflow-hidden border border-outline-variant/20">
                <img alt="User Profile" class="w-full h-full object-cover"
                    src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=200&auto=format&fit=crop" />
            </div>
        </div>
    </header>

    <main class="pb-24">
        <!-- Hero Section -->
        <section class="relative h-screen w-full overflow-hidden">

            <!-- Image dynamique -->
            <div id="heroBgA" class="absolute inset-0 bg-cover bg-center transition-opacity duration-700 opacity-100"
                style="background-image: url('{{ $hero['small_poster_path'] }}');">
            </div>

            <div id="heroBgB" class="absolute inset-0 bg-cover bg-center transition-opacity duration-700 opacity-0"
                style="background-image: url('{{ $hero['small_poster_path'] }}');">
            </div>

            <div class="absolute inset-0 bg-gradient-to-t from-background via-background/20 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-background via-transparent to-transparent"></div>

            <div class="relative h-full flex flex-col justify-end px-6 md:px-16 pb-20 max-w-5xl">

                <span class="bg-primary/20 text-primary px-3 py-1 rounded-full text-xs font-bold uppercase mb-4">
                    Featured
                </span>

                <!-- Titre -->
                <h1 id="heroTitle" class="font-headline text-5xl md:text-8xl font-black mb-6">
                    {{ $hero['title'] }}
                </h1>

                <div class="w-full max-w-2xl mb-8">
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-on-surface-variant">
                            search
                        </span>

                        <input type="text" id="seriesSearchInput" placeholder="Rechercher une série..."
                            autocomplete="off"
                            class="w-full rounded-full border border-white/10 bg-black/40 backdrop-blur-md pl-14 pr-5 py-4 text-white placeholder:text-on-surface-variant focus:border-primary focus:ring-0">
                    </div>
                </div>

                <!-- Description -->
                <p class="text-on-surface-variant text-lg max-w-2xl mb-8">

                </p>

                <div  class="flex gap-4">
                    <a id="heroWatchLink" href="{{ route('oneserie', ['id' => $hero['id']]) }}" class="bg-primary px-6 py-3 rounded-full font-bold inline-flex items-center">
    ▶ Regarder
</a>

                    <button class="bg-white/10 px-6 py-3 rounded-full">
                        + My List
                    </button>
                </div>

            </div>
        </section>

        <div class="space-y-12 -mt-10 relative z-10">
            <!-- My Series -->
         <section class="pl-6 md:pl-16">
    <div class="flex items-center justify-between pr-6 md:pr-16 mb-6">
        <h2 class="font-headline text-2xl font-bold tracking-tight uppercase">My Series</h2>
        <a class="text-primary text-sm font-bold tracking-widest uppercase hover:underline underline-offset-4"
            href="#">View All</a>
    </div>

    <div id="mySeriesSlider"
        class="flex gap-4 overflow-x-auto hide-scrollbar pb-4 w-full cursor-grab select-none">
        @foreach ($datas as $item)
            <a
                href="{{ route('oneserie', ['id' => $item['id']]) }}"
                class="slider-link shrink-0 block"
                draggable="false"
            >
                <div class="w-72 group cursor-pointer">
                    <div
                        class="relative aspect-video rounded-lg overflow-hidden mb-3 bg-surface-container-low transition-all duration-500 group-hover:scale-105">
                        <img
                            class="w-full h-full object-cover pointer-events-none select-none"
                            src="{{ $item['small_poster_path'] }}"
                            alt="{{ $item['title'] }}"
                            draggable="false"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 w-full h-1 bg-surface-container-highest"></div>
                    </div>
                    <h3 class="font-bold text-base truncate">{{ $item['title'] }}</h3>
                </div>
            </a>
        @endforeach
    </div>
</section>

            {{-- <!-- Trending Now -->
            <section class="pl-6 md:pl-16">
                <h2 class="font-headline text-2xl font-bold tracking-tight uppercase mb-6">Trending Now</h2>
                <div class="flex gap-6 overflow-x-auto hide-scrollbar pb-6">
                    @foreach ($trending as $item)
                        <div class="flex-none w-44 md:w-56 group cursor-pointer">
                            <div
                                class="aspect-[2/3] rounded-lg overflow-hidden mb-4 bg-surface-container-low shadow-2xl transition-all duration-500 group-hover:scale-105 group-hover:shadow-primary/10">
                                <img class="w-full h-full object-cover" src="{{ $item['image'] }}"
                                    alt="{{ $item['title'] }}">
                            </div>
                            <div class="flex items-center gap-2 mb-1">
                                <span
                                    class="text-primary font-bold text-xs uppercase tracking-tighter">{{ $item['match'] }}</span>
                                <span
                                    class="text-on-surface-variant text-[10px] border border-outline-variant px-1 rounded">{{ $item['rating'] }}</span>
                            </div>
                            <h3 class="font-bold text-sm tracking-tight truncate uppercase">{{ $item['title'] }}</h3>
                        </div>
                    @endforeach
                </div>
            </section> --}}

            {{-- <!-- Coming Soon -->
            <section class="px-6 md:px-16">
                <h2 class="font-headline text-2xl font-bold tracking-tight uppercase mb-8">Coming Soon</h2>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-auto md:h-[500px]">
                    <div class="md:col-span-8 relative group rounded-xl overflow-hidden bg-surface-container-low">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                            src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?q=80&w=1600&auto=format&fit=crop"
                            alt="Cyber Rain">
                        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80"></div>
                        <div class="absolute bottom-0 left-0 p-8">
                            <span
                                class="text-primary-fixed text-xs font-black tracking-widest uppercase mb-2 block">Premiere
                                Oct 24</span>
                            <h3 class="font-headline text-4xl font-black uppercase tracking-tighter">Cyber Rain</h3>
                            <button
                                class="mt-4 flex items-center gap-2 text-sm font-bold tracking-widest uppercase hover:text-primary transition-colors">
                                <span class="material-symbols-outlined">notifications</span>
                                Remind Me
                            </button>
                        </div>
                    </div>

                    <div class="md:col-span-4 flex flex-col gap-6">
                        <div class="flex-1 relative group rounded-xl overflow-hidden bg-surface-container-low">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                src="https://images.unsplash.com/photo-1446776653964-20c1d3a81b06?q=80&w=1000&auto=format&fit=crop"
                                alt="Orbiting">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 p-6">
                                <h4 class="font-bold text-lg uppercase tracking-tight">Orbiting</h4>
                                <span
                                    class="text-primary-fixed text-[10px] font-black tracking-widest uppercase">Coming
                                    Nov 12</span>
                            </div>
                        </div>

                        <div class="flex-1 relative group rounded-xl overflow-hidden bg-surface-container-low">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                src="https://images.unsplash.com/photo-1511818966892-d7d671e672a2?q=80&w=1000&auto=format&fit=crop"
                                alt="Structure">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                            <div class="absolute bottom-0 left-0 p-6">
                                <h4 class="font-bold text-lg uppercase tracking-tight">Structure</h4>
                                <span
                                    class="text-primary-fixed text-[10px] font-black tracking-widest uppercase">Coming
                                    Dec 05</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}

            {{-- <!-- Extra poster section -->
            <section class="px-6 md:px-16 pb-10">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-headline text-2xl font-bold tracking-tight uppercase">Featured Posters</h2>
                    <a class="text-primary text-sm font-bold tracking-widest uppercase hover:underline underline-offset-4"
                        href="#">Browse</a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-5">
                    @foreach ($trending as $item)
                        <div class="group cursor-pointer">
                            <div
                                class="aspect-[2/3] rounded-xl overflow-hidden bg-surface-container-low shadow-xl transition duration-500 group-hover:scale-[1.03]">
                                <img class="w-full h-full object-cover" src="{{ $item['image'] }}"
                                    alt="{{ $item['title'] }}">
                            </div>
                            <h3 class="mt-3 text-sm font-bold uppercase tracking-tight truncate">{{ $item['title'] }}
                            </h3>
                        </div>
                    @endforeach
                </div>
            </section> --}}
        </div>
    </main>

    <!-- BottomNavBar -->
    <nav
        class="fixed bottom-0 left-0 w-full flex justify-around items-center h-20 px-4 pb-4 bg-neutral-950/80 backdrop-blur-2xl z-50 rounded-t-3xl md:hidden">
        <a class="flex flex-col items-center justify-center text-fuchsia-400 bg-fuchsia-500/10 rounded-full px-4 py-1 active:scale-110 duration-200"
            href="#">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">home</span>
            <span class="font-body text-[10px] font-bold tracking-[0.05em] uppercase mt-1">Home</span>
        </a>
        <a class="flex flex-col items-center justify-center text-neutral-500 hover:text-neutral-200 transition-all"
            href="#">
            <span class="material-symbols-outlined">movie_filter</span>
            <span class="font-body text-[10px] font-bold tracking-[0.05em] uppercase mt-1">Originals</span>
        </a>
        <a class="flex flex-col items-center justify-center text-neutral-500 hover:text-neutral-200 transition-all"
            href="#">
            <span class="material-symbols-outlined">download</span>
            <span class="font-body text-[10px] font-bold tracking-[0.05em] uppercase mt-1">Downloads</span>
        </a>
        <a class="flex flex-col items-center justify-center text-neutral-500 hover:text-neutral-200 transition-all"
            href="#">
            <span class="material-symbols-outlined">person</span>
            <span class="font-body text-[10px] font-bold tracking-[0.05em] uppercase mt-1">Profile</span>
        </a>
    </nav>

    <div id="searchModal" class="fixed inset-0 z-[200] hidden">
        <div id="searchModalBackdrop" class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>

        <div class="relative z-[201] flex min-h-screen items-start justify-center px-4 pt-[10vh] pb-6">
            <div class="w-full max-w-4xl rounded-3xl border border-white/10 bg-[#111111]/95 shadow-2xl overflow-hidden">
                <div class="flex items-center gap-3 border-b border-white/10 px-4 md:px-6 py-4">
                    <span class="material-symbols-outlined text-on-surface-variant">search</span>

                    <input type="text" id="seriesSearchModalInput" placeholder="Rechercher une série..."
                        autocomplete="off"
                        class="w-full bg-transparent text-white placeholder:text-on-surface-variant outline-none border-0 focus:ring-0 text-base md:text-lg">

                    <button type="button" id="closeSearchModalBtn"
                        class="flex h-10 w-10 items-center justify-center rounded-full hover:bg-white/5 text-white transition"
                        aria-label="Fermer la recherche">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <div id="seriesSearchResultsInner" class="max-h-[65vh] overflow-y-auto">
                    <div class="px-6 py-6 text-sm text-on-surface-variant">
                        Commencez à taper pour rechercher une série.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.seriesSearchUrl = @js(route('series.search'));
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const heroInput = document.getElementById('seriesSearchInput');
            const modal = document.getElementById('searchModal');
            const modalBackdrop = document.getElementById('searchModalBackdrop');
            const modalInput = document.getElementById('seriesSearchModalInput');
            const resultsInner = document.getElementById('seriesSearchResultsInner');
            const closeBtn = document.getElementById('closeSearchModalBtn');

            if (!heroInput || !modal || !modalInput || !resultsInner) return;

            let debounceTimer = null;
            let abortController = null;

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text ?? '';
                return div.innerHTML;
            }

            function openSearchModal(initialValue = '') {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');

                modalInput.value = initialValue;
                setTimeout(() => {
                    modalInput.focus();
                    modalInput.setSelectionRange(modalInput.value.length, modalInput.value.length);
                }, 10);
            }

            function closeSearchModal() {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            function renderResults(items) {
                if (!items.length) {
                    resultsInner.innerHTML = `
                <div class="px-6 py-6 text-sm text-on-surface-variant">
                    Aucun résultat trouvé.
                </div>
            `;
                    return;
                }

                resultsInner.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 p-4">
                ${items.map(item => {
                    const title = escapeHtml(item.title ?? 'Sans titre');
                    const poster = item.small_poster_path ?? item.poster ?? item.image ?? '';
                    const year = escapeHtml(item.year ?? '');
                    const id = item.id ?? '';
                    const categories = Array.isArray(item.categories)
                        ? item.categories.map(cat => escapeHtml(cat.name ?? '')).filter(Boolean).slice(0, 3).join(' • ')
                        : '';

                    return `
                                <a
                                    href="/oneserie/${id}"
                                    class="flex gap-4 rounded-2xl border border-white/5 bg-white/[0.03] p-3 hover:bg-white/[0.06] transition"
                                >
                                    <div class="w-20 h-28 rounded-xl overflow-hidden bg-black/30 shrink-0">
                                        ${poster
                                            ? `<img src="${poster}" alt="${title}" class="w-full h-full object-cover">`
                                            : `<div class="w-full h-full flex items-center justify-center text-xs text-on-surface-variant px-2 text-center">Pas d'image</div>`
                                        }
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <div class="font-bold text-white text-base truncate">${title}</div>
                                        ${year ? `<div class="text-sm text-on-surface-variant mt-1">${year}</div>` : ''}
                                        ${categories ? `<div class="text-xs text-on-surface-variant mt-2 line-clamp-2">${categories}</div>` : ''}
                                    </div>
                                </a>
                            `;
                }).join('')}
            </div>
        `;
            }

            async function searchSeries(query) {
                if (!query || query.trim().length < 2) {
                    resultsInner.innerHTML = `
                <div class="px-6 py-6 text-sm text-on-surface-variant">
                    Commencez à taper pour rechercher une série.
                </div>
            `;
                    return;
                }

                if (abortController) {
                    abortController.abort();
                }

                abortController = new AbortController();

                resultsInner.innerHTML = `
            <div class="px-6 py-6 text-sm text-on-surface-variant">
                Recherche en cours...
            </div>
        `;

                try {
                    const response = await fetch(`${window.seriesSearchUrl}?q=${encodeURIComponent(query)}`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        signal: abortController.signal
                    });

                    if (!response.ok) {
                        throw new Error('Erreur serveur');
                    }

                    const data = await response.json();
                    renderResults(data.results ?? []);
                } catch (error) {
                    if (error.name === 'AbortError') return;

                    resultsInner.innerHTML = `
                <div class="px-6 py-6 text-sm text-red-300">
                    Une erreur est survenue pendant la recherche.
                </div>
            `;
                }
            }

            function handleSearchInput(value) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    searchSeries(value);
                }, 300);
            }

            heroInput.addEventListener('focus', function() {
                openSearchModal(heroInput.value);
                handleSearchInput(heroInput.value);
            });

            heroInput.addEventListener('input', function() {
                openSearchModal(this.value);
                modalInput.value = this.value;
                handleSearchInput(this.value);
            });

            modalInput.addEventListener('input', function() {
                heroInput.value = this.value;
                handleSearchInput(this.value);
            });

            closeBtn?.addEventListener('click', closeSearchModal);
            modalBackdrop?.addEventListener('click', closeSearchModal);

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeSearchModal();
                }
            });
        });
    </script>

    <script>
        let activeLayer = 'A';

        function preloadImage(src) {
            return new Promise((resolve, reject) => {
                if (!src) {
                    reject(new Error('Image vide ou undefined'));
                    return;
                }

                const img = new Image();
                img.src = src;
                img.onload = resolve;
                img.onerror = reject;
            });
        }

       async function changeHero(title, image, id = null) {
    if (!image) {
        console.warn('Image impossible à charger : valeur vide', image);
        return;
    }

    const heroTitle = document.getElementById('heroTitle');
    const heroWatchLink = document.getElementById('heroWatchLink');
    const bgA = document.getElementById('heroBgA');
    const bgB = document.getElementById('heroBgB');

    try {
        await preloadImage(image);
    } catch (e) {
        console.warn('Image impossible à charger', image);
        return;
    }

    const nextLayer = activeLayer === 'A' ? bgB : bgA;
    const currentLayer = activeLayer === 'A' ? bgA : bgB;

    nextLayer.style.backgroundImage = `url("${image}")`;
    nextLayer.classList.remove('opacity-0');
    nextLayer.classList.add('opacity-100');

    currentLayer.classList.remove('opacity-100');
    currentLayer.classList.add('opacity-0');

    if (heroTitle) heroTitle.textContent = title ?? '';
    if (heroWatchLink && id) heroWatchLink.href = `/oneserie/${id}`;

    activeLayer = activeLayer === 'A' ? 'B' : 'A';
}


        let featured = @json($featured ?? []);
        let index = 0;

        if (featured.length > 1) {
            setInterval(() => {
                index = (index + 1) % featured.length;
                const item = featured[index];
                console.log('Changement de héros vers :', item);
                changeHero(
                    item.title,
                   item.small_poster_path,  
                    item.id,    
                );
            }, 5000);
        }

  document.addEventListener('DOMContentLoaded', function () {
    const slider = document.getElementById('mySeriesSlider');
    if (!slider) return;

    let isDown = false;
    let startX = 0;
    let startScrollLeft = 0;
    let dragged = false;

    slider.querySelectorAll('a, img').forEach((el) => {
        el.setAttribute('draggable', 'false');
        el.addEventListener('dragstart', (e) => e.preventDefault());
    });

    slider.addEventListener('mousedown', (e) => {
        if (e.button !== 0) return;

        isDown = true;
        dragged = false;
        startX = e.pageX;
        startScrollLeft = slider.scrollLeft;

        slider.classList.add('cursor-grabbing');
        slider.classList.remove('cursor-grab');
    });

    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;

        const dx = e.pageX - startX;

        if (Math.abs(dx) > 6) {
            dragged = true;
            e.preventDefault();
            slider.scrollLeft = startScrollLeft - dx * 1.2;
        }
    });

    function stopDrag() {
        isDown = false;
        slider.classList.remove('cursor-grabbing');
        slider.classList.add('cursor-grab');

        setTimeout(() => {
            dragged = false;
        }, 50);
    }

    slider.addEventListener('mouseup', stopDrag);
    slider.addEventListener('mouseleave', stopDrag);

    slider.querySelectorAll('.slider-link').forEach((link) => {
        link.addEventListener('click', (e) => {
            if (dragged) {
                e.preventDefault();
                e.stopPropagation();
            }
        });
    });
});
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('seriesSearchInput');
            const resultsBox = document.getElementById('seriesSearchResults');
            const resultsInner = document.getElementById('seriesSearchResultsInner');

            if (!input || !resultsBox || !resultsInner) return;

            let debounceTimer = null;
            let abortController = null;

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text ?? '';
                return div.innerHTML;
            }

            function closeResults() {
                resultsBox.classList.add('hidden');
                resultsInner.innerHTML = '';
            }

            function openResults() {
                resultsBox.classList.remove('hidden');
            }

            function renderResults(items) {
                if (!items.length) {
                    resultsInner.innerHTML = `
            <div class="px-6 py-6 text-sm text-on-surface-variant">
                Aucun résultat trouvé.
            </div>
        `;
                    return;
                }

                resultsInner.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 p-4">
            ${items.map(item => {
                const title = escapeHtml(item.title ?? 'Sans titre');
                const poster = item.small_poster_path ?? '';
                const id = item.id ?? '';
                const type = item.type ?? 'movie';

                let year = '';
                if (item.release_date) {
                    year = String(item.release_date).slice(0, 4);
                }

                const runtime = item.runtime ? `
                $ {
                    item.runtime
                }
                min` : '';
                const lang = item.lang === 1 ? 'VF' : '';

                return ` <
                a
                href = "/oneserie/${id}"
                class =
                "flex gap-4 rounded-2xl border border-white/5 bg-white/[0.03] p-3 hover:bg-white/[0.06] transition" >
                <
                div class = "w-20 h-28 rounded-xl overflow-hidden bg-black/30 shrink-0" >
                $ {
                    poster
                        ?
                        `<img src="${poster}" alt="${title}" class="w-full h-full object-cover">` :
                        `<div class="w-full h-full flex items-center justify-center text-xs text-on-surface-variant px-2 text-center">Pas d'image</div>`
                } <
                /div>

                <
                div class = "min-w-0 flex-1" >
                <
                div class = "font-bold text-white text-base truncate" > $ {
                    title
                } < /div>

                <
                div class = "text-sm text-on-surface-variant mt-1 flex flex-wrap gap-2" >
                $ {
                    year ? `<span>${year}</span>` : ''
                }
                $ {
                    runtime ? `<span>${runtime}</span>` : ''
                }
                $ {
                    lang ? `<span>${lang}</span>` : ''
                } <
                /div>

                <
                div class = "text-xs text-on-surface-variant mt-2 uppercase tracking-widest" >
                $ {
                    escapeHtml(type)
                } <
                /div> < /
                div > <
                    /a>
                `;
            }).join('')}
        </div>
    `;
            }

            async function searchSeries(query) {
                if (!query || query.trim().length < 2) {
                    closeResults();
                    return;
                }

                if (abortController) {
                    abortController.abort();
                }

                abortController = new AbortController();

                resultsInner.innerHTML = `
            <div class="px-4 py-4 text-sm text-on-surface-variant">
                Recherche en cours...
            </div>
        `;
                openResults();

                try {
                    const response = await fetch(`/searchSeries?q=${encodeURIComponent(query)}`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        signal: abortController.signal
                    });

                    if (!response.ok) {
                        throw new Error('Erreur serveur');
                    }

                    const data = await response.json();
                    renderResults(data.results ?? []);
                } catch (error) {
                    if (error.name === 'AbortError') {
                        return;
                    }

                    resultsInner.innerHTML = `
                <div class="px-4 py-4 text-sm text-red-300">
                    Une erreur est survenue.
                </div>
            `;
                    openResults();
                }
            }

            input.addEventListener('input', function() {
                const value = this.value;

                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    searchSeries(value);
                }, 300);
            });

            document.addEventListener('click', function(e) {
                if (!resultsBox.contains(e.target) && e.target !== input) {
                    closeResults();
                }
            });

            input.addEventListener('focus', function() {
                if (resultsInner.innerHTML.trim() !== '') {
                    openResults();
                }
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeResults();
                }
            });
        });
    </script>


</body>

</html>
