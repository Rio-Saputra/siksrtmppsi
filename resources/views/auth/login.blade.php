<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIKS RT</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: "Poppins", sans-serif;
            background: #1d3c33;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 85%;
            max-width: 1200px;
            height: 650px;
            background: #f1f5f2;
            border-radius: 35px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 20px 55px rgba(0,0,0,0.25);
        }

        .left {
            width: 55%;
            background: #ffffff;
            padding: 40px;
            position: relative;
        }

        .blob {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 450px;
            height: 450px;
            background: #d9efe7;
            transform: translate(-50%, -50%);
            border-radius: 60% 40% 40% 60% / 55% 45% 55% 45%;
        }

        .illustration {
            position: absolute;
            width: 290px;
            top: 50%;
            left: 55%;
            transform: translate(-43%, -55%);
            z-index: 5;
        }

        .left-logo {
            width: 140px;
            position: absolute;
        }

        .right {
            width: 45%;
            background: #24483e;
            padding: 60px 50px;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right h2 {
            font-size: 36px;
            margin-bottom: 30px;
            font-weight: 700;
        }

        label {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
        }

        input {
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            border: none;
            margin-bottom: 20px;
            background: #2d5a50;
            color: #fff;
        }

        input::placeholder {
            color: #b7d1c8;
        }

        a {
            color: #9ad8c7;
            font-size: 14px;
            text-decoration: none;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #90d3bf;
            border: none;
            border-radius: 10px;
            margin-top: 10px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #7dcbb3;
            transform: translateY(-2px);
        }

        .alert-box {
            background: #ffdddd;
            border-left: 5px solid #ff5e5e;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            color: #b30000;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media(max-width: 950px) {
            .container { flex-direction: column; height: auto; }
            .left, .right { width: 100%; height: auto; }
            .illustration { width: 250px; }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- LEFT SIDE -->
    <div class="left">
        <img class="left-logo" src="{{ asset('images/Logo.png') }}">
        
        <div class="blob"></div>

        <img class="illustration" src="{{ asset('images/Orang2.png') }}">
    </div>

    <!-- RIGHT SIDE -->
    <div class="right">

        <h2>Login</h2>

        <!-- ALERT ERROR (tetap ada untuk fallback) -->
        @if ($errors->any())
            <div class="alert-box">
                <ul style="margin-left: 18px;">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <label>Username</label>
            <input type="email" name="email" placeholder="Masukkan username" value="{{ old('email') }}">

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password">

            

            <button class="btn-login" type="submit">Masuk</button>
        </form>

        <p>
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar Sekarang</a>
        </p>

    </div>

</div>

<!-- SWEETALERT2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // NOTIF LOGIN GAGAL
    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal!',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#d33'
        });
    @endif

    // NOTIF LOGIN SUKSES
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Login!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#28a745'
        });
        
    @endif
</script>

</body>
</html>
