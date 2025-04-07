<div class="p-5 ">
    <button type="button" onclick="showDetailTask({{ $task->id }})" class="mt-2 mb-5 font-medium">
        <i class="fa-solid fa-arrow-left me-1"></i>
        Back</button>
    <div class="flex mb-3">
        <p class="md:text-xl text-lg font-medium me-2">Edit Task</p>
    </div>

    <form id="edit-task-form-{{ $task->id }}" onsubmit="updateTask(event, {{ $task->id }})">
        @csrf
        @method('PUT')
        <div class="grid gap-4 mb-4 grid-cols-2">
            <div class="col-span-2">
                <label for="title" class="block md:text-base text-base font-semibold text-black">Title</label>
                <input type="text" name="title" id="edit-title"
                    class="bg-white shadow-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] focus:shadow-none transition-all focus:translate-y-[3px] border-2 border-black text-black text-sm font-medium  rounded-lg outline-none block w-full md:p-2.5 p-2"
                    required maxlength="50" value="{{ $task->title }}">
            </div>

            <div class="col-span-2">
                <label for="edit-description"
                    class="block md:text-base text-base font-semibold text-black">Description</label>
                <textarea name="description" type="text" id="edit-description" rows="3"
                    class="bg-white shadow-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] focus:shadow-none transition-all focus:translate-y-[3px] border-2 border-black text-black text-sm font-medium rounded-lg outline-none block w-full md:p-2.5 p-2">{{ $task->description }}</textarea>
            </div>

            <div class="col-span-2 sm:col-span-1">
                <label for="deadline" class="block md:text-base text-base font-semibold text-black">Deadline</label>

                <div class="relative max-w-sm">
                    <input id="edit-deadline" type="date" name="deadline"
                        class="bg-white shadow-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] focus:shadow-none transition-all focus:translate-y-[3px] border-2 border-black text-black text-sm font-medium rounded-lg outline-none block w-full md:p-2.5 p-2"
                        value="{{ $task->deadline }}">
                </div>
            </div>

            <div class="col-span-2 sm:col-span-1">
                <label for="priority" class="block md:text-base text-base font-semibold text-black">Select
                    Priority</label>
                <select id="priority" name="priority"
                    class="bg-white shadow-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] focus:shadow-none transition-all focus:translate-y-[3px] border-2 border-black text-black text-sm font-medium rounded-lg outline-none block w-full md:p-2.5 p-2">
                    {{-- <option selected>Skala Prioritas</option> --}}
                    <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium
                    </option>
                    <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div class="col-span-2 mt-2 flex justify-end">
                <button type="submit"
                    class="flex w-full text-center justify-center p-2 rounded-lg border-black shadow-[0px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[3px] ease-out hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] hover:bg-[#3A66B1] bg-[#3085d6] text-white transition-all border-2 font-medium">Save</button>
            </div>
        </div>
    </form>
</div>
