<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Comment extends Model
{
    protected $fillable = [
        'circle_id','user_id','book_id','time_sec','track_title','body','is_spoiler'
    ];
    public function circle() { return $this->belongsTo(Circle::class); }
    public function user()   { return $this->belongsTo(User::class); }
}
