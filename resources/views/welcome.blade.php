<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MPPSI SKIS - Kegiatan Sosial</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            overflow-x: hidden;
        }

        /* ===========================
            HERO SECTION (FULLSCREEN)
        ============================ */
        .hero {
            height: 100vh;
            width: 100%;
            background: 
                linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
                url('{{ asset('images/unnamed2.png') }}') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 700;
            max-width: 900px;
            line-height: 1.3;
            margin-bottom: 15px;
            text-shadow: 0 3px 8px rgba(0,0,0,0.4);
        }

        .hero p {
            font-size: 20px;
            max-width: 700px;
            margin-bottom: 35px;
            opacity: .9;
        }

        /* BUTTON GROUP */
        .btn-group {
            display: flex;
            gap: 20px;
        }

        .btn-main {
            padding: 14px 34px;
            font-size: 18px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login {
            background: #1E7F53;
            color: white;
            border: 2px solid #1E7F53;
        }

        .btn-login:hover {
            background: transparent;
            border-color: white;
            color: white;
            transform: scale(1.04);
        }

        .btn-register {
            background: white;
            color: #1E7F53;
            border: 2px solid white;
        }

        .btn-register:hover {
            background: transparent;
            color: white;
            transform: scale(1.04);
        }

        /* ===========================
              ABOUT SECTION (NEW)
        ============================ */
        .about {
            padding: 80px 10%;
            text-align: center;
            background: #f2f4f3;
        }

        .about h2 {
            font-size: 36px;
            color: #1E7F53;
            margin-bottom: 15px;
        }

        .about p {
            max-width: 850px;
            margin: 0 auto;
            font-size: 18px;
            line-height: 1.7;
            color: #444;
        }

     /* FEATURE GRID */
.features {
    margin-top: 40px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
}

/* CARD */
.feature-item {
    background: white;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    transition: 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-5px);
}

.feature-item img {
    width: 100%;
    height: 160px; /* diperkecil dari 220px */
    object-fit: cover;
}

/* Text dalam card */
.feature-item h3 {
    margin: 12px;
    color: #145b3c;
    font-size: 20px;
}

.feature-item p {
    margin: 0 12px 16px;
    color: #444;
    line-height: 1.5;
    font-size: 15px;
}


        /* FOOTER */
        footer {
            padding: 20px;
            text-align: center;
            background: #1E7F53;
            color: white;
            margin-top: 60px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hero h1 { font-size: 32px; }
            .hero p { font-size: 16px; }

            .btn-group {
                flex-direction: column;
                width: 100%;
                align-items: center;
            }

            .btn-main {
                width: 80%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- HERO -->
    <section class="hero" id="home">
        <h1>Selamat Datang di Sistem Informasi Kegiatan Sosial SKIS</h1>
        <p>Bersama membangun solidaritas dan kepedulian sosial warga melalui teknologi modern.</p>

        <div class="btn-group">
            <a href="{{ route('login') }}" class="btn-main btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn-main btn-register">Register</a>
        </div>
    </section>

    <!-- ABOUT -->
    <section class="about" id="about">
        <h2>Tentang Sistem</h2>
        <p>
            Sistem Informasi Kegiatan SKIS dibuat untuk meningkatkan keterlibatan warga 
            dalam kegiatan sosial seperti arisan, gotong royong, dan rapat warga. 
            Semua informasi kini dapat diakses kapan saja melalui website ini.
        </p>

        <!-- FEATURE CARDS -->
        <div class="features">

            <div class="feature-item">
                <img src="{{ asset('images/Arisangambar.png') }}" alt="">
                <h3>Arisan Warga</h3>
                <p>Kegiatan rutin untuk meningkatkan kebersamaan dan silaturahmi antarwarga.</p>
            </div>

            <div class="feature-item">
                <img src="{{ asset('images/gotongoyonghehe.png') }}" alt="">
                <h3>Gotong Royong</h3>
                <p>Membersihkan lingkungan secara bersama demi lingkungan yang asri dan nyaman.</p>
            </div>

            <div class="feature-item">
                <img src="{{ asset('images/Rapathehe.png') }}" alt="">
                <h3>Rapat Warga</h3>
                <p>Forum diskusi dan musyawarah warga untuk membuat keputusan bersama.</p>
            </div>

        </div>
    </section>

    <footer>
        &copy; {{ date('Y') }} MPPSI SKIS — Sistem Informasi Kegiatan Sosial RT
    </footer>

</body>
</html>
