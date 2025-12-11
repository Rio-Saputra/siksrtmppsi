@include('user.layout.navbar')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Sistem</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root{
            --primary:#1E7F53;
            --secondary:#145b3c;
            --text-dark:#1a1a1a;
            --text-light:#ffffff;
            --bg:#f2f4f3;
        }

        body{
            margin:0;
            font-family:"Poppins", sans-serif;
            background:var(--bg);
        }

        /* HERO */
        .hero-basic{
            background:#ffffff;
            padding:70px 20px;
            text-align:center;
            color:#274b39;
        }
        .hero-basic h1{
            font-size:42px;
            margin-bottom:8px;
        }
        .hero-basic p{
            font-size:18px;
        }

        /* CONTAINER */
        .container{
            max-width:1100px;
            margin:40px auto;
            padding:0 20px;
        }

        /* CARD */
        .card{
            background:white;
            padding:25px;
            border-radius:16px;
            margin-bottom:25px;
            border:1px solid #e4e4e4;
            box-shadow:0 6px 14px rgba(0,0,0,0.06);
        }
        .card h2{
            color:var(--primary);
            margin-top:0;
        }
        .card p, .card ul{
            color:#333;
            line-height:1.7;
        }

        /* FEATURE CARDS */
        .features{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(300px, 1fr));
            gap:20px;
            margin-top:40px;
        }

        .feature-item{
            background:white;
            border-radius:16px;
            overflow:hidden;
            box-shadow:0 6px 14px rgba(0,0,0,0.08);
            border:1px solid #e4e4e4;
            transition:0.3s;
        }
        .feature-item:hover{
            transform:translateY(-5px);
        }

        .feature-item img{
            width:100%;
            height:200px;
            object-fit:cover;
        }
        .feature-item h3{
            margin:15px;
            color:var(--secondary);
        }
        .feature-item p{
            margin:0 15px 20px 15px;
            color:#444;
        }

        /* FOOTER */
        .footer{
            text-align:center;
            padding:20px;
            background:#eaeaea;
            margin-top:50px;
            color:#555;
        }
    </style>
</head>
<body>

<div class="hero-basic">
    <h1>Tentang Sistem Informasi Kegiatan RT</h1>
    <p>Platform informasi kegiatan warga yang mudah diakses kapan saja oleh seluruh warga RT.</p>
</div>

<div class="container">

    <div class="card">
        <h2>Informasi Umum</h2>
        <p>
            Sistem ini disediakan untuk warga agar dapat melihat informasi terkini mengenai kegiatan sosial 
            seperti arisan, gotong royong, dan rapat warga. Dengan adanya sistem ini, warga tidak lagi ketinggalan 
            informasi dan dapat mengikuti seluruh kegiatan secara tepat waktu.
        </p>
    </div>

    <div class="card">
        <h2>Fitur untuk Warga</h2>
        <ul>
            <li>Melihat jadwal kegiatan RT secara real-time.</li>
          
            <li>Memperkuat keterlibatan warga dalam kegiatan lingkungan.</li>
        </ul>
    </div>

    <!-- FEATURE CARDS -->
    <h2 style="color:var(--primary); margin-top:50px;">Jenis Kegiatan Warga</h2>
    <div class="features">

        <div class="feature-item">
            <img src="{{ asset('images/Arisangambar.png') }}" alt="Arisan">
            <h3>Arisan Warga</h3>
            <p>Kegiatan rutin yang mempererat hubungan antarwarga dan menjadi ajang silaturahmi.</p>
        </div>

        <div class="feature-item">
            <img src="{{ asset('images/gotongoyonghehe.png') }}" alt="Gotong Royong">
            <h3>Gotong Royong</h3>
            <p>Kerja sama membersihkan lingkungan untuk menciptakan tempat tinggal yang nyaman.</p>
        </div>

        <div class="feature-item">
            <img src="{{ asset('images/Rapathehe.png') }}" alt="Rapat Warga">
            <h3>Rapat Warga</h3>
            <p>Tempat bermusyawarah dan berdiskusi untuk mengambil keputusan terbaik bagi lingkungan.</p>
        </div>

    </div>

    <div class="card" style="margin-top:40px;">
        <h2>Lokasi Kegiatan</h2>
        <p>RT 26 Kelurahan Paal Merah, Kecamatan Lingkar Selatan, Jambi.</p>
    </div>

</div>

<div class="footer">&copy; 2025 Sistem Informasi Kegiatan Sosial RT</div>

</body>
</html>
