@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-stone-50 text-stone-800 pb-32">
        {{-- HEADER --}}
        <header class="fixed top-0 inset-x-0 z-50 border-b border-stone-200/60 bg-white/80 backdrop-blur-xl">
            <div class="mx-auto flex max-w-3xl items-center justify-between px-6 py-4">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-700 font-bold shadow-sm">
                        EH
                    </div>

                    <div>
                        <h1 class="text-xl font-extrabold tracking-tight">Paris s’éveille</h1>
                        <p class="text-xs text-stone-500">Modifier un séjour</p>
                    </div>
                </div>

                <a href="{{ route('family-apartment.bookings.show', $booking) }}"
                    class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-white px-4 py-2 text-sm font-semibold text-stone-700 transition hover:bg-stone-50">
                    <span>←</span>
                    <span>Retour</span>
                </a>
            </div>
        </header>

        <main class="mx-auto max-w-3xl px-6 pt-28">
            <div class="mb-10">
                <h2 class="text-4xl font-extrabold tracking-tight md:text-5xl">
                    Modifier le séjour
                </h2>
                <p class="mt-2 text-lg text-stone-500">
                    Mets à jour les informations de cette réservation familiale.
                </p>
            </div>

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

            <form action="{{ route('family-apartment.bookings.update', $booking) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- TITRE DU SÉJOUR --}}
                <section class="rounded-3xl border border-stone-200 bg-white p-8 shadow-sm">
                    <label for="title" class="mb-4 block text-sm font-bold uppercase tracking-widest text-emerald-700">
                        Titre du séjour
                    </label>

                    <input id="title" name="title" type="text" value="{{ old('title', $booking->title) }}"
                        placeholder="Ex : Week-end à Paris"
                        class="w-full rounded-2xl border-0 bg-stone-100 px-5 py-4 text-lg font-semibold text-stone-800 placeholder:text-stone-400 focus:ring-2 focus:ring-emerald-300">
                </section>

                {{-- PERSONNE / FAMILLE --}}
                <section class="rounded-3xl border border-stone-200 bg-white p-8 shadow-sm">
                    <label for="name" class="mb-4 block text-sm font-bold uppercase tracking-widest text-emerald-700">
                        Qui réserve ?
                    </label>

                    <input id="name" name="name" type="text" value="{{ old('name', $booking->name) }}"
                        placeholder="Ex : Léo, Marie & Lucas..."
                        class="w-full rounded-2xl border-0 bg-stone-100 px-5 py-4 text-base text-stone-800 placeholder:text-stone-400 focus:ring-2 focus:ring-emerald-300">
                </section>

                {{-- DATES --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <section class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm">
                        <label for="start_date"
                            class="mb-4 flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-emerald-700">
                            <span>📅</span>
                            <span>Arrivée</span>
                        </label>

                        <input id="start_date" name="start_date" type="date"
                            value="{{ old('start_date', optional($booking->start_date)->format('Y-m-d') ?? \Carbon\Carbon::parse($booking->start_date)->format('Y-m-d')) }}"
                            class="w-full rounded-2xl border-0 bg-stone-100 px-4 py-3 text-stone-800 focus:ring-2 focus:ring-emerald-300">
                    </section>

                    <section class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm">
                        <label for="end_date"
                            class="mb-4 flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-emerald-700">
                            <span>🧳</span>
                            <span>Départ</span>
                        </label>

                        <input id="end_date" name="end_date" type="date"
                            value="{{ old('end_date', optional($booking->end_date)->format('Y-m-d') ?? \Carbon\Carbon::parse($booking->end_date)->format('Y-m-d')) }}"
                            class="w-full rounded-2xl border-0 bg-stone-100 px-4 py-3 text-stone-800 focus:ring-2 focus:ring-emerald-300">
                    </section>
                </div>

                {{-- STATUT + NB PERSONNES --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <section class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm">
                        <label for="status"
                            class="mb-4 block text-sm font-bold uppercase tracking-widest text-emerald-700">
                            Statut
                        </label>

                        <select id="status" name="status"
                            class="w-full rounded-2xl border-0 bg-stone-100 px-4 py-3 text-stone-800 focus:ring-2 focus:ring-emerald-300">
                            <option value="confirmed"
                                {{ old('status', $booking->status) === 'confirmed' ? 'selected' : '' }}>Confirmé</option>
                            <option value="pending" {{ old('status', $booking->status) === 'pending' ? 'selected' : '' }}>En
                                attente</option>
                            <option value="cancelled"
                                {{ old('status', $booking->status) === 'cancelled' ? 'selected' : '' }}>Annulé</option>
                        </select>
                    </section>

                    <section class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm">
                        <label for="guests_count"
                            class="mb-4 block text-sm font-bold uppercase tracking-widest text-emerald-700">
                            Nombre de personnes
                        </label>

                        <input id="guests_count" name="guests_count" type="number" min="1"
                            value="{{ old('guests_count', $booking->guests_count) }}" placeholder="Ex : 2"
                            class="w-full rounded-2xl border-0 bg-stone-100 px-4 py-3 text-stone-800 placeholder:text-stone-400 focus:ring-2 focus:ring-emerald-300">
                    </section>
                </div>

                {{-- DESCRIPTION --}}
                <section class="rounded-3xl bg-stone-100 p-8">
                    <label for="description"
                        class="mb-4 block text-sm font-bold uppercase tracking-widest text-emerald-700">
                        Description
                    </label>

                    <textarea id="description" name="description" rows="5"
                        placeholder="Racontez les projets du séjour, qui vient, les horaires prévus, etc."
                        class="w-full rounded-2xl border-0 bg-white px-5 py-4 text-stone-800 placeholder:text-stone-400 focus:ring-2 focus:ring-emerald-300">{{ old('description', $booking->description) }}</textarea>
                </section>

                {{-- INFOS PRATIQUES --}}
                <section class="relative overflow-hidden rounded-3xl bg-amber-100/70 p-8">
                    <div class="absolute -right-6 -top-6 text-8xl opacity-10">💡</div>

                    <label for="practical_info"
                        class="mb-4 block text-sm font-bold uppercase tracking-widest text-amber-800">
                        Infos pratiques
                    </label>

                    <input id="practical_info" name="practical_info" type="text"
                        value="{{ old('practical_info', $booking->practical_info) }}"
                        placeholder="Ex : On apporte les draps / arrivée vers 18h"
                        class="w-full rounded-2xl border-0 bg-white px-5 py-4 text-stone-800 placeholder:text-stone-400 focus:ring-2 focus:ring-amber-300">

                    <p class="mt-4 text-sm font-medium text-amber-800/80">
                        Tu peux y noter les détails utiles pour le reste de la famille.
                    </p>
                </section>

                {{-- NOTE MÉNAGE / RAPPEL --}}
                <section class="rounded-3xl border border-stone-200 bg-white p-8 shadow-sm">
                    <label for="reminder_note"
                        class="mb-4 block text-sm font-bold uppercase tracking-widest text-emerald-700">
                        Pense-bête
                    </label>

                    <textarea id="reminder_note" name="reminder_note" rows="3"
                        placeholder="Ex : Penser à vider le frigo avant de partir."
                        class="w-full rounded-2xl border-0 bg-stone-100 px-5 py-4 text-stone-800 placeholder:text-stone-400 focus:ring-2 focus:ring-emerald-300">{{ old('reminder_note', $booking->reminder_note) }}</textarea>
                </section>

                {{-- ACTIONS --}}
                <div class="pt-2 space-y-3">
                    <form action="{{ route('family-apartment.bookings.update', $booking) }}" method="POST"
                        class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- tous tes champs ici --}}

                        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                            <a href="{{ route('family-apartment.bookings.show', $booking) }}"
                                class="inline-flex items-center justify-center rounded-full border border-stone-200 bg-white px-6 py-3 font-semibold text-stone-700 transition hover:bg-stone-50">
                                Annuler
                            </a>

                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-emerald-700 to-emerald-500 px-8 py-4 text-base font-bold text-white shadow-lg transition hover:scale-[1.01] active:scale-[0.99]">
                                <span>✓</span>
                                <span>Enregistrer les modifications</span>
                            </button>
                        </div>
                    </form>

                    <form action="{{ route('family-apartment.bookings.destroy', $booking) }}" method="POST"
                        onsubmit="return confirm('Supprimer ce séjour ?')" class="sm:flex sm:justify-start">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-full bg-red-100 px-6 py-3 font-semibold text-red-700 transition hover:bg-red-200">
                            Supprimer
                        </button>
                    </form>
                </div>
            </form>
        </main>

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
                    <span class="text-xs font-medium">Ajouter</span>
                </a>

                <a href="{{ route('family-apartment.infos') }}" class="flex flex-col items-center gap-1 text-stone-500">
                    <span class="text-lg">i</span>
                    <span class="text-xs font-medium">Infos</span>
                </a>

                <a href="{{ route('family-apartment.history') }}"
                    class="flex flex-col items-center gap-1 text-stone-500">
                    <span class="text-lg">⏱</span>
                    <span class="text-xs font-medium">Historique</span>
                </a>
            </div>
        </nav>
    </div>
@endsection
