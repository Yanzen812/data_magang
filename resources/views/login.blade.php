<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nusa Indo</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="login-container">
        <div class="top-border"></div>
        
        <header>
            <h1>Nusa Indo</h1>
            <div class="divider">
                <span>Login untuk masuk</span>
            </div>
        </header>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

        <form action="{{ route('login_proses') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" placeholder="Nama Lengkap" name="nama" value="{{ old('nama') }}" required>
                <div class="icon-box">
                    <i class="fas fa-user"></i>
                </div>
            </div>

            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
                <div class="icon-box">
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <div class="action-row">
                <label class="checkbox-container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                    Ingatkan saya
                </label>
                <button type="submit" class="login-btn">Login</button>
            </div>
        </form>

        {{-- <div class="footer-links">
            <a href="#">Lupa kata sandi</a> --}}
            {{-- <a href="#">Belum punya akun?Registrasi</a> --}}
        {{-- </div> --}}
    </div>

</body>
</html>