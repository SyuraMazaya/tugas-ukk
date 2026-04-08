<x-layouts.app title="Detail Peminjaman">
    <x-slot:sidebar>
        @include('partials.peminjam-sidebar')
    </x-slot:sidebar>

    @php
        $isLate = $peminjaman->status === 'disetujui' && $peminjaman->tanggal_kembali_rencana->isPast();
    @endphp

    <!-- Header Banner -->
    <div class="mb-6 rounded-2xl border border-indigo-200/60 bg-gradient-to-r from-indigo-500 via-blue-500 to-cyan-500 px-5 py-6 shadow-lg shadow-indigo-300/30 sm:px-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <nav class="mb-3 flex items-center text-sm text-white/85">
                    <a href="{{ route('peminjam.peminjaman.index') }}" class="font-medium transition-colors hover:text-white">Peminjaman</a>
                    <svg class="mx-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="font-semibold text-white">Detail</span>
                </nav>
                <h1 class="text-2xl font-bold text-white sm:text-3xl">Detail Peminjaman</h1>
                <p class="mt-1 inline-flex rounded bg-white/15 px-2.5 py-1 font-mono text-sm text-white ring-1 ring-white/30">#{{ str_pad($peminjaman->id_peminjaman, 6, '0', STR_PAD_LEFT) }}</p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <x-badge :status="$peminjaman->status" size="md" />
                <a href="{{ route('peminjam.peminjaman.index') }}" class="inline-flex items-center rounded-xl border border-white/35 bg-white/20 px-4 py-2.5 text-sm font-semibold text-white transition-all hover:-translate-y-0.5 hover:bg-white/25">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <x-card class="overflow-hidden border border-slate-100 shadow-sm">
                <div class="h-1.5 bg-gradient-to-r from-indigo-400 via-blue-400 to-cyan-500"></div>

                <!-- Status Timeline -->
                <div class="mb-8 px-2 pt-2">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col items-center">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full font-semibold {{ in_array($peminjaman->status, ['pending', 'disetujui', 'selesai']) ? 'bg-indigo-600 text-white' : 'bg-slate-200 text-slate-500' }}">1</div>
                            <span class="mt-2 text-xs font-semibold text-slate-600 sm:text-sm">Diajukan</span>
                        </div>

                        <div class="mx-2 h-1 flex-1 {{ in_array($peminjaman->status, ['disetujui', 'selesai']) ? 'bg-indigo-600' : 'bg-slate-200' }}"></div>

                        <div class="flex flex-col items-center">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full font-semibold {{ in_array($peminjaman->status, ['disetujui', 'selesai']) ? 'bg-indigo-600 text-white' : ($peminjaman->status === 'ditolak' ? 'bg-rose-600 text-white' : 'bg-slate-200 text-slate-500') }}">2</div>
                            <span class="mt-2 text-xs font-semibold text-slate-600 sm:text-sm">{{ $peminjaman->status === 'ditolak' ? 'Ditolak' : 'Diproses' }}</span>
                        </div>

                        <div class="mx-2 h-1 flex-1 {{ $peminjaman->status === 'selesai' ? 'bg-emerald-600' : 'bg-slate-200' }}"></div>

                        <div class="flex flex-col items-center">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full font-semibold {{ $peminjaman->status === 'selesai' ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-500' }}">3</div>
                            <span class="mt-2 text-xs font-semibold text-slate-600 sm:text-sm">Selesai</span>
                        </div>
                    </div>
                </div>

                @if($isLate)
                    <div class="mb-6 inline-flex items-center rounded-lg bg-rose-100 px-2.5 py-1 text-xs font-semibold text-rose-700">
                        <svg class="mr-1 h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        TERLAMBAT
                    </div>
                @endif

                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="rounded-xl bg-slate-50 p-4">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal Pinjam</dt>
                        <dd class="mt-1 text-sm font-medium text-slate-800">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</dd>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Rencana Kembali</dt>
                        <dd class="mt-1 text-sm font-medium text-slate-800">{{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}</dd>
                    </div>

                    @if($peminjaman->petugas)
                        <div class="rounded-xl bg-slate-50 p-4">
                            <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Diproses Oleh</dt>
                            <dd class="mt-1 text-sm font-medium text-slate-800">{{ $peminjaman->petugas->name }}</dd>
                        </div>
                    @endif

                    @if($peminjaman->catatan)
                        <div class="rounded-xl bg-slate-50 p-4 sm:col-span-2">
                            <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Catatan</dt>
                            <dd class="mt-1 text-sm text-slate-700">{{ $peminjaman->catatan }}</dd>
                        </div>
                    @endif
                </dl>

                <div class="mt-8 border-t border-slate-100 pt-6">
                    <h4 class="mb-4 text-xs font-semibold uppercase tracking-wider text-slate-600">Alat yang Dipinjam</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50/80">
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Nama Alat</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Kode</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Kategori</th>
                                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider text-slate-600">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($peminjaman->detailPeminjaman as $detail)
                                    <tr class="transition-colors hover:bg-slate-50/50">
                                        <td class="px-4 py-3 text-sm font-medium text-slate-800">{{ $detail->alat->nama_alat }}</td>
                                        <td class="px-4 py-3 font-mono text-sm text-slate-500">{{ $detail->alat->kode_alat }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center rounded-md bg-amber-100 px-2 py-0.5 text-xs font-medium text-amber-800">{{ $detail->alat->kategori->nama_kategori }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="inline-flex items-center rounded-lg bg-indigo-100 px-2.5 py-1 text-sm font-semibold text-indigo-800">{{ $detail->jumlah }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </x-card>
        </div>

        <!-- Side Info -->
        <div class="space-y-6 lg:col-span-1">
            @if($peminjaman->status === 'pending')
                <x-card class="border border-amber-100 shadow-sm">
                    <div class="py-4 text-center">
                        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-amber-100">
                            <svg class="h-8 w-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                            </svg>
                        </div>
                        <h4 class="mb-1 font-semibold text-slate-800">Menunggu Persetujuan</h4>
                        <p class="text-sm text-slate-500">Petugas sedang meninjau pengajuan Anda.</p>

                        <form method="POST" action="{{ route('peminjam.peminjaman.cancel', $peminjaman->id_peminjaman) }}" class="mt-4" onsubmit="return confirm('Batalkan pengajuan peminjaman ini?')">
                            @csrf
                            <button type="submit" class="inline-flex items-center rounded-lg border border-rose-300 px-4 py-2 text-sm font-semibold text-rose-600 transition-colors hover:bg-rose-50">
                                <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Batalkan Pengajuan
                            </button>
                        </form>
                    </div>
                </x-card>
            @elseif($peminjaman->status === 'ditolak')
                <x-card class="border border-rose-100 shadow-sm">
                    <div class="py-4 text-center">
                        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-rose-100">
                            <svg class="h-8 w-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <h4 class="mb-1 font-semibold text-slate-800">Peminjaman Ditolak</h4>
                        @if($peminjaman->catatan)
                            <p class="text-sm text-slate-500">Alasan: {{ $peminjaman->catatan }}</p>
                        @endif
                    </div>
                </x-card>
            @elseif($peminjaman->status === 'disetujui')
                @php
                    $lateDuration = formatLateDuration($peminjaman->tanggal_kembali_rencana);
                    $tarifDenda = getTarifDendaAktif();
                    $estimatedDenda = hitungDendaKeterlambatan(
                        $lateDuration['days'],
                        $lateDuration['hours'],
                        $lateDuration['minutes']
                    );
                    $hasLate = $lateDuration['days'] > 0 || $lateDuration['hours'] > 0 || $lateDuration['minutes'] > 0;
                @endphp

                <x-card class="border border-rose-100 shadow-sm">
                    <div class="mb-4 flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-rose-500 to-pink-600 text-white">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-slate-800">Estimasi Denda</h3>
                    </div>

                    <div id="denda-realtime" data-return-date="{{ $peminjaman->tanggal_kembali_rencana->toIso8601String() }}" data-denda-rate="{{ $tarifDenda }}">
                        @if($hasLate)
                            <div class="py-3 text-center">
                                <p class="late-amount text-3xl font-bold text-rose-600">Rp {{ number_format($estimatedDenda, 0, ',', '.') }}</p>
                                <p class="late-duration mt-2 text-sm text-slate-500">{{ $lateDuration['formatted'] }}</p>
                                <p class="mt-1 text-xs text-slate-400">(Rp {{ number_format($tarifDenda, 0, ',', '.') }}/hari atau Rp {{ number_format($tarifDenda / 24, 0, ',', '.') }}/jam)</p>
                            </div>

                            <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50 p-4">
                                <div class="flex items-start">
                                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <p class="ml-2 text-sm text-rose-800">Segera kembalikan alat ke petugas agar denda tidak terus bertambah.</p>
                                </div>
                            </div>
                        @else
                            <div class="py-3 text-center">
                                <p class="text-3xl font-bold text-emerald-600">Rp 0</p>
                                <p class="mt-2 text-sm text-slate-500">Belum ada keterlambatan</p>
                            </div>

                            <div class="mt-4 rounded-xl border border-blue-200 bg-blue-50 p-4">
                                <div class="flex items-start">
                                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01" />
                                    </svg>
                                    <p class="ml-2 text-sm text-blue-800">Batas pengembalian: {{ $peminjaman->tanggal_kembali_rencana->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </x-card>
            @endif

            @if($peminjaman->pengembalian)
                <x-card class="border border-emerald-100 shadow-sm">
                    <div class="mb-4 flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-slate-800">Info Pengembalian</h3>
                    </div>

                    <dl class="space-y-3">
                        <div class="rounded-xl bg-slate-50 p-4">
                            <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal Kembali</dt>
                            <dd class="mt-1 text-sm font-medium text-slate-800">{{ $peminjaman->pengembalian->tanggal_kembali_real->format('d M Y') }}</dd>
                        </div>
                        <div class="rounded-xl bg-slate-50 p-4">
                            <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Keterlambatan</dt>
                            <dd class="mt-1 text-sm font-medium {{ $peminjaman->pengembalian->hari_terlambat > 0 ? 'text-rose-600' : 'text-emerald-600' }}">{{ $peminjaman->pengembalian->hari_terlambat }} hari</dd>
                        </div>
                        <div class="rounded-xl bg-slate-50 p-4">
                            <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Denda</dt>
                            <dd class="mt-1 text-lg font-bold {{ $peminjaman->pengembalian->denda > 0 ? 'text-rose-600' : 'text-emerald-600' }}">Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}</dd>
                        </div>
                        <div class="rounded-xl bg-slate-50 p-4">
                            <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Diproses Oleh</dt>
                            <dd class="mt-1 text-sm font-medium text-slate-800">{{ $peminjaman->pengembalian->petugas->name }}</dd>
                        </div>
                        @if($peminjaman->pengembalian->catatan_kondisi)
                            <div class="rounded-xl bg-slate-50 p-4">
                                <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Kondisi Alat</dt>
                                <dd class="mt-1 text-sm text-slate-700">{{ $peminjaman->pengembalian->catatan_kondisi }}</dd>
                            </div>
                        @endif
                    </dl>
                </x-card>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        function updateDendaRealtime() {
            const dendaElement = document.getElementById('denda-realtime');
            if (!dendaElement) return;

            const returnDate = new Date(dendaElement.dataset.returnDate);
            const dendaRate = parseFloat(dendaElement.dataset.dendaRate);
            const now = new Date();

            if (now <= returnDate) return;

            const diff = now - returnDate;
            const totalMinutes = Math.floor(diff / 60000);
            const totalHours = Math.floor(totalMinutes / 60);
            const days = Math.floor(totalHours / 24);
            const hours = totalHours % 24;
            const minutes = totalMinutes % 60;

            let formatted = [];
            if (days > 0) formatted.push(days + ' hari');
            if (hours > 0) formatted.push(hours + ' jam');
            if (minutes > 0) formatted.push(minutes + ' menit');

            const durationText = formatted.length > 0 ? formatted.join(' ') : '0 menit';

            const dendaPerJam = dendaRate / 24;
            const totalJamCeiling = Math.ceil((days * 24) + hours + (minutes / 60));
            const estimatedFine = totalJamCeiling * dendaPerJam;

            const amountElement = dendaElement.querySelector('.late-amount');
            const durationElement = dendaElement.querySelector('.late-duration');

            if (amountElement) {
                amountElement.textContent = 'Rp ' + Math.round(estimatedFine).toLocaleString('id-ID');
            }

            if (durationElement) {
                durationElement.textContent = durationText;
            }
        }

        updateDendaRealtime();

        setInterval(updateDendaRealtime, 60000);
    </script>
    @endpush
</x-layouts.app>