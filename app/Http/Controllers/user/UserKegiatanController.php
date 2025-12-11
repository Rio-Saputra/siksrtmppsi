<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;

class UserKegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::orderBy('tanggal', 'asc')->get();

        return view('user.kegiatan', compact('kegiatan'));
    }
}
