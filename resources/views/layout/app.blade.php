<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')

    <title>@yield('title', 'Todolist')</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    {{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" /> --}}
</head>

<body class="h-screen">

    <div class="grid grid-rows-[auto_1fr] grid-cols-[auto_1fr] h-full">
        <div class="row-start-1 row-end-2  col-end-3 col-start-1 lg:col-start-2">
            <x-navbar></x-navbar>
        </div>
        <div class="row-start-1 row-end-3 col-start-1 col-end-2">
            <x-sidebar></x-sidebar>
        </div>
        <div class="row-start-2 row-end-3  col-end-3 col-span-8 md:col-start-1 lg:col-start-2 overflow-y-auto">
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
