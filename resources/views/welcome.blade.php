<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
</head>

<body class="h-screen font-MadeforDisplay">

    <div class="h-full flex items-center justify-between px-8 ">

        <div class="w-1/2">
            <h1 class="text-6xl font-medium tracking-tight text-balance text-black">Simple, Straight
                Forward, and Powerfull</h1>
            <p class="mt-8 text-xl font-medium text-pretty text-black">Lorem ipsum dolor sit, amet
                consectetur adipisicing elit. Est vitae qui, necessitatibus atque exercitationem alias?</p>
            <div class="mt-10 flex items-center gap-x-6">
                <a href="home"
                    class="rounded-lg p-2 px-10 text-black border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] transition-all border-2 font-medium">Get
                    started</a>
            </div>
        </div>

        <div class="w-1/2 flex justify-center">
            <div class="w-3/4 rounded-lg overflow-hidden border-2 border-black shadow-[0px_8px_0px_0px_rgba(0,0,0,1)]">
                <img src="{{ asset('img/tampilan.jpg') }}" alt="Tampilan" class="w-full h-auto object-cover">
            </div>
        </div>
    </div>

</body>

</html>
