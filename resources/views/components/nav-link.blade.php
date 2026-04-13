@props([
    'href',
    'active' => false,
    'icon' => null,
])

@php
    $classes = $active
        ? 'group relative mb-1.5 flex items-center gap-3 rounded-xl border border-blue-800 bg-blue-900 px-3 py-2.5 text-sm font-semibold text-white shadow-sm transition-all duration-200'
        : 'group relative mb-1.5 flex items-center gap-3 rounded-xl border border-transparent px-3 py-2.5 text-sm font-medium text-blue-200 transition-all duration-200 hover:border-blue-800 hover:bg-blue-900 hover:text-white';

    $iconClasses = $active
        ? 'flex h-8 w-8 shrink-0 items-center justify-center rounded-lg border border-blue-700 bg-blue-800 text-blue-100'
        : 'flex h-8 w-8 shrink-0 items-center justify-center rounded-lg border border-blue-900 bg-blue-900 text-blue-300 transition-colors duration-200 group-hover:border-blue-700 group-hover:bg-blue-800 group-hover:text-blue-100';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if($active)
        <span class="absolute bottom-2 left-0 top-2 w-1 rounded-r bg-blue-300" aria-hidden="true"></span>
    @endif

    @if($icon)
        <span class="{{ $iconClasses }}">{!! $icon !!}</span>
    @endif

    <span class="truncate flex-1">{{ $slot }}</span>

    @if($active)
        <span class="shrink-0" aria-hidden="true">
            <svg class="h-4 w-4 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </span>
    @endif
</a>
