<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Kegiatan Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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

        h3 { 
            color: var(--green-dark); 
            font-weight: 700;
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
            font-size: 20px;
            cursor: pointer;
        }

        .approve { color: #2f6046; }
        .reject { color: #d43a3a; }
        .delete { color: #b30000; }

        /* ========== MODAL DELETE ========== */
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

        @keyframes fadeIn {
            from { transform: scale(.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .delete-box i {
            font-size: 50px;
            color: #d43a3a;
            margin-bottom: 10px;
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

    <h3 class="mb-3">Data Permintaan Kegiatan</h3>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-fixed mt-3">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($permintaan as $p)
                <tr>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ $p->judul }}</td>
                    <td>{{ $p->tanggal }}</td>
                    <td>{{ $p->lokasi }}</td>

                    <td>
                        @if($p->status == 'pending')
                        <span class="badge bg-warning">Menunggu</span>
                        @elseif($p->status == 'diterima')
                        <span class="badge bg-success">Diterima</span>
                        @else
                        <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>

                    <td>
                        <div class="aksi-btn">
                            
                            @if($p->status == 'pending')
                            <form action="{{ route('admin.permintaan.approve', $p->id) }}" method="POST">
                                @csrf
                                <button class="icon-btn approve"><i class="fa-solid fa-check"></i></button>
                            </form>

                            <form action="{{ route('admin.permintaan.reject', $p->id) }}" method="POST">
                                @csrf
                                <button class="icon-btn reject"><i class="fa-solid fa-xmark"></i></button>
                            </form>
                            @endif

                            <button 
                                class="icon-btn delete" 
                                onclick="openDeleteModal('{{ $p->id }}')">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
</div>

<!-- ========== MODAL HAPUS ========== -->
<div id="deleteModal">
    <div class="delete-box">
        <i class="fa-solid fa-trash"></i>
        <h3>Hapus Data?</h3>
        <p>Data yang dihapus tidak bisa dikembalikan.</p>

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
function openDeleteModal(id) {
    let url = "{{ url('/admin/permintaan/delete') }}/" + id; 
    document.getElementById("deleteForm").action = url;
    document.getElementById("deleteModal").style.display = "flex";
}

function closeDeleteModal() {
    document.getElementById("deleteModal").style.display = "none";
}
</script>


<script src="https://kit.fontawesome.com/a2d9d6cadc.js" crossorigin="anonymous"></script>

</body>
</html>
