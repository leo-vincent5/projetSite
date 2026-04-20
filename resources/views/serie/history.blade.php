<!DOCTYPE html>
<html class="dark" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Historique</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;700;800;900&family=Manrope:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-container-low": "#131313",
                        "surface-variant": "#262626",
                        "surface-container": "#1a1a1a",
                        "surface-container-highest": "#262626",
                        "surface-container-high": "#20201f",
                        "surface": "#0e0e0e",
                        "background": "#0e0e0e",
                        "primary": "#e08dff",
                        "on-surface": "#ffffff",
                        "on-surface-variant": "#adaaaa",
                        "outline": "#767575",
                    },
                    borderRadius: {
                        "2xl": "1.5rem",
                        "3xl": "2rem",
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

        .aura-gradient {
            background: linear-gradient(135deg, #e08dff 0%, #BF00FF 100%);
        }

        body {
            min-height: 100dvh;
        }
    </style>
</head>

<body class="bg-surface text-on-surface font-body selection:bg-primary selection:text-black">
    @php
        $continueWatchingGrouped = $continueWatchingGrouped ?? collect();
        $recentlyWatchedGrouped = $recentlyWatchedGrouped ?? collect();

        $formatMinutesLeft = function ($currentTime, $duration) {
            $remaining = max(0, (int) $duration - (int) $currentTime);
            return ceil($remaining / 60) . 'm restantes';
        };

        $formatDate = function ($date) {
            return $date ? \Carbon\Carbon::parse($date)->translatedFormat('d M Y') : null;
        };
    @endphp

    <header class="fixed top-0 w-full z-50 bg-neutral-950/60 backdrop-blur-2xl">
        <div class="flex justify-between items-center px-6 py-4 w-full max-w-screen-2xl mx-auto">
            <div class="flex items-center gap-4">
                <button onclick="history.back()" class="hover:text-[#BF00FF] transition-colors duration-300">
                    <span class="material-symbols-outlined text-2xl text-[#BF00FF]">arrow_back</span>
                </button>
                <h1 class="font-headline tracking-tight font-bold text-3xl text-white">Historique</h1>
            </div>
        </div>
    </header>

    <main class="pt-24 pb-24 px-6 max-w-screen-2xl mx-auto min-h-screen">
        <section class="mb-14">
            <div class="flex justify-between items-end mb-6">
                <h2 class="font-headline font-bold text-2xl tracking-tight">Continuer le visionnage</h2>
                <span class="text-sm text-on-surface-variant tracking-wider">
                    {{ $continueWatchingGrouped->count() }} contenu(x)
                </span>
            </div>

            @if ($continueWatchingGrouped->isEmpty())
                <div class="rounded-3xl bg-surface-container-low p-8 text-on-surface-variant">
                    Aucune reprise en cours.
                </div>
            @else
                <div class="space-y-8">
                    @foreach ($continueWatchingGrouped as $group)
                        @php
                            $latest = $group['latest'];
                            $episodes = collect($group['episodes'])->sortByDesc('updated_at_resume')->values();
                            $isSeries = ($group['media_type'] ?? 'series') === 'series';
                            $isMovie = ($group['media_type'] ?? 'series') === 'movie';

                            $watchUrl = route(
                                'oneserie',
                                array_filter([
                                    'id' => $group['series_id'],
                                    'saison' => $isSeries ? $latest->season_id ?? 1 : null,
                                ]),
                            );
                        @endphp

                        <div class="rounded-3xl bg-surface-container-low overflow-hidden">
                            <div class="grid grid-cols-1 lg:grid-cols-[420px_1fr]">
                                <a href="{{ $watchUrl }}" class="relative min-h-[260px] block">
                                    <img src="{{ $group['poster'] ?: 'https://placehold.co/900x500/131313/FFFFFF?text=Media' }}"
                                        alt="{{ $group['series_title'] }}"
                                        class="absolute inset-0 w-full h-full object-cover opacity-80">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent">
                                    </div>

                                    <div class="absolute bottom-0 left-0 w-full p-6 space-y-3">
                                        <div>
                                            <p
                                                class="text-[10px] uppercase tracking-widest font-bold {{ $isSeries ? 'text-[#BF00FF]' : 'text-cyan-300' }}">
                                                {{ $isSeries ? 'Série' : 'Film' }}
                                            </p>

                                            <h3 class="font-headline font-bold text-2xl leading-tight">
                                                {{ $group['series_title'] }}
                                            </h3>

                                            <p class="text-sm text-on-surface-variant mt-1">
                                                @if ($isSeries)
                                                    S{{ $latest->season_id }} • E{{ $latest->episode_id }}
                                                    @if ($latest->episode_title)
                                                        • {{ $latest->episode_title }}
                                                    @endif
                                                @else
                                                    {{ $latest->episode_title ?: 'Film en cours' }}
                                                @endif
                                            </p>
                                        </div>

                                        <div class="space-y-2">
                                            <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden">
                                                <div class="h-full aura-gradient"
                                                    style="width: {{ max(0, min(100, (int) $latest->progress_percent)) }}%">
                                                </div>
                                            </div>

                                            <div class="flex justify-between items-center">
                                                <span class="text-xs text-on-surface-variant">
                                                    {{ $formatMinutesLeft($latest->current_time, $latest->duration) }}
                                                </span>

                                                <span
                                                    class="aura-gradient text-black font-bold text-xs px-5 py-2 rounded-full flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-sm"
                                                        style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                                    REPRENDRE
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h4 class="font-headline font-bold text-xl">{{ $group['series_title'] }}</h4>

                                        <span class="text-xs uppercase tracking-widest text-on-surface-variant">
                                            {{ $isSeries ? $episodes->count() . ' épisode(s)' : 'Film' }}
                                        </span>
                                    </div>

                                    <div class="space-y-3">
                                        @foreach ($episodes as $episode)
                                            <a href="{{ route(
                                                'oneserie',
                                                array_filter([
                                                    'id' => $group['series_id'],
                                                    'saison' => $isSeries ? $episode->season_id ?? 1 : null,
                                                ]),
                                            ) }}"
                                                class="flex items-center justify-between gap-4 rounded-2xl bg-surface-container px-4 py-4 hover:bg-surface-container-high transition">

                                                <div class="min-w-0">
                                                    @if ($isSeries)
                                                        <p class="text-sm font-bold text-white truncate">
                                                            S{{ $episode->season_id }} • E{{ $episode->episode_id }}
                                                            @if ($episode->episode_title)
                                                                • {{ $episode->episode_title }}
                                                            @endif
                                                        </p>
                                                    @else
                                                        <p class="text-sm font-bold text-white truncate">
                                                            {{ $episode->episode_title ?: $group['series_title'] }}
                                                        </p>
                                                    @endif

                                                    <p class="text-xs text-on-surface-variant mt-1">
                                                        {{ $episode->progress_percent }}% •
                                                        {{ $formatMinutesLeft($episode->current_time, $episode->duration) }}
                                                    </p>
                                                </div>

                                                <div
                                                    class="w-24 h-1.5 bg-white/10 rounded-full overflow-hidden flex-shrink-0">
                                                    <div class="h-full bg-white"
                                                        style="width: {{ max(0, min(100, (int) $episode->progress_percent)) }}%">
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <section>
            <div class="flex justify-between items-end mb-6">
                <h2 class="font-headline font-bold text-2xl tracking-tight">Vu récemment</h2>
                <span class="text-sm text-on-surface-variant tracking-wider">
                    {{ $recentlyWatchedGrouped->count() }} séries
                </span>
            </div>

            @if ($recentlyWatchedGrouped->isEmpty())
                <div class="rounded-3xl bg-surface-container-low p-8 text-on-surface-variant">
                    Aucun historique récent.
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($recentlyWatchedGrouped as $group)
                        @php
                            $episodes = collect($group['episodes'])->sortByDesc('watched_at')->values();
                            $isSeries = ($group['media_type'] ?? 'series') === 'series';
                            $isMovie = ($group['media_type'] ?? 'series') === 'movie';

                            $watchUrl = route(
                                'oneserie',
                                array_filter([
                                    'id' => $group['series_id'],
                                    'saison' => $isSeries ? $episodes->first()->season_id ?? 1 : null,
                                ]),
                            );
                        @endphp

                        <div class="rounded-3xl bg-surface-container-low p-5 md:p-6">
                            <div class="flex items-start gap-5">
                                <a href="{{ $watchUrl }}"
                                    class="w-24 h-36 md:w-28 md:h-40 flex-shrink-0 overflow-hidden rounded-xl block">
                                    <img src="{{ $group['poster'] ?: 'https://placehold.co/300x430/131313/FFFFFF?text=Poster' }}"
                                        alt="{{ $group['series_title'] }}" class="w-full h-full object-cover">
                                </a>

                                <div class="flex-grow min-w-0">
                                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3 mb-4">
                                        <div>
                                            <h3 class="font-headline font-bold text-xl md:text-2xl">
                                                {{ $group['series_title'] }}
                                            </h3>
                                            <p class="text-sm text-on-surface-variant mt-1">
                                                Dernier visionnage : {{ $formatDate($group['latest_watched_at']) }}
                                            </p>
                                        </div>

                                        <span class="text-xs uppercase tracking-widest text-on-surface-variant">
                                            {{ $episodes->count() }} épisode(s) terminé(s)
                                        </span>
                                    </div>

                                    <div class="space-y-3">
                                        @foreach ($episodes as $episode)
                                            <a href="{{ route('oneserie', ['id' => $group['series_id'], 'saison' => $episode->season_id ?? 1]) }}"
                                                class="flex items-center justify-between gap-4 rounded-2xl bg-surface-container px-4 py-4 hover:bg-surface-container-high transition">
                                                <div class="min-w-0">
                                                    <p class="font-bold text-white truncate">
                                                        S{{ $episode->season_id }} • E{{ $episode->episode_id }}
                                                        @if ($episode->episode_title)
                                                            • {{ $episode->episode_title }}
                                                        @endif
                                                    </p>
                                                    <p class="text-xs text-on-surface-variant mt-1">
                                                        Vu
                                                        {{ $formatDate($episode->watched_at ?? $episode->updated_at) }}
                                                    </p>
                                                </div>

                                                <span
                                                    class="px-2 py-1 rounded text-[10px] font-bold bg-surface-container-highest text-on-surface-variant flex-shrink-0">
                                                    TERMINÉ
                                                </span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <nav
                class="fixed bottom-0 left-0 w-full flex justify-around items-center h-20 px-4 pb-4 bg-neutral-950/80 backdrop-blur-2xl z-50 rounded-t-3xl md:hidden">
                <a class="flex flex-col items-center justify-center text-neutral-500 bg-fuchsia-500/10 rounded-full px-4 py-1 active:scale-110 duration-200"
                    href="{{ route('alocine') }}">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">home</span>
                    <span class="font-body text-[10px] font-bold tracking-[0.05em] uppercase mt-1">Home</span>
                </a>
                <a class="flex flex-col items-center justify-center text-neutral-500 hover:text-neutral-200 transition-all"
                    href="{{ route('catalog') }}">
                    <span class="material-symbols-outlined">movie_filter</span>
                    <span class="font-body text-[10px] font-bold tracking-[0.05em] uppercase mt-1">Catalogue</span>
                </a>
                <a class="flex flex-col items-center justify-center text-fuchsia-400  hover:text-neutral-200 transition-all"
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

        </section>
    </main>
</body>

</html>
