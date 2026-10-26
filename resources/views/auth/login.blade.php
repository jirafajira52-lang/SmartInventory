
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | SmartInventory</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: linear-gradient(135deg, #0f172a, #1d4ed8, #38bdf8);
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 38px;
            background: rgba(255, 255, 255, 0.97);
            border-radius: 24px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
        }

        .logo {
            width: 70px;
            height: 70px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            color: white;
            font-size: 32px;
        }

        h1 {
            text-align: center;
            color: #0f172a;
            font-size: 26px;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-weight: 600;
            font-size: 14px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 13px 14px;
            margin-bottom: 20px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 22px;
            color: #475569;
            font-size: 14px;
        }

        .remember label {
            margin: 0;
            font-weight: normal;
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #2563eb, #0ea5e9);
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
        }

        .error {
            padding: 11px;
            margin-bottom: 18px;
            border-radius: 8px;
            background: #fee2e2;
            color: #b91c1c;
            font-size: 14px;
        }

        .footer {
            margin-top: 25px;
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="logo">📦</div>

        <h1>SmartInventory</h1>
        <p class="subtitle">Silakan login untuk mengelola inventori toko</p>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <label for="email">Email Admin</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukkan email"
                required
                autofocus
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            <div class="remember">
                <input type="checkbox" id="remember" name="remember" value="1">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit">Login Sekarang →</button>
        </form>

        <div class="footer">
            © {{ date('Y') }} SmartInventory · Sistem Manajemen Toko
        </div>
    </div>
</body>
</html>
