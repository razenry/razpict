<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $tile ?? ' Razpict' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>

        </style>
    @endif
    @livewireStyles
</head>

<body class="dark:bg-gray-800">

    <livewire:home.layout.navbar/>

    <div class="pt-16">
        {{ $slot }}
    </div>
    
    <livewire:home.layout.footer/>
    @livewireScripts
</body>

</html>
