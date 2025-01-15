<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktualności</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
            color: #333;
        }

        h1, h2 {
            text-align: center;
        }

        .news-section {
            margin-bottom: 30px;
        }

        .post-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 15px 0;
            padding: 20px;
            transition: transform 0.3s;
        }

        .post-card:hover {
            transform: translateY(-5px);
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Aktualności</h1>

    <!-- Posty obserwowanych użytkowników -->
    <div class="news-section">
        <h2>Posty obserwowanych użytkowników</h2>
        @if ($followedPosts->isEmpty())
            <p>Brak nowych postów od obserwowanych użytkowników.</p>
        @else
            @foreach ($followedPosts as $post)
                <div class="post-card">
                    <p><strong>{{ $post->user->nick }}</strong>: {{ $post->content }}</p>
                    <p>Wątek: <a href="{{ route('forum.threads.show', $post->thread) }}">{{ $post->thread->title }}</a></p>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Informacje o polubieniach -->
    <div class="news-section">
        <h2>Informacje o polubieniach</h2>
        @if ($likedPosts->isEmpty())
            <p>Brak nowych polubień Twoich postów.</p>
        @else
            @foreach ($likedPosts as $reputation)
                <div class="post-card">
                    <p>
                        Użytkownik <strong>{{ $reputation->user->nick }}</strong> polubił Twój post!
                    </p>
                </div>
            @endforeach
        @endif
    </div>

    <a href="{{ route('forum') }}" style="display: inline-block; margin: 20px 0; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Powrót do forum</a>
</body>
</html>
