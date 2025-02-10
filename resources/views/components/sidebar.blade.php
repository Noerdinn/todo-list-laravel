<aside id="default-sidebar"
    class="top-0 left-0 z-40 w-60 h-screen transition-transform -translate-x-full sm:translate-x-0 border-r-2 border-black"
    aria-label="Sidebar">
    <div class="h-full px-4 py-4 overflow-y-auto bg-white ">
        <ul class="space-y-2 font-medium font-MadeforText">
            <li>
                <a href="{{ route('home.page') }}" class="flex items-center btn-neo mb-10 text-center w-full group">
                    <p class="text-center w-full font-black font-MadeforDisplay text-2xl">Rentjana</p>
                </a>
            </li>
            <li>
                <a href="{{ route('home.page') }}"
                    class="flex items-center py-2 px-4 rounded-lg text-black border-black  hover:bg-gray-300 transition-all border-2 mb-5 group {{ Route::currentRouteName() === 'home.page' ? 'translate-y-1.5 shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] bg-gray-300' : 'hover:translate-y-1.5 shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)]' }}">
                    <i class="fa-solid fa-house"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Home</span>
                </a>
            </li>

            <li>
                <a href="{{ route('mytasks.page') }}"
                    class="flex items-center py-2 px-4 rounded-lg text-black border-black hover:bg-gray-300 transition-all border-2 mb-5 group {{ Route::currentRouteName() === 'mytasks.page' ? 'translate-y-1.5 shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] bg-gray-300' : 'shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)]' }}">
                    <i class="fa-solid fa-list-check"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">My Tasks</span>
                    <span {{-- jika ada tugas maka tampilkan notifikasi --}}
                        class="{{ $taskCount == 0 ? 'hidden' : 'inline-flex' }}  items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-white bg-black rounded-full ">{{ $taskCount }}</span>
                </a>
            </li>

            <li>
                <a href="{{ route('history.page') }}"
                    class="flex items-center py-2 px-4 rounded-lg text-black border-black  hover:bg-gray-300 transition-all border-2 mb-5 group {{ Route::currentRouteName() === 'mydays.page' ? 'translate-y-1.5 shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] bg-gray-300' : 'shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)]' }}">
                    <i class="fa-regular fa-clock"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">History</span>
                    {{-- <span
                        class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-white bg-black rounded-full ">Pro</span> --}}
                </a>
            </li>

            <li>
                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                    class="flex w-full text-left items-center py-2 px-4 rounded-lg text-black border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] hover:bg-gray-300 transition-all border-2 group">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap font-MadeforText">Logout</span>
                </button>
            </li>


        </ul>
    </div>
</aside>


{{-- modal logout --}}
<div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full font-MadeforText">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg border-2 border-black shadow-[0px_8px_0px_0px_rgba(0,0,0,1)]">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-xl font-medium text-black">Are you sure you
                    want to logout</h3>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" type="button"
                        class=" py-2 px-4 rounded-lg border-2 font-medium text-black border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] hover:bg-gray-300 transition-all text-center">
                        Yes, I'm sure
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
