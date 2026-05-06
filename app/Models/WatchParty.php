<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchParty extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'host_user_id',
        'media_id',
        'media_type',
        'season_id',
        'episode_id',
        'title',
        'source_url',
        'is_playing',
        'current_time',
        'last_synced_at',
        'scheduled_play_at',
    ];

    protected $casts = [
        'is_playing' => 'boolean',
        'current_time' => 'float',
        'last_synced_at' => 'datetime',
        'scheduled_play_at' => 'datetime',
    ];
}