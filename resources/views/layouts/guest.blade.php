<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>

<body class="bg-gray-200 antialiased px-10 md:px-40 lg:px-0 lg:container lg:mx-auto">


    <main class="flex min-h-screen flex-col justify-center items-center px-6 py-12 lg:px-8">
        {{ $slot }}
    </main>

    @vite('resources/js/app.js')
</body>

</html>
