@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-sm border-gray-300 focus:border-green-600 focus:ring-opacity-50 px-4 py-1']) !!}>
