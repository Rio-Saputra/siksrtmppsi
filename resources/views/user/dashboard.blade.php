<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Dashboard User - MPPSI SKIS</title>

<!-- FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<!-- Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
  :root{
    --green-700:#2f5b44;
    --green-500:#6b8e57;
    --accent:#2b7a78;
    --soft:#f4faf6;
  }

  *{box-sizing:border-box}
  body{
    margin:0;
    font-family:"Poppins", system-ui;
    background:linear-gradient(180deg,#eef6f0 0%, #fbfdfc 100%);
  }



  .wrap{
    max-width:1200px;
    margin:20px auto 60px;
    padding:0 20px;
  }

  /* HERO */
  .hero-card{
    background:linear-gradient(180deg,rgba(255,255,255,0.9),rgba(250,255,250,0.85));
    border-radius:20px;
    padding:28px;
    display:flex;gap:28px;align-items:center;
    box-shadow:0 18px 40px rgba(30,60,40,0.08);
  }

  .small-badge{
    display:inline-block;background:rgba(43,122,120,0.12);
    color:var(--accent);padding:6px 10px;border-radius:999px;
    font-size:13px;font-weight:600;margin-bottom:12px;
  }

  .hero-title{
    font-size:32px;color:#0f2b20;margin:6px 0 12px;
    font-weight:700;line-height:1.05;
  }

  .hero-sub{ color:#375a4b;max-width:560px;margin-bottom:18px; }

  .hero-right{
    width:460px;height:260px;border-radius:18px;
    background:linear-gradient(180deg,#fff,#f7f9f7);
    display:flex;align-items:center;justify-content:center;
    box-shadow:0 12px 30px rgba(30,60,40,0.06);
    position:relative;
  }

  .hero-image{
    width:92%;height:92%;object-fit:cover;border-radius:14px;
  }

  /* CALENDAR */
  .calendar-section{
    margin-top:30px;
    display:flex;
    gap:28px;
    align-items:flex-start;
    flex-wrap:wrap;
  }

  .calendar-card{
    flex:1 1 650px;
    background:white;
    border-radius:14px;
    padding:18px;
    box-shadow:0 12px 28px rgba(20,40,30,0.04);
  }

  .info-panel{
    width:300px;
    background:linear-gradient(180deg,#fff,#fbfff9);
    border-radius:14px;
    padding:20px;
    box-shadow:0 10px 30px rgba(20,40,30,0.04);
    position:sticky;
    top:20px;
  }

  .info-panel h4{
    margin:0 0 14px;
    color:var(--green-700);
    font-weight:700;
    text-align:center;
  }

  .info-item{
    display:flex; gap:12px;
    margin-bottom:18px;
    background:#f7faf7;
    padding:12px;
    border-radius:10px;
    align-items:center;
  }

  .info-item .icon{
    width:44px;height:44px;border-radius:10px;
    background:white;
    display:grid;place-items:center;
    box-shadow:0 4px 10px rgba(0,0,0,0.05);
    color:var(--green-700);
  }

  .stat-grid{
    margin-top:32px;
    display:flex;gap:18px;
    flex-wrap:wrap;
  }

  .stat{
    flex:1 1 260px;
    background:linear-gradient(180deg,#ffffff,#f7fff7);
    border-radius:12px;
    padding:18px;
    box-shadow:0 8px 20px rgba(20,40,30,0.04);
  }

  footer{text-align:center;padding:30px;color:#6a7a6b;margin-top:60px;font-size:14px;}
</style>
</head>

<body>

@include('user.layout.navbar')


<div class="wrap">

  <!-- HERO -->
  <section class="hero-card">
    <div id="d"></div>
    <div class="hero-left">
      <div class="small-badge">Kegiatan Komunitas • Informasi Terbaru</div>
      <h2 class="hero-title">Selamat Datang, {{ Auth::user()->name }}!</h2>
      <p class="hero-sub">Lihat semua jadwal arisan, rapat, dan kerja bakti dalam satu kalender yang rapi.</p>
      <div style="display:flex; gap:12px; margin-top:15px;">
            <button onclick="document.getElementById('calendar').scrollIntoView({behavior:'smooth'})"
                style="
                    background:var(--accent);
                    color:white;
                    border:none;
                    padding:12px 18px;
                    border-radius:12px;
                    cursor:pointer;
                    font-weight:600;
                ">
                Lihat Kalender
            </button>

            
        </div>
    </div>

    <div class="hero-right">
      <img src="{{ asset('images/bg-hero.png') }}" alt="hero" class="hero-image">
    </div>
  </section>

  <!-- CALENDAR -->
  <div class="calendar-section">

    <div class="calendar-card">
      <h3 style="margin:0 0 12px;color:var(--green-700)">Kalender Kegiatan</h3>
      <div id="calendar"></div>
    </div>

    <aside class="info-panel">
      <h4>Ringkasan Kegiatan</h4>

      <div class="info-item">
        <div class="icon"><i class="fa-solid fa-calendar-check"></i></div>
        <div>
          <p><strong>{{ \App\Models\Kegiatan::count() }}</strong><br><small>Total kegiatan</small></p>
        </div>
      </div>

      <div class="info-item">
        <div class="icon"><i class="fa-solid fa-clock"></i></div>
        <div>
          <p><strong>
            @php
              $next = \App\Models\Kegiatan::where('tanggal','>=',date('Y-m-d'))->orderBy('tanggal')->first();
            @endphp
            {{ $next ? $next->judul.' ('.\Carbon\Carbon::parse($next->tanggal)->format('d M Y').')' : '-' }}
          </strong><br><small>Kegiatan terdekat</small></p>
        </div>
      </div>

    </aside>

  </div>

  <!-- STATISTIK -->
  <div class="stat-grid">
    <div class="stat">
      <h5>Arisan</h5>
      <p>Kegiatan sosial bulanan untuk mempererat kebersamaan warga.</p>
    </div>
    <div class="stat">
      <h5>Rapat</h5>
      <p>Diskusi bersama untuk menentukan keputusan lingkungan.</p>
    </div>
    <div class="stat">
      <h5>Kerja Bakti</h5>
      <p>Gerakan gotong royong membersihkan dan menjaga lingkungan.</p>
    </div>
  </div>

</div>

<!-- TENTANG KAMI -->
<section id="tentang-kami" style="
    margin-top:70px;
    background:white;
    padding:50px 28px;
    border-radius:20px;
    box-shadow:0 12px 28px rgba(20,40,30,0.06);
    text-align:center;
">
    <h2 style="color:var(--green-700);font-weight:700;margin-bottom:16px;font-size:28px;">
        Tentang Kami
    </h2>

    <p style="
        color:#355c46;
        max-width:780px;
        margin:0 auto;
        line-height:1.7;
    ">
        MPPSI SKIS adalah platform digital komunitas yang menyediakan informasi kegiatan
        seperti arisan, rapat, dan kerja bakti. Sistem ini membantu warga mengikuti jadwal
        melalui kalender interaktif yang modern dan mudah digunakan.
    </p>
</section>

<footer>
  &copy; {{ date('Y') }} MPPSI SKIS — Dibuat untuk komunitas
</footer>

<!-- ========================= -->
<!-- MODAL DETAIL KEGIATAN -->
<!-- ========================= -->
<div id="detailModal" style="
    position: fixed;
    inset:0;
    background: rgba(0,0,0,0.5);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:2000;
">
    <div style="
        background:white;
        padding:25px;
        border-radius:14px;
        width:90%;
        max-width:450px;
        box-shadow:0 6px 30px rgba(0,0,0,0.2);
        animation: fadeIn .2s ease;
    ">
        <h3 style="margin-top:0;color:#2f5b44" id="detailJudul"></h3>
        <p><strong>Tanggal :</strong> <span id="detailTanggal"></span></p>
        <p><strong>Jam :</strong> <span id="detailJam"></span></p>
         <p><strong>Lokasi :</strong> <span id="detailLokasi"></span></p>
        <p><strong>Deskripsi :</strong></p>
        <p id="detailDeskripsi"></p>

        <button onclick="closeDetail()" style="
            margin-top:15px;
            background:#2f5b44;
            color:white;
            border:none;
            padding:10px 16px;
            border-radius:8px;
            cursor:pointer;
        ">Tutup</button>
    </div>
</div>

<script>
function closeDetail(){
    document.getElementById("detailModal").style.display = "none";
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

  var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
    initialView:'dayGridMonth',
    headerToolbar:{ left:'prev,next today', center:'title', right:'dayGridMonth,timeGridWeek,timeGridDay' },
    events:'{{ route('admin.kegiatan.events') }}',
    height:'auto',

    /* ===========================
       EVENT CLICK → MUNCUL DETAIL
       =========================== */
    eventClick: function(info){
        fetch('/user/kegiatan/' + info.event.id)

            .then(res => res.json())
            .then(data => {
                document.getElementById("detailJudul").innerText = data.judul;
                document.getElementById("detailTanggal").innerText = data.tanggal;
                document.getElementById("detailJam").innerText = data.jam ?? "-";
                document.getElementById("detailDeskripsi").innerText = data.deskripsi ?? "-";
                  document.getElementById('detailLokasi').innerText = info.event.extendedProps.lokasi ?? '-';

                document.getElementById("detailModal").style.display = "flex";
            });
    }

  });

  calendar.render();
});
</script>

<script>
// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener("click", function(e) {
        e.preventDefault();
        let targetID = this.getAttribute("href");
        let target = document.querySelector(targetID);
        if(target){
            window.scrollTo({
                top: target.offsetTop - 80,
                behavior: "smooth"
            });
        }
    });
});

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
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
