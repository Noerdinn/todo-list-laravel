@php
    $pageTitles = [
        'home.page' => 'Home',
        'mytasks.page' => 'My Tasks',
        'history.page' => 'History',
    ];

    $currentRoute = Route::currentRouteName();
    // cocokan halaman, jika tidak cocok maka tampilkan Todo list
    $pageTitle = $pageTitles[$currentRoute] ?? 'Todo list';
@endphp

<nav class="bg-transparent">
    <div class="max-w-full flex flex-wrap justify-between mx-auto md:p-4 px-4 py-2 border-b-2 border-black">
        {{-- <a href="{{ route('home.page') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <p class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</p>
        </a> --}}
        <div class="flex items-center order-last space-x-3 md:space-x-0 rtl:space-x-reverse">
            <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 border-black border-2"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="{{ asset('img/Profile-img-b.png') }}" alt="user photo">
            </button>
            <!-- Dropdown menu -->
            <div class="z-40 hidden my-4 text-base list-none bg-white border-2 border-black shadow-[0px_8px_0px_0px_rgba(0,0,0,1)] divide-y divide-black rounded-lg "
                id="user-dropdown">
                <div class="px-4 py-3">
                    <span class="block text-sm text-black font-medium">{{ $user->name }}</span>
                    <span class="block text-sm  text-black truncate ">{{ $user->email }}</span>
                </div>
                <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                        {{-- <button id="logout-btn"
                            class="block w-full text-left px-4 py-2 text-sm text-black hover:bg-black hover:text-white">
                            Sign out
                        </button>
                        <form id="logout-form" class="hidden" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form> --}}
                    </li>
                </ul>
            </div>

        </div>
        <div class="order-1 flex self-center">
            <h1 class="font-medium md:text-2xl text-lg">{{ $pageTitle }}</h1>
        </div>
        <div class="block md:hidden ">
            <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
                aria-controls="default-sidebar" type="button"
                class="inline-flex items-center p-2  text-sm text-black rounded-lg sm:hidden hover:bg-black hover:text-white">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                    </path>
                </svg>
            </button>
        </div>

    </div>
</nav>
