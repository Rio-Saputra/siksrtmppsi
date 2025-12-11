<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>

  <!-- Font -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background: #f7faf8;
    }

    /* NAVBAR */
    .navbar {
      width: 100%;
      background: #ffffff;
      padding: 12px 28px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 999;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .brand-container {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .brand-logo img {
      width: 40px;
      height: 40px;
      object-fit: contain;
      display: block;
    }

    .brand-logo {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      background: #ffffff;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    .brand-title {
      margin: 0;
      font-size: 16px;
      font-weight: 700;
      color: #274b39;
    }

    .brand-sub {
      margin: 0;
      font-size: 12px;
      color: #607860;
      margin-top: -2px;
    }

    .nav-links {
      display: flex;
      gap: 30px;
      align-items: center;
    }

    .nav-links a {
      text-decoration: none;
      color: #274b39;
      font-weight: 600;
      padding: 6px 2px;
      transition: 0.25s ease;
    }

    .nav-links a:hover {
      color: #1E7F53;
      font-weight: 700;
    }

    .nav-links a.active {
      color: #1E7F53;
      font-weight: 700;
      border-bottom: 2px solid #1E7F53;
      padding-bottom: 4px;
    }

    /* LOGOUT ICON */
    .logout-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #c0392b;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 18px;
      cursor: pointer;
      transition: 0.25s ease;
    }

    .logout-icon:hover {
      background: #e74c3c;
      transform: scale(1.08);
    }
  </style>
</head>

<body>

  <nav class="navbar">

    <!-- BRAND -->
    <div class="brand-container">
      <div class="brand-logo">
        <img src="{{ asset('images/Logo.png') }}" alt="Logo" onerror="this.style.display='none'">
      </div>

      <div>
        <p class="brand-title">SKIS</p>
        <p class="brand-sub">Admin Dashboard</p>
      </div>
    </div>

    <!-- MENU -->
    <div class="nav-links">
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
      <a href="{{ route('admin.kegiatan') }}" class="{{ request()->routeIs('admin.kegiatan') ? 'active' : '' }}">Kegiatan</a>
      <a href="{{ route('admin.permintaan') }}" class="{{ request()->routeIs('admin.permintaan') ? 'active' : '' }}">Permintaan</a>
      <a href="{{ route('admin.warga') }}" class="{{ request()->routeIs('admin.warga') ? 'active' : '' }}">Warga</a>
      <a href="{{ route('admin.about') }}" class="{{ request()->routeIs('admin.about') ? 'active' : '' }}">About</a>
    </div>

    <!-- LOGOUT ICON -->
    <div class="logout-icon" id="logoutAdminBtn">
      <i class="fa-solid fa-right-from-bracket"></i>
    </div>

  </nav>

  <div style="padding: 30px;">
    @yield('content')
  </div>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Logout Popup -->
  <script>
    document.getElementById("logoutAdminBtn").addEventListener("click", function(e){
        e.preventDefault();

        Swal.fire({
            title: "Yakin ingin logout?",
            text: "Anda akan keluar dari akun Admin.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, logout",
            cancelButtonText: "Batal",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('logout') }}"; // GET Logout
            }
        });
    });
  </script>

</body>
</html>
