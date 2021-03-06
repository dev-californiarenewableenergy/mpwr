@props(['name', 'label', 'checked', 'disabledToUser'])

@php
    $rand = Str::random(7);
    $disabledToUser = $disabledToUser ?? null;
@endphp

<div {{ $attributes->except(['wire:model', 'v-model'])->merge(['class' => 'flex items-center select-none']) }}>
    <input id="{{ $rand }}-{{ $name }}" name="{{ $name }}" type="checkbox" {{ isset($checked) ? 'checked="checked"' : '' }}
        class="form-checkbox h-4 w-4 text-green-base transition duration-150 ease-in-out" {{ $attributes }}
        @if($disabledToUser && user()->role == $disabledToUser) disabled @endif/>
    <label for="{{ $rand }}-{{ $name }}" class="ml-2 block text-sm leading-5 text-gray-900">
        {{ $label }}
    </label>
</div>
