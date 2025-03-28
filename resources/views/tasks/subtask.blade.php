<div id="subtask-card"
    class="subtask-card flex justify-between py-2 px-4 mb-5 border-2 rounded-lg border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)]"
    data-id="{{ $subtask->id }}">

    <div class="flex">
        <button class="toggle-complete flex items-center md:text-xl text-sm ">
            @if ($subtask->is_complete)
                <i class="fa-regular fa-circle-check"></i>
            @else
                <i class="fa-regular fa-circle"></i>
            @endif
        </button>
        <p
            class="md:mx-2 mx-1 font-medium capitalize md:text-base text-sm {{ $subtask->is_complete == 1 ? 'line-through text-gray-600' : '' }}">
            {{ $subtask->title }}</p>
    </div>
    <div class="flex">
        <div class="flex h-full">
            <button class="delete-subtask flex h-full items-center">
                <i class="fa-regular fa-circle-xmark md:text-xl text-sm"></i>
            </button>
        </div>
    </div>
</div>
