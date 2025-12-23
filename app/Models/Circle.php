<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Circle extends Model
{
    protected $fillable = [
        'name',
        'owner_id',
        'invite_token',
    ];

    /**
     * Membres du cercle
     * Table pivot : circle_members
     * Champs pivot : role
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'circle_members', // 👈 NOM CORRECT
            'circle_id',
            'user_id'
        )
        ->withPivot('role')
        ->withTimestamps();
    }

    /**
     * Propriétaire du cercle
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
