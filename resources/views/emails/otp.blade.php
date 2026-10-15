<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F5F3FF;
            color: #18102B;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            padding: 36px 32px;
            box-shadow: 0 8px 24px rgba(24, 16, 43, 0.06);
            border: 1px solid #DDD7F3;
        }
        .header {
            text-align: center;
            margin-bottom: 24px;
        }
        .header h1 {
            color: #834DFB;
            margin: 0;
            font-size: 26px;
            font-weight: 700;
        }
        .header p {
            color: #585175;
            font-size: 14px;
            margin-top: 6px;
        }
        .otp-code {
            text-align: center;
            background-color: #ECE4FD;
            border: 2px dashed #834DFB;
            font-size: 36px;
            font-weight: 800;
            letter-spacing: 8px;
            padding: 18px;
            border-radius: 12px;
            color: #18102B;
            margin: 28px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #585175;
            margin-top: 32px;
            border-top: 1px solid #DDD7F3;
            padding-top: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>NursePulse Academy</h1>
            <p>Kode Verifikasi Pendaftaran</p>
        </div>
        <p>Halo,</p>
        <p>Terima kasih telah mendaftar di <strong>NursePulse Academy</strong>. Gunakan kode OTP di bawah ini untuk memverifikasi alamat email Anda:</p>
        <div class="otp-code">{{ $otpCode }}</div>
        <p>Kode ini hanya berlaku selama <strong>10 menit</strong>. Jika Anda tidak merasa melakukan pendaftaran ini, silakan abaikan email ini.</p>
        <div class="footer">
            &copy; {{ date('Y') }} NursePulse Academy. Seluruh hak cipta dilindungi.
        </div>
    </div>
</body>
</html>
