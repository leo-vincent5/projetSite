<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeCalling extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'numero'];
}
