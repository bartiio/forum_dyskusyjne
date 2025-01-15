<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil {{ $user->nick }}</title>
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
            align-items: center;
            min-height: 100vh;
        }

        /* Wyspa */
        .content-box {
            background-color: white;
            width: 90%;
            max-width: 600px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
            margin: 20px;
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

        p {
            font-size: 1em;
            margin: 10px 0;
        }

        img {
            border-radius: 50%;
            margin-top: 10px;
        }

        a, button {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 20px;
            font-size: 1em;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        a:hover, button:hover {
            background-color: #0056b3;
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

        .high-contrast a, .high-contrast button {
            background-color: #fff;
            color: #000;
        }

        .hidden {
            display: none;
        }

        textarea, input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea:focus, input[type="text"]:focus {
            outline: none;
            border-color: #007bff;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="content-box">
        <h1>Profil: {{ $user->nick }}</h1>

        @if (session('success'))
            <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
        @endif

        <!-- Informacje o profilu -->
        <p><strong>Opis:</strong> {{ $user->description ?? 'Brak opisu.' }}</p>
        <p><strong>Reputacja:</strong> {{ $user->reputation() }}</p>

        <div>
            <strong>Zdjęcie profilowe:</strong><br>
            @if ($user->profile_picture_url)
                <img src="{{ $user->profile_picture_url }}" alt="Zdjęcie profilowe" width="100">
            @else
                <p>Brak zdjęcia profilowego.</p>
            @endif
        </div>

        <!-- Przyciski -->
        @if (isset($isOwner) && $isOwner)
            <button id="edit-profile-btn">Edytuj profil</button>
        @endif

        <a href="{{ route('forum') }}">Powrót do forum</a>

        @if (auth()->id() !== $user->id)
            @if (auth()->user()->followings->contains($user))
                <form action="{{ route('users.unfollow', $user) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Przestań obserwować</button>
                </form>
            @else
                <form action="{{ route('users.follow', $user) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Obserwuj</button>
                </form>
            @endif

            @if (auth()->user()->hiddenUsers->contains($user))
                <form action="{{ route('users.unhide', $user) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Odkryj posty</button>
                </form>
            @else
                <form action="{{ route('users.hide', $user) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Ukryj posty</button>
                </form>
            @endif
        @endif

        <!-- Sekcja edycji profilu -->
        @if (isset($isOwner) && $isOwner)
            <div id="edit-profile-form" class="hidden">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <label for="description">Opis:</label>
                    <textarea name="description" id="description" rows="4">{{ $user->description }}</textarea>
                    <label for="profile_picture_url">URL zdjęcia profilowego:</label>
                    <input type="text" name="profile_picture_url" id="profile_picture_url" value="{{ $user->profile_picture_url }}">
                    <button type="submit">Zapisz zmiany</button>
                    <button type="button" id="cancel-edit-btn">Anuluj</button>
                </form>
            </div>
        @endif

        <!-- Posty użytkownika -->
        <h2>Posty użytkownika:</h2>
        <ul>
            @foreach ($user->posts as $post)
                <li>
                    {{ $post->content }}
                    <small>(Wątek: <a href="{{ route('forum.threads.show', $post->thread) }}">{{ $post->thread->title }}</a>)</small>
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editProfileBtn = document.getElementById('edit-profile-btn');
            const cancelEditBtn = document.getElementById('cancel-edit-btn');
            const editProfileForm = document.getElementById('edit-profile-form');

            if (editProfileBtn) {
                editProfileBtn.addEventListener('click', function () {
                    editProfileForm.classList.remove('hidden');
                });
            }

            if (cancelEditBtn) {
                cancelEditBtn.addEventListener('click', function () {
                    editProfileForm.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>
