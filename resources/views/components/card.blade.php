@props([
    'title' => '',
    'description' => '',
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm ring-1 ring-slate-200/50 overflow-hidden']) }}>
    @if($title)
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h3 class="text-base font-semibold text-slate-800">{{ $title }}</h3>
            @if($description)
                <p class="mt-1 text-sm text-slate-500">{{ $description }}</p>
            @endif
        </div>
    @endif
    
    <div class="p-6">
        {{ $slot }}
    </div>
    
    @if(isset($footer))
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
            {{ $footer }}
        </div>
    @endif
</div>