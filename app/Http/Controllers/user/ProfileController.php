<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'name'      => 'required|string|max:100',
            'gender'    => 'nullable|in:Laki-laki,Perempuan',
            'nik'       => 'nullable|max:16',
            'ktp'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email'     => 'required|email|max:100',
        ]);

        // Update data yang bukan file
        $user->name   = $request->name;
        $user->gender = $request->gender;
        $user->nik    = $request->nik;
        $user->email  = $request->email;

        // ======================
        // HANDLE FOTO KTP
        // ======================
        if ($request->hasFile('ktp')) {

            // Hapus file lama jika ada
            if ($user->ktp && file_exists(storage_path('app/public/' . $user->ktp))) {
                unlink(storage_path('app/public/' . $user->ktp));
            }

            // Upload baru
            $path = $request->file('ktp')->store('ktp', 'public');
            $user->ktp = $path;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
