<div id="edit-modal-{{ $task->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg border-2 border-black shadow-[0_8px_0_0_rgba(0,0,0,1)]">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-black">
                    Edit Task
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="edit-modal-{{ $task->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- form modal untuk update -->
            @if ($task)
                <form class="p-4 md:p-5" action="{{ route('mytasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="title-{{ $task->id }}"
                                class="block mb-2 text-base font-medium text-black">Title</label>
                            <input type="text" name="title" id="title-{{ $task->id }}"
                                class="bg-white border-2 border-black text-black text-sm rounded-lg outline-none block w-full p-2.5"
                                placeholder="Title task" required="" value="{{ $task->title }}">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="description-{{ $task->id }}"
                                class="block mb-2 text-base font-medium text-black">Description</label>
                            <input type="text" name="description" id="description-{{ $task->id }}"
                                class="bg-white border-2 border-black text-black text-sm rounded-lg outline-none block w-full p-2.5"
                                placeholder="$desc" value="{{ $task->description }}">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="due_date" class="block mb-2 text-base font-medium text-black">Due
                                Date</label>

                            <div class="relative max-w-sm">
                                <input id="due_date-{{ $task->id }}" type="date" name="due_date"
                                    class="bg-white border-2 border-black text-black text-sm rounded-lg outline-none block w-full p-2.5"
                                    placeholder="Select date" value="{{ $task->due_date }}">
                            </div>

                        </div>
                        <div class="col-span-2">
                            <label for="priority" class="block mb-2 text-base font-medium text-black">Select
                                Priority</label>
                            <input type="text" name="priority" id="priority"
                                class="bg-white border-2 border-black text-black text-sm rounded-lg outline-none block w-full p-2.5"
                                required="" value="{{ $task->priority }}">
                        </div>
                    </div>

                    <button type="submit"
                        class="flex w-full text-center justify-center p-2 rounded-lg text-black border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] hover:bg-gray-300 transition-all border-2 mb-5 font-medium">

                        Apply Edit
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
