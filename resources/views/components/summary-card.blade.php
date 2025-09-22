@props([
    'title',
    'value',
    'highlight' => 'gray', // green, blue, red, gray
])

@php
    $colorClasses = [
        'green' => 'text-green-600',
        'blue'  => 'text-blue-600',
        'red'   => 'text-red-600',
        'gray'  => 'text-gray-600',
    ];
    $highlightClass = $colorClasses[$highlight] ?? $colorClasses['gray'];
@endphp

<div class="bg-white shadow-sm rounded-lg p-6">
    <h3 class="text-sm font-medium text-gray-500">{{ $title }}</h3>
    <p class="mt-2 text-2xl font-semibold {{ $highlightClass }}">{{ $value }}</p>
    
    @if(trim($slot))
        <div class="mt-1 text-sm text-gray-500">
            {{ $slot }}
        </div>
    @endif
</div>
