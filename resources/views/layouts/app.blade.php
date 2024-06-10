@props(['user'])

<!doctype html>
<html class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>

<body class="h-full">
    <div class="min-h-full">

        {{ $navbar }}

        @if (isset($head))
            <header class="bg-white shadow">
                <div class="mx-auto max-w-7xl px-5 py-4 sm:px-6 lg:px-8 ">
                    {{ $head }}
                </div>
            </header>
        @endif

        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 ">
                {{ $slot }}
            </div>
        </main>

    </div>

    @vite('resources/js/app.js')
</body>

</html>
