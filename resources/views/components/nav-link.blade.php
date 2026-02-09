@props([
    'href',
    'active' => false,
    'icon' => null,
])

@php
    $classes = $active
        ? 'relative flex items-center px-3 py-2 text-white bg-gradient-to-r from-indigo-600 to-indigo-500 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200 border border-indigo-500/50'
        : 'relative flex items-center px-3 py-2 text-slate-300 hover:text-white hover:bg-slate-700/60 rounded-lg font-medium transition-all duration-200 hover:translate-x-0.5';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes . ' mb-1 group']) }}>
    @if($icon)
        <span class="mr-2.5 flex-shrink-0 p-1 rounded-md {{ $active ? 'bg-indigo-500/40 text-indigo-100' : 'bg-slate-600/40 text-slate-300 group-hover:bg-slate-500/50 group-hover:text-slate-100' }} transition-all duration-200 flex items-center justify-center" style="width: 20px; height: 20px;">{!! $icon !!}</span>
    @endif
    <span class="truncate flex-1 text-sm">{{ $slot }}</span>
    @if($active)
        <span class="ml-auto flex items-center gap-1.5">
            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
        </span>
    @endif
</a>