<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'thread_id', 'user_id'];

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reputations()
{
    return $this->hasMany(Reputation::class);
}


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
