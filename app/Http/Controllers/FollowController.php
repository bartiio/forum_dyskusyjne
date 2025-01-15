<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        // Sprawdź, czy użytkownik próbuje obserwować samego siebie
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Nie możesz obserwować samego siebie.');
        }

        // Dodaj obserwację
        auth()->user()->followings()->attach($user);

        return back()->with('success', 'Teraz obserwujesz użytkownika.');
    }

    public function unfollow(User $user)
    {
        // Usuń obserwację
        auth()->user()->followings()->detach($user);

        return back()->with('success', 'Przestałeś obserwować użytkownika.');
    }
}
