<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',

            // NIK harus 16 digit angka
            'nik'      => 'required|digits:16|unique:users,nik',

            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',

            // Gender wajib dipilih
            'gender'   => 'required|in:Laki-laki,Perempuan',

            // KTP sebagai gambar (optional)
            'ktp'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload KTP jika ada
        $ktpPath = null;
        if ($request->hasFile('ktp')) {
            $ktpPath = $request->file('ktp')->store('ktp', 'public');
        }

        User::create([
            'name'     => $request->name,
            'nik'      => $request->nik,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'gender'   => $request->gender, // <-- DISIMPAN DI SINI
            'ktp'      => $ktpPath, 
            'role'     => 'user',
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Email tidak ditemukan
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan',
            ])->withInput();
        }

        // Password salah
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah',
            ])->withInput();
        }

        Auth::login($user);

       return $user->role == 'admin'
    ? redirect()->route('admin.dashboard')->with('success', 'Berhasil Login!')
    : redirect()->route('user.dashboard')->with('success', 'Berhasil Login!');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function store(Request $request)
{
    $result = $request->file('image')->storeOnCloudinary();
    
    // Ambil URL aman (https)
    $url = $result->getSecurePath();
    
    // Simpan $url ke database TiDB
    // ...
}
    
}
