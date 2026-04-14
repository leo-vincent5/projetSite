<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

      protected $fillable = [
        'title',
        'name',
        'start_date',
        'end_date',
        'status',
        'guests_count',
        'description',
        'practical_info',
        'reminder_note',
    ];
}
