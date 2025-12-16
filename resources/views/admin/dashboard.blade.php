<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Dashboard Admin - MPPSI SKIS</title>

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

  .hero-ctas{ display:flex; gap:12px; }

  .btn-primary{
    background:linear-gradient(90deg,var(--accent),#3a8b7f);
    color:white;padding:12px 18px;border-radius:12px;border:none;
    font-weight:700;cursor:pointer;
  }

  .btn-ghost{
    border:1px solid rgba(47,91,68,0.12);
    padding:10px 16px;border-radius:12px;
    background:transparent;color:var(--green-700);
    cursor:pointer;
  }

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

  .modal-overlay{
    position:fixed;
    top:0;left:0;right:0;bottom:0;
    background:rgba(0,0,0,0.45);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:2000;
  }

  .modal-box{
    background:white;
    max-width:400px;
    width:90%;
    padding:24px;
    border-radius:16px;
    box-shadow:0 12px 30px rgba(0,0,0,0.15);
    animation:pop 0.2s ease-out;
  }

  .modal-box h3{
    margin:0 0 10px;
    color:#2f5b44;
  }

  .btn-close{
    margin-top:18px;
    padding:10px 16px;
    width:100%;
    border:none;
    border-radius:10px;
    background:var(--accent);
    color:white;
    font-weight:600;
    cursor:pointer;
  }

  @keyframes pop{
    from{transform:scale(.8); opacity:0;}
    to{transform:scale(1); opacity:1;}
  }

  footer{text-align:center;padding:30px;color:#6a7a6b;margin-top:60px;font-size:14px;}
</style>
</head>

<body>
@include('admin.layout.navbar')
<!-- NAVBAR DIHAPUS SESUAI PERMINTAAN -->


<div class="wrap">

  <!-- HERO -->
  <section class="hero-card">
    <div class="hero-left">
      <div class="small-badge">Platform Kegiatan • Ramah Lingkungan</div>
      <h2 class="hero-title">Kelola & Pantau Kegiatan Lingkungan dengan Mudah</h2>
      <p class="hero-sub">Tambahkan, edit, dan lihat semua kegiatan komunitas seperti arisan, rapat, dan kerja bakti.</p>

      <div class="hero-ctas">
        <button class="btn-primary" onclick="document.getElementById('calendar').scrollIntoView({behavior:'smooth'})">Lihat Kalender</button>
        <button class="btn-ghost" onclick="window.location.href='{{ route('admin.kegiatan') }}'">Kelola Kegiatan</button>
      </div>
    </div>

    <div class="hero-right">
      <img src="{{ asset('images/bg-hero.png') }}" alt="hero" class="hero-image">
    </div>
  </section>

  <!-- CALENDAR SECTION -->
  <div class="calendar-section">

    <div class="calendar-card">
      <h3 style="margin:0 0 12px;color:var(--green-700)">Kalender Kegiatan</h3>
      <div id="calendar"></div>
    </div>

    <aside class="info-panel">
      <h4>Ringkasan Cepat</h4>

      <div class="info-item">
        <div class="icon"><i class="fa-solid fa-calendar-check"></i></div>
        <div>
          <p><strong>{{ \App\Models\Kegiatan::count() }}</strong><br><small>Total kegiatan terdaftar</small></p>
        </div>
      </div>

      <div class="info-item">
        <div class="icon"><i class="fa-solid fa-clock"></i></div>
        <div>
          <p><strong>
            @php
              $next = \App\Models\Kegiatan::where('tanggal','>=',date('Y-m-d'))
                      ->orderBy('tanggal')->first();
            @endphp
            {{ $next ? $next->judul.' ('.\Carbon\Carbon::parse($next->tanggal)->format('d M Y').')' : '-' }}
          </strong><br><small>Kegiatan terdekat</small></p>
        </div>
      </div>

      <a href="{{ route('admin.kegiatan') }}" class="btn-primary" style="display:block;text-align:center;padding:10px 12px;border-radius:10px;margin-top:6px;">Kelola Kegiatan</a>
    
    </aside>

  </div>

  

  <div class="stat-grid">
    <div class="stat">
      <h5>Arisan</h5>
      <p>Kegiatan santai berkala untuk mempererat silaturahmi.</p>
    </div>
    <div class="stat">
      <h5>Rapat</h5>
      <p>Pembahasan kebijakan dan koordinasi program kerja komunitas.</p>
    </div>
    <div class="stat">
      <h5>Kerja Bakti</h5>
      <p>Aktivitas gotong royong membersihkan area lingkungan.</p>
    </div>
  </div>

</div>

<!-- TENTANG KAMI -->
<section style="
    margin-top:70px;
    background:white;
    padding:50px 28px;
    border-radius:20px;
    box-shadow:0 12px 28px rgba(20,40,30,0.06);
    text-align:center;
">
    <h2 style="
        color:var(--green-700);
        margin-bottom:16px;
        font-size:28px;
        font-weight:700;
        text-align:center;
    ">
        Tentang Kami
    </h2>

    <p style="
        color:#355c46;
        line-height:1.7;
        font-size:15.5px;
        max-width:780px;
        margin:0 auto;
        text-align:center;
    ">
        SKIS adalah platform digital yang dirancang untuk mengelola kegiatan 
        komunitas seperti <strong>arisan, rapat warga, dan kerja bakti</strong>. 
        Sistem ini membantu menyatukan informasi, mempermudah koordinasi, serta 
        memberikan kemudahan bagi admin dan warga dalam mengakses jadwal kegiatan 
        melalui kalender interaktif yang modern, cepat, dan ramah lingkungan.
    </p>
</section>


<footer>
  &copy; {{ date('Y') }} MPPSI SKIS — Dibuat untuk komunitas
</footer>

<!-- MODAL -->
<div id="eventModal" class="modal-overlay">
  <div class="modal-box">
    <h3 id="modalTitle"></h3>
    <p id="modalDesc"></p>
    <p><strong>Waktu:</strong> <span id="modalTime"></span></p>
    <p><strong>Tanggal:</strong> <span id="modalDate"></span></p>
    <p><strong>Lokasi:</strong> <span id="modalLokasi"></span></p> <!-- 👈 Tambahan -->
    <button onclick="closeModal()" class="btn-close">Tutup</button>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

  var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
    initialView:'dayGridMonth',
    headerToolbar:{ 
      left:'prev,next today', 
      center:'title', 
      right:'dayGridMonth,timeGridWeek,timeGridDay' 
    },
    height:'auto',

    events:'{{ route('admin.kegiatan.events') }}',

    eventClick:function(info){
      document.getElementById('modalTitle').innerText = info.event.title;
      document.getElementById('modalDesc').innerText = info.event.extendedProps.description ?? '-';

      let tanggal = new Date(info.event.start).toLocaleDateString('id-ID');
      let waktu = new Date(info.event.start).toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'});

      document.getElementById('modalDate').innerText = tanggal;
      document.getElementById('modalTime').innerText = waktu;
        document.getElementById('modalLokasi').innerText = info.event.extendedProps.lokasi ?? '-';

      document.getElementById('eventModal').style.display = 'flex';
    }
  });

  calendar.render();
});

function closeModal(){
    document.getElementById('eventModal').style.display = 'none';
}
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
