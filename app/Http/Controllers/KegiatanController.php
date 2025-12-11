<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    // 🔹 Menampilkan semua kegiatan
    public function index()
    {
        $kegiatan = Kegiatan::all();
        return view('admin.kegiatan', compact('kegiatan'));
    }

    // 🔹 Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'lokasi' => 'nullable|string|max:255', // 👈 DITAMBAHKAN
        ]);

        Kegiatan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'lokasi' => $request->lokasi, // 👈 DITAMBAHKAN
        ]);

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    // 🔹 Mengupdate data
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'lokasi' => 'nullable|string|max:255', // 👈 DITAMBAHKAN
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'lokasi' => $request->lokasi, // 👈 DITAMBAHKAN
        ]);

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    // 🔹 Menghapus data
    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil dihapus.');
    }

    // 🔹 Return data untuk kalender
    public function getEvents()
    {
        $kegiatan = Kegiatan::all();

        $events = $kegiatan->map(function ($item) {
            return [
                'id'          => $item->id,
                'title'       => ucfirst($item->judul),
                'start'       => $item->tanggal . 'T' . $item->jam,
                'description' => $item->deskripsi,
                'lokasi'      => $item->lokasi ?? '-', // 👈 DITAMBAHKAN
            ];
        });

        return response()->json($events);
    }

    // 🔹 Detail event
    public function show($id)
    {
        $k = Kegiatan::findOrFail($id);

        return response()->json([
            'id'        => $k->id,
            'judul'     => $k->judul,
            'tanggal'   => $k->tanggal,
            'jam'       => $k->jam ?? '-',
            'deskripsi' => $k->deskripsi ?? '-',
            'lokasi'    => $k->lokasi ?? '-', // 👈 DITAMBAHKAN
        ]);
    }

    // 🔹 User mengajukan request kegiatan (status pending)
    public function userRequest(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'lokasi' => 'nullable|string|max:255', // 👈 DITAMBAHKAN
        ]);

        Kegiatan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'lokasi' => $request->lokasi,    // 👈 DITAMBAHKAN
            'status' => 'pending'
        ]);

        return back()->with('success', 'Permintaan kegiatan berhasil diajukan. Menunggu persetujuan admin.');
    }
}
