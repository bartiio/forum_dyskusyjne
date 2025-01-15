<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'nick',
        'profile_picture_url',
        'description',
        'joined_at',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function administrator()
    {
        return $this->hasOne(Administrator::class);
    }

    public function posts()
{
    return $this->hasMany(Post::class);
}

public function reputation()
    {
        return $this->hasManyThrough(Reputation::class, Post::class, 'user_id', 'post_id', 'id', 'id')
            ->sum('value');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    // Użytkownicy, którzy obserwują tego użytkownika
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }
    // Użytkownicy, których posty są ukrywane przez tego użytkownika
    public function hiddenUsers()
    {
        return $this->belongsToMany(User::class, 'hidden_posts', 'user_id', 'hidden_user_id');
    }

    // Użytkownicy, którzy ukrywają posty tego użytkownika
    public function hiddenBy()
    {
        return $this->belongsToMany(User::class, 'hidden_posts', 'hidden_user_id', 'user_id');
    }
}
