<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermintaanKegiatan;
use App\Models\Kegiatan;

class PermintaanKegiatanController extends Controller
{
    /**
     * Tampilkan semua permintaan kegiatan
     */
    public function index()
    {
        $permintaan = PermintaanKegiatan::with('user')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.permintaan', compact('permintaan'));
    }

    /**
     * Setujui permintaan kegiatan
     */
    public function approve($id)
    {
        $req = PermintaanKegiatan::findOrFail($id);

        // otomatis masukkan ke tabel kegiatan
        Kegiatan::create([
            'judul'     => $req->judul,
            'deskripsi' => $req->deskripsi,
            'tanggal'   => $req->tanggal,
            'jam'       => $req->jam,
            'lokasi'    => $req->lokasi,
        ]);

        $req->update(['status' => 'diterima']);

        return back()->with('success', 'Kegiatan telah disetujui!');
    }

    /**
     * Tolak permintaan kegiatan
     */
    public function reject($id)
    {
        $req = PermintaanKegiatan::findOrFail($id);
        $req->update(['status' => 'ditolak']);

        return back()->with('success', 'Permintaan kegiatan ditolak!');
    }

    /**
     * Hapus permintaan kegiatan
     */
    public function destroy($id)
    {
        $data = PermintaanKegiatan::findOrFail($id);
        $data->delete();

        return back()->with('success', 'Permintaan berhasil dihapus!');
    }
}
