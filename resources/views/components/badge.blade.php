@props([
    'status',
])

@php
    $classes = match($status) {
        'pending' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
        'disetujui' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
        'dipinjam' => 'bg-blue-50 text-blue-700 ring-blue-600/20',
        'ditolak' => 'bg-rose-50 text-rose-700 ring-rose-600/20',
        'selesai' => 'bg-slate-100 text-slate-700 ring-slate-600/10',
        'batal' => 'bg-slate-100 text-slate-500 ring-slate-600/10',
        'baik' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
        'rusak_ringan' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
        default => 'bg-slate-100 text-slate-600 ring-slate-600/10',
    };
    
    $icons = [
        'pending' => '<svg class="w-3 h-3" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>',
        'disetujui' => '<svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>',
        'dipinjam' => '<svg class="w-3 h-3" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>',
        'ditolak' => '<svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>',
        'selesai' => '<svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>',
        'baik' => '<svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>',
    ];
    
    $labels = [
        'pending' => 'Menunggu',
        'disetujui' => 'Disetujui',
        'dipinjam' => 'Dipinjam',
        'ditolak' => 'Ditolak',
        'selesai' => 'Selesai',
        'batal' => 'Dibatalkan',
        'baik' => 'Baik',
        'rusak_ringan' => 'Rusak Ringan',
    ];
@endphp

<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold ring-1 ring-inset {{ $classes }}">
    @if(isset($icons[$status]))
        {!! $icons[$status] !!}
    @endif
    {{ $labels[$status] ?? ucfirst(str_replace('_', ' ', $status)) }}
</span>