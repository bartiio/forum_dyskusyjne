<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Post;

class ForumController extends Controller
{
    public function index()
    {
        $threads = Thread::with('posts')->get();
        return view('forum.index', compact('threads'));
    }

    public function showThread(Thread $thread)
    {
        $posts = $thread->posts()->with('user')->get();
        return view('forum.thread', compact('thread', 'posts'));
    }

    public function createThread(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);

        Thread::create([
            'title' => $request->input('title'),
            'moderator_id' => auth()->id(),
        ]);

        return redirect()->route('forum')->with('success', 'Wątek został utworzony.');
    }

    public function createPost(Request $request, Thread $thread)
    {
        // Sprawdź, czy wątek jest zamknięty
        if ($thread->is_closed) {
            return redirect()->route('forum.threads.show', $thread)->with('error', 'Nie można dodać postu do zamkniętego wątku.');
        }
    
        $request->validate([
            'content' => 'required|string',
        ]);
    
        $thread->posts()->create([
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
        ]);
    
        return redirect()->route('forum.threads.show', $thread)->with('success', 'Post został dodany.');
    }

    public function closeThread(Thread $thread)
    {
        // Sprawdzenie, czy aktualny użytkownik jest moderatorem wątku
        if (auth()->id() !== $thread->moderator_id) {
            return redirect()->route('forum.threads.show', $thread)->with('error', 'Nie masz uprawnień do zamknięcia tego wątku.');
        }

        // Zamknięcie wątku
        $thread->update(['is_closed' => true]);

        return redirect()->route('forum.threads.show', $thread)->with('success', 'Wątek został zamknięty.');
    }
}

