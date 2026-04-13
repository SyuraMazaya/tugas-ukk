<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sistem Peminjaman Alat' }} - SIJAMAT-PRO</title>
    
    <!-- Tailwind CSS via CDN (v3) -->
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }

        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: #102a4d;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #33598b;
            border-radius: 9999px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: #3f6ba5;
        }

        .main-scroll::-webkit-scrollbar {
            width: 8px;
        }

        .main-scroll::-webkit-scrollbar-track {
            background: #e2e8f0;
        }

        .main-scroll::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 9999px;
        }

        .main-scroll::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
    </style>
    
    @stack('styles')
</head>
@php
    $userRole = strtolower((string) (Auth::user()->role->name ?? ''));
    $dashboardRoute = 'admin.dashboard';

    if ($userRole === 'petugas') {
        $dashboardRoute = 'petugas.dashboard';
    } elseif ($userRole === 'peminjam') {
        $dashboardRoute = 'peminjam.dashboard';
    }
@endphp
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <div
        x-data="{ sidebarOpen: false, userMenuOpen: false }"
        @keydown.escape.window="sidebarOpen = false; userMenuOpen = false"
        class="flex h-screen overflow-hidden"
    >
        
        <!-- Sidebar -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-72 border-r border-blue-900 bg-blue-950 shadow-xl transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
        >
            <!-- Logo -->
            <div class="flex h-16 items-center gap-3 border-b border-blue-900 px-4">
                <a href="{{ route($dashboardRoute) }}" class="flex min-w-0 items-center gap-3">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-blue-600 bg-blue-700 text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-bold tracking-wide text-blue-100">SIJAMAT-PRO</p>
                        <p class="truncate text-[11px] font-medium text-blue-300">Sistem Peminjaman Alat</p>
                    </div>
                </a>

                <button
                    @click="sidebarOpen = false"
                    class="ml-auto rounded-lg p-1.5 text-blue-300 transition hover:bg-blue-900 hover:text-white lg:hidden"
                    type="button"
                    aria-label="Tutup sidebar"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Navigation -->
            <nav class="sidebar-scroll flex h-[calc(100vh-4rem)] flex-col overflow-y-auto px-3 py-4">
                {{ $sidebar }}
            </nav>
        </aside>
        
        <!-- Main Content -->
        <div class="flex min-w-0 flex-1 flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="sticky top-0 z-20 border-b border-slate-200 bg-white shadow-sm">
                <div class="flex h-16 items-center gap-3 px-4 sm:px-6 lg:px-8">
                    <!-- Mobile menu button -->
                    <button 
                        @click="sidebarOpen = !sidebarOpen"
                        class="rounded-lg p-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500 lg:hidden"
                        type="button"
                        aria-label="Buka sidebar"
                    >
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-[11px] font-semibold uppercase tracking-[0.18em] text-blue-700">
                            {{ ucfirst($userRole ?: 'pengguna') }}
                        </p>
                        <h1 class="truncate text-base font-semibold text-slate-900 sm:text-lg">
                            {{ $title ?? 'Dashboard' }}
                        </h1>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-3">
                        <span class="hidden rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 md:inline-flex">
                            {{ now()->translatedFormat('d M Y') }}
                        </span>
                    
                        <!-- User dropdown -->
                        <div class="relative">
                            <button
                                @click="userMenuOpen = !userMenuOpen"
                                class="flex items-center gap-2 rounded-lg border border-slate-200 px-2.5 py-1.5 text-left transition hover:border-slate-300 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                type="button"
                                aria-label="Buka menu pengguna"
                            >
                                <div class="hidden sm:block">
                                    <p class="max-w-36 truncate text-xs font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                                    <p class="max-w-36 truncate text-[11px] text-slate-500">{{ ucfirst(Auth::user()->role->name) }}</p>
                                </div>
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg border border-blue-600 bg-blue-700 text-xs font-bold text-white">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                                <svg :class="userMenuOpen ? 'rotate-180' : ''" class="h-4 w-4 text-slate-500 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div
                                x-show="userMenuOpen"
                                @click.away="userMenuOpen = false"
                                x-cloak
                                x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0 -translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-1"
                                class="absolute right-0 mt-2 w-64 overflow-hidden rounded-xl border border-slate-200 bg-white py-2 shadow-lg"
                            >
                                <div class="border-b border-slate-100 px-4 py-3">
                                    <p class="text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                                    <p class="mt-1 text-xs text-slate-500">{{ Auth::user()->username ?? '-' }}</p>
                                    <span class="mt-2 inline-flex rounded-full border border-blue-200 bg-blue-50 px-2.5 py-1 text-[11px] font-semibold text-blue-700">
                                        {{ ucfirst(Auth::user()->role->name) }}
                                    </span>
                                </div>

                                <div class="px-2 pt-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex w-full items-center rounded-lg px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100 hover:text-slate-900">
                                            <svg class="mr-2 h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="main-scroll flex-1 overflow-y-auto bg-slate-100">
                <div class="mx-auto w-full max-w-7xl p-4 sm:p-6 lg:p-8">
                <!-- Flash Messages -->
                @if(session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif
                
                @if(session('error'))
                    <x-alert type="error" :message="session('error')" />
                @endif
                
                {{ $slot }}
                </div>
            </main>
        </div>
        
        <!-- Mobile sidebar overlay -->
        <div 
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-cloak
            class="fixed inset-0 z-40 bg-slate-900/50 lg:hidden"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        ></div>
    </div>
    
    @stack('scripts')
</body>
</html>