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

    @php
        $mediaType = strtolower((string) ($response['type'] ?? ''));
        $isMovie = in_array($mediaType, ['movie', 'film'], true);
        $isSeries = !$isMovie;
    @endphp

    @php
        $movieUrl =
            Arr::get($result, $lang . '.0.url') ??
            (Arr::get($result, 'fr.0.url') ?? (Arr::get($result, 'vo.0.url') ?? null));
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

                    @if (!empty($response['categories']))
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach ($response['categories'] as $category)
                                <span
                                    class="px-3 py-1 bg-surface-variant/50 backdrop-blur-md rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-white border border-white/10">
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

                    <div class="flex flex-wrap items-center gap-4 mt-6">
                        @if ($isSeries)
                            @if (!empty($latestResume))
                                <button type="button" id="resumeButton"
                                    class="bg-gradient-to-r from-primary to-primary-container px-10 py-4 rounded-full flex items-center gap-3 hover:scale-105 transition-transform active:scale-95 shadow-[0_0_20px_rgba(224,141,255,0.2)]">
                                    <span class="material-symbols-outlined text-on-primary-container"
                                        style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                    <span
                                        class="text-on-primary-container font-black uppercase tracking-widest text-sm">
                                        Reprendre
                                    </span>
                                </button>
                            @else
                                <button type="button" id="watchFirstEpisodeButton"
                                    class="bg-gradient-to-r from-primary to-primary-container px-10 py-4 rounded-full flex items-center gap-3 hover:scale-105 transition-transform active:scale-95 shadow-[0_0_20px_rgba(224,141,255,0.2)]">
                                    <span class="material-symbols-outlined text-on-primary-container"
                                        style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                    <span
                                        class="text-on-primary-container font-black uppercase tracking-widest text-sm">
                                        Regarder
                                    </span>
                                </button>
                            @endif
                        @else
                            <button type="button" id="watchMovieButton"
                                class="bg-gradient-to-r from-primary to-primary-container px-10 py-4 rounded-full flex items-center gap-3 hover:scale-105 transition-transform active:scale-95 shadow-[0_0_20px_rgba(224,141,255,0.2)]">
                                <span class="material-symbols-outlined text-on-primary-container"
                                    style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                <span class="text-on-primary-container font-black uppercase tracking-widest text-sm">
                                    {{ !empty($latestResume) ? 'Reprendre' : 'Regarder' }}
                                </span>
                            </button>
                        @endif

                        <button
                            class="w-14 h-14 rounded-full bg-surface-container-highest flex items-center justify-center hover:bg-surface-bright transition-colors">
                            <span class="material-symbols-outlined">add</span>
                        </button>

                        @if ($isSeries && !empty($latestResume))
                            <div class="text-sm text-on-surface-variant">
                                S{{ $latestResume->season_id }} • E{{ $latestResume->episode_id }}
                                • {{ $latestResume->progress_percent }}%
                            </div>
                        @elseif ($isMovie && !empty($latestResume))
                            <div class="text-sm text-on-surface-variant">
                                {{ $latestResume->progress_percent }}%
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Content Area -->
        <div class="max-w-7xl mx-auto px-6 md:px-12 mt-12 grid grid-cols-1 lg:grid-cols-12 gap-16">
            <!-- Left Column -->
            <div class="lg:col-span-8 flex flex-col gap-16">

                {{-- Bloc options de lecture --}}
                <section>
                    <div class="mb-8 space-y-4">
                        <div class="flex items-center justify-between gap-4">
                            <h2 class="text-2xl font-bold tracking-tight shrink-0">
                                {{ $isSeries ? 'Episodes' : 'Lecture' }}
                            </h2>
                        </div>

                        {{-- Ligne saisons uniquement pour les séries --}}
                        @if ($isSeries)
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
                        @endif

                        {{-- Ligne langue pour films ET séries --}}
                        <div class="flex">
                            <div
                                class="flex gap-1 p-1 rounded-full bg-surface-container-highest border border-white/10 w-fit">
                                <a href="{{ $isSeries
                                    ? request()->fullUrlWithQuery(['saison' => $saison, 'lang' => 'fr'])
                                    : request()->fullUrlWithQuery(['lang' => 'fr']) }}"
                                    class="px-5 py-3 rounded-full text-sm font-bold tracking-widest uppercase transition-all whitespace-nowrap
                        {{ $lang === 'fr'
                            ? 'bg-primary text-black shadow-[0_0_20px_rgba(224,141,255,0.35)]'
                            : 'text-white hover:bg-white/5' }}">
                                    VF
                                </a>

                                <a href="{{ $isSeries
                                    ? request()->fullUrlWithQuery(['saison' => $saison, 'lang' => 'vo'])
                                    : request()->fullUrlWithQuery(['lang' => 'vo']) }}"
                                    class="px-5 py-3 rounded-full text-sm font-bold tracking-widest uppercase transition-all whitespace-nowrap
                        {{ $lang === 'vo'
                            ? 'bg-primary text-black shadow-[0_0_20px_rgba(224,141,255,0.35)]'
                            : 'text-white hover:bg-white/5' }}">
                                    VO / MULTI
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Liste des épisodes uniquement pour les séries --}}
                    @if ($isSeries)
                        <div class="flex flex-col gap-2">
                            @php
                                $progressMap = $progressMap ?? [];
                            @endphp

                            @foreach ($responseSaison as $key => $episode)
                                @php
                                    $episodeNumber = Arr::get($episode, 'episode');
                                    $link = Arr::get($result, $lang . '.' . $saison . '.' . $episodeNumber . '.url');
                                @endphp

                                <div class="group flex flex-col md:flex-row items-start md:items-center gap-6 p-4 rounded-xl hover:bg-surface-container-low transition-all cursor-pointer"
                                    onclick="openPlayerByEpisode(@js($episode['name']), @js($link), {{ $loop->index }})">
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

                                            @php
                                                $episodeProgress =
                                                    (int) ($progressMap[$saison . '|' . $episode['episode']] ?? 0);
                                            @endphp

                                            <div
                                                class="h-1 flex-grow max-w-[100px] bg-surface-container-highest rounded-full overflow-hidden">
                                                <div class="h-full bg-white rounded-full transition-all duration-300"
                                                    style="width: {{ max(0, min(100, $episodeProgress)) }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
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
                        <h4 class="text-[10px] font-bold uppercase tracking-[0.2em] text-outline mb-3">Descriptions
                        </h4>
                        <p class="text-on-surface font-medium">
                            {{ Arr::get($response, 'overview', 'No description available.') }}</p>
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
                <div class="pt-2">
                    <button type="button" id="copyResultButton"
                        class="w-full px-5 py-3 rounded-xl bg-primary text-black font-bold uppercase tracking-widest text-sm hover:scale-[1.02] transition">
                        Copier les liens MP4 / M3U8
                    </button>

                    <p id="copyResultMessage" class="mt-3 text-sm text-on-surface-variant hidden"></p>
                </div>
            </div>
        </div>
    </main>

    <!-- BottomNavBar -->
    <nav
        class="fixed bottom-0 left-0 w-full flex justify-around items-center h-20 px-4 pb-4 bg-neutral-950/80 backdrop-blur-2xl z-50 rounded-t-3xl md:hidden">
        <a class="flex flex-col items-center justify-center text-neutral-500 bg-fuchsia-500/10 rounded-full px-4 py-1 active:scale-110 duration-200"
            href="{{ route('alocine') }}">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">home</span>
            <span class="font-body text-[10px] font-bold tracking-[0.05em] uppercase mt-1">Home</span>
        </a>
        <a class="flex flex-col items-center justify-center  text-fuchsia-400 hover:text-neutral-200 transition-all"
            href="{{ route('catalog') }}">
            <span class="material-symbols-outlined">movie_filter</span>
            <span class="font-body text-[10px] font-bold tracking-[0.05em] uppercase mt-1">Catalogue</span>
        </a>
        <a class="flex flex-col items-center justify-center text-neutral-500 hover:text-neutral-200 transition-all"
            href="{{ route('series.history') }}">
            <span class="material-symbols-outlined">history</span>
            <span class="font-body text-[10px] font-bold tracking-[0.05em] uppercase mt-1">Historique</span>
        </a>
        <a class="flex flex-col items-center justify-center text-neutral-500 hover:text-neutral-200 transition-all"
            href="#">
            <span class="material-symbols-outlined">person</span>
            <span class="font-body text-[10px] font-bold tracking-[0.05em] uppercase mt-1">Profile</span>
        </a>
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

                    <!-- Overlay épisode suivant -->
                    <div id="nextEpisodeOverlay"
                        class="hidden absolute inset-0 bg-black/80 flex items-center justify-center p-6 z-[101]">
                        <div
                            class="max-w-md w-full rounded-2xl bg-surface-container-low border border-white/10 p-6 text-center shadow-2xl">

                            <p class="text-sm uppercase tracking-widest text-on-surface-variant mb-2">
                                Lecture terminée
                            </p>

                            <h4 id="nextEpisodeTitle" class="text-xl font-bold mb-3">
                                Épisode suivant
                            </h4>

                            <p class="text-on-surface-variant mb-6">
                                Démarrage dans
                                <span id="nextEpisodeCountdown" class="font-bold text-white">5</span>
                                secondes
                            </p>
                            <div class="mb-6 text-left">
                                <label for="nextEpisodeTriggerSeconds"
                                    class="block text-sm text-on-surface-variant mb-2">
                                    Ouvrir cet écran avant la fin de l’épisode
                                </label>

                                <div class="flex items-center gap-3">
                                    <input id="nextEpisodeTriggerSeconds" type="number" min="0"
                                        max="300" step="1" value="10"
                                        class="w-24 rounded-xl bg-black/40 border border-white/10 px-3 py-2 text-white focus:border-primary focus:ring-0">
                                    <span class="text-sm text-on-surface-variant">secondes</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-center gap-3">

                                <button type="button" id="playNextEpisodeNow"
                                    class="px-5 py-3 rounded-xl bg-primary text-black font-bold uppercase tracking-widest text-sm hover:scale-105 transition">
                                    ▶ Lancer maintenant
                                </button>

                                <button type="button" id="cancelNextEpisode"
                                    class="px-5 py-3 rounded-xl bg-white/10 text-white font-bold uppercase tracking-widest text-sm hover:bg-white/20 transition">
                                    Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

    @php
        $jsEpisodes = $isSeries
            ? collect($responseSaison)
                ->map(function ($episode) use ($result, $lang, $saison) {
                    $episodeNumber = Arr::get($episode, 'episode');

                    return [
                        'id' => Arr::get($episode, 'episode'),
                        'season_id' => (int) $saison,
                        'episode' => $episodeNumber,
                        'title' => Arr::get($episode, 'name'),
                        'poster' => Arr::get($episode, 'poster'),
                        'url' => Arr::get($result, $lang . '.' . $saison . '.' . $episodeNumber . '.url'),
                    ];
                })
                ->values()
            : collect();
    @endphp

    <script>
        window.playerEpisodes = @json($jsEpisodes);
    </script>


    <script>
        window.seriesProgressUrl = @js(route('series.progress.store'));
        window.csrfToken = @js(csrf_token());
        window.isSeries = @json($isSeries);
        window.isMovie = @json($isMovie);

        window.currentSeries = {
            series_id: @json($response['id'] ?? null),
            series_title: @json($response['title'] ?? ''),
            episode_id: @json($isMovie ? 1 : null),
            episode_title: @json($isMovie ? $response['title'] ?? '' : ''),
            poster: @json(Arr::get($response, 'posters.small')),
            season_id: @json($isMovie ? 1 : $saison),
        };

        window.movieUrl = @json($movieUrl);
    </script>

    @php
        $seriesResumesMap = collect($seriesResumes ?? collect())
            ->mapWithKeys(function ($resume) {
                return [
                    $resume->season_id . '|' . $resume->episode_id => [
                        'season_id' => $resume->season_id,
                        'episode_id' => $resume->episode_id,
                        'current_time' => $resume->current_time,
                        'progress_percent' => $resume->progress_percent,
                    ],
                ];
            })
            ->toArray();
    @endphp

    <script>
        window.seriesResumesMap = @json($seriesResumesMap);
    </script>

    <script>
        let hlsInstance = null;
        let currentEpisodeIndex = null;
        let nextEpisodeTimeout = null;
        let nextEpisodeInterval = null;
        let nextEpisodeRemaining = 5;
        let nextEpisodeOverlayShown = false;

        const NEXT_EPISODE_TRIGGER_KEY = 'next_episode_trigger_seconds';

        function getNextEpisodeTriggerSeconds() {
            const saved = localStorage.getItem(NEXT_EPISODE_TRIGGER_KEY);
            const value = parseInt(saved ?? '10', 10);

            if (Number.isNaN(value)) return 10;
            return Math.max(0, Math.min(300, value));
        }

        function setNextEpisodeTriggerSeconds(value) {
            const normalized = Math.max(0, Math.min(300, parseInt(value || '10', 10)));
            localStorage.setItem(NEXT_EPISODE_TRIGGER_KEY, String(normalized));

            const input = document.getElementById('nextEpisodeTriggerSeconds');
            if (input) {
                input.value = normalized;
            }

            return normalized;
        }

        function getNextEpisode() {
            if (window.isMovie) return null;
            if (!Array.isArray(window.playerEpisodes)) return null;
            if (currentEpisodeIndex === null) return null;

            return window.playerEpisodes[currentEpisodeIndex + 1] ?? null;
        }

        function hideNextEpisodeOverlay() {
            const overlay = document.getElementById('nextEpisodeOverlay');
            const countdown = document.getElementById('nextEpisodeCountdown');

            if (overlay) overlay.classList.add('hidden');
            if (countdown) countdown.textContent = '5';

            if (nextEpisodeTimeout) {
                clearTimeout(nextEpisodeTimeout);
                nextEpisodeTimeout = null;
            }

            if (nextEpisodeInterval) {
                clearInterval(nextEpisodeInterval);
                nextEpisodeInterval = null;
            }

            nextEpisodeRemaining = 5;
        }

        function showNextEpisodeOverlay() {
            const overlay = document.getElementById('nextEpisodeOverlay');
            const title = document.getElementById('nextEpisodeTitle');
            const countdown = document.getElementById('nextEpisodeCountdown');

            const nextEpisode = getNextEpisode();

            if (!overlay || !nextEpisode || !nextEpisode.url) {
                return;
            }

            title.textContent = nextEpisode.title || 'Épisode suivant';
            countdown.textContent = '5';
            overlay.classList.remove('hidden');

            nextEpisodeRemaining = 5;

            nextEpisodeInterval = setInterval(() => {
                nextEpisodeRemaining--;

                if (countdown) {
                    countdown.textContent = String(Math.max(0, nextEpisodeRemaining));
                }
            }, 1000);

            nextEpisodeTimeout = setTimeout(() => {
                playNextEpisode();
            }, 5000);
        }

        function openPlayerByEpisode(title, m3u8Url, episodeIndex = null) {
            currentEpisodeIndex = episodeIndex;
            nextEpisodeOverlayShown = false;

            const episodeData = Array.isArray(window.playerEpisodes) ?
                window.playerEpisodes[episodeIndex] ?? null :
                null;

            if (episodeData) {
                window.currentSeries.episode_id = episodeData.id ?? null;
                window.currentSeries.episode_title = episodeData.title ?? title ?? '';
                window.currentSeries.poster = episodeData.poster ?? window.currentSeries.poster ?? null;
                window.currentSeries.season_id = episodeData.season_id ?? window.currentSeries.season_id ?? null;
            }

            const seasonId = Number(window.currentSeries.season_id || 0);
            const episodeId = Number(window.currentSeries.episode_id || 0);
            const resumeKey = `${seasonId}|${episodeId}`;
            const resume = window.seriesResumesMap?.[resumeKey] ?? null;

            console.log('resumeKey', resumeKey);
            console.log('resume', resume);
            console.log('available keys', Object.keys(window.seriesResumesMap || {}));
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

            hideNextEpisodeOverlay();
            nextEpisodeOverlayShown = false;

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

            const applyResumeAndPlay = () => {
                const savedTime = Number(resume?.current_time || 0);

                if (savedTime > 0 && Number.isFinite(video.duration) && savedTime < video.duration - 10) {
                    video.currentTime = savedTime;
                }

                video.play().catch((error) => {
                    console.warn('Lecture auto bloquée par le navigateur', error);
                });
            };

            if (video.canPlayType('application/vnd.apple.mpegurl')) {
                video.src = m3u8Url;
                video.addEventListener('loadedmetadata', function onLoaded() {
                    applyResumeAndPlay();
                    video.removeEventListener('loadedmetadata', onLoaded);
                });
            } else if (window.Hls && Hls.isSupported()) {
                hlsInstance = new Hls();
                hlsInstance.loadSource(m3u8Url);
                hlsInstance.attachMedia(video);

                video.addEventListener('loadedmetadata', function onLoaded() {
                    applyResumeAndPlay();
                    video.removeEventListener('loadedmetadata', onLoaded);
                });
            } else {
                alert('Votre navigateur ne supporte pas la lecture HLS.');
                return;
            }
        }

        function openPlayer(title, m3u8Url, resumeTime = 0) {
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

            hideNextEpisodeOverlay();
            nextEpisodeOverlayShown = false;

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

        function playNextEpisode() {
            const nextEpisode = getNextEpisode();

            if (!nextEpisode || !nextEpisode.url) {
                hideNextEpisodeOverlay();
                return;
            }

            currentEpisodeIndex = currentEpisodeIndex + 1;
            hideNextEpisodeOverlay();
            nextEpisodeOverlayShown = false;
            openPlayer(nextEpisode.title, nextEpisode.url);
        }

        function closePlayer() {
            const modal = document.getElementById('playerModal');
            const video = document.getElementById('episodePlayer');

            hideNextEpisodeOverlay();
            nextEpisodeOverlayShown = false;

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
            const video = document.getElementById('episodePlayer');
            const playNextBtn = document.getElementById('playNextEpisodeNow');
            const cancelNextBtn = document.getElementById('cancelNextEpisode');
            const triggerInput = document.getElementById('nextEpisodeTriggerSeconds');

            if (triggerInput) {
                triggerInput.value = getNextEpisodeTriggerSeconds();

                triggerInput.addEventListener('change', function() {
                    setNextEpisodeTriggerSeconds(this.value);
                });
            }

            if (modal && box) {
                modal.addEventListener('click', function(e) {
                    if (!box.contains(e.target)) {
                        closePlayer();
                    }
                });
            }

            if (video) {
                video.addEventListener('timeupdate', function() {
                    const nextEpisode = getNextEpisode();
                    if (!nextEpisode || !nextEpisode.url) return;
                    if (nextEpisodeOverlayShown) return;
                    if (!Number.isFinite(video.duration) || video.duration <= 0) return;

                    const remaining = video.duration - video.currentTime;
                    const triggerSeconds = getNextEpisodeTriggerSeconds();

                    if (remaining <= triggerSeconds) {
                        nextEpisodeOverlayShown = true;
                        showNextEpisodeOverlay();
                    }
                });

                video.addEventListener('ended', function() {
                    if (!nextEpisodeOverlayShown) {
                        nextEpisodeOverlayShown = true;
                        showNextEpisodeOverlay();
                    }
                });
            }

            if (playNextBtn) {
                playNextBtn.addEventListener('click', function() {
                    playNextEpisode();
                });
            }

            if (cancelNextBtn) {
                cancelNextBtn.addEventListener('click', function() {
                    hideNextEpisodeOverlay();
                });
            }
        });
    </script>

    <script>
        window.resultToCopy = @json($result, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const copyButton = document.getElementById('copyResultButton');
            const copyMessage = document.getElementById('copyResultMessage');

            if (!copyButton) return;

            function showMessage(text, isError = false) {
                if (!copyMessage) return;
                copyMessage.textContent = text;
                copyMessage.classList.remove('hidden', 'text-red-300', 'text-green-300', 'text-on-surface-variant');
                copyMessage.classList.add(isError ? 'text-red-300' : 'text-green-300');
            }

            async function copyTextToClipboard(text) {
                if (navigator.clipboard && window.isSecureContext) {
                    await navigator.clipboard.writeText(text);
                    return;
                }

                const textarea = document.createElement('textarea');
                textarea.value = text;
                textarea.style.position = 'fixed';
                textarea.style.opacity = '0';
                textarea.style.pointerEvents = 'none';
                document.body.appendChild(textarea);
                textarea.focus();
                textarea.select();

                const success = document.execCommand('copy');
                document.body.removeChild(textarea);

                if (!success) {
                    throw new Error('Copie impossible');
                }
            }

            copyButton.addEventListener('click', async function() {
                try {
                    const text = typeof window.resultToCopy === 'string' ?
                        window.resultToCopy :
                        JSON.stringify(window.resultToCopy, null, 2);

                    await copyTextToClipboard(text);

                    showMessage('Les liens ont été copiés dans le presse-papiers.');
                } catch (error) {
                    console.error(error);
                    showMessage('Impossible de copier les liens.', true);
                }
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('episodePlayer');

            if (!video || !window.currentSeries?.series_id) return;

            let lastSavedAt = 0;
            const SAVE_EVERY_SECONDS = 120;

            let saveInFlight = false;
            let lastSaveKey = null;
            let lastSaveSentAt = 0;
            const MIN_SAVE_GAP_MS = 1500;

            function buildSavePayload(eventType = 'progress') {
                if (!window.currentSeries?.series_id) return null;
                if (!window.currentSeries?.episode_id) return null;
                if (!video.duration || isNaN(video.duration)) return null;

                const currentTime = Math.floor(video.currentTime || 0);
                const duration = Math.floor(video.duration || 0);

                return {
                    series_id: window.currentSeries.series_id,
                    series_title: window.currentSeries.series_title,
                    episode_id: window.currentSeries.episode_id,
                    episode_title: window.currentSeries.episode_title,
                    current_time: currentTime,
                    duration: duration,
                    poster: window.currentSeries.poster,
                    season_id: window.currentSeries.season_id ?? null,
                    event_type: eventType,
                    media_type: window.isMovie ? 'movie' : 'series',
                };
            }

            async function saveProgress(force = false, eventType = 'progress') {
                const payload = buildSavePayload(eventType);
                if (!payload) return;

                const currentTime = payload.current_time;
                const nowMs = Date.now();

                if (!force && (currentTime - lastSavedAt) < SAVE_EVERY_SECONDS) {
                    return;
                }
                console.log('Tentative de sauvegarde progression', payload);
                const saveKey = [
                    payload.series_id,
                    payload.episode_id,
                    payload.current_time,
                    payload.duration,
                    payload.media_type,
                    payload.event_type
                ].join('|');

                if (saveInFlight && saveKey === lastSaveKey) {
                    return;
                }

                if (saveKey === lastSaveKey && (nowMs - lastSaveSentAt) < MIN_SAVE_GAP_MS) {
                    return;
                }

                saveInFlight = true;
                lastSaveKey = saveKey;
                lastSaveSentAt = nowMs;
                lastSavedAt = currentTime;

                try {
                    const response = await fetch(window.seriesProgressUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': window.csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: JSON.stringify(payload)
                    });

                    if (!response.ok) {
                        const text = await response.text();
                        console.error('Erreur HTTP sauvegarde progression', response.status, text);
                    }
                } catch (error) {
                    console.error('Erreur sauvegarde progression', error);
                } finally {
                    saveInFlight = false;
                }
            }

            video.addEventListener('timeupdate', function() {
                saveProgress(false, 'progress');
            });

            video.addEventListener('pause', function() {
                saveProgress(true, 'pause');
            });

            video.addEventListener('ended', function() {
                saveProgress(true, 'ended');
            });

            document.addEventListener('visibilitychange', function() {
                if (document.visibilityState === 'hidden') {
                    saveProgress(true, 'hidden');
                }
            });

            window.saveCurrentEpisodeStart = function() {
                saveProgress(true, 'start');
            };
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('episodePlayer');
            const resume = @json($latestResume ?? null);

            if (!video || !resume) return;

            const savedEpisodeId = Number(resume.episode_id || 0);

            if (!savedEpisodeId || !Array.isArray(window.playerEpisodes)) return;

            const foundIndex = window.playerEpisodes.findIndex(ep => Number(ep.id || 0) === savedEpisodeId);
            if (foundIndex === -1) return;

            const savedEpisode = window.playerEpisodes[foundIndex];
            if (!savedEpisode?.url) return;

            window.currentSeries.episode_id = savedEpisode.id ?? null;
            window.currentSeries.episode_title = savedEpisode.title ?? '';
            window.currentSeries.poster = savedEpisode.poster ?? window.currentSeries.poster ?? null;
            window.currentSeries.season_id = savedEpisode.season_id ?? window.currentSeries.season_id ?? null;

            openPlayerByEpisode(savedEpisode.title, savedEpisode.url, foundIndex);

            video.addEventListener('loadedmetadata', function onLoaded() {
                const savedTime = Number(resume.current_time || 0);

                if (savedTime > 0 && savedTime < video.duration - 10) {
                    video.currentTime = savedTime;
                }

                video.removeEventListener('loadedmetadata', onLoaded);
            });
        });
    </script> --}}

   <script>
document.addEventListener('DOMContentLoaded', function() {
    const resumeButton = document.getElementById('resumeButton');
    const latestResume = @json($latestResume ?? null);

    if (!resumeButton || !latestResume) return;

    resumeButton.addEventListener('click', function() {
        if (window.isMovie) {
            if (!window.movieUrl) {
                console.warn('Aucune URL film trouvée');
                return;
            }

            openPlayer(window.currentSeries.series_title, window.movieUrl);

            const video = document.getElementById('episodePlayer');
            if (!video) return;

            video.addEventListener('loadedmetadata', function onLoaded() {
                try {
                    let time = Number(latestResume.current_time || 0);

                    if (!Number.isFinite(time) || time < 0) {
                        time = 0;
                    }

                    if (Number.isFinite(video.duration) && video.duration > 0) {
                        if (time > 0 && time < video.duration - 10) {
                            video.currentTime = time;
                        }
                    }
                } catch (e) {
                    console.warn('Resume impossible', e);
                }

                video.removeEventListener('loadedmetadata', onLoaded);
            });

            return;
        }

        const seasonId = Number(latestResume.season_id || 0);
        const episodeId = Number(latestResume.episode_id || 0);

        if (seasonId !== Number(@json($saison))) {
            const url = new URL(window.location.href);
            url.searchParams.set('saison', seasonId);
            window.location.href = url.toString();
            return;
        }

        const foundIndex = window.playerEpisodes.findIndex(ep =>
            Number(ep.id || 0) === episodeId &&
            Number(ep.season_id || 0) === seasonId
        );

        if (foundIndex === -1) return;

        const savedEpisode = window.playerEpisodes[foundIndex];
        if (!savedEpisode?.url) return;

        window.currentSeries.episode_id = savedEpisode.id ?? null;
        window.currentSeries.episode_title = savedEpisode.title ?? '';
        window.currentSeries.poster = savedEpisode.poster ?? window.currentSeries.poster ?? null;
        window.currentSeries.season_id = savedEpisode.season_id ?? window.currentSeries.season_id ?? null;

        openPlayerByEpisode(savedEpisode.title, savedEpisode.url, foundIndex);

        const video = document.getElementById('episodePlayer');
        if (!video) return;

        video.addEventListener('loadedmetadata', function onLoaded() {
            const savedTime = Number(latestResume.current_time || 0);

            if (
                Number.isFinite(savedTime) &&
                savedTime > 0 &&
                Number.isFinite(video.duration) &&
                savedTime < video.duration - 10
            ) {
                video.currentTime = savedTime;
            }

            video.removeEventListener('loadedmetadata', onLoaded);
        });
    });
});
</script>

  <script>
document.addEventListener('DOMContentLoaded', function() {
    const watchMovieButton = document.getElementById('watchMovieButton');
    const latestResume = @json($latestResume ?? null);

    if (!watchMovieButton || !window.isMovie) return;

    watchMovieButton.addEventListener('click', function() {
        if (!window.movieUrl) {
            console.warn('Aucune URL film trouvée');
            return;
        }

        openPlayer(window.currentSeries.series_title, window.movieUrl);

        const video = document.getElementById('episodePlayer');
        if (!video) return;

        video.addEventListener('loadedmetadata', function onLoaded() {
            const savedTime = Number(latestResume?.current_time || 0);

            if (
                Number.isFinite(savedTime) &&
                savedTime > 0 &&
                Number.isFinite(video.duration) &&
                savedTime < video.duration - 10
            ) {
                video.currentTime = savedTime;
            }

            video.removeEventListener('loadedmetadata', onLoaded);
        });
    });
});
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const watchFirstEpisodeButton = document.getElementById('watchFirstEpisodeButton');
            if (!watchFirstEpisodeButton || !window.isSeries) return;

            watchFirstEpisodeButton.addEventListener('click', function() {
                const firstEpisode = Array.isArray(window.playerEpisodes) ? window.playerEpisodes[0] ??
                    null : null;
                if (!firstEpisode?.url) return;

                openPlayerByEpisode(firstEpisode.title, firstEpisode.url, 0);
            });
        });
    </script>


</body>

</html>
