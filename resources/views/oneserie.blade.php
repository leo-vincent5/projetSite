<!DOCTYPE html>
<html class="dark" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="robots" content="noindex, nofollow, noarchive">
    <meta name="googlebot" content="noindex, nofollow, noarchive">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $hero['title'] ?? 'Cinematheque' }}</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;700;900&family=Manrope:wght@400;500;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

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

        html,
        body {
            margin: 0;
            min-height: 100%;
            overflow-x: hidden;
        }

        body {
            font-family: 'Manrope', sans-serif;
            background-color: #0e0e0e;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Epilogue', sans-serif;
        }

        .text-shadow-glow {
            text-shadow: 0 0 20px rgba(224, 141, 255, 0.3);
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="text-on-surface selection:bg-primary/30">
    @php
        $heroImage = $hero['backdrop_path'] ?? ($hero['small_poster_path'] ?? ($hero['image'] ?? ''));
        $posterImage = $hero['poster_path'] ?? ($hero['small_poster_path'] ?? $heroImage);

        $cast = $cast ?? [
            [
                'name' => 'Elias Thorne',
                'role' => 'Kaelen',
                'image' =>
                    'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Mira Vane',
                'role' => 'Lyra',
                'image' =>
                    'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Julian Mars',
                'role' => 'The Oracle',
                'image' =>
                    'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Leo Beck',
                'role' => 'Soren',
                'image' =>
                    'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=400&auto=format&fit=crop',
            ],
        ];

        $episodes = $episodes ?? [
            [
                'number' => '01',
                'title' => 'The Static Silence',
                'description' => 'Kaelen découvre un fichier corrompu qui mène vers un secteur interdit.',
                'duration' => '52 minutes',
                'progress' => 100,
                'image' =>
                    'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'number' => '02',
                'title' => 'Neural Bypass',
                'description' => 'Une course-poursuite révèle un lien secret entre Lyra et le programme.',
                'duration' => '48 minutes',
                'progress' => 25,
                'image' =>
                    'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'number' => '03',
                'title' => 'Fragments of Gold',
                'description' => 'L’Oracle offre un aperçu du monde avant le grand effacement.',
                'duration' => '55 minutes',
                'progress' => 0,
                'image' =>
                    'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=900&auto=format&fit=crop',
            ],
        ];

        $genres = $genres ?? ['Sci-Fi', 'Thriller', 'Noir'];
        $director = $director ?? 'Satoshi Nakamoto';
        $writers = $writers ?? 'Elena Rossi, David Chen';
        $audioLabel = $audioLabel ?? 'Dolby Atmos 5.1';
        $rating = $rating ?? '4.9';
        $year = $year ?? '2024';
        $seasons = $seasons ?? '1 saison';
        $saison = 1;
    @endphp

    @php
        $seasonCount = (int) ($response['seasons'] ?? 1);
        $saison = (int) request('saison', 1);
        $lang = request('lang', 'fr');

        if (!in_array($lang, ['fr', 'vo'], true)) {
            $lang = 'fr';
        }
    @endphp

    <!-- TopAppBar -->
    <nav class="fixed top-0 w-full z-50 bg-neutral-950/60 backdrop-blur-xl flex justify-between items-center px-6 h-16">
        <div class="flex items-center gap-4">
            <button
                class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-surface-container-highest transition-all"
                onclick="history.back()">
                <span class="material-symbols-outlined text-on-surface">arrow_back</span>
            </button>

            <span class="text-xl font-black tracking-tighter text-fuchsia-500 uppercase font-headline">
                Knockturn Alley
            </span>
        </div>

        <div class="flex items-center gap-6">
            <span
                class="material-symbols-outlined text-fuchsia-400 cursor-pointer hover:text-fuchsia-300 transition-colors duration-300">search</span>

            <div
                class="w-8 h-8 rounded-full bg-surface-container-highest overflow-hidden border border-outline-variant/20">
                <img alt="User profile avatar" class="w-full h-full object-cover"
                    src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=200&auto=format&fit=crop" />
            </div>
        </div>
    </nav>

    <main class="pb-28">
        <!-- Hero Section -->
        <section class="relative w-full min-h-[680px] md:h-[751px] flex items-end">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover" src="{{ Arr::get($response, 'posters.small') }}"
                    alt="{{ $hero['title'] ?? 'Hero image' }}">
                <div class="absolute inset-0 bg-gradient-to-t from-background via-background/40 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-background via-transparent to-transparent"></div>
            </div>

            <div class="relative z-10 w-full max-w-7xl mx-auto px-6 md:px-12 pb-16">
                <div class="flex flex-col gap-4 max-w-2xl">
                    <div class="flex flex-wrap items-center gap-3">
                        <span
                            class="px-3 py-1 bg-primary/20 text-primary rounded-full text-xs font-bold tracking-widest uppercase">
                            Original Series
                        </span>

                        <div class="flex items-center gap-1 text-tertiary">
                            <span class="material-symbols-outlined text-sm"
                                style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="font-bold text-sm">{{ $rating }}</span>
                        </div>

                        <span class="text-on-surface-variant text-sm font-medium">
                            {{ $year }} • {{ $seasons }}
                        </span>
                    </div>

                    <h1 class="text-5xl md:text-8xl font-black tracking-tighter leading-[0.9] text-shadow-glow">
                        {{ $response['title'] ?? 'NEON ECHOES' }}
                    </h1>

                    @if(!empty($response['categories']))
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach($response['categories'] as $category)
                                <span class="px-3 py-1 bg-surface-variant/50 backdrop-blur-md rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-white border border-white/10">
                                    {{ $category['name'] }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    @if (!empty($hero['overview']))
                        <p class="text-on-surface-variant text-lg leading-relaxed mt-2 max-w-xl font-medium">
                            {{ $hero['overview'] }}
                        </p>
                    @endif

                    <div class="flex items-center gap-4 mt-6">
                        <button
                            class="bg-gradient-to-r from-primary to-primary-container px-10 py-4 rounded-full flex items-center gap-3 hover:scale-105 transition-transform active:scale-95 shadow-[0_0_20px_rgba(224,141,255,0.2)]">
                            <span class="material-symbols-outlined text-on-primary-container"
                                style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                            <span
                                class="text-on-primary-container font-black uppercase tracking-widest text-sm">Regarder</span>
                        </button>

                        <button
                            class="w-14 h-14 rounded-full bg-surface-container-highest flex items-center justify-center hover:bg-surface-bright transition-colors">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Content Area -->
        <div class="max-w-7xl mx-auto px-6 md:px-12 mt-12 grid grid-cols-1 lg:grid-cols-12 gap-16">
            <!-- Left Column -->
            <div class="lg:col-span-8 flex flex-col gap-16">
                <!-- Cast -->
                {{-- <section>
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold tracking-tight">Main Cast</h2>
                        <button
                            class="text-primary text-sm font-bold uppercase tracking-widest hover:underline decoration-2 underline-offset-8 transition-all">
                            View All
                        </button>
                    </div>

                    <div class="flex gap-6 overflow-x-auto pb-4 hide-scrollbar">
                        @foreach ($cast as $person)
                            <div class="flex-shrink-0 group cursor-pointer w-24">
                                <div
                                    class="w-24 h-24 rounded-full overflow-hidden mb-3 border-2 border-transparent group-hover:border-primary transition-all">
                                    <img class="w-full h-full object-cover" src="{{ $person['image'] }}"
                                        alt="{{ $person['name'] }}">
                                </div>
                                <p class="text-xs font-bold text-center group-hover:text-primary transition-colors">
                                    {{ $person['name'] }}</p>
                                <p class="text-[10px] text-on-surface-variant text-center uppercase tracking-tighter">
                                    {{ $person['role'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </section> --}}

                <!-- Episodes -->
                <section>
                    <div class="mb-8 space-y-4">
                        <div class="flex items-center justify-between gap-4">
                            <h2 class="text-2xl font-bold tracking-tight shrink-0">Episodes</h2>
                        </div>

                        <!-- Ligne saisons -->
                        <div class="flex flex-wrap gap-2">
                            @for ($i = 1; $i <= $seasonCount; $i++)
                                <a href="{{ request()->fullUrlWithQuery(['saison' => $i, 'lang' => $lang]) }}"
                                    class="px-5 py-3 rounded-full text-sm font-bold tracking-widest uppercase transition-all border
            {{ (int) $saison === $i
                ? 'bg-primary text-black border-primary shadow-[0_0_20px_rgba(224,141,255,0.35)]'
                : 'bg-surface-container-highest text-white border-white/10 hover:bg-surface-bright hover:border-primary/40' }}">
                                    Saison {{ $i }}
                                </a>
                            @endfor
                        </div>

                        <!-- Ligne langue -->
                        <div class="flex">
                            <div
                                class="flex gap-1 p-1 rounded-full bg-surface-container-highest border border-white/10 w-fit">
                                <a href="{{ request()->fullUrlWithQuery(['saison' => $saison, 'lang' => 'fr']) }}"
                                    class="px-5 py-3 rounded-full text-sm font-bold tracking-widest uppercase transition-all whitespace-nowrap
                    {{ $lang === 'fr'
                        ? 'bg-primary text-black shadow-[0_0_20px_rgba(224,141,255,0.35)]'
                        : 'text-white hover:bg-white/5' }}">
                                    VF
                                </a>

                                <a href="{{ request()->fullUrlWithQuery(['saison' => $saison, 'lang' => 'vo']) }}"
                                    class="px-5 py-3 rounded-full text-sm font-bold tracking-widest uppercase transition-all whitespace-nowrap
                    {{ $lang === 'vo'
                        ? 'bg-primary text-black shadow-[0_0_20px_rgba(224,141,255,0.35)]'
                        : 'text-white hover:bg-white/5' }}">
                                    VO / MULTI
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        @foreach ($responseSaison as $key => $episode)
                            @php
                                $episodeNumber = Arr::get($episode, 'episode');
                                $link = Arr::get($result, $lang . '.' . $saison . '.' . $episodeNumber . '.url');
                            @endphp

                            <div class="group flex flex-col md:flex-row items-start md:items-center gap-6 p-4 rounded-xl hover:bg-surface-container-low transition-all cursor-pointer"
                                onclick="openPlayer(@js($episode['name']), @js($link))">
                                <span
                                    class="text-2xl font-black text-outline-variant group-hover:text-primary transition-colors font-headline">
                                    {{ $episode['episode'] }}
                                </span>

                                <div
                                    class="relative w-full md:w-48 aspect-video rounded-lg overflow-hidden flex-shrink-0">
                                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                        src="{{ $episode['poster'] }}" alt="{{ $episode['name'] }}">
                                    <div
                                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span class="material-symbols-outlined text-on-surface text-4xl"
                                            style="font-variation-settings: 'FILL' 1;">play_circle</span>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-1 flex-grow w-full">
                                    <h3 class="text-lg font-bold group-hover:text-primary transition-colors">
                                        {{ $episode['name'] }}
                                    </h3>
                                    <p class="text-sm text-on-surface-variant line-clamp-2 md:line-clamp-1">
                                        {{ $episode['overview'] }}
                                    </p>

                                    <div class="flex items-center gap-4 mt-1">
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-outline">
                                            {{ $episode['runtime']['human'] }}
                                        </span>

                                        <div
                                            class="h-1 flex-grow max-w-[100px] bg-surface-container-highest rounded-full overflow-hidden">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <!-- Right Column -->
            <div class="lg:col-span-4 flex flex-col gap-12">
                <div class="bg-surface-container-low p-8 rounded-xl flex flex-col gap-8">
                    <div>
                        <h4 class="text-[10px] font-bold uppercase tracking-[0.2em] text-outline mb-3">Director</h4>
                        <p class="text-on-surface font-medium">{{ $director }}</p>
                    </div>

                    <div>
                        <h4 class="text-[10px] font-bold uppercase tracking-[0.2em] text-outline mb-3">Descriptions</h4>
                        <p class="text-on-surface font-medium">{{ Arr::get($response, 'overview', 'No description available.') }}</p>
                    </div>

                    <div>
                        <h4 class="text-[10px] font-bold uppercase tracking-[0.2em] text-outline mb-3">Genres</h4>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach (Arr::get($response, 'categories', []) as $genre)
                                <span
                                    class="px-3 py-1 bg-surface-variant/40 backdrop-blur-md rounded-full text-[10px] font-bold uppercase tracking-widest">
                                    {{ Arr::get($genre, 'name', 'Unknown Genre') }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h4 class="text-[10px] font-bold uppercase tracking-[0.2em] text-outline mb-3">Audio</h4>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg text-primary">surround_sound</span>
                            <p class="text-on-surface font-medium">{{ $audioLabel }}</p>
                        </div>
                    </div>
                </div>

                {{-- <div class="relative rounded-xl overflow-hidden aspect-[4/5] group cursor-pointer">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                        src="{{ $posterImage }}" alt="Poster">
                    <div class="absolute inset-0 bg-gradient-to-t from-background to-transparent opacity-60"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <h4 class="text-lg font-bold">More Like This</h4>
                        <p class="text-sm text-on-surface-variant">Explore the Cyberpunk collection</p>
                    </div>
                </div> --}}
            </div>
        </div>
    </main>

    <!-- BottomNavBar -->
    <nav
        class="fixed bottom-0 left-0 w-full flex justify-around items-center h-20 px-4 pb-4 bg-neutral-950/80 backdrop-blur-2xl z-50 rounded-t-3xl md:hidden">
        <div
            class="flex flex-col items-center justify-center text-neutral-500 hover:text-neutral-200 transition-all cursor-pointer">
            <span class="material-symbols-outlined mb-1">home</span>
            <span class="font-body text-[10px] font-bold tracking-[0.05em] uppercase">Home</span>
        </div>

        <div
            class="flex flex-col items-center justify-center text-fuchsia-400 bg-fuchsia-500/10 rounded-full px-4 py-1 transition-all cursor-pointer scale-110">
            <span class="material-symbols-outlined mb-1"
                style="font-variation-settings: 'FILL' 1;">movie_filter</span>
            <span class="font-body text-[10px] font-bold tracking-[0.05em] uppercase">Originals</span>
        </div>

        <div
            class="flex flex-col items-center justify-center text-neutral-500 hover:text-neutral-200 transition-all cursor-pointer">
            <span class="material-symbols-outlined mb-1">download</span>
            <span class="font-body text-[10px] font-bold tracking-[0.05em] uppercase">Downloads</span>
        </div>

        <div
            class="flex flex-col items-center justify-center text-neutral-500 hover:text-neutral-200 transition-all cursor-pointer">
            <span class="material-symbols-outlined mb-1">person</span>
            <span class="font-body text-[10px] font-bold tracking-[0.05em] uppercase">Profile</span>
        </div>
    </nav>
    <div id="playerModal" class="fixed inset-0 z-[100] hidden bg-black/80 backdrop-blur-sm">
        <div class="flex min-h-screen items-center justify-center p-4 md:p-8">
            <div id="playerBox"
                class="relative w-full max-w-6xl bg-black rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                <button type="button" onclick="closePlayer()"
                    class="absolute top-3 right-3 z-[102] flex h-11 w-11 items-center justify-center rounded-full bg-black/70 text-white hover:text-primary hover:bg-black transition"
                    aria-label="Fermer le lecteur">
                    <span class="material-symbols-outlined text-3xl">close</span>
                </button>

                <div
                    class="flex items-center justify-between px-4 py-3 bg-surface-container-low border-b border-white/10">
                    <h3 id="playerTitle" class="text-sm md:text-base font-bold truncate pr-12">Lecture</h3>
                </div>

                <div class="relative bg-black aspect-video w-full">
                    <video id="episodePlayer" class="w-full h-full" controls playsinline></video>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script>
        let hlsInstance = null;

        function openPlayer(title, m3u8Url) {
            const modal = document.getElementById('playerModal');
            const video = document.getElementById('episodePlayer');
            const playerTitle = document.getElementById('playerTitle');

            if (!modal || !video || !m3u8Url) {
                console.warn('Player impossible à ouvrir', {
                    title,
                    m3u8Url
                });
                return;
            }

            playerTitle.textContent = title || 'Lecture';
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            if (hlsInstance) {
                hlsInstance.destroy();
                hlsInstance = null;
            }

            video.pause();
            video.removeAttribute('src');
            video.load();

            if (video.canPlayType('application/vnd.apple.mpegurl')) {
                video.src = m3u8Url;
            } else if (window.Hls && Hls.isSupported()) {
                hlsInstance = new Hls();
                hlsInstance.loadSource(m3u8Url);
                hlsInstance.attachMedia(video);
            } else {
                alert('Votre navigateur ne supporte pas la lecture HLS.');
                return;
            }

            video.play().catch((error) => {
                console.warn('Lecture auto bloquée par le navigateur', error);
            });
        }

        function closePlayer() {
            const modal = document.getElementById('playerModal');
            const video = document.getElementById('episodePlayer');

            if (hlsInstance) {
                hlsInstance.destroy();
                hlsInstance = null;
            }

            if (video) {
                video.pause();
                video.removeAttribute('src');
                video.load();
            }

            if (modal) {
                modal.classList.add('hidden');
            }

            document.body.classList.remove('overflow-hidden');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePlayer();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('playerModal');
            const box = document.getElementById('playerBox');

            if (modal && box) {
                modal.addEventListener('click', function(e) {
                    if (!box.contains(e.target)) {
                        closePlayer();
                    }
                });
            }
        });
    </script>
</body>

</html>
