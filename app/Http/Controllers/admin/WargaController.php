<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
        if ($warga->ktp) {
             // Extract public ID (assuming simple folder structure 'ktp/filename')
             $publicId = 'ktp/' . pathinfo($warga->ktp, PATHINFO_FILENAME);
             try {
                Cloudinary::destroy($publicId);
             } catch (\Exception $e) {
                 // Log error or ignore if already deleted
             }
        }

        // Hapus data warga
        $warga->delete();

        return redirect()->back()->with('success', 'Data warga berhasil dihapus');
    }
}
