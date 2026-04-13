@props([
    'title',
    'icon' => null,
    'expanded' => true,
])

<div x-data="{ expanded: {{ json_encode($expanded) }} }" class="mb-6">
    <button
        @click="expanded = !expanded"
        class="group flex w-full items-center justify-between px-2 py-1"
        type="button"
    >
        <div class="flex min-w-0 items-center gap-2">
            @if($icon)
                <div class="flex h-5 w-5 shrink-0 items-center justify-center rounded border border-blue-800 bg-blue-900 text-blue-300">
                    {!! $icon !!}
                </div>
            @endif
            <span class="truncate text-[11px] font-bold uppercase tracking-[0.16em] text-blue-300">{{ $title }}</span>
        </div>
        <svg
            :class="expanded ? 'rotate-180' : ''"
            class="h-4 w-4 shrink-0 text-blue-400 transition-transform duration-200"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7-7m0 0L5 14m7-7v12" />
        </svg>
    </button>

    <div class="mt-2 border-t border-blue-900"></div>

    <div
        x-show="expanded"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-1"
        class="mt-3 space-y-1"
    >
        {{ $slot }}
    </div>
</div>