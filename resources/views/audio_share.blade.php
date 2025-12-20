@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-slate-50">
    <div class="max-w-3xl mx-auto px-6 py-16 space-y-10">

        {{-- Header --}}
        <div class="flex items-center gap-4">
            <img
                src="{{ $track['cover'] }}"
                alt="Cover"
                class="w-20 h-20 rounded-xl shadow-lg object-cover"
            >

            <div>
                <h1 class="text-2xl font-semibold">
                    Extrait partagé
                </h1>
                <p class="text-slate-400 text-sm mt-1">
                    {{ $track['title'] }} · {{ $track['artist'] }}
                </p>
               @php
                    $start = (int) $start;          // seconds
                    $end = (int) $end;
                    $dur = max(0, $end - $start);

                    $fmt = function($s){
                        $h = intdiv($s, 3600);
                        $m = intdiv($s % 3600, 60);
                        $sec = $s % 60;
                        return $h > 0
                            ? sprintf('%d:%02d:%02d', $h, $m, $sec)
                            : sprintf('%d:%02d', $m, $sec);
                    };
                @endphp

                <p class="text-sm text-slate-300">
                De {{ $fmt($start) }} à {{ $fmt($end) }} ({{ $fmt($dur) }})
                </p>
            </div>
        

        </div>

        {{-- Player --}}
        <div class="bg-slate-900/80 border border-slate-700 rounded-3xl px-6 py-8 shadow-xl space-y-6">

            {{-- Controls --}}
            <div class="flex items-center gap-5">
                {{-- Play / Pause --}}
                <button
                    id="play-btn"
                    class="flex items-center justify-center
                           w-14 h-14 rounded-full
                           bg-indigo-600/90
                           shadow-lg shadow-indigo-600/40
                           hover:bg-indigo-500
                           active:scale-95
                           transition-all"
                >
                    {{-- Play --}}
                    <svg id="play-icon" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z"/>
                    </svg>

                    {{-- Pause --}}
                    <svg id="pause-icon" class="w-6 h-6 text-white hidden" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 5h4v14H6zm8 0h4v14h-4z"/>
                    </svg>
                </button>

                {{-- Progress --}}
                <div class="flex-1 space-y-2">
                    <div class="flex justify-between text-xs text-slate-400">
                        <span id="current-time">0:00</span>
                        <span>{{ gmdate('i:s', $end - $start) }}</span>
                    </div>

                    <div class="h-2 rounded-full bg-slate-700 overflow-hidden">
                        <div
                            id="progress-bar"
                            class="h-full bg-indigo-500 transition-all duration-150"
                            style="width: 0%"
                        ></div>
                    </div>
                </div>
            </div>

            {{-- Audio --}}
            <audio
                id="audio-player"
                src="{{ $track['url'] }}"
                preload="metadata"
            ></audio>
        </div>
            <p id="status" class="text-xs text-slate-400"></p>
        {{-- Back --}}
        <a
            href="{{ route('audio.player') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                   bg-slate-800 hover:bg-slate-700 transition"
        >
            ← Retour à la bibliothèque
        </a>
    </div>
</div>

{{-- JS --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const audio = document.getElementById('audio-player');
    const playBtn = document.getElementById('play-btn');
    const playIcon = document.getElementById('play-icon');
    const pauseIcon = document.getElementById('pause-icon');
    const progressBar = document.getElementById('progress-bar');
    const currentTimeEl = document.getElementById('current-time');

    // (optionnel) si tu as un <p id="status">, sinon laisse null
    const statusEl = document.getElementById('status');

    let excerptEnded = false;

    const START_TIME = {{ $start }};
    const END_TIME   = {{ $end }};
    const DURATION   = Math.max(END_TIME - START_TIME, 0.01);

    function fmt(seconds) {
        seconds = Math.max(0, Math.floor(seconds));
        const m = Math.floor(seconds / 60);
        const s = String(seconds % 60).padStart(2, '0');
        return `${m}:${s}`;
    }

    function setUIFromTime() {
        const elapsed = Math.min(Math.max(audio.currentTime - START_TIME, 0), DURATION);
        const percent = Math.min((elapsed / DURATION) * 100, 100);
        progressBar.style.width = `${percent}%`;
        if (currentTimeEl) currentTimeEl.textContent = fmt(elapsed);
    }

    // Positionne au début de l'extrait dès que les métadonnées sont prêtes
    audio.addEventListener('loadedmetadata', () => {
        audio.currentTime = START_TIME;
        setUIFromTime();
    }, { once: true });

    playBtn.addEventListener('click', async () => {
        // si l'extrait était terminé, on repart du début
        if (excerptEnded) {
            excerptEnded = false;
            audio.currentTime = START_TIME;
            progressBar.classList.remove('bg-emerald-500');
            progressBar.classList.add('bg-indigo-500');
            if (statusEl) statusEl.textContent = '';
        }

        if (audio.paused) {
            await audio.play().catch(() => {});
        } else {
            audio.pause();
        }
    });

    audio.addEventListener('play', () => {
        playIcon.classList.add('hidden');
        pauseIcon.classList.remove('hidden');
    });

    audio.addEventListener('pause', () => {
        playIcon.classList.remove('hidden');
        pauseIcon.classList.add('hidden');
    });

    audio.addEventListener('timeupdate', () => {
        if (excerptEnded) return;

        // Fin de l'extrait (pas fin du fichier)
        if (audio.currentTime >= END_TIME) {
            audio.pause();
            audio.currentTime = END_TIME;

            excerptEnded = true;

            progressBar.style.width = '100%';
            progressBar.classList.remove('bg-indigo-500');
            progressBar.classList.add('bg-emerald-500');

            playIcon.classList.remove('hidden');
            pauseIcon.classList.add('hidden');

            if (statusEl) statusEl.textContent = 'Extrait terminé.';

            return;
        }

        setUIFromTime();
    });

    // Anti-seek hors extrait (bonus)
    audio.addEventListener('seeking', () => {
        if (audio.currentTime < START_TIME) audio.currentTime = START_TIME;
        if (audio.currentTime > END_TIME) audio.currentTime = END_TIME;
    });
});
</script>

@endsection
