@extends('layouts.app')

@section('css')
    <style>

      .navbar {
            background-color: rgb(2 6 23 / var(--tw-bg-opacity, 1))!important;
           
      }

       .navbar-brand{
 color:white !important;
       }

      main{
        background-color: rgb(2 6 23 / var(--tw-bg-opacity, 1))!important;
      }


      .navbar-light .navbar-toggler-icon {
    filter: invert(1) !important;
      }


      .text-3xl {
    font-size: 1.875rem;
    line-height: 2.25rem;
    color: #ff8800 !important;
}

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
                <div class="relative md:w-40 md:h-40 w-60 h-60  sm:w-48 sm:h-48 rounded-2xl overflow-hidden shadow-[0_0_40px_rgba(15,23,42,0.9)] bg-slate-800">
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
                   <div class="flex flex-wrap items-center w-full  gap-2">
                    {{-- Bouton partager (icone) --}}
                    <button
                        id="open-share-modal"
                        type="button"
                        class="inline-flex items-center justify-center w-11 h-11 rounded-xl flex-1
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

                    <button id="open-comments-modal"
                            type="button"
                            class="inline-flex items-center justify-center w-11 h-11 rounded-xl flex-1
                                border border-slate-700 bg-slate-900/70 hover:bg-slate-800/80 transition"
                            title="Commentaires">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-200" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M4 4h16v12H7l-3 3V4z"/>
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
                        class="hidden w-full md:w-auto px-4 py-2 text-sm rounded-xl border border-slate-500 text-slate-100
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


  

{{-- ====== MODALE CREATION CERCLE ====== --}}
<div id="create-circle-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

    <div class="relative min-h-full flex items-center justify-center p-4">
        <div class="w-full max-w-md rounded-3xl border border-slate-700 bg-slate-900/95 shadow-2xl overflow-hidden">
            <div class="p-5 border-b border-slate-800 flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-400">Nouveau cercle</p>
                    <p class="text-lg font-semibold text-slate-50">Créer un cercle d’amis</p>
                </div>

                <button id="close-create-circle" type="button"
                        class="w-10 h-10 rounded-xl border border-slate-700 bg-slate-900/70 hover:bg-slate-800 transition flex items-center justify-center"
                        aria-label="Fermer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-200" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.3 5.71 12 12l6.3 6.29-1.41 1.42L12 13.41l-6.89 6.3-1.42-1.41L10.59 12 3.69 5.71 5.1 4.29 12 10.59l6.89-6.3z"/>
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('circles.store') }}" class="p-5 space-y-4">
                @csrf
                <div class="space-y-2">
                    <label class="text-sm text-slate-300">Nom du cercle</label>
                    <input name="name" required maxlength="80"
                           class="w-full px-3 py-2 rounded-xl bg-slate-950 border border-slate-700 text-sm text-slate-100"
                           placeholder="Ex: Les potes, Famille, Team…">
                </div>

                <div class="flex items-center justify-end gap-2 pt-2">
                    <button type="button" id="cancel-create-circle"
                            class="px-4 py-2 rounded-xl border border-slate-600 text-slate-100 hover:bg-slate-800 transition text-sm">
                        Annuler
                    </button>
                    <button type="submit"
                            class="px-4 py-2 rounded-xl bg-emerald-600/90 text-white hover:bg-emerald-500 transition text-sm font-medium">
                        Créer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

        <div class="bg-slate-900/60 rounded-3xl border border-slate-700/70 p-5 sm:p-6">
            <div class="flex items-center justify-between flex-wrap">
                <h2 class="text-lg font-semibold">Commentaires</h2>
                <div id="locked-comments" class="text-xs text-slate-400"></div>
            </div>

            <div id="comments-list-main" class="mt-4 space-y-3"></div>
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
                            class="track-btn group relative flex flex-col rounded-2xl overflow-hidden bg-slate-900 shadow-lg  border-slate-800 hover:border-indigo-400/80 hover:shadow-[0_0_30px_rgba(129,140,248,0.3)] transition-all duration-300"
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
              {{-- ====== CERClES ====== --}}
<div class="bg-slate-900/60 rounded-3xl border border-slate-700/70 p-5 sm:p-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Cercles</p>
            <h2 class="text-lg font-semibold text-slate-50">Tes cercles d’amis</h2>
            <p class="text-sm text-slate-400">Crée un cercle, invite des amis, et partage des extraits.</p>
        </div>

        <div class="flex items-center gap-2">
            {{-- Sélecteur cercle actif (optionnel) --}}
            <select id="circle-select"
                    class="px-3 py-2 rounded-xl bg-slate-950 border border-slate-700 text-sm text-slate-100">
                <option value="">Aucun cercle</option>
                @foreach(($circles ?? []) as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>

            {{-- Nouveau cercle --}}
            <button id="open-create-circle"
                    type="button"
                    class="inline-flex items-center justify-center w-11 h-11 rounded-xl
                           border border-slate-700 bg-slate-900/70 hover:bg-slate-800/80 transition"
                    title="Créer un cercle">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-200" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 11H13V5h-2v6H5v2h6v6h2v-6h6z"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Liste des cercles --}}
    <div class="mt-5 grid gap-3 sm:grid-cols-2">
        @forelse(($circles ?? []) as $c)
            <div class="rounded-2xl border border-slate-800 bg-slate-950/40 p-4">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="font-semibold text-slate-50 leading-tight">{{ $c->name }}</p>
                        <p class="text-xs text-slate-400 mt-1">{{ $c->members_count }} membre(s)</p>

                        {{-- Membres (bulles) --}}
                        <div class="mt-3 flex -space-x-2">
                            @foreach($c->members->take(6) as $m)
                                @php
                                    $initials = collect(explode(' ', trim($m->name ?? '')))
                                        ->filter()->take(2)->map(fn($p)=>mb_strtoupper(mb_substr($p,0,1)))->join('');
                                    if($initials === '') $initials = '🙂';
                                @endphp
                                <div class="px-3 w-9 h-9 rounded-full border border-slate-700 bg-slate-900 flex items-center justify-center text-xs font-semibold text-slate-100"
                                     title="{{ $m->name }}">
                                    {{ $m->name }}
                                </div>
                            @endforeach

                            @if($c->members_count > 6)
                                <div class="w-9 h-9 rounded-full border border-slate-700 bg-slate-900 flex items-center justify-center text-[11px] font-semibold text-slate-300">
                                    +{{ $c->members_count - 6 }}
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Actions (optionnel) --}}
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('circles.show', $c) }}"
                           class="px-3 py-2 rounded-xl border border-slate-700 text-sm text-slate-100 hover:bg-slate-800 transition text-center">
                            Ouvrir
                        </a>

                        {{-- si tu veux un bouton invite rapide --}}
                        <button type="button"
                                class="copy-invite px-3 py-2 rounded-xl border border-indigo-500/70 text-sm text-indigo-100 hover:bg-indigo-600/20 transition"
                                data-invite="{{ route('circles.invite', $c->invite_token) }}">
                            Inviter
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-slate-800 bg-slate-950/40 p-4">
                <p class="text-slate-300 font-medium">Aucun cercle pour l’instant</p>
                <p class="text-sm text-slate-400 mt-1">Clique sur + pour créer ton premier cercle.</p>
            </div>
        @endforelse
    </div>
</div>
    </div>
</div>

<div id="comments-modal" class="fixed inset-0 z-50 hidden">
  <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

  <div class="relative min-h-full flex items-center justify-center p-4">
    <div class="w-full max-w-xl rounded-3xl border border-slate-700 bg-slate-900/95 shadow-2xl overflow-hidden">
      <div class="p-5 border-b border-slate-800 flex items-center justify-between">
        <div>
          <p class="text-sm text-slate-400">Commentaires (anti-spoil)</p>
          <p class="text-lg font-semibold text-slate-50" id="comments-modal-title">—</p>
          <p class="text-xs text-slate-400 mt-1">
            Cercle : <span id="comments-circle-name" class="text-slate-200">—</span>
            · <span id="comments-hidden" class="text-slate-400"></span>
          </p>
        </div>

        <button id="close-comments-modal" type="button"
                class="w-10 h-10 rounded-xl border border-slate-700 bg-slate-900/70 hover:bg-slate-800 transition flex items-center justify-center">
          ✕
        </button>
      </div>

      <div class="p-5 space-y-4">
        <div class="flex items-center gap-2">
          <select id="comments-circle-select"
                  class="px-3 py-2 rounded-xl bg-slate-950 border border-slate-700 text-sm text-slate-100">
            <option value="">Choisir un cercle…</option>
            @foreach(($circles ?? []) as $c)
              <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
          </select>

          <button id="add-comment-now"
                  class="px-4 py-2 rounded-xl bg-indigo-600/90 text-white hover:bg-indigo-500 transition text-sm">
            Commenter à ce moment
          </button>
        </div>

        <div id="comments-list-modal"
             class="max-h-[45vh] overflow-auto space-y-2 rounded-2xl border border-slate-800 bg-slate-950/40 p-3">
          <p class="text-sm text-slate-400">Sélectionne un cercle pour voir les commentaires.</p>
        </div>
      </div>
    </div>
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

  const csrfToken   = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
  const SAVE_URL    = "{{ route('audio.resume.save') }}";
  const SAVE_INTERVAL_MS = 5 * 60 * 1000; // 5 minutes

  const COMMENTS_INDEX_URL = "{{ route('comments.index') }}";
  const COMMENTS_STORE_URL = "{{ route('comments.store') }}";
  const COMMENTS_MY_URL = "{{ route('comments.my') }}";

  // =========================
  // Helpers
  // =========================
  function escapeHtml(s){
    return String(s ?? '').replace(/[&<>"']/g, m => ({
      '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'
    }[m]));
  }

  function fmtTime(s){
    s = Math.max(0, Math.floor(s || 0));
    const m = Math.floor(s / 60);
    const r = s % 60;
    return `${m}:${String(r).padStart(2,'0')}`;
  }

  // =========================
  // Cercles / Create circle modal
  // =========================
  const createCircleModal = document.getElementById('create-circle-modal');
  const openCreateCircleBtn = document.getElementById('open-create-circle');
  const closeCreateCircleBtn = document.getElementById('close-create-circle');
  const cancelCreateCircleBtn = document.getElementById('cancel-create-circle');

  function openCreateCircleModal(){ createCircleModal?.classList.remove('hidden'); }
  function closeCreateCircleModal(){ createCircleModal?.classList.add('hidden'); }

  openCreateCircleBtn?.addEventListener('click', openCreateCircleModal);
  closeCreateCircleBtn?.addEventListener('click', closeCreateCircleModal);
  cancelCreateCircleBtn?.addEventListener('click', closeCreateCircleModal);

  createCircleModal?.addEventListener('click', (e) => {
    if (e.target === createCircleModal) closeCreateCircleModal();
  });

  document.querySelectorAll('.copy-invite').forEach(btn => {
    btn.addEventListener('click', async () => {
      const link = btn.dataset.invite;
      if (!link) return;

      try {
        await navigator.clipboard.writeText(link);
        const old = btn.textContent;
        btn.textContent = 'Copié ✅';
        setTimeout(() => btn.textContent = old, 1200);
      } catch (e) {
        window.prompt('Copie le lien :', link);
      }
    });
  });

  async function fetchMyComments(){
  const track = tracks[currentIndex];
  if (!track?.bookId) return;

  const t = Math.floor(audioEl.currentTime || 0);

  const url = new URL(COMMENTS_MY_URL, window.location.origin);
  url.searchParams.set('book_id', track.bookId);
  url.searchParams.set('progress', String(t));

  const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' }});
  if (!res.ok) return;

  const json = await res.json();

  // json.visible = commentaires de tous mes cercles
  renderCommentsMain(json.visible || []);
  renderCommentsModal(json.visible || []);

  const n = json.locked_count || 0;
  if (lockedEl) lockedEl.textContent = n > 0 ? `${n} commentaire(s) verrouillé(s) (anti-spoil)` : '';
  if (commentsHidden) commentsHidden.textContent = n > 0 ? `🔒 ${n} pas encore débloqué(s)` : `✅ aucun spoiler`;
}

  // =========================
  // Tracks & resume cache
  // =========================
  const serverResumes = @json($lastState ?? []);
  const localResumes = readLocalResumes();

// fusion simple : priorité au plus récent (updated_at), sinon local si server absent
  function mergeResumes(server, local) {
    const out = { ...(server || {}) };

    Object.keys(local || {}).forEach((bookId) => {
      const s = out[bookId];
      const l = local[bookId];

      const sTs = s?.updated_at ? Number(s.updated_at) : 0;
      const lTs = l?.updated_at ? Number(l.updated_at) : 0;

      if (!s) out[bookId] = l;
      else if (lTs > sTs) out[bookId] = l;
    });

    return out;
  }

  const mergedResumes = mergeResumes(serverResumes, localResumes);

  // remplace ensuite ton serverResumes par mergedResumes
  Object.assign(serverResumes, mergedResumes);

  const tracks = Array.from(buttons).map((btn, index) => {
    const meta = btn.querySelector('.track-meta');
    return {
      btn,
      index,
      bookId: meta?.dataset?.bookId,
      url: meta?.dataset?.url,
      title: meta?.dataset?.title,
      artist: meta?.dataset?.artist,
      album: meta?.dataset?.album,
      cover: meta?.dataset?.cover,
      duration: meta?.dataset?.duration ? parseFloat(meta.dataset.duration) : null,
    };
  });

  let currentIndex = 0;
  let lastServerSaveTs = 0;
  let isSaving = false;

  function applyTrackToUI(track) {
    titleEl.textContent  = track?.title || 'Audio';
    artistEl.textContent = track?.artist || '';
    if (track?.cover) coverEl.src = track.cover;
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
  book_id: track.bookId,                    // ✅ requis
  time: Math.floor(audioEl.currentTime || 0), // ✅ requis

  // optionnels si ton backend les accepte
    time_sec: Math.floor(audioEl.currentTime || 0),
  url: track.url || null,
  title: track.title || '',
  artist: track.artist || '',
  cover: track.cover || '',
};
  saveResumeLocal(track, payload.time); // ✅ ici
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
        payload.updated_at = Date.now();
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

  // =========================
  // MAIN comments (zone page)
  // IMPORTANT: ton HTML doit avoir UN id unique ici, ex: id="comments-list-main"
  // =========================
  const circleSelect = document.getElementById('circle-select');
  const lockedEl = document.getElementById('locked-comments');
  const commentsListMain = document.getElementById('comments-list-main'); // <-- renomme ton id HTML

  let lastFetchAt = 0;
  let commentsDebounceTimer = null;

  function renderCommentsMain(items){
  if (!commentsListMain) return;

  if (!items?.length) {
    commentsListMain.innerHTML = `<p class="text-sm text-slate-400">Aucun commentaire pour l’instant.</p>`;
    return;
  }

  commentsListMain.innerHTML = items.map(c => {
    const who = escapeHtml(c.user?.name || 'Quelqu’un');
    const body = escapeHtml(c.body || '');
    const t = parseInt(c.time_sec ?? 0, 10);
    const mm = Math.floor(t/60);
    const ss = String(t%60).padStart(2,'0');

    return `
      <div class="rounded-2xl border border-slate-800 bg-slate-950/40 p-4">
        <div class="flex items-center justify-between gap-3">
          <div class="text-sm text-slate-200 font-medium">${who}</div>
          <button type="button"
            class="text-xs px-2 py-1 rounded-lg border border-slate-700 text-slate-300 hover:bg-slate-800"
            data-jump="${t}">⏱ ${fmtTimeHM(c.time_sec)}</button>
        </div>
        <p class="text-sm text-slate-100 mt-2">${body}</p>
      </div>
    `;
  }).join('');

  commentsListMain.querySelectorAll('[data-jump]').forEach(b => {
    b.addEventListener('click', () => {
      const t = parseInt(b.dataset.jump, 10) || 0;
      audioEl.currentTime = t;
      audioEl.play().catch(()=>{});
    });
  });
}


function renderCommentsModal(items){
  if (!commentsListModal) return;

  if (!items?.length) {
    commentsListModal.innerHTML = `<p class="text-sm text-slate-400">Aucun commentaire débloqué pour l’instant.</p>`;
    return;
  }

  commentsListModal.innerHTML = items.map(c => {
    const who = escapeHtml(c.user?.name || 'Quelqu’un');
    const body = escapeHtml(c.body || '');
    const t = parseInt(c.time_sec ?? 0, 10);

    return `
      <div class="rounded-xl border border-slate-800 bg-slate-900/40 p-3">
        <div class="flex items-center justify-between">
          <div class="text-sm text-slate-200 font-medium">${who}</div>
          <div class="text-xs text-slate-400">${fmtTimeHM(c.time_sec)}</div>
        </div>
        <div class="text-sm text-slate-100 mt-1 whitespace-pre-wrap">${body}</div>
      </div>
    `;
  }).join('');
}

  async function fetchCommentsMain(){
    const circleId = circleSelect?.value;
    const track = tracks[currentIndex];

    if (!circleId || !track?.bookId) {
      renderCommentsMain([]);
      if (lockedEl) lockedEl.textContent = '';
      return;
    }

    const now = Date.now();
    if (now - lastFetchAt < 2500) return;
    lastFetchAt = now;

    const t = Math.floor(audioEl.currentTime || 0);
    const url = new URL(COMMENTS_INDEX_URL, window.location.origin);
    url.searchParams.set('circle_id', circleId);
    url.searchParams.set('book', track.bookId);        // ✅
    url.searchParams.set('progress', String(t));  

    const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' }});
    if (!res.ok) return;

   const json = await res.json();
renderCommentsMain(json.visible || []);
lockedEl.textContent = (json.locked_count || 0) > 0
  ? `${json.locked_count} commentaire(s) verrouillé(s) (anti-spoil)`
  : '';
    if (lockedEl) {
const n = json.locked_count ?? json.hidden ?? 0;
lockedEl.textContent = n > 0 ? `${n} commentaire(s) verrouillé(s) (anti-spoil)` : '';
    }
  }

  circleSelect?.addEventListener('change', fetchCommentsMain);
let myCommentsTimer = null;
  audioEl.addEventListener('timeupdate', () => {
   
   if (myCommentsTimer) return;
  myCommentsTimer = setTimeout(() => {
    myCommentsTimer = null;
    fetchMyComments();
  }, 3000); // toutes les 3s pendant la lecture
  });

  // =========================
  // Load track
  // =========================
  function loadTrack(index, autoplay = true, tryRestoreTime = true) {
    const track = tracks[index];
    if (!track) return;

    currentIndex = index;
    setLastBookId(track.bookId);
    audioEl.src  = track.url;
    applyTrackToUI(track);

    buttons.forEach((btn, i) => {
      btn.classList.toggle('ring-2', i === index);
      btn.classList.toggle('ring-indigo-400', i === index);
    });

    updateResumeButtonForCurrentTrack();

    const state = tryRestoreTime ? getResumeForTrack(track) : null;

    const startPlayback = () => {
      if (autoplay) audioEl.play().catch(() => {});
    };

    if (state && state.time != null && !isNaN(state.time) && state.time > 0) {
      const onLoaded = () => {
        audioEl.currentTime = state.time;
        requestAnimationFrame(startPlayback);
        audioEl.removeEventListener('loadedmetadata', onLoaded);
      };
      audioEl.addEventListener('loadedmetadata', onLoaded);
    } else {
      startPlayback();
    }

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

    // si la modale commentaires est ouverte, refresh (défini plus bas)
    if (isCommentsOpen()) {
      commentsTitle.textContent = track.title || 'Commentaires';
      fetchCommentsModal();
    }

    // refresh zone page
    fetchCommentsMain();
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
      requestAnimationFrame(() => audioEl.play().catch(() => {}));
      audioEl.removeEventListener('loadedmetadata', onLoaded);
    };

    if (audioEl.readyState >= 1) onLoaded();
    else audioEl.addEventListener('loadedmetadata', onLoaded);
  });
  

  // =========================
  // SHARE MODAL (fix class selector)
  // =========================
  const shareModal = document.getElementById('share-modal');
  const openShareModalBtn = document.getElementById('open-share-modal');
  const closeShareModalBtn = document.getElementById('close-share-modal');
  const closeShareModalBtn2 = document.getElementById('close-share-modal-2');
  const shareTitleEl = document.getElementById('share-modal-title');
  const shareLinkInput = document.getElementById('share-link');
  const copyBtn = document.getElementById('copy-share-link');
  const copyFeedback = document.getElementById('copy-feedback');
  const openShareLinkBtn = document.getElementById('open-share-link');

  let shareDuration = 30;



// =========================
// LocalStorage resume store
// =========================
  const LS_RESUME_KEY = 'leodible_resumes_v1';      // { [bookId]: {time, title, url, cover, artist, updated_at} }
  const LS_LAST_KEY   = 'leodible_last_book_id_v1'; // "hp2"

  function readLocalResumes() {
    try {
      return JSON.parse(localStorage.getItem(LS_RESUME_KEY) || '{}') || {};
    } catch {
      return {};
    }
  }

  function writeLocalResumes(obj) {
    localStorage.setItem(LS_RESUME_KEY, JSON.stringify(obj || {}));
  }

  function setLastBookId(bookId) {
    if (bookId) localStorage.setItem(LS_LAST_KEY, String(bookId));
  }

  function getLastBookId() {
    return localStorage.getItem(LS_LAST_KEY) || null;
  }

  /**
  * Sauve l'état local + marque ce book comme "dernier lu"
  */
  function saveResumeLocal(track, timeSec) {
  if (!track?.bookId) return;

  const t = Math.floor(timeSec || 0);
  const resumes = readLocalResumes();

  resumes[track.bookId] = {
    book_id: track.bookId,
    time: t,
    url: track.url || null,
    title: track.title || '',
    artist: track.artist || '',
    cover: track.cover || '',
    updated_at: Date.now()
  };

  writeLocalResumes(resumes);
  setLastBookId(track.bookId);
}


  function refreshShareLink() {
    const track = tracks[currentIndex];
    const t = Math.max(0, Math.floor(audioEl.currentTime || 0));
    const url = new URL("{{ route('audio.share.show') }}", window.location.origin);
    url.searchParams.set('book', track.bookId);
    url.searchParams.set('t', t);
    url.searchParams.set('d', shareDuration);
    if (shareLinkInput) shareLinkInput.value = url.toString();
  }

  function openShareModal() {
    const track = tracks[currentIndex];
    if (shareTitleEl) shareTitleEl.textContent = track?.title || 'Extrait';
    refreshShareLink();
    shareModal?.classList.remove('hidden');
    copyFeedback?.classList.add('hidden');
  }

  function closeShareModal() {
    shareModal?.classList.add('hidden');
  }

  openShareModalBtn?.addEventListener('click', () => {
    if (!tracks?.length) return;
    openShareModal();
  });

  closeShareModalBtn?.addEventListener('click', closeShareModal);
  closeShareModalBtn2?.addEventListener('click', closeShareModal);

  shareModal?.addEventListener('click', (e) => {
    if (e.target === shareModal) closeShareModal();
  });

  // ✅ tu avais ".share-dur-btn" mais tes boutons sont ".share-duration-btn"
  document.querySelectorAll('.share-duration-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      shareDuration = parseInt(btn.dataset.dur, 10) || 30;

      document.querySelectorAll('.share-duration-btn')
        .forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      refreshShareLink();
      copyFeedback?.classList.add('hidden');
    });
  });

  copyBtn?.addEventListener('click', async () => {
    try {
      await navigator.clipboard.writeText(shareLinkInput?.value || '');
      copyFeedback?.classList.remove('hidden');
      setTimeout(() => copyFeedback?.classList.add('hidden'), 1500);
    } catch (e) {
      shareLinkInput?.select?.();
      document.execCommand('copy');
      copyFeedback?.classList.remove('hidden');
      setTimeout(() => copyFeedback?.classList.add('hidden'), 1500);
    }
  });

  openShareLinkBtn?.addEventListener('click', () => {
    if (shareLinkInput?.value) window.open(shareLinkInput.value, '_blank');
  });

  // =========================
  // COMMENTS MODAL (renommé pour éviter doublons)
  // IMPORTANT: ton HTML modale doit utiliser id="comments-list-modal"
  // =========================
  const commentsModal = document.getElementById('comments-modal');
  const openCommentsBtn = document.getElementById('open-comments-modal');
  const closeCommentsBtn = document.getElementById('close-comments-modal');

  const commentsTitle = document.getElementById('comments-modal-title');
  const commentsListModal = document.getElementById('comments-list-modal'); // <-- id unique HTML


  const commentsCircleSelect = document.getElementById('comments-circle-select');
  const commentsCircleName = document.getElementById('comments-circle-name');
  const commentsHidden = document.getElementById('comments-hidden');
  const addCommentNowBtn = document.getElementById('add-comment-now');





  let commentsCache = [];
  let commentsHiddenCount = 0;
  let modalInterval = null;

  function fmtTimeHM(seconds){
  seconds = Math.max(0, Math.floor(seconds || 0));

  const h = Math.floor(seconds / 3600);
  const m = Math.floor((seconds % 3600) / 60);
  const s = seconds % 60;







  if (h > 0) {
    return `${h}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
  }
  return `${m}:${String(s).padStart(2,'0')}`;
}

  function renderCommentsModal(list){
  if (!commentsListModal) return;

  if (!list || !list.length){
    commentsListModal.innerHTML = `<p class="text-sm text-slate-400">Aucun commentaire débloqué pour l’instant.</p>`;
    return;
  }

  commentsListModal.innerHTML = list.map(c => `
    <div class="rounded-xl border border-slate-800 bg-slate-900/40 p-3">
      <div class="flex items-center justify-between">
        <div class="text-sm text-slate-200 font-medium">${escapeHtml(c.user?.name ?? 'Quelqu’un')}</div>
        <div class="text-xs text-slate-400">${fmtTimeHM(c.time_sec)}</div>
      </div>
      <div class="text-sm text-slate-100 mt-1 whitespace-pre-wrap">${escapeHtml(c.body)}</div>
    </div>
  `).join('');
}

async function fetchCommentsModal(){
  const circleId = commentsCircleSelect?.value;
  const track = tracks[currentIndex];
  if (!circleId || !track?.bookId) {
    renderCommentsModal([]);
    commentsHidden.textContent = '';
    return;
  }

  const t = Math.floor(audioEl.currentTime || 0);

  const url = new URL(COMMENTS_INDEX_URL, window.location.origin);
  url.searchParams.set('circle_id', circleId);
  url.searchParams.set('book_id', track.bookId);   // ou book selon ton merge côté Laravel
  url.searchParams.set('progress', String(t));     // ou t

  const res = await fetch(url.toString(), {
    headers: { 'Accept': 'application/json' }
  });

  if (!res.ok) return;

  const json = await res.json();

  renderCommentsModal(json.visible || []);
  const n = json.locked_count || 0;
  commentsHidden.textContent = n > 0
    ? `🔒 ${n} commentaire(s) pas encore débloqué(s)`
    : `✅ aucun spoiler`;
}

  function openCommentsModal(){
    const track = tracks[currentIndex];
    if (commentsTitle) commentsTitle.textContent = track?.title || 'Commentaires';
    commentsModal?.classList.remove('hidden');

    fetchCommentsModal();
    modalInterval = setInterval(fetchCommentsModal, 3000);
  }

  function closeCommentsModal(){
    commentsModal?.classList.add('hidden');
    if (modalInterval) clearInterval(modalInterval);
    modalInterval = null;
  }

  function isCommentsOpen(){
    return commentsModal && !commentsModal.classList.contains('hidden');
  }

  openCommentsBtn?.addEventListener('click', openCommentsModal);
  closeCommentsBtn?.addEventListener('click', closeCommentsModal);

  commentsModal?.addEventListener('click', (e) => {
    if (e.target === commentsModal) closeCommentsModal();
  });

  commentsCircleSelect?.addEventListener('change', () => {
    const txt = commentsCircleSelect.options[commentsCircleSelect.selectedIndex]?.textContent || '—';
    if (commentsCircleName) commentsCircleName.textContent = txt;
    fetchCommentsModal();
  });

  addCommentNowBtn?.addEventListener('click', async () => {
    const circleId = commentsCircleSelect?.value;
    const track = tracks[currentIndex];
    if (!circleId || !track?.bookId) return;

    const timecode = Math.floor(audioEl.currentTime || 0);
    const content = window.prompt(`Ton commentaire à ${fmtTimeHM(timecode)} :`);
    if (!content) return;

    const res = await fetch(COMMENTS_STORE_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json',
      },
       body: JSON.stringify({
  circle_id: parseInt(circleId, 10),
  book_id: track.bookId,                  
    track_title: (track.title || 'Audio'),   // ✅ jamais null     // si ton backend attend "book" (comme /comments GET)
  time_sec: Math.floor(audioEl.currentTime || 0), // ✅ requis
  body: content                              // ✅ requis (content = le texte du prompt)
})
    });

    if (!res.ok) {
      console.error(await res.text());
      return;
    }

    await fetchCommentsModal();
    fetchCommentsMain(); // optionnel: refresh zone page aussi
  });

  // =========================
  // INIT
  // =========================
  if (tracks.length > 0) {
  const serverLast = serverResumes?.__last?.book_id || null;
  const localLast  = getLastBookId();
  const lastId = serverLast || localLast;

  let idx = 0;
  if (lastId) {
    const found = tracks.find(t => String(t.bookId) === String(lastId));
    if (found) idx = found.index;
  } else {
    // fallback : prends la plus récente via updated_at (ou la plus avancée si pas de timestamps)
    let best = { idx: 0, score: -1 };
    tracks.forEach(t => {
      const r = serverResumes?.[t.bookId];
      if (!r) return;
      const score = (r.updated_at ? Number(r.updated_at) : 0) || (r.time ? Number(r.time) : 0);
      if (score > best.score) best = { idx: t.index, score };
    });
    idx = best.idx;
  }

  loadTrack(idx, true, true);
} else {
  updateResumeButtonForCurrentTrack();
}

  updateTrackBadges();
  fetchCommentsMain();
  fetchMyComments();


  function saveBeforeLeave() {
  const track = tracks[currentIndex];
  if (!track) return;

  const t = Math.floor(audioEl.currentTime || 0);
  if (t < 1) return;

  saveResumeLocal(track, t);

  fetch(SAVE_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json',
    },
    body: JSON.stringify({
      book_id: track.bookId,
      time: t,
      url: track.url || null,
      title: track.title || '',
      artist: track.artist || '',
      cover: track.cover || '',
    }),
    keepalive: true
  }).catch(()=>{});
}

window.addEventListener('pagehide', saveBeforeLeave);
document.addEventListener('visibilitychange', () => {
  if (document.visibilityState === 'hidden') saveBeforeLeave();
});


});
</script>

@endsection