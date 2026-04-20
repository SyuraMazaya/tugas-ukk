@props([
    'status',
    'size' => 'sm',
])

@php
    $classes = match($status) {
        'pending' => 'bg-gradient-to-r from-amber-50 to-orange-50 text-amber-700 ring-amber-500/30 shadow-amber-500/10',
        'disetujui' => 'bg-gradient-to-r from-emerald-50 to-green-50 text-emerald-700 ring-emerald-500/30 shadow-emerald-500/10',
        'menunggu_approval' => 'bg-gradient-to-r from-amber-50 to-orange-50 text-amber-700 ring-amber-500/30 shadow-amber-500/10',
        'menunggu_pembayaran' => 'bg-gradient-to-r from-rose-50 to-pink-50 text-rose-700 ring-rose-500/30 shadow-rose-500/10',
        'menunggu_verifikasi_pembayaran' => 'bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 ring-blue-500/30 shadow-blue-500/10',
        'dipinjam' => 'bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 ring-blue-500/30 shadow-blue-500/10',
        'ditolak' => 'bg-gradient-to-r from-rose-50 to-red-50 text-rose-700 ring-rose-500/30 shadow-rose-500/10',
        'selesai' => 'bg-gradient-to-r from-slate-50 to-gray-50 text-slate-600 ring-slate-400/30 shadow-slate-500/10',
        'batal' => 'bg-gradient-to-r from-slate-100 to-gray-100 text-slate-500 ring-slate-400/20 shadow-slate-500/10',
        'baik' => 'bg-gradient-to-r from-emerald-50 to-green-50 text-emerald-700 ring-emerald-500/30 shadow-emerald-500/10',
        'rusak_ringan' => 'bg-gradient-to-r from-amber-50 to-orange-50 text-amber-700 ring-amber-500/30 shadow-amber-500/10',
        'rusak' => 'bg-gradient-to-r from-rose-50 to-red-50 text-rose-700 ring-rose-500/30 shadow-rose-500/10',
        default => 'bg-gradient-to-r from-slate-50 to-gray-50 text-slate-600 ring-slate-400/30 shadow-slate-500/10',
    };
    
    $sizeClasses = match($size) {
        'xs' => 'px-2 py-0.5 text-[10px]',
        'sm' => 'px-2.5 py-1 text-xs',
        'md' => 'px-3 py-1.5 text-sm',
        default => 'px-2.5 py-1 text-xs',
    };
    
    $icons = [
        'pending' => '<span class="relative flex h-2 w-2 mr-1.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span></span>',
        'disetujui' => '<svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>',
        'menunggu_approval' => '<span class="relative flex h-2 w-2 mr-1.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span></span>',
        'menunggu_pembayaran' => '<svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V7m0 1v8m0 0v1"/></svg>',
        'menunggu_verifikasi_pembayaran' => '<svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        'dipinjam' => '<svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>',
        'ditolak' => '<svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>',
        'selesai' => '<svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>',
        'batal' => '<svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>',
        'baik' => '<svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>',
        'rusak_ringan' => '<svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
        'rusak' => '<svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>',
    ];
    
    $labels = [
        'pending' => 'Menunggu',
        'disetujui' => 'Disetujui',
        'menunggu_approval' => 'Menunggu Approval',
        'menunggu_pembayaran' => 'Menunggu Pembayaran',
        'menunggu_verifikasi_pembayaran' => 'Menunggu Verifikasi',
        'dipinjam' => 'Dipinjam',
        'ditolak' => 'Ditolak',
        'selesai' => 'Selesai',
        'batal' => 'Dibatalkan',
        'baik' => 'Baik',
        'rusak_ringan' => 'Rusak Ringan',
        'rusak' => 'Rusak',
    ];
@endphp

<span class="inline-flex items-center {{ $sizeClasses }} rounded-full font-semibold ring-1 ring-inset shadow-sm {{ $classes }}">
    @if(isset($icons[$status]))
        {!! $icons[$status] !!}
    @endif
    {{ $labels[$status] ?? ucfirst(str_replace('_', ' ', $status)) }}
</span>