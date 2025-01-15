<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wybór Administratora</title>
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
            height: 100vh;
        }

        /* Wyspa */
        .content-box {
            background-color: white;
            width: 90%;
            max-width: 400px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .content-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1em;
            margin-bottom: 20px;
        }

        a {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            font-size: 1em;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a.green {
            background-color: #28a745;
        }

        a:hover {
            background-color: #0056b3;
        }

        a.green:hover {
            background-color: #218838;
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
            background-color: #fff;
            color: #000;
        }

        .high-contrast a.green {
            background-color: #00ff00;
            color: #000;
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
        <h1>Witaj, {{ auth()->user()->nick }}!</h1>
        <p>Jesteś zalogowany jako administrator. Wybierz, co chcesz zrobić:</p>

        <a href="{{ route('admin.dashboard') }}">Przejdź do panelu administratora</a>
        <a href="{{ route('forum') }}" class="green">Przejdź do forum</a>
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
