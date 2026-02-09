@props([
    'type' => 'submit',
    'variant' => 'primary',
])

@php
    $classes = match($variant) {
        'primary' => 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-sm hover:shadow focus:ring-indigo-500',
        'secondary' => 'bg-slate-600 hover:bg-slate-700 text-white shadow-sm hover:shadow focus:ring-slate-500',
        'success' => 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm hover:shadow focus:ring-emerald-500',
        'danger' => 'bg-rose-600 hover:bg-rose-700 text-white shadow-sm hover:shadow focus:ring-rose-500',
        'warning' => 'bg-amber-500 hover:bg-amber-600 text-white shadow-sm hover:shadow focus:ring-amber-500',
        'outline' => 'bg-white border border-slate-300 hover:bg-slate-50 hover:border-slate-400 text-slate-700 focus:ring-indigo-500',
        'ghost' => 'bg-transparent hover:bg-slate-100 text-slate-600 hover:text-slate-900 focus:ring-slate-500',
        default => 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-sm hover:shadow focus:ring-indigo-500',
    };
@endphp

<button 
    type="{{ $type }}"
    {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-4 py-2.5 rounded-lg font-semibold text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-150 disabled:opacity-50 disabled:cursor-not-allowed ' . $classes]) }}
>
    {{ $slot }}
</button>