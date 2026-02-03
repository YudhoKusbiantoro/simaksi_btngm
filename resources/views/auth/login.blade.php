<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SIMAKSI TNGM</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Figtree', sans-serif;
            background:
                linear-gradient(rgba(0, 0, 0, .45), rgba(0, 0, 0, .45)),
                url('{{ asset('images/gunung-merapi.jpeg') }}') center/cover no-repeat;
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
            max-width: 420px;
            padding: 36px 32px;
            border-radius: 20px;

            background: rgba(255, 255, 255, 0.20);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);

            border: 1px solid rgba(255, 255, 255, 0.35);
            box-shadow: 0 30px 70px rgba(0, 0, 0, .35);
            color: #fff;
        }

        .header {
            text-align: center;
            margin-bottom: 26px;
        }

        .header img {
            width: 64px;
            margin-bottom: 12px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
        }

        .header p {
            font-size: 13px;
            opacity: .9;
            margin-top: 4px;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: none;
            font-size: 14px;
            margin-bottom: 16px;
            background: rgba(255, 255, 255, 0.9);
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(22, 163, 74, .6);
        }

        button {
            width: 100%;
            padding: 13px;
            border-radius: 10px;
            border: none;
            background: #15803d;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 6px;
        }

        button:hover {
            background: #166534;
        }

        .links {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
        }

        .links a {
            color: #86efac;
            text-decoration: underline;
            font-weight: 600;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }

        footer {
            background: rgba(20, 83, 45, .95);
            color: #e5e7eb;
            text-align: center;
            padding: 14px;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <div class="glass-card">
            <div class="header">
                <img src="{{ asset('images/logo-simaksi.webp') }}" alt="TNGM">
                <h1>SIMAKSI TNGM</h1>
                <p>Sistem Informasi Manajemen Akses Kawasan</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>

                <label>Password</label>
                <input type="password" name="password" required autocomplete="current-password"
                    style="margin-bottom: 4px;">

                @if($errors->any())
                    <p
                        style="color: #ff4d4d; font-size: 13px; margin-top: 0; margin-bottom: 16px; font-weight: 700;">
                        {{ $errors->first() }}
                    </p>
                @endif

                <button type="submit">Login</button>
            </form>

            <div class="links">
                <a href="{{ route('password.request') }}">Lupa password?</a><br>
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar</a>
            </div>
        </div>
    </div>

    <footer>
        © {{ date('Y') }} Balai Taman Nasional Gunung Merapi — Kementerian LHK RI
    </footer>

</body>

</html>