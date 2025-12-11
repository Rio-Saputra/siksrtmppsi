<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class WargaController extends Controller
{
    public function index()
    {
        // Ambil semua user dengan role "user"
        $warga = User::where('role', 'user')->get();

        return view('admin.warga', compact('warga'));
    }
}
