<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi PIN - SIMAKSI TNGM</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Figtree', sans-serif;
            background:
                linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .glass-card {
            width: 100%;
            max-width: 440px;
            padding: 40px 36px;
            border-radius: 20px;

            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);

            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 30px 80px rgba(0, 0, 0, .5);
            color: #fff;
        }

        .verification-badge {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            color: white;
            text-align: center;
            padding: 10px 16px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.3);
        }

        .header {
            text-align: center;
            margin-bottom: 28px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header p {
            font-size: 14px;
            opacity: .75;
            margin-top: 8px;
            color: #94a3b8;
            line-height: 1.5;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
            display: block;
            color: #e2e8f0;
            text-align: center;
        }

        .pin-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .pin-input {
            width: 100%;
            padding: 16px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 24px;
            font-weight: 800;
            text-align: center;
            background: rgba(255, 255, 255, 0.05);
            color: white;
            letter-spacing: 8px;
            transition: all 0.3s ease;
        }

        .pin-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(34, 197, 94, 0.5);
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.15);
        }

        button {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #15803d 0%, #166534 100%);
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(21, 128, 61, 0.3);
        }

        button:hover {
            background: linear-gradient(135deg, #166534 0%, #14532d 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(21, 128, 61, 0.4);
        }

        .error-message {
            color: #fca5a5;
            font-size: 13px;
            margin-bottom: 20px;
            font-weight: 600;
            padding: 10px 14px;
            background: rgba(220, 38, 38, 0.15);
            border-radius: 8px;
            border-left: 3px solid #dc2626;
            text-align: center;
        }

        .logout-link {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
        }

        .logout-link button {
            background: none;
            box-shadow: none;
            color: #94a3b8;
            font-weight: 500;
            padding: 0;
            width: auto;
            border-bottom: 1px dashed #475569;
            border-radius: 0;
        }

        .logout-link button:hover {
            background: none;
            color: #cbd5e1;
            transform: none;
            border-bottom-color: #cbd5e1;
        }

        footer {
            background: rgba(15, 23, 42, .95);
            color: #94a3b8;
            text-align: center;
            padding: 16px;
            font-size: 13px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <div class="glass-card">
            <div class="verification-badge">
                🔐 Two-Step Verification
            </div>

            <div class="header">
                <h1>Verifikasi PIN</h1>
                <p>Masukkan 6 digit PIN Keamanan Anda untuk melanjutkan ke Dashboard.</p>
            </div>

            <form method="POST" action="{{ route('admin.verify-pin') }}">
                @csrf

                <label for="pin">PIN KEAMANAN</label>
                <input type="password" name="pin" id="pin" class="pin-input" maxlength="6" pattern="\d{6}"
                    inputmode="numeric" required autofocus placeholder="••••••">

                @if($errors->has('pin'))
                    <p class="error-message">
                        {{ $errors->first('pin') }}
                    </p>
                @endif

                <button type="submit">Verifikasi & Masuk</button>
            </form>

            <div class="logout-link">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit">Bukan Anda? Keluar</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        © {{ date('Y') }} Balai Taman Nasional Gunung Merapi — Kementerian LHK RI
    </footer>

</body>

</html>