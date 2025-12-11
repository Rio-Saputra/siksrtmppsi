<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermintaanKegiatan;
use Illuminate\Support\Facades\Auth;

class PermintaanKegiatanController extends Controller
{
    public function index()
    {
        $permintaan = PermintaanKegiatan::where('user_id', Auth::id())->get();
        return view('user.permintaan', compact('permintaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'lokasi' => 'required|string',
        ]);

        PermintaanKegiatan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'lokasi' => $request->lokasi,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Permintaan kegiatan telah dikirim!');
    }
}
