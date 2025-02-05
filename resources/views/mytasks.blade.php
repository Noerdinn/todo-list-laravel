@extends('layout.app')
@section('title', 'My Tasks')
@section('content')

    <div class="p-4 h-full ">
        <div class="grid grid-rows-10 grid-cols-2 gap-4 font-MadeforText h-full">
            <div class="row-start-1 row-span-1">
                <div class="grid grid-rows-1 grid-cols-12 gap-4">
                    <div class="col-start-1 col-span-4">
                        <!-- Modal toggle -->
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                            class="block p-2 rounded-lg text-black border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] hover:bg-gray-300 transition-all border-2 font-medium text-base w-full"
                            type="button">
                            Create Task
                        </button>
                    </div>
                    <div class="col-span-8">

                        <x-searchbar></x-searchbar>
                    </div>
                </div>


                <!-- Main modal untuk create task -->
                <x-modal-create></x-modal-create>
            </div>


            <div {{-- konten task --}}
                class="row-start-2 row-span-full overflow-y-auto scrollbar-thin scrollbar-thumb-black  scrollbar-track-transparent scrollbar-thumb-rounded-full p-4 border-2 rounded-lg border-black shadow-[0px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="flex mb-3">
                    <p class="text-xl font-medium me-2">List</p>
                    <button class="flex items-center">
                        <span class="material-symbols-outlined">
                            filter_list
                        </span>
                    </button>

                </div>


                <div>
                    @foreach ($tasks as $task)
                        <div
                            class="flex justify-between py-2 px-4 mb-5 border-2 rounded-lg border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)]">
                            <div class="flex">
                                {{-- update is_complete selesai atau tidak selesai menggunakan ajax --}}
                                <button onclick="toggleTaskStatus({{ $task->id }})" class="flex items-center">
                                    <i
                                        class="text-xl {{ $task->is_complete ? 'fa-regular fa-circle-check' : 'fa-regular fa-circle' }}"></i>
                                </button>
                                <p
                                    class="mx-2 font-medium duration-1000 capitalize {{ $task->is_complete ? 'line-through transition-transform ' : '' }}">
                                    {{ $task->title }}</p>
                                {{-- triger modal update --}}
                                <button class="flex items-center" data-modal-target="edit-modal-{{ $task->id }}"
                                    data-modal-toggle="edit-modal-{{ $task->id }}">
                                    <i class="fa-regular fa-pen-to-square text-lg"></i>
                                </button>
                                {{-- triger detail list --}}
                                <button onclick="showDetailTask({{ $task->id }})" class="flex items-center ms-3">
                                    <i class="fa-solid fa-eye text-lg"></i>
                                </button>
                                <button class="flex items-center ms-3">
                                    <i class=" {{ $task->priority === 'high' ? 'fa-solid fa-thumbtack text-lg' : '' }}"></i>
                                </button>
                            </div>
                            <div class="flex"> {{-- haput task --}}
                                <form action="{{ route('mytasks.delete', $task->id) }}" method="POST" class="flex h-full">
                                    @csrf
                                    @method('DELETE')
                                    <button class="flex h-full items-center">
                                        <i class="fa-regular fa-circle-xmark text-xl"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- Main modal untuk update -->
                        <div id="edit-modal-{{ $task->id }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
                                    <!-- form modal untuk update -->
                                    @if ($task)
                                        <form class="p-4 md:p-5" action="{{ route('mytasks.update', $task->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="title-{{ $task->id }}"
                                                        class="block mb-2 text-base font-medium text-black">Title</label>
                                                    <input type="text" name="title" id="title-{{ $task->id }}"
                                                        class="bg-white border-2 border-black text-black text-sm font-medium rounded-lg outline-none block w-full p-2.5"
                                                        required="" value="{{ $task->title }}">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="description-{{ $task->id }}"
                                                        class="block mb-2 text-base font-medium text-black">Description</label>
                                                    <textarea name="description" type="text" id="description-{{ $task->id }}" rows="3"
                                                        class="bg-white border-2 border-black text-black text-sm font-medium rounded-lg outline-none block w-full p-2.5"
                                                        value="">{{ $task->description }}</textarea>
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="due_date"
                                                        class="block mb-2 text-base font-medium text-black">Due
                                                        Date</label>

                                                    <div class="relative max-w-sm">
                                                        <input id="due_date-{{ $task->id }}" type="date"
                                                            name="due_date"
                                                            class="bg-white border-2 border-black text-black text-sm font-medium rounded-lg outline-none block w-full p-2.5"
                                                            value="{{ $task->due_date }}">
                                                    </div>

                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="priority"
                                                        class="block mb-2 text-base font-medium text-black">Select
                                                        Priority</label>
                                                    <input type="text" name="priority" id="priority"
                                                        class="bg-white border-2 border-black text-black text-sm font-medium rounded-lg outline-none block w-full p-2.5"
                                                        required="" value="{{ $task->priority }}">
                                                </div>
                                            </div>

                                            <button type="submit"
                                                class="flex w-full text-center justify-center p-2 rounded-lg text-black border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] hover:bg-gray-300 transition-all border-2 mb-5 mt-6  font-medium">
                                                Apply Edit
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div {{-- detail dari task yang di tekan --}}
                class="row-start-2 row-span-full overflow-y-auto scrollbar-thin scrollbar-thumb-black  scrollbar-track-transparent scrollbar-thumb-rounded-full p-4 border-2 rounded-lg border-black shadow-[0px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="mb-3">
                    <p class="text-xl font-medium me-2">Detail</p>
                </div>
                <div>
                    <div>
                        <h1 id="task-title" class="text-3xl font-semibold capitalize">Title Task</h1>
                        <div class="mt-4">
                            <p class="text-lg font-medium mb-2">Description</p>
                            <p id="task-desc" class="text-base font-normal ">Lorem ipsum dolor sit, amet consectetur
                                adipisicing
                                elit. Cumque animi ipsum, similique et velit vero ipsa possimus illum autem corporis.</p>
                        </div>

                        <div class="mt-4 ">
                            <p class="text-lg font-medium mb-2">Tasks</p>
                            <div id="subtasks-container" class="overflow-y-auto">
                                {{-- tempat menampilkan subtask --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
