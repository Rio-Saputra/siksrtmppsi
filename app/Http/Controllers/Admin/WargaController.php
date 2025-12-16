<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;

class WargaController extends Controller
{
    public function index()
    {
        $warga = User::where('role', 'user')->get();
        return view('admin.warga', compact('warga'));
    }

    /**
     * Hapus data warga
     */
    public function destroy($id)
    {
        $warga = User::where('role', 'user')->findOrFail($id);

        // ===============================
        // HAPUS FOTO KTP DI CLOUDINARY
        // ===============================
        if ($warga->ktp) {
            try {
                /**
                 * Contoh ktp:
                 * https://res.cloudinary.com/demo/image/upload/v123456/ktp/abc123.jpg
                 */

                // Ambil public_id dari URL Cloudinary
                $publicId = pathinfo(parse_url($warga->ktp, PHP_URL_PATH), PATHINFO_FILENAME);

                // Jika ada folder ktp/
                if (str_contains($warga->ktp, '/ktp/')) {
                    $publicId = 'ktp/' . $publicId;
                }

                Cloudinary::destroy($publicId);

            } catch (\Exception $e) {
                Log::warning('Gagal hapus KTP Cloudinary: ' . $e->getMessage());
            }
        }

        // ===============================
        // HAPUS DATA DATABASE
        // ===============================
        $warga->delete();

        return redirect()->back()->with('success', 'Data warga berhasil dihapus');
    }
}
