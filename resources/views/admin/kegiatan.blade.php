<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Kegiatan - MPPSI SKIS</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  :root {
    --green-dark: #2f6046;
    --green-soft: #e9f5ef;
    --green-border: #c8e2d4;
    --green-text: #244b36;
  }

  * { box-sizing: border-box }
  body {
    margin: 0;
    font-family: "Poppins", system-ui;
    background: linear-gradient(180deg, #eef6f0 0%, #fbfdfc 100%);
  }

  .page-container {
    min-height: calc(100vh - 80px); /* 80px = tinggi footer */
}

  .page-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px 40px;
  }

  .wrap {
    background: #fff;
    padding: 40px;
    border-radius: 22px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
  }

  h1 { text-align: center; color: var(--green-dark); }

  .btn-primary {
    background: var(--green-dark);
    color: #fff;
    padding: 10px 20px;
    border-radius: 10px;
    border: none;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
  }

  .search-box { position: relative }
  .search-box input {
    padding: 10px 40px 10px 14px;
    border: 1px solid var(--green-border);
    border-radius: 10px;
  }
  .search-box i {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--green-dark);
  }

  .top-bar {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-bottom: 20px;
  }

  .table-fixed {
    width: 100%;
    overflow-y: auto;
    max-height: 420px;
    border: 1px solid var(--green-border);
    border-radius: 12px;
  }

  table { width: 100%; border-collapse: collapse; }
  thead {
    background: var(--green-dark);
    color: white;
    text-align: center !important;
  }

  th {
    padding: 12px;
    font-weight: 600;
    text-align: center !important;
  }

  td {
    padding: 12px;
    border-bottom: 1px solid var(--green-border);
    color: var(--green-text);
    text-align: left;
  }

  td:first-child,
  td:nth-child(5),
  td:last-child {
    text-align: center;
  }

  tr:hover td { background: var(--green-soft); }

  .aksi-btn {
    display: flex;
    justify-content: center;
    gap: 8px;
  }

  .icon-btn {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
  }
  .edit { color: #2f6046; }
  .delete { color: #d43a3a; }

  .modal {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.45);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 999;
  }

  .modal-content {
    background: #fff;
    width: 380px;
    padding: 25px;
    border-radius: 14px;
    animation: fadeIn .2s ease;
  }

  @keyframes fadeIn {
    from { transform: scale(.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
  }

  .modal-content h3 {
    text-align: center;
    margin-bottom: 18px;
    color: var(--green-dark);
  }

  .modal-content input,
  .modal-content textarea,
  .modal-content select {
    width: 100%;
    padding: 10px;
    border: 1px solid var(--green-border);
    border-radius: 10px;
    margin-bottom: 12px;
  }

  .modal-btn {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 10px;
    background: var(--green-dark);
    color: white;
    font-weight: 600;
    cursor: pointer;
  }

  .close {
    background: #ccc;
    padding: 8px 12px;
    border-radius: 10px;
    float: right;
    cursor: pointer;
  }
  /* ==================== MODAL HAPUS ==================== */
#deleteModal {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.45);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.delete-box {
  background: #fff;
  width: 360px;
  padding: 25px;
  border-radius: 16px;
  text-align: center;
  animation: fadeIn .2s ease;
}

.delete-box i {
  font-size: 50px;
  color: #d43a3a;
  margin-bottom: 10px;
}

.delete-box h3 {
  margin-bottom: 8px;
  color: var(--green-dark);
  font-size: 22px;
}

.delete-box p {
  color: var(--green-text);
  margin-bottom: 20px;
}

.delete-actions {
  display: flex;
  justify-content: space-between;
  gap: 10px;
}

.btn-cancel {
  flex: 1;
  background: #ccc;
  border: none;
  padding: 10px;
  border-radius: 10px;
  cursor: pointer;
  font-weight: 600;
}

.btn-delete {
  flex: 1;
  background: #d43a3a;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 10px;
  cursor: pointer;
  font-weight: 600;
}


</style>
</head>

<body>

@include('admin.layout.navbar')

<div class="page-container">
  <div class="wrap">

    <h1>Kelola Kegiatan</h1>

    <!-- TOP BAR -->
    <div class="top-bar">
      <button class="btn-primary" onclick="openAddModal()">
        <i class="fa-solid fa-plus"></i> Tambah Kegiatan
      </button>

      <div class="search-box">
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari kegiatan...">
        <i class="fa-solid fa-magnifying-glass"></i>
      </div>

      <select id="filter" onchange="filterTable()">
        <option value="Semua">Semua</option>
        <option value="Arisan">Arisan</option>
        <option value="Kerja Bakti">Kerja Bakti</option>
        <option value="Rapat">Rapat</option>
      </select>
    </div>

    <!-- TABLE -->
    <div class="table-fixed">
      <table id="tabelKegiatan">
        <thead>
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Lokasi</th> <!-- 🔥 DITAMBAHKAN -->
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($kegiatan as $index => $item)
          <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $item->judul }}</td>
            <td>{{ $item->deskripsi }}</td>
            <td>{{ $item->tanggal }}</td>
            <td style="text-align:center">{{ $item->jam }} - selesai</td>
            <td>{{ $item->lokasi ?? '-' }}</td> <!-- 🔥 DITAMBAHKAN -->

            <td class="aksi-btn">
              <button class="icon-btn edit"
                onclick="editKegiatan({{ $item->id }}, 
                  `{{ $item->judul }}`, 
                  `{{ $item->deskripsi }}`, 
                  `{{ $item->tanggal }}`, 
                  `{{ $item->jam }}`,
                  `{{ $item->lokasi }}`)"> <!-- 🔥 DITAMBAHKAN -->
                <i class="fa-solid fa-pen"></i>
              <button type="button" class="icon-btn delete" onclick="openDeleteModal({{ $item->id }})">
  <i class="fa-solid fa-trash"></i>
</button>

              </form>

            </td>
          </tr>
          @empty
          <tr><td colspan="7" style="text-align:center">Belum ada kegiatan.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>

<!-- ====================== MODAL ADD ======================= -->
<div class="modal" id="addModal">
  <div class="modal-content">
    <span class="close" onclick="closeAddModal()">×</span>
    <h3>Tambah Kegiatan</h3>

    <form action="{{ route('admin.kegiatan.store') }}" method="POST">
      @csrf

      <select name="judul" required>
        <option value="">Pilih kegiatan</option>
        <option value="Rapat">Rapat</option>
        <option value="Kerja Bakti">Kerja Bakti</option>
        <option value="Arisan">Arisan</option>
      </select>

      <textarea name="deskripsi" rows="3" placeholder="Deskripsi kegiatan" required></textarea>

      <input type="date" name="tanggal" required>
      <input type="time" name="jam" required>

      <input type="text" name="lokasi" placeholder="Lokasi kegiatan"> <!-- 🔥 DITAMBAHKAN -->

      <button class="modal-btn" type="submit">Simpan</button>
    </form>
  </div>
</div>

<!-- ====================== MODAL EDIT ======================= -->
<div class="modal" id="editModal">
  <div class="modal-content">
    <span class="close" onclick="closeEditModal()">×</span>
    <h3>Edit Kegiatan</h3>

    <form id="editForm" method="POST">
      @csrf
      @method('PUT')

      <select id="editJudul" name="judul" required>
        <option value="Rapat">Rapat</option>
        <option value="Kerja Bakti">Kerja Bakti</option>
        <option value="Arisan">Arisan</option>
      </select>

      <textarea id="editDeskripsi" name="deskripsi" rows="3" required></textarea>

      <input type="date" id="editTanggal" name="tanggal" required>
      <input type="time" id="editJam" name="jam" required>

      <input type="text" id="editLokasi" name="lokasi" placeholder="Lokasi kegiatan"> <!-- 🔥 DITAMBAHKAN -->

      <button class="modal-btn" type="submit">Update</button>
    </form>
  </div>
</div>

<!-- ====================== MODAL DELETE ======================= -->
<div id="deleteModal">
  <div class="delete-box">
    <i class="fa-solid fa-circle-exclamation"></i>
    <h3>Hapus Kegiatan?</h3>
    <p>Data yang dihapus tidak dapat dikembalikan.</p>

    <form id="deleteForm" method="POST">
      @csrf
      @method('DELETE')

      <div class="delete-actions">
        <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Batal</button>
        <button type="submit" class="btn-delete">Hapus</button>
      </div>
    </form>

  </div>
</div>


<script>
function searchTable() {
  let input = document.getElementById("searchInput").value.toLowerCase();
  document.querySelectorAll("#tabelKegiatan tbody tr").forEach(tr => {
    tr.style.display = tr.innerText.toLowerCase().includes(input) ? "" : "none";
  });
}

function filterTable() {
  let filter = document.getElementById("filter").value.toLowerCase();
  document.querySelectorAll("#tabelKegiatan tbody tr").forEach(row => {
    row.style.display = (filter === "semua" || row.cells[1].innerText.toLowerCase() === filter)
      ? ""
      : "none";
  });
}

function openAddModal() { document.getElementById("addModal").style.display = "flex"; }
function closeAddModal() { document.getElementById("addModal").style.display = "none"; }
function closeEditModal() { document.getElementById("editModal").style.display = "none"; }

function editKegiatan(id, judul, deskripsi, tanggal, jam, lokasi) {
  document.getElementById("editModal").style.display = "flex";

  document.getElementById("editJudul").value = judul;
  document.getElementById("editDeskripsi").value = deskripsi;
  document.getElementById("editTanggal").value = tanggal;
  document.getElementById("editJam").value = jam;
  document.getElementById("editLokasi").value = lokasi; // 🔥 DITAMBAHKAN

  document.getElementById("editForm").action = "/admin/kegiatan/" + id;
}

function openDeleteModal(id) {
  document.getElementById("deleteModal").style.display = "flex";
  document.getElementById("deleteForm").action = "/admin/kegiatan/" + id;
}

function closeDeleteModal() {
  document.getElementById("deleteModal").style.display = "none";
}

</script>

<footer style="text-align:center; padding:20px; color:#4e6b59;">
  © {{ date('Y') }} MPPSI SKIS — Dibuat untuk komunitas
</footer>

</body>
</html>
