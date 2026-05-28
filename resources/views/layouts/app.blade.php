<!doctype html>
<html style="scroll-behavior: smooth; font-size: initial" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Equicode') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('css')
    @stack('styles')
</head>

<body class="min-h-screen bg-[#090406] text-white antialiased">

    <div id="app" class="min-h-screen">

        <nav x-data="{ open: false, userMenu: false }"
            class="sticky top-0 z-50 border-b border-white/10 bg-[#090406]/90 backdrop-blur-xl">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="flex h-20 items-center justify-between">

                    <a href="{{ url('/') }}" class="flex items-center gap-4">

                        <img src="{{ asset('img/equicode.png') }}" alt="Equicode"
                            class="h-14 w-auto drop-shadow-[0_0_25px_rgba(251,191,36,0.25)] transition duration-300 hover:scale-105 invert">

                        <div>
                            <div class="text-2xl font-black tracking-tight text-white">
                                {{ config('app.name', 'Equicode') }}
                            </div>

                            <div class="hidden text-xs uppercase tracking-[0.25em] text-rose-100/50 sm:block">
                                Photographie
                            </div>
                        </div>

                    </a>

                    <div class="hidden items-center gap-3 md:flex">

                        <a href="{{ url('/') }}"
                            class="rounded-full px-4 py-2 text-sm font-semibold text-rose-100/80 transition hover:bg-white/10 hover:text-white">
                            Galeries
                        </a>

                        @guest
                            <a href="{{ route('login') }}"
                                class="rounded-full px-5 py-2 text-sm font-semibold text-rose-100/80 transition hover:bg-white/10 hover:text-white">
                                Connexion
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="rounded-full bg-amber-300 px-5 py-2 text-sm font-bold text-[#12070d] transition hover:bg-amber-200">
                                    Inscription
                                </a>
                            @endif
                        @else
                            @php
                                $cartCount = \App\Panier::query()->where('id_user', Auth::id())->count();
                            @endphp

                            <a href="{{ route('panier') }}"
                                class="rounded-full bg-white/10 px-5 py-2 text-sm font-semibold text-white ring-1 ring-white/10 transition hover:bg-white/15">
                                Votre panier
                                <span id="cptPanier"
                                    class="ml-1 rounded-full bg-amber-300 px-2 py-0.5 text-xs font-black text-[#12070d]">
                                    {{ $cartCount }}
                                </span>
                            </a>

                            <div class="relative">
                                <button type="button" @click="userMenu = !userMenu"
                                    class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-white ring-1 ring-white/10 transition hover:bg-white/15">
                                    {{ Auth::user()->name ?? 'Mon compte' }}

                                    <svg class="h-4 w-4 text-amber-300" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="userMenu" @click.outside="userMenu = false" x-transition
                                    class="absolute right-0 mt-3 w-56 overflow-hidden rounded-2xl border border-white/10 bg-[#160910] shadow-2xl"
                                    style="display: none;">
                                    <a href="{{ route('panier') }}"
                                        class="block px-5 py-3 text-sm font-semibold text-rose-100/80 transition hover:bg-white/10 hover:text-white">
                                        Voir mon panier
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button type="submit"
                                            class="block w-full px-5 py-3 text-left text-sm font-semibold text-rose-100/80 transition hover:bg-white/10 hover:text-white">
                                            Déconnexion
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endguest

                    </div>

                    <button type="button" @click="open = !open"
                        class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/10 p-3 text-amber-300 transition hover:bg-white/15 md:hidden">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                </div>
            </div>

            <div x-show="open" x-transition class="border-t border-white/10 bg-[#12070d] md:hidden"
                style="display: none;">
                <div class="space-y-2 px-4 py-5">

                    <a href="{{ url('/') }}"
                        class="block rounded-2xl px-4 py-3 font-semibold text-rose-100/80 hover:bg-white/10 hover:text-white">
                        Galeries
                    </a>

                    @guest
                        <a href="{{ route('login') }}"
                            class="block rounded-2xl px-4 py-3 font-semibold text-rose-100/80 hover:bg-white/10 hover:text-white">
                            Connexion
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="block rounded-2xl bg-amber-300 px-4 py-3 font-bold text-[#12070d]">
                                Inscription
                            </a>
                        @endif
                    @else
                        <a href="{{ route('panier') }}"
                            class="block rounded-2xl px-4 py-3 font-semibold text-rose-100/80 hover:bg-white/10 hover:text-white">
                            Votre panier
                            <span id="cptPanierMobile"
                                class="ml-1 rounded-full bg-amber-300 px-2 py-0.5 text-xs font-black text-[#12070d]">
                                {{ $cartCount ?? 0 }}
                            </span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                class="block w-full rounded-2xl px-4 py-3 text-left font-semibold text-rose-100/80 hover:bg-white/10 hover:text-white">
                                Déconnexion
                            </button>
                        </form>
                    @endguest

                </div>
            </div>
        </nav>

        <main>
            @yield('content')

            <div id="paypalButton"></div>
        </main>



        <footer class="relative mt-24 overflow-hidden border-t border-white/10 bg-[#12070d]">

    {{-- LUEURS --}}
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(190,24,93,0.18),transparent_35%),radial-gradient(circle_at_bottom_left,rgba(251,191,36,0.10),transparent_30%)]"></div>

    <div class="relative mx-auto max-w-7xl px-6 py-16">

        <div class="grid gap-12 lg:grid-cols-4">

            {{-- LOGO --}}
            <div class="lg:col-span-2">

                <div class="flex items-center gap-4">

                    <img
                        src="{{ asset('img/equicode.png') }}"
                        alt="Equicode"
                        class="h-16 w-auto invert"
                    >

                    <div>
                        <h2 class="text-3xl font-black">
                            Equicode
                        </h2>

                        <p class="mt-1 text-sm uppercase tracking-[0.25em] text-rose-100/50">
                            Photographie
                        </p>
                    </div>

                </div>

                <p class="mt-6 max-w-xl text-rose-100/70">
                    Capture de vos plus beaux souvenirs équestres, événements,
                    concours et instants uniques à travers une photographie
                    immersive et émotionnelle.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">

                    <a
                        href="{{ url('/galerie') }}"
                        class="rounded-full bg-white/10 px-5 py-3 text-sm font-bold text-white ring-1 ring-white/10 transition hover:bg-white/15"
                    >
                        Galeries
                    </a>

                    <a
                        href="{{ route('panier') }}"
                        class="rounded-full bg-amber-300 px-5 py-3 text-sm font-black text-[#12070d] transition hover:bg-amber-200"
                    >
                        Mon panier
                    </a>

                </div>

            </div>

            {{-- NAVIGATION --}}
            <div>

                <h3 class="text-lg font-black text-white">
                    Navigation
                </h3>

                <div class="mt-5 space-y-3">

                    <a
                        href="{{ url('/') }}"
                        class="block text-rose-100/70 transition hover:text-white"
                    >
                        Accueil
                    </a>

                    <a
                        href="{{ route('history') }}"
                        class="block text-rose-100/70 transition hover:text-white"
                    >
                        Mes photos
                    </a>

                    <a
                        href="{{ route('panier') }}"
                        class="block text-rose-100/70 transition hover:text-white"
                    >
                        Panier
                    </a>

                    @guest
                        <a
                            href="{{ route('login') }}"
                            class="block text-rose-100/70 transition hover:text-white"
                        >
                            Connexion
                        </a>
                    @endguest

                </div>

            </div>

            {{-- LÉGAL --}}
            <div>

                <h3 class="text-lg font-black text-white">
                    Informations
                </h3>

                <div class="mt-5 space-y-3 text-rose-100/70">

                    <p>
                        Equicode - Léo Vincent
                    </p>

                    <p>
                        Photographe événementiel
                    </p>

                    <p>
                        Avignon • France
                    </p>

                    <p>
                        contact@equicode.fr
                    </p>

                    <p>
                        SIREN : 89375134700012 
                    </p>

                </div>

            </div>

        </div>

        {{-- BAS --}}
        <div class="mt-16 border-t border-white/10 pt-8">

            <div class="flex flex-col gap-6 text-sm text-rose-100/50 md:flex-row md:items-center md:justify-between">

                <div>
                    © {{ date('Y') }} Equicode • Tous droits réservés
                </div>

                <div class="flex flex-wrap gap-6">

                    <a
                        href="{{ route('mentions2026') }}"
                        class="transition hover:text-white"
                    >
                        Mentions légales
                    </a>

                    <a
                        href="{{ route('confidentialite2026') }}"
                        class="transition hover:text-white"
                    >
                        Politique de confidentialité
                    </a>

                    <a
                        href="{{ route('cgv2026') }}"
                        class="transition hover:text-white"
                    >
                        CGV
                    </a>

                </div>

            </div>

        </div>

    </div>

</footer>

    </div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    @yield('js')
    @stack('scripts')

</body>

</html>
