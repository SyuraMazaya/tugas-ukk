@php
    $menuIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>';
    $katalogIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>';
    $peminjamanIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>';
    $sectionIcon = '<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/></svg>';

@endphp

<!-- User Profile Card -->
<div class="mx-2 mb-6 rounded-xl border border-blue-800 bg-blue-900 p-3 shadow-sm">
    <div class="flex items-center gap-3">
        <div class="shrink-0">
            <div class="flex h-11 w-11 items-center justify-center rounded-lg border border-blue-600 bg-blue-700 text-sm font-bold text-white">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>
        <div class="flex-1 min-w-0">
            <p class="truncate text-xs font-bold leading-tight text-blue-100">{{ Auth::user()->name }}</p>
            <p class="mt-0.5 text-xs font-medium leading-tight text-blue-300">{{ ucfirst(Auth::user()->role->name) }}</p>
        </div>
        <div class="shrink-0">
            <span class="inline-flex items-center rounded-md border border-blue-700 bg-blue-800 px-2 py-1 text-xs font-semibold text-blue-100 whitespace-nowrap">
                <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-blue-300"></span>
                Online
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

<!-- Footer Branding -->
<div class="mt-auto pt-3 pb-2">
    <div class="mx-2 rounded-lg border border-blue-900 bg-blue-950 px-3 py-2">
        <div class="flex items-center justify-between text-xs">
            <span class="text-xs text-blue-300">SIJAMAT-PRO v1.0</span>
            <span class="text-xs text-blue-400">© 2026</span>
        </div>
        <div class="mt-1.5 flex items-center gap-1 text-blue-400">
            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="text-xs leading-none">Sistem Normal</span>
        </div>
    </div>
</div>