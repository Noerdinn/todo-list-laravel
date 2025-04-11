<div id="subtask-card"
    class="subtask-card bg-white flex justify-between py-2 px-3 md:px-4 mb-3 md:mb-4 border-2 rounded-lg border-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)]"
    data-id="{{ $subtask->id }}">

    <div class="flex">
        <button class="toggle-complete flex items-center md:text-xl text-sm ">
            @if ($subtask->is_complete)
                {{-- <i class="fa-regular fa-circle-check"></i> --}}
                <i class="fa-solid fa-circle-check"></i>
            @else
                <i class="fa-regular fa-circle"></i>
            @endif
        </button>
        <p
            class="md:ms-3 ms-1 font-medium capitalize md:text-base text-sm {{ $subtask->is_complete == 1 ? 'line-through text-gray-700' : '' }}">
            {{ $subtask->title }}</p>
    </div>
    <div class="flex">
        <div class="flex h-full">
            <button class="delete-subtask flex h-full items-center md:text-xl text-sm ">
                {{-- <i class="fa-regular fa-circle-xmark md:text-xl text-sm"></i> --}}
                <i class="fa-solid fa-circle-xmark"></i>
            </button>
        </div>
    </div>
</div>
