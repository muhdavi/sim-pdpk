@props(['value'])

<label {{ $attributes->merge(['class' => 'block uppercase font-medium font-bold text-xs text-grey-darker']) }}>
    {{ $value ?? $slot }}
</label>
