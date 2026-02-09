<x-layouts.app title="Detail Peminjaman">
    <x-slot:sidebar>
        @include('partials.peminjam-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header -->
    <div class="mb-8">
        <nav class="flex items-center text-sm text-slate-500 mb-4">
            <a href="{{ route('peminjam.peminjaman.index') }}" class="hover:text-indigo-600 transition-colors">Peminjaman</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-slate-700 font-medium">Detail</span>
        </nav>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Detail Peminjaman</h1>
                <p class="mt-1 text-slate-500 font-mono bg-slate-100 inline-flex px-2 py-0.5 rounded">#{{ str_pad($peminjaman->id_peminjaman, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
            <a href="{{ route('peminjam.peminjaman.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Peminjaman Info -->
        <div class="lg:col-span-2">
            <x-card>
                <!-- Status Timeline -->
                <div class="mb-8 px-4">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold
                                        {{ in_array($peminjaman->status, ['pending', 'disetujui', 'selesai']) ? 'bg-indigo-600 text-white' : 'bg-slate-200 text-slate-500' }}">
                                1
                            </div>
                            <span class="mt-2 text-sm font-medium text-slate-600">Diajukan</span>
                        </div>
                        <div class="flex-1 h-1 mx-3 {{ in_array($peminjaman->status, ['disetujui', 'selesai']) ? 'bg-indigo-600' : 'bg-slate-200' }}"></div>
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold
                                        {{ in_array($peminjaman->status, ['disetujui', 'selesai']) ? 'bg-indigo-600 text-white' : ($peminjaman->status === 'ditolak' ? 'bg-rose-600 text-white' : 'bg-slate-200 text-slate-500') }}">
                                2
                            </div>
                            <span class="mt-2 text-sm font-medium text-slate-600">{{ $peminjaman->status === 'ditolak' ? 'Ditolak' : 'Disetujui' }}</span>
                        </div>
                        <div class="flex-1 h-1 mx-3 {{ $peminjaman->status === 'selesai' ? 'bg-emerald-600' : 'bg-slate-200' }}"></div>
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold
                                        {{ $peminjaman->status === 'selesai' ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-500' }}">
                                3
                            </div>
                            <span class="mt-2 text-sm font-medium text-slate-600">Dikembalikan</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 mb-6">
                    <x-badge :status="$peminjaman->status" />
                    @if($peminjaman->status === 'disetujui' && $peminjaman->tanggal_kembali_rencana->isPast())
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-rose-100 text-rose-700">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            TERLAMBAT
                        </span>
                    @endif
                </div>
                
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Pinjam</dt>
                        <dd class="mt-1 text-sm font-medium text-slate-800 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $peminjaman->tanggal_pinjam->format('d M Y') }}
                        </dd>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Rencana Kembali</dt>
                        <dd class="mt-1 text-sm font-medium text-slate-800 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}
                        </dd>
                    </div>
                    @if($peminjaman->petugas)
                        <div class="bg-slate-50 rounded-xl p-4">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Diproses Oleh</dt>
                            <dd class="mt-1 text-sm font-medium text-slate-800">{{ $peminjaman->petugas->name }}</dd>
                        </div>
                    @endif
                    @if($peminjaman->catatan)
                        <div class="bg-slate-50 rounded-xl p-4 sm:col-span-2">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Catatan</dt>
                            <dd class="mt-1 text-sm text-slate-700">{{ $peminjaman->catatan }}</dd>
                        </div>
                    @endif
                </dl>
                
                <!-- Alat List -->
                <div class="mt-8 pt-6 border-t border-slate-100">
                    <h4 class="text-xs font-semibold text-slate-600 uppercase tracking-wider mb-4">Alat yang Dipinjam</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-slate-200">
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama Alat</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Kode</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Kategori</th>
                                    <th class="px-4 py-3 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($peminjaman->detailPeminjaman as $detail)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-4 py-3 text-sm font-medium text-slate-800">{{ $detail->alat->nama_alat }}</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 font-mono">{{ $detail->alat->kode_alat }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-amber-100 text-amber-800">
                                                {{ $detail->alat->kategori->nama_kategori }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-sm font-semibold bg-indigo-100 text-indigo-800">
                                                {{ $detail->jumlah }}
                                            </span>
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
        <div class="lg:col-span-1 space-y-6">
            @if($peminjaman->status === 'pending')
                <x-card>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-800 mb-1">Menunggu Persetujuan</h4>
                        <p class="text-sm text-slate-500">Peminjaman Anda sedang diproses oleh petugas</p>
                    </div>
                </x-card>
            @elseif($peminjaman->status === 'ditolak')
                <x-card>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-800 mb-1">Peminjaman Ditolak</h4>
                        @if($peminjaman->catatan)
                            <p class="text-sm text-slate-500">Alasan: {{ $peminjaman->catatan }}</p>
                        @endif
                    </div>
                </x-card>
            @elseif($peminjaman->status === 'disetujui')
                <x-card>
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-500 to-pink-600 flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-slate-800">Estimasi Denda</h3>
                    </div>
                    
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
                    
                    <div id="denda-realtime" 
                         data-return-date="{{ $peminjaman->tanggal_kembali_rencana->toIso8601String() }}"
                         data-denda-rate="{{ $tarifDenda }}">
                        @if($hasLate)
                            <div class="text-center py-4">
                                <p class="text-3xl font-bold text-rose-600 late-amount">Rp {{ number_format($estimatedDenda, 0, ',', '.') }}</p>
                                <p class="text-sm text-slate-500 mt-2 late-duration">{{ $lateDuration['formatted'] }}</p>
                                <p class="text-xs text-slate-400 mt-1">(Rp {{ number_format($tarifDenda, 0, ',', '.') }}/hari atau Rp {{ number_format($tarifDenda/24, 0, ',', '.') }}/jam)</p>
                            </div>
                            <div class="bg-rose-50 border border-rose-200 rounded-xl p-4 mt-4">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-rose-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <p class="ml-2 text-sm text-rose-800">
                                        Segera kembalikan alat ke petugas untuk menghindari denda yang lebih besar. Denda dihitung per jam dan akan terus bertambah!
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <p class="text-3xl font-bold text-emerald-600">Rp 0</p>
                                <p class="text-sm text-slate-500 mt-2">Belum ada keterlambatan</p>
                            </div>
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mt-4">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="ml-2 text-sm text-blue-800">
                                        Batas pengembalian: {{ $peminjaman->tanggal_kembali_rencana->format('d M Y H:i') }}
                                    </p>
                            </div>
                        </div>
                    @endif
                </x-card>
            @endif
            
            @if($peminjaman->pengembalian)
                <x-card>
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-slate-800">Info Pengembalian</h3>
                    </div>
                    
                    <dl class="space-y-4">
                        <div class="bg-slate-50 rounded-xl p-4">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Kembali</dt>
                            <dd class="mt-1 text-sm font-medium text-slate-800">{{ $peminjaman->pengembalian->tanggal_kembali_real->format('d M Y') }}</dd>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Keterlambatan</dt>
                            <dd class="mt-1 text-sm font-medium {{ $peminjaman->pengembalian->hari_terlambat > 0 ? 'text-rose-600' : 'text-emerald-600' }}">
                                {{ $peminjaman->pengembalian->hari_terlambat }} hari
                            </dd>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Denda</dt>
                            <dd class="mt-1 text-lg font-bold {{ $peminjaman->pengembalian->denda > 0 ? 'text-rose-600' : 'text-emerald-600' }}">
                                Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}
                            </dd>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Diproses Oleh</dt>
                            <dd class="mt-1 text-sm font-medium text-slate-800">{{ $peminjaman->pengembalian->petugas->name }}</dd>
                        </div>
                        @if($peminjaman->pengembalian->catatan_kondisi)
                            <div class="bg-slate-50 rounded-xl p-4">
                                <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kondisi Alat</dt>
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
        // Realtime denda calculator for detail page
        function updateDendaRealtime() {
            const dendaElement = document.getElementById('denda-realtime');
            if (!dendaElement) return;
            
            const returnDate = new Date(dendaElement.dataset.returnDate);
            const dendaRate = parseFloat(dendaElement.dataset.dendaRate);
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
            const amountElement = dendaElement.querySelector('.late-amount');
            const durationElement = dendaElement.querySelector('.late-duration');
            
            if (amountElement) {
                amountElement.textContent = 'Rp ' + Math.round(estimatedFine).toLocaleString('id-ID');
            }
            
            if (durationElement) {
                durationElement.textContent = durationText;
            }
        }
        
        // Update immediately on page load
        updateDendaRealtime();
        
        // Update every minute
        setInterval(updateDendaRealtime, 60000);
    </script>
    @endpush
</x-layouts.app>