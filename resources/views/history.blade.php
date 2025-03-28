@extends('layout.app')
@section('title', 'History')
@section('content')

    <div class="p-4 h-full font-MadeforText">
        <div class="relative overflow-x-auto border-2 rounded-lg border-black shadow-[0px_8px_0px_0px_rgba(0,0,0,1)]">
            <table class="w-full text-sm text-left rtl:text-right text-black">
                <thead class="md:text-base text-xs text-white uppercase bg-black">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Task Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Priority
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Deadline
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created At
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Complete At
                        </th>
                    </tr>
                </thead>
                <tbody class="md:text-base text-xs">
                    @if ($tasks->isEmpty())
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-black">
                                Saat ini belum ada task yang selesai
                            </td>
                        </tr>
                    @else
                        @foreach ($tasks as $task)
                            <tr class="bg-white border-t-2 border-black ">
                                <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                                    {{ $task->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $task->priority }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{-- nanti tambahkan kolom baru untuk end_at --}}
                                    {{ $task->is_complete ? 'Selesai' : 'Belum Selesai' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $task->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($task->complete_at)->format('d M Y') }}
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>

    </div>


@endsection
