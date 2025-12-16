<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil user.
     */
    public function index()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Update data profil user.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi
        $request->validate([
            'name'   => 'required|string|max:100',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
            'nik'    => 'nullable|max:16',
            'ktp'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email'  => 'required|email|max:100',
        ]);

        // Update data non-file
        $user->name   = $request->name;
        $user->gender = $request->gender;
        $user->nik    = $request->nik;
        $user->email  = $request->email;

        // ======================
        // HANDLE FOTO KTP (CLOUDINARY)
        // ======================
        if ($request->hasFile('ktp')) {

            // Hapus KTP lama di Cloudinary jika ada
            if ($user->ktp) {
                try {
                    $path = parse_url($user->ktp, PHP_URL_PATH);
                    $filename = pathinfo($path, PATHINFO_FILENAME);

                    $publicId = str_contains($path, '/ktp/')
                        ? 'ktp/' . $filename
                        : $filename;

                    Cloudinary::uploadApi()->destroy($publicId);
                } catch (\Exception $e) {
                    Log::warning('Gagal hapus KTP lama: ' . $e->getMessage());
                }
            }

            // Upload KTP baru ke Cloudinary
            $upload = Cloudinary::upload(
                $request->file('ktp')->getRealPath(),
                [
                    'folder' => 'ktp'
                ]
            );

            // Simpan URL Cloudinary ke database
            $user->ktp = $upload->getSecurePath();
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
