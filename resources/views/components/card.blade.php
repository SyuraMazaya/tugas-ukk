@props([
    'title' => '',
    'description' => '',
    'padding' => true,
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm ring-1 ring-slate-200/60 overflow-hidden hover:shadow-md transition-shadow duration-300']) }}>
    @if($title)
        <div class="px-6 py-4 border-b border-slate-100 bg-gradient-to-r from-slate-50/80 to-white">
            <h3 class="text-base font-bold text-slate-800">{{ $title }}</h3>
            @if($description)
                <p class="mt-1 text-sm text-slate-500">{{ $description }}</p>
            @endif
        </div>
    @endif
    
    <div class="{{ $padding ? 'p-6' : '' }}">
        {{ $slot }}
    </div>
    
    @if(isset($footer))
        <div class="px-6 py-4 bg-gradient-to-r from-slate-50/80 to-white border-t border-slate-100">
            {{ $footer }}
        </div>
    @endif
</div>