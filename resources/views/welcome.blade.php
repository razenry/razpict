<!DOCTYPE html>
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

<body class="">
    <div class="navbar bg-base-100 shadow-sm">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl">Razpict</a>
        </div>
        <div class="flex gap-2">
            <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto" />
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS Navbar component"
                            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                    </div>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                    <li>
                        <a class="justify-between">
                            Profile
                            <span class="badge">New</span>
                        </a>
                    </li>
                    <li><a>Settings</a></li>
                    <li><a>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    {{-- {{ $slot }} --}}
    @livewireScripts
</body>

</html>
