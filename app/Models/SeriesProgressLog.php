<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesProgressLog extends Model
{
    use HasFactory;

       protected $fillable = [
        'user_id',
        'series_id',
        'series_title',
        'episode_id',
        'episode_title',
        'current_time',
        'duration',
        'progress_percent',
        'poster',
        'event_type',
        'watched_at',
        'season_id',
        'media_type',
    ];

    protected $casts = [
        'watched_at' => 'datetime',
    ];
}
