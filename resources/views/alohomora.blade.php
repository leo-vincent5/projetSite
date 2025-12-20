@extends('layouts.app')

@section('css')
    <style>

.share-duration-btn.active {
  background: linear-gradient(135deg,
    rgba(99,102,241,0.35),
    rgba(79,70,229,0.25)
  );
  border-color: rgb(129 140 248); /* indigo-400 */
  color: white;
  box-shadow:
    0 0 0 1px rgba(99,102,241,0.4),
    0 8px 30px rgba(99,102,241,0.25);
}
        </style>
@endsection

@section('content')

{{-- MODALE PARTAGE --}}
<div id="share-modal" class="fixed inset-0 z-50 hidden">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

    {{-- Panel --}}
    <div class="relative min-h-full flex items-center justify-center p-4">
        <div class="w-full max-w-md rounded-3xl border border-slate-700 bg-slate-900/95 shadow-2xl overflow-hidden">
            <div class="p-5 border-b border-slate-800 flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-400">Partager un extrait</p>
                    <p class="text-lg font-semibold text-slate-50" id="share-modal-title">—</p>
                </div>

                <button id="close-share-modal" type="button"
                        class="w-10 h-10 rounded-xl border border-slate-700 bg-slate-900/70 hover:bg-slate-800 transition flex items-center justify-center"
                        aria-label="Fermer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-200" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.3 5.71 12 12l6.3 6.29-1.41 1.42L12 13.41l-6.89 6.3-1.42-1.41L10.59 12 3.69 5.71 5.1 4.29 12 10.59l6.89-6.3z"/>
                    </svg>
                </button>
            </div>

            <div class="p-5 space-y-4">
                <div class="space-y-2">
                    <label class="text-sm text-slate-300">Durée de l’extrait</label>
                    <div class="grid grid-cols-4 gap-2">
                        <button type="button" class="share-duration-btn px-4 py-2 rounded-xl border text-sm transition border-slate-600 text-slate-300 bg-slate-800/60 hover:bg-slate-700/60 hover:border-indigo-400 hover:text-white" data-dur="15">15s</button>
                        <button type="button" class="share-duration-btn px-4 py-2 rounded-xl border text-sm transition border-slate-600 text-slate-300 bg-slate-800/60 hover:bg-slate-700/60 hover:border-indigo-400 hover:text-white" data-dur="30">30s</button>
                        <button type="button" class="share-duration-btn px-4 py-2 rounded-xl border text-sm transition border-slate-600 text-slate-300 bg-slate-800/60 hover:bg-slate-700/60 hover:border-indigo-400 hover:text-white" data-dur="60">60s</button>
                        <button type="button" class="share-duration-btn px-4 py-2 rounded-xl border text-sm transition border-slate-600 text-slate-300 bg-slate-800/60 hover:bg-slate-700/60 hover:border-indigo-400 hover:text-white" data-dur="120">2m</button>
                    </div>
                    <p class="text-xs text-slate-400">
                        Le lien pointera exactement à l’instant où tu es.
                    </p>
                </div>

                <div class="space-y-2">
                    <label class="text-sm text-slate-300">Lien</label>
                    <div class="flex gap-2">
                        <input id="share-link" type="text" readonly
                               class="flex-1 px-3 py-2 rounded-xl bg-slate-950 border border-slate-700 text-sm text-slate-100"
                               value="">
                        <button id="copy-share-link" type="button"
                                class="px-4 py-2 rounded-xl border border-indigo-500 text-indigo-100 hover:bg-indigo-600/80 transition text-sm">
                            Copier
                        </button>
                    </div>
                    <p id="copy-feedback" class="text-xs text-emerald-400 hidden">Copié ✅</p>
                </div>

                <div class="flex items-center justify-end gap-2 pt-2">
                    <button id="open-share-link" type="button"
                            class="px-4 py-2 rounded-xl border border-slate-600 text-slate-100 hover:bg-slate-800 transition text-sm">
                        Ouvrir
                    </button>
                    <button id="close-share-modal-2" type="button"
                            class="px-4 py-2 rounded-xl bg-indigo-600/90 text-white hover:bg-indigo-500 transition text-sm">
                        Terminé
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="min-h-screen bg-slate-950 text-slate-50">
    <div class="max-w-5xl mx-auto px-4 py-10 space-y-8">

        {{-- Titre + meta --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
            <div>
                <h1 class="text-3xl font-semibold">Mes audios</h1>
                <p class="mt-1 text-sm text-slate-400">Sélectionne une piste dans ta bibliothèque pour la lire.</p>
            </div>

            @if(!empty($tracks))
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-900 border border-slate-700 text-xs">
                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                    <span>{{ count($tracks) }} piste(s) disponible(s)</span>
                </div>
                @php
                $fmt = function($s){
                    $s = (int) round($s);
                    $h = intdiv($s, 3600);
                    $m = intdiv($s % 3600, 60);
                    return $h > 0 ? "{$h}h ".sprintf('%02d', $m)."m" : "{$m} min";
                };
                @endphp

                <div class="text-xs text-slate-400">
                Temps total écouté (approx) : <span class="text-slate-200 font-medium">{{ $fmt($totalSeconds) }}</span>
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
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400 mb-1">En lecture</p>
                    <p id="current-title" class="text-xl sm:text-2xl font-semibold text-slate-50">
                        Sélectionne un audio pour commencer
                    </p>
                    <p id="current-artist" class="text-sm text-slate-400 mt-1">-</p>
                </div>

                <div class="space-y-3">
                   <div class="flex items-center gap-2">
                    {{-- Bouton partager (icone) --}}
                    <button
                        id="open-share-modal"
                        type="button"
                        class="inline-flex items-center justify-center w-11 h-11 rounded-xl
                            border border-slate-700 bg-slate-900/70
                            hover:bg-slate-800/80 hover:border-slate-600
                            transition"
                        title="Partager un extrait"
                    >
                        {{-- Icon share --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-200" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15 8a3 3 0 1 0-2.83-4H12a3 3 0 0 0 0 .17l-5.9 3.1A3 3 0 0 0 3 10a3 3 0 0 0 3.1 2.99l5.9 3.1A3 3 0 0 0 12 16a3 3 0 1 0 3-3c-.52 0-1 .13-1.42.35l-5.38-2.83c.05-.17.08-.35.08-.52s-.03-.35-.08-.52l5.38-2.83C14 7.87 14.48 8 15 8z"/>
                        </svg>
                    </button>

                    {{-- Bouton sauvegarder (tu peux le laisser normal ou aussi en icône) --}}
                    <button
                        id="save-now-btn"
                        class="px-4 py-2 text-sm rounded-xl border border-emerald-500 text-emerald-100
                            hover:bg-emerald-600/80 hover:border-emerald-400 transition
                            disabled:opacity-60 disabled:cursor-not-allowed"
                        type="button"
                    >
                        Sauvegarder maintenant (auto 5min)
                    </button>

                    {{-- Reprendre (si visible) --}}
                    <button
                        id="resume-btn"
                        class="hidden px-4 py-2 text-sm rounded-xl border border-slate-500 text-slate-100
                            hover:bg-slate-800/80 transition disabled:opacity-60 disabled:cursor-not-allowed"
                        type="button"
                    >
                        Reprendre
                    </button>
                </div>

                    <div class="bg-slate-800/80 rounded-2xl px-3 py-2 flex items-center gap-3">
                        <audio id="audio-player" class="w-full" controls preload="none">
                            Votre navigateur ne supporte pas l’élément audio.
                        </audio>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bibliothèque d’audios --}}
        <section class="space-y-3">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">Bibliothèque</h2>
                <p class="text-xs text-slate-400">Clique sur une jaquette pour lancer la lecture.</p>
            </div>

            @if(empty($tracks))
                <p class="text-sm text-slate-400 mt-4">Aucune piste audio disponible pour le moment.</p>
            @else
                <div class="grid gap-4 sm:gap-5 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                    @foreach ($tracks as $index => $track)
                        <button
                            type="button"
                            class="track-btn group relative flex flex-col rounded-2xl overflow-hidden bg-slate-900 shadow-lg border border-slate-800 hover:border-indigo-400/80 hover:shadow-[0_0_30px_rgba(129,140,248,0.3)] transition-all duration-300"
                            data-index="{{ $index }}"
                        >
                            <div class="relative aspect-square w-full">
                                {{-- Badge + barre de progression --}}
                                <div class="absolute top-2 left-2 flex items-center gap-2 pointer-events-none">
                                    <span class="badge-status hidden px-2 py-1 rounded-lg text-xs font-medium border backdrop-blur
                                                bg-slate-950/60 border-slate-200/10 text-slate-100">
                                    </span>
                                </div>

                                <div class="absolute left-0 right-0 bottom-0 h-1.5 bg-black/30">
                                    <div class="badge-progress h-full w-0 bg-indigo-500/90"></div>
                                </div>
                                <img
                                    src="{{ $track['cover'] ?? asset('images/default-cover.png') }}"
                                    alt="{{ $track['title'] ?? 'Audio' }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                >

                                <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent"></div>

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

                            <div class="px-3 py-2 text-left">
                                <p class="text-sm font-medium truncate">{{ $track['title'] ?? 'Piste '.($index+1) }}</p>
                                <p class="text-xs text-slate-400 truncate">{{ $track['artist'] ?? 'Audio' }}</p>
                            </div>

                            {{-- Meta cachées --}}
                            <span class="hidden track-meta"
                                  data-url="{{ $track['url'] }}"
                                  data-title="{{ $track['title'] ?? 'Piste '.($index+1) }}"
                                  data-artist="{{ $track['artist'] ?? 'Audio' }}"
                                  data-album="{{ $track['album'] ?? '' }}"
                                  data-cover="{{ $track['cover'] ?? asset('images/default-cover.png') }}"
                                  data-book-id="{{ $track['book_id'] ?? $track['url'] }}"
                                  data-duration="{{ $track['duration'] ?? '' }}">
                            </span>
                        </button>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</div>

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

    // IMPORTANT: $lastState doit maintenant être un objet { book_id: {...}, book_id2: {...} }
    const serverResumes = @json($lastState ?? []);

    const tracks = Array.from(buttons).map((btn, index) => {
        const meta = btn.querySelector('.track-meta');
        return {
            btn: btn, // ✅ IMPORTANT pour les badges
            index,
            bookId: meta.dataset.bookId,
            url: meta.dataset.url,
            title: meta.dataset.title,
            artist: meta.dataset.artist,
            album: meta.dataset.album,
            cover: meta.dataset.cover,
            duration: meta.dataset.duration ? parseFloat(meta.dataset.duration) : null,
        };
    });


    let currentIndex  = 0;
    let lastServerSaveTs = 0;
    let isSaving      = false;


    const shareBtn = document.getElementById('share-btn');
    const shareDurationEl = document.getElementById('share-duration');

    shareBtn?.addEventListener('click', async () => {
    const track = tracks[currentIndex];
    if (!track) return;

    const t = Math.floor(audioEl.currentTime || 0);
    const d = parseInt(shareDurationEl.value || '30', 10);

    const url = new URL("{{ route('audio.share.show') }}", window.location.origin);
    url.searchParams.set('book', track.bookId);
    url.searchParams.set('t', String(t));
    url.searchParams.set('d', String(d));

    // si le navigateur supporte le partage natif
    if (navigator.share) {
        try {
        await navigator.share({
            title: `Extrait - ${track.title}`,
            text: `Extrait (${d}s) à ${t}s`,
            url: url.toString(),
        });
        return;
        } catch (e) {}
    }

    // fallback: copie dans le presse-papiers
    await navigator.clipboard.writeText(url.toString());
    shareBtn.textContent = "Lien copié ✅";
    setTimeout(() => shareBtn.textContent = "Partager l’extrait", 2000);
    });


    function applyTrackToUI(track) {
        titleEl.textContent  = track.title || 'Audio';
        artistEl.textContent = track.artist || '';
        if (track.cover) coverEl.src = track.cover;
    }

    function getResumeForTrack(track) {
        if (!track?.bookId) return null;
        return serverResumes[track.bookId] ?? null;
    }


    function fmtShort(seconds) {
        seconds = Math.max(0, Math.floor(seconds || 0));
        const h = Math.floor(seconds / 3600);
        const m = Math.floor((seconds % 3600) / 60);
        if (h > 0) return `${h}h${String(m).padStart(2,'0')}`;
        return `${m} min`;
    }

    function updateTrackBadges() {
        tracks.forEach((t) => {
            const resume = serverResumes?.[t.bookId] ?? null;

            const badgeEl = t.btn.querySelector('.badge-status');
            const barEl   = t.btn.querySelector('.badge-progress');

            if (!badgeEl || !barEl) return;

            // reset
            badgeEl.classList.add('hidden');
            badgeEl.textContent = '';
            badgeEl.classList.remove(
                'bg-emerald-500/15','border-emerald-400/30','text-emerald-200',
                'bg-indigo-500/15','border-indigo-400/30','text-indigo-200'
            );

            barEl.style.width = '0%';
            barEl.classList.remove('bg-emerald-500/90');
            barEl.classList.add('bg-indigo-500/90');

            if (!resume || !resume.time || resume.time < 5) return;

            let pct = null;
            if (t.duration && t.duration > 0) {
                pct = Math.min((resume.time / t.duration) * 100, 100);
                barEl.style.width = `${pct}%`;
            } else {
                // sans durée -> barre symbolique
                barEl.style.width = '35%';
            }

            const isDone = (pct !== null) ? (pct >= 98) : false;

            if (isDone) {
                badgeEl.classList.remove('hidden');
                badgeEl.textContent = 'Lu';
                badgeEl.classList.add('bg-emerald-500/15','border-emerald-400/30','text-emerald-200');
                barEl.classList.remove('bg-indigo-500/90');
                barEl.classList.add('bg-emerald-500/90');
            } else {
                badgeEl.classList.remove('hidden');
                badgeEl.textContent = `En cours · ${fmtShort(resume.time)}`;
                badgeEl.classList.add('bg-indigo-500/15','border-indigo-400/30','text-indigo-200');
            }
        });
    }


    function updateResumeButtonForCurrentTrack() {
        const track = tracks[currentIndex];
        const state = getResumeForTrack(track);

        if (state && state.time != null && !isNaN(state.time) && state.time > 0) {
            resumeBtn.classList.remove('hidden');
            resumeBtn.textContent = `Reprendre “${state.title || track.title || 'ma lecture'}”`;
        } else {
            resumeBtn.classList.add('hidden');
        }
    }

    async function saveResumeToServer(manual = false) {
        const track = tracks[currentIndex];
        if (!track || isNaN(audioEl.currentTime)) return;

        if (!manual && audioEl.currentTime < 10) return;

        if (manual && audioEl.currentTime < 1) {
            const oldText = saveNowBtn.textContent;
            saveNowBtn.textContent = 'Rien à sauvegarder pour l’instant';
            setTimeout(() => saveNowBtn.textContent = oldText, 2000);
            return;
        }

        const payload = {
            book_id: track.bookId,
            url: track.url,
            title: track.title || '',
            artist: track.artist || '',
            cover: track.cover || '',
            time: audioEl.currentTime,
        };

        const now = Date.now();
        if (!manual && now - lastServerSaveTs < SAVE_INTERVAL_MS - 10_000) return;

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

                // ✅ Met à jour le cache côté client aussi
                serverResumes[track.bookId] = payload;
                updateResumeButtonForCurrentTrack();
                updateTrackBadges();

                if (manual) {
                    const oldText = saveNowBtn.textContent;
                    saveNowBtn.textContent = 'Sauvegardé ✅';
                    setTimeout(() => saveNowBtn.textContent = oldText, 2000);
                }
            }
        } catch (e) {
            console.error('Erreur réseau sauvegarde audio:', e);
        } finally {
            isSaving = false;
            saveNowBtn.disabled = false;
        }
    }

 function loadTrack(index, autoplay = true, tryRestoreTime = true) {
    const track = tracks[index];
    if (!track) return;

    currentIndex = index;
    audioEl.src  = track.url;
    applyTrackToUI(track);

    buttons.forEach((btn, i) => {
        btn.classList.toggle('ring-2', i === index);
        btn.classList.toggle('ring-indigo-400', i === index);
    });

    updateResumeButtonForCurrentTrack();

    const state = tryRestoreTime ? getResumeForTrack(track) : null;

    const startPlayback = () => {
        if (autoplay) {
            audioEl.play().catch(() => {});
        }
    };

    // Si on a une reprise, on repositionne AVANT de lancer play
    if (state && state.time != null && !isNaN(state.time) && state.time > 0) {
        const onLoaded = () => {
            audioEl.currentTime = state.time;

            // Certains navigateurs ont besoin d'un micro "tick"
            requestAnimationFrame(() => {
                startPlayback();
            });

            audioEl.removeEventListener('loadedmetadata', onLoaded);
        };
        audioEl.addEventListener('loadedmetadata', onLoaded);
    } else {
        // Pas de reprise → on lance direct
        startPlayback();
    }

    // MediaSession (inchangé)
    if ('mediaSession' in navigator) {
        try {
            const metaInit = {
                title: track.title || 'Audio',
                artist: track.artist || '',
                album: track.album || ''
            };
            if (track.cover) metaInit.artwork = [{ src: track.cover, sizes: '512x512' }];
            navigator.mediaSession.metadata = new MediaMetadata(metaInit);
        } catch (e) {}
    }
}

    buttons.forEach((btn, index) => {
        btn.addEventListener('click', () => loadTrack(index, true, true));
    });

    audioEl.addEventListener('ended', () => {
        saveResumeToServer(false);
        if (currentIndex + 1 < tracks.length) loadTrack(currentIndex + 1, true, true);
    });

    audioEl.addEventListener('timeupdate', () => {
        const now = Date.now();
        if (now - lastServerSaveTs > SAVE_INTERVAL_MS) saveResumeToServer(false);
    });

    saveNowBtn.addEventListener('click', () => saveResumeToServer(true));

    resumeBtn.addEventListener('click', () => {
    const track = tracks[currentIndex];
    const state = getResumeForTrack(track);
    if (!state) return;

    const onLoaded = () => {
        audioEl.currentTime = state.time || 0;

        requestAnimationFrame(() => {
            audioEl.play().catch(() => {});
        });

        audioEl.removeEventListener('loadedmetadata', onLoaded);
    };

    // si déjà chargé, loadedmetadata ne se déclenche pas toujours → on gère les 2 cas
    if (audioEl.readyState >= 1) {
        onLoaded();
    } else {
        audioEl.addEventListener('loadedmetadata', onLoaded);
    }
});


    // Init
    if (tracks.length > 0) {
        loadTrack(0, true, true);
    } else {
        updateResumeButtonForCurrentTrack();
    }

    updateTrackBadges();


    // ====== SHARE MODAL ======
const shareModal = document.getElementById('share-modal');
const openShareModalBtn = document.getElementById('open-share-modal');
const closeShareModalBtn = document.getElementById('close-share-modal');
const closeShareModalBtn2 = document.getElementById('close-share-modal-2');
const shareTitleEl = document.getElementById('share-modal-title');
const shareLinkInput = document.getElementById('share-link');
const copyBtn = document.getElementById('copy-share-link');
const copyFeedback = document.getElementById('copy-feedback');
const openShareLinkBtn = document.getElementById('open-share-link');

let shareDuration = 30; // default

function openShareModal() {
    // titre du track courant
    const track = tracks[currentIndex];
    if (shareTitleEl) shareTitleEl.textContent = track?.title || 'Extrait';

    // génère le lien à l’instant actuel
    refreshShareLink();

    shareModal.classList.remove('hidden');
    copyFeedback.classList.add('hidden');
}

function closeShareModal() {
    shareModal.classList.add('hidden');
}

function refreshShareLink() {
    const track = tracks[currentIndex];
    const t = Math.max(0, Math.floor(audioEl.currentTime || 0));

    // construit un lien type: /extrait?book=hp1&t=123&d=30
    const url = new URL("{{ route('audio.share.show') }}", window.location.origin);

    url.searchParams.set('book', track.bookId);
    url.searchParams.set('t', t);
    url.searchParams.set('d', shareDuration);

    shareLinkInput.value = url.toString();
}

openShareModalBtn?.addEventListener('click', () => {
    if (!tracks?.length) return;
    openShareModal();
});

closeShareModalBtn?.addEventListener('click', closeShareModal);
closeShareModalBtn2?.addEventListener('click', closeShareModal);

// click backdrop pour fermer
shareModal?.addEventListener('click', (e) => {
    if (e.target === shareModal) closeShareModal();
});

document.querySelectorAll('.share-dur-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        shareDuration = parseInt(btn.dataset.dur, 10) || 30;

        // UI: highlight sélection
        document.querySelectorAll('.share-dur-btn').forEach(b => {
            b.classList.remove('border-indigo-500', 'text-indigo-100');
            b.classList.add('border-slate-700');
        });
        btn.classList.remove('border-slate-700');
        btn.classList.add('border-indigo-500', 'text-indigo-100');

        refreshShareLink();
        copyFeedback.classList.add('hidden');
    });

    
});


document.querySelectorAll('.share-duration-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.share-duration-btn')
      .forEach(b => b.classList.remove('active'));

    btn.classList.add('active');
  });
});
copyBtn?.addEventListener('click', async () => {
    try {
        await navigator.clipboard.writeText(shareLinkInput.value);
        copyFeedback.classList.remove('hidden');
        setTimeout(() => copyFeedback.classList.add('hidden'), 1500);
    } catch (e) {
        // fallback: select + copy
        shareLinkInput.select();
        document.execCommand('copy');
        copyFeedback.classList.remove('hidden');
        setTimeout(() => copyFeedback.classList.add('hidden'), 1500);
    }
});

openShareLinkBtn?.addEventListener('click', () => {
    window.open(shareLinkInput.value, '_blank');
});


});
</script>
@endsection
