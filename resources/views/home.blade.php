@extends('layout.app')
@section('title', 'Home')
@section('content')
    <div class="p-4 h-full">
        <div class="h-full flex items-center justify-center font-MadeforDisplay">
            <div class="text-center">
                <h1 class="text-6xl font-normal tracking-tight text-black capitalize">
                    {{ $greeting }},
                    {{ Auth::user()->name }}</h1>
                <p class=" text-xl font-medium text-black mt-3">It's time to plan what you want to
                    do.
                </p>
                {{-- grid --}}
                <div class="grid grid-rows-[auto_1fr] grid-cols-6 mt-8 gap-4">
                    <div
                        class="flex items-center justify-center bg-white row-start-1 row-end-3 col-start-2 col-span-2 rounded-lg border-2 border-black shadow-[0px_8px_0px_0px_rgba(0,0,0,1)] h-20">
                        <i class="text-2xl fa-regular fa-circle-check"></i>
                        <p class="text-lg ms-1.5 font-semibold">Task Complete <strong
                                class="font-black">{{ $completeTask }}</strong></p>
                    </div>
                    <div
                        class="flex items-center justify-center bg-white row-start-1 row-end-3 col-span-2 rounded-lg border-2 border-black shadow-[0px_8px_0px_0px_rgba(0,0,0,1)]">
                        <i class="text-2xl fa-regular fa-circle"></i>
                        <p class="text-lg ms-1.5 font-semibold">Task Incomplete <strong
                                class="font-black">{{ $incompleteTasks }}</strong></p>
                    </div>
                    <div
                        class="flex items-center justify-center bg-white row-start-3 row-span-2 col-start-2 col-span-4 rounded-lg border-2 border-black shadow-[0px_8px_0px_0px_rgba(0,0,0,1)] h-24 px-20">
                        <p class="text-2xl font-semibold">Today is {{ $date }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
