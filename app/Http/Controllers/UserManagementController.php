<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all(); // Pobierz wszystkich użytkowników
        return view('admin.users', compact('users'));
    }

    // Mianowanie użytkownika na administratora
    public function makeAdmin(User $user)
    {
        if (!$user->administrator) {
            $user->administrator()->create(['role' => 'admin']);
        }
        return redirect()->route('admin.users')->with('success', 'Użytkownik został mianowany administratorem.');
    }

    // Banowanie użytkownika (usuwanie)
    public function banUser(User $user)
{
    if ($user->nick === 'admin') {
        return redirect()->route('admin.users')->with('error', 'Nie możesz zbanować konta admin.');
    }

    $user->delete(); // Usuwa użytkownika i powiązane dane
    return redirect()->route('admin.users')->with('success', 'Użytkownik został zbanowany.');
}
}
