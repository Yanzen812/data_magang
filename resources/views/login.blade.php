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

        <form action="{{ route('login_proses') }}" method="POST">
            @csrf
            @if ($errors->any())
                    <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <span>{{ $error }}</li>
                            @endforeach
                    </div>
                @endif
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" value="{{ old('username') }}" required>
                <div class="icon-box">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <div class="input-group show-password">
                <input type="password" placeholder="Password" name="password" required id="password">
                <div class="icon-box">
                    <span class="fas fa-lock" id="password-lock"></span>
                </div>
            </div>

            <div class="action-row">
                <button type="submit" class="login-btn">Login</button>
            </div>
        </form>
    </div>
{{-- <script>
    $('.show-password').on('click', function() {
        if($('#password').attr('type') === 'password') {
            $('#password').attr('type', 'text');
            $('#password-lock').attr('class', 'fas fa-unlock');
        } else {
            $('#password').attr('type', 'password');
            $('#password-lock').attr('class', 'fas fa-lock');
        }
    });
</script> --}}
</body>
</html>
