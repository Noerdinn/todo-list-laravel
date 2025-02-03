        <div class="items-center  w-full h-full" id="navbar-user">
            <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search" aria-expanded="false"
                class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
            <div class="relative hidden md:block h-full">
                <div class="absolute inset-y-0 start-0 h-full  flex items-center ps-4 pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    {{-- <span class="sr-only">Search icon</span> --}}
                </div>
                <input type="text" id="search-navbar"
                    class="block w-full h-full p-2 ps-10 text-base  border-2 rounded-lg bg-white border-black placeholder-black font-medium  text-black outline-none shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] focus:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] focus:translate-y-1.5 transition-all"
                    placeholder="Search...">
            </div>
        </div>
