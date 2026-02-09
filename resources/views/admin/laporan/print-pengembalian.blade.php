<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengembalian - SIJAMAT-PRO</title>
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
        <h1>LAPORAN PENGEMBALIAN ALAT</h1>
        <p>Sistem Peminjaman Alat Produktif Jurusan</p>
        <p>Dicetak: {{ now()->format('d M Y H:i') }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Tanggal Kembali</th>
                <th>Denda</th>
                <th>Petugas</th>
                <th>Catatan Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @php $totalDenda = 0; @endphp
            @forelse($pengembalians as $index => $pengembalian)
                @php $totalDenda += $pengembalian->denda; @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pengembalian->peminjaman->user->name }}</td>
                    <td>{{ $pengembalian->tanggal_kembali_real->format('d/m/Y') }}</td>
                    <td>Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
                    <td>{{ $pengembalian->petugas->name }}</td>
                    <td>{{ $pengembalian->catatan_kondisi ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="footer">
        <p>Total Pengembalian: {{ $pengembalians->total() }}</p>
        <p><strong>Total Denda: Rp {{ number_format($totalDenda, 0, ',', '.') }}</strong></p>
    </div>
    
    <script>
        window.onload = function() { window.print(); }
    </script>
</body>
</html>