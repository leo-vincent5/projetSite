@extends('layouts.app')

@section('content')


@php
    $me = auth()->user();
    $isAdmin = $circle->members
        ->firstWhere('id', $me->id)?->pivot->role === 'owner';
@endphp


<div class="min-h-screen bg-slate-950 text-slate-50">
    <div class="max-w-4xl mx-auto px-4 py-10 space-y-8">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold">
                    {{ $circle->name }}
                </h1>
                <p class="text-sm text-slate-400 mt-1">
                    Cercle d’amis · {{ $circle->members->count() }} membre(s)
                </p>
            </div>

            <a href="{{ route('audio.player') }}"
               class="px-4 py-2 rounded-xl border border-slate-700 text-slate-200 hover:bg-slate-800 transition text-sm">
                ← Retour
            </a>
        </div>

        {{-- Membres --}}
        <div class="bg-slate-900/80 border border-slate-700/70 rounded-2xl shadow-xl p-5">
            <h2 class="text-lg font-semibold mb-4">
                Membres du cercle
            </h2>

            @if($circle->members->isEmpty())
                <p class="text-sm text-slate-400">
                    Aucun membre pour le moment.
                </p>
            @else
                <ul class="divide-y divide-slate-800">
                    @foreach($circle->members as $member)
                        <li class="py-3 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                {{-- Avatar simple --}}
                                <div class="w-9 h-9 rounded-full bg-indigo-500/20 text-indigo-300 flex items-center justify-center font-semibold">
                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                </div>

                                <div>
                                    <p class="text-sm font-medium">
                                        {{ $member->name }}
                                    </p>
                                    <p class="text-xs text-slate-400">
                                        {{ $member->email }}
                                    </p>
                                </div>
                            </div>

                            {{-- Rôle --}}
                          
                            <span class="text-xs px-2 py-1 rounded-lg border
                                {{ $member->pivot->role === 'owner'
                                    ? 'border-emerald-400/30 text-emerald-300 bg-emerald-500/10'
                                    : 'border-slate-600 text-slate-300 bg-slate-800/60'
                                }}">
                                {{ $member->pivot->role === 'owner' ? 'Admin' : 'Membre' }}
                            </span>
                        </li>
                        @if($isAdmin && $member->id !== $me->id)
                            <form method="POST"
                                action="{{ route('circles.members.remove', [$circle, $member]) }}"
                                onsubmit="return confirm('Retirer ce membre du cercle ?')">
                                @csrf
                                @method('DELETE')

                                <button class="text-xs px-3 py-1 rounded-lg
                                            border border-red-500/30 text-red-300
                                            hover:bg-red-500/10 transition">
                                    Retirer
                                </button>
                            </form>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>

    </div>
</div>
@endsection
