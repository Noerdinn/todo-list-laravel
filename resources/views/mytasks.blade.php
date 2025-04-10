@extends('layout.app')
@section('title', 'My Tasks')
@section('content')

    <div
        class=" p-6 h-full scrollbar-thin scrollbar-thumb-black  scrollbar-track-transparent scrollbar-thumb-rounded-full container-pattern">
        <div
            class="grid md:grid-rows-[auto_1fr] grid-rows-[min-content_1fr] grid-cols-2 md:gap-4 gap-4 font-MadeforText h-full">
            <div class="row-start-1 h-min">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-4">
                        <!-- Modal toggle -->
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                            class="block p-2 rounded-lg border-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[3px] hover:shadow-none transition-all border-2 font-medium md:text-base text-sm w-full text-white hover:bg-[#3A66B1] bg-[#3085d6]"
                            type="button">
                            Create Task
                        </button>
                    </div>
                    {{-- <div class="md:col-span-8">
                        <x-searchbar></x-searchbar>
                    </div> --}}
                </div>
                <!-- Main modal untuk create task -->
                <x-modal-create></x-modal-create>
            </div>


            <div {{-- konten task --}}
                class="row-start-2 min-h-[60vh] max-h-[calc(100vh-185px)] md:col-span-1 col-span-full overflow-y-auto scrollbar-thin scrollbar-thumb-black scrollbar-track-transparent scrollbar-thumb-rounded-full p-5 border-2 rounded-lg border-black shadow-[0px_6px_0px_0px_rgba(0,0,0,1)] me-0 mb-0 md:me-2 md:mb-2 bg-white flex flex-col ">
                <div class="flex mb-3">
                    <p class="md:text-xl text-lg font-medium">Task</p>
                </div>

                <div class="flex-1 ">
                    @forelse ($tasks as $task)
                        {{-- tekan pada task untuk memunculkan detail --}}
                        <div data-task-id="{{ $task->id }}" onclick="showDetailTask({{ $task->id }})"
                            class="task-item flex
                                justify-between py-2 px-3 md:px-4 mb-3 md:mb-4 border-2 rounded-lg border-black transition-all ease-out 
                                shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] overflow-x-hidden hover:shadow-none hover:translate-y-[3px] hover:bg-[#e1e3e5] cursor-pointer">
                            <div class="flex justify-between items-center w-full">

                                {{-- update is_complete selesai atau tidak selesai menggunakan ajax --}}

                                {{-- <button onclick="toggleTaskStatus({{ $task->id }})" class=" flex items-center">
                                    <i
                                        class="toggle-task-status md:text-xl text-sm {{ $task->is_complete ? 'fa-regular fa-circle-check' : 'fa-regular fa-circle' }}"></i>
                                </button> --}}

                                <div class="flex">
                                    {{-- icon status --}}
                                    <div class="flex items-center">
                                        <i
                                            class="toggle-task-status md:text-xl text-sm {{ $task->is_complete ? 'fa-regular fa-circle-check' : 'fa-regular fa-circle' }}"></i>
                                    </div>

                                    {{-- title task --}}
                                    <div class="flex ">
                                        <p class="title-task mx-2 md:mx-3 md:text-base text-sm self-center font-medium duration-1000 capitalize transition-transform   {{ $task->is_complete ? 'line-through' : '' }}"
                                            data-task-id="{{ $task->id }}">
                                            {{ $task->title }}</p>
                                    </div>

                                    {{-- icon clock reminder --}}
                                    {{-- jika deadline hari ini/besok dan belum selesai --}}
                                    <div
                                        class="flex reminder-icon items-center {{ $reminderTask->contains('id', $task->id) && !$task->is_complete ? '' : 'hidden' }}">

                                        <i class="fa-solid fa-stopwatch animate-wiggle text-[#E53123] md:text-xl text-sm"
                                            title="Deadline dalam 1 hari"></i>
                                    </div>
                                </div>
                                <div>
                                    {{-- indikator prioritas --}}
                                    <div class="flex items-center">
                                        @if ($task->priority === 'high')
                                            <span
                                                class="py-1 px-2 md:text-xs text-xs rounded-[4px] border-2 border-black bg-[#E53123] text-white">High</span>
                                        @elseif ($task->priority === 'medium')
                                            <span
                                                class="py-1 px-2 md:text-xs text-xs rounded-[4px] border-2 border-black bg-[#efce31]">Medium</span>
                                        @elseif ($task->priority === 'low')
                                            <span
                                                class="py-1 px-2 md:text-xs text-xs rounded-[4px] border-2 border-black text-white bg-[#3C6CCE]">Low</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- empty state --}}
                        <div class="flex-1 font-MadeforDisplay flex flex-col items-center h-full justify-center">
                            <div
                                class="md:h-32 md:w-32 h-20 w-20  bg-white border-2 border-black rounded-lg shadow-[0_4px_0_0_rgba(0,0,0,1)] flex items-center justify-center mb-10">
                                <p class="text-7xl md:text-9xl font-bold">+</p>
                            </div>
                            <p class="text-xl md:text-2xl font-bold mb-2">Task Masih Kosong</p>
                            <div class="flex items-center">
                                <p class="text-sm md:text-lg font-medium text-black/55 text-center text-pretty">Untuk
                                    menambah task
                                    baru
                                    tekan tombol Create Task diatas.
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            {{-- untuk menyimpan id dari task yang di tekan (detail task) --}}
            <input id="current-task-id" type="hidden" class="text-black hidden" value=""></input>
            {{-- detail dari task yang di tekan --}}
            <div id="task-detail-container"
                class="md:row-start-2 row-start-3 min-h-[60vh] max-h-[calc(100vh-185px)] md:col-span-1 col-span-full overflow-y-auto scrollbar-thin scrollbar-thumb-black scrollbar-track-transparent scrollbar-thumb-rounded-full border-2 rounded-lg border-black shadow-[0px_6px_0px_0px_rgba(0,0,0,1)] me-0 mb-0 md:me-2 md:mb-2 flex bg-white flex-col justify-between">
                {{-- detail.blade akan ditampilkan disini --}}

            </div>
        </div>
    </div>



@endsection
