<div class="flex-grow-1 p-7">
    <div class="flex mb-1 mt-1 gap-2">
        <h1 id="task-title" class="md:text-3xl text-xl font-semibold capitalize">{{ $task->title }}</h1>
        @if ($task->priority === 'high')
            <span
                class="py-1 px-2 md:text-base text-xs rounded-[5px] border-2 border-black h-fit self-center bg-red-400">High</span>
        @elseif ($task->priority === 'medium')
            <span
                class="py-1 px-2 md:text-base text-xs rounded-[5px] border-2 border-black h-fit self-center bg-yellow-200">Medium</span>
        @elseif ($task->priority === 'low')
            <span
                class="py-1 px-2 md:text-base text-xs rounded-[5px] border-2 border-black h-fit self-center bg-blue-300">Low</span>
        @endif
    </div>
    <div class="mb-6">
        <p class="text-gray-700 font-normal">Deadline {{ \Carbon\Carbon::parse($task->deadline)->format('d F Y') }}</p>
    </div>
    <div class="flex justify-between mb-4">
        <div class="flex gap-1.5">
            {{-- trigger complete task --}}
            <div>
                <button onclick="toggleTaskStatus({{ $task->id }})" id="mark-complete-btn"
                    class="py-1.5 px-3 md:text-sm text-xs rounded-lg border-2 border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-none transition-all bg-white"
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
                    class="delete-task py-1.5 px-3 md:text-sm text-xs rounded-lg border-2 border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-none transition-all "
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
                    class="py-1.5 px-3 md:text-sm text-xs rounded-lg border-2 border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-none transition-all "
                    {{ $task->is_complete ? 'disabled' : '' }}>
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
        <p id="task-desc" class="md:text-base text-sm text-gray-700 font-normal ">{{ $task->description }}</p>
    </div>

    {{-- menampilkan subtask --}}
    <div class="mt-4 ">
        <p class="md:text-lg text-base font-medium mb-2">Subtasks</p>
        <div id="subtasks-container">
            @foreach ($task->subtasks as $subtask)
                @include('tasks.subtask', ['subtask' => $subtask])
            @endforeach
        </div>
    </div>

</div>
<div class="sticky bottom-0 p-4 bg-white">
    <div class="flex items-center gap-3">
        {{-- untuk menambahkan subtask --}}
        <input type="text" id="subtask-title"
            class="md:text-base text-sm border-2 border-black w-full p-2 rounded-lg outline-none placeholder:text-black"
            placeholder="Add new subtask">
        <button id="add-subtask-btn" class="md:text-base text-sm bg-black text-white p-2 px-4 rounded-lg">+Add</button>
    </div>
</div>
