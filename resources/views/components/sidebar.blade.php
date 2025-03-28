<aside id="default-sidebar"
    class="sm:relative fixed top-0 left-0 z-40 w-60 h-screen transition-transform -translate-x-full sm:translate-x-0 border-r-2 border-black bg-black"
    aria-label="Sidebar">
    <div class="h-full px-4 py-4 overflow-y-auto  bg-white">
        <ul class="space-y-2 font-medium font-MadeforText h-full flex flex-col justify-between">
            <div>
                <li>
                    <a href="{{ route('home.page') }}"
                        class="flex items-center p-2 rounded-full text-black border-black shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:translate-x-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] hover:bg-gray-300 transition-all border-2 mb-10 text-center w-full group">
                        <p class="text-center w-full font-black font-MadeforDisplay text-2xl">Rentjana</p>
                    </a>
                </li>
                {{-- <li>
                <a href="{{ route('home.page') }}"
                    class="flex items-center py-2 px-4 rounded-lg text-black border-black  hover:bg-gray-400 transition-all border-2 mb-5 group {{ Route::currentRouteName() === 'home.page' ? 'translate-y-1.5 shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] bg-gray-400' : 'hover:translate-y-1.5 shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)]' }}">
                    <i class="fa-solid fa-house"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Home</span>
                </a>
            </li> --}}

                <li>
                    <a href="{{ route('home.page') }}"
                        class="flex items-center py-2 px-4 rounded-xl text-black border-black transition-all border-2 mb-5 group bg-[#FBD51B] {{ Route::currentRouteName() === 'home.page' ? 'translate-y-[3px] shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] bg-[#e1c019]' : 'hover:translate-y-[3px] shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)]' }}">
                        <i class="fa-solid fa-house"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Home</span>
                    </a>
                </li>

                {{-- <li>
                <a href="{{ route('mytasks.page') }}"
                    class="flex items-center py-2 px-4 rounded-lg text-black border-black hover:bg-gray-400 transition-all border-2 mb-5 group {{ Route::currentRouteName() === 'mytasks.page' ? 'translate-y-1.5 shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] bg-gray-400' : 'shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)]' }}">
                    <i class="fa-solid fa-list-check"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">My Tasks</span>
                    <span 
                        class="{{ $taskCount == 0 ? 'hidden' : 'inline-flex' }}  items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-white bg-black rounded-full ">{{ $taskCount }}</span>
                </a>
            </li> --}}

                <li>
                    <a href="{{ route('mytasks.page') }}"
                        class="flex items-center py-2 px-4 rounded-xl text-black border-black transition-all border-2 mb-5 group bg-[#FBD51B] {{ Route::currentRouteName() === 'mytasks.page' ? 'translate-y-[3px] shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] bg-[#e1c019]' : 'hover:translate-y-[3px] shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)]' }}">
                        <i class="fa-solid fa-list-check"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">My Tasks</span>
                        <span {{-- jika ada tugas maka tampilkan indikator bulat --}}
                            class="{{ $taskCount == 0 ? 'hidden' : 'inline-flex' }}  items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-white bg-black rounded-full ">{{ $taskCount }}</span>
                    </a>
                </li>

                {{-- <li>
                <a href="{{ route('history.page') }}"
                    class="flex items-center py-2 px-4 rounded-lg text-black border-black  hover:bg-gray-400 transition-all border-2 mb-5 group {{ Route::currentRouteName() === 'history.page' ? 'translate-y-1.5 shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] bg-gray-400' : 'shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)]' }}">
                    <i class="fa-regular fa-clock"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">History</span>
                </a>
            </li> --}}

                <li>
                    <a href="{{ route('history.page') }}"
                        class="flex items-center py-2 px-4 rounded-xl text-black border-black transition-all border-2 mb-5 group bg-[#FBD51B] {{ Route::currentRouteName() === 'history.page' ? 'translate-y-[3px] shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] bg-[#e1c019]' : 'hover:translate-y-[3px] shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)]' }}">
                        <i class="fa-regular fa-clock"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">History</span>
                    </a>
                </li>

                {{-- <li>
                <button id="logout-btn"
                    class="flex w-full text-left items-center py-2 px-4 rounded-lg text-black border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] hover:bg-gray-400 transition-all border-2 group">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap font-MadeforText">Log out</span>
                </button>

                <form id="logout-form" class="hidden" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </li> --}}

            </div>
            <div>
                <li>
                    <div
                        class="py-2 px-4 rounded-lg text-black border-black transition-all border-2 mb-5 mx-1 shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] bg-[#F0F0F0]">
                        <div class="rounded-full md:me-0 my-4">
                            <img class="w-25 h-20 m-auto border-black border-2 rounded-full"
                                src="{{ asset('img/Profile-img-b.png') }}" alt="user photo">
                        </div>
                        <p>User</p>
                        <p>email@example.com</p>
                        <button id="logout-btn"
                            class="flex w-full items-center py-2 justify-center rounded-xl text-white border-black transition-all border-2 my-3 bg-red-500 hover:translate-y-[3px]  shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)]">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span class="ms-3">Logout</span>
                        </button>

                        <form id="logout-form" class="hidden" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </div>
                </li>
            </div>
        </ul>

    </div>
</aside>
