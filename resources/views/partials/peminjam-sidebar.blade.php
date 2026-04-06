@php
    $menuIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>';
    $katalogIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>';
    $peminjamanIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>';
    $sectionIcon = '<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/></svg>';

@endphp

<!-- User Profile Card -->
<div class="mx-2 mb-6 p-3 bg-gradient-to-br from-slate-700/60 to-slate-800/70 rounded-xl border border-slate-600/40 backdrop-blur-sm hover:border-slate-600/60 transition-all duration-300 shadow-lg">
    <div class="flex items-center gap-3">
        <div class="flex-shrink-0">
            <div class="w-11 h-11 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm ring-2 ring-indigo-400/60 shadow-lg">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-xs font-bold text-white truncate leading-tight">{{ Auth::user()->name }}</p>
            <p class="text-xs text-indigo-200 font-medium leading-tight mt-0.5">{{ ucfirst(Auth::user()->role->name) }}</p>
        </div>
        <div class="flex-shrink-0">
            <span class="inline-flex items-center px-2 py-1 rounded-md bg-emerald-500/20 text-emerald-300 text-xs font-semibold ring-1 ring-emerald-500/40 whitespace-nowrap">
                <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full mr-1.5 animate-pulse"></span>
                Aktif
            </span>
        </div>
    </div>
</div>

<!-- Main Menu Section -->
<x-sidebar-section title="Menu" :icon="$sectionIcon" :expanded="true">
    <x-nav-link href="{{ route('peminjam.dashboard') }}" :active="request()->routeIs('peminjam.dashboard')" :icon="$menuIcon">
        Dashboard
    </x-nav-link>

    <x-nav-link href="{{ route('peminjam.katalog') }}" :active="request()->routeIs('peminjam.katalog')" :icon="$katalogIcon">
        Katalog Alat
    </x-nav-link>

    <x-nav-link href="{{ route('peminjam.peminjaman.index') }}" :active="request()->routeIs('peminjam.peminjaman.*')" :icon="$peminjamanIcon">
        Peminjaman Saya
    </x-nav-link>
</x-sidebar-section>