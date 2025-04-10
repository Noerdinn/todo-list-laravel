<div class="flex-grow-1 p-5">
    <div class="flex flex-col mb-1 mt-1 gap-2">
        <p class="md:text-xl text-lg font-medium">Detail Task</p>
        {{-- title --}}
        <h1 id="task-title" class="md:text-3xl text-base font-semibold capitalize">{{ $task->title }}</h1>
    </div>

    <div class="my-6 bg-[#e1e3e5] p-4 border-2 border-black rounded-lg">
        <div class="grid md:grid-cols-[130px_1fr] grid-cols-[100px_1fr] gap-y-3 items-center">
            {{-- Status --}}
            <p class="md:text-lg text-base font-medium">Status</p>
            <p
                class="status-lable-task text-white md:text-sm text-xs border-2 border-black {{ $task->is_complete ? 'bg-green-700' : 'bg-red-500' }}  w-fit text-center px-5 py-0.5 rounded-full">
                {{ $task->is_complete ? 'Complete' : 'Incomplete' }}</p>

            {{-- created task --}}
            <p class="md:text-lg text-base font-medium">Created At</p>
            <p class="flex items-center gap-1.5 md:text-base text-sm">
                {{ $task->created_at->format('d F Y') }}
            </p>

            {{-- Deadline --}}
            <p class="md:text-lg text-base font-medium">Deadline</p>
            <p class="flex items-center gap-1.5 md:text-base text-sm">
                <i class="fa-solid fa-stopwatch text-black "></i>
                {{ \Carbon\Carbon::parse($task->deadline)->format('d F Y') }}
            </p>

            {{-- Priority --}}
            <p class="md:text-lg text-base font-medium">Priority</p>
            @if ($task->priority === 'high')
                <p
                    class="text-white bg-[#E53123] w-fit text-center px-4 py-0.5 rounded-full border-2 border-black md:text-sm text-xs">
                    High
                </p>
            @elseif ($task->priority === 'medium')
                <p
                    class="text-black bg-[#efce31] w-fit text-center px-4 py-0.5 rounded-full border-2 border-black md:text-sm text-xs">
                    Medium</p>
            @elseif ($task->priority === 'low')
                <p
                    class="text-white bg-[#3C6CCE] w-fit text-center px-4 py-0.5 rounded-full border-2 border-black md:text-sm text-xs">
                    Low
                </p>
            @endif
        </div>

        {{-- decription --}}
        <div class="mt-3">
            <p class="md:text-lg text-base font-medium mb-2">Description</p>
            <p id="task-desc" class="md:text-base text-sm text-gray-700 font-normal">{{ $task->description }}
            </p>
        </div>
    </div>

    <div class="flex justify-between mb-4">
        <div class="flex {{ $task->is_complete ? '' : 'gap-1.5' }}">
            {{-- trigger complete task --}}
            <div>
                <button onclick="toggleTaskStatus({{ $task->id }})" id="mark-complete-btn"
                    class="py-1.5 px-3 md:text-sm text-xs rounded-lg border-2 border-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[3px] hover:shadow-none transition-all ease-out bg-[#4A9F93] text-white {{ $task->is_complete ? 'hidden' : '' }}"
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
                <button onclick="showEditTask({{ $task->id }})"
                    class="edit-button py-1.5 px-3 md:text-sm text-xs rounded-lg border-2 border-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[3px] hover:shadow-none transition-all ease-out text-white bg-[#3C6CCE] {{ $task->is_complete ? 'hidden' : '' }}">
                    <div class="block md:hidden">
                    </div>
                    <i class="fa-regular fa-pen-to-square "></i>
                    <span class="hidden md:block">Edit</span>
                </button>
            </div>

        </div>
    </div>

    {{-- menampilkan subtask --}}
    <div class="mt-4 ">
        <p class="md:text-lg text-base font-medium mb-2">Subtasks</p>
        <div id="subtasks-container">
            @foreach ($task->subtasks as $subtask)
                @include('tasks.subtask', ['subtask' => $subtask, 'task' => $task])
            @endforeach
        </div>
    </div>

</div>
<div class="sticky bottom-0 p-4 bg-white {{ $task->is_complete ? 'hidden' : '' }}">
    <div class="flex items-center gap-3">
        {{-- untuk menambahkan subtask --}}
        <input type="text" id="subtask-title"
            class="md:text-base text-sm border-2 border-black w-full p-2 rounded-lg outline-none placeholder:text-black"
            placeholder="Add new subtask">
        <button id="add-subtask-btn"
            class="md:text-base text-sm shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[3px] hover:shadow-none transition-all mb-1 border-black border-2 text-white bg-[#3C6CCE] p-2 px-4 rounded-lg">+Add</button>
    </div>
</div>
