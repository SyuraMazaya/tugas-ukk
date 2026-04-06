<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengembalian - SIJAMAT-PRO</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            font-size: 11px;
            color: #1e293b;
            line-height: 1.5;
            background: #fff;
        }
        .container {
            max-width: 100%;
            padding: 20px;
        }
        .header { 
            text-align: center; 
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px double #059669;
        }
        .header .logo-area {
            margin-bottom: 10px;
        }
        .header h1 { 
            font-size: 20px; 
            font-weight: 700;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .header .subtitle {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 3px;
        }
        .header .date {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
        }
        .summary-box {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border: 1px solid #a7f3d0;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .summary-item {
            text-align: center;
            padding: 0 15px;
        }
        .summary-item .value {
            font-size: 18px;
            font-weight: 700;
            color: #059669;
        }
        .summary-item .value.denda {
            color: #dc2626;
        }
        .summary-item .label {
            font-size: 9px;
            text-transform: uppercase;
            color: #10b981;
            letter-spacing: 0.5px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 15px;
            font-size: 10px;
        }
        th, td { 
            border: 1px solid #e2e8f0; 
            padding: 10px 8px; 
            text-align: left; 
        }
        th { 
            background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 9px;
            letter-spacing: 0.5px;
            color: #475569;
        }
        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }
        tbody tr:hover {
            background-color: #ecfdf5;
        }
        .denda-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 600;
        }
        .denda-ada { background: #fee2e2; color: #991b1b; }
        .denda-tidak { background: #f1f5f9; color: #64748b; }
        .footer { 
            margin-top: 30px; 
            padding-top: 15px;
            border-top: 2px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
        }
        .footer-left {
            font-size: 10px;
            color: #64748b;
        }
        .footer-right {
            text-align: right;
        }
        .total-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            padding: 8px 15px;
            border-radius: 6px;
            margin-top: 10px;
        }
        .total-box strong {
            color: #dc2626;
        }
        .signature-area {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
        }
        .signature-box {
            text-align: center;
            width: 200px;
        }
        .signature-line {
            border-bottom: 1px solid #1e293b;
            margin-top: 60px;
            margin-bottom: 5px;
        }
        .signature-name {
            font-size: 10px;
            font-weight: 600;
        }
        .signature-title {
            font-size: 9px;
            color: #64748b;
        }
        @media print { 
            body { 
                margin: 0;
                padding: 15px; 
            }
            .container {
                padding: 0;
            }
            @page {
                margin: 1cm;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-area">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin: 0 auto;">
                    <rect width="40" height="40" rx="8" fill="#059669"/>
                    <path d="M14 20L18 24L26 16" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h1>Laporan Pengembalian Alat</h1>
            <p class="subtitle">SIJAMAT-PRO - Sistem Peminjaman Alat Produktif Jurusan</p>
            <p class="date">Dicetak pada: {{ now()->translatedFormat('l, d F Y - H:i') }} WIB</p>
        </div>

        @php $totalDenda = 0; @endphp
        @foreach($pengembalians as $pengembalian)
            @php $totalDenda += $pengembalian->denda; @endphp
        @endforeach

        <div class="summary-box">
            <div class="summary-item">
                <div class="value">{{ $pengembalians->total() }}</div>
                <div class="label">Total Pengembalian</div>
            </div>
            <div class="summary-item">
                <div class="value denda">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
                <div class="label" style="color: #dc2626;">Total Denda</div>
            </div>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>Peminjam</th>
                    <th style="width: 90px;">Tgl Kembali</th>
                    <th style="width: 100px;">Denda</th>
                    <th style="width: 120px;">Petugas</th>
                    <th>Catatan Kondisi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengembalians as $index => $pengembalian)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $pengembalian->peminjaman->user->name }}</strong>
                        </td>
                        <td>{{ $pengembalian->tanggal_kembali_real->format('d/m/Y') }}</td>
                        <td>
                            @if($pengembalian->denda > 0)
                                <span class="denda-badge denda-ada">
                                    Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                                </span>
                            @else
                                <span class="denda-badge denda-tidak">Rp 0</span>
                            @endif
                        </td>
                        <td>{{ $pengembalian->petugas->name }}</td>
                        <td>{{ $pengembalian->catatan_kondisi ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 30px;">
                            <em style="color: #94a3b8;">Tidak ada data pengembalian</em>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="footer">
            <div class="footer-left">
                <strong>SIJAMAT-PRO</strong><br>
                Sistem Peminjaman Alat Produktif
            </div>
            <div class="footer-right">
                <strong>Total Pengembalian:</strong> {{ $pengembalians->total() }} data<br>
                <div class="total-box">
                    <strong>Total Denda: Rp {{ number_format($totalDenda, 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>

        <div class="signature-area">
            <div class="signature-box">
                <p style="font-size: 10px; color: #64748b;">{{ now()->translatedFormat('d F Y') }}</p>
                <p style="font-size: 10px; margin-top: 5px;">Petugas,</p>
                <div class="signature-line"></div>
                <p class="signature-name">{{ Auth::user()->name }}</p>
                <p class="signature-title">Petugas Peminjaman</p>
            </div>
        </div>
    </div>
    
    <script>
        window.onload = function() { window.print(); }
    </script>
</body>
</html>
