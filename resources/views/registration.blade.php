<div>
    <!-- Simplicity is an acquired taste. - Katharine Gerould -->
</div>
<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
</head>

<body class="h-full font-MadeforDisplay">
    <div class="grid grid-rows-1 grid-cols-3 gap-4 min-h-full max-h-screen justify-center px-6 py-12 lg:px-8">
        <div class="flex items-center border-2 border-black px-6 rounded-lg shadow-[0px_8px_0px_0px_rgba(0,0,0,1)]">
            <div class="container">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <h2 class="text-center text-4xl font-bold tracking-tight text-gray-900">Registration</h2>
                </div>

                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form class="space-y-3" action="{{ route('registration.submit') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block text-lg font-medium text-black">Name</label>
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                            <div class="mt-2">
                                <input type="name" name="name" id="name" autocomplete="name" required
                                    class="w-full rounded-md border-2 border-black bg-white px-3 py-1.5 text-base text-black outline-none">
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-lg font-medium text-black">Email
                                address</label>
                            @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                            <div class="mt-2">
                                <input type="email" name="email" id="email" autocomplete="email" required
                                    class="w-full rounded-md border-2 border-black bg-white px-3 py-1.5 text-base text-black outline-none">
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-lg font-medium text-black">Password</label>
                            </div>
                            @error('password')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                            <div class="mt-2">
                                <input type="password" name="password" id="password" autocomplete="current-password"
                                    required
                                    class="w-full rounded-md border-2 border-black bg-white px-3 py-1.5 text-base text-black outline-none">
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full font-medium font-MadeforDisplay text-xl items-center p-2 rounded-lg text-black border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] transition-all border-2 text-center mt-6">Register</button>
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
        <div class="col-span-2 justify-center flex">
            <img src="{{ asset('img/Gambar 2.jpg') }}" alt="" class="h-full">
        </div>
    </div>
</body>

</html>
