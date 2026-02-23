<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vars.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.tailwindcss.com/3.2.0"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'main': '#197adc',
                        'grey': '#595555',
                        'add': '#1c1e20',
                    },
                    fontFamily: {
                        'rubik': ['Rubik', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        button, input, select, textarea {
            border: none;
            background: none;
            font: inherit;
        }
        menu, ol, ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Rubik', sans-serif;
        }
    </style>
    <title>Лавка желаний и предсказаний</title>
    @stack('styles')
</head>
<body>
    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
