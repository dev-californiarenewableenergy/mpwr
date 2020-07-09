@props(['name', 'label', 'checked'])

<div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <input id="{{ $name }}" name="{{ $name }}" type="checkbox" {{ $checked ? 'checked' : '' }}
           class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"/>
    <label for="{{ $name }}" class="ml-2 block text-sm leading-5 text-gray-900">
        {{ $label }}
    </label>
</div>
