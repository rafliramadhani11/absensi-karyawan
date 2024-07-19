<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <title>
        {{ $title ?? 'Default Title' }} - Laravel App
    </title>
</head>

<body class="bg-gray-200 antialiased px-10 md:px-40 lg:px-0 lg:container lg:mx-auto">


    <main class="flex min-h-screen flex-col justify-center items-center px-6 py-12 lg:px-8">
        {{ $slot }}
    </main>

</body>

</html>
