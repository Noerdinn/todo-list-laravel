@extends('layout.app')
@section('title', 'Home')
@section('content')
    <div class="p-4 h-full container-pattern">
        <div class="h-full flex items-center justify-center font-MadeforDisplay">
            <div class="text-center select-none">
                <h1 class="md:text-6xl text-4xl font-normal tracking-tight text-black capitalize">
                    {{ $greeting }},
                    {{ explode(' ', Auth::user()->name)[0] }}<strong class="text-[#3A66B1]">.</strong></h1>
                <p class="md:text-xl text-base font-medium text-black mt-3">It's time to plan what you want to do.
                </p>
                {{-- grid --}}
                <div class="grid grid-rows-[auto_1fr] grid-cols-6 mt-8 gap-4">
                    <div
                        class="flex items-center justify-center bg-white active:bg-[#E6E5E5] text-black row-start-1 row-end-3 md:col-start-2 md:col-span-2 col-span-3 rounded-lg border-2 border-black shadow-[0px_4px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-y-[4px] transition-all h-20">
                        <i class="md:text-2xl text-base fa-regular fa-circle-check"></i>
                        <p class="md:text-lg text-sm ms-1 font-semibold flex items-center">Task
                            Complete</p>
                        <strong class="font-black md:text-2xl text-base ms-1 flex">{{ $completeTask }}</strong>
                    </div>
                    <div
                        class="flex items-center justify-center bg-white active:bg-[#E6E5E5] text-black row-start-1 row-end-3 md:col-span-2 col-span-3 rounded-lg border-2 border-black shadow-[0px_4px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-y-[4px] transition-all">
                        <i class="md:text-2xl text-base fa-regular fa-circle"></i>
                        <p class="md:text-lg text-sm ms-1 font-semibold flex items-center">Task Total </p>
                        <strong class="font-black md:text-2xl text-base ms-1">{{ $incompleteTasks }}</strong>
                    </div>
                    <div
                        class="flex items-center justify-center bg-[#3A66B1] active:bg-[#224E7D] text-white row-start-3 row-span-2 md:col-start-2 md:col-span-4 col-span-full rounded-lg border-2 border-black shadow-[0px_4px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-y-[4px] transition-all h-24 md:px-20 px-0">
                        <p class="md:text-2xl text-lg font-semibold">Today is {{ $date }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
