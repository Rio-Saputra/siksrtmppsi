<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function baca() {
        $users = User::all();
        return view('baca', compact('users'));
    }

    public function tambah() {
        return view('tambah');
    }

    public function proses_tambah(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email salah',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('get.tambah')->with('success', 'Data berhasil disimpan!');
        return redirect()->route('dashboard')->with('success', 'Berhasil login!');

    }
}
