{{-- resources/views/family-apartment/infos.blade.php --}}
@extends('layouts.app')

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

          
        <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
            <a href="{{ route('family-apartment.dashboard') }}"
               class="{{ request()->routeIs('family-apartment.dashboard') ? 'text-emerald-600 font-bold' : 'text-stone-500 hover:text-black' }}">
                Accueil
            </a>

              <a href="{{ route('family-apartment.tips.index') }}"
                   class="{{ request()->routeIs('family-apartment.tips.*') ? 'font-bold text-emerald-600' : 'text-stone-500 hover:text-black' }}">
                    Bons plans
                </a>

            <a href="{{ route('family-apartment.infos') }}"
               class="{{ request()->routeIs('family-apartment.infos') ? 'text-emerald-600 font-bold' : 'text-stone-500 hover:text-black' }}">
                Infos
            </a>

            <a href="{{ route('family-apartment.history') }}"
               class="{{ request()->routeIs('family-apartment.history') ? 'text-emerald-600 font-bold' : 'text-stone-500 hover:text-black' }}">
                Historique
            </a>

            <a href="{{ route('family-apartment.bookings.create') }}"
               class="{{ request()->routeIs('family-apartment.bookings.create') ? 'text-emerald-600 font-bold' : 'text-stone-500 hover:text-black' }}">
                Ajouter
            </a>
        </nav>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl px-6 pt-28">
        <section class="mb-10 w-full">
            <h2 class="mb-4 text-4xl font-extrabold md:text-5xl">
                Bienvenue à Paris 🗼
            </h2>

            <p class="max-w-xl text-stone-500">
                Tout ce qu’il faut savoir pour passer un bon séjour à paris.
            </p>
        </section>

        <section class="w-full">
            <div class="grid w-full grid-cols-1 gap-6 md:grid-cols-12">

                {{-- WIFI --}}
                <div class="w-full min-w-0 md:col-span-8">
                    <div class="h-full rounded-3xl border border-stone-200 bg-white p-8 shadow-sm">
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <div class="mb-3 text-3xl">📶</div>
                                <h3 class="text-2xl font-bold">Connexion Internet</h3>
                                <p class="text-stone-500">Parfait pour travailler ou Netflix 😄</p>
                            </div>

                            <span class="shrink-0 rounded-full bg-red-100 px-3 py-1 text-sm font-bold text-red-700">
                                Innactif
                            </span>
                        </div>

                        <div class="mt-6 grid w-full grid-cols-1 gap-4 rounded-2xl bg-stone-100 p-6 md:grid-cols-2">
                            <div class="min-w-0">
                                <p class="text-xs font-bold uppercase text-stone-400">Nom du réseau</p>
                                <p class="truncate text-lg font-bold">-</p>
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs font-bold uppercase text-stone-400">Mot de passe</p>
                                <p class="truncate text-lg font-bold">-</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ACCÈS --}}
                <div class="w-full min-w-0 md:col-span-4">
                    <div class="h-full rounded-3xl bg-stone-100 p-8 shadow-sm">
                        <div class="mb-3 text-3xl">🔑</div>
                        <h3 class="mb-4 text-xl font-bold">Accès</h3>

                        <ul class="space-y-3 text-sm text-stone-700">
                            <li>✔ Code immeuble : <b>9092#</b></li>
                            <li>✔ Clés secours gardien</li>
                            <li>✔ Gardien disponible 8h - 20h</li>
                        </ul>
                    </div>
                </div>

                {{-- RÈGLES --}}
                <div class="w-full min-w-0 md:col-span-5">
                    <div class="h-full rounded-3xl bg-amber-100 p-8 shadow-sm">
                        <h3 class="mb-6 text-2xl font-bold">Règles de la maison</h3>

                        <div class="space-y-5 text-sm text-stone-700">
                            <div>
                                <p class="font-bold">🔇 Silence</p>
                                <p>22h - 7h pour respecter les voisins</p>
                            </div>

                            <div>
                                <p class="font-bold">🚭 Non fumeur</p>
                                <p>Appartement 100% non-fumeur</p>
                            </div>
                        </div>

                        <p class="mt-6 text-xs italic text-stone-500">
                            "Une maison propre = une famille heureuse"
                        </p>
                    </div>
                </div>

                {{-- POUBELLES --}}
                <div class="w-full min-w-0 md:col-span-7">
                    <div class="h-full rounded-3xl border border-stone-200 bg-white p-8 shadow-sm">
                        <div class="mb-3 text-3xl">🗑️</div>
                        <h3 class="mb-3 text-xl font-bold">Poubelles</h3>

                        <p class="mb-4 text-stone-500">
                            Situées au sous-sol (niveau -1)
                        </p>

                        <div class="grid w-full grid-cols-2 gap-4">
                            <div class="rounded-2xl bg-stone-100 p-4 text-center">
                                <p class="text-xs text-stone-400">Recyclage</p>
                                <p class="font-bold">Mardi</p>
                            </div>

                            <div class="rounded-2xl bg-stone-100 p-4 text-center">
                                <p class="text-xs text-stone-400">Ordures</p>
                                <p class="font-bold">Tous les jours</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- URGENCE --}}
                <div class="w-full min-w-0 md:col-span-12">
                    <div class="rounded-3xl border border-stone-200 bg-white p-8 shadow-sm">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                            <div class="flex items-center gap-4 min-w-0">
                                <div class="text-3xl">🚨</div>

                                <div class="min-w-0">
                                    <h3 class="text-lg font-bold">Urgence / Contact</h3>
                                    <p class="text-sm text-stone-500">Besoin d’aide rapidement ?</p>
                                </div>
                            </div>

                            <div class="flex flex-col gap-3 sm:flex-row">
                                <button class="rounded-full bg-stone-100 px-6 py-3 font-bold text-stone-800">
                                    Appeler
                                </button>

                                <button class="rounded-full bg-emerald-600 px-6 py-3 font-bold text-white">
                                    Guide urgence
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    {{-- NAV MOBILE --}}
     {{-- NAV MOBILE --}}
        <nav class="fixed inset-x-0 bottom-0 z-50 border-t border-stone-200 bg-white/95 backdrop-blur xl:hidden">
            <div class="mx-auto flex max-w-xl items-center justify-around px-4 py-3">
                <a href="{{ route('family-apartment.dashboard') }}"
                    class="flex flex-col items-center gap-1 text-stone-500">
                    <span class="text-lg">⌂</span>
                    <span class="text-xs font-medium">Accueil</span>
                </a>

                <a href="{{ route('family-apartment.bookings.create') }}"
                    class="flex flex-col items-center gap-1 text-stone-500">
                    <span class="text-lg">＋</span>
                    <span class="text-xs font-medium">Réserver</span>
                </a>

                <a href="{{ route('family-apartment.infos') }}" class="flex flex-col items-center gap-1 text-emerald-600">
                    <span class="text-lg">i</span>
                    <span class="text-xs font-medium">Infos</span>
                </a>

                <a href="{{ route('family-apartment.history') }}" class="flex flex-col items-center gap-1 text-stone-500">
                    <span class="text-lg">⏱</span>
                    <span class="text-xs font-medium">Historique</span>
                </a>
            </div>
        </nav>

</div>
@endsection