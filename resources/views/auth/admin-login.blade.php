<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - SIMAKSI TNGM</title>

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

        .security-badge {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            text-align: center;
            padding: 10px 16px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        .header {
            text-align: center;
            margin-bottom: 28px;
        }

        .header img {
            width: 70px;
            margin-bottom: 14px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
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
            font-size: 13px;
            opacity: .75;
            margin-top: 6px;
            color: #94a3b8;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #e2e8f0;
        }

        input {
            width: 100%;
            padding: 13px 16px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 14px;
            margin-bottom: 18px;
            background: rgba(255, 255, 255, 0.05);
            color: white;
            transition: all 0.3s ease;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        input:focus {
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

        button:active {
            transform: translateY(0);
        }

        .error-message {
            color: #fca5a5;
            font-size: 13px;
            margin-top: -12px;
            margin-bottom: 16px;
            font-weight: 600;
            padding: 10px 14px;
            background: rgba(220, 38, 38, 0.15);
            border-radius: 8px;
            border-left: 3px solid #dc2626;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
        }

        .back-link a {
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: #cbd5e1;
            text-decoration: underline;
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
            <div class="security-badge">
                🔒 Restricted Area - Admin Only
            </div>

            <div class="header">
                <img src="{{ asset('images/logo-simaksi.webp') }}" alt="TNGM">
                <h1>Admin Panel</h1>
                <p>SIMAKSI TNGM - Administrator Access</p>
            </div>

            <form method="POST" action="{{ route('admin.login') }}" autocomplete="off">
                @csrf

                <label>Email Administrator</label>
                <input type="email" name="email" value="" placeholder="admin@example.com" required autocomplete="off">

                <label>Password</label>
                <input type="password" name="password" required autocomplete="new-password" placeholder="••••••••"
                    style="margin-bottom: 4px;">

                @if($errors->any())
                    <p class="error-message">
                        {{ $errors->first() }}
                    </p>
                @endif

                <button type="submit">Login sebagai Admin</button>
            </form>

            <div class="back-link">
                <a href="{{ route('home') }}">← Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>

    <footer>
        © {{ date('Y') }} Balai Taman Nasional Gunung Merapi — Kementerian LHK RI
    </footer>

</body>

</html>