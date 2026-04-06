<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman - SIJAMAT-PRO</title>
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
            border-bottom: 3px double #4f46e5;
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
            background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
            border: 1px solid #c7d2fe;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .summary-item {
            text-align: center;
            padding: 0 15px;
        }
        .summary-item .value {
            font-size: 18px;
            font-weight: 700;
            color: #4f46e5;
        }
        .summary-item .label {
            font-size: 9px;
            text-transform: uppercase;
            color: #6366f1;
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
            background-color: #eef2ff;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-disetujui { background: #dbeafe; color: #1e40af; }
        .status-ditolak { background: #fee2e2; color: #991b1b; }
        .status-selesai { background: #d1fae5; color: #065f46; }
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
                    <rect width="40" height="40" rx="8" fill="#4f46e5"/>
                    <path d="M20 10L28 14V22L20 30L12 22V14L20 10Z" stroke="white" stroke-width="2" fill="none"/>
                </svg>
            </div>
            <h1>Laporan Peminjaman Alat</h1>
            <p class="subtitle">SIJAMAT-PRO - Sistem Peminjaman Alat Produktif Jurusan</p>
            <p class="date">Dicetak pada: {{ now()->translatedFormat('l, d F Y - H:i') }} WIB</p>
        </div>

        <div class="summary-box">
            <div class="summary-item">
                <div class="value">{{ $peminjamans->total() }}</div>
                <div class="label">Total Data</div>
            </div>
            @if($status)
            <div class="summary-item">
                <div class="value" style="color: #059669;">{{ ucfirst($status) }}</div>
                <div class="label">Filter Status</div>
            </div>
            @endif
        </div>
        
        <table>
            <thead>
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>Peminjam</th>
                    <th style="width: 90px;">Tgl Pinjam</th>
                    <th style="width: 90px;">Rencana Kembali</th>
                    <th>Alat Dipinjam</th>
                    <th style="width: 80px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $index => $peminjaman)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $peminjaman->user->name }}</strong><br>
                            <span style="color: #64748b; font-size: 9px;">{{ $peminjaman->user->username }}</span>
                        </td>
                        <td>{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                        <td>{{ $peminjaman->tanggal_kembali_rencana->format('d/m/Y') }}</td>
                        <td>
                            @foreach($peminjaman->detailPeminjaman as $detail)
                                <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 3px; margin-right: 3px; white-space: nowrap;">
                                    {{ $detail->alat->nama_alat }} <strong>({{ $detail->jumlah }})</strong>
                                </span>
                                @if(!$loop->last)<br>@endif
                            @endforeach
                        </td>
                        <td>
                            <span class="status-badge status-{{ $peminjaman->status }}">
                                {{ $peminjaman->status_label }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 30px;">
                            <em style="color: #94a3b8;">Tidak ada data peminjaman</em>
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
                <strong>Total Data:</strong> {{ $peminjamans->total() }} peminjaman
            </div>
        </div>

        <div class="signature-area">
            <div class="signature-box">
                <p style="font-size: 10px; color: #64748b;">{{ now()->translatedFormat('d F Y') }}</p>
                <p style="font-size: 10px; margin-top: 5px;">Administrator,</p>
                <div class="signature-line"></div>
                <p class="signature-name">{{ Auth::user()->name }}</p>
                <p class="signature-title">Admin Sistem</p>
            </div>
        </div>
    </div>
    
    <script>
        window.onload = function() { window.print(); }
    </script>
</body>
</html>