<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesResume extends Model
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
        'updated_at_resume',
        'season_id',
        'media_type',
    ];

    protected $casts = [
        'updated_at_resume' => 'datetime',
    ];
}
