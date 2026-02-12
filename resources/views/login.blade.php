<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ParkirPasar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 24px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            color: white;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-icon {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            display: block;
            text-align: center;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            padding: 0.8rem 1.2rem;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            box-shadow: none;
        }

        .btn-login {
            background: white;
            color: #6366f1;
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-login:hover {
            background: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            color: #4f46e5;
        }

        .alert-custom {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fee2e2;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

<div class="login-card">
    <span class="login-icon">🚗</span>
    <h2 class="text-center fw-bold mb-1">ParkirPasar</h2>
    <p class="text-center mb-4 text-white-50">Silakan masuk ke akun Anda</p>

    @if(session('error'))
        <div class="alert-custom d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label small fw-bold">USERNAME</label>
            <input 
                type="text" 
                name="username" 
                class="form-control" 
                placeholder="Masukkan username"
                required>
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold">PASSWORD</label>
            <input 
                type="password" 
                name="password" 
                class="form-control" 
                placeholder="Masukkan password"
                required>
        </div>

        <button class="btn btn-login w-100">
            MASUK
        </button>

    </form>
    
    <div class="mt-4 text-center">
        <p class="small text-white-50 mb-0">@2026novalardyansah</p>
    </div>
</div>

</body>
</html>
