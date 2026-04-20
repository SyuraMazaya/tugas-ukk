<x-layouts.app title="Detail Peminjaman">
    <x-slot:sidebar>
        @include('partials.peminjam-sidebar')
    </x-slot:sidebar>

    @php
        $workflowStatus = $peminjaman->hasPengembalianInProgress() ? $peminjaman->pengembalian->status : $peminjaman->status;
    @endphp

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
                <x-badge :status="$workflowStatus" size="md" />
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
        <div class="lg:col-span-2 space-y-6">
            <x-card class="overflow-hidden border border-slate-100 shadow-sm">
                <div class="h-1.5 bg-gradient-to-r from-indigo-400 via-blue-400 to-cyan-500"></div>

                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="rounded-xl bg-slate-50 p-4">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal Pinjam</dt>
                        <dd class="mt-1 text-sm font-medium text-slate-800">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</dd>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Rencana Kembali</dt>
                        <dd class="mt-1 text-sm font-medium text-slate-800">{{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}</dd>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Status Peminjaman</dt>
                        <dd class="mt-1"><x-badge :status="$peminjaman->status" /></dd>
                    </div>

                    @if($peminjaman->pengembalian)
                        <div class="rounded-xl bg-slate-50 p-4">
                            <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Status Pengembalian</dt>
                            <dd class="mt-1"><x-badge :status="$peminjaman->pengembalian->status" /></dd>
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
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($peminjaman->detailPeminjaman as $detail)
                                    <tr class="transition-colors hover:bg-slate-50/50">
                                        <td class="px-4 py-3 text-sm font-medium text-slate-800">{{ $detail->alat->nama_alat }}</td>
                                        <td class="px-4 py-3 font-mono text-sm text-slate-500">{{ $detail->alat->kode_alat }}</td>
                                        <td class="px-4 py-3 text-sm text-slate-700">{{ $detail->jumlah }} unit</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </x-card>
        </div>

        <div class="space-y-6 lg:col-span-1">
            @if($peminjaman->status === 'pending')
                <x-card class="border border-amber-100 shadow-sm">
                    <div class="py-4 text-center">
                        <h4 class="mb-1 font-semibold text-slate-800">Menunggu Persetujuan</h4>
                        <p class="text-sm text-slate-500">Pengajuan Anda sedang diproses petugas.</p>

                        <form method="POST" action="{{ route('peminjam.peminjaman.cancel', $peminjaman->id_peminjaman) }}" class="mt-4" onsubmit="return confirm('Batalkan pengajuan peminjaman ini?')">
                            @csrf
                            <button type="submit" class="inline-flex items-center rounded-lg border border-rose-300 px-4 py-2 text-sm font-semibold text-rose-600 transition-colors hover:bg-rose-50">
                                Batalkan Pengajuan
                            </button>
                        </form>
                    </div>
                </x-card>
            @elseif($peminjaman->status === 'ditolak')
                <x-card class="border border-rose-100 shadow-sm">
                    <div class="py-4 text-center">
                        <h4 class="mb-1 font-semibold text-slate-800">Peminjaman Ditolak</h4>
                        @if($peminjaman->catatan)
                            <p class="text-sm text-slate-500">Alasan: {{ $peminjaman->catatan }}</p>
                        @endif
                    </div>
                </x-card>
            @endif

            @if($peminjaman->status === 'disetujui' && !$peminjaman->pengembalian)
                <x-card class="border border-indigo-100 shadow-sm">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-slate-800">Ajukan Pengembalian</h3>
                        <p class="text-sm text-slate-500 mt-1">Ajukan pengembalian, lalu tunggu approval petugas.</p>
                    </div>

                    <form method="POST" action="{{ route('peminjam.peminjaman.ajukan-pengembalian', $peminjaman->id_peminjaman) }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-2">Tanggal Kembali Real</label>
                            <input type="date" name="tanggal_kembali_real" value="{{ now()->format('Y-m-d') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20" required>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-2">Catatan Pengembalian</label>
                            <textarea name="catatan_peminjam" rows="3" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20" placeholder="Contoh: alat sudah dikembalikan lengkap"></textarea>
                        </div>

                        <button type="submit" class="w-full inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 transition-colors">
                            Kirim Pengajuan Pengembalian
                        </button>
                    </form>
                </x-card>
            @endif

            @if($peminjaman->pengembalian)
                <x-card class="border border-emerald-100 shadow-sm">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-slate-800">Status Pengembalian</h3>
                    </div>

                    <dl class="space-y-3">
                        <div class="rounded-xl bg-slate-50 p-4">
                            <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal Kembali</dt>
                            <dd class="mt-1 text-sm font-medium text-slate-800">{{ $peminjaman->pengembalian->tanggal_kembali_real->format('d M Y') }}</dd>
                        </div>
                        <div class="rounded-xl bg-slate-50 p-4">
                            <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Denda</dt>
                            <dd class="mt-1 text-lg font-bold {{ $peminjaman->pengembalian->denda > 0 ? 'text-rose-600' : 'text-emerald-600' }}">Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}</dd>
                        </div>
                    </dl>

                    @if($peminjaman->pengembalian->status === 'menunggu_approval')
                        <div class="mt-4 rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">
                            Pengembalian sudah diajukan. Menunggu approval petugas.
                        </div>
                    @endif

                    @if($peminjaman->pengembalian->status === 'menunggu_pembayaran')
                        <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50 p-4">
                            <p class="text-sm font-semibold text-rose-800">Pembayaran Denda Diperlukan</p>
                            <p class="text-xs text-rose-700 mt-1">Silakan pilih metode pembayaran tunai atau QRIS.</p>
                        </div>

                        <form method="POST" action="{{ route('peminjam.peminjaman.pembayaran-denda', $peminjaman->id_peminjaman) }}" enctype="multipart/form-data" class="mt-4 space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-2">Metode Pembayaran</label>
                                <select name="metode_pembayaran" id="metode_pembayaran" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20" required>
                                    <option value="tunai">Tunai</option>
                                    <option value="qris">QRIS</option>
                                </select>
                            </div>

                            <div id="qris-example" class="rounded-xl bg-slate-50 p-4 text-center hidden">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-600 mb-3">Contoh QRIS</p>
                                <svg width="150" height="150" viewBox="0 0 150 150" class="mx-auto">
                                    <!-- QR Code Pattern -->
                                    <rect width="150" height="150" fill="white"/>
                                    
                                    <!-- Top-left finder pattern -->
                                    <rect x="10" y="10" width="40" height="40" fill="black"/>
                                    <rect x="15" y="15" width="30" height="30" fill="white"/>
                                    <rect x="20" y="20" width="20" height="20" fill="black"/>
                                    
                                    <!-- Top-right finder pattern -->
                                    <rect x="100" y="10" width="40" height="40" fill="black"/>
                                    <rect x="105" y="15" width="30" height="30" fill="white"/>
                                    <rect x="110" y="20" width="20" height="20" fill="black"/>
                                    
                                    <!-- Bottom-left finder pattern -->
                                    <rect x="10" y="100" width="40" height="40" fill="black"/>
                                    <rect x="15" y="105" width="30" height="30" fill="white"/>
                                    <rect x="20" y="110" width="20" height="20" fill="black"/>
                                    
                                    <!-- Timing patterns -->
                                    <line x1="50" y1="25" x2="90" y2="25" stroke="black" stroke-width="2"/>
                                    <line x1="25" y1="50" x2="25" y2="90" stroke="black" stroke-width="2"/>
                                    
                                    <!-- Data area with random pattern -->
                                    <rect x="55" y="55" width="50" height="50" fill="white" stroke="black" stroke-width="1"/>
                                    <rect x="60" y="60" width="8" height="8" fill="black"/>
                                    <rect x="75" y="60" width="8" height="8" fill="black"/>
                                    <rect x="90" y="60" width="8" height="8" fill="black"/>
                                    <rect x="60" y="75" width="8" height="8" fill="black"/>
                                    <rect x="90" y="75" width="8" height="8" fill="black"/>
                                    <rect x="60" y="90" width="8" height="8" fill="black"/>
                                    <rect x="75" y="90" width="8" height="8" fill="black"/>
                                    <rect x="90" y="90" width="8" height="8" fill="black"/>
                                </svg>
                                <p class="text-xs text-slate-500 mt-2">Pindai dengan aplikasi pembayaran Anda</p>
                            </div>

                            <div id="bukti-pembayaran-field" class="hidden">
                                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-2">Upload Screenshot Pembayaran</label>
                                <input type="file" name="bukti_pembayaran" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                            </div>

                            <button type="submit" class="w-full inline-flex items-center justify-center rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-rose-700 transition-colors">
                                Kirim Pembayaran Denda
                            </button>
                        </form>
                    @endif

                    @if($peminjaman->pengembalian->status === 'menunggu_verifikasi_pembayaran')
                        <div class="mt-4 rounded-xl border border-blue-200 bg-blue-50 p-4 text-sm text-blue-800">
                            Pembayaran denda sudah dikirim. Menunggu verifikasi petugas.
                        </div>

                        @if($peminjaman->pengembalian->bukti_pembayaran)
                            <div class="mt-3">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Bukti Pembayaran</p>
                                <img src="{{ asset('storage/' . $peminjaman->pengembalian->bukti_pembayaran) }}" alt="Bukti pembayaran" class="w-full rounded-xl border border-slate-200">
                            </div>
                        @endif
                    @endif

                    @if($peminjaman->pengembalian->status === 'selesai')
                        <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
                            Pengembalian dan denda sudah clear.
                        </div>

                        @if($peminjaman->pengembalian->denda_lunas && in_array($peminjaman->pengembalian->metode_pembayaran, ['tunai', 'qris'], true))
                            <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Pembayaran Berhasil Diverifikasi</p>
                                <p class="mt-2 text-sm text-slate-700">Metode: <span class="font-semibold text-slate-800">{{ $peminjaman->pengembalian->metode_pembayaran_label }}</span></p>
                                <p class="text-sm text-slate-700">Tanggal Bayar: <span class="font-semibold text-slate-800">{{ $peminjaman->pengembalian->tanggal_pembayaran?->format('d M Y H:i') ?? '-' }}</span></p>

                                @if($peminjaman->pengembalian->metode_pembayaran === 'qris' && $peminjaman->pengembalian->bukti_pembayaran)
                                    <div class="mt-3">
                                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Lampiran Bukti QRIS</p>
                                        <img src="{{ asset('storage/' . $peminjaman->pengembalian->bukti_pembayaran) }}" alt="Bukti pembayaran" class="w-full rounded-xl border border-slate-200">
                                    </div>
                                @endif
                            </div>

                            <a href="{{ route('peminjam.peminjaman.pembayaran-pdf', $peminjaman->id_peminjaman) }}" class="mt-4 inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-slate-800">
                                Unduh Bukti Pembayaran PDF
                            </a>
                        @endif
                    @endif
                </x-card>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        const metodePembayaranSelect = document.getElementById('metode_pembayaran');
        const buktiPembayaranField = document.getElementById('bukti-pembayaran-field');
        const qrisExample = document.getElementById('qris-example');

        if (metodePembayaranSelect && buktiPembayaranField) {
            const toggleBuktiField = () => {
                const isQris = metodePembayaranSelect.value === 'qris';
                buktiPembayaranField.classList.toggle('hidden', !isQris);
                qrisExample?.classList.toggle('hidden', !isQris);
            };

            metodePembayaranSelect.addEventListener('change', toggleBuktiField);
            toggleBuktiField();
        }
    </script>
    @endpush
</x-layouts.app>
