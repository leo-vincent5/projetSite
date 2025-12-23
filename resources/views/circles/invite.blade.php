@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-950 text-slate-50 flex items-center justify-center p-6">
  <div class="w-full max-w-lg rounded-3xl border border-slate-700 bg-slate-900/80 p-6">
    <p class="text-sm text-slate-400">Invitation à rejoindre</p>
    <h1 class="text-2xl font-semibold mt-1">{{ $circle->name }}</h1>

    @if($already)
      <p class="mt-4 text-slate-300">Tu fais déjà partie de ce cercle ✅</p>
      <a href="{{ route('circles.show', $circle) }}"
         class="inline-flex mt-5 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 transition">
        Ouvrir le cercle
      </a>
    @else
      <p class="mt-4 text-slate-300">
        {{ auth()->user()->name }}, veux-tu rejoindre ce cercle d’amis ?
      </p>

      <form method="POST" action="{{ route('circles.join', $circle) }}" class="mt-5">
        @csrf
        <button class="w-full px-4 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 transition font-medium">
          Rejoindre le cercle
        </button>
      </form>

      <p class="mt-3 text-xs text-slate-400">
        En rejoignant, tu pourras partager et voir les extraits du cercle (selon tes règles).
      </p>
    @endif
  </div>
</div>
@endsection
