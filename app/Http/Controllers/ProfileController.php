<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isOwner = true;
        return view('profile.index', compact('user', 'isOwner'));
    }

    public function show($nick)
    {
        // Znajdź użytkownika po nicku
        $user = User::where('nick', $nick)->firstOrFail();

        // Sprawdź, czy to własny profil
        $isOwner = Auth::check() && Auth::id() === $user->id;

        return view('profile.index', compact('user', 'isOwner'));
    }

    public function update(Request $request)
{
    $request->validate([
        'description' => 'nullable|string|max:1000',
        'profile_picture_url' => 'nullable|url',
    ]);

    $user = Auth::user();

    // Aktualizacja opisu
    if ($request->filled('description')) {
        $user->description = $request->input('description');
    }

    // Aktualizacja zdjęcia profilowego (URL)
    if ($request->filled('profile_picture_url')) {
        $user->profile_picture_url = $request->input('profile_picture_url');
    }

    $user->save();

    return redirect()->route('profile')->with('success', 'Profil został zaktualizowany.');
    
}
}
