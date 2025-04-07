<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')

    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <link rel="manifest" href="/img/site.webmanifest">

    <title>@yield('title', 'Todolist')</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body class="h-[100dvh]">

    {{-- loading screen --}}
    <div id="loading-screen"
        class="loading-neo fixed h-full inset-0 z-50 items-center justify-center bg-black/25 backdrop-blur-sm transition-opacity opacity-100">
        <div class="flex h-full items-center justify-center gap-2 md:gap-3">

            <div
                class="md:w-20 md:h-20 w-14 h-14 bg-white border-2 border-black rounded-lg shadow-[0_4px_0_0_rgba(0,0,0,1)] animate-bounce delay-[100ms]">
                <p class="flex h-full items-center justify-center font-MadeforDisplay font-black md:text-5xl text-3xl">N
                </p>
            </div>
            <div
                class="md:w-20 md:h-20 w-14 h-14 bg-white border-2 border-black rounded-lg shadow-[0_4px_0_0_rgba(0,0,0,1)] animate-bounce delay-[150ms]">
                <p class="flex h-full items-center justify-center font-MadeforDisplay font-black md:text-5xl text-3xl">E
                </p>
            </div>
            <div
                class="md:w-20 md:h-20 w-14 h-14 bg-white border-2 border-black rounded-lg shadow-[0_4px_0_0_rgba(0,0,0,1)] animate-bounce delay-[200ms]">
                <p class="flex h-full items-center justify-center font-MadeforDisplay font-black md:text-5xl text-3xl">O
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-rows-[auto_1fr] grid-cols-[auto_1fr] h-full">
        <div class="row-start-1 row-end-2  col-end-3 col-start-1 lg:col-start-2">
            <x-navbar></x-navbar>
        </div>
        <div class="row-start-1 row-end-3 col-start-1 col-end-2">
            <x-sidebar :user="Auth::user()"></x-sidebar>
        </div>
        <div class="row-start-2 row-end-3  col-end-3 col-span-8 md:col-start-1 lg:col-start-2 h-full">
            @yield('content')
        </div>
    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    @vite('resources/js/app.js')
</body>
@if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            showAlert('success', "{{ session('success') }}");
        });
    </script>
@endif

</html>
