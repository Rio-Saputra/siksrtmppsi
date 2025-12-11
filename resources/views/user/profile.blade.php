@include('user.layout.navbar')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile User</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #e9eee8;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }

        .profile-container {
            width: 90%;
            max-width: 950px;
            margin: 40px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            border-top: 8px solid #274b39;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .profile-icon img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #274b39;
        }

        .profile-title {
            font-size: 26px;
            margin-top: 15px;
            font-weight: bold;
            color: #274b39;
        }

        .profile-info {
            margin-top: 25px;
        }

        .info-group {
            margin-bottom: 15px;
        }

        .info-label {
            font-weight: bold;
            color: #274b39;
        }

        .info-value {
            margin-top: 4px;
            font-size: 16px;
            padding: 10px;
            background: #f3f6f4;
            border-radius: 8px;
        }

        .btn-edit {
            display: inline-block;
            background: #274b39;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s;
        }

        .btn-edit:hover {
            background: #1d3a2c;
        }

        /* FOTO KTP */
        .ktp-photo {
            width: 100%;
            max-width: 380px;
            border-radius: 10px;
            margin-top: 10px;
            border: 3px solid #274b39;
        }

        /* POPUP MODAL */
        .modal {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.6);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            width: 90%;
            max-width: 500px;
            background: #ffffff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            font-weight: 600;
            color: #274b39;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        .btn-save {
            width: 100%;
            padding: 12px;
            background: #274b39;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-close {
            margin-top: 10px;
            width: 100%;
            padding: 12px;
            background: #b83a3a;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="profile-container">

    <!-- FOTO PROFIL -->
    <div class="profile-header">
        <div class="profile-icon">
          <img src="{{ asset('images/Logo.png') }}" 
     alt="Logo Profil" 
     class="profile-photo">

        </div>

        <h2 class="profile-title">Profile Saya</h2>

        <button class="btn-edit" onclick="openModal()">Edit Profil</button>
    </div>

    <div class="profile-info">

        <div class="info-group">
            <div class="info-label">Nama Lengkap</div>
            <div class="info-value">{{ $user->name }}</div>
        </div>

        <div class="info-group">
            <div class="info-label">Jenis Kelamin</div>
            <div class="info-value">{{ $user->gender ?? '-' }}</div>
        </div>

        <div class="info-group">
            <div class="info-label">NIK</div>
            <div class="info-value">{{ $user->nik ?? '-' }}</div>
        </div>

        <div class="info-group">
            <div class="info-label">Email</div>
            <div class="info-value">{{ $user->email }}</div>
        </div>

        <div class="info-group">
            <div class="info-label">Foto KTP</div>
            <img src="{{ asset('storage/'.$user->ktp) }}" class="ktp-photo">
        </div>

    </div>

</div>


<!-- ===================== MODAL EDIT ===================== -->
<div class="modal" id="editModal">
    <div class="modal-content">

        <h3 style="margin-bottom: 15px; color:#274b39">Edit Data Profil</h3>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ $user->name }}">
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="gender">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ $user->gender=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $user->gender=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" value="{{ $user->nik }}">
            </div>

            <div class="form-group">
                <label>Foto KTP (Upload Baru)</label>
                <input type="file" name="ktp">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}">
            </div>

            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </form>

        <button class="btn-close" onclick="closeModal()">Batal</button>

    </div>
</div>

<script>
function openModal() {
    document.getElementById("editModal").style.display = "flex";
}
function closeModal() {
    document.getElementById("editModal").style.display = "none";
}
</script>

</body>
</html>
