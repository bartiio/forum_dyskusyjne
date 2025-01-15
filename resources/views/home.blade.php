<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
</head>
<body>
    <h1>Strona główna</h1>

    <!-- Sekcja z postami obserwowanych -->
    <h2>Posty od obserwowanych użytkowników</h2>
    <ul>
        @foreach ($followedPosts as $post)
            <li>
                <strong>{{ $post->user->nick }}</strong>: {{ $post->content }}
                <br>
                <a href="{{ route('forum.threads.show', $post->thread) }}">Przejdź do wątku</a>
            </li>
        @endforeach
    </ul>

    <!-- Sekcja z komentarzami -->
    <h2>Nowe komentarze do twoich postów</h2>
    <ul>
        @foreach ($recentComments as $comment)
            <li>
                <strong>{{ $comment->user->nick }}</strong> skomentował Twój post:
                "{{ $comment->content }}"
                <br>
                <a href="{{ route('forum.threads.show', $comment->post->thread) }}">Przejdź do wątku</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
