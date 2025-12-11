<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class AdminController extends Controller
{
    public function kegiatan()
    {
        // Ambil semua data kegiatan dari database
        $kegiatan = Kegiatan::all();

        // Kirim data ke view
        return view('admin.kegiatan', compact('kegiatan'));
    }
    
    public function permintaan()
{
    $permintaan = Kegiatan::where('status', 'pending')->get();
    return view('admin.permintaan', compact('permintaan'));
}

public function approve($id)
{
    Kegiatan::where('id', $id)->update(['status' => 'approved']);
    return back()->with('success', 'Kegiatan disetujui.');
}

public function reject($id)
{
    Kegiatan::where('id', $id)->update(['status' => 'rejected']);
    return back()->with('error', 'Kegiatan ditolak.');
}

}
