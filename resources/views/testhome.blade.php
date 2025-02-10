@extends('layout.app')
@section('title', 'My Tasks')
@section('content')

    <div>
        <img src="{{ asset('img/laptop.svg') }}" alt="">
        <p class="text-black h-full flex items-center justify-center">Tidak ada task yang dipilih</p>
    </div>

    <div class="flex-grow-1 bg-green-200 p-4">
        <div class="mb-3">
            <p class="text-xl font-medium me-2">Detail Task</p>
        </div>
        <h1 id="task-title" class="text-3xl font-semibold capitalize">${
            taskData.title
            }</h1>
        <div class="mt-4">
            <p class="text-lg font-medium mb-2">Description</p>
            <p id="task-desc" class="text-base font-normal ">${
                taskData.description
                }</p>
        </div>

        <div class="mt-4 ">
            <p class="text-lg font-medium mb-2">Tasks</p>

            <div id="subtasks-container">
                ${
                taskData.subtasks.length
                ? taskData.subtasks.map(renderSubtask).join("")
                : ``
                }
            </div>
        </div>
    </div>
    <div class="sticky bottom-0 bg-pink-300 px-4 py-5">
        <div class="flex items-center gap-3">
            <input type="text" id="subtask-title"
                class="border-2 border-black w-full p-2 rounded-lg outline-none placeholder:text-black"
                placeholder="Add new subtask">
            <button id="add-subtask-btn" class="bg-black text-white p-2 px-4 rounded-lg">+Add</button>
        </div>
    </div>


@endsection
