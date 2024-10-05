@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 border-gray-700 bg-gray-900 text-gray-300 focus:border-indigo-500 focus:border-indigo-600 focus:ring-indigo-500 focus:ring-indigo-600 rounded-md shadow-sm']) !!}>
