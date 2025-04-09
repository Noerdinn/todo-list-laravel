<div>
    <!-- Simplicity is an acquired taste. - Katharine Gerould -->
</div>
<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="h-full font-MadeforDisplay">
    <x-bounce-time></x-bounce-time>

    <div class="grid grid-rows-1 grid-cols-3 gap-4 min-h-full max-h-screen justify-center px-6 py-12 lg:px-8">
        <div
            class="flex md:col-span-1 col-span-full md:h-full h-fit py-10 md:py-0 self-center items-center lg:border-2 border-0 border-black px-6 md:px-10 2xl:px-0 rounded-lg lg:shadow-[0px_6px_0px_0px_rgba(0,0,0,1)] shadow-none">
            <div class="container">
                <div class="w-full">
                    <img class="h-14 2xl:h-20 mx-auto mb-4" src="{{ asset('img/Neo List icon.png') }}" alt="">
                </div>

                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <h2 class="text-center text-3xl lg:text-2xl 2xl:text-4xl font-bold tracking-tight text-black mb-2">
                        Registration
                    </h2>
                    <p class="text-center lg:text-sm 2xl:text-lg">Buat akun dan kelola semua tugasmu dengan lebih
                        mudah.</p>
                </div>

                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form class="space-y-4" action="{{ route('registration.submit') }}" method="POST">
                        @csrf
                        <div>
                            {{-- <label for="name" class="block text-lg font-medium text-black">Name</label> --}}
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            <div class="mt-2">
                                <input type="name" name="name" id="name" autocomplete="name" required
                                    class="w-full rounded-md border-2 border-black bg-white px-3 py-1.5 text-base text-black outline-none shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] focus:shadow-none focus:translate-y-[3px] transition-all ease-out placeholder:text-black/60"
                                    placeholder="Name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div>
                            {{-- <label for="email" class="block text-lg font-medium text-black">Email
                                address</label> --}}
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            <div class="mt-2">
                                <input type="email" name="email" id="email" autocomplete="email" required
                                    class="w-full rounded-md border-2 border-black bg-white px-3 py-1.5 text-base text-black outline-none shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] focus:shadow-none focus:translate-y-[3px] transition-all ease-out placeholder:text-black/60"
                                    placeholder="Email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div>
                            {{-- <div class="flex items-center justify-between">
                                <label for="password" class="block text-lg font-medium text-black">Password</label>
                            </div> --}}
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            <div class="mt-2">
                                <input type="password" name="password" id="password" autocomplete="current-password"
                                    required
                                    class="w-full rounded-md border-2 border-black bg-white px-3 py-1.5 text-base text-black outline-none shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] focus:shadow-none focus:translate-y-[3px] transition-all ease-out placeholder:text-black/60"
                                    placeholder="Password" value="{{ old('password') }}">
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full font-medium font-MadeforDisplay text-xl items-center p-2 rounded-lg text-black border-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[3px] hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] transition-all border-2 text-center mt-6 bg-[#efce31]">Register</button>
                        </div>
                    </form>

                    <p class="mt-6 text-center text-sm text-black">
                        Already have account?
                        <a href="/login" class="font-semibold text-black hover:underline">Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-span-2 h-full hidden md:block">
            <div class="justify-center flex h-full">
                <img src="{{ asset('img/Gambar 2.jpg') }}" alt="">
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
</body>

</html>
