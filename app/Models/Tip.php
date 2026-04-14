<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;


class Tip extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'category_label',
        'user_id',
        'author',
        'address',
        'lat',
        'lng',
        'rating',
        'image',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'lat' => 'decimal:7',
        'lng' => 'decimal:7',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getCategoryLabelAttribute($value): string
    {
        if (!empty($value)) {
            return $value;
        }

        return match ($this->category) {
            'food' => 'Gastronomie',
            'nature' => 'Nature',
            'culture' => 'Culture',
            'practical' => 'Pratique',
            default => 'Autre',
        };
    }

    public function getCategoryColorAttribute(): string
    {
        return match ($this->category) {
            'food' => 'bg-amber-100 text-amber-800',
            'nature' => 'bg-emerald-100 text-emerald-700',
            'culture' => 'bg-blue-100 text-blue-700',
            'practical' => 'bg-stone-200 text-stone-700',
            default => 'bg-stone-200 text-stone-700',
        };
    }

    public function getIconAttribute(): string
    {
        return match ($this->category) {
            'food' => '🥐',
            'nature' => '🌿',
            'culture' => '🏛️',
            'practical' => '🧭',
            default => '📍',
        };
    }

    public function getAuthorNameAttribute(): string
    {
        if ($this->user && !empty($this->user->name)) {
            return $this->user->name;
        }

        if (!empty($this->author)) {
            return $this->author;
        }

        return 'Famille';
    }

    public function getAuthorInitialAttribute(): string
    {
        return mb_strtoupper(mb_substr($this->author_name, 0, 1));
    }

  
    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (Str::startsWith($this->image, 'storage/')) {
            return asset($this->image);
        }

        return asset('storage/' . ltrim($this->image, '/'));
    }
    
}