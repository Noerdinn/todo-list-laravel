<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg border-2 border-black shadow-[0_8px_0_0_rgba(0,0,0,1)]">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-black">
                <h3 class="text-xl font-semibold text-black">
                    Create New Task
                </h3>
                <button type="button"
                    class="text-black bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body untuk create task -->
            <form class="p-4 md:p-5" action="{{ route('mytasks.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="title" class="block mb-2 text-base font-medium text-black">Title</label>
                        <input type="text" name="title" id="title"
                            class="bg-white border-2 border-black text-black text-sm font-medium  rounded-lg outline-none block w-full p-2.5"
                            required="">
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-base font-medium text-black">Description</label>
                        <textarea name="description" type="text" id="description" rows="3"
                            class="bg-white border-2 border-black text-black text-sm font-medium rounded-lg outline-none block w-full p-2.5"></textarea>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="deadline" class="block mb-2 text-base font-medium text-black">Due
                            Date</label>

                        <div class="relative max-w-sm">
                            <input id="deadline" type="date" name="deadline"
                                class="bg-white border-2 border-black text-black text-sm font-medium rounded-lg outline-none block w-full p-2.5">
                        </div>

                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="priority" class="block mb-2 text-base font-medium text-black">Select
                            Priority</label>
                        <select id="priority" name="priority"
                            class="bg-white border-2 border-black text-black text-sm font-medium rounded-lg outline-none block w-full p-2.5">
                            {{-- <option selected>Skala Prioritas</option> --}}
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                </div>
                <button type="submit"
                    class="flex w-full text-center justify-center p-2 rounded-lg text-black border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1.5 hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] hover:bg-gray-300 transition-all border-2 mb-5 mt-6 font-medium">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Add Task
                </button>
            </form>
        </div>
    </div>
</div>
