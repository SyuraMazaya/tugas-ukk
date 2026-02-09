@props([
    'value' => 0,
    'label' => '',
    'icon' => null,
    'color' => 'blue',
])

@php
    $colorClasses = match($color) {
        'blue' => 'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-blue-500/30',
        'green' => 'bg-gradient-to-br from-emerald-500 to-emerald-600 text-white shadow-emerald-500/30',
        'yellow' => 'bg-gradient-to-br from-amber-400 to-amber-500 text-white shadow-amber-500/30',
        'red' => 'bg-gradient-to-br from-rose-500 to-rose-600 text-white shadow-rose-500/30',
        'purple' => 'bg-gradient-to-br from-violet-500 to-violet-600 text-white shadow-violet-500/30',
        default => 'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-blue-500/30',
    };
    
    $ringColor = match($color) {
        'blue' => 'ring-blue-100',
        'green' => 'ring-emerald-100',
        'yellow' => 'ring-amber-100',
        'red' => 'ring-rose-100',
        'purple' => 'ring-violet-100',
        default => 'ring-blue-100',
    };
@endphp

<div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200/50 p-6 hover:shadow-md transition-smooth">
    <div class="flex items-center">
        <div class="flex-shrink-0 p-3 rounded-xl {{ $colorClasses }} shadow-lg ring-4 {{ $ringColor }}">
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
                    @default
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                @endswitch
            @endif
        </div>
        <div class="ml-5 flex-1 min-w-0">
            <p class="text-sm font-medium text-slate-500 truncate">{{ $label }}</p>
            <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $value }}</p>
        </div>
    </div>
</div>