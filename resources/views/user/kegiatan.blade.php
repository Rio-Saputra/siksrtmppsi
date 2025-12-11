<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kegiatan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --green-dark: #2f6046;
            --green-soft: #e9f5ef;
            --green-border: #c8e2d4;
            --green-text: #244b36;
        }

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
            margin-bottom: 40px;
        }

        h3 {
            color: var(--green-dark);
            font-weight: 700;
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
        }

        tr:hover td {
            background: var(--green-soft);
        }

        td:nth-child(1), td:nth-child(4), td:nth-child(5), td:nth-child(6) {
            text-align: center;
        }

        .badge {
            font-size: 12px;
            padding: 6px 10px;
        }
    </style>
</head>

<body>

@include('user.layout.navbar')

<div class="page-container">

    <!-- ===================== -->
    <!-- TO-DO LIST Kegiatan   -->
    <!-- ===================== -->
    <div class="wrap">
        <h3>Kegiatan Belum Dilaksanakan (To-Do List)</h3>

        <div class="table-fixed">
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach(App\Models\Kegiatan::orderBy('tanggal','asc')->get() as $k)
                        @php
                            $tanggal = \Carbon\Carbon::parse($k->tanggal);
                            if($tanggal->isPast()) continue;
                        @endphp

                        <tr>
                            <td>{{ $k->judul }}</td>
                            <td>{{ $tanggal->format('d M Y') }}</td>
                            <td>{{ $k->jam ?? '-' }}</td>
                            <td>{{ $k->lokasi ?? '-' }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    Belum Dilaksanakan
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>



    <!-- ===================== -->
    <!-- KEGIATAN SELESAI      -->
    <!-- ===================== -->
    <div class="wrap">
        <h3>Kegiatan Yang Sudah Dilaksanakan</h3>

        <div class="table-fixed">
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach(App\Models\Kegiatan::orderBy('tanggal','desc')->get() as $k)
                        @php
                            $tanggal = \Carbon\Carbon::parse($k->tanggal);
                            if(!$tanggal->isPast()) continue;
                        @endphp

                        <tr>
                            <td>{{ $k->judul }}</td>
                            <td>{{ $tanggal->format('d M Y') }}</td>
                            <td>{{ $k->jam ?? '-' }}</td>
                            <td>{{ $k->lokasi ?? '-' }}</td>
                            <td>
                                <span class="badge bg-success">
                                    Selesai
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>

</body>
</html>
