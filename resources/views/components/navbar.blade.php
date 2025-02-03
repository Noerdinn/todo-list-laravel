@php
    $pageTitles = [
        'home.page' => 'Home',
        'mytasks.page' => 'My Tasks',
        'mydays.page' => 'Recent',
    ];

    $currentRoute = Route::currentRouteName();
    // cocokan halaman, jika tidak cocok maka tampilkan Todo list
    $pageTitle = $pageTitles[$currentRoute] ?? 'Todo list';
@endphp

<nav class="bg-transparent">
    <div class="max-w-full flex flex-wrap justify-between mx-auto p-4 border-b-2 border-black">
        {{-- <a href="{{ route('home.page') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <p class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</p>
        </a> --}}
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 border-black border-2"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="{{ asset('img/Mina Myoi.jpg') }}" alt="user photo">
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white border-2 border-black shadow-[0px_8px_0px_0px_rgba(0,0,0,1)] divide-y divide-black rounded-lg "
                id="user-dropdown">
                <div class="px-4 py-3">
                    <span class="block text-sm text-black font-medium">{{ $user->name }}</span>
                    <span class="block text-sm  text-black truncate ">{{ $user->email }}</span>
                </div>
                <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-black hover:bg-black hover:text-white">Settings</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-black hover:bg-black hover:text-white">Sign
                            out</a>
                    </li>
                </ul>
            </div>
            <button data-collapse-toggle="navbar-user" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-user" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div>
            <h1 class="font-medium text-2xl">{{ $pageTitle }}</h1>

        </div>

    </div>
</nav>
