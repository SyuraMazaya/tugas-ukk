<x-layouts.app title="Riwayat Peminjaman">
    <x-slot:sidebar>
        @include('partials.peminjam-sidebar')
    </x-slot:sidebar>

    @php
        $totalData = $peminjamans->total();
        $shownData = $peminjamans->count();
        $pendingOnPage = $peminjamans->where('status', 'pending')->count();
        $disetujuiOnPage = $peminjamans->where('status', 'disetujui')->count();
    @endphp

    <!-- Header Banner -->
    <div class="mb-6 rounded-2xl border border-indigo-200/60 bg-gradient-to-r from-indigo-500 via-blue-500 to-cyan-500 px-5 py-6 shadow-lg shadow-indigo-300/30 sm:px-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white sm:text-3xl">Riwayat Peminjaman</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Pantau status, keterlambatan, dan detail peminjaman Anda dalam satu halaman.</p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                @if(filled($status))
                    <span class="inline-flex items-center rounded-xl border border-white/30 bg-white/15 px-3 py-2 text-sm font-semibold text-white">Filter: {{ ucfirst($status) }}</span>
                @endif
                <a href="{{ route('peminjam.peminjaman.create') }}" class="inline-flex items-center rounded-xl border border-white/35 bg-white/20 px-4 py-2.5 text-sm font-semibold text-white transition-all hover:-translate-y-0.5 hover:bg-white/25">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                    </svg>
                    Ajukan Peminjaman
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-indigo-200 bg-gradient-to-br from-indigo-50 to-blue-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-indigo-700">Total Data</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalData }}</p>
            <p class="mt-1 text-xs text-slate-500">Keseluruhan histori</p>
        </div>

        <div class="rounded-xl border border-cyan-200 bg-gradient-to-br from-cyan-50 to-sky-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-cyan-700">Ditampilkan</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $shownData }}</p>
            <p class="mt-1 text-xs text-slate-500">Data halaman aktif</p>
        </div>

        <div class="rounded-xl border border-amber-200 bg-gradient-to-br from-amber-50 to-orange-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-amber-700">Menunggu</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $pendingOnPage }}</p>
            <p class="mt-1 text-xs text-slate-500">Belum diproses petugas</p>
        </div>

        <div class="rounded-xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-teal-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Disetujui</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $disetujuiOnPage }}</p>
            <p class="mt-1 text-xs text-slate-500">Masih/baru dipinjam</p>
        </div>
    </div>

    <!-- Filter + Search -->
    <x-card class="mb-6 border border-indigo-100 bg-gradient-to-r from-indigo-50/70 via-white to-cyan-50/70 shadow-sm">
        <form method="GET" class="grid grid-cols-1 gap-4 lg:grid-cols-12">
            <div class="lg:col-span-6">
                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-600">Filter Status</label>
                <select name="status" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-700 shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                    <option value="disetujui" {{ $status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ $status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="selesai" {{ $status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="lg:col-span-6 lg:self-end">
                <div class="flex flex-wrap gap-2">
                    <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition-all hover:from-indigo-700 hover:to-blue-700">
                        <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Terapkan Filter
                    </button>

                    @if(filled($status))
                        <a href="{{ route('peminjam.peminjaman.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition-colors hover:bg-slate-50">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <div class="relative mt-4">
            <svg class="absolute left-4 top-3 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
                type="text"
                id="search-input"
                placeholder="Cari nomor peminjaman, status, atau nama alat di halaman ini..."
                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-11 text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
            />
            <button id="clear-search" class="absolute right-3 top-3 hidden text-slate-400 transition-colors hover:text-slate-600" title="Hapus pencarian" type="button">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </x-card>

    <!-- Peminjaman List -->
    <div class="space-y-4" id="peminjaman-list">
        @forelse($peminjamans as $peminjaman)
            @php
                $alatKeywords = $peminjaman->detailPeminjaman->pluck('alat.nama_alat')->filter()->implode(' ');
                $statusLabel = ucfirst($peminjaman->status);
            @endphp
            <x-card
                class="peminjaman-item border border-slate-100 transition-shadow hover:shadow-md"
                data-id="{{ strtolower(str_pad($peminjaman->id_peminjaman, 6, '0', STR_PAD_LEFT)) }}"
                data-status="{{ strtolower($statusLabel) }}"
                data-alat="{{ strtolower($alatKeywords) }}"
            >
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="mb-2 flex flex-wrap items-center gap-3">
                            <x-badge :status="$peminjaman->status" />
                            <span class="rounded bg-slate-100 px-2 py-0.5 font-mono text-sm text-slate-500">#{{ str_pad($peminjaman->id_peminjaman, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        <h3 class="font-semibold text-slate-800">{{ $peminjaman->detailPeminjaman->count() }} alat dipinjam</h3>

                        <p class="mt-1 flex flex-wrap items-center gap-1 text-sm text-slate-500">
                            <span class="inline-flex items-center">
                                <svg class="mr-1 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10" />
                                </svg>
                                {{ $peminjaman->tanggal_pinjam->format('d M Y') }}
                            </span>
                            <span class="text-slate-300">|</span>
                            <span class="inline-flex items-center">
                                <svg class="mr-1 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                                </svg>
                                Kembali: {{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}
                            </span>
                        </p>

                        @if($peminjaman->status === 'disetujui' && $peminjaman->tanggal_kembali_rencana->isPast())
                            @php
                                $lateDuration = formatLateDuration($peminjaman->tanggal_kembali_rencana);
                                $estimatedDenda = hitungDendaKeterlambatan(
                                    $lateDuration['days'],
                                    $lateDuration['hours'],
                                    $lateDuration['minutes']
                                );
                            @endphp
                            <div class="mt-2 inline-flex items-center rounded-lg bg-rose-50 px-3 py-1 text-sm font-medium text-rose-700" data-return-date="{{ $peminjaman->tanggal_kembali_rencana->toIso8601String() }}" data-denda-rate="{{ getTarifDendaAktif() }}">
                                <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span class="late-duration">Terlambat {{ $lateDuration['formatted'] }}</span>
                                <span class="ml-2 text-rose-600">(Est. denda: <span class="late-fine">Rp {{ number_format($estimatedDenda, 0, ',', '.') }}</span>)</span>
                            </div>
                        @endif

                        @if($peminjaman->pengembalian)
                            <div class="mt-2 inline-flex items-center rounded-lg bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700">
                                <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                                </svg>
                                Dikembalikan: {{ $peminjaman->pengembalian->tanggal_kembali_real->format('d M Y') }}
                                @if($peminjaman->pengembalian->denda > 0)
                                    <span class="ml-2 text-rose-600">(Denda: Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }})</span>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="shrink-0">
                        <a href="{{ route('peminjam.peminjaman.show', $peminjaman->id_peminjaman) }}" class="inline-flex items-center rounded-lg border border-indigo-200 px-4 py-2 text-sm font-medium text-indigo-600 transition-colors hover:bg-indigo-50">
                            <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Detail
                        </a>
                    </div>
                </div>

                <div class="mt-4 border-t border-slate-100 pt-4">
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">Alat Dipinjam</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($peminjaman->detailPeminjaman->take(3) as $detail)
                            <span class="inline-flex items-center rounded-lg bg-slate-100 px-3 py-1 text-sm text-slate-700">
                                {{ $detail->alat->nama_alat }}
                                <span class="ml-1.5 rounded bg-slate-200 px-1.5 py-0.5 text-xs text-slate-600">{{ $detail->jumlah }}</span>
                            </span>
                        @endforeach
                        @if($peminjaman->detailPeminjaman->count() > 3)
                            <span class="inline-flex items-center rounded-lg bg-slate-100 px-3 py-1 text-sm text-slate-500">+{{ $peminjaman->detailPeminjaman->count() - 3 }} lainnya</span>
                        @endif
                    </div>
                </div>
            </x-card>
        @empty
            <x-card class="border border-slate-100 shadow-sm">
                <div class="py-16 text-center">
                    <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-slate-100">
                        <svg class="h-10 w-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <p class="mb-1 text-lg font-medium text-slate-700">Belum ada peminjaman</p>
                    <p class="mb-6 text-slate-500">Mulai dengan mengajukan peminjaman pertama Anda.</p>
                    <a href="{{ route('peminjam.peminjaman.create') }}" class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-indigo-700">
                        <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                        </svg>
                        Ajukan Peminjaman Pertama
                    </a>
                </div>
            </x-card>
        @endforelse
    </div>

    <div id="no-results" class="mt-4 hidden rounded-xl border border-slate-200 bg-white px-4 py-12 text-center shadow-sm">
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-indigo-100">
            <svg class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <p class="mb-1 font-medium text-slate-600">Tidak ada hasil pencarian</p>
        <p class="text-sm text-slate-400">Gunakan kata kunci lain untuk mencari data pada halaman ini.</p>
    </div>

    @if($peminjamans->hasPages())
        <div class="mt-6">
            {{ $peminjamans->appends(request()->query())->links() }}
        </div>
    @endif

    @push('scripts')
    <script>
        const searchInput = document.getElementById('search-input');
        const clearSearchBtn = document.getElementById('clear-search');
        const noResults = document.getElementById('no-results');
        const loanItems = document.querySelectorAll('.peminjaman-item');

        function runLocalSearch() {
            if (!searchInput || loanItems.length === 0) {
                return;
            }

            const keyword = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            loanItems.forEach((item) => {
                const id = item.dataset.id || '';
                const status = item.dataset.status || '';
                const alat = item.dataset.alat || '';
                const match = keyword === '' || id.includes(keyword) || status.includes(keyword) || alat.includes(keyword);

                if (match) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (noResults) {
                noResults.classList.toggle('hidden', visibleCount !== 0 || keyword === '');
            }
        }

        if (searchInput && clearSearchBtn) {
            searchInput.addEventListener('input', function() {
                clearSearchBtn.classList.toggle('hidden', this.value === '');
                runLocalSearch();
            });

            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                clearSearchBtn.classList.add('hidden');
                runLocalSearch();
                searchInput.focus();
            });
        }

        // Realtime late duration and fine calculator
        function updateLateDurations() {
            const lateElements = document.querySelectorAll('[data-return-date]');
            
            lateElements.forEach(element => {
                const returnDate = new Date(element.dataset.returnDate);
                const dendaRate = parseFloat(element.dataset.dendaRate);
                const now = new Date();
                
                if (now <= returnDate) return;
                
                // Calculate difference
                const diff = now - returnDate;
                const totalMinutes = Math.floor(diff / 60000);
                const totalHours = Math.floor(totalMinutes / 60);
                const days = Math.floor(totalHours / 24);
                const hours = totalHours % 24;
                const minutes = totalMinutes % 60;
                
                // Format duration
                let formatted = [];
                if (days > 0) formatted.push(days + ' hari');
                if (hours > 0) formatted.push(hours + ' jam');
                if (minutes > 0) formatted.push(minutes + ' menit');
                
                const durationText = formatted.length > 0 ? formatted.join(' ') : '0 menit';
                
                // Calculate fine (per jam, dibulatkan ke atas)
                const dendaPerJam = dendaRate / 24;
                const totalJamCeiling = Math.ceil((days * 24) + hours + (minutes / 60));
                const estimatedFine = totalJamCeiling * dendaPerJam;
                
                // Update DOM
                const durationSpan = element.querySelector('.late-duration');
                const fineSpan = element.querySelector('.late-fine');
                
                if (durationSpan) {
                    durationSpan.textContent = 'Terlambat ' + durationText;
                }
                
                if (fineSpan) {
                    fineSpan.textContent = 'Rp ' + Math.round(estimatedFine).toLocaleString('id-ID');
                }
            });
        }
        
        // Update immediately
        updateLateDurations();
        
        // Update every minute for real-time tracking
        setInterval(updateLateDurations, 60000);
    </script>
    @endpush
</x-layouts.app>