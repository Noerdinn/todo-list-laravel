<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    {{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="h-screen font-MadeforDisplay">

    <div class="h-full grid grid-cols-5 gap-8 md:grid-rows-1 grid-rows-2 md:items-center px-8 ">

        <div class="md:col-span-2 col-span-full self-end md:self-center">
            <h1
                class="md:text-6xl text-4xl font-medium tracking-tight text-balance text-black md:text-left text-center">
                Simple,
                Straight
                Forward, and Powerfull</h1>
            <p class="md:mt-8 mt-4 md:text-xl text-base font-medium text-pretty text-black md:text-left text-center">
                Write it
                down,
                organize,
                and complete your tasks
                hassle-free. Make your day more structured!</p>
            <div class="md:mt-10 mt-8 md:justify-start justify-center flex items-center  gap-x-6">
                <a href="home"
                    class="rounded-lg p-2 px-10 text-black border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] transition-all border-2 font-medium capitalize">Get
                    Started</a>
            </div>
        </div>

        <div class="md:col-span-3 col-span-full flex md:justify-end justify-center ">
            <div
                class="hidden md:block md:w-[90%] w-full rounded-lg overflow-hidden border-2 border-black shadow-[0px_8px_0px_0px_rgba(0,0,0,1)]">
                <img src="{{ asset('img/tampilan.jpg') }}" alt="Tampilan" class="w-full h-auto object-cover">
            </div>
            <div
                class="block md:hidden w-full h-fit rounded-lg overflow-hidden border-2 border-black shadow-[0px_8px_0px_0px_rgba(0,0,0,1)]">
                <img src="{{ asset('img/Mobile Asset 2.jpg') }}" alt="Tampilan" class="w-full h-auto object-cover">
            </div>
        </div>
    </div>

</body>

</html>
