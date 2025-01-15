<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Główna</title>
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
            max-width: 600px;
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
            font-size: 2.5em;
            margin-top: 0;
        }

        p {
            font-size: 1.2em;
            margin: 15px 0;
        }

        a {
            display: inline-block;
            margin: 20px;
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s ease-in-out;
        }

        a:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        /* Stylizacja dla wysoka kontrast */
        .high-contrast {
            background-color: #000;
            color: #fff;
        }

        .high-contrast a {
            background-color: #f4f4f9;
            color: #000;
        }

        .high-contrast .content-box {
            background-color: #222;
            color: #fff;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.2);
        }

        /* Przycisk przełączania trybu wysokiego kontrastu */
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

        /* Styl dla małych ekranów (mobile) */
        @media (max-width: 768px) {
            h1 {
                font-size: 2em;
            }

            p {
                font-size: 1em;
            }

            a {
                font-size: 16px;
                padding: 12px 25px;
            }

            .content-box {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Wyspa -->
    <div class="content-box">
        <h1>Witaj na naszym forum!</h1>
        <p>Wybierz jedną z opcji poniżej:</p>
        <a href="{{ route('login.form') }}">Logowanie</a>
        <a href="{{ route('registration.form') }}">Rejestracja</a>
    </div>

    <!-- Przycisk przełączania trybu wysokiego kontrastu -->
    <button class="contrast-toggle" onclick="toggleContrast()">
        <i class="fas fa-adjust"></i>
    </button>

    <script>
        // Funkcja przełączania trybu wysokiego kontrastu
        function toggleContrast() {
            document.body.classList.toggle('high-contrast');
        }
    </script>
</body>
</html>
