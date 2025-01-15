<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Post;


class AdminController extends Controller
{
    public function choice()
    {
        return view('admin.choice');
    }
public function deletePost(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts_threads')->with('success', 'Post został usunięty.');
    }

    public function closeThread(Thread $thread)
    {
        // Sprawdzenie, czy aktualny użytkownik jest moderatorem wątku
        

        // Zamknięcie wątku
        $thread->update(['is_closed' => true]);

        return redirect()->route('admin.posts_threads')->with('success', 'Wątek został zamkniety.');
    }


    public function deleteThread(Thread $thread)
    {
        $thread->delete();

        return redirect()->route('admin.posts_threads')->with('success', 'Wątek został usunięty.');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function managePostsAndThreads()
{
    $threads = Thread::with('moderator')->get();
    $posts = Post::with('user', 'thread')->get();

    
    return view('admin.manage_posts_threads', compact('threads', 'posts'));
    
}
}
