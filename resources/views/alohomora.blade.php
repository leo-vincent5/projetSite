@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-950 text-slate-50">
    <div class="max-w-5xl mx-auto px-4 py-10 space-y-8">

        {{-- Titre + meta --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
            <div>
                <h1 class="text-3xl font-semibold">
                    Mes audios
                </h1>
                <p class="mt-1 text-sm text-slate-400">
                    Sélectionne une piste dans ta bibliothèque pour la lire.
                </p>
            </div>

            @if(!empty($tracks))
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-900 border border-slate-700 text-xs">
                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                    <span>{{ count($tracks) }} piste(s) disponible(s)</span>
                </div>
            @endif
        </div>

        {{-- Player principal --}}
        <div class="bg-slate-900/80 rounded-3xl border border-slate-700/70 shadow-xl p-5 sm:p-6 flex flex-col sm:flex-row gap-5">
            {{-- Cover grande --}}
            <div class="w-full sm:w-48 flex-shrink-0 flex justify-center sm:justify-start">
                <div class="relative w-40 h-40 sm:w-48 sm:h-48 rounded-2xl overflow-hidden shadow-[0_0_40px_rgba(15,23,42,0.9)] bg-slate-800">
                    <img
                        id="player-cover"
                        src="{{ $tracks[0]['cover'] ?? asset('images/default-cover.png') }}"
                        alt="Cover"
                        class="w-full h-full object-cover"
                    >
                    <div class="absolute inset-0 bg-gradient-to-tr from-slate-950/50 via-transparent to-slate-950/20 pointer-events-none"></div>
                </div>
            </div>

            {{-- Infos + contrôles --}}
            <div class="flex-1 flex flex-col justify-between">
                <div class="mb-3">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400 mb-1">
                        En lecture
                    </p>
                    <p id="current-title" class="text-xl sm:text-2xl font-semibold text-slate-50">
                        Sélectionne un audio pour commencer
                    </p>
                    <p id="current-artist" class="text-sm text-slate-400 mt-1">
                        -
                    </p>
                </div>

                <div class="space-y-3">
                    <button
                        id="resume-btn"
                        class="hidden px-4 py-2 text-sm rounded-xl border border-slate-500 text-slate-100 hover:bg-slate-800/80 transition disabled:opacity-60 disabled:cursor-not-allowed"
                        type="button"
                    >
                        Reprendre ma dernière écoute
                    </button>
                    <button
                        id="save-now-btn"
                        class="px-4 py-2 text-sm rounded-xl border border-emerald-500 text-emerald-100 hover:bg-emerald-600/80 hover:border-emerald-400 transition disabled:opacity-60 disabled:cursor-not-allowed"
                        type="button"
                    >
                        Sauvegarder maintenant (auto 5min)
                    </button>

                    <div class="bg-slate-800/80 rounded-2xl px-3 py-2 flex items-center gap-3">
                        <audio
                            id="audio-player"
                            class="w-full"
                            controls
                            preload="none"
                        >
                            Votre navigateur ne supporte pas l’élément audio.
                        </audio>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bibliothèque d’audios --}}
        <section class="space-y-3">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">
                    Bibliothèque
                </h2>
                <p class="text-xs text-slate-400">
                    Clique sur une jaquette pour lancer la lecture.
                </p>
            </div>

            @if(empty($tracks))
                <p class="text-sm text-slate-400 mt-4">
                    Aucune piste audio disponible pour le moment.
                </p>
            @else
                <div class="grid gap-4 sm:gap-5 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                    @foreach ($tracks as $index => $track)
                        <button
                            type="button"
                            class="track-btn group relative flex flex-col rounded-2xl overflow-hidden bg-slate-900 shadow-lg border border-slate-800 hover:border-indigo-400/80 hover:shadow-[0_0_30px_rgba(129,140,248,0.3)] transition-all duration-300"
                            data-index="{{ $index }}"
                        >
                            {{-- Cover carrée --}}
                            <div class="relative aspect-square w-full">
                                <img
                                    src="{{ $track['cover'] ?? asset('images/default-cover.png') }}"
                                    alt="{{ $track['title'] ?? 'Audio' }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                >

                                {{-- Dégradé bas pour le texte + effet au survol --}}
                                <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent"></div>

                                {{-- Play au centre au survol --}}
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                                        <div class="h-12 w-12 rounded-full bg-slate-950/85 backdrop-blur flex items-center justify-center border border-slate-100/30">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Titre / sous-titre --}}
                            <div class="px-3 py-2 text-left">
                                <p class="text-sm font-medium truncate">
                                    {{ $track['title'] ?? 'Piste '.($index+1) }}
                                </p>
                                <p class="text-xs text-slate-400 truncate">
                                    {{ $track['artist'] ?? 'Audio' }}
                                </p>
                            </div>

                            {{-- Meta cachées --}}
                            <span class="hidden track-meta"
                                  data-url="{{ $track['url'] }}"
                                  data-title="{{ $track['title'] ?? 'Piste '.($index+1) }}"
                                  data-artist="{{ $track['artist'] ?? 'Audio' }}"
                                  data-album="{{ $track['album'] ?? '' }}"
                                  data-cover="{{ $track['cover'] ?? asset('images/default-cover.png') }}">
                            </span>
                        </button>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</div>


<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    slate: {
                        950: '#0f172a',
                    }
                }
            }
        }
    }
</script>


<style>
    /* Si jamais tu réutilises un jour un mode bandeau scrollable */
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const buttons     = document.querySelectorAll('.track-btn');
    const audioEl     = document.getElementById('audio-player');
    const titleEl     = document.getElementById('current-title');
    const artistEl    = document.getElementById('current-artist');
    const coverEl     = document.getElementById('player-cover');
    const resumeBtn   = document.getElementById('resume-btn');
    const saveNowBtn  = document.getElementById('save-now-btn');

    const csrfToken   = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const SAVE_URL    = "{{ route('audio.resume.save') }}";
    const SAVE_INTERVAL_MS = 5 * 60 * 1000; // 5 minutes

    const serverLastState = @json($lastState ?? null);

    const tracks = Array.from(buttons).map((btn, index) => {
        const meta = btn.querySelector('.track-meta');
        return {
            index,
            url: meta.dataset.url,
            title: meta.dataset.title,
            artist: meta.dataset.artist,
            album: meta.dataset.album,
            cover: meta.dataset.cover,
        };
    });

    let currentIndex  = 0;
    let lastServerSaveTs = 0;
    let isSaving      = false;

    function applyTrackToUI(track) {
        titleEl.textContent  = track.title || 'Audio';
        artistEl.textContent = track.artist || '';
        if (track.cover) {
            coverEl.src = track.cover;
        }
    }

    async function saveResumeToServer(manual = false) {
        const track = tracks[currentIndex];
        if (!track || isNaN(audioEl.currentTime)) return;

        if (!manual && audioEl.currentTime < 10) {
            return;
        }

        if (manual && audioEl.currentTime < 1) {
            const oldText = saveNowBtn.textContent;
            saveNowBtn.textContent = 'Rien à sauvegarder pour l’instant';
            setTimeout(() => {
                saveNowBtn.textContent = oldText;
            }, 2000);
            return;
        }

        const payload = {
            url: track.url,
            title: track.title || '',
            artist: track.artist || '',
            cover: track.cover || '',
            time: audioEl.currentTime,
        };

        const now = Date.now();
        if (!manual && now - lastServerSaveTs < SAVE_INTERVAL_MS - 10_000) {
            return;
        }

        if (isSaving) return;
        isSaving = true;
        saveNowBtn.disabled = true;

        try {
            const res = await fetch(SAVE_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(payload),
            });

            if (!res.ok) {
                console.error('Erreur sauvegarde audio:', await res.text());
            } else {
                lastServerSaveTs = now;
                if (manual) {
                    const oldText = saveNowBtn.textContent;
                    saveNowBtn.textContent = 'Sauvegardé ✅';
                    setTimeout(() => {
                        saveNowBtn.textContent = oldText;
                    }, 2000);
                }
            }
        } catch (e) {
            console.error('Erreur réseau sauvegarde audio:', e);
        } finally {
            isSaving = false;
            saveNowBtn.disabled = false;
        }
    }

    function showResumeButtonIfAny() {
        if (serverLastState && serverLastState.url && !isNaN(serverLastState.time)) {
            resumeBtn.classList.remove('hidden');
            resumeBtn.textContent = `Reprendre “${serverLastState.title || 'ma dernière écoute'}”`;
        } else {
            resumeBtn.classList.add('hidden');
        }
    }

    function loadTrack(index, autoplay = true) {
        const track = tracks[index];
        if (!track) return;

        currentIndex = index;
        audioEl.src  = track.url;
        applyTrackToUI(track);

        buttons.forEach((btn, i) => {
            btn.classList.toggle('ring-2', i === index);
            btn.classList.toggle('ring-indigo-400', i === index);
        });

        if ('mediaSession' in navigator) {
            try {
                const metaInit = {
                    title: track.title || 'Audio',
                    artist: track.artist || '',
                    album: track.album || ''
                };

                if (track.cover) {
                    metaInit.artwork = [
                        {
                            src: track.cover,
                            sizes: '512x512'
                        }
                    ];
                }

                navigator.mediaSession.metadata = new MediaMetadata(metaInit);

                navigator.mediaSession.setActionHandler('previoustrack', () => {
                    if (currentIndex > 0) {
                        loadTrack(currentIndex - 1);
                        audioEl.play();
                    }
                });

                navigator.mediaSession.setActionHandler('nexttrack', () => {
                    if (currentIndex + 1 < tracks.length) {
                        loadTrack(currentIndex + 1);
                        audioEl.play();
                    }
                });
            } catch (e) {
                console.error('MediaSession error', e);
            }
        }

        if (autoplay) {
            audioEl.play().catch(() => {});
        }
    }

    buttons.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            loadTrack(index, true);
        });
    });

    audioEl.addEventListener('ended', () => {
        saveResumeToServer(false);
        if (currentIndex + 1 < tracks.length) {
            loadTrack(currentIndex + 1, true);
        }
    });

    audioEl.addEventListener('timeupdate', () => {
        const now = Date.now();
        if (now - lastServerSaveTs > SAVE_INTERVAL_MS) {
            saveResumeToServer(false);
        }
    });

    saveNowBtn.addEventListener('click', () => {
        saveResumeToServer(true);
    });

    resumeBtn.addEventListener('click', () => {
        const state = serverLastState;
        if (!state) return;

        const idx = tracks.findIndex(t => t.url === state.url);
        if (idx === -1) return;

        loadTrack(idx, false);

        const onLoaded = () => {
            audioEl.currentTime = state.time || 0;
            audioEl.play().catch(() => {});
            audioEl.removeEventListener('loadedmetadata', onLoaded);
        };
        audioEl.addEventListener('loadedmetadata', onLoaded);
    });

    if (serverLastState && serverLastState.url && !isNaN(serverLastState.time)) {
        const idx = tracks.findIndex(t => t.url === serverLastState.url);

        if (idx !== -1) {
            const track = tracks[idx];
            currentIndex = idx;

            audioEl.src = track.url;
            applyTrackToUI(track);
            buttons.forEach((btn, i) => {
                btn.classList.toggle('ring-2', i === idx);
                btn.classList.toggle('ring-indigo-400', i === idx);
            });

            audioEl.addEventListener('loadedmetadata', () => {
                audioEl.currentTime = serverLastState.time || 0;
            }, { once: true });

            showResumeButtonIfAny();
        } else {
            if (tracks.length > 0) {
                loadTrack(0, false);
            }
            showResumeButtonIfAny();
        }
    } else {
        if (tracks.length > 0) {
            loadTrack(0, false);
        }
        showResumeButtonIfAny();
    }
});
</script>
@endsection
