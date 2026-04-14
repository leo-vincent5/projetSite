{{-- resources/views/family-apartment/history.blade.php --}}
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

    <main class="mx-auto w-full max-w-4xl px-6 pt-28">
        @php
            $historyStats = $historyStats ?? [
                'total_stays' => $pastBookings->count() ?? 0,
                'last_stay_label' => isset($pastBookings) && $pastBookings->count()
                    ? \Carbon\Carbon::parse($pastBookings->first()->end_date)->locale('fr')->translatedFormat('M y')
                    : '—',
            ];
        @endphp

        {{-- HERO --}}
        <section class="mb-10">
            <h2 class="mb-4 text-4xl font-extrabold tracking-tight md:text-5xl">
                Souvenirs des séjours
            </h2>

            <p class="max-w-xl text-lg text-stone-500">
                Retrouve les anciens passages de la famille dans l’appartement.
            </p>
        </section>

        {{-- STATS --}}
        <section class="mb-10 grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="flex h-36 flex-col justify-between rounded-3xl bg-emerald-100 p-6">
                <div class="text-2xl">✨</div>

                <div>
                    <div class="text-3xl font-extrabold text-emerald-800">
                        {{ $historyStats['total_stays'] }}
                    </div>
                    <div class="text-sm font-medium text-emerald-700">
                        Séjours au total
                    </div>
                </div>
            </div>

            <div class="flex h-36 flex-col justify-between rounded-3xl bg-amber-100 p-6">
                <div class="text-2xl">🗓️</div>

                <div>
                    <div class="text-3xl font-extrabold text-amber-900">
                        {{ $historyStats['last_stay_label'] }}
                    </div>
                    <div class="text-sm font-medium text-amber-700">
                        Dernier séjour
                    </div>
                </div>
            </div>
        </section>

        {{-- TIMELINE --}}
        <section class="space-y-6">
            <h3 class="text-sm font-bold uppercase tracking-[0.2em] text-stone-400">
                Historique
            </h3>

            @forelse($pastBookings as $booking)
                @php
                    $start = \Carbon\Carbon::parse($booking->start_date)->locale('fr');
                    $end = \Carbon\Carbon::parse($booking->end_date)->locale('fr');

                    if ($start->month === $end->month && $start->year === $end->year) {
                        $dateLabel = $start->translatedFormat('d') . ' - ' . $end->translatedFormat('d F Y');
                    } else {
                        $dateLabel = $start->translatedFormat('d M Y') . ' - ' . $end->translatedFormat('d M Y');
                    }

                    $season = match (true) {
                        in_array((int) $start->month, [12, 1, 2]) => ['label' => 'Hiver', 'classes' => 'bg-blue-100 text-blue-700'],
                        in_array((int) $start->month, [3, 4, 5]) => ['label' => 'Printemps', 'classes' => 'bg-emerald-100 text-emerald-700'],
                        in_array((int) $start->month, [6, 7, 8]) => ['label' => 'Été', 'classes' => 'bg-amber-100 text-amber-800'],
                        default => ['label' => 'Automne', 'classes' => 'bg-orange-100 text-orange-700'],
                    };

                    $guestCount = $booking->guests_count ?: 1;
                @endphp

                <article class="group rounded-3xl border border-transparent bg-white p-5 shadow-sm transition hover:border-stone-200 hover:bg-stone-50">
                    <div class="flex items-start gap-4">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-base font-bold text-emerald-700">
                            {{ \Illuminate\Support\Str::of($booking->name)->explode(' ')->map(fn($part) => mb_substr($part, 0, 1))->take(2)->implode('') }}
                        </div>

                        <div class="min-w-0 flex-1">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                <div class="min-w-0">
                                    <h4 class="truncate text-xl font-bold text-stone-900">
                                        {{ $booking->title ?: 'Séjour de ' . $booking->name }}
                                    </h4>

                                    <p class="mt-1 text-sm text-stone-500">
                                        {{ $dateLabel }}
                                    </p>
                                </div>

                                <span class="inline-flex w-fit rounded-full px-3 py-1 text-[11px] font-bold uppercase tracking-wide {{ $season['classes'] }}">
                                    {{ $season['label'] }}
                                </span>
                            </div>

                            <div class="mt-4 flex flex-wrap items-center gap-3 text-sm text-stone-500">
                                <span class="inline-flex items-center gap-2 rounded-full bg-stone-100 px-3 py-1">
                                    <span>👥</span>
                                    <span>{{ $guestCount }} personne{{ $guestCount > 1 ? 's' : '' }}</span>
                                </span>

                                <span class="inline-flex items-center gap-2 rounded-full bg-stone-100 px-3 py-1">
                                    <span>🌙</span>
                                    <span>{{ $start->diffInDays($end) }} nuit{{ $start->diffInDays($end) > 1 ? 's' : '' }}</span>
                                </span>

                                <span class="inline-flex items-center gap-2 rounded-full bg-stone-100 px-3 py-1">
                                    <span>🏠</span>
                                    <span>{{ $booking->name }}</span>
                                </span>
                            </div>

                            @if(!empty($booking->description))
                                <p class="mt-4 line-clamp-3 text-sm leading-relaxed text-stone-600">
                                    {{ $booking->description }}
                                </p>
                            @endif

                            <div class="mt-4">
                                <a href="{{ route('family-apartment.bookings.show', $booking) }}"
                                   class="inline-flex items-center gap-2 text-sm font-bold text-emerald-700 hover:underline">
                                    Voir le détail
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border border-dashed border-stone-300 bg-white p-8 text-center text-stone-500">
                    Aucun séjour passé pour le moment.
                </div>
            @endforelse
        </section>
    </main>

    {{-- NAV MOBILE --}}
    <nav class="fixed inset-x-0 bottom-0 border-t bg-white py-3 md:hidden">
        <div class="flex items-center justify-around">
            <a href="{{ route('family-apartment.dashboard') }}" class="text-sm text-stone-500">Accueil</a>
            <a href="{{ route('family-apartment.bookings.create') }}" class="text-sm text-stone-500">Ajouter</a>
            <a href="{{ route('family-apartment.infos') }}" class="text-sm text-stone-500">Infos</a>
            <a href="{{ route('family-apartment.history') }}" class="text-sm font-bold text-emerald-600">Historique</a>
        </div>
    </nav>
</div>
@endsection