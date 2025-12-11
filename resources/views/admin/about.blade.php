@include('admin.layout.navbar')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Sistem</title>
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
            color:#274b39;
        }
        .hero-basic p{
            font-size:18px;
            color:#274b39;
        }
        .hero-basic h1{
            font-size:42px;
            margin-bottom:8px;
        }
        .hero-basic p{
            font-size:18px;
        }
        .hero h1{
            font-size:48px;
            margin-bottom:10px;
        }
        .hero p{
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
    <p>Menyederhanakan komunikasi dan kegiatan warga dengan teknologi modern.</p>
</div>

<div class="container">

    <div class="card">
        <h2>Latar Belakang</h2>
        <p>Sistem Informasi Kegiatan Sosial RT dikembangkan untuk membantu proses penyampaian informasi kegiatan seperti arisan, kerja bakti, dan rapat warga. Kendala seperti keterlambatan informasi, jadwal yang tidak terdata, serta kurangnya dokumentasi membuat perlunya sistem yang lebih teratur dan efisien.</p>
    </div>

    <div class="card">
        <h2>Tujuan Sistem</h2>
        <ul>
            <li>Menyediakan platform bagi pengurus RT untuk mengelola kegiatan secara terstruktur.</li>
            <li>Mempermudah warga mengakses informasi kegiatan melalui kalender interaktif.</li>
            <li>Membedakan hak akses antara admin dan warga demi keamanan data.</li>
        </ul>
    </div>

    <div class="card">
        <h2>Manfaat Sistem</h2>
        <ul>
            <li><b>Bagi Pengurus RT:</b> Pengelolaan kegiatan lebih cepat, rapi, dan terdokumentasi.</li>
            <li><b>Bagi Warga:</b> Informasi dapat diakses kapan saja dengan mudah.</li>
            <li><b>Bagi Pengembang:</b> Menjadi media belajar membangun aplikasi web modern.</li>
            <li><b>Bagi Lingkungan:</b> Meningkatkan partisipasi dan komunikasi antarwarga.</li>
        </ul>
    </div>

    <!-- 3 FEATURE CARDS -->
    <h2 style="color:var(--primary); margin-top:50px;">Kegiatan Sosial RT</h2>
    <div class="features">

        <div class="feature-item">
            <img src="{{ asset('images/Arisangambar.png') }}" alt="Arisan">
            <h3>Arisan Warga</h3>
            <p>Kegiatan rutin untuk mempererat hubungan antarwarga serta menjadi sarana kebersamaan dalam lingkungan RT.</p>
        </div>

        <div class="feature-item">
            <img src="{{ asset('images/gotongoyonghehe.png') }}" alt="Gotong Royong">
            <h3>Gotong Royong</h3>
            <p>Kerja bakti bersama untuk menjaga kebersihan dan kenyamanan lingkungan demi terciptanya lingkungan yang sehat.</p>
        </div>

        <div class="feature-item">
            <img src="{{ asset('images/Rapathehe.png') }}" alt="Rapat Warga">
            <h3>Rapat Warga</h3>
            <p>Forum musyawarah untuk membahas kebijakan, kegiatan, serta perencanaan demi kemajuan lingkungan RT.</p>
        </div>

    </div>

    <div class="card" style="margin-top:40px;">
        <h2>Lokasi Penelitian</h2>
        <p>RT 26 Kelurahan Paal Merah, Kecamatan Lingkar Selatan, Jambi.</p>
    </div>

</div>

<div class="footer">&copy; 2025 Sistem Informasi Kegiatan Sosial RT</div>

</body>
</html>
