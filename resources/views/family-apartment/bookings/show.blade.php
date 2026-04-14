{{-- resources/views/family-apartment/bookings/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-stone-50 text-stone-800 pb-32">

    {{-- HEADER --}}
    <header class="fixed top-0 inset-x-0 z-50 border-b border-stone-200/60 bg-white/80 backdrop-blur-xl">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-6 py-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('family-apartment.dashboard') }}"
                   class="text-stone-500 hover:scale-105">←</a>

                <h1 class="text-xl font-extrabold tracking-tight">Our Hearth</h1>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-6 pt-28 space-y-8">

        {{-- HERO --}}
        <section class="relative group">
            <div class="w-full aspect-[16/9] overflow-hidden rounded-3xl shadow-xl">
                <img
                    src="https://images.unsplash.com/photo-1505691938895-1758d7feb511"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-700"
                >
            </div>

            <div class="absolute top-4 right-4 px-4 py-2 rounded-full text-sm font-bold
                {{ $booking->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : '' }}
                {{ $booking->status === 'pending' ? 'bg-amber-100 text-amber-800' : '' }}
                {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
            ">
                {{ ucfirst($booking->status) }}
            </div>
        </section>

        {{-- TITRE --}}
        <section class="space-y-4">
            <div class="flex flex-col md:flex-row md:justify-between md:items-end gap-4">

                <div>
                    <h2 class="text-4xl md:text-5xl font-extrabold">
                        {{ $booking->title ?? 'Séjour' }}
                    </h2>

                    <p class="text-lg text-emerald-700 mt-2">
                        Appartement familial - Paris
                    </p>
                </div>

                <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-full shadow border">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-sm font-bold">
                            {{ substr($booking->name, 0, 1) }}
                        </div>
                    </div>

                    <span class="text-sm font-semibold">
                        {{ $booking->name }}
                    </span>
                </div>

            </div>

            {{-- INFOS GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">

                {{-- DATES --}}
                <div class="md:col-span-2 bg-white p-6 rounded-2xl flex justify-between items-center border">
                    <div class="flex items-center gap-4">
                        <div class="bg-emerald-100 p-3 rounded-full text-emerald-700">📅</div>

                        <div>
                            <p class="text-xs uppercase text-stone-400 font-bold">Période</p>

                            <p class="text-xl font-bold">
                                {{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('d M') }}
                                —
                                {{ \Carbon\Carbon::parse($booking->end_date)->translatedFormat('d M') }}
                            </p>
                        </div>
                    </div>

                    <div class="text-right text-sm text-stone-500">
                        {{ \Carbon\Carbon::parse($booking->start_date)->diffInDays($booking->end_date) }} nuits
                    </div>
                </div>

                {{-- VOYAGEURS --}}
                <div class="bg-white p-6 rounded-2xl flex items-center gap-4 border">
                    <div class="bg-blue-100 p-3 rounded-full">👨‍👩‍👧</div>

                    <div>
                        <p class="text-xs uppercase text-stone-400 font-bold">Voyageurs</p>
                        <p class="text-xl font-bold">
                            {{ $booking->guests_count ?? '?' }} pers.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        {{-- DESCRIPTION --}}
        <section class="grid md:grid-cols-5 gap-8">

            <div class="md:col-span-3 space-y-6">

                <h3 class="text-2xl font-bold flex items-center gap-2">
                    📝 À propos du séjour
                </h3>

                <div class="text-stone-600 leading-relaxed">
                    {{ $booking->description ?? 'Aucune description.' }}
                </div>

                <div class="flex gap-4 pt-4">

                    <a href="{{ route('family-apartment.bookings.edit', $booking) }}"
                       class="bg-emerald-600 text-white px-6 py-3 rounded-full font-bold hover:scale-105 transition">
                        Modifier
                    </a>

                    <form method="POST" action="{{ route('family-apartment.bookings.destroy', $booking) }}">
                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Supprimer ce séjour ?')"
                            class="bg-red-100 text-red-700 px-6 py-3 rounded-full font-bold hover:bg-red-200">
                            Supprimer
                        </button>
                    </form>

                </div>
            </div>

            {{-- INFOS PRATIQUES --}}
            <div class="md:col-span-2">

                <div class="bg-amber-100 p-6 rounded-2xl shadow-sm">

                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        💡 Infos pratiques
                    </h3>

                    <p class="text-sm text-stone-700">
                        {{ $booking->practical_info ?? 'Aucune info.' }}
                    </p>

                </div>

                {{-- NOTE --}}
                <div class="mt-4 bg-white p-6 rounded-2xl border">
                    <h3 class="text-sm uppercase text-stone-400 font-bold mb-2">
                        Pense-bête
                    </h3>

                    <p class="text-stone-600 text-sm">
                        {{ $booking->reminder_note ?? '—' }}
                    </p>
                </div>

            </div>

        </section>

    </main>

    {{-- NAV MOBILE --}}
    <nav class="fixed bottom-0 inset-x-0 bg-white border-t flex justify-around py-3">
        <a href="{{ route('family-apartment.dashboard') }}" class="text-stone-500 text-sm">Accueil</a>
        <a href="{{ route('family-apartment.bookings.create') }}" class="text-stone-500 text-sm">Ajouter</a>
        <a href="#" class="text-emerald-600 font-bold text-sm">Détail</a>
    </nav>

</div>
@endsection