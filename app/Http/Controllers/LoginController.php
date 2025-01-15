<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Wyświetlanie formularza logowania
    public function showForm()
    {
        return view('login');
    }

    // Obsługa logowania
    public function login(Request $request)
    {
        // Walidacja danych
        $request->validate([
            'nick' => 'required',
            'password' => 'required',
        ]);

        // Znajdź użytkownika na podstawie nicku
        $user = User::where('nick', $request->input('nick'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return back()->withErrors(['login' => 'Nieprawidłowy nick lub hasło']);
        }

        // Logowanie użytkownika
        auth()->login($user);

        // Jeśli użytkownik jest administratorem, przekieruj na widok pośredni
        if ($user->administrator) {
            return redirect()->route('admin.choice');
        }

        // Dla zwykłych użytkowników przekierowanie na forum
        return redirect()->route('forum')->with('success', 'Zalogowano pomyślnie.');
    }
}
