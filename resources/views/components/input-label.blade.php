@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-gray-500']) }}>
    {{ $value ?? $slot }}
</label>
