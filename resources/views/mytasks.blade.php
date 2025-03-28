@extends('layout.app')
@section('title', 'My Tasks')
@section('content')

    <div
        class=" p-6 h-full overflow-y-auto scrollbar-thin scrollbar-thumb-black  scrollbar-track-transparent scrollbar-thumb-rounded-full container-pattern">
        <div
            class="grid md:grid-rows-[auto_1fr] grid-rows-[min-content_1fr] grid-cols-2 md:gap-4 gap-6 font-MadeforText h-full">
            <div class="row-start-1 h-min">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-4">
                        <!-- Modal toggle -->
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                            class="block p-2 rounded-xl border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] transition-all border-2 font-medium md:text-base text-sm w-full text-black bg-[#8BB696]"
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
                class="row-start-2 min-h-[60vh] md:col-span-1 col-span-full overflow-y-auto scrollbar-thin scrollbar-thumb-black scrollbar-track-transparent scrollbar-thumb-rounded-full p-6 border-2 rounded-lg border-black shadow-[0px_6px_0px_0px_rgba(0,0,0,1)] me-0 mb-0 md:me-2 md:mb-2 bg-white">

                <div class="flex mb-3">
                    <p class="md:text-xl text-lg font-medium me-2">Task</p>
                </div>

                <div>
                    @foreach ($tasks as $task)
                        {{-- tekan pada task untuk memunculkan detail --}}
                        <div data-task-id="{{ $task->id }}" onclick="showDetailTask({{ $task->id }})"
                            class="task-item flex
                            justify-between py-2 px-4 mb-5 border-2 rounded-lg border-black transition-all 
                            shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] overflow-x-hidden hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[3px] hover:bg-[#f0f0f0] cursor-pointer">
                            <div class="flex">

                                {{-- update is_complete selesai atau tidak selesai menggunakan ajax --}}
                                {{-- <button onclick="toggleTaskStatus({{ $task->id }})" class=" flex items-center">
                                    <i
                                        class="toggle-task-status md:text-xl text-sm {{ $task->is_complete ? 'fa-regular fa-circle-check' : 'fa-regular fa-circle' }}"></i>
                                </button> --}}
                                <div class="flex items-center">

                                    <i
                                        class="toggle-task-status md:text-xl text-sm {{ $task->is_complete ? 'fa-regular fa-circle-check' : 'fa-regular fa-circle' }}"></i>
                                </div>

                                {{-- title task --}}
                                <div class="flex ">
                                    <p class="title-task mx-3 md:text-base text-sm self-center font-medium duration-1000 capitalize transition-transform {{ $task->is_complete ? 'line-through  text-gray-500' : '' }}"
                                        data-task-id="{{ $task->id }}">
                                        {{ $task->title }}</p>
                                </div>

                                {{-- triger modal edit / update --}}
                                {{-- <button class="flex items-center" data-modal-target="edit-modal-{{ $task->id }}"
                                    data-modal-toggle="edit-modal-{{ $task->id }}"
                                    {{ $task->is_complete ? 'disabled' : '' }}>
                                    <i class="fa-regular fa-pen-to-square md:text-lg text-sm"></i>
                                </button> --}}

                                {{-- triger detail list --}}
                                {{-- <button onclick="showDetailTask({{ $task->id }})" data-task-id="{{ $task->id }}"
                                    class="flex items-center md:ms-3 ms-1.5">
                                    <i class="fa-solid fa-eye md:text-lg text-sm"></i>
                                </button> --}}

                                {{-- indikator prioritas --}}
                                <div class="flex items-center ms-1.5">
                                    {{-- <i
                                        class=" {{ $task->priority === 'high' ? 'fa-solid fa-thumbtack md:text-lg text-sm' : '' }}"></i> --}}
                                    @if ($task->priority === 'high')
                                        <span
                                            class="py-1 px-2 md:text-xs text-xs rounded-[4px] border-2 border-black bg-red-400 text-white">High</span>
                                    @elseif ($task->priority === 'medium')
                                        <span
                                            class="py-1 px-2 md:text-xs text-xs rounded-[4px] border-2 border-black bg-yellow-200">Medium</span>
                                    @elseif ($task->priority === 'low')
                                        <span
                                            class="py-1 px-2 md:text-xs text-xs rounded-[4px] border-2 border-black bg-blue-300 ">Low</span>
                                    @endif
                                </div>
                                <div id="successLable" data-lable-id="{{ $task->id }}"
                                    class="flex items-center ms-1.5 {{ $task->is_complete ? '' : 'hidden' }}">
                                    <span
                                        class="py-1 px-2 md:text-xs text-xs rounded-[4px] border-2 border-black bg-green-200">Success</span>
                                </div>
                            </div>{{-- hapus task --}}
                            {{-- <div class="flex"> 
                                <div class="flex h-full">
                                    <button class="delete-task flex h-full items-center"
                                        data-task-id="{{ $task->id }}">
                                        <i class="fa-regular fa-circle-xmark text-xl"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $task->id }}"
                                    action="{{ route('mytasks.delete', $task->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div> --}}
                        </div>
                        <!-- Main modal untuk update -->
                        <div id="edit-modal-{{ $task->id }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 justify-center items-center w-full md:inset-0  max-h-full ">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div
                                    class="relative bg-white rounded-lg border-2 border-black shadow-[0_8px_0_0_rgba(0,0,0,1)]">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                        <h3 class="text-xl font-semibold text-black">
                                            Edit Task
                                        </h3>
                                        <button type="button"
                                            class="text-black bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                            data-modal-toggle="edit-modal-{{ $task->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- untuk menyimpan id dari task yang di tekan (detail task) --}}
            <input id="current-task-id" type="hidden" class="text-black hidden" value=""></input>
            {{-- detail dari task yang di tekan --}}
            <div id="task-detail-container"
                class="md:row-start-2 row-start-3 min-h-[60vh] md:col-span-1 col-span-full overflow-y-auto scrollbar-thin scrollbar-thumb-black scrollbar-track-transparent scrollbar-thumb-rounded-full border-2 rounded-lg border-black shadow-[0px_6px_0px_0px_rgba(0,0,0,1)] me-0 mb-0 md:me-2 md:mb-2 bg-white">
                {{-- detail.blade akan ditampilkan disini --}}

            </div>
        </div>
    </div>



@endsection
