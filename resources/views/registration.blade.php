<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
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

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            text-align: left;
            color: inherit; /* Zapewnia widoczność tekstu */
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Błędy */
        .errors {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            text-align: left;
        }

        /* Stylizacja dla wysoka kontrast */
        .high-contrast {
            background-color: #000;
            color: #fff;
        }

        .high-contrast input,
        .high-contrast button {
            background-color: #333;
            color: #fff;
            border: 1px solid #fff; /* Biała ramka dla kontrastu */
        }

        .high-contrast label,
        .high-contrast h1 {
            color: #fff; /* Widoczny tekst w trybie wysokiego kontrastu */
        }

        .high-contrast .errors {
            background-color: #721c24;
            color: #fff;
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

        /* High contrast mode styles */
        .high-contrast {
            background-color: #000;
            color: #fff;
        }

        .high-contrast label {
            color: black;
        }

        .high-contrast h1 {
            color: black;
        }

        .high-contrast input {
            background-color: #333;
            color: #fff;
            border: 1px solid #fff;
        }

        .high-contrast button {
            background-color: #333;
            color: #fff;
            border: 1px solid #fff;
        }
    </style>
</head>
<body>
    <!-- Wyspa -->
    <div class="content-box">
        <h1>Rejestracja</h1>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('registration.submit') }}" method="POST">
            @csrf
            <div>
                <label for="nick">Nick:</label>
                <input type="text" name="nick" id="nick" value="{{ old('nick') }}" required>
            </div>
            <div>
                <label for="password">Hasło:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Zarejestruj się</button>
        </form>
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
