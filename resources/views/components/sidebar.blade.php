@props(['user'])
<aside id="default-sidebar"
    class="sm:relative fixed top-0 left-0 z-40 w-60 h-dvh transition-transform duration-500 ease-out -translate-x-full sm:translate-x-0 border-r-2 border-black"
    aria-label="Sidebar">
    <div class="h-full px-4 py-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium font-MadeforText h-full flex flex-col justify-between">
            <div>
                <li>
                    <a href="{{ route('home.page') }}"
                        class="flex items-center p-2 rounded-full text-black border-black shadow-[0px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[4px] hover:shadow-none hover:bg-[#EAE9E5] transition-all ease-out border-2 mb-10 text-center w-full group">
                        <img src="{{ asset('img/Neo List Typo.png') }}" alt="" class="flex px-3">
                    </a>
                </li>

                <li>
                    <a href="{{ route('home.page') }}"
                        class="flex items-center py-2 px-4 rounded-lg text-black border-black transition-all border-2 mb-5 group ease-out {{ Route::currentRouteName() === 'home.page' ? 'translate-y-[3px] shadow-none bg-[#C0A142]' : 'hover:translate-y-[3px] bg-[#E9C452] hover:bg-[#C0A142] shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-none' }}">
                        <i class="fa-solid fa-house"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Home</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('mytasks.page') }}"
                        class="flex items-center py-2 px-4 rounded-lg text-black border-black transition-all border-2 mb-5 group ease-out {{ Route::currentRouteName() === 'mytasks.page' ? 'translate-y-[3px] shadow-none bg-[#C0A142]' : 'hover:translate-y-[3px] bg-[#E9C452] hover:bg-[#C0A142] shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-none' }}">
                        {{-- <i class="fa-solid fa-list-check"></i> --}}
                        <i class="fa-solid fa-rectangle-list"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">My Tasks</span>
                        {{-- jika ada tugas maka tampilkan indikator bulat --}}
                        {{-- logika ada di service provider --}}
                        <span
                            class="{{ $taskCount == 0 ? 'hidden' : 'inline-flex' }}  items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-white bg-black rounded-full ">{{ $taskCount }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('history.page') }}"
                        class="flex items-center py-2 px-4 rounded-lg text-black border-black transition-all border-2 mb-5 group ease-out {{ Route::currentRouteName() === 'history.page' ? 'translate-y-[3px] shadow-none bg-[#C0A142]' : 'hover:translate-y-[3px] bg-[#E9C452] hover:bg-[#C0A142] shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-none' }}">
                        {{-- <i class="fa-regular fa-clock"></i> --}}
                        <i class="fa-solid fa-clock"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">History</span>
                    </a>
                </li>

            </div>
            <div>
                <li>
                    <div
                        class="py-2 px-4 rounded-lg text-black border-black transition-all border-2 mb-5 mx-1 shadow-[0px_4px_0px_0px_rgba(0,0,0,1)] bg-[#EAE9E5]">
                        <div class="rounded-full md:me-0 my-4">
                            <img class="w-25 h-20 m-auto border-black border-2 rounded-full"
                                src="{{ asset('img/Profile-img-b.png') }}" alt="user photo">
                        </div>
                        <p class="text-sm capitalize truncate" title="{{ $user->name }}">
                            {{ $user->name }}</p>
                        <p class="text-sm lowercase truncate" title="{{ $user->email }}">{{ $user->email }}</p>
                        <button id="logout-btn"
                            class="flex w-full items-center py-2 justify-center rounded-lg text-white border-black transition-all border-2 my-3 bg-[#E85446] hover:bg-[#cf4a3e] hover:translate-y-[3px] shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)]">
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
