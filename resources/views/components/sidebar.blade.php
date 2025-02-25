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
                    class="flex items-center py-2 px-4 rounded-lg text-black border-black  hover:bg-gray-400 transition-all border-2 mb-5 group {{ Route::currentRouteName() === 'home.page' ? 'translate-y-1.5 shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] bg-gray-400' : 'hover:translate-y-1.5 shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)]' }}">
                    <i class="fa-solid fa-house"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Home</span>
                </a>
            </li>

            <li>
                <a href="{{ route('mytasks.page') }}"
                    class="flex items-center py-2 px-4 rounded-lg text-black border-black hover:bg-gray-400 transition-all border-2 mb-5 group {{ Route::currentRouteName() === 'mytasks.page' ? 'translate-y-1.5 shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] bg-gray-400' : 'shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)]' }}">
                    <i class="fa-solid fa-list-check"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">My Tasks</span>
                    <span {{-- jika ada tugas maka tampilkan indikator bulat --}}
                        class="{{ $taskCount == 0 ? 'hidden' : 'inline-flex' }}  items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-white bg-black rounded-full ">{{ $taskCount }}</span>
                </a>
            </li>

            <li>
                <a href="{{ route('history.page') }}"
                    class="flex items-center py-2 px-4 rounded-lg text-black border-black  hover:bg-gray-400 transition-all border-2 mb-5 group {{ Route::currentRouteName() === 'history.page' ? 'translate-y-1.5 shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] bg-gray-400' : 'shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)]' }}">
                    <i class="fa-regular fa-clock"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">History</span>
                    {{-- <span
                        class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-white bg-black rounded-full ">Pro</span> --}}
                </a>
            </li>

            <li>
                <button id="logout-btn"
                    class="flex w-full text-left items-center py-2 px-4 rounded-lg text-black border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] hover:bg-gray-400 transition-all border-2 group">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap font-MadeforText">Log out</span>
                </button>

                <form id="logout-form" class="hidden" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </li>


        </ul>
    </div>
</aside>
