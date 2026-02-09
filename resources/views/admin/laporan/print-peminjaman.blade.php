<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman - SIPINJAM</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; }
        .footer { margin-top: 30px; text-align: right; }
        @media print { body { margin: 20px; } }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PEMINJAMAN ALAT</h1>
        <p>Sistem Peminjaman Alat Produktif Jurusan</p>
        <p>Dicetak: {{ now()->format('d M Y H:i') }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Rencana Kembali</th>
                <th>Alat Dipinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $index => $peminjaman)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $peminjaman->user->name }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                    <td>{{ $peminjaman->tanggal_kembali_rencana->format('d/m/Y') }}</td>
                    <td>
                        @foreach($peminjaman->detailPeminjaman as $detail)
                            {{ $detail->alat->nama_alat }} ({{ $detail->jumlah }})@if(!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>{{ $peminjaman->status_label }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="footer">
        <p>Total: {{ $peminjamans->total() }} data</p>
    </div>
    
    <script>
        window.onload = function() { window.print(); }
    </script>
</body>
</html>