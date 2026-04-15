{{-- resources/views/family-apartment/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
    @php
        $appName = $appName ?? 'Paris s’éveille';
        $greeting = $greeting ?? 'Welcome to Paris !';
        $heroText = $heroText ?? "L'appartement vous attend. Prêts pour votre prochain séjour à Paris ?";
        $currentMonthLabel = $currentMonthLabel ?? \Carbon\Carbon::now()->locale('fr')->translatedFormat('F Y');

        $calendarDays = $calendarDays ?? [
            ['day' => 28, 'current_month' => false, 'today' => false, 'events' => []],
            ['day' => 29, 'current_month' => false, 'today' => false, 'events' => []],
            ['day' => 30, 'current_month' => false, 'today' => false, 'events' => []],
            [
                'day' => 1,
                'current_month' => true,
                'today' => true,
                'events' => [['label' => "Aujourd'hui", 'type' => 'today']],
            ],
            [
                'day' => 2,
                'current_month' => true,
                'today' => false,
                'events' => [['label' => 'Séjour Marie', 'type' => 'booking']],
            ],
            [
                'day' => 3,
                'current_month' => true,
                'today' => false,
                'events' => [['label' => 'Séjour Marie', 'type' => 'booking']],
            ],
            [
                'day' => 4,
                'current_month' => true,
                'today' => false,
                'events' => [['label' => 'Séjour Marie', 'type' => 'booking']],
            ],
            ['day' => 5, 'current_month' => true, 'today' => false, 'events' => []],
            ['day' => 6, 'current_month' => true, 'today' => false, 'events' => []],
            [
                'day' => 7,
                'current_month' => true,
                'today' => false,
                'events' => [['label' => 'Fête famille', 'type' => 'special']],
            ],
            ['day' => 8, 'current_month' => true, 'today' => false, 'events' => []],
            ['day' => 9, 'current_month' => true, 'today' => false, 'events' => []],
            ['day' => 10, 'current_month' => true, 'today' => false, 'events' => []],
            ['day' => 11, 'current_month' => true, 'today' => false, 'events' => []],
        ];

        $upcomingBookings = $upcomingBookings ?? [
            [
                'name' => 'Marie & Lucas',
                'dates' => '2 - 5 Octobre',
                'status' => 'Confirmé',
                'avatar' => null,
                'url' => '#',
            ],
            [
                'name' => 'Papa & Maman',
                'dates' => '12 - 19 Octobre',
                'status' => 'Confirmé',
                'avatar' => null,
                'url' => '#',
            ],
        ];

        $memo = $memo ?? "N'oubliez pas de vider le frigo et de fermer les volets avant de partir.";
        $usefulInfos = $usefulInfos ?? [
     
            ['icon' => 'vpn_key', 'label' => 'Code d\'entrée : 9092'],
        ];

        $weekDays = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
    @endphp

    <div class="min-h-screen bg-stone-50 text-stone-800 pb-32">
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
        <main class="mx-auto max-w-7xl space-y-10 px-6 pt-28">
            @if(session('success'))
                <div class="rounded-2xl bg-emerald-100 border border-emerald-300 text-emerald-800 px-5 py-4 font-semibold shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            {{-- HERO --}}
            <section
                class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-700 via-emerald-600 to-emerald-300 px-8 py-10 text-white shadow-xl md:px-12 md:py-14">
                <div class="relative z-10 max-w-2xl">
                    <h1 class="text-3xl font-extrabold tracking-tight md:text-5xl">{{ $greeting }}</h1>
                    <p class="mt-4 text-base font-medium text-white/90 md:text-lg">
                        {{ $heroText }}
                    </p>

                    <div class="mt-8">
                        <a href="{{ route('family-apartment.bookings.create') }}"
                            class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-3 font-bold text-emerald-700 shadow-lg transition hover:scale-[1.02]">
                            <span>+</span>
                            <span>Réserver un séjour</span>
                        </a>
                    </div>
                </div>

                <div class="pointer-events-none absolute -right-8 -top-8 h-48 w-48 rounded-full bg-white/10 blur-2xl"></div>
                <div class="pointer-events-none absolute bottom-0 right-0 h-40 w-40 rounded-full bg-white/10 blur-2xl">
                </div>
            </section>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
                {{-- CALENDRIER --}}
                <section class="space-y-6 lg:col-span-8">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-extrabold md:text-3xl">Calendrier des séjours</h2>
                            <p class="text-sm text-stone-500">{{ ucfirst($currentMonthLabel) }}</p>
                        </div>

                        <div class="flex items-center gap-2">
                            <a   class="flex h-10 w-10 items-center justify-center rounded-full border border-stone-200 bg-white text-stone-600 transition hover:bg-stone-50" 
                                href="{{ route('family-apartment.dashboard', ['month' => $month->copy()->subMonth()->format('Y-m')]) }}">
                                ←
                            </a>

                            <a   class="flex h-10 w-10 items-center justify-center rounded-full border border-stone-200 bg-white text-stone-600 transition hover:bg-stone-50"
                                href="{{ route('family-apartment.dashboard', ['month' => $month->copy()->addMonth()->format('Y-m')]) }}">
                                →
                            </a>
                        </div>
                    </div>

                 @php
    $weekDays = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
@endphp

<div class="rounded-3xl border border-stone-200 bg-white p-3 sm:p-4 lg:p-6 shadow-sm">

    {{-- JOURS --}}
    <div class="mb-3 grid grid-cols-7 gap-1.5 sm:gap-2 lg:gap-3">
        @foreach($weekDays as $dayName)
            <div class="text-center text-[10px] sm:text-xs font-bold uppercase tracking-wide text-stone-500">
                {{ $dayName }}
            </div>
        @endforeach
    </div>

    {{-- SEMAINES --}}
    <div class="space-y-1.5 sm:space-y-2 lg:space-y-3">
        @foreach($calendarWeeks as $week)
            <div class="grid grid-cols-7 gap-1.5 sm:gap-2 lg:gap-3">

                @foreach($week as $day)
                    @php
                        $cellClasses = 'h-[78px] sm:h-[92px] md:h-[110px] lg:h-[128px] xl:h-[140px] rounded-xl lg:rounded-2xl p-1.5 sm:p-2 lg:p-3 flex flex-col overflow-hidden border transition';

                        if (!$day['current_month']) {
                            $cellClasses .= ' bg-stone-100 text-stone-400 opacity-60 border-stone-100';
                        } elseif ($day['today']) {
                            $cellClasses .= ' bg-emerald-50 border-emerald-300';
                        } else {
                            $cellClasses .= ' bg-stone-50 border-stone-100 hover:border-stone-200 hover:shadow-sm';
                        }
                    @endphp

                    <div class="{{ $cellClasses }}">
                        {{-- HAUT DE CASE --}}
                        <div class="flex items-start justify-between gap-1">
                            <span class="text-xs sm:text-sm font-semibold leading-none {{ $day['today'] ? 'text-emerald-700' : '' }}">
                                {{ $day['day'] }}
                            </span>

                            @if($day['today'])
                                <span class="hidden lg:inline rounded-full bg-emerald-100 px-2 py-0.5 text-[10px] font-bold text-emerald-700">
                                    Aujourd’hui
                                </span>
                            @endif
                        </div>

                        {{-- EVENTS --}}
                        <div class="mt-1.5 sm:mt-2 space-y-1 overflow-hidden">
                            @forelse($day['events'] as $event)
                                @php
                                    $badgeClasses = match($event['type']) {
                                        'pending' => 'bg-amber-100 text-amber-800',
                                        default => 'bg-blue-100 text-blue-700',
                                    };
                                @endphp

                                <a href="{{ route('family-apartment.bookings.show', $event['booking_id']) }}"
                                   class="block truncate rounded-md lg:rounded-lg px-1.5 sm:px-2 py-1 text-[9px] sm:text-[10px] lg:text-xs font-bold {{ $badgeClasses }}">
                                    {{ $event['label'] }}
                                </a>
                            @empty
                                <div class="h-2"></div>
                            @endforelse
                        </div>
                    </div>
                @endforeach

            </div>
        @endforeach
    </div>
</div>
                </section>

                {{-- SIDEBAR --}}
                <aside class="space-y-6 lg:col-span-4">
                    <section>
                        <h2 class="mb-4 text-2xl font-bold">Prochains séjours</h2>

                        <div class="space-y-4">
                            @forelse($upcomingBookings as $booking)
                                <div
                                    class="rounded-3xl border border-stone-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                                    <div class="mb-3 flex items-center gap-4">
                                        <div
                                            class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-full bg-emerald-100 font-bold text-emerald-700">
                                            @if (!empty($booking['avatar']))
                                                <img src="{{ $booking['avatar'] }}" alt="{{ $booking['name'] }}"
                                                    class="h-full w-full object-cover">
                                            @else
                                                {{ \Illuminate\Support\Str::of($booking['name'])->explode(' ')->map(fn($part) => mb_substr($part, 0, 1))->take(2)->implode('') }}
                                            @endif
                                        </div>

                                        <div>
                                            <h3 class="text-lg font-bold">{{ $booking['name'] }}</h3>
                                            
                                            <p class="text-xs font-medium text-stone-500">{{ $booking['dates'] }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <span
                                            class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">
                                            {{ $booking['status'] }}
                                        </span>

                                        <a href="{{ $booking['url'] }}"
                                            class="text-sm font-bold text-emerald-700 hover:underline">
                                            Détails
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="rounded-3xl border border-dashed border-stone-300 bg-white p-6 text-sm text-stone-500">
                                    Aucun séjour prévu pour le moment.
                                </div>
                            @endforelse
                        </div>
                    </section>

                    <section class="relative overflow-hidden rounded-3xl bg-amber-100 p-6">
                        <h3 class="mb-2 font-bold text-amber-900">Pense-bête</h3>
                        <p class="text-sm text-amber-800">
                            {{ $memo }}
                        </p>
                        <div class="pointer-events-none absolute -bottom-6 -right-4 text-7xl opacity-10">💡</div>
                    </section>

                    <section class="rounded-3xl border border-stone-200 bg-stone-100 p-6">
                        <h3 class="mb-4 text-sm font-bold uppercase tracking-widest text-stone-500">
                            Informations utiles
                        </h3>

                        <ul class="space-y-4">
                            @foreach ($usefulInfos as $info)
                                <li class="flex items-center gap-3">
                                    <span
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white text-emerald-700 shadow-sm">
                                        •
                                    </span>
                                    <span class="text-sm font-medium text-stone-700">{{ $info['label'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                </aside>
            </div>
            <section class="mt-2 space-y-4">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-extrabold md:text-3xl">Bons plans</h2>
            <p class="text-sm text-stone-500">Les dernières idées et adresses partagées par la famille</p>
        </div>

        <a href="{{ route('family-apartment.tips.index') }}"
           class="text-sm font-bold text-emerald-700 hover:underline">
            Voir tout
        </a>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse(($tips ?? collect()) as $tip)
            <a href="{{ route('family-apartment.tips.show', $tip) }}"
               class="group overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">

                <div class="relative h-40 bg-gradient-to-br from-stone-200 to-stone-100">
                    @if($tip->image_url)
                        <img
                            src="{{ $tip->image_url }}"
                            alt="{{ $tip->title }}"
                            class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                        >
                    @else
                        <div class="flex h-full w-full items-center justify-center text-5xl">
                            {{ $tip->icon }}
                        </div>
                    @endif

                    <div class="absolute left-4 top-4">
                        <span class="rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $tip->category_color }}">
                            {{ $tip->category_label }}
                        </span>
                    </div>
                </div>

                <div class="p-5">
                    <div class="mb-2 flex items-start justify-between gap-3">
                        <h3 class="text-lg font-bold text-stone-900">
                            {{ $tip->title }}
                        </h3>

                        @if(!is_null($tip->rating))
                            <div class="flex shrink-0 items-center gap-1 text-amber-500">
                                <span>★</span>
                                <span class="text-sm font-bold text-stone-700">
                                    {{ number_format((float) $tip->rating, 1, ',', ' ') }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <p class="mb-3 line-clamp-2 text-sm leading-relaxed text-stone-600">
                        {{ $tip->description }}
                    </p>

                    @if(!empty($tip->address))
                        <p class="mb-3 text-sm text-stone-500">
                            📍 {{ $tip->address }}
                        </p>
                    @endif

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-xs font-bold text-emerald-700">
                                {{ $tip->author_initial }}
                            </div>

                            <span class="text-xs font-medium text-stone-500">
                                {{ $tip->author_name }}
                            </span>
                        </div>

                        <span class="text-sm font-bold text-emerald-700">
                            Voir →
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <div class="rounded-3xl border border-dashed border-stone-300 bg-white p-6 text-sm text-stone-500 md:col-span-2 xl:col-span-3">
                Aucun bon plan pour le moment.
            </div>
        @endforelse
    </div>
</section>
        </main>

        {{-- NAV MOBILE --}}
        <nav class="fixed inset-x-0 bottom-0 z-50 border-t border-stone-200 bg-white/95 backdrop-blur xl:hidden">
            <div class="mx-auto flex max-w-xl items-center justify-around px-4 py-3">
                <a href="{{ route('family-apartment.dashboard') }}"
                    class="flex flex-col items-center gap-1 text-emerald-700">
                    <span class="text-lg">⌂</span>
                    <span class="text-xs font-medium">Accueil</span>
                </a>

                <a href="{{ route('family-apartment.bookings.create') }}"
                    class="flex flex-col items-center gap-1 text-stone-500">
                    <span class="text-lg">＋</span>
                    <span class="text-xs font-medium">Réserver</span>
                </a>

                <a href="{{ route('family-apartment.infos') }}" class="flex flex-col items-center gap-1 text-stone-500">
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
