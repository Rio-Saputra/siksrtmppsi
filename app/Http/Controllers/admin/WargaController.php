<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class WargaController extends Controller
{
    public function index()
    {
        // Ambil semua user dengan role "user"
        $warga = User::where('role', 'user')->get();

        return view('admin.warga', compact('warga'));
    }

    /**
     * Hapus data warga
     */
    public function destroy($id)
    {
        $warga = User::where('role', 'user')->findOrFail($id);

        // Hapus foto KTP jika ada
        if ($warga->ktp && Storage::disk('public')->exists($warga->ktp)) {
            Storage::disk('public')->delete($warga->ktp);
        }

        // Hapus data warga
        $warga->delete();

        return redirect()->back()->with('success', 'Data warga berhasil dihapus');
    }
}
