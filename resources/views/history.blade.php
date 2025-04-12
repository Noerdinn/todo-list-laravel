@extends('layout.app')
@section('title', 'History')
@section('content')

    <div class="p-4 h-full font-MadeforText container-pattern">
        <div class="relative overflow-x-auto border-2 rounded-lg border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)]">
            <div
                class="max-h-[calc(100dvh-106px)] scrollbar-thin scrollbar-thumb-black scrollbar-track-transparent scrollbar-thumb-rounded-full">
                <table class="w-full text-sm text-left rtl:text-right text-black">
                    <thead class="md:text-base text-xs text-black uppercase bg-[#E9C452]">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="pe-6 py-3 text-nowrap">
                                Task Name
                            </th>
                            <th scope="col" class="pe-6 py-3">
                                Priority
                            </th>
                            <th scope="col" class="pe-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="pe-6 py-3 text-nowrap">
                                Created At
                            </th>
                            <th scope="col" class="pe-6 py-3">
                                Deadline
                            </th>
                            <th scope="col" class="pe-6 py-3 text-nowrap">
                                Complete At
                            </th>
                        </tr>
                    </thead>
                    <tbody class="md:text-base text-xs bg-white">
                        @if ($tasks->isEmpty())
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-black">
                                    Saat ini belum ada task yang selesai
                                </td>
                            </tr>
                        @else
                            @foreach ($tasks as $task)
                                <tr class="bg-white border-t-2 border-black text-nowrap">
                                    <td class="px-6 py-3">{{ $loop->iteration }}</td>
                                    <td scope="row"
                                        class="pe-6 py-4 font-medium text-black whitespace-nowrap truncate md:max-w-10 max-w-36 cursor-pointer"
                                        title="{{ $task->title }}">
                                        {{ $task->title }}
                                    </td>
                                    <td class="pe-6 py-4">
                                        @if ($task->priority === 'high')
                                            <span
                                                class="py-1 px-2 md:font-medium text-xs rounded-[4px] border-2 border-black bg-[#E53123] text-white">High</span>
                                        @elseif ($task->priority === 'medium')
                                            <span
                                                class="py-1 px-2 md:font-medium text-xs rounded-[4px] border-2 border-black bg-[#E9C452]">Medium</span>
                                        @elseif ($task->priority === 'low')
                                            <span
                                                class="py-1 px-2 md:font-medium text-xs rounded-[4px] border-2 border-black text-white bg-[#5E74A6]">Low</span>
                                        @endif
                                        {{-- {{ $task->priority }} --}}
                                    </td>
                                    <td class="pe-6 py-4 font-medium flex items-center gap-2">
                                        <i class="fa-solid fa-circle-check text-[#4A9F93]"></i>
                                        {{ $task->is_complete ? 'Selesai' : 'Belum Selesai' }}
                                    </td>
                                    <td class="pe-6 py-4 font-medium text-nowrap ">
                                        <div class="flex gap-2 items-center">
                                            <i class="fa-solid fa-clock"></i>
                                            {{ $task->created_at->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="pe-6 py-4 font-medium text-nowrap">
                                        <div class="flex gap-2 items-center">
                                            <i class="fa-solid fa-stopwatch"></i>
                                            {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="pe-6 py-4 font-medium text-nowrap ">
                                        <div class="flex gap-2 items-center">
                                            <i class="fa-solid fa-clock"></i>
                                            {{ \Carbon\Carbon::parse($task->complete_at)->format('d M Y') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>

    </div>


@endsection
