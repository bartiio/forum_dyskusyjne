<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista użytkowników</title>
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

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
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
        .button {
        display: inline-block;
        margin: 10px auto;
        padding: 10px 20px;
        font-size: 1em;
        text-align: center;
        text-decoration: none;
        color: white;
        background-color: #007bff;
        border-radius: 5px;
        transition: background-color 0.3s, transform 0.2s ease-in-out;
        cursor: pointer;
        font-weight: bold;
    }

    .button:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .button:active {
        background-color: #004085;
        transform: scale(0.95);
    }

        button.ban {
            background-color: #dc3545;
        }

        button:hover {
            background-color: #0056b3;
        }

        button.ban:hover {
            background-color: #c82333;
        }

        /* Powiadomienia */
        .alert {
            width: 100%;
            max-width: 800px;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 1em;
        }

        .alert.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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

        .high-contrast button.ban {
            background-color: #ff0000;
            color: #fff;
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
            background-color: #333;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <h1>Lista użytkowników</h1>

    @if (session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert error">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tabela użytkowników -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nick</th>
                <th>Data dołączenia</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->nick }}</td>
                    <td>{{ $user->joined_at }}</td>
                    <td>
                        @if (!$user->administrator)
                            <form action="{{ route('admin.users.makeAdmin', $user) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit">Mianuj na administratora</button>
                            </form>
                        @endif
                        <form action="{{ route('admin.users.ban', $user) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="ban">Zbanuj</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.dashboard') }}" class="button">Powrót do panelu administratora</a>


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
