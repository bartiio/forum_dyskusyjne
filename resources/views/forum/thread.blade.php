<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $thread->title }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Globalne style */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 20px;
        }

        /* Wyspa */
        .content-box {
            background-color: white;
            width: 90%;
            max-width: 800px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .content-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        h1, h2 {
            font-size: 1.8em;
            margin-bottom: 15px;
            text-align: center;
        }

        p, li {
            font-size: 1em;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: #007bff;
            cursor: pointer;
            position: relative;
        }

        a:hover {
            color: #0056b3;
        }

        /* Styl dla dymków */
        a:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: #333;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
            white-space: nowrap;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 999;
        }

        .post-item {
            padding: 15px 0;
            border-bottom: 1px solid #ccc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .post-item:last-child {
            border-bottom: none;
        }

        .post-content {
            flex: 1;
            margin-right: 15px;
        }

        .vote-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .vote-buttons button {
            background: none;
            border: none;
            font-size: 1.2em;
            color: inherit;
            cursor: pointer;
            transition: color 0.3s;
        }

        .vote-buttons button:hover {
            color: #007bff;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        textarea:focus {
            outline: none;
            border-color: #007bff;
        }

        .hidden {
            display: none;
        }

        /* Tryb wysokiego kontrastu */
        .high-contrast {
            background-color: #000;
            color: #fff;
        }

        .high-contrast .content-box {
            background-color: #222;
            color: #fff;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.2);
        }

        .high-contrast a {
            color: #fff;
        }

        /* Przycisk zmiany kontrastu */
        .contrast-toggle {
            position: fixed;
            bottom: 20px;
            left: 20px;
            padding: 10px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            z-index: 9999;
            transition: background-color 0.3s, transform 0.2s ease-in-out;
        }

        .contrast-toggle:hover {
            background-color: #555;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
<div class="content-box">
    <h1>{{ $thread->title }}</h1>
    <p>Wątek stworzony przez: {{ $thread->moderator->nick }}</p>
    <a href="{{ route('forum') }}" style="display: inline-block; margin: 20px 0; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Powrót do forum</a>

    <!-- Wyświetlanie postów -->
    @foreach($posts as $post)
        @if (!auth()->user()->hiddenUsers->contains($post->user))
            <div class="post-item">
                <div class="post-content">
                    <a href="{{ route('users.profile', $post->user->nick) }}" data-tooltip="Profil użytkownika">
                        {{ $post->user->nick }}
                    </a>: 
                    {{ $post->content }}
                </div>

                <div class="vote-buttons">
                    <form action="{{ route('posts.vote', $post) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="value" value="1">
                        <button type="submit" style="color: green;">&#x25B2;</button>
                    </form>
                    <form action="{{ route('posts.vote', $post) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="value" value="-1">
                        <button type="submit" style="color: red;">&#x25BC;</button>
                    </form>
                    <span>
                        <strong style="color: {{ $post->reputations->sum('value') > 0 ? 'green' : ($post->reputations->sum('value') < 0 ? 'red' : 'gray') }};">
                            {{ $post->reputations->sum('value') }}
                        </strong>
                    </span>
                </div>
            </div>

            <!-- Komentarze -->
            <ul>
                @foreach($post->comments as $comment)
                    <li>
                        <a href="{{ route('users.profile', $comment->user->nick) }}" data-tooltip="Profil użytkownika">
                            {{ $comment->user->nick }}
                        </a>: 
                        {{ $comment->content }}
                    </li>
                @endforeach
            </ul>

            <!-- Formularz dodawania komentarza -->
            <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                @csrf
                <textarea name="content" placeholder="Dodaj komentarz" rows="2" required></textarea>
                <button type="submit">Skomentuj</button>
            </form>
        @endif
    @endforeach

    <!-- Formularz dodawania nowego posta -->
    @if (!$thread->is_closed)
        <div class="add-post">
            <h2>Dodaj post:</h2>
            <form action="{{ route('forum.posts.create', $thread) }}" method="POST">
                @csrf
                <textarea name="content" placeholder="Treść posta" rows="4" required></textarea>
                <button type="submit">Dodaj</button>
            </form>
        </div>
    @else
        <p style="color: red;">Ten wątek jest zamknięty. Nie można dodawać nowych postów.</p>
    @endif
    </div>
    <!-- Przycisk zmiany kontrastu -->
    <button class="contrast-toggle" onclick="toggleContrast()">
        <i class="fas fa-adjust"></i>
    </button>

    <script>
        // Funkcja zmiany trybu wysokiego kontrastu
        function toggleContrast() {
            document.body.classList.toggle('high-contrast');
        }
    </script>
</body>
</html>
