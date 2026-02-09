@props([
    'label' => '',
    'name',
    'options' => [],
    'selected' => '',
    'required' => false,
    'placeholder' => 'Pilih...',
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
    
    <div class="relative">
        <select 
            name="{{ $name }}"
            id="{{ $name }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'w-full px-4 py-2.5 border rounded-lg shadow-sm text-slate-700 bg-white transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 appearance-none cursor-pointer ' . ($errors->has($name) ? 'border-rose-300 bg-rose-50/50' : 'border-slate-200 hover:border-slate-300')]) }}
        >
            <option value="" class="text-slate-400">{{ $placeholder }}</option>
            @foreach($options as $value => $label)
                <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>
    
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