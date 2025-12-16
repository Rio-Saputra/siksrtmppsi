<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Warga - MPPSI SKIS</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root {
  --green-dark: #2f6046;
  --green-soft: #e9f5ef;
  --green-border: #c8e2d4;
  --green-text: #244b36;
}

* { box-sizing: border-box; }

html, body {
  height: 100%;
  margin: 0;
}

body {
  display: flex;
  flex-direction: column;
  font-family: "Poppins", system-ui;
  background: linear-gradient(180deg, #eef6f0 0%, #fbfdfc 100%);
}

/* ======== PAGE FLEX ======== */
.page-container {
  flex: 1;
  max-width: 1400px;
  margin: 0 auto;
  padding: 20px 40px;
  display: flex;
  flex-direction: column;
}

.wrap {
  background: #fff;
  padding: 40px;
  border-radius: 22px;
  box-shadow: 0 12px 30px rgba(0,0,0,0.08);
  flex: 1;
  display: flex;
  flex-direction: column;
}

h1 {
  text-align: center;
  color: var(--green-dark);
  margin-bottom: 25px;
}

/* ======== TOP BAR ======== */
.top-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 20px;
}

.search-box {
  position: relative;
}

.search-box input {
  padding: 10px 40px 10px 14px;
  border-radius: 10px;
  border: 1px solid var(--green-border);
  width: 250px;
}

.search-box i {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--green-dark);
}

select {
  padding: 10px;
  border-radius: 10px;
  border: 1px solid var(--green-border);
}

/* ======== TABLE SCROLL ======== */
.table-fixed {
  flex: 1;
  overflow-y: auto;
  overflow-x: auto;
  border-radius: 12px;
  border: 1px solid var(--green-border);
  background: white;
}

table {
  width: 100%;
  table-layout: fixed;
  border-collapse: collapse;
  font-size: 15px;
}

thead {
  background: var(--green-dark);
  color: white;
}

th, td {
  padding: 12px;
  text-align: center;
  border-bottom: 1px solid var(--green-border);
  color: var(--green-text);
}

tr:hover td {
  background: var(--green-soft);
}

/* ======== BUTTON AKSI ======== */
.aksi-btn {
  display: flex;
  justify-content: center;
  gap: 10px;
}

.icon-btn {
  background: none;
  border: none;
  font-size: 18px;
  cursor: pointer;
  transition: 0.2s;
}

.icon-btn.detail { color: #2f6046; }
.icon-btn.delete { color: #d43a3a; }
.icon-btn:hover { transform: scale(1.15); }

/* ======== MODAL DETAIL ======== */
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
  padding: 25px;
  border-radius: 14px;
  width: 350px;
  position: relative;
  text-align: center;
}
.modal-content img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin-top: 10px;
    cursor: pointer;
}


.modal-content h3 {
  margin-top: 0;
  color: var(--green-dark);
  margin-bottom: 15px;
}

.close {
  position: absolute;
  top: 10px;
  right: 15px;
  cursor: pointer;
  font-size: 18px;
  font-weight: bold;
}

/* ========= MODAL FOTO BESAR ========= */
#imageModal {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  display: none;
  justify-content: center;
  align-items: center;
  background: rgba(0,0,0,0.85);
  z-index: 1000;
  cursor: pointer;
}

#imageModal img {
  max-width: 90%;
  max-height: 90%;
  border-radius: 10px;
}

/* ========= MODAL DELETE ========= */
#deleteModal .modal-content {
  width: 360px;
}

.delete-btns {
  display: flex;
  justify-content: center;
  gap: 12px;
  margin-top: 20px;
}

.btn-cancel,
.btn-delete {
  padding: 10px 20px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  font-size: 14px;
}

.btn-cancel {
  background: #ccc;
}

.btn-delete {
  background: #d43a3a;
  color: white;
}

/* ======== FOOTER ======== */
footer {
  text-align: center;
  padding: 20px;
  color: #4e6b59;
  margin-top: auto;
}
</style>
</head>

<body>

@include('admin.layout.navbar')

<div class="page-container">
  <div class="wrap">
    <h1>Data Warga</h1>

    <div class="top-bar">
      <div class="search-box">
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari warga...">
        <i class="fa-solid fa-magnifying-glass"></i>
      </div>

      <select id="filterGender" onchange="filterGender()">
        <option value="semua">Filter Gender</option>
        <option value="laki-laki">Laki-laki</option>
        <option value="perempuan">Perempuan</option>
      </select>
    </div>

    <div class="table-fixed">
      <table id="tabelWarga">
        <thead>
          <tr>
            <th style="width:50px">No</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>NIK</th>
            <th style="width:150px">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($warga as $index => $w)
          <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $w->name }}</td>
            <td>{{ $w->gender ?? '-' }}</td>
            <td>{{ $w->nik }}</td>
            <td class="aksi-btn">
              <button class="icon-btn detail" 
                onclick="showDetail('{{ $w->name }}','{{ $w->gender }}','{{ $w->nik }}','{{ $w->email }}','{{ $w->ktp }}')">
                <i class="fa-solid fa-eye"></i>
              </button>

              <!-- BUTTON DELETE MENGGUNAKAN MODAL -->
              <button class="icon-btn delete" onclick="showDeleteModal({{ $w->id }})">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </tr>
          @empty
          <tr><td colspan="5">Tidak ada data warga.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- ========= MODAL DETAIL ========= -->
<div class="modal" id="detailModal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">×</span>
    <h3>Detail Warga</h3>
    <p><strong>Nama:</strong> <span id="detailName"></span></p>
    <p><strong>Gender:</strong> <span id="detailGender"></span></p>
    <p><strong>NIK:</strong> <span id="detailNIK"></span></p>
    <p><strong>Email:</strong> <span id="detailEmail"></span></p>
    <img id="detailKTP" src="" alt="Foto KTP" onclick="openImageModal(this.src)">
  </div>
</div>

<!-- ========= MODAL FOTO BESAR ========= -->
<div class="modal" id="imageModal" onclick="closeImageModal()">
  <img id="enlargedKTP" src="">
</div>

<!-- ========= MODAL DELETE ========= -->
<div class="modal" id="deleteModal">
  <div class="modal-content">
    <h3>Hapus Data?</h3>
    <p>Data warga akan dihapus secara permanen.</p>

    <div class="delete-btns">
      <button class="btn-cancel" onclick="closeDeleteModal()">Batal</button>
      <button class="btn-delete" onclick="submitDelete()">Hapus</button>
    </div>
  </div>
</div>

<form id="deleteForm" method="POST" style="display:none;">
  @csrf
  @method('DELETE')
</form>


<script>
function searchTable() {
  const input = document.getElementById('searchInput').value.toLowerCase();
  const rows = document.querySelectorAll('#tabelWarga tbody tr');
  rows.forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(input) ? '' : 'none';
  });
}

function filterGender() {
  const gender = document.getElementById('filterGender').value.toLowerCase();
  const rows = document.querySelectorAll('#tabelWarga tbody tr');
  rows.forEach(row => {
    const val = row.cells[2].innerText.toLowerCase();
    row.style.display = (gender === 'semua' || val === gender) ? '' : 'none';
  });
}

/* ===== DETAIL MODAL ===== */
function showDetail(name, gender, nik, email, ktp){
  document.getElementById('detailName').innerText = name;
  document.getElementById('detailGender').innerText = gender;
  document.getElementById('detailNIK').innerText = nik;
  document.getElementById('detailEmail').innerText = email;
  if (ktp) {
      if (ktp.startsWith('http')) {
          document.getElementById('detailKTP').src = ktp;
      } else {
          document.getElementById('detailKTP').src = '/storage/' + ktp;
      }
  } else {
      document.getElementById('detailKTP').src = ''; // Placeholder or empty
      // Optional: hide image if no KTP
  }
  document.getElementById('detailModal').style.display = 'flex';
}

function closeModal(){
  document.getElementById('detailModal').style.display = 'none';
}

/* ===== IMAGE MODAL ===== */
function openImageModal(src){
  document.getElementById('enlargedKTP').src = src;
  document.getElementById('imageModal').style.display = 'flex';
}

function closeImageModal(){
  document.getElementById('imageModal').style.display = 'none';
}

/* ===== DELETE MODAL ===== */
let deleteId = null;

function showDeleteModal(id){
  deleteId = id;
  document.getElementById('deleteModal').style.display = 'flex';
}

function closeDeleteModal(){
  document.getElementById('deleteModal').style.display = 'none';
}

function submitDelete(){
  const form = document.getElementById('deleteForm');
  form.action = "/admin/warga/" + deleteId;
  form.submit();
}
</script>

<footer>© {{ date('Y') }} MPPSI SKIS — Data Warga</footer>

</body>
</html>
