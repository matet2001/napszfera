<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Napszfera</title>

    <style>
        /* Inline styles for the email */
        body {
            background-color: #2D033B; /* Background color */
            color: #E5B8F4; /* Text color */
            font-family: 'Roboto Mono', monospace; /* Font family */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            flex-grow: 1;
            margin: 0 auto;
            padding: 2rem 1.5rem; /* Equivalent of px-6 py-8 */
        }

        .parent {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
<div class="container parent">
    {{ $slot }}
</div>
</body>
</html>
