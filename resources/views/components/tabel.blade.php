<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    </td>
                    <td>
                        {{-- <form action="{{ route('mytasks.update', ['edit' => $editTask->id]) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm"></button>
                        </form> --}}
                        <!-- Button to trigger Edit Modal -->
                        <button data-modal-target="edit-modal-{{ $task->id }}"
                            data-modal-toggle="edit-modal-{{ $task->id }}"
                            class="btn btn-warning btn-sm">Edit</button>
                        <!-- Main modal -->
                        <div id="edit-modal-{{ $task->id }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Create New Task
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="edit-modal-{{ $task->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    @if ($task)
                                        <form class="p-4 md:p-5" action="{{ route('mytasks.update', $task->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="title-{{ $task->id }}"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                                    <input type="text" name="title" id="title-{{ $task->id }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        placeholder="Type product title" required=""
                                                        value="{{ $task->title }}">
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="description-{{ $task->id }}"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                                    <input type="text" name="description"
                                                        id="description-{{ $task->id }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        placeholder="$2999" required=""
                                                        value="{{ $task->description }}">
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="category"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Due
                                                        Date</label>

                                                    <div class="relative max-w-sm">
                                                        <input datepicker id="due_date-{{ $task->id }}"
                                                            type="date" name="due_date"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Select date" value="{{ $task->due_date }}">
                                                    </div>

                                                </div>
                                                <div class="col-span-2">
                                                    <label for="priority"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Priority</label>
                                                    <input type="text" name="priority" id="priority"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        placeholder="$2999" required=""
                                                        value="{{ $task->priority }}">
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Add Task
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- <a href="{{ route('mytasks.update', ['edit' => $task->id]) }}"
                            class="btn btn-warning btn-sm">Edit</a> --}}
                        <form action="{{ route('mytasks.delete', $task->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
