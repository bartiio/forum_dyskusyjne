<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HiddenPostController extends Controller
{
    public function hide(User $user)
    {
        // Użytkownik nie może ukrywać swoich własnych postów
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Nie możesz ukryć własnych postów.');
        }

        // Dodaj ukrycie
        auth()->user()->hiddenUsers()->attach($user);

        return back()->with('success', 'Posty użytkownika zostały ukryte.');
    }

    public function unhide(User $user)
    {
        // Usuń ukrycie
        auth()->user()->hiddenUsers()->detach($user);

        return back()->with('success', 'Posty użytkownika zostały odkryte.');
    }
}
