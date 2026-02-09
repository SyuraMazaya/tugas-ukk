@props([
    'label' => '',
    'name',
    'value' => '',
    'required' => false,
    'rows' => 3,
    'placeholder' => '',
    'hint' => '',
])

<div class="mb-5">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-slate-700 mb-2">
            {{ $label }}
            @if($required)
                <span class="text-rose-500 ml-0.5">*</span>
            @endif
        </label>
    @endif
    
    <textarea 
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-4 py-2.5 border rounded-lg shadow-sm text-slate-700 placeholder-slate-400 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 resize-none ' . ($errors->has($name) ? 'border-rose-300 bg-rose-50/50' : 'border-slate-200 hover:border-slate-300')]) }}
    >{{ old($name, $value) }}</textarea>
    
    @if($hint)
        <p class="mt-1.5 text-xs text-slate-500">{{ $hint }}</p>
    @endif
    
    @error($name)
        <p class="mt-1.5 text-sm text-rose-600 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ $message }}
        </p>
    @enderror
</div>