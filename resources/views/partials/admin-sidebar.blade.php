@php
    $menuIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>';
    $userIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>';
    $kategoriIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>';
    $alatIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>';
    $dendaIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
    $logIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>';
    $laporanIcon = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>';
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
<x-sidebar-section title="Menu Utama" :icon="$sectionIcon" :expanded="true">
    <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')" :icon="$menuIcon">
        Dashboard
    </x-nav-link>

    <x-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')" :icon="$userIcon">
        Manajemen User
    </x-nav-link>

    <x-nav-link href="{{ route('admin.kategori.index') }}" :active="request()->routeIs('admin.kategori.*')" :icon="$kategoriIcon">
        Manajemen Kategori
    </x-nav-link>

    <x-nav-link href="{{ route('admin.alat.index') }}" :active="request()->routeIs('admin.alat.*')" :icon="$alatIcon">
        Manajemen Alat
    </x-nav-link>

    <x-nav-link href="{{ route('admin.denda.index') }}" :active="request()->routeIs('admin.denda.*')" :icon="$dendaIcon">
        Pengaturan Denda
    </x-nav-link>
</x-sidebar-section>

<!-- Reports Section -->
<x-sidebar-section title="Laporan & Log" :icon="$sectionIcon" :expanded="true">
    <x-nav-link href="{{ route('admin.log-aktivitas.index') }}" :active="request()->routeIs('admin.log-aktivitas.*')" :icon="$logIcon">
        Log Aktivitas
    </x-nav-link>

    <x-nav-link href="{{ route('admin.laporan.index') }}" :active="request()->routeIs('admin.laporan.*')" :icon="$laporanIcon">
        Laporan
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