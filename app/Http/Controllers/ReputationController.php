<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Reputation;
class ReputationController extends Controller
{
    public function vote(Request $request, Post $post)
    {
        // Upewnij się, że użytkownik nie głosuje na swój własny post
        if ($post->user_id === auth()->id()) {
            return back()->with('error', 'Nie możesz głosować na własny post.');
        }

        // Sprawdź, czy użytkownik już głosował
        $existingVote = Reputation::where('post_id', $post->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingVote) {
            return back()->with('error', 'Już głosowałeś na ten post.');
        }

        // Zapisz głos
        Reputation::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'value' => $request->input('value'), // +1 lub -1
        ]);

        return back()->with('success', 'Głos został zapisany.');
    }
}
