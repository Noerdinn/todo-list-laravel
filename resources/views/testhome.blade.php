<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="h-screen">
    <div class="grid grid-rows-[auto_1fr] grid-cols-[auto_1fr] h-full">
        <div class="row-start-1 row-end-2 col-start-2 col-end-3">
            <x-navbar></x-navbar>
        </div>
        <div class="row-start-1 row-end-3 col-start-1 col-end-2 ">
            <x-sidebar></x-sidebar>
        </div>
        <div class="row-start-2 row-end-3 col-start-2 col-end-3 col-span-8  overflow-y-scroll">
            <x-main-content></x-main-content>
        </div>
    </div>

</body>

</html>
