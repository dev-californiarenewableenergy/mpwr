@props(['color', 'title', 'description'])

@php
    $color = $color ?? 'green';
@endphp

<div x-data="{ open: false }" x-init="setTimeout(()=> {open = true; setTimeout(()=> {open = false}, 3000)}, 300)"
     class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end"
     x-show="open"
     x-transition:enter="transform ease-out duration-300 transition"
     x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
     x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
     x-transition:leave="transition ease-in duration-100"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
>
    <div class="w-full max-w-sm bg-white rounded-lg shadow-lg pointer-events-auto">
        <div class="overflow-hidden rounded-lg shadow-xs">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        @if($color == 'green')
                            <x-svg.check :class='"h-6 w-6 text-green-base mr-2"'/>
                        @else
                            <x-svg.check :class='"h-6 w-6 text-{$color}-500 mr-2"'/>
                        @endif
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-medium leading-5 text-gray-900">
                            {{ $title }}
                        </p>
                        @if($description ?? false )
                            <p class="mt-1 text-sm leading-5 text-gray-500">
                                {{ $description }}
                            </p>
                        @endif
                    </div>
                    <div class="flex flex-shrink-0 ml-4">
                        <button
                            class="inline-flex text-gray-400 transition duration-150 ease-in-out focus:outline-none focus:text-gray-500">
                            <x-svg.x class="w-5 h-5"/>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
