<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 bottom-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg border-2 border-black shadow-[0_8px_0_0_rgba(0,0,0,1)]">
            <!-- Modal header -->
            <div class="flex items-center justify-between md:py-6 py-4 px-6 border-b rounded-t  border-black">
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
            <form class="md:py-6 py-4 px-6" action="{{ route('mytasks.store') }}" method="POST">
                @csrf
                <div class="grid gap-2 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="title" class="block md:text-base text-base font-semibold text-black"
                            title="required">Title<strong class="text-red-500">*</strong></label>
                        <input type="text" name="title" id="title" placeholder="30 Character Max"
                            maxlength="30"
                            class="bg-white shadow-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] focus:shadow-none transition-all focus:translate-y-[3px] border-2 border-black text-black text-sm font-medium placeholder:text-black/50 rounded-lg outline-none block w-full md:p-2.5 p-2"
                            required>
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block text-base font-semibold text-black">Description
                            (Optional)</label>
                        <textarea name="description" type="text" id="description" rows="2"
                            class="bg-white shadow-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] focus:shadow-none transition-all focus:translate-y-[3px] border-2 border-black text-black text-sm font-medium rounded-lg outline-none block w-full md:p-2.5 p-2"></textarea>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="deadline" class="block text-base font-semibold text-black"
                            title="required">Deadline<strong class="text-red-500">*</strong></label>

                        <div class="relative max-w-sm">
                            <input id="deadline" type="date" name="deadline"
                                class="bg-white shadow-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] focus:shadow-none transition-all focus:translate-y-[3px] border-2 border-black text-black text-sm font-medium rounded-lg outline-none block w-full md:p-2.5 p-2"
                                required>
                        </div>

                    </div>
                    <div class="sm:col-span-1">
                        <label for="priority" class="block text-base font-semibold text-black" title="required">Select
                            Priority<strong class="text-red-500">*</strong></label>
                        <select id="priority" name="priority"
                            class="bg-white shadow-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] focus:shadow-none transition-all focus:translate-y-[3px] border-2 border-black text-black text-sm font-medium rounded-lg outline-none block w-full md:p-2.5 p-2">
                            {{-- <option selected>Skala Prioritas</option> --}}
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                </div>
                <button type="submit"
                    class="flex w-full text-center justify-center p-2 rounded-lg text-white border-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[3px] hover:shadow-none bg-[#3D97CC] transition-all border-2 mb-5 mt-6 font-medium">
                    Add Task
                </button>
            </form>
        </div>
    </div>
</div>
