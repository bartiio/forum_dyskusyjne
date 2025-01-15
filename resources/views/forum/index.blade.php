<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
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
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        h1, h2 {
            font-size: 2em;
            margin-bottom: 20px;
            text-align: center;
        }

        a {
            text-decoration: none;
            color: #007bff;
            margin: 10px;
            padding: 10px 20px;
            border: 1px solid #007bff;
            border-radius: 5px;
            background-color: white;
            transition: background-color 0.3s, color 0.3s;
        }

        a:hover {
            background-color: #007bff;
            color: white;
        }

        .threads-container {
            width: 100%;
            max-width: 800px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        .thread-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .thread-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .thread-info {
            display: flex;
            flex-direction: column;
        }

        .thread-info span {
            font-size: 0.9em;
            color: gray;
        }

        .thread-info .closed {
            color: red;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            max-width: 600px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Tryb wysokiego kontrastu */
        .high-contrast {
            background-color: #000;
            color: #fff;
        }

        .high-contrast .thread-card {
            background-color: #222;
            color: #fff;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.2);
        }

        .high-contrast a {
            color: white;
            background-color: black;
            border: 1px solid white;
        }

        .high-contrast button {
            background-color: white;
            color: black;
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
    <h1>Forum</h1>

    <!-- Lista wątków -->
    <div class="threads-container">
        @foreach ($threads as $thread)
            <div class="thread-card">
                <div class="thread-info">
                    <a href="{{ route('forum.threads.show', $thread) }}">{{ $thread->title }}</a>
                    @if ($thread->is_closed)
                        <span class="closed">(Zamknięty)</span>
                    @endif
                    <span>Postów: {{ $thread->posts->count() }}</span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Formularz dodawania wątku -->
    <h2>Dodaj wątek:</h2>
    <form action="{{ route('forum.threads.create') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Tytuł wątku">
        <button type="submit">Utwórz</button>
    </form>

    <!-- Linki nawigacyjne -->
    <a href="{{ route('news') }}" >Aktualności</a>
    <a href="{{ route('profile') }}">Mój profil</a>
    <a href="{{ route('logout') }}">Wyloguj się</a>

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
