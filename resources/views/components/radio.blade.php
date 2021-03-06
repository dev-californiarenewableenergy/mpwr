@props(['name', 'value', 'label', 'checked'])

<div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <input id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" type="radio" {{ $checked == $value ? 'checked' : '' }}
           class="form-radio h-4 w-4 text-green-base transition duration-150 ease-in-out"/>
    <label for="{{ $name }}" class="ml-2 block text-sm leading-5 text-gray-900">
        {{ $label }}
    </label>
</div>