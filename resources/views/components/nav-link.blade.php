@props([
    'href',
    'active' => false,
    'icon' => null,
])

@php
    $classes = $active
        ? 'relative flex items-center px-3 py-2 text-white bg-indigo-500/15 rounded-lg font-medium transition-all duration-150 border-l-2 border-indigo-500'
        : 'relative flex items-center px-3 py-2 text-slate-400 hover:text-slate-300 hover:bg-slate-700/40 rounded-lg font-medium transition-all duration-150 border-l-2 border-transparent';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes . ' mb-1 group']) }}>
    @if($icon)
        <span class="mr-2.5 flex-shrink-0 p-1 rounded-md {{ $active ? 'bg-indigo-500/30 text-indigo-200' : 'bg-slate-600/30 text-slate-400 group-hover:bg-slate-500/30 group-hover:text-slate-300' }} transition-all duration-150 flex items-center justify-center" style="width: 20px; height: 20px;">{!! $icon !!}</span>
    @endif
    <span class="truncate flex-1 text-sm">{{ $slot }}</span>
</a>