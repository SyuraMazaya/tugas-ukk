<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi 2FA</title>
</head>
<body style="margin:0;padding:0;background-color:#f5f7fb;font-family:Arial,sans-serif;color:#1f2937;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color:#f5f7fb;padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:560px;background:#ffffff;border-radius:12px;border:1px solid #e5e7eb;padding:28px;">
                    <tr>
                        <td>
                            <h1 style="margin:0 0 12px;font-size:22px;line-height:1.3;color:#111827;">Verifikasi Login Dua Faktor</h1>
                            <p style="margin:0 0 18px;font-size:15px;line-height:1.6;color:#374151;">Halo {{ $recipientName }},</p>
                            <p style="margin:0 0 18px;font-size:15px;line-height:1.6;color:#374151;">
                                Gunakan kode berikut untuk menyelesaikan login Anda:
                            </p>

                            <div style="margin:0 0 18px;padding:14px 16px;border-radius:10px;background:#eef2ff;border:1px solid #c7d2fe;text-align:center;">
                                <span style="font-size:34px;letter-spacing:6px;font-weight:700;color:#3730a3;font-family:'Courier New',monospace;">{{ $code }}</span>
                            </div>

                            <p style="margin:0 0 8px;font-size:14px;line-height:1.6;color:#4b5563;">
                                Kode ini berlaku selama {{ $expiresInMinutes }} menit dan hanya dapat digunakan satu kali.
                            </p>
                            <p style="margin:0 0 18px;font-size:14px;line-height:1.6;color:#4b5563;">
                                Jika Anda tidak merasa melakukan login, abaikan email ini.
                            </p>

                            <hr style="border:none;border-top:1px solid #e5e7eb;margin:20px 0;">

                            <p style="margin:0;font-size:12px;line-height:1.6;color:#6b7280;">
                                Email ini dikirim otomatis oleh sistem {{ config('app.name') }}.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>