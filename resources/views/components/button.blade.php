@props([
    'type' => 'submit',
    'variant' => 'primary',
    'size' => 'md',
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-semibold focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed transform active:scale-[0.98]';
    
    $sizeClasses = match($size) {
        'xs' => 'px-2.5 py-1.5 text-xs rounded-md',
        'sm' => 'px-3 py-2 text-sm rounded-lg',
        'md' => 'px-4 py-2.5 text-sm rounded-lg',
        'lg' => 'px-5 py-3 text-base rounded-xl',
        'xl' => 'px-6 py-3.5 text-lg rounded-xl',
        default => 'px-4 py-2.5 text-sm rounded-lg',
    };
    
    $variantClasses = match($variant) {
        'primary' => 'bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white shadow-md shadow-indigo-500/25 hover:shadow-lg hover:shadow-indigo-500/30 focus:ring-indigo-500',
        'secondary' => 'bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-700 hover:to-slate-800 text-white shadow-md shadow-slate-500/25 hover:shadow-lg hover:shadow-slate-500/30 focus:ring-slate-500',
        'success' => 'bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white shadow-md shadow-emerald-500/25 hover:shadow-lg hover:shadow-emerald-500/30 focus:ring-emerald-500',
        'danger' => 'bg-gradient-to-r from-rose-600 to-rose-700 hover:from-rose-700 hover:to-rose-800 text-white shadow-md shadow-rose-500/25 hover:shadow-lg hover:shadow-rose-500/30 focus:ring-rose-500',
        'warning' => 'bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white shadow-md shadow-amber-500/25 hover:shadow-lg hover:shadow-amber-500/30 focus:ring-amber-500',
        'outline' => 'bg-white border-2 border-slate-200 hover:border-indigo-300 hover:bg-indigo-50/50 text-slate-700 hover:text-indigo-700 focus:ring-indigo-500',
        'ghost' => 'bg-transparent hover:bg-slate-100 text-slate-600 hover:text-slate-900 focus:ring-slate-500',
        'outline-danger' => 'bg-white border-2 border-rose-200 hover:border-rose-300 hover:bg-rose-50/50 text-rose-600 hover:text-rose-700 focus:ring-rose-500',
        default => 'bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white shadow-md shadow-indigo-500/25 hover:shadow-lg hover:shadow-indigo-500/30 focus:ring-indigo-500',
    };
@endphp

<button 
    type="{{ $type }}"
    {{ $attributes->merge(['class' => $baseClasses . ' ' . $sizeClasses . ' ' . $variantClasses]) }}
>
    {{ $slot }}
</button>