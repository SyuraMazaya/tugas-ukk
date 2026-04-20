<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pembayaran Denda</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            color: #0f172a;
            font-size: 12px;
            line-height: 1.5;
            padding: 24px;
            background: #ffffff;
        }

        .header {
            border-bottom: 2px solid #0f172a;
            margin-bottom: 18px;
            padding-bottom: 12px;
        }

        .title {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .subtitle {
            color: #475569;
            font-size: 11px;
            margin-top: 4px;
        }

        .badge {
            display: inline-block;
            margin-top: 8px;
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
            border-radius: 999px;
            padding: 4px 10px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .section {
            margin-top: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px;
        }

        .section h3 {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 8px;
            color: #334155;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 5px 0;
            vertical-align: top;
        }

        .info-table td:first-child {
            width: 180px;
            color: #475569;
        }

        .info-table td:last-child {
            font-weight: 600;
            color: #0f172a;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #cbd5e1;
            padding: 8px;
            text-align: left;
        }

        .items-table th {
            background: #f8fafc;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: #334155;
        }

        .items-table td {
            font-size: 11px;
        }

        .align-right {
            text-align: right;
        }

        .proof-box {
            margin-top: 10px;
            border: 1px dashed #94a3b8;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            background: #f8fafc;
        }

        .proof-image {
            max-width: 100%;
            max-height: 320px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
        }

        .note {
            margin-top: 20px;
            font-size: 10px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
        }
    </style>
</head>
<body>
    @php
        $nomorPeminjaman = str_pad((string) $peminjaman->id_peminjaman, 6, '0', STR_PAD_LEFT);
    @endphp

    <div class="header">
        <div class="title">Bukti Pembayaran Denda</div>
        <div class="subtitle">Dokumen pembayaran denda peminjaman alat</div>
        <span class="badge">Pembayaran Sukses</span>
    </div>

    <div class="section">
        <h3>Informasi Pembayaran</h3>
        <table class="info-table">
            <tr>
                <td>No. Peminjaman</td>
                <td>#{{ $nomorPeminjaman }}</td>
            </tr>
            <tr>
                <td>Nama Peminjam</td>
                <td>{{ $peminjaman->user->name }}</td>
            </tr>
            <tr>
                <td>Username</td>
                <td>{{ $peminjaman->user->username }}</td>
            </tr>
            <tr>
                <td>Metode Pembayaran</td>
                <td>{{ $pengembalian->metode_pembayaran_label }}</td>
            </tr>
            <tr>
                <td>Tanggal Pembayaran</td>
                <td>{{ $pengembalian->tanggal_pembayaran?->format('d M Y H:i') ?? '-' }} WIB</td>
            </tr>
            <tr>
                <td>Tanggal Verifikasi</td>
                <td>{{ $pengembalian->tanggal_verifikasi?->format('d M Y H:i') ?? '-' }} WIB</td>
            </tr>
            <tr>
                <td>Status Pembayaran</td>
                <td>Lunas dan tervalidasi</td>
            </tr>
            <tr>
                <td>Nominal Denda</td>
                <td>Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3>Daftar Alat</h3>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Nama Alat</th>
                    <th>Kode</th>
                    <th class="align-right">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman->detailPeminjaman as $detail)
                    <tr>
                        <td>{{ $detail->alat->nama_alat }}</td>
                        <td>{{ $detail->alat->kode_alat }}</td>
                        <td class="align-right">{{ $detail->jumlah }} unit</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>Lampiran Bukti Pembayaran</h3>

        @if($pengembalian->metode_pembayaran === 'qris')
            @if($buktiPembayaranDataUri)
                <div class="proof-box">
                    <img src="{{ $buktiPembayaranDataUri }}" alt="Lampiran bukti pembayaran QRIS" class="proof-image">
                </div>
            @else
                <div class="proof-box">
                    Lampiran gambar pembayaran QRIS tidak ditemukan di penyimpanan.
                </div>
            @endif
        @else
            <div class="proof-box">
                Pembayaran dilakukan secara tunai (tanpa lampiran gambar).
            </div>
        @endif
    </div>

    <div class="note">
        Dokumen ini dihasilkan otomatis oleh sistem pada {{ now()->format('d M Y H:i') }} WIB.
    </div>
</body>
</html>
