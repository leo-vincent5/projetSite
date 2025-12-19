<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;

    public function codeCalling()
    {
        // Si le lien est fait via le champ 'numero', utilise cette relation
        return $this->hasOne(CodeCalling::class, 'numero', 'numero');
    }
}
