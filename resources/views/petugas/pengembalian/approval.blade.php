<x-layouts.app title="Approval Pengembalian">
    <x-slot:sidebar>
        @include('partials.petugas-sidebar')
    </x-slot:sidebar>

    <div class="mb-8">
        <nav class="flex items-center text-sm text-slate-500 mb-4">
            <a href="{{ route('petugas.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('petugas.pengembalian.index') }}" class="hover:text-indigo-600 transition-colors">Approval Pengembalian</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-slate-700 font-medium">Detail Approval</span>
        </nav>

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Approval Pengembalian</h1>
                <p class="mt-1 text-slate-500">Peminjaman #{{ str_pad($pengembalian->peminjaman->id_peminjaman, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
            <x-badge :status="$pengembalian->status" />
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="text-lg font-semibold text-slate-800">Informasi Pengembalian</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Peminjam</p>
                    <p class="mt-1 text-sm font-semibold text-slate-800">{{ $pengembalian->peminjaman->user->name }}</p>
                    <p class="text-xs text-slate-500">{{ $pengembalian->peminjaman->user->username }}</p>
                </div>

                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Kembali Diajukan</p>
                    <p class="mt-1 text-sm font-semibold text-slate-800">{{ $pengembalian->tanggal_kembali_real->format('d M Y') }}</p>
                </div>

                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Estimasi Denda</p>
                    <p class="mt-1 text-sm font-semibold {{ $estimatedDenda > 0 ? 'text-rose-700' : 'text-emerald-700' }}">
                        Rp {{ number_format($estimatedDenda, 0, ',', '.') }}
                    </p>
                </div>

                @if($pengembalian->catatan_peminjam)
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <p class="text-xs font-semibold text-blue-700 uppercase tracking-wider">Catatan Peminjam</p>
                        <p class="mt-1 text-sm text-blue-800">{{ $pengembalian->catatan_peminjam }}</p>
                    </div>
                @endif

                <div class="border-t border-slate-200 pt-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Alat Dipinjam</p>
                    <div class="space-y-2">
                        @foreach($pengembalian->peminjaman->detailPeminjaman as $detail)
                            <div class="flex items-center justify-between bg-slate-50 rounded-lg px-3 py-2">
                                <span class="text-sm text-slate-700">{{ $detail->alat->nama_alat }}</span>
                                <span class="text-xs font-semibold text-slate-500">{{ $detail->jumlah }} unit</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="text-lg font-semibold text-slate-800">Aksi Approval</h3>
            </div>

            <div class="p-6">
                @if($pengembalian->isMenungguApproval())
                    <form method="POST" action="{{ route('petugas.pengembalian.approval.store', $pengembalian->id) }}">
                        @csrf

                        <div class="space-y-5">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Keputusan Approval</label>
                                <select name="status_approval" class="w-full px-4 py-3 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                                    <option value="selesai">Setujui Tanpa Denda (Clear)</option>
                                    <option value="menunggu_pembayaran">Perlu Pembayaran Denda</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Nominal Denda</label>
                                <input
                                    type="number"
                                    name="custom_denda"
                                    min="0"
                                    step="1000"
                                    placeholder="{{ number_format($estimatedDenda, 0, '', '') }}"
                                    class="w-full px-4 py-3 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500"
                                >
                                <p class="mt-1 text-xs text-slate-400">Kosongkan untuk gunakan estimasi otomatis.</p>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Kondisi Alat</label>
                                <div class="space-y-3">
                                    @foreach($pengembalian->peminjaman->detailPeminjaman as $detail)
                                        <div class="bg-slate-50 rounded-xl p-4">
                                            <p class="text-sm font-medium text-slate-800 mb-3">{{ $detail->alat->nama_alat }}</p>
                                            <div class="flex flex-wrap gap-2">
                                                <label class="inline-flex items-center">
                                                    <input type="radio" name="kondisi_alat[{{ $detail->alat_id }}]" value="baik" class="mr-1.5">
                                                    <span class="text-sm text-slate-700">Baik</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="radio" name="kondisi_alat[{{ $detail->alat_id }}]" value="rusak_ringan" class="mr-1.5">
                                                    <span class="text-sm text-slate-700">Rusak Ringan</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="radio" name="kondisi_alat[{{ $detail->alat_id }}]" value="rusak" class="mr-1.5">
                                                    <span class="text-sm text-slate-700">Rusak</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Catatan Kondisi</label>
                                <textarea name="catatan_kondisi" rows="3" class="w-full px-4 py-3 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500" placeholder="Catatan kondisi alat saat dicek petugas"></textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Catatan Approval</label>
                                <textarea name="catatan_approval" rows="3" class="w-full px-4 py-3 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500" placeholder="Alasan jika perlu pembayaran denda"></textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-100">
                            <a href="{{ route('petugas.pengembalian.index') }}" class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                                Kembali
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors">
                                Simpan Approval
                            </button>
                        </div>
                    </form>
                @elseif($pengembalian->isMenungguVerifikasiPembayaran())
                    <div class="space-y-4">
                        <div class="bg-slate-50 rounded-xl p-4">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Metode Pembayaran</p>
                            <p class="mt-1 text-sm font-semibold text-slate-800">{{ $pengembalian->metode_pembayaran_label }}</p>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-4">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Nominal Denda</p>
                            <p class="mt-1 text-sm font-semibold text-rose-700">Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</p>
                        </div>

                        @if($pengembalian->bukti_pembayaran)
                            <div>
                                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Bukti Pembayaran</p>
                                <img src="{{ asset('storage/' . $pengembalian->bukti_pembayaran) }}" alt="Bukti pembayaran" class="w-full rounded-xl border border-slate-200">
                            </div>
                        @endif

                        <form method="POST" action="{{ route('petugas.pengembalian.verifikasi-pembayaran', $pengembalian->id) }}">
                            @csrf
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Catatan Verifikasi</label>
                                <textarea name="catatan_approval" rows="3" class="w-full px-4 py-3 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500" placeholder="Catatan jika pembayaran ditolak atau ada klarifikasi"></textarea>
                            </div>

                            <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-slate-100">
                                <a href="{{ route('petugas.pengembalian.index') }}" class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                                    Kembali
                                </a>
                                <button type="submit" name="aksi" value="tolak" class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-white bg-rose-600 rounded-xl hover:bg-rose-700 transition-colors">
                                    Tolak Pembayaran
                                </button>
                                <button type="submit" name="aksi" value="setujui" class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors">
                                    Setujui Pembayaran
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-14 h-14 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-slate-700 font-semibold">Workflow sudah selesai</p>
                        <a href="{{ route('petugas.pengembalian.show', $pengembalian->id) }}" class="inline-flex items-center mt-4 px-4 py-2 text-sm font-semibold text-indigo-600 border border-indigo-200 rounded-lg hover:bg-indigo-50">
                            Lihat Detail
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
