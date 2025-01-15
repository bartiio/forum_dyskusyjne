<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzaj postami i wątkami</title>
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

        table {
            width: 100%;
            max-width: 800px;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f4f4f4;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        button.delete {
            background-color: #dc3545;
        }

        button:hover {
            background-color: #0056b3;
        }

        button.delete:hover {
            background-color: #c82333;
        }

        /* Link */
        .back-link {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back-link:hover {
            background-color: #218838;
        }

        /* Tryb wysokiego kontrastu */
        .high-contrast {
            background-color: #000;
            color: #fff;
        }

        .high-contrast table {
            background-color: #222;
            color: #fff;
        }

        .high-contrast th {
            background-color: #000;
        }

        .high-contrast button {
            background-color: #fff;
            color: #000;
        }

        .high-contrast button.delete {
            background-color: #ff0000;
            color: #fff;
        }

        .high-contrast .back-link {
            background-color: lime;
            color: black;
        }
        .high-contrast tr:nth-child(even) {
            background-color: #333;
        }

        .high-contrast tr:hover {
            background-color: #444;
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
    <h1>Zarządzaj postami i wątkami</h1>

    <h2>Posty</h2>
    <table>
        <thead>
            <tr>
                <th>Autor</th>
                <th>Treść</th>
                <th>Wątek</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->user->nick }}</td>
                    <td>{{ $post->content }}</td>
                    <td>
                        <a href="{{ route('forum.threads.show', $post->thread) }}">{{ $post->thread->title }}</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.posts.delete', $post) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete">Usuń</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Wątki</h2>
    <table>
        <thead>
            <tr>
                <th>Tytuł</th>
                <th>Moderator</th>
                <th>Status</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($threads as $thread)
                <tr>
                    <td>{{ $thread->title }}</td>
                    <td>{{ $thread->moderator->nick }}</td>
                    <td>
                        @if (!$thread->is_closed)
                            Otwarty
                        @else
                            Zamknięty
                        @endif
                    </td>
                    <td>
                        @if (!$thread->is_closed)
                            <form action="{{ route('admin.threads.close', $thread) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit">Zamknij</button>
                            </form>
                        @else
                            <form action="{{ route('admin.threads.delete', $thread) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete">Usuń</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.dashboard') }}" class="back-link">Powrót do panelu głównego</a>

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
