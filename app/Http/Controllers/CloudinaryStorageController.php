<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CloudinaryStorageController extends Controller
{
    public function upload(Request $request)
    {
        // Validasi input (wajib ada file 'image')
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses Upload ke Cloudinary
        // getRealPath() mengambil lokasi sementara file di server
        $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
            'folder' => 'mppsi_uploads' // Opsional: nama folder di Cloudinary
        ]);

        // Ambil URL gambar yang sudah diupload
        $url = $uploadedFile->getSecurePath();
        
        // Ambil Public ID (berguna jika nanti mau hapus gambar)
        $publicId = $uploadedFile->getPublicId();

        return response()->json([
            'message' => 'Upload berhasil!',
            'url' => $url,
            'public_id' => $publicId
        ]);
    }
}