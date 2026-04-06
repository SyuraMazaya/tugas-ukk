<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sistem Peminjaman Alat' }} - SIJAMAT-PRO</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        
        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.3);
        }
        
        /* Custom scrollbar for main content */
        main::-webkit-scrollbar {
            width: 8px;
        }
        main::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        main::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        main::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Smooth transitions */
        .transition-smooth {
            transition: all 0.2s ease-in-out;
        }
        
        /* Fade in animation for page content */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.3s ease-out forwards;
        }
        
        /* Table hover effects */
        tbody tr {
            transition: all 0.15s ease;
        }
        
        /* Button press effect */
        .btn-press:active {
            transform: scale(0.98);
        }
        
        /* Card hover lift effect */
        .card-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-lift:hover {
            transform: translateY(-2px);
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
        }
        
        @keyframes skeleton-loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        /* Focus ring improvements */
        .focus-ring:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        
        /* Pulse animation for notifications */
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 1; }
            50% { transform: scale(1); opacity: 0.7; }
            100% { transform: scale(0.95); opacity: 1; }
        }
        
        .pulse-ring {
            animation: pulse-ring 2s ease-in-out infinite;
        }
    </style>
    
    <!-- Notif styles -->
    <style>
        .nav-divider { 
            @apply w-px h-6 bg-slate-200; 
        }
        
        .nav-icon-btn {
            @apply relative p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2;
        }
        
        .notification-pulse::after {
            content: '';
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-radius: 50%;
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            box-shadow: 0 0 8px rgba(239, 68, 68, 0.5);
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-slate-50 min-h-screen antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-slate-800 via-slate-800 to-slate-900 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 shadow-2xl"
        >
            <!-- Top border accent -->
            <div class="h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500"></div>

            <!-- Logo -->
            <div class="flex items-center justify-center h-16 bg-slate-900/70 border-b border-slate-700/60">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group p-2 rounded-lg transition-all duration-300 hover:bg-slate-800/50">
                    <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold shadow-lg">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <span class="text-white text-lg font-bold tracking-tight">SIJAMAT</span>
                        <span class="text-indigo-400 text-xs font-semibold ml-1">PRO</span>
                    </div>
                </a>
            </div>
            
            <!-- Navigation -->
            <nav class="mt-4 px-2.5 sidebar-scroll overflow-y-auto" style="height: calc(100vh - 5rem);">
                {{ $sidebar }}
            </nav>

            <!-- Footer copyright (optional) -->
            <div class="px-4 py-3 border-t border-slate-700/50 text-xs text-slate-500 text-center">
                <p>© 2024 SIJAMAT-PRO</p>
            </div>
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-gradient-to-r from-white to-slate-50 border-b border-slate-200/80 z-10 shadow-sm sticky top-0">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8 gap-4">
                    <!-- Left section: Mobile menu + Breadcrumb -->
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <!-- Mobile menu button -->
                        <button 
                            @click="sidebarOpen = !sidebarOpen"
                            class="lg:hidden p-2.5 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 flex-shrink-0"
                        >
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        <!-- Breadcrumb navigation -->
                        <div class="hidden lg:flex items-center gap-2 text-sm">
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors duration-200 font-medium">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <span>Dashboard</span>
                            </a>
                            <span class="text-slate-400">/</span>
                            <span class="text-slate-600 font-medium truncate">{{ $title ?? 'Dashboard' }}</span>
                        </div>
                    </div>

                    <!-- Right section: Actions + User profile -->
                    <div class="flex items-center justify-end gap-2">
                        <!-- Quick search (hidden on mobile) -->
                        <div class="hidden md:flex items-center relative">
                            <input 
                                type="text"
                                placeholder="Cari..."
                                class="px-4 py-2 pl-10 pr-4 rounded-lg bg-slate-100 border border-slate-200 text-slate-700 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-200 w-56 text-sm"
                            >
                            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>

                        <!-- Divider -->
                        <div class="hidden md:block w-px h-6 bg-slate-200"></div>

                        <!-- Notification button -->
                        <button class="nav-icon-btn notification-pulse">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </button>

                        <!-- Help button -->
                        <button class="nav-icon-btn hidden sm:flex">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </button>

                        <!-- Divider -->
                        <div class="w-px h-6 bg-slate-200"></div>

                        <!-- User dropdown -->
                        <div x-data="{ open: false }" class="relative">
                            <button 
                                @click="open = !open" 
                                @click.away="open = false"
                                class="flex items-center gap-2.5 px-2.5 py-1.5 rounded-lg text-slate-700 hover:bg-slate-100 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >
                                <div class="hidden sm:block text-right">
                                    <p class="text-xs font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-slate-500 leading-none mt-0.5">{{ ucfirst(Auth::user()->role->name) }}</p>
                                </div>
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 text-white text-xs font-bold ring-2 ring-indigo-200/50 flex-shrink-0">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 text-slate-400 transition-transform duration-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            
                            <!-- Dropdown menu -->
                            <div 
                                x-show="open" 
                                x-cloak
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95 -translate-y-2"
                                x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="transform opacity-0 scale-95 -translate-y-2"
                                class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl ring-1 ring-black ring-opacity-20 py-2 z-50 overflow-hidden"
                            >
                                <!-- Profile Info -->
                                <div class="px-4 py-3 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-transparent">
                                    <p class="text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-slate-500 mt-1">{{ Auth::user()->username }}</p>
                                    <p class="text-xs text-indigo-600 font-medium mt-1">{{ ucfirst(Auth::user()->role->name) }}</p>
                                </div>

                                <!-- Menu Items -->
                                <div class="py-2">
                                    <a href="#" class="flex items-center px-4 py-2.5 text-sm text-slate-700 hover:text-slate-900 hover:bg-slate-50 transition-colors duration-150">
                                        <svg class="w-4 h-4 mr-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Pengaturan Akun
                                    </a>

                                    <a href="#" class="flex items-center px-4 py-2.5 text-sm text-slate-700 hover:text-slate-900 hover:bg-slate-50 transition-colors duration-150">
                                        <svg class="w-4 h-4 mr-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                        Bantuan & Dukungan
                                    </a>
                                </div>

                                <!-- Logout -->
                                <div class="py-1 border-t border-slate-100">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 hover:text-red-700 hover:bg-red-50/50 transition-colors duration-150">
                                            <svg class="w-4 h-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                            Keluar dari Sistem
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-slate-50">
                <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
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
            class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden"
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