<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Management System</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="relative min-h-screen bg-gray-100 sm:flex sm:justify-center sm:items-center">
        {{-- @if (Route::has('login'))
            <div class="p-6 text-right sm:fixed sm:top-0 sm:right-0">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="font-semibold text-gray-600 hover:text-blue-500 dark:text-gray-400 dark:hover:text-white ">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-blue-500 dark:text-gray-400 dark:hover:text-white ">Log
                        in</a>

                        <!--Check route existance-->
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-blue-500 dark:text-gray-400 dark:hover:text-white">Register</a>
                    @endif
                @endauth
            </div>
        @endif --}}

        <div class="p-6 text-center">
            <h1 class="mb-8 text-4xl font-bold text-gray-900">Laravel <br> Task Management System</h1>

            @auth
                {{-- <a href="{{ route('dashboard') }}"
                    class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                    Go to Dassssssssssshboard
                </a> --}}
            @else
                <div class="flex justify-center mx-auto space-x-4">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        Login
                    </a>
                    <div class="pr-4 pl-4 pt-2">or</div>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</body>

</html>
