@props([
    'href',
    'active' => false,
    'icon' => null,
])

@php
    $classes = $active
        ? 'relative flex items-center px-3 py-2.5 text-white bg-gradient-to-r from-indigo-500/20 to-indigo-500/10 hover:from-indigo-500/25 hover:to-indigo-500/15 rounded-lg font-medium transition-all duration-200 border-l-3 border-indigo-500 shadow-sm'
        : 'relative flex items-center px-3 py-2.5 text-slate-300 hover:text-slate-100 hover:bg-slate-700/50 rounded-lg font-medium transition-all duration-200 border-l-3 border-transparent';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes . ' mb-1.5 group']) }}>
    @if($icon)
        <span class="mr-3 flex-shrink-0 p-1.5 rounded-lg {{ $active ? 'bg-indigo-500/40 text-indigo-100 shadow-md' : 'bg-slate-600/40 text-slate-400 group-hover:bg-slate-500/50 group-hover:text-slate-200' }} transition-all duration-200 flex items-center justify-center" style="width: 22px; height: 22px;">{!! $icon !!}</span>
    @endif
    <span class="truncate flex-1 text-sm font-medium">{{ $slot }}</span>
    @if($active)
        <span class="flex-shrink-0 visual-indicator">
            <svg class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
        </span>
    @endif
</a>