<?php

namespace App\Http\Controllers;

use App\Models\WatchParty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WatchPartyController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'media_id' => ['required', 'integer'],
            'media_type' => ['required', 'in:movie,series'],
            'season_id' => ['nullable', 'integer'],
            'episode_id' => ['nullable', 'integer'],
            'title' => ['nullable', 'string', 'max:255'],
            'source_url' => ['required', 'string'],
        ]);

        $party = WatchParty::create([
            'token' => Str::random(12),
            'host_user_id' => auth()->id(),

            'media_id' => $data['media_id'],
            'media_type' => $data['media_type'],
            'season_id' => $data['season_id'] ?? null,
            'episode_id' => $data['episode_id'] ?? null,

            'title' => $data['title'] ?? null,
            'source_url' => $data['source_url'],

            'is_playing' => false,
            'current_time' => 0,

            'last_synced_at' => now()->timestamp,
            'scheduled_play_at' => null,
        ]);

        return response()->json([
            'success' => true,
            'url' => route('watch-party.show', $party->token),
            'token' => $party->token,
        ]);
    }

    public function show(string $token)
    {
        $party = WatchParty::where('token', $token)->firstOrFail();

        return view('watch-party.show', compact('party'));
    }

    public function sync(Request $request, string $token)
    {
        $party = WatchParty::where('token', $token)->firstOrFail();

        $data = $request->validate([
            'is_playing' => ['required', 'boolean'],
            'current_time' => ['required', 'numeric', 'min:0'],
            'scheduled_play_at' => ['nullable', 'numeric'],
            'clear_schedule' => ['nullable', 'boolean'],
        ]);

        $party->is_playing = (bool) $data['is_playing'];
        $party->current_time = (float) $data['current_time'];
        $party->last_synced_at = now()->timestamp;

        if ($request->boolean('clear_schedule')) {
            $party->scheduled_play_at = null;
        } elseif ($request->has('scheduled_play_at')) {
            $party->scheduled_play_at = (int) $data['scheduled_play_at'];
        }

        $party->save();

        return response()->json([
            'success' => true,

            'media_id' => $party->media_id,
            'media_type' => $party->media_type,
            'season_id' => $party->season_id,
            'episode_id' => $party->episode_id,
            'title' => $party->title,
            'source_url' => $party->source_url,

            'is_playing' => (bool) $party->is_playing,
            'current_time' => (float) $party->current_time,

            'scheduled_play_at' => $party->scheduled_play_at,
            'last_synced_at' => $party->last_synced_at,
            'server_time' => now()->timestamp,
        ]);
    }

    public function state(string $token)
    {
        $party = WatchParty::where('token', $token)->firstOrFail();

        return response()->json([
            'media_id' => $party->media_id,
            'media_type' => $party->media_type,
            'season_id' => $party->season_id,
            'episode_id' => $party->episode_id,
            'title' => $party->title,
            'source_url' => $party->source_url,

            'is_playing' => (bool) $party->is_playing,
            'current_time' => (float) $party->current_time,

            'scheduled_play_at' => $party->scheduled_play_at,
            'last_synced_at' => $party->last_synced_at,
            'server_time' => now()->timestamp,
        ]);
    }
}