@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
