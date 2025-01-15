<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // Walidacja danych
        $request->validate([
            'thread_id' => 'required|exists:threads,id',
            'content' => 'required|string|max:1000',
        ]);

        // Zapisanie nowego posta
        Post::create([
            'user_id' => auth()->id(),
            'thread_id' => $request->input('thread_id'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('forum')->with('success', 'Post został opublikowany.');
    }
}
