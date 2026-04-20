{{-- resources/views/streaming/catalog.blade.php --}}
@php
    $filters = $filters ?? ['All Series', 'Sci-Fi', 'Thriller', 'Drama', 'Noir', 'Documentary', 'Limited Edition'];

    $activeFilter = $activeFilter ?? 'All Series';

    $series = $series ?? [
        [
            'title' => 'NEON VELVET',
            'match' => '98% MATCH',
            'year' => '2024',
            'rating' => 'TV-MA',
            'badge' => 'Premium',
            'image' =>
                'https://lh3.googleusercontent.com/aida-public/AB6AXuB6D3P26mt8agySmahNpCOJzlTZG3ziGZ7CDQmC5Ra9P4b-DceP0YUKVH1Zp79renljNsHeUwQ_bmZiFnI7dHEeAXkIRlliyl9rNGpEP0G5IzFTUD1y7RIxcQE8U94JxpjJyLfn5u8FMo7-UTQ3A1C9gwE-sSXMPKCrVTtVM9mZmkIfY6BVEbq1O3xDEv6FMohHzYFzJwc_Zo7Is5XAfpAdRIU2sIiHiJzZsduz4Qv7GmD0zrFsZdZ_7cqtaJk-GDQxlqVrQbfRpVw',
        ],
        [
            'title' => 'CHASE THE ECHO',
            'match' => '94% MATCH',
            'year' => '2023',
            'rating' => '18+',
            'image' =>
                'https://lh3.googleusercontent.com/aida-public/AB6AXuAT6t8jGPhHXW_8Em3h6oP_EAQri4ZB4OAghNJOKhFuEp3GblcrJbkOJzj_BJn_dUf_Lx5_IgluI6HJKh_1751NfmlTmR-8LTmspspdN5AvZlGvh5tqDlDJvL134GdxVKN-2DyGh2QZOoBtkyk-rk_a369japOZXwnYI2w2E8egdMafBNLxo9kiqcf536_zMqNn25yhgkSWyxDS3t2D8pI7aiitMErLxpkdw8got1qyGoR1Aasj-DcPBeiZa09O_VQYpnooXT-j110',
        ],
        [
            'title' => 'SILENT ORBIT',
            'match' => '89% MATCH',
            'year' => '2024',
            'rating' => 'TV-14',
            'image' =>
                'https://lh3.googleusercontent.com/aida-public/AB6AXuAeLhlNHEmgr1XngwwhOv7vTDt4B5PRdojv8uBixIeqDHSjiIg3Kn_hJCR9J8FIbINcxoJyx9F6ss80PLJN4VcKv8R2e7ARiJuZ9rn8UyfamLLC_ZgKzJY3y8FD0SXXoF9ohD_OHsB3fE7bmmZEAUivjjuj5b6bxXSIGlE7qC5fPvK6aSDSSJXtgjN6f2SZWU6jAp9VyVt7RMOdc-rg5i8gRKTqLpyq9K0x8hBI1-f51a44JKa-qByRm3ow3tmq-4opBWiUU879r2U',
        ],
        [
            'title' => 'MIND FRAME',
            'match' => '99% MATCH',
            'year' => '2024',
            'rating' => 'TV-MA',
            'image' =>
                'https://lh3.googleusercontent.com/aida-public/AB6AXuAEQPY6bPh5ZXBwfIfLshwJmSbm3thllTX0wB2vE_4xSulsYi5VSXNqYloOHFa73pLvnxjJXbaeUGVeYmcigRyNfeKW5QLywKQQoGtbuUiGamlEjJ_NhM7TQKL5H0WhsyDwpNn1ddR-GHn9_PFi500tlZIH1B9duwPFHp0vrpKDhhR_JbyKnwjITw6f7obgn-f9eC5V5HFyEAB8aXA9Pt5drOJW_Emd6b4TXbPmRxciFi0zPhZBdXHv1j29bp_ZRYzrxB6yPrVyrWk',
        ],
        [
            'title' => 'DUNE STRAND',
            'match' => '82% MATCH',
            'year' => '2022',
            'rating' => 'TV-PG',
            'image' =>
                'https://lh3.googleusercontent.com/aida-public/AB6AXuD7NaCB2nU34BjSFfzKUc8ZQnC91CgBHUfnExoGRzkBmDKAkifSdBNMPKlsgNw0wguQWQTz4DGOqTLDAP5cicFa1kbyEhT_HJevTd90naPMqZ3WEz2LSMvK1eoDpO_dIxZVupnMTMeRCgzRgslFe4bM2xzDmzjYpLdEtcj5pcWpDCyDS4yKGvP0PX8wMv1Nqh0tV4ZO3SSR_7Z3EpUesFCWM6GFJzqsffhpsGQ7ulJ_XTcwY8fJb99SLs8TsEO6ktZhiYpW-5fkhBA',
        ],
        [
            'title' => 'NIGHT DRIFT',
            'match' => '91% MATCH',
            'year' => '2024',
            'rating' => 'TV-MA',
            'image' =>
                'https://lh3.googleusercontent.com/aida-public/AB6AXuDF7e3hFsLzZ3BN2daj2P3lN9Xs7sZgYyLUmqbXJnNqOY1rSCFPzVBmSUPYBkgoQL_kq2Zzrd44KK-g0TMcatyJJ-gWMEPxFz_3pXP2TQxuNxDeHvWV0n-FOpbEi0MXfmuzXv4kHeVJTRhkfnCU1mOlC1guB-KQ43Qncdho1_rhuXCq4yubeisB3iZxaqhVUu0FZkA4ZaIY6o-Y_MttH40OaYC68fe9VYMW1GUC7d1loXpeOFOOz1xnb-IYdYdBQC_r2y3HSmrud64',
        ],
        [
            'title' => 'BLOOM THEORY',
            'match' => '78% MATCH',
            'year' => '2023',
            'rating' => 'TV-14',
            'image' =>
                'https://lh3.googleusercontent.com/aida-public/AB6AXuBJyeNvBr35QHt0k6sTwqbigxo989cH04lIp_QfzD7Lkb5mRRej98M3t2RwgvS5iBnF2BQihaSxuJgIprhxy096BDRadxDWaTkai_05We_roeZXZytsmKKqvTmDEyOd0Xzr3OxwoRISI1vLOIbrFRLh8GMCz7KaYMKEopWzVL2wDjQHuaBLF0EUzrbpgSSgblwZVL8m2i_TiacgL-QOfyOrG5fe22NWWliiO3rLgSkptL3uozS0Y4HOWjFHLGfYKFbe_b_C6J4uqQE',
        ],
        [
            'title' => 'THE FOUNDRY',
            'match' => '95% MATCH',
            'year' => '2024',
            'rating' => 'TV-MA',
            'image' =>
                'https://lh3.googleusercontent.com/aida-public/AB6AXuDAYPjWptg944O8gAkkt2crAgaptPlAeMES61yV5Z6Fm4yF2eDHX1_R36o6sckpMbK0AQ9ne_0_SisznChsora2JbJ40in164TbXR94lbD-thLcoIopcACHHDNrpUaXbhBDXwfDX8xbXudiKD05FLiibMgi7u7VWQBeAUAniiVSlQOyxL3oj2a8Dk7WtZAxDaP2XnQnm0rM1G-D87cy3y6EC8hnd7KO_c5D-Zxw19LPS88atixgHlX-m6gNPdJ7jVeyutOPXC4ppn8',
        ],
        [
            'title' => 'CODE BREAKER',
            'match' => '87% MATCH',
            'year' => '2023',
            'rating' => 'TV-G',
            'image' =>
                'https://lh3.googleusercontent.com/aida-public/AB6AXuDFlKdBAiV7kjQWXImtpTHldJlT2SOwaGEdJmcpYCmEvdvPbmlIFcZN4LyUyaU3g6tOBREEnFGGGPBZwaFjArovL_9SsqmZRXU6Om1IbMmqsk77ZFsjob2Ini-KFysLK7XLCE33-_Caap7AkknoFZ5gL6bhZJGpHF6VVvNufXRErBPzDMBAUDtQfSjwl4y2IFq89544TP9TCFsYWPUo2-WF91W6WIbpAh3Qr--OrRp_gL1eQG1zGmIHRxfDGIY-C-IOyoRkmpGbw5E',
        ],
        [
            'title' => 'STARRY ECHO',
            'match' => '92% MATCH',
            'year' => '2024',
            'rating' => 'TV-14',
            'image' =>
                'https://lh3.googleusercontent.com/aida-public/AB6AXuDLL7mzYjxYCKlUVo-OjgNXcKfB3wbyyHt5VcFpOVw_0APc3buXBq1X1SFM8oPRGBemFjNfFFIH8G9abd4AXjdqRgUx9tQWtsH58TjyqKgu0oqfsNMwADFcBbA7Qqrq5x0b6_46qrM7Y6AWcdd69f5gQC-f4FZLt1VYSzyO_6h9mZtxMHDF3BVf5tuoV2LcR9FfSoWeYd5gPyhPLz-yaKj9PhONEgzFLXfj1j2awFx5JZ4lV5UF_ODzh-zGQnNLqytFKWXDRwKxtVM',
        ],
    ];
@endphp

<!DOCTYPE html>
<html class="dark" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $pageTitle ?? 'Cinematheque' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Epilogue:wght@300;400;600;700;800&family=Manrope:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --surface-tint: #e08dff;
            --inverse-on-surface: #565555;
            --surface-container: #1a1a1a;
            --inverse-primary: #9a00cf;
            --background: #0e0e0e;
            --primary: #e08dff;
            --outline: #767575;
            --on-surface: #ffffff;
            --tertiary: #ff928a;
            --on-primary: #4f006c;
            --surface-variant: #262626;
            --surface-container-highest: #262626;
            --surface-container-high: #20201f;
            --surface-container-low: #131313;
            --surface-container-lowest: #000000;
            --on-surface-variant: #adaaaa;
            --primary-container: #d978ff;
            --outline-variant: #484847;
        }

        html,
        body {
            background: var(--background);
            color: var(--on-surface);
            font-family: 'Manrope', sans-serif;
            min-height: 100dvh;
        }

        .font-headline {
            font-family: 'Epilogue', sans-serif;
        }

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
    </style>
</head>

<body class="bg-[#0e0e0e] text-white selection:bg-fuchsia-400/30">

    <header
        class="fixed top-0 left-0 z-50 flex w-full items-center justify-between bg-[#0e0e0e]/60 px-8 py-6 shadow-[0_12px_40px_rgba(0,0,0,0.5)] backdrop-blur-xl">
        <div class="flex items-center gap-4">
            <button type="button"
                class="text-[#e08dff] transition-transform transition-colors duration-300 active:scale-95 hover:text-white">
                <span class="material-symbols-outlined">menu</span>
            </button>

            <h1
                class="font-headline text-2xl font-bold uppercase tracking-[0.2em] text-transparent bg-gradient-to-br from-[#e08dff] to-[#d978ff] bg-clip-text">
                Knockturn Alley
            </h1>
        </div>

        <div class="mx-12 hidden max-w-md flex-1 md:flex">
            <div class="group relative w-full">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#adaaaa]">
                    search
                </span>

                <input type="text" id="seriesSearchInput" placeholder="Rechercher une série, un réalisateur..."
                    autocomplete="off"
                    class="w-full rounded-full border-none bg-[#262626]/70 py-2.5 pl-12 pr-4 text-sm text-white placeholder:text-[#adaaaa] focus:ring-1 focus:ring-fuchsia-400" />
            </div>
        </div>

        <div class="flex items-center gap-6">
            <div class="hidden items-center gap-8 text-sm font-semibold uppercase tracking-widest md:flex">
                <a href="{{ route('alocine') }}"
                    class="text-[#adaaaa] transition-colors duration-300 hover:text-white">Home</a>
                <a href="#" class="text-[#e08dff] transition-colors duration-300 hover:text-white">Catalog</a>
                <a href="#" class="text-[#adaaaa] transition-colors duration-300 hover:text-white">Studio</a>
            </div>

            <button type="button" id="openSearchModalBtn"
                class="text-[#e08dff] transition-transform transition-colors duration-300 active:scale-95 hover:text-white md:hidden">
                <span class="material-symbols-outlined">search</span>
            </button>
        </div>
    </header>

    <main class="mx-auto min-h-screen max-w-[1600px] px-6 pb-32 pt-32 md:px-12">
        <section class="mb-12">
            <h2 class="font-headline mb-4 text-5xl font-extrabold tracking-tighter md:text-7xl">
                Actio Cine !
            </h2>
            <p class="max-w-xl text-lg font-light leading-relaxed text-[#adaaaa]">
                Cherche ta série, découvre de nouveaux films, et plonge dans l'univers du cinéma avec notre catalogue
                riche et varié.
            </p>
        </section>

        <div class="mb-6 flex flex-wrap gap-3">
            <a href="{{ request()->fullUrlWithQuery(['type' => 'all']) }}"
                class="rounded-full px-4 py-2 text-xs font-bold uppercase tracking-widest transition
        {{ ($type ?? 'all') === 'all' ? 'bg-fuchsia-300 text-fuchsia-950' : 'border border-[#484847]/40 bg-[#262626]/40 text-white hover:border-fuchsia-400/50' }}">
                Tout
            </a>

            <a href="{{ request()->fullUrlWithQuery(['type' => 'tv']) }}"
                class="rounded-full px-4 py-2 text-xs font-bold uppercase tracking-widest transition
        {{ ($type ?? 'all') === 'tv' ? 'bg-fuchsia-300 text-fuchsia-950' : 'border border-[#484847]/40 bg-[#262626]/40 text-white hover:border-fuchsia-400/50' }}">
                Séries
            </a>

            <a href="{{ request()->fullUrlWithQuery(['type' => 'movie']) }}"
                class="rounded-full px-4 py-2 text-xs font-bold uppercase tracking-widest transition
        {{ ($type ?? 'all') === 'movie' ? 'bg-fuchsia-300 text-fuchsia-950' : 'border border-[#484847]/40 bg-[#262626]/40 text-white hover:border-fuchsia-400/50' }}">
                Films
            </a>
        </div>

        @php
            $activeFilters = collect(request()->input('categories', []))
                ->map(fn($id) => (int) $id)
                ->all();
        @endphp

        <form method="GET" action="{{ url()->current() }}"
            class="top-[88px] z-40 -mx-6 mb-8 bg-[#0e0e0e]/80 px-6 py-4 backdrop-blur-md">
            <input type="hidden" name="type" value="{{ $type ?? 'all' }}">
            <div class="flex flex-col gap-4">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-white/90">
                            Filtres
                        </h3>
                        <p class="text-xs text-[#adaaaa]">
                            Sélectionne une ou plusieurs catégories
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        @if (!empty($activeFilters))
                            <a href="{{ request()->url() }}?type={{ $type ?? 'all' }}"
                                class="rounded-full border border-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-[#adaaaa] transition hover:border-white/20 hover:text-white">
                                Réinitialiser
                            </a>
                        @endif

                        {{-- <button
                    type="submit"
                    class="rounded-full bg-fuchsia-300 px-4 py-2 text-xs font-bold uppercase tracking-wider text-fuchsia-950 transition hover:brightness-110"
                >
                    Appliquer
                </button> --}}
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    @foreach ($filters as $filter)
                        @php
                            $filterId = (int) Arr::get($filter, 'id');
                            $filterName = Arr::get($filter, 'name');
                            $isActive = in_array($filterId, $activeFilters, true);
                        @endphp

                        <label class="cursor-pointer">
                            <input type="checkbox" name="categories[]" value="{{ $filterId }}" class="peer sr-only"
                                {{ $isActive ? 'checked' : '' }}>

                            <span
                                class="
                        inline-flex items-center gap-2 rounded-full border px-4 py-2 text-xs font-bold uppercase tracking-widest transition-all
                        {{ $isActive
                            ? 'border-fuchsia-300 bg-fuchsia-300 text-fuchsia-950 shadow-[0_0_0_1px_rgba(224,141,255,0.25)]'
                            : 'border-[#484847]/40 bg-[#262626]/40 text-white hover:border-fuchsia-400/50 hover:bg-[#2d2d2d]' }}
                        peer-checked:border-fuchsia-300
                        peer-checked:bg-fuchsia-300
                        peer-checked:text-fuchsia-950
                    ">
                                <span
                                    class="h-2 w-2 rounded-full {{ $isActive ? 'bg-fuchsia-950' : 'bg-[#6b6b6b]' }}"></span>
                                {{ $filterName }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
        </form>

        <div class="grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
            @foreach ($items ?? [] as $item)
                <a href="{{ route('oneserie', ['id' => $item['id']]) }}" class="group block cursor-pointer">
                    <div
                        class="relative mb-4 aspect-[2/3] overflow-hidden rounded-2xl bg-[#1a1a1a] transition-transform duration-500 group-hover:scale-[1.03]">
                        <img src="{{ $item['small_poster_path'] }}" alt="{{ $item['title'] }}"
                            class="h-full w-full object-cover grayscale-0 transition-all duration-700 group-hover:grayscale">

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-[#0e0e0e] via-transparent to-transparent opacity-60">
                        </div>

                        @if (!empty($item['badge']))
                            <div
                                class="absolute left-3 top-3 rounded-sm bg-fuchsia-400/90 px-2 py-1 text-[10px] font-bold uppercase tracking-tight text-fuchsia-950">
                                {{ $item['badge'] }}
                            </div>
                        @endif
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <span
                                class="rounded-full px-2 py-1 text-[10px] font-bold uppercase tracking-widest
            {{ ($item['type'] ?? 'tv') === 'movie' ? 'bg-cyan-300/20 text-cyan-300' : 'bg-fuchsia-300/20 text-fuchsia-300' }}">
                                {{ ($item['type'] ?? 'tv') === 'movie' ? 'Film' : 'Série' }}
                            </span>
                        </div>

                        <h3
                            class="font-headline text-lg font-bold tracking-tight text-white transition-colors group-hover:text-fuchsia-300">
                            {{ $item['title'] }}
                        </h3>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-20 flex justify-center">
            <button type="button"
                class="group flex items-center gap-4 text-[#adaaaa] transition-colors duration-300 hover:text-white">
                <span class="h-[1px] w-12 bg-[#484847] transition-all duration-500 group-hover:w-20"></span>
                <span class="text-xs font-bold uppercase tracking-[0.3em]">Load More Series</span>
                <span class="h-[1px] w-12 bg-[#484847] transition-all duration-500 group-hover:w-20"></span>
            </button>
        </div>
    </main>

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


    <div id="searchModal" class="fixed inset-0 z-[200] hidden">
        <div id="searchModalBackdrop" class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>

        <div class="relative z-[201] flex min-h-screen items-start justify-center px-4 pt-[10vh] pb-6">
            <div
                class="w-full max-w-4xl overflow-hidden rounded-3xl border border-white/10 bg-[#111111]/95 shadow-2xl">
                <div class="flex items-center gap-3 border-b border-white/10 px-4 py-4 md:px-6">
                    <span class="material-symbols-outlined text-[#adaaaa]">search</span>

                    <input type="text" id="seriesSearchModalInput" placeholder="Rechercher un film ou une série..."
                        autocomplete="off"
                        class="w-full border-0 bg-transparent text-base text-white placeholder:text-[#adaaaa] outline-none focus:ring-0 md:text-lg">

                    <button type="button" id="closeSearchModalBtn"
                        class="flex h-10 w-10 items-center justify-center rounded-full text-white transition hover:bg-white/5"
                        aria-label="Fermer la recherche">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <div id="seriesSearchResultsInner" class="max-h-[65vh] overflow-y-auto">
                    <div class="px-6 py-6 text-sm text-[#adaaaa]">
                        Commence à taper pour rechercher une série.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.seriesSearchUrl = @js(route('series.search'));
    </script>

    <script>
        document.addEventListener('change', function(e) {
            if (e.target.matches('input[name="categories[]"]')) {
                e.target.form.submit();
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const heroInput = document.getElementById('seriesSearchInput');
            const openSearchModalBtn = document.getElementById('openSearchModalBtn');
            const modal = document.getElementById('searchModal');
            const modalBackdrop = document.getElementById('searchModalBackdrop');
            const modalInput = document.getElementById('seriesSearchModalInput');
            const resultsInner = document.getElementById('seriesSearchResultsInner');
            const closeBtn = document.getElementById('closeSearchModalBtn');

            if (!modal || !modalInput || !resultsInner) return;

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
                <div class="px-6 py-6 text-sm text-[#adaaaa]">
                    Aucun résultat trouvé.
                </div>
            `;
                    return;
                }

                resultsInner.innerHTML = `
            <div class="grid grid-cols-1 gap-3 p-4 md:grid-cols-2">
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
                                    class="flex gap-4 rounded-2xl border border-white/5 bg-white/[0.03] p-3 transition hover:bg-white/[0.06]"
                                >
                                    <div class="h-28 w-20 shrink-0 overflow-hidden rounded-xl bg-black/30">
                                        ${
                                            poster
                                                ? `<img src="${poster}" alt="${title}" class="h-full w-full object-cover">`
                                                : `<div class="flex h-full w-full items-center justify-center px-2 text-center text-xs text-[#adaaaa]">Pas d'image</div>`
                                        }
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <div class="truncate text-base font-bold text-white">${title}</div>
                                        ${year ? `<div class="mt-1 text-sm text-[#adaaaa]">${year}</div>` : ''}
                                        ${categories ? `<div class="mt-2 line-clamp-2 text-xs text-[#adaaaa]">${categories}</div>` : ''}
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
                <div class="px-6 py-6 text-sm text-[#adaaaa]">
                    Commence à taper pour rechercher une série.
                </div>
            `;
                    return;
                }

                if (abortController) {
                    abortController.abort();
                }

                abortController = new AbortController();

                resultsInner.innerHTML = `
            <div class="px-6 py-6 text-sm text-[#adaaaa]">
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

            if (heroInput) {
                heroInput.addEventListener('focus', function() {
                    openSearchModal(heroInput.value);
                    handleSearchInput(heroInput.value);
                });

                heroInput.addEventListener('input', function() {
                    openSearchModal(this.value);
                    modalInput.value = this.value;
                    handleSearchInput(this.value);
                });
            }

            if (openSearchModalBtn) {
                openSearchModalBtn.addEventListener('click', function() {
                    openSearchModal('');
                    handleSearchInput('');
                });
            }

            modalInput.addEventListener('input', function() {
                if (heroInput) {
                    heroInput.value = this.value;
                }
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


</body>



</html>
