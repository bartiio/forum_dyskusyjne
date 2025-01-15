<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'moderator_id', 'is_closed'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function moderator()
    {
        return $this->belongsTo(User::class, 'moderator_id');
    }

    protected static function boot()
{
    parent::boot();

    static::deleting(function ($thread) {
        $thread->posts()->delete(); // Usuń powiązane posty
    });
}
}