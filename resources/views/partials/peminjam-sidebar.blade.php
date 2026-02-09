@php
    $menuIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>';
    $katalogIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>';
    $peminjamanIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>';
@endphp

<!-- User Profile Card -->
<div class="mx-2 mb-4 p-2.5 bg-gradient-to-br from-slate-700/50 to-slate-800/50 rounded-lg border border-slate-600/30 backdrop-blur-sm">
    <div class="flex items-center gap-2">
        <div class="flex-shrink-0">
            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm ring-2 ring-indigo-400/50 shadow-md">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-xs font-semibold text-white truncate">{{ Auth::user()->name }}</p>
            <p class="text-xs text-indigo-300 font-medium leading-tight">{{ ucfirst(Auth::user()->role->name) }}</p>
        </div>
        <div class="flex-shrink-0">
            <span class="inline-flex items-center px-1.5 py-0.5 rounded-md bg-green-500/20 text-green-400 text-xs font-medium ring-1 ring-green-500/30 whitespace-nowrap">
                <span class="w-1 h-1 bg-green-400 rounded-full mr-1 animate-pulse"></span>
                Aktif
            </span>
        </div>
    </div>
</div>

<!-- Main Menu Section -->
<div class="mb-6">
    <div class="flex items-center gap-2 px-3 mb-2.5">
        <div class="flex-1">
            <p class="text-xs font-bold text-slate-300 uppercase tracking-wide leading-none">Menu</p>
        </div>
        <div class="w-1 h-1 rounded-full bg-gradient-to-r from-indigo-500 to-blue-500"></div>
    </div>
    
    <x-nav-link href="{{ route('peminjam.dashboard') }}" :active="request()->routeIs('peminjam.dashboard')" :icon="$menuIcon">
        Dashboard
    </x-nav-link>

    <x-nav-link href="{{ route('peminjam.katalog') }}" :active="request()->routeIs('peminjam.katalog')" :icon="$katalogIcon">
        Katalog Alat
    </x-nav-link>

    <x-nav-link href="{{ route('peminjam.peminjaman.index') }}" :active="request()->routeIs('peminjam.peminjaman.*')" :icon="$peminjamanIcon">
        Peminjaman Saya
    </x-nav-link>
</div>

<!-- Footer Branding -->
<div class="mt-auto pt-3 pb-2">
    <div class="mx-2 px-3 py-2 bg-slate-700/30 rounded-lg border border-slate-600/20">
        <div class="flex items-center justify-between text-xs">
            <span class="text-slate-400 text-xs">SIPINJAM v1.0</span>
            <span class="text-slate-500 text-xs">© 2026</span>
        </div>
        <div class="mt-1.5 flex items-center gap-1 text-slate-500">
            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="text-xs leading-none">Sistem Normal</span>
        </div>
    </div>
</div>