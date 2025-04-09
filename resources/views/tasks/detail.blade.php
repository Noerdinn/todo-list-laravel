<div class="flex-grow-1 p-5">
    <div class="flex flex-col md:flex-row mb-1 mt-1 gap-2">
        {{-- title --}}
        <h1 id="task-title" class="md:text-3xl text-base font-semibold capitalize">{{ $task->title }}</h1>
        {{-- @if ($task->priority === 'high')
            <span
                class="py-1 px-2 md:text-base text-xs rounded-[5px] border-2 border-black h-fit self-center text-white bg-[#E53123]">High</span>
        @elseif ($task->priority === 'medium')
            <span
                class="py-1 px-2 md:text-base text-xs rounded-[5px] border-2 border-black h-fit self-center bg-[#efce31]">Medium</span>
        @elseif ($task->priority === 'low')
            <span
                class="py-1 px-2 md:text-base text-xs rounded-[5px] border-2 border-black h-fit self-center text-white bg-[#3C6CCE]">Low</span>
        @endif --}}
    </div>
    <div class="mt-2 mb-6 flex items-center md:text-base text-sm text-gray-700 font-normal divide-x-2 divide-gray-700">
        {{-- deadline --}}
        <p class="pe-1 md:pe-3">Deadline
            {{ \Carbon\Carbon::parse($task->deadline)->format('d F Y') }}
        </p>
        {{-- status --}}
        <p class="status-lable-task px-1 md:px-3">{{ $task->is_complete ? 'Complete' : 'Incomplete' }}</p>
        {{-- priority --}}
        @if ($task->priority === 'high')
            <span class="ps-1 md:ps-3">High</span>
        @elseif ($task->priority === 'medium')
            <span class="ps-1 md:ps-3">Medium</span>
        @elseif ($task->priority === 'low')
            <span class="ps-1 md:ps-3">Low</span>
        @endif
    </div>
    <div class="flex justify-between mb-4">
        <div class="flex gap-1.5">
            {{-- trigger complete task --}}
            <div>
                <button onclick="toggleTaskStatus({{ $task->id }})" id="mark-complete-btn"
                    class="py-1.5 px-3 md:text-sm text-xs rounded-lg border-2 border-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[3px] hover:shadow-none transition-all ease-out bg-[#4A9F93] text-white"
                    data-task-id="{{ $task->id }}">
                    <div class="block md:hidden">
                    </div>
                    <i class="fa-regular fa-circle-check "></i>
                    <span class="hidden md:block">Complete Task</span>
                </button>
            </div>

            {{-- trigger delete task --}}
            <div>
                <button
                    class="delete-task py-1.5 px-3 md:text-sm text-xs rounded-lg border-2 border-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[3px] hover:shadow-none transition-all ease-out bg-[#E53123] text-white"
                    data-task-id="{{ $task->id }}">
                    <div class="block md:hidden">
                    </div>
                    <i class="fa-regular fa-trash-can "></i>
                    <span class="hidden md:block">Delete</span>
                </button>

                <form id="delete-form-{{ $task->id }}" action="{{ route('mytasks.delete', $task->id) }}"
                    method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>

            {{-- trigger edit task --}}
            <div>
                <button onclick="showEditTask({{ $task->id }})" data-edit-id="{{ $task->id }}"
                    class="edit-button py-1.5 px-3 md:text-sm text-xs rounded-lg border-2 border-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[3px] hover:shadow-none transition-all ease-out text-white bg-[#3C6CCE] {{ $task->is_complete ? 'hidden' : '' }}">
                    <div class="block md:hidden">
                    </div>
                    <i class="fa-regular fa-pen-to-square "></i>
                    <span class="hidden md:block">Edit</span>
                </button>
            </div>

        </div>
    </div>
    <div class="mt-4">
        <p class="md:text-lg text-base font-medium mb-2">Description</p>
        <p id="task-desc" class="md:text-base text-sm text-gray-700 font-normal">{{ $task->description }}</p>
    </div>

    {{-- menampilkan subtask --}}
    <div class="mt-4 ">
        <p class="md:text-lg text-base font-medium mb-2">Subtasks</p>
        <div id="subtasks-container" class="border-2 border-black rounded-lg p-4 min-h-32 bg-[#e1e3e5] pb-0">
            @forelse ($task->subtasks as $subtask)
                @include('tasks.subtask', ['subtask' => $subtask])
            @empty
                {{-- <div class="empty-subtask-state transition-all bg-black/60">
                    <p class="text-white text-center py-1">Subtask Masih Kosong</p>
                </div> --}}
            @endforelse
        </div>
    </div>

</div>
<div class="sticky bottom-0 p-4 bg-white">
    <div class="flex items-center gap-3">
        {{-- untuk menambahkan subtask --}}
        <input type="text" id="subtask-title"
            class="md:text-base text-sm border-2 border-black w-full p-2 rounded-lg outline-none placeholder:text-black"
            placeholder="Add new subtask">
        <button id="add-subtask-btn"
            class="md:text-base text-sm shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[3px] hover:shadow-none transition-all mb-1 border-black border-2 text-white bg-[#3C6CCE] p-2 px-4 rounded-lg">+Add</button>
    </div>
</div>
