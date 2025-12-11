<!-- ====================== NAVBAR USER ====================== -->

<style>
  * { box-sizing: border-box; }
  body { margin:0; font-family:"Poppins", sans-serif; }

  .navbar-user{
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

  .brand-user{
    display:flex;
    align-items:center;
    gap:12px;
  }

  .brand-user .logo{
    width:40px;
    height:40px;
    border-radius:10px;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
    font-weight:700;
    font-size:18px;
  }

  .brand-user .logo img{
    width:100%;
    height:100%;
    object-fit:contain;
  }

  .brand-user-title{
    margin:0;
    font-size:16px;
    font-weight:700;
    color:#274b39;
  }

  .brand-user-sub{
    margin:0;
    font-size:12px;
    color:#607860;
    margin-top:-2px;
  }

  .nav-user-links{
    display:flex;
    gap:30px;
    align-items:center;
  }

  .nav-user-links a{
    text-decoration:none;
    color:#274b39;
    font-weight:600;
    padding:6px 2px;
    transition:0.25s ease;
  }

  .nav-user-links a:hover{
    color:#1E7F53;
    font-weight:700;
  }

  .nav-user-links a.active{
    color:#1E7F53;
    font-weight:700;
    border-bottom:2px solid #1E7F53;
    padding-bottom:4px;
  }

  /* PROFILE ICON */
  .profile-wrapper{
    position:relative;
  }

  .profile-user{
    width:40px;
    height:40px;
    border-radius:50%;
    background:#274b39;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    cursor:pointer;
    transition:0.25s ease;
    font-size:16px;
  }

  .profile-user:hover{
    background:#1E7F53;
    transform:scale(1.08);
  }

  /* DROPDOWN MENU */
  .profile-dropdown{
    position:absolute;
    top:48px;
    right:0;
    background:white;
    width:150px;
    border-radius:10px;
    box-shadow:0 4px 16px rgba(0,0,0,0.1);
    display:none;
    flex-direction:column;
    overflow:hidden;
    animation: fade 0.2s ease;
  }

  @keyframes fade {
    from { opacity:0; transform: translateY(-6px); }
    to   { opacity:1; transform: translateY(0); }
  }

  .profile-dropdown a{
    padding:10px 14px;
    font-size:14px;
    color:#274b39;
    text-decoration:none;
    transition:.2s;
  }

  .profile-dropdown a:hover{
    background:#f4f4f4;
  }

  .logout-btn{
    color:#d63031 !important;
    font-weight:700;
  }

  .logout-btn:hover{
    background:#ffe5e5 !important;
  }
</style>

<nav class="navbar-user">

  <div class="brand-user">
      <div class="logo">
          <img src="{{ asset('images/Logo.png') }}" alt="Logo">
      </div>

      <div>
          <p class="brand-user-title">MPPSI SKIS</p>
          <p class="brand-user-sub">User Dashboard</p>
      </div>
  </div>

  <div class="nav-user-links">

      <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
         Dashboard
      </a>

      <a href="{{ route('user.kegiatan') }}" class="{{ request()->routeIs('user.kegiatan') ? 'active' : '' }}">
         Kegiatan
      </a>

      <a href="{{ route('user.permintaan') }}" class="{{ request()->routeIs('user.permintaan') ? 'active' : '' }}">
         Permintaan
      </a>

      <a href="{{ route('user.about') }}" class="{{ request()->routeIs('user.about') ? 'active' : '' }}">
         Tentang Kami
      </a>

      <!-- PROFILE DROPDOWN -->
      <div class="profile-wrapper">
        <div class="profile-user" id="profileIcon">
          <i class="fa-solid fa-user"></i>
        </div>

        <!-- Dropdown -->
        <div class="profile-dropdown" id="dropdownMenu">
            <a href="{{ route('profile') }}">
              <i class="fa-solid fa-id-card"></i> &nbsp; Profile
            </a>

            <a href="#" class="logout-btn" id="logoutDropdown">
              <i class="fa-solid fa-right-from-bracket"></i> &nbsp; Logout
            </a>
        </div>
      </div>

  </div>
</nav>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
/* Toggle dropdown */
const profileIcon = document.getElementById("profileIcon");
const dropdown = document.getElementById("dropdownMenu");

profileIcon.addEventListener("click", () => {
    dropdown.style.display = dropdown.style.display === "flex" ? "none" : "flex";
});

/* Close dropdown when clicking outside */
document.addEventListener("click", function (e) {
    if (!document.querySelector(".profile-wrapper").contains(e.target)) {
        dropdown.style.display = "none";
    }
});

/* Logout Button */
document.getElementById("logoutDropdown").addEventListener("click", function(e){
    e.preventDefault();

    Swal.fire({
        title: "Yakin ingin logout?",
        text: "Anda akan keluar dari akun.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, logout",
        cancelButtonText: "Batal",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('logout') }}";
        }
    });
});
</script>
