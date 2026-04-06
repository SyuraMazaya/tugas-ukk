@props([
    'value' => 0,
    'label' => '',
    'icon' => null,
    'color' => 'blue',
    'trend' => null, // 'up', 'down', or null
    'trendValue' => '',
])

@php
    $colorClasses = match($color) {
        'blue' => 'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30',
        'green' => 'bg-gradient-to-br from-emerald-500 to-emerald-600 text-white shadow-lg shadow-emerald-500/30',
        'yellow' => 'bg-gradient-to-br from-amber-400 to-amber-500 text-white shadow-lg shadow-amber-500/30',
        'red' => 'bg-gradient-to-br from-rose-500 to-rose-600 text-white shadow-lg shadow-rose-500/30',
        'purple' => 'bg-gradient-to-br from-violet-500 to-violet-600 text-white shadow-lg shadow-violet-500/30',
        'indigo' => 'bg-gradient-to-br from-indigo-500 to-indigo-600 text-white shadow-lg shadow-indigo-500/30',
        'cyan' => 'bg-gradient-to-br from-cyan-500 to-cyan-600 text-white shadow-lg shadow-cyan-500/30',
        'pink' => 'bg-gradient-to-br from-pink-500 to-pink-600 text-white shadow-lg shadow-pink-500/30',
        default => 'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30',
    };
    
    $ringColor = match($color) {
        'blue' => 'ring-blue-100',
        'green' => 'ring-emerald-100',
        'yellow' => 'ring-amber-100',
        'red' => 'ring-rose-100',
        'purple' => 'ring-violet-100',
        'indigo' => 'ring-indigo-100',
        'cyan' => 'ring-cyan-100',
        'pink' => 'ring-pink-100',
        default => 'ring-blue-100',
    };
    
    $hoverBg = match($color) {
        'blue' => 'hover:ring-blue-200',
        'green' => 'hover:ring-emerald-200',
        'yellow' => 'hover:ring-amber-200',
        'red' => 'hover:ring-rose-200',
        'purple' => 'hover:ring-violet-200',
        'indigo' => 'hover:ring-indigo-200',
        'cyan' => 'hover:ring-cyan-200',
        'pink' => 'hover:ring-pink-200',
        default => 'hover:ring-blue-200',
    };
@endphp

<div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200/60 p-6 hover:shadow-lg {{ $hoverBg }} transition-all duration-300 group">
    <div class="flex items-center">
        <div class="flex-shrink-0 p-3.5 rounded-xl {{ $colorClasses }} ring-4 {{ $ringColor }} group-hover:scale-105 transition-transform duration-300">
            @if($slot->isNotEmpty())
                {{ $slot }}
            @elseif($icon)
                {!! $icon !!}
            @else
                @switch($color)
                    @case('yellow')
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        @break
                    @case('green')
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        @break
                    @case('purple')
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        @break
                    @case('red')
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        @break
                    @default
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                @endswitch
            @endif
        </div>
        <div class="ml-5 flex-1 min-w-0">
            <p class="text-sm font-medium text-slate-500 truncate">{{ $label }}</p>
            <div class="flex items-baseline gap-2">
                <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $value }}</p>
                @if($trend && $trendValue)
                    <span class="inline-flex items-center text-xs font-medium {{ $trend === 'up' ? 'text-emerald-600' : 'text-rose-600' }}">
                        @if($trend === 'up')
                            <svg class="w-3 h-3 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg class="w-3 h-3 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                        {{ $trendValue }}
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>