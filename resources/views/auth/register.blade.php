<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SIKS RT</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: "Poppins", sans-serif;
            background: #1d3c33;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 85%;
            max-width: 1200px;
            min-height: 680px;
            background: #f1f5f2;
            border-radius: 35px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 20px 55px rgba(0,0,0,0.25);
            animation: fadeUp 0.8s ease-out;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(40px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .left { width: 55%; background: #ffffff; padding: 40px; position: relative; overflow: hidden; }

        .blob {
            position: absolute;
            top: 50%; left: 50%;
            width: 450px; height: 450px;
            background: #d9efe7;
            transform: translate(-50%, -50%);
            border-radius: 60% 40% 40% 60% / 55% 45% 55% 45%;
            animation: blobMove 6s infinite ease-in-out;
        }

        @keyframes blobMove {
            0% { border-radius: 60% 40% 40% 60% / 55% 45% 55% 45%; }
            50% { border-radius: 50% 50% 60% 40% / 50% 50% 60% 40%; }
            100% { border-radius: 60% 40% 40% 60% / 55% 45% 55% 45%; }
        }

         .illustration {
            position: absolute;
            width: 290px;
            top: 50%;
            left: 55%;
            transform: translate(-43%, -55%);
            z-index: 5;
            animation: float 4s infinite ease-in-out;
        }

        @keyframes float {
            0%,100% { transform: translate(-50%, -50%) translateY(0); }
            50% { transform: translate(-50%, -50%) translateY(-12px); }
        }

        .left-logo { width: 140px; position: absolute; }

        .right {
            width: 45%;
            background: #24483e;
            padding: 35px 40px;
            color: #fff;
            display: flex;
            flex-direction: column;
        }

        .right h2 {
            font-size: 30px;
            margin-bottom: 18px;
            font-weight: 700;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            border: none;
            margin-bottom: 12px;
            background: #2d5a50;
            color: #fff;
            font-size: 14px;
        }

        select option { color: #000; }
        input::placeholder { color: #b7d1c8; }

        /* --- FIELD 2 KOLOM --- */
        .row-2col {
            display: flex;
            gap: 12px;
        }
        .row-2col .col {
            flex: 1;
        }

        .file-wrapper {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 12px;
        }

        .file-input { padding: 8px 0; color: #d9efe7; background: none; }

                #previewKTP {
                    width: 150px;       /* ukuran fix */
                        height: 100px;      /* ukuran fix */
                object-fit: cover;  /* biar fotonya nge-crop rapi */
                border-radius: 10px;
                border: 2px solid #9ad8c7;
                display: none;
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
            transition: 0.25s;
        }
        .btn-login:hover {
            background: #7dcbb3;
            transform: translateY(-3px);
        }

        p { margin-top: 8px; font-size: 14px; }
        p a { font-weight: 600; color: #9ad8c7; }

        .alert {
            background: #ffdddd;
            padding: 14px;
            border-radius: 10px;
            color: #b30000;
            margin-bottom: 18px;
            font-size: 14px;
        }

        @media(max-width: 950px) {
            .container { flex-direction: column; }
            .left, .right { width: 100%; }
            .illustration { width: 240px; }
            .row-2col { flex-direction: column; }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="left">
        <img class="left-logo"
             src="{{ asset('images/Logo.png') }}">

        <div class="blob"></div>

        <img class="illustration"
             src="{{ asset('images/Orang4.png') }}">
    </div>

    <div class="right">

        <h2>Registrasi</h2>

        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- === NAMA + GENDER DALAM 1 BARIS === -->
            <div class="row-2col">
                <div class="col">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" placeholder="Masukkan nama anda..." required>
                </div>

                <div class="col">
                    <label>Gender</label>
                    <select name="gender" required>
                        <option value="">Pilih Gender</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <label>NIK</label>
            <input type="text"
                name="nik"
                placeholder="Masukkan NIK..."
                required minlength="16" maxlength="16"
                pattern="[0-9]+"
                oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,16);">

            <label>Email</label>
            <input type="email" name="email" placeholder="Masukkan email..." required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password..." required>

            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" placeholder="Ulangi password..." required>

            <label>Upload Foto KTP</label>
            <div class="file-wrapper">
                <input type="file" name="ktp" accept="image/*" class="file-input" id="ktpInput">
                <img id="previewKTP">
            </div>

            <button class="btn-login" type="submit">Daftar</button>
        </form>

        <p>
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk</a>
        </p>

    </div>
</div>

<script>
document.getElementById('ktpInput').addEventListener('change', function(e) {
    const img = document.getElementById('previewKTP');
    img.src = URL.createObjectURL(e.target.files[0]);
    img.style.display = "block";
});
</script>
<script>
document.getElementById('ktpInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const img  = document.getElementById('previewKTP');

    if (!file) return;

    // 2 MB = 2 * 1024 * 1024 bytes
    const maxSize = 2 * 1024 * 1024;

    if (file.size > maxSize) {
        alert("Ukuran gambar maksimal 2MB. File yang kamu pilih: " + 
              (file.size / 1024 / 1024).toFixed(2) + " MB");
        e.target.value = "";   // reset input
        img.style.display = "none";
        img.src = "";
        return;
    }

    img.src = URL.createObjectURL(file);
    img.style.display = "block";
});
</script>


</body>
</html>
