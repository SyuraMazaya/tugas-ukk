<x-layouts.app title="Manajemen User">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>

    @php
        $selectedRoleId = $roleId ? (int) $roleId : null;
        $activeRole = $selectedRoleId ? $roleStats->firstWhere('id', $selectedRoleId) : null;
        $roleThemes = [
            'all' => [
                'icon' => 'from-fuchsia-500 to-indigo-500',
                'accent' => 'text-fuchsia-700',
                'badge' => 'bg-fuchsia-50 text-fuchsia-700 ring-fuchsia-200',
                'active' => 'border-fuchsia-300 bg-gradient-to-br from-fuchsia-50 to-indigo-50 shadow-md shadow-fuchsia-200/70',
                'idle' => 'border-slate-200 bg-white hover:border-fuchsia-200 hover:bg-gradient-to-br hover:from-fuchsia-50/60 hover:to-indigo-50/60',
            ],
            'admin' => [
                'icon' => 'from-rose-500 to-orange-500',
                'accent' => 'text-rose-700',
                'badge' => 'bg-rose-50 text-rose-700 ring-rose-200',
                'active' => 'border-rose-300 bg-gradient-to-br from-rose-50 to-orange-50 shadow-md shadow-rose-200/70',
                'idle' => 'border-slate-200 bg-white hover:border-rose-200 hover:bg-gradient-to-br hover:from-rose-50/60 hover:to-orange-50/60',
            ],
            'petugas' => [
                'icon' => 'from-sky-500 to-cyan-500',
                'accent' => 'text-sky-700',
                'badge' => 'bg-sky-50 text-sky-700 ring-sky-200',
                'active' => 'border-sky-300 bg-gradient-to-br from-sky-50 to-cyan-50 shadow-md shadow-sky-200/70',
                'idle' => 'border-slate-200 bg-white hover:border-sky-200 hover:bg-gradient-to-br hover:from-sky-50/60 hover:to-cyan-50/60',
            ],
            'peminjam' => [
                'icon' => 'from-emerald-500 to-teal-500',
                'accent' => 'text-emerald-700',
                'badge' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                'active' => 'border-emerald-300 bg-gradient-to-br from-emerald-50 to-teal-50 shadow-md shadow-emerald-200/70',
                'idle' => 'border-slate-200 bg-white hover:border-emerald-200 hover:bg-gradient-to-br hover:from-emerald-50/60 hover:to-teal-50/60',
            ],
            'default' => [
                'icon' => 'from-slate-500 to-slate-600',
                'accent' => 'text-slate-700',
                'badge' => 'bg-slate-100 text-slate-700 ring-slate-200',
                'active' => 'border-slate-300 bg-gradient-to-br from-slate-50 to-slate-100 shadow-md shadow-slate-200/70',
                'idle' => 'border-slate-200 bg-white hover:border-slate-300 hover:bg-gradient-to-br hover:from-slate-50/60 hover:to-slate-100/60',
            ],
        ];
    @endphp

    <!-- Header Banner -->
    <div class="mb-6 rounded-2xl bg-gradient-to-r from-indigo-500 via-blue-500 to-fuchsia-500 px-5 py-6 sm:px-6 border border-indigo-200/50 shadow-lg shadow-indigo-300/30">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="inline-flex items-center gap-2 rounded-full bg-white/20 px-3 py-1 text-xs font-semibold text-white ring-1 ring-white/40">
                    Dashboard User
                </p>
                <h1 class="mt-3 text-2xl font-bold text-white sm:text-3xl">Manajemen User</h1>
                <p class="mt-1 text-sm text-white/85 sm:text-base">
                    Menampilkan {{ $users->total() }} user
                    @if($activeRole)
                        dengan role <span class="font-semibold text-white">{{ ucfirst($activeRole->name) }}</span>
                    @else
                        dari total <span class="font-semibold text-white">{{ $totalUsers }}</span> akun
                    @endif
                </p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center rounded-xl bg-white/15 px-4 py-2.5 text-sm font-semibold text-white border border-white/35 backdrop-blur-sm transition-all hover:-translate-y-0.5 hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/60 focus:ring-offset-2 focus:ring-offset-indigo-500">
                <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah User Baru
            </a>
        </div>
    </div>

    <!-- Role Summary Cards -->
    <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
        @php
            $allTheme = $roleThemes['all'];
            $isAllActive = is_null($selectedRoleId);
        @endphp
        <a href="{{ route('admin.users.index') }}" class="group relative overflow-hidden rounded-xl border p-4 transition-all duration-200 shadow-sm hover:-translate-y-0.5 {{ $isAllActive ? $allTheme['active'] : $allTheme['idle'] }}">
            <div class="absolute -top-8 -right-8 h-20 w-20 rounded-full bg-white/45 blur-2xl"></div>
            <div class="relative flex items-start justify-between gap-3">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">All Users</p>
                    <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalUsers }}</p>
                    <p class="mt-1 text-xs text-slate-500">Semua role pengguna</p>
                </div>
                <div class="h-10 w-10 rounded-lg bg-gradient-to-br {{ $allTheme['icon'] }} text-white shadow-md flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V10a2 2 0 00-2-2h-3M9 20H4V10a2 2 0 012-2h3m0 12V4m0 16h6m-6 0H9m6 0h.01M9 4h6" />
                    </svg>
                </div>
            </div>
            <div class="relative mt-3 inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $allTheme['badge'] }}">
                {{ $isAllActive ? 'Sedang aktif' : 'Klik untuk tampilkan semua' }}
            </div>
        </a>

        @foreach($roleStats as $role)
            @php
                $roleKey = strtolower($role->name);
                $theme = $roleThemes[$roleKey] ?? $roleThemes['default'];
                $isActive = $selectedRoleId === $role->id;
            @endphp
            <a href="{{ route('admin.users.index', ['role_id' => $role->id]) }}" class="group relative overflow-hidden rounded-xl border p-4 transition-all duration-200 shadow-sm hover:-translate-y-0.5 {{ $isActive ? $theme['active'] : $theme['idle'] }}">
                <div class="absolute -top-8 -right-8 h-20 w-20 rounded-full bg-white/45 blur-2xl"></div>
                <div class="relative flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Role</p>
                        <p class="mt-1 text-base font-bold {{ $theme['accent'] }}">{{ ucfirst($role->name) }}</p>
                        <p class="mt-2 text-2xl font-bold text-slate-800">{{ $role->users_count }}</p>
                    </div>
                    <div class="h-10 w-10 rounded-lg bg-gradient-to-br {{ $theme['icon'] }} text-white shadow-md flex items-center justify-center">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A6.962 6.962 0 0112 15c2.074 0 3.938.833 5.286 2.18M15 11a3 3 0 11-6 0 3 3 0 016 0zM19.071 4.929a10 10 0 11-14.142 0 10 10 0 0114.142 0z" />
                        </svg>
                    </div>
                </div>
                <div class="relative mt-3 inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $theme['badge'] }}">
                    {{ $isActive ? 'Sedang aktif' : 'Filter role ini' }}
                </div>
            </a>
        @endforeach
    </div>

    <!-- Search Bar -->
    <x-card class="mb-5 border border-indigo-100 bg-gradient-to-r from-indigo-50/70 via-white to-fuchsia-50/60 shadow-sm">
        <div class="flex flex-col gap-3 lg:flex-row lg:items-center">
            <div id="search-container" class="relative flex-1">
                <svg class="absolute left-4 top-3 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    type="text"
                    id="search-input"
                    placeholder="Cari nama atau username di halaman ini..."
                    class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-11 text-slate-700 shadow-sm transition-colors placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                />
                <button id="clear-search" class="absolute right-3 top-3 hidden text-slate-400 transition-colors hover:text-slate-600" title="Hapus pencarian">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-600 shadow-sm">
                <svg class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>
                    Filter: <strong>{{ $activeRole ? ucfirst($activeRole->name) : 'Semua Role' }}</strong>
                </span>
                @if($activeRole)
                    <a href="{{ route('admin.users.index') }}" class="rounded-md bg-slate-100 px-2 py-0.5 text-xs font-semibold text-slate-700 transition-colors hover:bg-slate-200">
                        Reset
                    </a>
                @endif
            </div>
        </div>
    </x-card>

    <!-- Users Table -->
    <x-card class="overflow-hidden border border-slate-100 shadow-sm">
        <div class="h-1.5 bg-gradient-to-r from-rose-400 via-violet-400 to-cyan-400"></div>
        <div id="table-container" data-active-role="{{ $selectedRoleId ?? '' }}">
            <div class="overflow-x-auto">
                <table class="min-w-full" id="users-table">
                    <thead>
                        <tr class="border-b border-slate-200 bg-gradient-to-r from-slate-50 via-indigo-50/40 to-slate-50">
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">No</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">User</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Username</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Role</th>
                            <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="table-body">
                        @forelse($users as $index => $user)
                            @php
                                $roleBadgeColors = [
                                    'admin' => 'bg-rose-50 text-rose-700 ring-rose-200',
                                    'petugas' => 'bg-sky-50 text-sky-700 ring-sky-200',
                                    'peminjam' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                                ];
                                $avatarGradients = [
                                    'admin' => 'from-rose-500 to-orange-500',
                                    'petugas' => 'from-sky-500 to-cyan-500',
                                    'peminjam' => 'from-emerald-500 to-teal-500',
                                ];
                                $roleName = $user->role->name;
                                $roleBadgeColor = $roleBadgeColors[$roleName] ?? 'bg-slate-100 text-slate-700 ring-slate-200';
                                $avatarGradient = $avatarGradients[$roleName] ?? 'from-slate-500 to-slate-600';
                            @endphp
                            <tr class="user-row transition-colors hover:bg-indigo-50/40" data-user-name="{{ strtolower($user->name) }}" data-user-username="{{ strtolower($user->username) }}" data-user-role="{{ $user->role_id }}">
                                <td class="whitespace-nowrap px-5 py-3.5 text-sm text-slate-500">
                                    {{ $users->firstItem() + $index }}
                                </td>
                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br {{ $avatarGradient }} text-sm font-semibold text-white shadow">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-slate-800">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <span class="rounded-md bg-slate-100 px-2.5 py-1.5 font-mono text-sm text-slate-600">{{ $user->username }}</span>
                                </td>
                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ring-1 ring-inset {{ $roleBadgeColor }}">
                                        {{ ucfirst($roleName) }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-5 py-3.5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="rounded-lg p-2 text-indigo-500 bg-indigo-50/60 transition-colors duration-200 hover:bg-indigo-100 hover:text-indigo-700" title="Edit User">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        @if($user->id !== Auth::id())
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete-btn rounded-lg p-2 text-rose-500 bg-rose-50/60 transition-colors duration-200 hover:bg-rose-100 hover:text-rose-700" title="Hapus User">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-14 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                                            <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                        <p class="mb-1 font-medium text-slate-500">Tidak ada data user</p>
                                        <p class="mb-4 text-sm text-slate-400">Mulai dengan menambahkan user pertama</p>
                                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-indigo-700">
                                            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Tambah User
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- No Results State for Search Filter -->
            <div id="no-results" class="hidden px-5 py-14 text-center">
                <div class="flex flex-col items-center">
                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-amber-100">
                        <svg class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <p class="mb-1 font-medium text-slate-500">Tidak ada hasil pencarian</p>
                    <p class="text-sm text-slate-400">Coba gunakan kata kunci yang berbeda</p>
                </div>
            </div>
        </div>

        @if($users->hasPages())
            <div class="border-t border-slate-100 px-5 py-4">
                {{ $users->links() }}
            </div>
        @endif
    </x-card>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-sm rounded-lg bg-white shadow-xl animate-in">
            <div class="border-b border-slate-100 p-6">
                <h3 class="flex items-center gap-3 text-lg font-bold text-slate-800">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-rose-100">
                        <svg class="h-6 w-6 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 0v2m0-6v-2" />
                        </svg>
                    </div>
                    Hapus User?
                </h3>
            </div>
            <div class="p-6">
                <p class="mb-2 text-slate-600">Yakin ingin menghapus user <strong id="delete-username" class="text-slate-800">ini</strong>?</p>
                <p class="text-sm text-slate-500">Tindakan ini tidak bisa dibatalkan.</p>
            </div>
            <div class="flex justify-end gap-3 border-t border-slate-100 p-6">
                <button type="button" id="cancel-delete" class="rounded-lg border border-slate-300 px-4 py-2 font-semibold text-slate-700 transition-colors hover:bg-slate-50">
                    Batal
                </button>
                <button type="button" id="confirm-delete" class="rounded-lg bg-rose-600 px-4 py-2 font-semibold text-white transition-colors hover:bg-rose-700">
                    Hapus
                </button>
            </div>
        </div>
    </div>

    <!-- Success Toast Notification -->
    <div id="success-toast" class="fixed bottom-4 right-4 z-40 hidden items-center gap-3 rounded-lg bg-emerald-500 px-6 py-4 text-white shadow-lg animate-in">
        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <span id="toast-message">Operasi berhasil</span>
    </div>

    <script>
        // Search by name/username while keeping server-side role filter from selected card.
        const searchInput = document.getElementById('search-input');
        const clearSearchBtn = document.getElementById('clear-search');
        const userRows = document.querySelectorAll('.user-row');
        const noResultsDiv = document.getElementById('no-results');
        const tableBody = document.getElementById('table-body');
        const tableContainer = document.getElementById('table-container');
        const activeRole = tableContainer?.dataset.activeRole ?? '';

        function filterRows() {
            if (!searchInput || userRows.length === 0) {
                return;
            }

            const searchTerm = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            userRows.forEach((row) => {
                const name = row.dataset.userName;
                const username = row.dataset.userUsername;
                const roleId = row.dataset.userRole;

                const matchesSearch = searchTerm === '' || name.includes(searchTerm) || username.includes(searchTerm);
                const matchesRole = activeRole === '' || roleId === activeRole;

                if (matchesSearch && matchesRole) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (visibleCount === 0) {
                tableBody.style.display = 'none';
                noResultsDiv.classList.remove('hidden');
            } else {
                tableBody.style.display = '';
                noResultsDiv.classList.add('hidden');
            }
        }

        if (searchInput && clearSearchBtn) {
            searchInput.addEventListener('input', function() {
                clearSearchBtn.classList.toggle('hidden', this.value === '');
                filterRows();
            });

            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                clearSearchBtn.classList.add('hidden');
                filterRows();
                searchInput.focus();
            });
        }

        // Delete confirmation modal
        const deleteModal = document.getElementById('delete-modal');
        const cancelDeleteBtn = document.getElementById('cancel-delete');
        const confirmDeleteBtn = document.getElementById('confirm-delete');
        const deleteUsername = document.getElementById('delete-username');
        let pendingDeleteForm = null;

        document.querySelectorAll('.delete-btn').forEach((btn) => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                const userName = row.querySelector('td:nth-child(2)').textContent.trim();
                deleteUsername.textContent = userName;
                pendingDeleteForm = this.closest('form');
                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
            });
        });

        cancelDeleteBtn.addEventListener('click', () => {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
            pendingDeleteForm = null;
        });

        confirmDeleteBtn.addEventListener('click', () => {
            if (pendingDeleteForm) {
                pendingDeleteForm.submit();
            }
        });

        deleteModal.addEventListener('click', (e) => {
            if (e.target === deleteModal) {
                cancelDeleteBtn.click();
            }
        });

        @if(session('success'))
            const toast = document.getElementById('success-toast');
            document.getElementById('toast-message').textContent = '{{ session("success") }}';
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 4000);
        @endif
    </script>
</x-layouts.app>