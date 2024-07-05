@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 text-black focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
