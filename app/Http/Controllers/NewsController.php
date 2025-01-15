<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Reputation;

class NewsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Pobierz posty obserwowanych użytkowników
        $followedPosts = Post::whereIn('user_id', $user->followings->pluck('id'))
                             ->with('thread')
                             ->latest()
                             ->get();

        // Pobierz informacje o polubieniach postów użytkownika
        $likedPosts = Reputation::where('value', 1)
                                ->whereHas('post', function ($query) use ($user) {
                                    $query->where('user_id', $user->id);
                                })
                                ->with(['post', 'post.thread', 'user'])
                                ->latest()
                                ->get();

        return view('news.index', compact('followedPosts', 'likedPosts'));
    }
}
