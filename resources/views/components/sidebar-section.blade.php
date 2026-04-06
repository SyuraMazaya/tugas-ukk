@props([
    'title',
    'icon' => null,
    'expanded' => true,
])

<div x-data="{ expanded: {{ json_encode($expanded) }} }" class="mb-6">
    <!-- Section Header (Optional Collapsible) -->
    <button 
        @click="expanded = !expanded"
        class="w-full flex items-center justify-between px-3 mb-3 group hover:opacity-80 transition-opacity duration-200"
    >
        <div class="flex items-center gap-2 flex-1">
            @if($icon)
                <div class="flex-shrink-0 w-4 h-4 rounded flex items-center justify-center bg-gradient-to-br from-indigo-500/30 to-purple-500/30 text-indigo-300 text-xs">
                    {!! $icon !!}
                </div>
            @endif
            <span class="text-xs font-bold text-slate-300 uppercase tracking-widest leading-none">{{ $title }}</span>
        </div>
        <svg 
            :class="expanded ? 'rotate-180' : ''"
            class="w-4 h-4 text-slate-500 transition-transform duration-300 flex-shrink-0" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7-7m0 0L5 14m7-7v12"/>
        </svg>
    </button>

    <!-- Divider -->
    <div class="px-3 mb-2.5">
        <div class="h-px bg-gradient-to-r from-slate-700/0 via-slate-600/50 to-slate-700/0"></div>
    </div>

    <!-- Section Content -->
    <div
        x-show="expanded"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="space-y-1 px-0"
    >
        {{ $slot }}
    </div>
</div>