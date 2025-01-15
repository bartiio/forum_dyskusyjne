<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    // Wyświetlanie formularza rejestracji
    public function showForm()
    {
        return view('registration');
    }

    // Obsługa danych z formularza rejestracji
    public function register(Request $request)
    {
        // Walidacja danych
        $request->validate([
            'nick' => 'required|unique:users|max:255',
            'password' => 'required|min:6',
        ]);

        // Utworzenie użytkownika
        User::create([
            'nick' => $request->input('nick'),
            'password' => Hash::make($request->input('password')),
            'profile_picture_url' => null, // Puste domyślne wartości
            'description' => null,
            'joined_at' => now(),
        ]);

        return redirect('/')->with('success', 'Rejestracja zakończona sukcesem!');
    }
}

